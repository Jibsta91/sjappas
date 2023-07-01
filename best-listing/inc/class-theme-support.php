<?php
/**
 * Functions which enhance the theme by hooking into Directorist.
 * 
 * @package best-listing
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

namespace BestListing\wpWax;

use BestListing\wpWax\Helper as BestListingHelper;
use Directorist\Directorist_Listing_Dashboard;
use Directorist\Directorist_Listing_Taxonomy;
use Directorist\Directorist_Listing_Form;
use Directorist\Directorist_Listings;
use Directorist\Helper;

/**
 * Main class to add support of directorist.
 */
class ThemeSupport {

	use Directorist_Taxonomy_Custom_Fields;

	protected static $instance = null;
	public static $searchform;
	public static $listings_options;
	public static $price_currency_symbol;

	public function __construct() { 
		$this->directorist_taxonomy_custom_fields_init();

		/*
		==============================
			All Listing Layout
		===============================*/
		// Added & Modified widgets on Builder --> All Listing Layout (Grid & List View)
		add_filter( 'atbdp_listing_type_settings_field_list', array( $this, 'all_listing_widgets' ) );

		/*
		==============================
			Single Page Layout
		===============================*/
		// Added and Modifying: Builder-> Single Page Layout -> Listing Header
		add_filter( 'directorist_listing_header_layout', array( $this, 'single_listing_header_layout' ) );
		// Adds New Sections: Builder-> Single Page Layout-> Contents.
		add_filter( 'atbdp_single_listing_other_fields_widget', array( $this, 'single_listing_other_fields' ) );
		// Adds New Sections: Builder-> Single Page Layout-> Contents.
		add_filter( 'atbdp_single_listing_content_widgets', array( $this, 'single_listing_preset_widgets' ) );

		/*
		=========================================
			Listing with Map
		==========================================*/
		// Listing with Map.
		add_filter( 'bdmv_view_as', array( $this, 'bdmv_view_as' ) );
		// Listing with Map.
		add_filter( 'atbdp_listings_with_map_header_sort_by_button', array( $this, 'atbdp_listings_with_map_header_sort_by_button' ) );
		// Map Header Title by JS.
		add_action( 'wp_ajax_best_listing_map_header_title', array( $this, 'wp_ajax_best_listing_map_header_title' ) );
		add_action( 'wp_ajax_nopriv_best_listing_map_header_title', array( $this, 'wp_ajax_best_listing_map_header_title' ) );
		// All Listings Ajax.
		add_action( 'wp_ajax_best_listing_archive_listings', array( $this, 'wp_ajax_nopriv_best_listing_archive_listings' ) );
		add_action( 'wp_ajax_nopriv_best_listing_archive_listings', array( $this, 'wp_ajax_nopriv_best_listing_archive_listings' ) );

		/*
		==============================
			Add Listing Form
		===============================*/
		// Listing form present field.
		add_filter( 'atbdp_form_preset_widgets', array( $this, 'atbdp_form_preset_widgets' ) );
		// Listing form custom field.
		add_filter( 'atbdp_submission_form_settings', array( $this, 'atbdp_submission_form_settings' ) );
		add_action( 'directorist_before_add_listing_from_frontend', array( $this, 'directorist_before_add_listing_from_frontend' ) );
		add_filter( 'atbdp_form_custom_widgets', array( $this, 'atbdp_form_custom_widgets' ) );

		// Add User signup & login Modal to header
		add_action( 'wp_body_open', array( $this, 'header_login_modal' ) );
		// Add Listing Popup Login.
		add_filter( 'atbdp_listing_form_login_link', array( $this, 'atbdp_listing_form_login_link' ) );
		// Add Listing Popup Sign up.
		add_filter( 'atbdp_listing_form_signup_link', array( $this, 'atbdp_listing_form_signup_link' ) );
		// Improved listing type widget in frontend
		add_filter( 'atbdp_listing_type_form_fields', array( $this, 'add_listing_group_field_icon' ) );

		/*
		============================================
			Additional modifications
		===============================================*/
		// Contact Button Modal HTML for Single Listing.
		add_action( 'wp_footer', array( $this, 'contact_listing_owner_html' ), 100 );
		// Modified the query $args for All Locations.
		add_filter( 'atbdp_all_locations_argument', array( $this, 'atbdp_all_locations_argument' ) );
		// Add Title in Taxonomy Page.
		add_action( 'atbdp_before_all_categories_loop', array( $this, 'taxonomy_title' ) );
		add_action( 'atbdp_before_all_locations_loop', array( $this, 'taxonomy_title' ) );
		// Add category image size.
		add_action( 'atbdp_category_image_size', array( $this, 'atbdp_category_image_size' ) );
		// Add location image size.
		add_action( 'atbdp_location_image_size', array( $this, 'atbdp_location_image_size' ) );

		// Unique Classes are Added Based on Directorist Template.
		add_filter( 'body_class', array( $this, 'body_classes' ) );

		// Enqueue scripts for Builder.
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		// Removing the 'directorist-inline-style' to prevent CSS conflict.
		add_filter( 'directorist_css_scripts', array( $this, 'directorist_css_scripts' ) );

		// Unset Option Value.
		add_filter( 'directorist_option', array( $this, 'directorist_option' ), 10, 2 );
	}

