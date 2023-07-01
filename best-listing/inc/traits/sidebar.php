<?php
/**
 * Sidebar helper functions.
 * 
 * @package best-listing
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

namespace BestListing\wpWax;

/**
 * theme sidebar functions.
 */
trait Sidebar_Trait {

	// Check is sidebar.
	public static function has_sidebar() {
		$has_sidebar_widgets = false;

		if ( is_active_sidebar( 'sidebar' ) ) {
			$has_sidebar_widgets = true;
		}

		if ( $has_sidebar_widgets && 'full-width' !== Theme::$layout ) {
			return true;
		} else {
			return false;
		}
	}

	// Layout class is sidebar active.
	public static function the_layout_class() {
		$layout_class = self::has_sidebar() ? 'col-lg-8 col-sm-12' : 'col-sm-12';
		
		if ( is_single() ) {
			$layout_class = self::has_sidebar() ? 'col-lg-8 col-sm-12' : 'col-lg-8 offset-lg-2';
		}

		echo apply_filters( 'best_listing_layout_class', esc_html( $layout_class ) ); // phpcs:ignore WordPress.Security.EscapeOutput
	}

	// Sidebar class.
	public static function the_sidebar_class() {
		echo apply_filters( 'best_listing_sidebar_class', esc_html( 'col-lg-4 col-sm-12' ) ); // phpcs:ignore WordPress.Security.EscapeOutput
	}

	// Checked left sidebar.
	public static function left_sidebar() {

		if ( self::has_sidebar() ) {

			if ( 'left-sidebar' === Theme::$layout ) {
				get_sidebar();
			}
		}
	}

	// Checked right sidebar.
	public static function right_sidebar() {

		if ( self::has_sidebar() ) {

			if ( 'right-sidebar' === Theme::$layout ) {
				get_sidebar();
			}
		}
	}
}
