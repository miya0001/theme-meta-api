<?php
/**
 * Plugin Name:     Theme Review Helper
 * Plugin URI:      https://github.com/miya0001/theme-review-helper
 * Version:         0.1.0
 *
 * @package theme-review-helper
 */

register_activation_hook( __FILE__, 'my_activation_callback' );

/**
 * Callback function that be fired when the plugin activated.
 */
function my_activation_callback() {
	add_rewrite_endpoint( 'theme-features', EP_ROOT );
	add_rewrite_endpoint( 'theme-tags', EP_ROOT );
	add_rewrite_endpoint( 'theme-meta', EP_ROOT );
	flush_rewrite_rules();
}

add_action( 'init', function() {
	add_rewrite_endpoint( 'theme-features', EP_ROOT );
	add_rewrite_endpoint( 'theme-tags', EP_ROOT );
	add_rewrite_endpoint( 'theme-meta', EP_ROOT );
} );

add_action( 'template_redirect', function() {
	global $wp_query;
	if ( isset( $wp_query->query['theme-features'] ) ) {
		global $_wp_theme_features;
		header( 'content-type: application/json' );
		echo json_encode( $_wp_theme_features );
		exit;
	} elseif ( isset( $wp_query->query['theme-tags'] ) ) {
		$theme = wp_get_theme();
		header( 'content-type: application/json' );
		echo json_encode( $theme->get( 'Tags' ) );
		exit;
	} elseif ( isset( $wp_query->query['theme-meta'] ) ) {
		$theme = wp_get_theme();
		header( 'content-type: application/json' );
		if ( defined( 'IS_TEXTDOMAIN_LOADED' ) && true === IS_TEXTDOMAIN_LOADED ) {
			$is_textdomain_loaded = true;
		} else {
			$is_textdomain_loaded = false;
		}
		echo json_encode( array(
			'name' => $theme->name,
			'version' => $theme->version,
			'stylesheet' => $theme->stylesheet,
			'template' => $theme->template,
			'textdomain' => $theme->get( 'TextDomain' ),
			'is_textdomain_loaded' => $is_textdomain_loaded,
		) );
		exit;
	}
} );

add_filter( 'override_load_textdomain', function( $override, $domain, $mofile ) {
	if ( wp_get_theme()->get( 'TextDomain' ) === $domain ) {
		if ( ! defined( 'IS_TEXTDOMAIN_LOADED' ) ) {
			define( 'IS_TEXTDOMAIN_LOADED', true );
		}
	}
	return $override;
}, 10, 3 );

add_action( 'wp_head', function(){
	?>
	<script>
	( function() {
		var home_url = '<?php echo home_url(); ?>';

		window.addEventListener( 'error', function( e ) {
			var msg = e.message + ' in ' + e.filename + ' on line ' + e.lineno;
			msg = msg.replace( home_url, '' );
			document.body.setAttribute( 'data-jserror', msg );
		} );

		document.addEventListener( 'DOMContentLoaded', function() {
			var img = document.getElementsByTagName( 'img' );
			for ( var i = 0; i < img.length; i++ ) {
				img[i].addEventListener( 'error', function( e ) {
					var msg = this.src + ' not found.';
					msg = msg.replace( home_url, '' );
					document.body.setAttribute( 'data-imgerror', msg );
				} );
			}
		} );
	} )();
	</script>
	<?php
} );