	// Initialize the class.
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function all_listing_widgets( $fields ) {

		// Adds & Modified Grid & List View.
		foreach ( $fields as $key => $value ) {

			if ( 'listings_card_grid_view' === $key ) {
				array_push(
					$fields[ $key ]['card_templates']['grid_view_with_thumbnail']['layout']['thumbnail']['bottom_left']['acceptedWidgets'],
					'pricing'
				);

				if ( class_exists( 'BD_Business_Hour' ) ) {
					array_push(
						$fields[ $key ]['card_templates']['grid_view_with_thumbnail']['layout']['footer']['right']['acceptedWidgets'],
						'open_close_badge'
					);
					array_push(
						$fields[ $key ]['card_templates']['grid_view_without_thumbnail']['layout']['footer']['right']['acceptedWidgets'],
						'open_close_badge'
					);
				}
			}

			if ( 'listings_card_list_view' === $key ) {
				array_push(
					$fields[ $key ]['card_templates']['list_view_with_thumbnail']['layout']['footer']['right']['acceptedWidgets'],
					'pricing'
				);

				if ( class_exists( 'BD_Business_Hour' ) ) {
					array_push(
						$fields[ $key ]['card_templates']['list_view_without_thumbnail']['layout']['footer']['right']['acceptedWidgets'],
						'open_close_badge'
					);
				}
			}
		}

		// Adds Pricing Plan Listing Type Section Settings
		if ( class_exists( 'ATBDP_Pricing_Plans' ) ) {
			$fields['enable_onelisting_listing_type'] = array(
				'label' => __( 'Show Listing Type Section at Top', 'best-listing' ),
				'type'  => 'toggle',
				'name'  => 'enable_onelisting_listing_type',
				'value' => true,
			);

			$fields['onelisting_choose_listing_type_label'] = array(
				'type'  => 'text',
				'name'  => 'general_label',
				'label' => esc_html__( 'Section Title', 'best-listing' ),
				'value' => esc_html__( 'Choose listing type', 'best-listing' ),

			);
			$fields['onelisting_general_label'] = array(
				'type'  => 'text',
				'name'  => 'general_label',
				'label' => esc_html__( 'General listing label', 'best-listing' ),
				'value' => esc_html__( 'Regular listing', 'best-listing' ),

			);
			$fields['onelisting_featured_label'] = array(
				'type'  => 'text',
				'name'  => 'featured_label',
				'label' => esc_html__( 'Featured listing label', 'best-listing' ),
				'value' => esc_html__( 'Featured listing', 'best-listing' ),

			);
		}

		// Add sSimilar Listings Section at Bottom of the Single Listing Page
		$fields['show_similar_listings'] = array(
			'type'      => 'toggle',
			'label'     => __( 'BestListing: Similar Listings at Bottom', 'best-listing' ),
			'labelType' => 'h3',
			'value'     => true,
		);

		$fields['similar_listings_label'] = array(
			'type'    => 'text',
			'name'    => 'featured_label',
			'label'   => esc_html__( 'Section Title', 'best-listing' ),
			'value'   => esc_html__( 'Similar Properties', 'best-listing' ),
			'show_if' => array(
				'where'      => 'show_similar_listings',
				'conditions' => array(
					array(
						'key'     => 'value',
						'compare' => '=',
						'value'   => true,
					),
				),
			),

		);

		return $fields;
	}

