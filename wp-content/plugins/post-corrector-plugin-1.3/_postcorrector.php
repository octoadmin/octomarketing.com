<?php
/*
Plugin Name: Post Correcttor
Plugin URI: http://www.lordtime.com/products/post-corrector/
Description: Perform Dynamic Post Correction Tasks and Auto Keywords Linking (<a href="http://www.lordtime.com/forum/viewforum.php?f=7">Plugin Support Forum</a>)
Author: Volodymyr Danylyuk (lordtime)
Version: 1.3
Author URI: http://www.lordtime.com
*/

add_action('init', '_pc_init');
//add_action('plugins_loaded','_pc_widget_init');

function _pc_init()
{
    global $_pc;
    if( !isset($_pc) ) $_pc = new _pc();
}

class _pc
{
    function _pc()
    {
        global $wpdb, $PHP_SELF;

	$this->base = $PHP_SELF . "?page={$_REQUEST['page']}";

        $this->macros_enabled = get_option('pc_lcm'); // list childs macro
	$this->enable_cat_guess = get_option('pc_guesscat'); // list childs macro
        $this->keywords_enabled = get_option('pc_ak');
        $this->multiple_guess = get_option('pc_multicats');
        $this->preserve = get_option('pc_preserve');
        $this->pc_spost = get_option('pc_spost');
        $this->pc_loop_each = get_option('pc_loop_each');
        $this->pc_loop = get_option('pc_loop');
        $this->pc_header_footer = get_option('pc_header_footer');

        $this->threshold = get_option('pc_thresh');
        $this->threshold = $this->threshold != '' ? $this->threshold : 80;
        $this->pc_loop_each = $this->pc_loop_each != '' ? $this->pc_loop_each : 3;

        add_action('admin_menu', array(&$this, 'admin_menu'));

        // GUESS Category Enable
        if($this->enable_cat_guess) {
            add_action('publish_post', array(&$this, 'act_new_post') );
        }

        // Show Child pages
        if($this->macros_enabled) {
            add_action('the_content', array(&$this, 'filter_the_content') );
        }

        if($this->keywords_enabled) {
            $this->init_auto_keywords();
            add_action('the_content', array(&$this, 'auto_keywords') );
        }

        if($this->pc_spost) {
            add_action('the_content', array(&$this, 'single_post') );
        }

        if($this->pc_loop) {
            add_action('the_content', array(&$this, 'process_loop') );
        }

        if($this->pc_header_footer) {
            add_action('wp_head', array(&$this, 'wp_head') );
            add_action('wp_footer', array(&$this, 'wp_footer') );
        }


        // specific variables
        $this->_filter_tags = array( "a", "textarea", "select", "script", "style", "label", "noscript" , "noindex", "button" );

    }

    function admin_menu()
    {
        add_submenu_page('options-general.php', __('Post Corrector'), __('Post Corrector'), 8, __FILE__, array(&$this, 'vi_options') );
        add_submenu_page('options-general.php', __('Auto Keywords'), __('Auto Keywords'), 8, __FILE__ . '2' , array(&$this, 'vi_keywords') );
        add_submenu_page('edit.php', __('Bulk Create Categories'), __('Bulk Create Categories'), 1, __FILE__, array(&$this, 'vi_bulk_create_categories') );
    }

    function filter_the_content($data)
    {
        global $wpdb, $post;

        if($this->macros_enabled){

            //$html = print_r($post, true);
            $param = "child_of={$post->ID}&echo=0&title_li=";
            $html = wp_list_pages($param);

            $data = str_replace('%CHILDS%', $html, $data);
        }

        return $data;
    }

    function init_auto_keywords()
    {
        $keywords = get_option('pc_keywords');
        $feed_body = preg_replace('![\r\n]!', "\n", $keywords);
        $this->_words_page = array();

        if($feed_body!='')
        {
            $feed_body = preg_replace('![\r\n]!', "\n", $feed_body);
            $words = split("\n", $feed_body);
            if($words && @count($words) )
            {
                foreach($words as $pair)
                {
                    list($w, $r) = preg_split("![=\t]!", $pair, 2);
                    if($w && $r ){
                        $this->_words_page[] = array($w, $r);
                    }
                }
            }
        }
    }

