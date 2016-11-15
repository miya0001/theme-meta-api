<?php
/**
 * Plugin Name:     Theme Meta API
 * Plugin URI:      https://github.com/miya0001/theme-meta-api
 * Version:         0.1.0
 */

register_activation_hook( __FILE__, 'my_activation_callback' );

function my_activation_callback() {
	add_rewrite_endpoint( 'theme-features', EP_ROOT );
	add_rewrite_endpoint( 'theme-tags', EP_ROOT );
	add_rewrite_endpoint( 'theme-meta', EP_ROOT );
	flush_rewrite_rules();
}

add_action( "init", function() {
	add_rewrite_endpoint( 'theme-features', EP_ROOT );
	add_rewrite_endpoint( 'theme-tags', EP_ROOT );
	add_rewrite_endpoint( 'theme-meta', EP_ROOT );
} );

add_action( 'template_redirect', function() {
	global $wp_query;
	if ( isset( $wp_query->query['theme-features'] ) ) {
		global $_wp_theme_features;
		header( "content-type: application/json" );
		echo json_encode( $_wp_theme_features );
		exit;
	} elseif ( isset( $wp_query->query['theme-tags'] ) ) {
		$theme = wp_get_theme();
		header( "content-type: application/json" );
		echo json_encode( $theme->get( "Tags" ) );
		exit;
	} elseif ( isset( $wp_query->query['theme-meta'] ) ) {
		$theme = wp_get_theme();
		header( "content-type: application/json" );
		echo json_encode( array(
			"name" => $theme->name,
			"version" => $theme->version,
			"stylesheet" => $theme->stylesheet,
			"template" => $theme->template,
			"textdomain" => $theme->get( "TextDomain" ),
		) );
		exit;
	}
} );
