<?php

global $imgevr_quick_settings_created;
$imgevr_quick_settings_created = false;

/**
 * Adds the Image Elevator button to the editor.
 */
function imgevr_media_buttons() {
  
    wp_enqueue_script('image-elavator', IMGEVR_PLUGIN_URL . '/assets/admin/js/image-elavator.js', array('jquery'));
    wp_enqueue_style('image-elevator', IMGEVR_PLUGIN_URL . '/assets/admin/css/image-elevator.020503.css' );

    wp_enqueue_style('jquery-qtip-2', IMGEVR_PLUGIN_URL . '/assets/admin/css/jquery.qtip.min.css');
    wp_enqueue_script('jquery-qtip-2', IMGEVR_PLUGIN_URL . '/assets/admin/js/jquery.qtip.min.js', array('jquery'));
    
    ?>
    <?php ?>
    <a class='button imgevr-controller' href='#'><span></span></a>
    <?php 
 ?>
    <?php
    
    global $imgevr_quick_settings_created;
    
    if ( $imgevr_quick_settings_created ) return;
    $imgevr_quick_settings_created = true;
    
    add_action('admin_footer', 'imgevr_print_quick_settings');
    add_action('wp_footer', 'imgevr_print_quick_settings');
}
add_action('media_buttons', 'imgevr_media_buttons', 20);

/**
 * Saves the form Quick Settings. 
 */
function imgevr_save_quick_settings() {

    $linksEnabled = empty( $_POST['imgevr_links_enable'] ) ? 0 : 1;
    update_option('imgevr_links_enable', $linksEnabled);
    
    $cssClasses = empty($_POST['imgevr_css_class']) ? '' : trim($_POST['imgevr_css_class']);
    update_option('imgevr_css_class', $cssClasses);
    
    // resizing options 
        
        $resizingEnabled = empty($_POST['imgevr_resizing_enable']) ? 0 : 1;
        update_option('imgevr_resizing_enable', $resizingEnabled);

        $width = isset( $_POST['imgevr_resizing_max_width'] ) ? intval( $_POST['imgevr_resizing_max_width'] ) : 0;
        if ( $width < 0 ) $width = 0;
        $width = !$width ? '' : $width;
        update_option('imgevr_resizing_max_width', $width );

        $height = isset( $_POST['imgevr_resizing_max_height'] ) ? intval( $_POST['imgevr_resizing_max_height'] ) : 0;
        if ( $height < 0 ) $height = 0;
        $height = !$height ? '' : $height;
        update_option('imgevr_resizing_max_height', $height );

        $cropMode = empty($_POST['imgevr_resizing_crop_mode']) || $_POST['imgevr_resizing_crop_mode'] === 'false' ? 0 : 1;
        update_option('imgevr_resizing_crop_mode', $cropMode);

        $saveOriginal = empty($_POST['imgevr_resizing_save_original']) ? 0 : 1;
        update_option('imgevr_resizing_save_original', $saveOriginal);
    
    

    
    // compression options 
    
        $compressionEnabled = empty($_POST['imgevr_compression_enable']) ? 0 : 1;
        update_option('imgevr_compression_enable', $compressionEnabled);

        $compressionSize = isset( $_POST['imgevr_compression_size'] ) ? intval( $_POST['imgevr_compression_size'] ) : '';
        if ( trim( $compressionSize ) === '' ) $compressionSize = 400;
        if ( $compressionSize < 0 ) $compressionSize = 0;
        update_option('imgevr_compression_size', $compressionSize );

        $compressionQuality = isset( $_POST['imgevr_compression_jpeg_quality'] ) ? intval( $_POST['imgevr_compression_jpeg_quality'] ) : '';
        if ( trim( $compressionQuality ) === '' ) $compressionQuality = 80;
        if ( $compressionQuality <= 0 || $compressionQuality > 100 ) $compressionQuality = 80;
        update_option('imgevr_compression_jpeg_quality', $compressionQuality );
    
    
 

        echo json_encode(array(
            'success' => true,
            'imgevr_links_enable' => $linksEnabled,
            'imgevr_css_class' => $cssClasses,
            'imgevr_resizing_enable' => $resizingEnabled,
            'imgevr_resizing_max_width'=>  $width,
            'imgevr_resizing_max_height' => $height,
            'imgevr_resizing_crop_mode' => $cropMode,
            'imgevr_resizing_save_original' => $saveOriginal,         
            'imgevr_compression_enable' => $compressionEnabled,
            'imgevr_compression_size' => $compressionSize,
            'imgevr_compression_jpeg_quality' => $compressionQuality   
        ));
    
    

    
    exit;
}
add_action('wp_ajax_imgevr_save_quick_settings', 'imgevr_save_quick_settings');

/**
 * Prints the form Quick Settings.
 */