    function wp_head() {
        echo get_option('pc_header');
    }

    function wp_footer() {
        echo get_option('pc_footer');
    }

    function auto_keywords($data)
    {
        return $this->replace_in_text_segment($data);
    }

    function replace_in_text_segment($text, $max_use = 3)
    {
        $usage = array();
        if (count($this->_words_page) > 0)
        {

            $source_sentence = array();
            foreach ($this->_words_page as $n => $sentence){
                 $source_sentences[$n] = preg_quote(strip_tags($sentence[0]),'/'); // str_replace(' ','((\s)|(&nbsp;))+',
            }

            $first_part = true;
            if (count($source_sentences) > 0){

                $content = '';
                $open_tags = array();
                $close_tag = '';

                $part = strtok(' '.$text, '<');

                while ($part !== false){
                    if (preg_match('/(?si)^(\/?[a-z0-9]+)/', $part, $matches)){
                        $tag_name = strtolower($matches[1]);
                        if (substr($tag_name,0,1) == '/'){
                            $close_tag = substr($tag_name, 1);
                        } else {
                            $close_tag = '';
                        }
                        $cnt_tags = count($open_tags);
                        if (($cnt_tags  > 0) && ($open_tags[$cnt_tags-1] == $close_tag)){
                            array_pop($open_tags);
                            if ($cnt_tags-1 ==0){
                            }
                        }

                        if (count($open_tags) == 0){
                            if (!in_array($tag_name, $this->_filter_tags)){
                                $split_parts = explode('>', $part, 2);
                                if (count($split_parts) == 2){
                                    foreach ($source_sentences as $n => $sentence){

                                        if(($usage[$n] < $max_use))
                                        {
                                            $key = str_replace('%keyword%', $sentence,  $this->_words_page[$n][1] );
                                            $replaces = array();
                                            $keys = array();
                                            if( preg_match('/([\.,;\?:\s]+)('.$sentence.')([\.,;\?:\s]+)/i', $split_parts[1], $ca) == 1) {
                                                    $replaces[] = '/'.preg_quote($ca[0]).'/i';
                                                    $key = str_replace('%keyword%', $ca[2],  $this->_words_page[$n][1] );
                                                    $keys[] = "{$ca[1]}$key{$ca[3]}";
                                            }
                                            if( preg_match('/^('.$sentence.')([\.,;\?:\s]+)/i', $split_parts[1], $ca) == 1) {
                                                    $replaces[] = '/^'.preg_quote($ca[0]).'/i';
                                                    $key = str_replace('%keyword%', $ca[1],  $this->_words_page[$n][1] );
                                                    $keys[] = "$key{$ca[2]}";
                                            }
                                            if( preg_match('/([\.,;\?:\s]+)('.$sentence.')$/i', $split_parts[1], $ca) == 1) {
                                                    $replaces[] = '/'.preg_quote($ca[0]).'$/i';
                                                    $key = str_replace('%keyword%', $ca[2],  $this->_words_page[$n][1] );
                                                    $keys[] = "{$ca[1]}$key";
                                            }
                                            if( preg_match('/^('.$sentence.')$/i', $split_parts[1], $ca) == 1) {
                                                    $replaces[] = '/^'.preg_quote($ca[0]).'$/i';
                                                    $key = str_replace('%keyword%', $ca[1],  $this->_words_page[$n][1] );
                                                    $keys[] = $key;
                                            }

                                            if(count($replaces))
                                            {
                                                    $split_parts[1] = preg_replace($replaces, $keys , $split_parts[1], 1);
                                                    $usage[$n]++;
                                            }

                                        }
                                    }
                                    $part = $split_parts[0].'>'.$split_parts[1];
                                    unset($split_parts);
                                }
                            } else {
                                $open_tags[] = $tag_name;
                            }
                        }
                    } else {
                        foreach ($source_sentences as $n => $sentence)
                        {
                            if(($usage[$n] < $max_use))
                            {
                                $key = str_replace('%keyword%', $sentence ,  $this->_words_page[$n][1] );
                                $replaces = array();
                                $keys = array();
                                if( preg_match('/([,;\?:\s\.]+)('.$sentence.')([,;\?:\s\.]+)/i', $part, $ca) == 1) {
                                        $replaces[] = '/'.preg_quote($ca[0]).'/i';
                                        $key = str_replace('%keyword%', $ca[2],  $this->_words_page[$n][1] );
                                        $keys[] = "{$ca[1]}$key{$ca[3]}";
                                }
                                if( preg_match('/^('.$sentence.')([,;\?:\s\.]+)/i', $part, $ca) == 1) {
                                        $replaces[] = '/^'.preg_quote($ca[0]).'/i';
                                        $key = str_replace('%keyword%', $ca[1],  $this->_words_page[$n][1] );
                                        $keys[] = "$key{$ca[2]}";
                                }
                                if( preg_match('/([,;\?:\s\.]+)('.$sentence.')$/i', $part, $ca) == 1) {
                                        $replaces[] = '/'.preg_quote($ca[0]).'$/i';
                                        $key = str_replace('%keyword%', $ca[2],  $this->_words_page[$n][1] );
                                        $keys[] = "{$ca[1]}$key";
                                }
                                if( preg_match('/^('.$sentence.')$/i', $part, $ca) == 1) {
                                        $replaces[] = '/^'.preg_quote($ca[0]).'$/i';
                                        $key = str_replace('%keyword%', $ca[1],  $this->_words_page[$n][1] );
                                        $keys[] = $key;
                                }

                                if(count($replaces))
                                {
                                        $split_parts[1] = preg_replace($replaces, $keys , $split_parts[1], 1);
                                        $usage[$n]++;
                                }

                            }
                        }
                    }

                    if ($first_part ){
                        $content .= $part;
                        $first_part = false;
                    } else {
                        $content .= $debug.'<'.$part;
                    }
                    unset($part);
                    $part = strtok('<');
                }
                $text = ltrim($content);
                unset($content);
            }
        }

        return $text;
    }