	// Adds and Modified: Builder-> Single Page Layout -> Listing Header.
	public function single_listing_header_layout( $fields ) {

		if ( class_exists( 'BD_Business_Hour' ) ) {
			$fields['widgets']['open_close_badge'] = array(
				'type'  => 'button',
				'label' => esc_html__( 'Open/Close', 'best-listing' ),
				'icon'  => 'uil uil-text-fields',
			);

			array_push(
				$fields['layout']['listings_header']['quick_info']['acceptedWidgets'],
				'open_close_badge'
			);
		}

		// Add Listing Title in General Area.
		$fields['card-options']['general']['listing_title'] = array(
			'type'    => 'title',
			'label'   => __( 'Listing Title', 'best-listing' ),
			'options' => array(
				'title'  => __( 'Listing Title Settings', 'best-listing' ),
				'fields' => array(
					'enable_title' => array(
						'type'  => 'toggle',
						'label' => __( 'Show Title', 'best-listing' ),
						'value' => true,
					),
				),
			),
		);

		// Remove Unused Fields.
		unset( $fields['card-options']['content_settings']['listing_description'] );
		unset( $fields['card-options']['content_settings']['listing_title'] );
		unset( $fields['card-options']['general']['section_title'] );
		unset( $fields['card-options']['general']['back'] );
		unset( $fields['widgets']['listing_slider']['options'] );

		return $fields;
	}

	// Adds New Sections: Builder-> Single Page Layout-> Contents.
	public function single_listing_other_fields( $fields ) {

		$fields['onelisting_description'] = array(
			'type'    => 'section',
			'label'   => esc_html__( 'Best Listing: Description', 'best-listing' ),
			'icon'    => 'uil uil-text-fields',
			'options' => array(
				'label'                => array(
					'type'  => 'text',
					'label' => esc_html__( 'Label', 'best-listing' ),
					'value' => 'Description',
				),
				'custom_block_id'      => array(
					'type'  => 'text',
					'label' => esc_html__( 'Custom block ID', 'best-listing' ),
					'value' => '',
				),
				'custom_block_classes' => array(
					'type'  => 'text',
					'label' => esc_html__( 'Custom block Classes', 'best-listing' ),
					'value' => '',
				),
			),
		);

		return $fields;
	}

	// Adds New Sections: Builder-> Single Page Layout-> Contents.
	public function single_listing_preset_widgets( $fields ) {
		$fields['onelisting_feature_list'] = array(
			'options' => array(
				'icon' => array(
					'type'  => 'icon',
					'label' => esc_html__( 'Icon', 'best-listing' ),
					'value' => 'las la-list',
				),
			),
		);

		return $fields;
	}

	// Contact Button Modal HTML for Single Listing.
	public function contact_listing_owner_html() {
		if ( is_singular( 'at_biz_dir' ) ) {
			return BestListingHelper::get_template_part( 'directorist/custom/listing-contact' );
		}
	}

	// Listing with Map
	public function bdmv_view_as( $html ) {
		$html  = BestListingHelper::get_template_part( 'directorist/custom/sort-map' );
		$html .= BestListingHelper::get_template_part( 'directorist/custom/view-mode-map' );

		return $html;
	}

	// unset Listing with Map sort by button.
	public function atbdp_listings_with_map_header_sort_by_button( $html ) {
		return;
	}

	// Map Header Title by JS.
	public function wp_ajax_best_listing_map_header_title() {
		 $post_id = isset( $_POST['post_id'] ) ? wp_unslash( $_POST['post_id'] ) : get_the_ID(); // @codingStandardsIgnoreLine

		$js_data  = isset( $_POST['form'] ) ? esc_html( $_POST['form'] ) : ''; // @codingStandardsIgnoreLine
		echo wp_kses_post( self::get_header_title( $post_id, $js_data ) );
		wp_die();
	}

