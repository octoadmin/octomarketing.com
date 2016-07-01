<?php
//
// Recommended way to include parent theme styles.
//  (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
//  
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}
//
// Your code goes below
//





// apply tags to attachments (media)
function wptp_add_tags_to_attachments() {
    register_taxonomy_for_object_type( 'post_tag', 'attachment' );
}
add_action( 'init' , 'wptp_add_tags_to_attachments' );

// apply categories to attachments (media)
function wptp_add_categories_to_attachments() {
    register_taxonomy_for_object_type( 'category', 'attachment' );
}
add_action( 'init' , 'wptp_add_categories_to_attachments' );

// apply custom content_type taxonomy to attachments (media)
function wptp_add_content_type_to_attachments() {
    register_taxonomy_for_object_type( 'content_type', 'attachment' );
}
add_action( 'init' , 'wptp_add_content_type_to_attachments' );

// apply custom creative_concept taxonomy to attachments (media)
function wptp_add_creative_concept_to_attachments() {
    register_taxonomy_for_object_type( 'creative_concept', 'attachment' );
}
add_action( 'init' , 'wptp_add_creative_concept_to_attachments' );

// apply custom target_audience taxonomy to attachments (media)
function wptp_add_target_audience_to_attachments() {
    register_taxonomy_for_object_type( 'target_audience', 'attachment' );
}
add_action( 'init' , 'wptp_add_target_audience_to_attachments' );

// apply custom media_type taxonomy to attachments (media)
function wptp_add_media_type_to_attachments() {
    register_taxonomy_for_object_type( 'media_type', 'attachment' );
}
add_action( 'init' , 'wptp_add_media_type_to_attachments' );

// apply custom message_strategy taxonomy to attachments (media)
function wptp_add_message_strategy_to_attachments() {
    register_taxonomy_for_object_type( 'message_strategy', 'attachment' );
}
add_action( 'init' , 'wptp_add_message_strategy_to_attachments' );

// apply custom tone taxonomy to attachments (media)
function wptp_add_tone_to_attachments() {
    register_taxonomy_for_object_type( 'tone', 'attachment' );
}
add_action( 'init' , 'wptp_add_tone_to_attachments' );

// apply custom look taxonomy to attachments (media)
function wptp_add_look_to_attachments() {
    register_taxonomy_for_object_type( 'look', 'attachment' );
}
add_action( 'init' , 'wptp_add_look_to_attachments' );

// apply custom builtwith_technology_profile taxonomy to attachments (media)
function wptp_add_builtwith_technology_profile_to_attachments() {
    register_taxonomy_for_object_type( 'builtwith_technology_profile', 'attachment' );
}
add_action( 'init' , 'wptp_add_builtwith_technology_profile_to_attachments' );





// Add default text to operations handbook
add_filter( 'default_content', 'my_editor_content', 10, 2 );