    function act_new_post($post_ID = -1, $pre = false){
        global $wpdb ;


	if ($post_ID == -1) {
	    global $post_ID;
	}

        $preserve = $this->preserve;

        $post = $wpdb->get_row("select * from {$wpdb->posts} where ID = $post_ID");
        $categories = get_categories('get=all');

        $score = array();
        $max = 0;
        $matched = 0;
        foreach($categories as $cat)
        {
            $k = substr_count(strtolower($post->post_title), strtolower($cat->name) ) * 2;
            $k += substr_count(strtolower($post->post_content), strtolower($cat->name) );

            if($k > $max ) $max = $k;
            if($k) $matched++;
            $score[$cat->cat_ID] = $k;
        }

        $accept = $this->multiple_guess ?  ($matched > 1 ? ( ($max * $this->threshold / 100)  ) : $max) : $max;

        $ad_cats = $preserve ?  wp_get_post_categories($post_ID)  : array();

        foreach($score as $cat_id => $sc){
            if($sc && $sc >= $accept) $ad_cats[] = $cat_id;
        }

        $ad_cats = array_unique($ad_cats);

        if(count($ad_cats) == 0) {
            $ad_cats[] = get_option('default_category');
        }


        wp_set_post_categories($post_ID, $ad_cats);
    }

    function single_post($data)
    {
        global $wpdb;

        if( is_single() ){
            $data = get_option('pc_prepend') . $data;
            $data .= get_option('pc_append');
        }

        return $data;
    }

    function process_loop($data)
    {
        global $wpdb;

        if($this->pc_loop_each && (is_home() || is_category() || is_archive() ) ){

            $data = get_option('pc_loop_pre') . $data;
            $data .= get_option('pc_loop_app');

            $this->pc_loop_each--;
        }

        return $data;
    }