	// All Listings Ajax.
	public function wp_ajax_nopriv_best_listing_archive_listings() {
		$type = isset( $_POST['type'] ) ? wp_unslash( $_POST['type'] ) : null; // @codingStandardsIgnoreLine
		$atts = isset( $_POST['atts'] ) ? $_POST['atts'] : array(); // @codingStandardsIgnoreLine

		$atts['directory_type']   = $type;
		$listings                 = new Directorist_Listings( $atts, 'listing' );
		$listings->directory_type = $type;

		$view          = isset( $atts['view'] ) ? sanitize_text_field( $atts['view'] ) : 'grid';
		$template_file = "archive/{$view}-view";

		Helper::get_template( $template_file, array( 'listings' => $listings ) );

		wp_die();
	}

	// Listing form present field.
	public function atbdp_form_preset_widgets( $fields ) {
		// Removed unused field.
		unset( $fields['tagline'] );

		return $fields;
	}

	public function atbdp_submission_form_settings( $settings ) {

		// Adds Pricing Plan Listing Type Section Settings
		if ( class_exists( 'ATBDP_Pricing_Plans' ) ) {
			$settings['onelisting_listing_type'] = array(
				'title'     => __( 'BestListing: Pricing Plan Listing Type', 'best-listing' ),
				'container' => 'short-width',
				'fields'    => array(
					'enable_onelisting_listing_type',
					'onelisting_choose_listing_type_label',
					'onelisting_general_label',
					'onelisting_featured_label',
				),
			);
		}

		return $settings;
	}

	public function directorist_before_add_listing_from_frontend() {

		// Add Pricing Plan Listing Type Section Markup
		if ( ! class_exists( 'ATBDP_Pricing_Plans' ) ) {
			return;
		}

		if ( strpos( $_SERVER['REQUEST_URI'], 'edit' ) ) { // @codingStandardsIgnoreLine
			return;
		}

		BestListingHelper::get_template_part( 'directorist/custom/add-listing_listing_type', $this->get_add_listing_settings_data( Directorist_Listing_Form::instance()->current_listing_type ) );
	}

	// Listing form custom field.
	public function atbdp_form_custom_widgets( $fields ) {
		$custom_field_meta_key_field = apply_filters(
			'directorist_custom_field_meta_key_field_args',
			array(
				'type'  => 'hidden',
				'label' => esc_html__( 'Key', 'best-listing' ),
				'value' => 'custom-text',
				'rules' => array(
					'unique'   => true,
					'required' => true,
				),
			) 
		);

		$fields['onelisting_feature_list'] = array(
			'label'   => 'Best Listing: Feature List',
			'icon'    => 'las la-list',
			'options' => array(
				'type'        => array(
					'type'  => 'hidden',
					'value' => 'textarea',
				),
				'label'       => array(
					'type'  => 'text',
					'label' => esc_html__( 'Label', 'best-listing' ),
					'value' => 'Feature List',
				),
				'field_key'   => array_merge(
					$custom_field_meta_key_field,
					array(
						'value' => 'custom-feature-list',
					) 
				),
				'rows'        => array(
					'type'  => 'number',
					'label' => esc_html__( 'Rows', 'best-listing' ),
					'value' => 8,
				),
				'placeholder' => array(
					'type'  => 'text',
					'label' => esc_html__( 'Placeholder', 'best-listing' ),
					'value' => esc_html__( 'ex: Air Conditioning', 'best-listing' ),
				),
				'description' => array(
					'type'  => 'text',
					'label' => esc_html__( 'Description', 'best-listing' ),
					'value' => esc_html__( 'Each new line will print a feature', 'best-listing' ),
				),
				'required'    => array(
					'type'  => 'toggle',
					'label' => esc_html__( 'Required', 'best-listing' ),
					'value' => false,
				),
			),

		);

		return $fields;
	}

	public function header_login_modal() {
		return BestListingHelper::get_template_part( 'directorist/custom/content-header-login-modal' );
	}

	// Add Listing Popup Login.
	public function atbdp_listing_form_login_link() {
		return __( '<a href="#" data-bs-toggle="modal" data-bs-target="#theme-login-modal">Here</a>', 'best-listing' );
	}

	// Add Listing Popup Sign up.
	public function atbdp_listing_form_signup_link() {
		return __( '<a href="#" data-bs-toggle="modal" data-bs-target="#theme-register-modal">Sign Up</a>', 'best-listing' );
	}

	// Icon support in group fields
	public function add_listing_group_field_icon( $args ) {

		$args['groupFields']['icon'] = array(
			'type'        => 'text',
			'label'       => 'Icon',
			'value'       => 'las la-bars',
			'placeholder' => 'icon name',
		);

		return $args;
	}

