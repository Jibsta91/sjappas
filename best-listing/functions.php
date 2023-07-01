<?php
/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

namespace BestListing\wpWax;

if ( ! isset( $best_listing_content_width ) ) {
	$best_listing_content_width = 1140;
}

class BestListing_Main {

	public $theme = 'best-listing';

	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'load_textdomain' ) );
		$this->includes();
	}

	public function load_textdomain() {
		load_theme_textdomain( $this->theme, get_template_directory() . '/languages' );
	}

	public function includes() {

		do_action( 'best_listing_init_before' );

		require_once get_template_directory() . '/lib/wpwaxtheme-breadcrumb/class-breadcrumb.php';
		require_once get_template_directory() . '/lib/tgm/class-tgm-plugin-activation.php';

		require_once get_template_directory() . '/inc/class-constants.php';
		require_once get_template_directory() . '/inc/traits/init.php';
		require_once get_template_directory() . '/inc/class-helper.php';
		require_once get_template_directory() . '/inc/class-tgm-config.php';

		require_once get_template_directory() . '/inc/class-theme.php';
		require_once get_template_directory() . '/inc/class-general-setup.php';
		require_once get_template_directory() . '/inc/class-scripts.php';
		require_once get_template_directory() . '/inc/class-layouts.php';

		do_action( 'best_listing_init_after' );
	
		if ( class_exists( 'Directorist_Base' ) ) {
			require_once get_template_directory() . '/inc/class-theme-support.php';
		}
	}
}

new BestListing_Main();
