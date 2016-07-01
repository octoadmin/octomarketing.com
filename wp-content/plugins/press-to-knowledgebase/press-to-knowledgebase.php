<?php
/**
 * Plugin Name: Custom Press-This Post Type
 * Plugin URI:  http://wordpress.stackexchange.com/a/192065/26350
 */
add_action( 'wp_ajax_press-this-save-post', function()        
{ 
    add_filter( 'wp_insert_post_data', function( $data )
    {
        $old_cpt = 'post';
        $new_cpt = 'knowledgebase';  // <-- Edit this cpt to your needs!

        $obj = get_post_type_object( $new_cpt );

        // Change the post type
        if( 
               isset( $data['post_type'] ) 
            && $old_cpt === $data['post_type'] 
            && isset( $obj->cap->create_posts ) 
            && current_user_can( $obj->cap->create_posts )   // Check for capability
        )
            $data['post_type'] = $new_cpt;

        return $data;

    }, PHP_INT_MAX );

}, 0 );