	// Modified the query $args for All Locations.
	public function atbdp_all_locations_argument( $args ) {

		// If Locations don't have any parent.
		foreach ( $args as $key => $value ) {
			if ( 'parent' === $key ) {
				$args[ $key ] = '';
			}
		}

		return $args;
	}

	// Add Title in Taxonomy Page.
	public function taxonomy_title() {
		if ( ! is_page() ) {
			return;
		}
		if ( get_the_ID() === get_directorist_option( 'all_categories_page' ) || get_the_ID() === get_directorist_option( 'single_category_page' ) || get_the_ID() === get_directorist_option( 'all_locations_page' ) || get_the_ID() === get_directorist_option( 'single_location_page' ) || get_the_ID() === get_directorist_option( 'single_tag_page' ) ) {
			printf( '<h2 class="directorist-archive-title">%s</h2>', esc_html( self::get_header_title( get_the_ID() ) ) );
		}
	}

	// Add category image size.
	public function atbdp_category_image_size() {
		return 'wpwaxtheme-476x340';
	}

	// Add location image size.
	public function atbdp_location_image_size() {
		return 'wpwaxtheme-260x300';
	}

	// Unique Classes are Added Based on Directorist Template.
	public function body_classes( $classes ) {

		if ( ! class_exists( 'Directorist_Base' ) ) {
			return;
		}

		$page_list = array(
			'home',
			'search-result',
			'add-listing',
			'all-listing',
			'dashboard',
			'author',
			'category',
			'single_category',
			'all_locations',
			'single_location',
			'single_tag',
			'registration',
			'login',
		);

		foreach ( $page_list as $page ) {

			if ( atbdp_is_page( $page ) ) {
				$classes[] = "theme-dir-{$page}";
			}
		}

		if ( is_single() && 'at_biz_dir' === get_post_type() ) {
			$classes[] = 'theme-dir-single_listing';
		}

		if ( class_exists( 'BD_Map_View' ) && atbdp_is_page( 'all-listing' ) ) {
			$is_lwm_active = strpos( get_the_content(), 'listings_with_map' );
			$classes[]     = ( $is_lwm_active ) ? 'dir-listings_with_map' : '';
		}

		return $classes;
	}

	// Enqueue scripts for Builder
	public function admin_enqueue_scripts() {
		if ( isset( $_REQUEST['page'] ) && 'atbdp-directory-types' != $_REQUEST['page'] ) { // @codingStandardsIgnoreLine
			return;
		}

		// Removed the Image Slider from Single Listing Header.
		$css = '.cptm-card-preview-widget {
			display: grid;
		}

		.cptm-title-bar {grid-row: 2;}';

