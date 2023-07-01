<?php
/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

namespace BestListing\wpWax;

class Theme {

	protected static $instance;

	// Sitewide static variables
	public static $options;

	// Template specific variables
	public static $layout;
	public static $has_banner;
	public static $has_breadcrumb;
	public static $bgtype;
	public static $bgimg;
	public static $bgcolor;

	private function __construct() {
		add_action( 'after_setup_theme', array( $this, 'set_options' ) );
	}

	public static function instance() {

		if ( null == self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function set_options() {

		if ( class_exists( 'CSF' ) ) {
			$options = get_option( Constants::$theme_options, array() );
		} else {
			include 'predefined-data.php';
			$best_listing_option_values = json_decode( $best_listing_option_values, true );
			$options                    = $best_listing_option_values;
		}

		self::$options = apply_filters( 'best_listing_theme_options', $options );
	}
}

Theme::instance();
