<?php
/**
 * Functions which enhance the theme by hooking into Directorist
 *
 * @package best-listing
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

namespace BestListing\wpWax;

// Configure TGM.
class TGM_Config {

	public $prefix; // prefix.
	public $path; // path.

	// Class const.
	public function __construct() {
		$this->prefix = Constants::$theme_prefix;
		$this->path   = Constants::$theme_plugins_dir;

		add_action( 'tgmpa_register', array( $this, 'register_required_plugins' ) );
	}

	// Call plugins by array.
	public function register_required_plugins() {
		$plugins = array(
			array(
				'name'     => esc_html__( 'Best Listing Toolkit', 'best-listing' ),
				'slug'     => 'best-listing-toolkit',
				'required' => true,
			),
			array(
				'name'     => esc_html__( 'Elementor Page Builder', 'best-listing' ),
				'slug'     => 'elementor',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'Directorist – Business Directory Plugin', 'best-listing' ),
				'slug'     => 'directorist',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'Contact Form 7', 'best-listing' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'MC4WP: Mailchimp for WordPress', 'best-listing' ),
				'slug'     => 'mailchimp-for-wp',
				'required' => false,
			),
			/*
			 array(
				'name'     => esc_html__( 'WpWax Demo Importer', 'best-listing' ),
				'slug'     => 'wpwax-demo-importer',
				'source'   => 'http://demo.directorist.com/theme/demo-content/wpwax-demo-importer.zip',
				'version'  => '1.0',
				'required' => false,
			), */
		);

		$config = array(
			'id'           => $this->prefix, // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => $this->path, // Default absolute path to bundled plugins.
			'menu'         => $this->prefix . '-install-plugins', // Menu slug.
			'is_automatic' => false, // Automatically activate plugins after installation or not.
		);

		tgmpa( $plugins, $config );
	}
}

new TGM_Config();
