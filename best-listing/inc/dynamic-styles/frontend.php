<?php
/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

namespace BestListing\wpWax;

Helper::includes( 'dynamic-styles/common.php' );

/*
--------------
// -CSS Variables
---------------*/
$best_listing_primary_color = Helper::get_primary_color();                                                          // #ff385c
$best_listing_primary_rgb   = Helper::hex2rgb( $best_listing_primary_color );                                       // 239, 48, 114
$best_listing_other_colors  = Theme::$options['other_colors'] ? Theme::$options['other_colors'] : 'primary_color';
$best_listing_is_custom     = 'custom' === $best_listing_other_colors ? true : false;

$best_listing_menu_text_colors = Theme::$options['menu_text_colors'] ? Theme::$options['menu_text_colors'] : array();
$best_listing_menu_color_text  = $best_listing_menu_text_colors['default'] ? $best_listing_menu_text_colors['default'] : '#51526e';

$best_listing_menu_hover_color_text  = $best_listing_is_custom && $best_listing_menu_text_colors['hover'] ? $best_listing_menu_text_colors['hover'] : $best_listing_primary_color;
$best_listing_menu_active_color_text = $best_listing_is_custom && $best_listing_menu_text_colors['active'] ? $best_listing_menu_text_colors['active'] : $best_listing_primary_color;

$best_listing_add_listing_button_text_colors = Theme::$options['add_listing_button_text_colors'] ? Theme::$options['add_listing_button_text_colors'] : array();
$best_listing_add_listing_button_text_color  = $best_listing_add_listing_button_text_colors['default'] ? $best_listing_add_listing_button_text_colors['default'] : '#fff';

$best_listing_add_listing_button_text_color_hover = $best_listing_add_listing_button_text_colors['hover'] ? $best_listing_add_listing_button_text_colors['hover'] : '#fff';

$best_listing_add_listing_button_bgcolors       = Theme::$options['add_listing_button_bgcolors'] ? Theme::$options['add_listing_button_bgcolors'] : array();
$best_listing_add_listing_button_bgcolor        = $best_listing_is_custom && $best_listing_add_listing_button_bgcolors['default'] ? $best_listing_add_listing_button_bgcolors['default'] : $best_listing_primary_color;
$best_listing_add_listing_button_bgcolors_hover = $best_listing_is_custom && $best_listing_add_listing_button_bgcolors['hover'] ? $best_listing_add_listing_button_bgcolors['hover'] : $best_listing_primary_color;

$best_listing_banner_bgopacity       = Theme::$options['bgopacity'] ? Theme::$options['bgopacity'] : '60';
$best_listing_banner_title_color     = Theme::$options['banner_title_color'] ? Theme::$options['banner_title_color'] : '#fff';
$best_listing_breadcrumb_link_colors = Theme::$options['breadcrumb_link_colors'] ? Theme::$options['breadcrumb_link_colors'] : array();

$best_listing_breadcrumb_link_color        = $best_listing_breadcrumb_link_colors['default'] ? $best_listing_breadcrumb_link_colors['default'] : '#f8f9fb';
$best_listing_breadcrumb_link_color_hover  = $best_listing_is_custom && $best_listing_breadcrumb_link_colors['hover'] ? $best_listing_breadcrumb_link_colors['hover'] : $best_listing_primary_color;
$best_listing_breadcrumb_link_color_active = $best_listing_is_custom && $best_listing_breadcrumb_link_colors['active'] ? $best_listing_breadcrumb_link_colors['active'] : '#acabac';
$best_listing_breadcrumb_seperator_color   = isset( Theme::$options['breadcrumb_seperator_color'] ) ? Theme::$options['breadcrumb_seperator_color'] : '#f8f9fb';

$best_listing_footer_bgcolor       = Theme::$options['footer_bgcolor'] ? Theme::$options['footer_bgcolor'] : '#ffffff';
$best_listing_footer_divider_color = Theme::$options['footer_divider_color'] ? Theme::$options['footer_divider_color'] : '#eff1f6';
$best_listing_footer_title_color   = Theme::$options['footer_title_color'] ? Theme::$options['footer_title_color'] : '#1a1b29';
$best_listing_footer_text_color    = Theme::$options['footer_text_color'] ? Theme::$options['footer_text_color'] : '#605f74';