function my_editor_content( $content, $post ) {

    switch( $post->post_type ) {
        case 'operations_handbook':
            $content = '&lt;div class=&quot;csRow&quot;&gt; &lt;div class=&quot;csColumn&quot; style=&quot;margin: 0px; padding: 0px; float: left; width: 64.1%;&quot; data-csstartpoint=&quot;330&quot; data-csendpoint=&quot;945&quot; data-cswidth=&quot;64.1%&quot; data-csid=&quot;261812bd-4f90-1937-ab85-8ee1f6b96215&quot;&gt; &lt;h2&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;HOW?&lt;/span&gt;&lt;/h2&gt; &lt;span class=&quot;transcript ga current&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;0.79&quot;&gt;Once weve established the foundation of a system on the left side, were ready&lt;/span&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;5.21&quot;&gt;to move onto the main part of the system, which is the how-to section.&lt;/span&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;9.61&quot;&gt;This is where we list all of the systems steps.&lt;/span&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;13.27&quot;&gt;We dont need to provide every little detail regarding the how. We just want to&lt;/span&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;18.44&quot;&gt;create an outline, a sketch of the general steps that someone should follow to complete this system.&lt;/span&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;25.33&quot;&gt;Keep in mind that this system is designed to be a training tool for use in&lt;/span&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;30.23&quot;&gt;teaching the system to another person.&lt;/span&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;108.96&quot;&gt;Notice again the use of bullet points to quickly call out different ideas, and&lt;/span&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;114.75&quot;&gt;then the rest of the system unfolds step by step from here. Just keep asking&lt;/span&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;120.34&quot;&gt;that question, whats the next step and so on, until you arrive at the end result of the system.&lt;/span&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;127.57&quot;&gt;You may wonder, what if I have many steps that are going to make this document&lt;/span&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;132.7&quot;&gt;spill on to more than one page?&lt;/span&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;135.61&quot;&gt;My first recommendation is to ask if the system can or should be broken down into smaller systems.&lt;/span&gt; &lt;/div&gt; &lt;div class=&quot;csColumnGap&quot; style=&quot;margin: 0px; padding: 0px; float: left; width: 3.12%;&quot;&gt;&lt;img style=&quot;border: none;&quot; src=&quot;http://www.octomarketing.com/wp-content/plugins/advanced-wp-columns/assets/js/plugins/views/img/1x1-pixel.png&quot; alt=&quot;&quot; /&gt;&lt;/div&gt; &lt;div class=&quot;csColumn&quot; style=&quot;margin: 0px; padding: 0px; float: left; width: 31.3%;&quot; data-csstartpoint=&quot;15&quot; data-csendpoint=&quot;315&quot; data-cswidth=&quot;31.3%&quot; data-csid=&quot;46ed88e8-ab6c-1254-a760-36e1edf373d3&quot;&gt; &lt;h2&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;WHAT?&lt;/span&gt;&lt;/h2&gt; The What section is designed to create a picture in someone elses mind of the end result of the system. This is a brief phrase, one or two sentences that begins with, &quot;This system will.&quot; In the example, the what is to ensure that our clothes are clean, fresh smelling, without shrinkage or color bleeding and are ready to put in the dryer. Thats all we need. &lt;h2&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;WHY?&lt;/span&gt;&lt;/h2&gt; Now the Why section; this is the logic or motivation behind following a system. &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;97.67&quot;&gt;We want to convince in a few words someone else as to why following the system benefits them.&lt;/span&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;105.36&quot;&gt;In our example, the why says having fresh, clean clothes will help you look more&lt;/span&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;111.37&quot;&gt;attractive and socially acceptable.&lt;/span&gt; &lt;h2&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;WHO?&lt;/span&gt;&lt;/h2&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;114.74&quot;&gt;Next, the Who section. Here we simply list the positions responsible for following this system.&lt;/span&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;122.27&quot;&gt;You might list positions such as sales manager or assembly line worker, depending on the system.&lt;/span&gt; &lt;h2&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;WHEN?&lt;/span&gt;&lt;/h2&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;147.84&quot;&gt;Next, the when. This refers to any standards that we want to measure in terms of&lt;/span&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;153.5&quot;&gt;time, timing, or length.&lt;/span&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;155.59&quot;&gt;It can also include scheduled times when the system should be followed.&lt;/span&gt; &lt;h2&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;HOW MUCH?&lt;/span&gt;&lt;/h2&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;177.01&quot;&gt;Next, the How much section. Here we list anything numerical or quantifiable,&lt;/span&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;182.23&quot;&gt;such as performance standards, results, numbers, or statistics.&lt;/span&gt; &lt;h2&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;WITH WHAT?&lt;/span&gt;&lt;/h2&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;194.99&quot;&gt;Finally, the With what section. Here you list any resources the system requires.&lt;/span&gt; &lt;span class=&quot;transcript ga&quot; data-ga-action=&quot;click&quot; data-ga-label=&quot;toc-video-transcript&quot; data-duration=&quot;201.03&quot;&gt;In our example, weve listed dirty clothes, the clothes washer, detergent, laundry booster, and bleach.&lt;/span&gt; &lt;/div&gt; &lt;div style=&quot;clear: both; float: none; display: block; visibility: hidden; width: 0px; font-size: 0px; line-height: 0;&quot;&gt;&lt;/div&gt; &lt;/div&gt;
';
        break;
    }

    return $content;
}