    function vi_bulk_create_categories()
    {
        global $wpdb;

        if('bulk' == $_POST['action'] )
        {
	    $cats = $_POST['bulk_categories'];
	    $s = split("\n", $cats);
	    foreach($s as $cat){
		$cat = trim(preg_replace("![\r\n]+!", '', $cat));
		$cats = split('\/', $cat);
		$last_id = 0;
		foreach($cats as $c2){
		    $last_id = wp_create_category($c2, $last_id);
		}
	    }

	    wp_redirect("categories.php");
        }


    ?>
	<div class="wrap">
	<h2><?php  _e('Create Categories (Bulk Mode)')?></h2>
	<form name="data" id="data" method="post" action="<?php echo $this->base; ?>&noheader=1">
	<input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>" />
	<input type="hidden" name="action" value="bulk" />

	<fieldset class="options">
	<table width="100%" cellspacing="2" cellpadding="5" class="editform">

	<tr>
	<th width="25%" scope="row" valign="top" ><?php _e('Categories') ?>:</th>
	<td>
	    <textarea rows="10" cols="64" name="bulk_categories"></textarea><br/>
            <em><?php _e('Enter One Name per row')?></em><br/>

        </td>
	</tr>

        <tr valign="top">
	<th scope="row"></th>
	<td class="submit" style="text-align: left;">
	<input type="submit" value="Create"  />
	&nbsp;
	<input type="reset" value="Reset"  />
	</td>
	</tr>
        </table>


        </div>
    <?php
    }

