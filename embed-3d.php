<?php
/*
Plugin Name: 3DHop 
Plugin URI: 
Description: Adds support to embed Nexus (.nxz) files usgin the  3D Heritage Online Presenter (http://3dhop.net/)
Author: leogermani
Version: 0.1
Text Domain: 3dhop-viewer
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/
namespace NxzEmbed;

class Embed {
	
	private static $instance = null;

    public static function get_instance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
	
	protected function __construct() {
		
		/**
		 * Add responsiveness to embeds
		 */
		// add_filter('embed_oembed_html', [$this, 'responsive_embed'], 10, 3);
		// add_action( 'admin_enqueue_scripts', array( &$this, 'add_css' ) );
		// add_action( 'wp_enqueue_scripts', array( &$this, 'add_css' ) );

		/**
		 * ADD NXZ Embed handler using 3DHOP
		 */
		wp_embed_register_handler( 'nxz', '#^https?://.+?\.(nxz)$#i', [$this, 'nxz_embed_handler'] );
		//wp_oembed_add_provider( '#^https?://.+?\.(nxz)$#i', 'http://localhost/wp/wp-json/oembed/1.0/', true );
		add_filter( 'upload_mimes', [$this, 'allow_nxz_upload'], 1, 1 );
		
	}
	
	public function nxz_embed_handler($matches, $attr, $url, $rawattr) {
		$viewer_url = plugins_url('3dhop/3dhop-viewer.php', __FILE__);
		$viewer_url .= '?model_url=' . esc_url($url);
		
		$defaults = array(
			'width' => '100%',
			'height' => '640px'
		);
		
		$args = array_merge($attr, $defaults);

		$dimensions = '';
		if ( ! empty( $args['width'] ) && ! empty( $args['height'] ) ) {
			$dimensions .= sprintf( "width='%s' ", $args['width'] );
			$dimensions .= sprintf( "height='%s' ", $args['height'] );
		}

		$iframe = "<iframe id='iframeNXZ' scrolling='no' name='iframeNXZ' src='$viewer_url' $dimensions allowfullscreen webkitallowfullscreen></iframe>";
		return $iframe;
	}
	
	public function allow_nxz_upload($mime_types) {
		$mime_types['nxz'] = 'application/octet-stream';
		return $mime_types;
	}
	
	/**
	 * Responsiveness
	 */
	// public function add_css() {
	// 	global $TAINACAN_BASE_URL;
	// 	wp_enqueue_style( 'tainacan-embeds', $TAINACAN_BASE_URL . '/assets/css/tainacan-embeds.css' );
	// }
	/**
	 * Adds a responsive embed wrapper around oEmbed content
	 * @param  string $html The oEmbed markup
	 * @param  string $url  The URL being embedded
	 * @param  array  $attr An array of attributes
	 * @return string       Updated embed markup
	 */
	// function responsive_embed($html, $url, $attr) {
	// 	return $html !== '' ? '<div class="tainacan-embed-container">'.$html.'</div>' : '';
	// }
	 
}

Embed::get_instance();