		wp_add_inline_style( 'directorist-admin-style', $css );
	}

	// Removing the 'directorist-inline-style' to prevent CSS conflict.
	public function directorist_css_scripts( $css_list ) {

		foreach ( $css_list as $key => $value ) {

			if ( 'directorist-inline-style' === $key ) {
				unset( $css_list[ $key ] );
			}
		}

		return $css_list;
	}

	// Unset Option Value.
	public function directorist_option( $v, $name ) {
		// Unset Popular Category Title.
		if ( 'popular_cat_title' === $name ) {
			$v = '';
		}

		return $v;
	}

	// Symbol for Dashboard-> Bookmarks.
	public static function get_currency_symbol() {
		$currency = atbdp_get_payment_currency();

		return atbdp_currency_symbol( $currency );
	}

	// Member Joined Text for Author Page.
	public static function get_member_joined_text( $author_id ) {
		$user_registered = get_the_author_meta( 'user_registered', $author_id );
		$date            = date( 'M Y', strtotime( $user_registered ) );

		return sprintf( '%s %s', esc_html__( 'Joined in', 'best-listing' ), $date );
	}

	// Ratings HTML for Author Page.
	public static function get_rating_stars_html( $avg_rating ) {

		$avg_rating = round( $avg_rating, 1 );

		ob_start(); ?>

		<ul class="ratings" data-rating="<?php echo esc_attr( $avg_rating ); ?>">
			<li class="rating__item"></li>
			<li class="rating__item"></li>
			<li class="rating__item"></li>
			<li class="rating__item"></li>
			<li class="rating__item"></li>
		</ul>

			<?php
			echo wp_kses_post( ob_get_clean() );
	}

	// Author $args for Author.
	public static function get_author_args( $author ) {
		$author_id = $author->id;
		$bio       = get_user_meta( $author_id, 'description', true );
		$bio       = trim( $bio );

		$display_email = get_directorist_option( 'display_author_email', 'public' );

		if ( 'public' === $display_email ) {
			$email_endabled = true;
		} elseif ( 'logged_in' === $display_email && is_user_logged_in() ) {
			$email_endabled = true;
		} else {
			$email_endabled = false;
		}

		$args = array(
			'author'         => $author,
			'bio'            => nl2br( $bio ),
			'address'        => get_user_meta( $author_id, 'address', true ),
			'phone'          => get_user_meta( $author_id, 'atbdp_phone', true ),
			'email_endabled' => $email_endabled,
			'email'          => get_the_author_meta( 'user_email', $author_id ),
			'website'        => get_the_author_meta( 'user_url', $author_id ),
			'facebook'       => get_user_meta( $author_id, 'atbdp_facebook', true ),
			'twitter'        => get_user_meta( $author_id, 'atbdp_twitter', true ),
			'linkedin'       => get_user_meta( $author_id, 'atbdp_linkedin', true ),
			'youtube'        => get_user_meta( $author_id, 'atbdp_youtube', true ),
		);

		return $args;
	}

	// Header Title for All Listings, Search Results & Listings with Map.
	public static function get_header_title( $post_id, $js_data = '' ) {
		$data = array();

		if ( $js_data && ! empty( $js_data ) ) {
			parse_str( $js_data, $data );
		} elseif ( $_GET ) { // @codingStandardsIgnoreLine
			$data = $_GET; // @codingStandardsIgnoreLine
		} elseif ( $_POST ) { // @codingStandardsIgnoreLine
			$data = $_POST; // @codingStandardsIgnoreLine
		}

		$string  = ( isset( $data['q'] ) && ! empty( $data['q'] ) ) ? $data['q'] : '';
		$address = ( isset( $data['address'] ) && ! empty( $data['address'] ) ) ? $data['address'] : '';
		$in_cat  = ( isset( $data['in_cat'] ) && ! empty( $data['in_cat'] ) ) ? $data['in_cat'] : '';

		if ( ! $data ) {
			return get_the_title( $post_id );
		} elseif ( ! empty( $address ) ) {

			if ( ! empty( $string ) ) {
				/* translators: %1$s and %2$s are replaced with the search text and address */
				return sprintf( _x( '%1$s <span>in</span> %2$s', 'address place', 'best-listing' ), $string, $address );
			} else {
				return esc_html( $address );
			}
		} elseif ( ! empty( $in_cat ) ) {
			$term = get_term( $in_cat );

			if ( ! empty( $string ) ) {
				/* translators: %1$s and %2$s are replaced with the search text and category */
				return sprintf( _x( '%1$s <span>at</span> %2$s', 'address area', 'best-listing' ), $string, $term->name );
			} else {
				return esc_html( $term->name );
			}
		} elseif ( ! empty( $string ) ) {
			/* translators: %s is replaced with the search text*/
			return sprintf( _x( 'Search results <span>for</span> %s', 'search text', 'best-listing' ), $string );
		} else {
			return get_the_title( $post_id );
		}
	}

	// Show Custom Title in these pages.
	public static function show_title( $post_id ) {
		$pages = array(
			'all_listing_page',
			'search_result_page',
			'single_category_page',
			'single_location_page',
			'single_tag_page',
		);

		foreach ( $pages as $key => $page ) {
			if ( get_directorist_option( $page ) === $post_id ) {
				return true;
			}
		}

		return false;
	}

	// Remove Brackets.
	public static function remove_bracket( $count_html, $only_int = false ) {
		$count_html = str_replace( array( '(', ')' ), array( '' ), $count_html );

		if ( $only_int ) {
			$count_html = wp_strip_all_tags( $count_html );
		}

		return $count_html;
	}

	// If terms has parent.
	public static function has_parent_name( $term ) {

		if ( is_array( $term ) && 0 != $term['term']->parent ) {
			$term_obj = get_term( $term['term']->parent );

			return $term_obj->name;
		} elseif ( is_object( $term ) && $term->parent ) {
			$term_obj = get_term( $term->parent );

			return $term_obj->name;
		}

		return false;
	}

	// Single Listing Header.
	public static function get_single_listing_header( $listing ) {
		return get_term_meta( $listing->type, 'single_listing_header', true );
	}

	// Rating Reviews HTML.
	public static function get_rating_reviews_html( $post_id ) {
		$reviews_count = ATBDP()->review->db->count( array( 'post_id' => $post_id ) );
		$avg_rating    = ATBDP()->review->get_average( $post_id );
		$review_text   = ( ( $reviews_count > 1 ) || ( 0 === $reviews_count ) ) ? __( 'reviews', 'best-listing' ) : __( 'review', 'best-listing' );

		printf( '<div class="directorist-review-meta"><span class="directorist-rating-avg">%s %s </span>%s %s</div>', directorist_icon( 'fas fa-star', false ), esc_html( $avg_rating ), esc_html( $reviews_count ), esc_html( $review_text ) ); // phpcs:ignore WordPress.Security.EscapeOutput
	}

	// Dashboard Navigation for Header Avatar
	public static function get_dashboard_navigation() {
		$data['dashboard'] = Directorist_Listing_Dashboard::instance();

		return BestListingHelper::get_template_part( '/directorist/custom/header-dashboard-navigation', $data );
	}

	// Taxonomy Custom Template Args for Elementor All Categories-> Grid View -> Style 2.
	public static function get_taxonomy_data( $atts ) {
		$taxonomy = new Directorist_Listing_Taxonomy( $atts );

		$args = array(
			'taxonomy'   => $taxonomy,
			'categories' => $taxonomy->tax_data(),
			'columns'    => $taxonomy->columns,
		);

		return $args;
	}

	// Add Listing Settings Data for Pricing Plan.
	public function get_add_listing_settings_data( $dir_id ) {
		$enable_onelisting_listing_type       = get_term_meta( $dir_id, 'enable_onelisting_listing_type' );
		$onelisting_choose_listing_type_label = get_term_meta( $dir_id, 'onelisting_choose_listing_type_label' );
		$onelisting_general_label             = get_term_meta( $dir_id, 'onelisting_general_label' );
		$onelisting_featured_label            = get_term_meta( $dir_id, 'onelisting_featured_label' );

		return array(
			'current_listing_type'                 => $dir_id,
			'enable_onelisting_listing_type'       => isset( $enable_onelisting_listing_type[0] ) ? $enable_onelisting_listing_type[0] : 1,
			'onelisting_choose_listing_type_label' => isset( $onelisting_choose_listing_type_label[0] ) ? $onelisting_choose_listing_type_label[0] : esc_html__( 'Choose listing type', 'best-listing' ),
			'onelisting_general_label'             => isset( $onelisting_general_label[0] ) ? $onelisting_general_label[0] : esc_html__( 'Regular listing', 'best-listing' ),
			'onelisting_featured_label'            => isset( $onelisting_featured_label[0] ) ? $onelisting_featured_label[0] : esc_html__( 'Featured listing', 'best-listing' ),
		);
	}

	// Get View Mode 'active' class by $_POST & $object.
	public static function get_map_view_mode( $object, $mode ) {

		if ( isset( $_POST['view_as'] ) ) { // @codingStandardsIgnoreLine
			$view_as = isset( $_POST['view_as'] ) ? wp_unslash( $_POST['view_as'] ) : ''; // @codingStandardsIgnoreLine

			return ( $mode === $view_as ) ? 'active' : '';
		}

		foreach ( $object->options as $key => $value ) {
			if ( 'listing_map_view' === $key ) {
				if ( $mode === $value ) {
					return 'active';
				}
			}
		}
	}

	// Get Sort Placeholder by $_Post & Object.
	public static function get_map_sort_default_title( $post_data = array(), $listings ) {

		$best_match = esc_html__( 'Best match', 'best-listing' );

		if ( empty( $post_data ) ) {
			return $best_match;
		}

		foreach ( $post_data as $key => $value ) {
			if ( 'sort_by' === $key ) {
				foreach ( $listings->get_sort_by_link_list() as $_key => $_value ) {
					if ( $_value['key'] === $value ) {
						return ! empty( $_value['label'] ) ? $_value['label'] : $best_match;
					}
				}
			}
		}

		return $best_match;
	}

	// Get Listings Options.
	public static function get_listings_options() {
		if ( ! self::$listings_options ) {
			self::$listings_options = new Directorist_Listings();
		}

		return self::$listings_options;
	}

	// Categories Icons to Pass by Localize
	public static function get_categories_icon() {
		$terms = get_terms(
			array(
				'taxonomy'   => ATBDP_CATEGORY,
				'hide_empty' => false,
			) 
		);

		$id_icon_list = array();
		foreach ( $terms as $term ) {
			$icon                           = get_term_meta( $term->term_id, 'category_icon', true );
			$id_icon_list[ $term->term_id ] = Helper::get_icon_src( $icon );
		}

		return $id_icon_list;
	}

	// Categories Colors to Pass by Localize
	public static function get_categories_color() {
		$terms = get_terms(
			array(
				'taxonomy'   => ATBDP_CATEGORY,
				'hide_empty' => false,
			) 
		);

		$id_color_list = array();
		foreach ( $terms as $term ) {
			$color                           = get_term_meta( $term->term_id, 'onelisting_category_color', '000' );
			$id_color_list[ $term->term_id ] = $color ? $color : '000';
		}

		return $id_color_list;
	}

	// Get Listing Images by Size.
	public static function get_single_listing_images_by_size( $listing_id, $size ) {
		$listing_imgs  = get_post_meta( $listing_id, '_listing_img', true );
		$listing_imgs  = $listing_imgs ? $listing_imgs : array();
		$listing_title = get_the_title( $listing_id );
		$image_links   = array();

		// Get the preview image.
		$preview_img_id   = get_post_meta( $listing_id, '_listing_prv_img', true );
		$preview_img_link = ! empty( $preview_img_id ) ? atbdp_get_image_source( $preview_img_id, $size ) : '';
		$preview_img_alt  = get_post_meta( $preview_img_id, '_wp_attachment_image_alt', true );
		$preview_img_alt  = ( ! empty( $preview_img_alt ) ) ? $preview_img_alt : get_the_title( $preview_img_id );

		if ( ! empty( $preview_img_link ) ) {
			$image_links[] = array(
				'alt' => $preview_img_alt,
				'src' => $preview_img_link,
				'id'  => isset( $preview_img_id ) ? $preview_img_id : '',
			);
		}

		// Get the Slider Images.
		foreach ( $listing_imgs as $img_id ) {
			$alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
			$alt = ( ! empty( $alt ) ) ? $alt : get_the_title( $img_id );

			$image_links[] = array(
				'alt' => ( ! empty( $alt ) ) ? $alt : $listing_title,
				'src' => atbdp_get_image_source( $img_id, $size ),
				'id'  => $img_id,
			);
		}

		// Default Image.
		$type          = get_post_meta( $listing_id, '_directory_type', true );
		$default_image = Helper::default_preview_image_src( $type );

		if ( count( $listing_imgs ) < 1 ) {
			$listing_imgs[] = array(
				'alt' => $listing_title,
				'src' => $default_image,
				'id'  => '',
			);
		}

		return $image_links;
	}

	// Check Is View Mode Active.
	public static function is_view_mode_active( $listings, $view_mode ) {
		$list      = $listings->get_view_as_link_list();
		$view_mode = ucwords( $view_mode );

		foreach ( $list as $key => $value ) {
			if ( $view_mode === $list[ $key ]['label'] ) {
				return true;
			}
		}

		return false;
	}

	// Get View Mode Link.
	public static function get_view_mode_link( $listings, $view_mode ) {
		$list      = $listings->get_view_as_link_list();
		$view_mode = ucwords( $view_mode );

		foreach ( $list as $key => $value ) {
			if ( $view_mode === $list[ $key ]['label'] ) {
				return $value['link'];
			}
		}

		return "?{$view_mode}";
	}

	// Check whether a field has in Basic or Advanced area.
	public static function has_field_in_search_form( $field_name, $searchform, $form_type = 'basic' ) {
		$basic_or_advance = ( 'basic' === $form_type ) ? '0' : '1';

		return isset( $searchform->form_data[ $basic_or_advance ]['fields'][ $field_name ] ) ? true : false;
	}
}

ThemeSupport::instance();