$best_listing_footer_link_colors      = Theme::$options['footer_link_colors'];
$best_listing_footer_link_color       = $best_listing_footer_link_colors['default'] ? $best_listing_footer_link_colors['default'] : '#51526e';
$best_listing_footer_link_hover_color = $best_listing_is_custom && $best_listing_footer_link_colors['hover'] ? $best_listing_footer_link_colors['hover'] : $best_listing_primary_color;
?>

<?php
/*
--------------
// -CSS Variables
---------------*/
?>

:root {
	--color-primary       : <?php echo esc_attr( $best_listing_primary_color ); ?>;
	--color-primary-rgba  : <?php echo esc_attr( $best_listing_primary_rgb ); ?>;
	--color-primary-rgb-1 : rgb(<?php echo esc_attr( $best_listing_primary_rgb ); ?>, 0.1) ;
	--color-primary-rgb-05: rgb(<?php echo esc_attr( $best_listing_primary_rgb ); ?>, 0.05);
	--color-primary-rgb-15: rgb(<?php echo esc_attr( $best_listing_primary_rgb ); ?>, 0.15);

	--color-menu       : <?php echo esc_attr( $best_listing_menu_color_text ); ?>;
	--color-menu-hover : <?php echo esc_attr( $best_listing_menu_hover_color_text ); ?>;
	--color-menu-active: <?php echo esc_attr( $best_listing_menu_active_color_text ); ?>;

	--color-add-listing-button-text      : <?php echo esc_attr( $best_listing_add_listing_button_text_color ); ?>;
	--color-add-listing-button-text-hover: <?php echo esc_attr( $best_listing_add_listing_button_text_color_hover ); ?>;
	--bgcolor-add-listing-button         : <?php echo esc_attr( $best_listing_add_listing_button_bgcolor ); ?>;
	--bgcolor-add-listing-button-hover   : <?php echo esc_attr( $best_listing_add_listing_button_bgcolors_hover ); ?>;

	--banner-bg-opacity          : <?php echo esc_attr( $best_listing_banner_bgopacity ); ?>;
	--color-banner_title         : <?php echo esc_attr( $best_listing_banner_title_color ); ?>;
	--color-breadcrumb-link      : <?php echo esc_attr( $best_listing_breadcrumb_link_color ); ?>;
	--color-breadcrumb-link-hover: <?php echo esc_attr( $best_listing_breadcrumb_link_color_hover ); ?>;
	--color-breadcrumb-active    : <?php echo esc_attr( $best_listing_breadcrumb_link_color_active ); ?>;
	--color-breadcrumb_separator : <?php echo esc_attr( $best_listing_breadcrumb_seperator_color ); ?>;

	--bgcolor-footer         : <?php echo esc_attr( $best_listing_footer_bgcolor ); ?>;
	--color-footer-divider   : <?php echo esc_attr( $best_listing_footer_divider_color ); ?>;
	--color-footer-title     : <?php echo esc_attr( $best_listing_footer_title_color ); ?>;
	--color-footer-text      : <?php echo esc_attr( $best_listing_footer_text_color ); ?>;
	--color-footer-link      : <?php echo esc_attr( $best_listing_footer_link_color ); ?>;
	--color-footer-link-hover: <?php echo esc_attr( $best_listing_footer_link_hover_color ); ?>;

	--color-facebook: #3b5998;
	--color-twitter: #1da1f2;
	--color-youtube: #cd201f;
	--color-instagram: #262626;
	--color-linkedin: #0077b5;
	--color-pinterest: #b7081b;
	--color-rss: #EA6221;

	--color-facebook-rgba: 59, 89, 152;
	--color-twitter-rgba: 29, 161, 242;
	--color-youtube-rgba: 205, 32, 31;
	--color-instagram-rgba: 38, 38, 38;
	--color-linkedin-rgba: 0, 119, 181;
	--color-pinterest-rgba: 183, 8, 27;
	--color-rss-rgba: 234, 98, 33;
	
	--color-gray: #605F74;
	--color-white:#ffffff;
	--color-body: #51526e;
	--color-light-gray: #8f8e9f;

	--color-border: #e1e4ec;
	--color-border-light: #eff1f6;
}