    function vi_options()
    {
        global $wpdb;

        set_time_limit(120);

        if($_REQUEST['action'] == 'update-posts' )
        {

            // Run through all posts!
            echo "Running ...<br/><br/>";
            flush();
            $limit = 30;
            $posts = $wpdb->get_var("select count(*) from {$wpdb->posts} where post_type='post' and post_status = 'publish'");
            if($posts) {
                $start = 0;
                $count = 0;
                while($posts > 0)
                {
                    $ids = $wpdb->get_col("select ID from {$wpdb->posts} where post_type='post' and post_status = 'publish' LIMIT $start, $limit");
                    $posts -= $limit;
                    $start += $limit;
                    foreach($ids as $post_id){
                            $this->act_new_post($post_id, true);
                            $count++;
                    }

                    echo "<b>$count</b> posts processed<br/>";
                    flush();
                }
            }

            echo "<br><hr size='1'/>Done ...<br/><br/>";
            echo "<a href='edit.php'>Click here to contiune ...</a>";
            flush();
            //wp_redirect("edit.php");
            die();
        }

    ?>
	<div class="wrap">
	<h2><?php  _e('Post Corrector Options')?></h2>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options') ?>

        This plugin allows You to enable automatic guessing of post categories according to frequency of terms met in the posts.<br/>
        Most frequent keyword (among exisitng) will be assigned as a primary post category. You may consider multiple categories with ajustable threshold.

        <p class="submit"><input type="submit" name="Submit" value="<?php _e('Update Options &raquo;') ?>" /></p>


        <fieldset class="options">
        <legend>Global Post Automation Options</legend>

	<table class="optiontable">
	<tr valign="top">
	<th scope="row">&nbsp;</th>
	<td><label><input name="pc_guesscat" type="checkbox" id="pc_guesscat" value="1" <?php if($this->enable_cat_guess) echo 'checked="1"'; ?> />
	    <?php _e('Enable Category Auto Guess') ?></label>
            <input style="margin-left: 24px;" type="button" name="update" value="<?php _e('Update Categories Now!') ?>" onclick="document.location='<?php echo $this->base; ?>&noheader=1&action=update-posts'"/>
        </td>
	</tr>
	<tr valign="top">
	<th scope="row">&nbsp;</th>
	<td style="padding-left: 24px;"><label><input name="pc_preserve" type="checkbox" id="pc_preserve" value="1" <?php if($this->preserve) echo 'checked="1"'; ?> />
	    <?php _e('Keep Exisitng Categories') ?></label></td>
	</tr>

	<tr valign="top">
	<th scope="row">&nbsp;</th>
	<td style="padding-left: 24px;"><label><input name="pc_multicats" type="checkbox" id="pc_multicats" value="1" <?php if($this->multiple_guess) echo 'checked="1"'; ?> />
	    <?php _e('Allow Multiple Categories') ?></label>
        </td>
	</tr>

	<tr valign="top">
	<th scope="row">&nbsp;</th>
	<td style="padding-left: 24px;"><label>Threshold: <input type="text" name="pc_thresh" value="<?php echo $this->threshold ?>" size="3" style="text-align: right;" /> %</label>
        </td>
	</tr>

        </table>
        </fieldset>

        <fieldset class="options">
        <legend>Single Page Options</legend>

	<table class="optiontable">
	<tr valign="top">
	<th scope="row">&nbsp;</th>
	<td><label><input name="pc_lcm" type="checkbox" id="pc_lcm" value="1" <?php if($this->macros_enabled) echo 'checked="1"'; ?> />
	    <?php _e('Enable Page Macros') ?></label> -
            Enable to use <u>%CHILDS%</u> macro to display list of child pages.
        </td>
	</tr>

        </table>
        </fieldset>

        <fieldset class="options">
        <legend>Single Post Options</legend>

        <table class="optiontable">

	<tr valign="top">
	<th scope="row">&nbsp;</th>
	<td><label><input name="pc_spost" type="checkbox" id="pc_spost" value="1" <?php if($this->pc_spost) echo 'checked="1"'; ?> />
	    <?php _e('Enable Single Post Auto Data') ?></label>
        </td>
	</tr>

	<tr valign="top">
	<th scope="row"><label for="pc_keywords"><?php _e('Prepend text') ?></label></th>
	<td><textarea rows="5" cols="64" name="pc_prepend" id="pc_prepend"><?php  echo get_option('pc_prepend') ?></textarea>
        <br/>
        </td>
	</tr>

	<tr valign="top">
	<th scope="row"><label for="pc_keywords"><?php _e('Append text') ?></label></th>
	<td><textarea rows="5" cols="64" name="pc_append" id="pc_append"><?php  echo get_option('pc_append') ?></textarea>
        <br/>
        </td>
	</tr>

	<tr valign="top">
	<th scope="row">&nbsp;</th>
	<td>Theese texts are useful if you want to display some AD codes such as Adsense when each single post is displayed.
        </td>
	</tr>


	</table>
        </fieldset>

        <!-- loop options -->
        <fieldset class="options">
        <legend>Loop Options</legend>

        <table class="optiontable">

	<tr valign="top">
	<th scope="row">&nbsp;</th>
	<td><label><input name="pc_loop" type="checkbox" id="pc_loop" value="1" <?php if($this->pc_loop) echo 'checked="1"'; ?> />
	    <?php _e('Enable Loop Auto Data') ?></label>
        </td>
	</tr>

	<tr valign="top">
	<th scope="row"><label for="pc_loop_each"><?php _e('Apply to first') ?></label></th>
	<td><input name="pc_loop_each" type="text" id="pc_loop_each" value="<?php echo $this->pc_loop_each; ?>" size="3" style="text-align: right;" />
         <?php _e('Posts') ?>

        </td>
	</tr>


	<tr valign="top">
	<th scope="row"><label for="pc_keywords"><?php _e('Prepend text') ?></label></th>
	<td><textarea rows="5" cols="64" name="pc_loop_pre" id="pc_loop_pre"><?php  echo get_option('pc_loop_pre') ?></textarea>
        <br/>
        </td>
	</tr>

	<tr valign="top">
	<th scope="row"><label for="pc_loop_app"><?php _e('Append text') ?></label></th>
	<td><textarea rows="5" cols="64" name="pc_loop_app" id="pc_loop_app"><?php  echo get_option('pc_loop_app') ?></textarea>
        <br/>
        </td>
	</tr>

	<tr valign="top">
	<th scope="row">&nbsp;</th>
	<td>Theese texts are useful if you want to display some AD codes such as Adsense when each single post is displayed.
        </td>
	</tr>


	</table>
        </fieldset>




        <!-- header footer options -->
        <fieldset class="options">
        <legend>Header and Footer Options</legend>

        <table class="optiontable">

	<tr valign="top">
	<th scope="row">&nbsp;</th>
	<td><label><input name="pc_header_footer" type="checkbox" id="pc_header_footer" value="1" <?php if($this->pc_header_footer) echo 'checked="1"'; ?> />
	    <?php _e('Enable Custom Header & Footer') ?></label>
        </td>
	</tr>


	<tr valign="top">
	<th scope="row"><label for="pc_header"><?php _e('Header HTML Code') ?></label></th>
	<td><textarea rows="5" cols="64" name="pc_header" id="pc_header"><?php  echo get_option('pc_header') ?></textarea>
        <br/>
        </td>
	</tr>

	<tr valign="top">
	<th scope="row"><label for="pc_footer"><?php _e('Footer HTML Code') ?></label></th>
	<td><textarea rows="5" cols="64" name="pc_footer" id="pc_footer"><?php  echo get_option('pc_footer') ?></textarea>
        <br/>
        </td>
	</tr>

	<tr valign="top">
	<th scope="row">&nbsp;</th>
	<td>Use this to embed custom META tags and tracking codes (Google Analytics for example).
        </td>
	</tr>


	</table>
        </fieldset>



	<p class="submit">
            <input type="submit" name="Submit" value="<?php _e('Update Options &raquo;') ?>" />
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="pc_footer,pc_header,pc_header_footer,pc_lcm,pc_guesscat,pc_multicats,pc_preserve,pc_thresh,pc_prepend,pc_append,pc_spost,pc_loop,pc_loop_pre,pc_loop_app,pc_loop_each" />
	</p>
	</form>

        <div align="center">
        <a href="http://www.lordtime.com/blog/" target="_blank">&copy; Lordtime.com, Check for updates</a>
        </div>

	</div>
    <?php
    }

