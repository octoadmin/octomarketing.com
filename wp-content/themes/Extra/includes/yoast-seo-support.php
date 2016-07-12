<?php
// Prevent file from being loaded directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( ! function_exists( 'is_plugin_active' ) ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

/**
 * Only load if YOAST SEO plugin is activated
 */
if ( is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) {
	/**
	 * Force YOAST SEO to use title and meta description options on Dashboard > Titles & Metas > Homepage
	 * when Category Builder is used for homepage.
	 * @return string
	 */
	function extra_yoast_seo_show_titledesc_options( $value, $option ) {
		global $pagenow;

		if ( is_admin() && 'admin.php' === $pagenow && isset( $_GET['page'] ) && 'wpseo_titles' === $_GET['page'] && 'layout' === $value ) {
			$value = 'posts';
		}

		return $value;
	}
	add_filter( 'option_show_on_front', 'extra_yoast_seo_show_titledesc_options', 10, 2 );

	/**
	 * Get values from WPSEO_Options based on given key if current page is
	 * homepage and category builder is used on homepage
	 * @return string
	 */
	function extra_yoast_seo_homepage_adjustment( $option_key, $default ) {
		if ( class_exists( 'WPSEO_Options' ) && is_home() && 'layout' === get_option( 'show_on_front' ) ) {
			$all_options = WPSEO_Options::get_all();
		}

		$value = isset( $all_options[$option_key] ) ? $all_options[$option_key] : $default;

		return wpseo_replace_vars( $value, array() );
	}

	/**
	 * Adjusting homepage's title tag
	 * @return string
	 */
	function extra_yoast_seo_homepage_title_adjustment( $title ) {
		return extra_yoast_seo_homepage_adjustment( 'title-home-wpseo', $title );
	}
	add_filter( 'wpseo_title', 'extra_yoast_seo_homepage_title_adjustment' );

	/**
	 * Adjusting homepage's meta description
	 * @return string
	 */
	function extra_yoast_seo_homepage_meta_desc_adjustment( $desc ) {
		return extra_yoast_seo_homepage_adjustment( 'metadesc-home-wpseo', $desc );
	}
	add_filter( 'wpseo_metadesc', 'extra_yoast_seo_homepage_meta_desc_adjustment' );
}