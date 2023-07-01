<?php
/**
 * Best Listing general functions.
 *
 * @package best-listing
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

namespace BestListing\wpWax;

use BestListing\wpWax\Helper as ThemeHelper;

/**
 * Theme general functions.
 */
class General_Setup {

	protected static $instance = null; // class instance.

	// const.
	public function __construct() {
		// After set up theme.
		add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
		// Widget init.
		add_action( 'widgets_init', array( $this, 'register_sidebars' ), 5 );
		// Preloader script.
		add_action( 'wp_head', array( $this, 'noscript_hide_preloader' ), 1 );
		// Scroll to top.
		add_action( 'wp_head', array( $this, 'pingback' ) );
		// Preloader.
		add_action( 'wp_body_open', array( $this, 'preloader' ) );
		// Body class.
		add_filter( 'body_class', array( $this, 'body_classes' ) );
		// User custom field.
		add_filter( 'comment_form_fields', array( $this, 'comment_fields_custom_order' ) );
	}

	// Initialize the class.
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	// After set up theme.
	public function theme_setup() {
		// Theme supports.
		add_theme_support( 'title-tag' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'responsive-embeds' );
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		add_post_type_support( 'post', 'page-attributes' );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

		// theme logo.
		$defaults = array(
			'height'               => 80,
			'width'                => 130,
			'flex-height'          => true,
			'flex-width'           => true,
			'header-text'          => array( 'site-title', 'site-description' ),
			'unlink-homepage-logo' => true,
		);

		add_theme_support( 'custom-logo', $defaults );

		$args = array(
			'default-text-color' => '000000',
			'height'             => 360,
			'width'              => 1905,
			'flex-height'        => true,
			'flex-width'         => true,
		);

		add_theme_support( 'custom-header', $args );

		add_theme_support( 'custom-background' );

		// Image sizes.
		$sizes = array(
			'wpwaxtheme-size1'   => array( 736, 999, true ),     // Single Post.
			'wpwaxtheme-size2'   => array( 352, 252, true ),     // Blog and Elementor Widget.
			'wpwaxtheme-size3'   => array( 60, 60, true ),       // Blog Sidebar Widget.
			'wpwaxtheme-size4'   => array( 1120, 9999, true ),   // Page thumbnail.
			'wpwaxtheme-476x340' => array( 476, 340, true ),     // Single Listing Header Slider.
			'wpwaxtheme-260x300' => array( 260, 300, true ),     // Location Image.
		);

		$this->add_image_sizes( $sizes );

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'best_listing_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'best-listing' ),
			)
		);

		// activate_plugin( 'best-listing-toolkit/best-listing-toolkit.php' );
	}

	function custom_logo_setup() {
		$defaults = array(
			'height'               => 80,
			'width'                => 130,
			'flex-height'          => true,
			'flex-width'           => true,
			'header-text'          => array( 'site-title', 'site-description' ),
			'unlink-homepage-logo' => true,
		);

		add_theme_support( 'custom-logo', $defaults );
	}

	private function add_image_sizes( $sizes ) {
		$sizes = apply_filters( 'best_listing_image_sizes', $sizes );

		foreach ( $sizes as $size => $value ) {
			add_image_size( $size, $value[0], $value[1], $value[2] );
		}
	}

	// Widget init.
	public function register_sidebars() {

		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'best-listing' ),
				'id'            => 'sidebar',
				'before_widget' => '<div id="%1$s" class="widget %2$s atbd_widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widgettitle">',
				'after_title'   => '</h4>',
			)
		);

		$footer_widget_titles = array(
			'1' => esc_html__( 'Footer 1', 'best-listing' ),
			'2' => esc_html__( 'Footer 2', 'best-listing' ),
			'3' => esc_html__( 'Footer 3', 'best-listing' ),
			'4' => esc_html__( 'Footer 4', 'best-listing' ),
		);

		foreach ( $footer_widget_titles as $id => $name ) {
			register_sidebar(
				array(
					'name'          => $name,
					'id'            => 'footer-' . $id,
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="widget-title">',
					'after_title'   => '</h4>',
				)
			);
		}
	}

	// Preloader script.
	public function noscript_hide_preloader() {
		// Hide preloader if js is disabled.
		echo '<noscript><style>#preloader{display:none;}</style></noscript>';
	}

	// Scroll to top.
	public function pingback() {

		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}

	}

	// Preloader.
	public function preloader() {

		if ( Theme::$options['preloader'] ) {

			if ( ! empty( Theme::$options['preloader_image']['url'] ) ) {
				$preloader_img = Theme::$options['preloader_image']['url'];
			} else {
				$preloader_img = ThemeHelper::get_img( 'preloader.svg' );
			}

			echo '<div id="theme-preloader" style="background-image:url(' . esc_url( $preloader_img ) . ');"></div>';
		}
	}

	// Body class.
	public function body_classes( $classes ) {

		// Sidebar.
		if ( 'left-sidebar' === Theme::$layout ) {
			$classes[] = 'has-sidebar left-sidebar';
		} elseif ( 'right-sidebar' === Theme::$layout ) {
			$classes[] = 'has-sidebar right-sidebar';
		} else {
			$classes[] = 'no-sidebar';
		}

		// Bgtype.
		if ( 'bgimg' === Theme::$bgtype ) {
			$classes[] = 'header-bgimg';
		}

		if ( is_single() ) {
			$classes[] = 'theme-single-post';
		}

		if ( is_page() ) {
			$classes[] = 'theme-single-page';
		}

		if ( is_home() ) {
			$classes[] = 'theme-blog';
		}

		if ( is_category() ) {
			$classes[] = 'theme-category';
		}

		if ( is_archive() ) {
			$classes[] = 'theme-archive';
		}

		return $classes;
	}

	// Comment Fields Order.
	public function comment_fields_custom_order( $fields ) {
		$comment_field = $fields['comment'];
		$author_field  = $fields['author'];
		$email_field   = $fields['email'];
		unset( $fields['comment'] );
		unset( $fields['author'] );
		unset( $fields['email'] );
		// The order of fields is the order below, change it as needed:.
		$fields['author']  = $author_field;
		$fields['email']   = $email_field;
		$fields['comment'] = $comment_field;

		// Done ordering, now return the fields:.
		return $fields;
	}
}

General_Setup::instance();
