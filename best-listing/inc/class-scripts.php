<?php
/**
 * Theme scripts
 * 
 * @package best-listing
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

namespace BestListing\wpWax;

use Elementor\Plugin;

/**
 * Theme scripts.
 */
class Scripts {

	public $version; // version.
	protected static $instance = null; // instance..

	// Class const.
	public function __construct() {
		$this->version = Constants::$theme_version;

		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ), 12 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 15 );
		add_action( 'enqueue_block_editor_assets', array( $this, 'gutenberg_scripts' ) );
	}

	// Initialized the class.
	public static function instance() {

		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	// Register scripts.
	public function register_scripts() {

		$in_footer = true;
		// Bootstrap.
		wp_register_style( 'bootstrap', Helper::get_vendor_assets( 'bootstrap/css/bootstrap.min.css' ), array(), $this->version );
		// Bootstrap RTL
		wp_register_style( 'bootstrap-rtl', Helper::get_vendor_assets( 'bootstrap/css/bootstrap-rtl.css' ), array(), $this->version );
		wp_register_script( 'bootstrap', Helper::get_vendor_assets( 'bootstrap/js/bootstrap.bundle.min.js' ), array( 'jquery' ), $this->version, $in_footer );
		// Swiper Slider.
		wp_register_style( 'swiper', Helper::get_vendor_assets( 'swiper/swiper.css' ), array(), $this->version );
		wp_register_script( 'swiper', Helper::get_vendor_assets( 'swiper/swiper.js' ), array( 'jquery' ), $this->version, true );
		// Countdown.
		wp_register_script( 'jquery-counterup', Helper::get_vendor_assets( 'counter/jquery.counterup.min.js' ), array( 'jquery' ), $this->version, $in_footer );
		// Waypoints.
		wp_register_script( 'jquery-waypoints', Helper::get_vendor_assets( 'waypoints/waypoints.min.js' ), array( 'jquery' ), $this->version, $in_footer );
		// Magnific Popup.
		wp_register_script( 'jquery-magnific-popup', Helper::get_vendor_assets( 'magnific-popup/jquery.magnific-popup.min.js' ), array( 'jquery' ), $this->version, $in_footer );
		wp_register_style( 'magnific-popup', Helper::get_vendor_assets( 'magnific-popup/magnific-popup.css' ), array(), $this->version, 'all' );

		// Main Style.
		wp_register_style( 'best-listing-directorist', Helper::get_css( 'directorist' ), array(), $this->version );
		// Directory Listing RTL
		wp_register_style( 'best-listing-directorist-rtl', Helper::get_css( 'directorist-rtl' ), array(), $this->version );
		wp_register_style( 'best-listing-elementor', Helper::get_css( 'elementor' ), array(), $this->version );
		// Elementor RTL.
		wp_register_style( 'best-listing-elementor-rtl', Helper::get_css( 'elementor-rtl' ), array(), $this->version );
		wp_register_style( 'best-listing-style', Helper::get_css( 'style' ), array(), $this->version );
		// Main RTL Style.
		wp_register_style( 'best-listing-rtl-style', Helper::get_css( 'style-rtl' ), array(), $this->version );
		// Main js.
		wp_register_script( 'best-listing-main', Helper::get_js( 'main' ), array( 'jquery' ), $this->version );

		$data = array(
			'ajaxurl'         => admin_url( 'admin-ajax.php' ),
			'resmenuWidth'    => isset( Theme::$options['resmenu_width'] ) ? Theme::$options['resmenu_width'] : '991',
			'category_icons'  => class_exists( 'Directorist_Base' ) ? ThemeSupport::get_categories_icon() : '',
			'category_colors' => class_exists( 'Directorist_Base' ) ? ThemeSupport::get_categories_color() : '',
		);

		wp_localize_script( 'best-listing-main', 'best_listing_localize_data', $data );
	}

	public function add_google_fonts() {
		wp_enqueue_style( 'csf-google-web-fonts', '//fonts.googleapis.com/css?family=Roboto:400,500&#038;display=swap', false );
	}

	// Enqueue scripts.
	public function enqueue_scripts() {

		$this->add_google_fonts(); // add google fonts.

		$this->elementor_scripts(); // Elementor Scripts in preview mode.
		$this->conditional_scripts();
		$this->dynamic_style();

		if ( is_rtl() ) {
			// Bootstrap TRL.
			wp_enqueue_style( 'bootstrap-rtl' );
			// Directory Listing RTL.
			wp_enqueue_style( 'best-listing-directorist-rtl' );
			// Elementor RTL.
			wp_enqueue_style( 'best-listing-elementor-rtl' );
			// Theme CSS RTL.
			wp_enqueue_style( 'best-listing-rtl-style' );
		} else {
			// Bootstrap.
			wp_enqueue_style( 'bootstrap' );
			// Directory Listing.
			wp_enqueue_style( 'best-listing-directorist' );
			// Elementor.
			wp_enqueue_style( 'best-listing-elementor' );
			// Theme CSS.
			wp_enqueue_style( 'best-listing-style' );
		}
		
		/*
		=======================
			Enqueued JS scripts
		========================*/

		// Theme JS
		wp_enqueue_script( 'best-listing-main' );
		// Bootstrap JS
		wp_enqueue_script( 'bootstrap' );
		// Swiper JS
		wp_enqueue_style( 'swiper' );
		// Swiper CSS
		wp_enqueue_script( 'swiper' );
	}

	// Elementor loaded scripts.
	public function elementor_scripts() {

		if ( ! did_action( 'elementor/loaded' ) ) {
			return;
		}

		if ( Plugin::$instance->preview->is_preview_mode() ) {
			wp_enqueue_script( 'swiper' );
			wp_enqueue_style( 'swiper' );
			wp_enqueue_script( 'jquery-counterup' );
			wp_enqueue_script( 'jquery-waypoints' );
		}

	}

	// Gutenberg scripts.
	public function gutenberg_scripts() {
		wp_enqueue_style( 'best-listing-gutenberg', Helper::get_css( 'gutenberg' ), array(), $this->version );

		ob_start();
		Helper::requires( 'dynamic-styles/common.php' );
		$dynamic_css = ob_get_clean();

		$css = $this->add_prefix_to_css( $dynamic_css, '.wp-block.block-editor-block-list__block' );
		ob_start();

		Helper::requires( 'dynamic-styles/frontend.php' );
		$css .= ob_get_clean();

		$css = str_replace( 'gtnbg_root', '', $css );
		$css = str_replace( 'gtnbg_suffix', 'wp-block.block-editor-block-list__block', $css );
		$css = $this->optimized_css( $css );
		wp_add_inline_style( 'best-listing-gutenberg', $css );
	}

	// Conditional scripts.
	private function conditional_scripts() {

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if ( is_home() || is_category() || is_tag() || is_author() || is_date() ) {
			wp_enqueue_script( 'jquery-masonry' );
		}

		if ( class_exists( 'Directorist_Base' ) ) {

			if ( is_singular( 'at_biz_dir' ) ) {
				wp_enqueue_style( 'swiper' );
				wp_enqueue_script( 'swiper' );
				wp_enqueue_style( 'magnific-popup' );
				wp_enqueue_script( 'jquery-magnific-popup' );
			}

			if ( atbdp_is_page( 'all_locations' ) || atbdp_is_page( 'category' ) ) {
				wp_enqueue_script( 'jquery-masonry' );
			}
		}

	}

	// Banner option.
	private function template_style() {
		$css               = '';
		$header_text_color = get_header_textcolor();
		if ( 'bgcolor' === Theme::$bgtype ) {
			$bgcolor      = Theme::$bgcolor;
			$banner_style = 'background-color:{' . esc_attr( $bgcolor ) . '};';
		} else {
			$bgimg        = ! empty( get_header_image() ) ? get_header_image() : Theme::$bgimg;
			$banner_style = 'background:url(' . esc_attr( $bgimg ) . ') no-repeat scroll center center / cover;';
		}

		$css .= '.banner{' . esc_attr( $banner_style ) . '} ';
		$css .= 'h1.site-title{color: #' . esc_attr( $header_text_color ) . '}';

		if ( 'bgimg' === Theme::$bgtype ) {
			$opacity = Theme::$options['bgopacity'] / 100;
			$css    .= '.header-bgimg .banner:before{background-color: #05071D; opacity: ' . esc_attr( $opacity ) . ';}';
		}

		return $css;
	}

	// CSS prefix.
	private function add_prefix_to_css( $css, $prefix ) {

		$parts = explode( '}', $css );

		foreach ( $parts as &$part ) {

			if ( empty( $part ) ) {
				continue;
			}

			$first_part = substr( $part, 0, strpos( $part, '{' ) + 1 );
			$last_part  = substr( $part, strpos( $part, '{' ) + 2 );
			$sub_parts  = explode( ',', $first_part );

			foreach ( $sub_parts as &$sub_part ) {
				$sub_part = str_replace( "\n", '', $sub_part );
				$sub_part = $prefix . ' ' . trim( $sub_part );
			}

			$part = implode( ', ', $sub_parts ) . $last_part;
		}

		$prefixed_css = implode( "}\n", $parts );

		return $prefixed_css;
	}

	// Optimized CSS.
	private function optimized_css( $css ) {
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), ' ', $css );

		return $css;
	}

	// Loaded inline css.
	private function dynamic_style() {
		$dynamic_css  = '';
		$dynamic_css .= $this->template_style();
		ob_start();
		Helper::requires( 'dynamic-styles/frontend.php' );
		$dynamic_css .= ob_get_clean();
		$dynamic_css  = $this->optimized_css( $dynamic_css );
		wp_add_inline_style( 'best-listing-style', $dynamic_css );
	}
}

Scripts::instance();