    function vi_keywords()
    {
        global $wpdb;

    ?>
	<div class="wrap">
	<h2><?php  _e('Auto Keywords Options')?></h2>

        Useful to link certaing keywords to various PPC Programs.
        I recommend to use theese:  <a target="_blank" href="http://tinyurl.com/34tq3q">3fn marketing</a>,
        <a target="_blank" href="http://tinyurl.com/2fyscl">Umax</a>. Its really easy to link certain keywords and make money of their use.


	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options') ?>
	<p class="submit"><input type="submit" name="Submit" value="<?php _e('Update Options &raquo;') ?>" /></p>
	<table class="optiontable">


	<tr valign="top">
	<th scope="row">&nbsp;</th>
	<td><label><input name="pc_ak" type="checkbox" id="pc_ak" value="1" <?php if($this->keywords_enabled) echo 'checked="1"'; ?> />
	    <?php _e('Enable Auto Keywords') ?></label></td>
	</tr>
	<tr valign="top">
	<th scope="row"><label for="pc_keywords"><?php _e('Keywords List') ?></label></th>
	<td><textarea rows="15" cols="64" name="pc_keywords" id="pc_keywords"><?php  echo get_option('pc_keywords') ?></textarea>
        <br/>
        <em>keyword=html replacement code</em><br/>
        Example: home repair=&lt;a href="http://myhomerepairsite.com"&gt;%keyword%&lt;/a&gt;
        </td>
	</tr>

	</table>
	<p class="submit"><input type="submit" name="Submit" value="<?php _e('Update Options &raquo;') ?>" />
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="pc_ak,pc_keywords" />
	</p>
	</form>

	</div>
    <?php
    }

}

?>
