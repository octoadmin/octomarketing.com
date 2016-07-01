<?php

/**
 * Uploads image given as a binnary stream or the base64 data.
 */
function imgevr_upload_image(){
    if ( !current_user_can('edit_posts') ) return;
    
    $mime = !empty( $_POST['imgMime'] ) ? $_POST['imgMime'] : null;
    if ( 'null' === $mime ) $mime = null;
    
    $name = !empty( $_POST['imgName'] ) ? $_POST['imgName'] : null;
    if ( 'null' === $name ) $name = null;
    
    $parentId = isset( $_POST['imgParent'] ) ? intval($_POST['imgParent']) : 0;
    $ref = isset( $_POST['imgRef'] ) ? $_POST['imgRef'] : false;    

    if ( empty($mime) ) {
        if ( !empty( $_POST['file'] ) && preg_match('/image\/[a-z0-9]+/', $_POST['file'], $matches) ) {
            $mime = $matches[0];
        } else {
            factory_325_json_error('Unable to get mime type of the file.');
        }
    }

    // gets extension
    $parts = explode('/', $mime);
    $ext = empty( $parts[1] ) ? 'png' : $parts[1];
    
    if ( !in_array( $ext, array('png', 'jpeg', 'jpg', 'gif', 'tiff', 'bmp') ) ) {
        factory_325_json_error('Sorry, only following types of images allowed to paste: png, jpeg, jpg, gif, tiff, bmp');
    }
    
    // check the path to upload
    $uploadInfo = wp_upload_dir();
    $targetPath = $uploadInfo['path'];
    if ( !is_dir($targetPath) ) mkdir($targetPath, 0777, true);

    // move the uploaded file to the upload path
    $imageName = ( !empty($name) && $name !== 'undefined' ) 
                    ? factory_325_filename_without_ext($name) 
                    : 'img_' . uniqid();
    
    $target = $targetPath . '/' . $imageName . '.' . $ext;
    
    if ( isset( $_FILES['file'] ) ) {

        if ( empty( $_FILES['file']['size'] ) ) {
            factory_325_json_error('Sorry, the error of reading image data occured. May be the image is empty of has incorrect format.');
        }
        
        $source = $_FILES['file']['tmp_name'];
        move_uploaded_file($source, $target);
        
    } else {
        if ( preg_match('/base64,(.*)/', $_POST['file'], $matches) ) {
            $img = str_replace(' ', '+', $matches[1]);
            $data = base64_decode($img);
            $success = file_put_contents($target, $data);

            if ( !$success ) factory_325_json_error('Unable to save the image.');
        } else {
            factory_325_json_error('Incorrect file format (base64).');
        }
    }
    
    $media = array();
    $media['base'] = array(
        'guid' => $uploadInfo['url'] . '/' . $imageName . '.' . $ext,
        'path' => $target,
        'name' => $imageName
    );

        $resizingEnabled = get_option('imgevr_resizing_enable', false);
        $compressionEnabled = get_option('imgevr_compression_enable', false); 
        
        // if resizing is requried
        if ( $resizingEnabled ) {
            
            $saveOriginal = get_option('imgevr_resizing_save_original', false);
            
            // saving the original file
            if ( $saveOriginal ) {
                $originalPath = $targetPath . '/' . $imageName . '-full.' . $ext;
                if ( !copy($target, $originalPath) ) {
                    factory_325_json_error( 'Unable to save the original image while resizing. Please contact OnePress support.' );
                }
                
                $media['original'] = array(
                    'guid' => $uploadInfo['url'] . '/' . $imageName . '-full.' . $ext,
                    'path' => $originalPath,
                    'name' => $imageName . '-full'
                );
            }
            
            $newWidth = intval( get_option('imgevr_resizing_max_width', null ) );
            if ( empty( $newWidth ) ) $newWidth = null;
            
            $newHeight = intval( get_option('imgevr_resizing_max_height', null ) );
            if ( empty( $newHeight ) ) $newHeight = null;
            
            $cropMode = get_option('imgevr_resizing_crop_mode', false );
            
            $image = wp_get_image_editor( $target );
            if ( !is_wp_error( $image ) ) {
                $image->resize( $newWidth, $newHeight, $cropMode );
                $image->save( $target );
            } else {
                factory_325_json_error( 'Unexpected error while resizing the image: ' . $image->get_error_message() );
            }
        }

        // if compression is requried (png to jpeg)
        if ( $compressionEnabled ) { 
            
            if ( !function_exists('imagejpeg') ) {
                factory_325_json_error('The function "imagejpeg" is not defined. It means that your site configuration does not support compression of images.');
            }
            
            $size = filesize($target) / 1024;
            if ( $size > intval( get_option('imgevr_compression_size', 400) ) ) {
                $quality = intval( get_option('imgevr_compression_jpeg_quality', 80) );
                
                $newTarget = $targetPath . '/' . $imageName . '.jpg';
                $image = imagecreatefrompng($target);
                imagejpeg($image, $newTarget, $quality);
                imagedestroy($image);
                
                // removes the original file
                unlink( $target );

                $target = $newTarget;
                $ext = 'jpg';
                
                $media['base'] = array(
                    'guid' => $uploadInfo['url'] . '/' . $imageName . '.jpg',
                    'path' => $newTarget,
                    'name' => $imageName
                );
            }
        }

    

    
    // for the function wp_generate_attachment_metadata() to work
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    
    foreach( $media as $key => $item ) {
        
        $attachment = array(
            'guid' => $item['guid'],
            'post_mime_type' => $mime,
            'post_title' => $item['name'],
            'post_name' => $item['name'],
            'post_content' => '',
            'post_status' => 'inherit',
        );
        
        $media[$key]['id'] = wp_insert_attachment( $attachment, $item['path'], $parentId );
                
        $attach_data = wp_generate_attachment_metadata( $media[$key]['id'], $item['path'] );
        wp_update_attachment_metadata( $media[$key]['id'], $attach_data );     
    }
    
    $id = $media['base']['id'];
    $cssClasses = ' ' . trim( get_option( 'imgevr_css_class', '' ) );
    
    if ( !empty( $id ) ) {
        $html = "<img alt='' class='alignnone size-full wp-image-" . $id . $cssClasses . "' src='" . $media['base']['guid'] . "' />";   
    } else {
        $html = "<img alt='' class='alignnone size-full" . $cssClasses . "' src='" . $media['base']['guid'] . "' />";  
    }

    $linksEnabled = get_option( 'imgevr_links_enable', false );
    if ( $linksEnabled ) {
        $saveOriginal = get_option('imgevr_resizing_save_original', false);
            
        if ( $resizingEnabled && $saveOriginal ) {
            $html = "<a href='" . $media['original']['guid'] . "'>" . $html . '</a>';
        } else {
            $html = "<a href='" . $media['base']['guid'] . "'>" . $html . '</a>';
        }
    }

    $result = array(
        'html' => $html
    );
    
    echo json_encode($result);
    exit;
}

add_action('wp_ajax_imageinsert_upload', 'imgevr_upload_image');