function imgevr_print_quick_settings( ) {
    
    $links = get_option('imgevr_links_enable', false);
    $cssClass = get_option('imgevr_css_class', false);
    
    $resizing = get_option('imgevr_resizing_enable', false);
    $resizingMaxWidth = get_option('imgevr_resizing_max_width', '');
    $resizingMaxHeight = get_option('imgevr_resizing_max_height', '');
    $resizingCropMode = get_option('imgevr_resizing_crop_mode', false);
    $resizingSaveOriginal = get_option('imgevr_resizing_save_original', false);

    $compression = get_option('imgevr_compression_enable', false);
    
    $compressionSize = get_option('imgevr_compression_size', 400);
    $compressionQuality = get_option('imgevr_compression_jpeg_quality', 80); 
    
    if ( empty( $compressionQuality ) ) $compressionQuality = 80;
    ?>
    <div id="imgevr-quick-settings-corner"></div>
    <div id="imgevr-quick-settings" class="imgevr-dialog">
        <div class="imgevr-inner-wrap">
            
            <div class="imgevr-section">
                <div class="imgevr-option imgevr-checkbox-option">
                    <label>
                        <input type="checkbox" id="imgevr-ctrl-links" <?php if ( $links ) echo 'checked="checked"' ?> />
                        <?php _e('Paste images with links.', 'imageelevator') ?>
                    </label>  
                    <div class="imgevr-help">If set, wraps pasted images with the &lt;a&gt; tag.</div>
                </div>
                <div class="imgevr-option">
                    <div class="imgevr-table">
                        <div class="imgevr-row">
                            <div class="imgevr-cell imgevr-collapsed">
                                <label for="imgevr-ctrl-css-class">
                                    <?php _e('CSS classes', 'imageelevator') ?>
                                </label>  
                            </div>    
                            <div class="imgevr-cell">
                                <input type="text" id="imgevr-ctrl-css-class" value="<?php echo $cssClass ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="imgevr-help">Optional. Set extra CSS classes for pasted images.</div>
                </div>           
            </div>

            <div class="imgevr-section">
                
                <?php ?>
                
                <div class="imgevr-option">
                    <label for="imgevr-ctrl-resizing">
                        <input type="checkbox" id="imgevr-ctrl-resizing" <?php if ( $resizing ) echo 'checked="checked"' ?> />
                        <?php _e('Image Resizing', 'imageelevator') ?>
                    </label>
                    <div class="imgevr-help"><?php _e('Resize pasted images to fit specific dimensions.', 'imageelevator') ?></div>  
                </div>
                <div class="imgevr-sub-option imgevr-resizing-options">
                    <div class="imgevr-option">
                        <span class="imgevr-inline-option">
                            <label for="imgevr-ctrl-max-width"><?php _e('Size', 'imageelevator') ?></label>  
                            <input type="text" id="imgevr-ctrl-max-width" value="<?php echo $resizingMaxWidth ?>" maxlength="4" />
                            <span>px /</span>
                            <input type="text" id="imgevr-ctrl-max-height" value="<?php echo $resizingMaxHeight ?>" maxlength="4" /> 
                            <span>px</span>
                        </span>
                        <span class="imgevr-inline-option">
                            <label for="imgevr-ctrl-crop-mode">
                                <?php _e('Crop to fit', 'imageelevator') ?>
                                <input style="margin-left: 3px;" type="checkbox" id="imgevr-ctrl-crop-mode" <?php if ( $resizingCropMode ) echo 'checked="checked"' ?> />
                            </label>
                        </span>
                        <div class="imgevr-help">Set a new size for pasted images: width / height.</div>
                    </div>
                    <div class="imgevr-option">
                        <label for="imgevr-ctrl-save-original">
                            <input type="checkbox" id="imgevr-ctrl-save-original" <?php if ( $resizingSaveOriginal ) echo 'checked="checked"' ?> />
                            <?php _e('Save original images', 'imageelevator') ?>
                        </label>  
                        <div class="imgevr-help">Use this option to generate thumbnails. Images resized will point to original images if the option "Paste images with links" enabled.</div>
                    </div>
                </div>
                
                <?php 
 ?>
                
            </div>

            <div class="imgevr-section">
                
                <?php ?>
                
                <div class="imgevr-option">
                    <label for="imgevr-ctrl-compression">
                        <input type="checkbox" id="imgevr-ctrl-compression" <?php if ( $compression ) echo 'checked="checked"' ?>/>
                        <?php _e('Image Compression', 'imageelevator') ?>  
                    </label>
                    <div class="imgevr-help">Convert pasted images to JPG.</div>
                </div>
                <div class="imgevr-sub-option imgevr-compression-options">
                    <div class="imgevr-option">
                        <label><?php _e('Skip images less then', 'imageelevator') ?></label>  
                        <input type="text" id="imgevr-ctrl-compression-size" value="<?php echo $compressionSize ?>" maxlength="5" />
                        <span class="imgevr-units">Kb</span>
                        <div class="imgevr-help">The image will not be compressed if its size is less.</div>
                    </div>
                    <div class="imgevr-option">
                        <label><?php _e('JPEG Quality', 'imageelevator') ?></label>  
                        <input type="text" id="imgevr-ctrl-jpeg-quality" value="<?php echo $compressionQuality ?>" maxlength="3" />
                        <span class="imgevr-units">%</span>
                        <div class="imgevr-help">The quality level of compressed images (0-100%).</div>
                    </div>
                </div>
                
                <?php 
 ?>
                
            </div>
            
            <?php ?>
            
            <div class="imgevr-actions">
                <a href="#" id="imgevr-btn-manage" class="button imgevr-active">
                    <span class="imgevr-active">is active</span>
                    <span class="imgevr-deactive">is inactive</span>
                </a>
                <a href="#" class="button" id="imgevr-btn-cancel"><?php _e('Close', 'imageelevator') ?></a>
                <a href="#" class="button button-primary" id="imgevr-btn-update-rules"><?php _e('Update Rules', 'imageelevator') ?></a>
            </div>
            
        </div>
    </div>
    
    <script>
        if ( !window.imgevr ) window.imgevr = {};
        window.imgevr.assetsUrl = '<?php echo IMGEVR_PLUGIN_URL . '/assets/admin' ?>';
        window.imgevr.ajaxurl = '<?php echo admin_url('admin-ajax.php') ?>';
    </script>
    
    <?php
    ?>
    <script>
        window.imgevr_clipboard_active = <?php echo ( get_option('imgelv_clipboard_enable') ? 'true' : 'false' ); ?>;
    </script>
    <?php  
    

}
