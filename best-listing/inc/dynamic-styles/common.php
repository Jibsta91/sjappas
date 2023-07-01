<?php
/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

use BestListing\wpWax\Theme;

/*
--------------
// -Typography
---------------*/
$best_listing_typo_body    = Theme::$options['typo_body'];
$best_listing_typo_h1      = Theme::$options['typo_h1'];
$best_listing_typo_h2      = Theme::$options['typo_h2'];
$best_listing_typo_h3      = Theme::$options['typo_h3'];
$best_listing_typo_h4      = Theme::$options['typo_h4'];
$best_listing_typo_h5      = Theme::$options['typo_h5'];
$best_listing_typo_h6      = Theme::$options['typo_h6'];
$best_listing_menu_typo    = Theme::$options['menu_typo'];
$best_listing_submenu_typo = Theme::$options['submenu_typo'];
$best_listing_resmenu_typo = Theme::$options['resmenu_typo'];  // Mobile Menu
?>

<?php
/*
--------------
// -Typography
---------------*/
?>

body,
gtnbg_root,
input,
gtnbg_root p {
	font-family: '<?php echo esc_html( $best_listing_typo_body['font-family'] ); ?>', sans-serif;
	font-size: <?php echo esc_html( $best_listing_typo_body['font-size'] . 'px' ); ?>;
	font-weight : <?php echo esc_html( $best_listing_typo_body['font-weight'] ); ?>;
}
h1,
h1.gtnbg_suffix {
	font-family: '<?php echo esc_html( $best_listing_typo_h1['font-family'] ); ?>', sans-serif;
	font-size: <?php echo esc_html( $best_listing_typo_h1['font-size'] . 'px' ); ?>;
	font-weight : <?php echo esc_html( $best_listing_typo_h1['font-weight'] ); ?>;
}
h2,
h2.gtnbg_suffix {
	font-family: '<?php echo esc_html( $best_listing_typo_h2['font-family'] ); ?>', sans-serif;
	font-size: <?php echo esc_html( $best_listing_typo_h2['font-size'] . 'px' ); ?>;
	font-weight : <?php echo esc_html( $best_listing_typo_h2['font-weight'] ); ?>;
}
h3,
h3.gtnbg_suffix {
	font-family: '<?php echo esc_html( $best_listing_typo_h3['font-family'] ); ?>', sans-serif;
	font-size: <?php echo esc_html( $best_listing_typo_h3['font-size'] . 'px' ); ?>;
	font-weight : <?php echo esc_html( $best_listing_typo_h3['font-weight'] ); ?>;
}
h4,
h4.gtnbg_suffix {
	font-family: '<?php echo esc_html( $best_listing_typo_h4['font-family'] ); ?>', sans-serif;
	font-size: <?php echo esc_html( $best_listing_typo_h4['font-size'] . 'px' ); ?>;
	font-weight : <?php echo esc_html( $best_listing_typo_h4['font-weight'] ); ?>;
}
h5,
h5.gtnbg_suffix {
	font-family: '<?php echo esc_html( $best_listing_typo_h5['font-family'] ); ?>', sans-serif;
	font-size: <?php echo esc_html( $best_listing_typo_h5['font-size'] . 'px' ); ?>;
	font-weight : <?php echo esc_html( $best_listing_typo_h5['font-weight'] ); ?>;
}
h6,
h6.gtnbg_suffix {
	font-family: '<?php echo esc_html( $best_listing_typo_h6['font-family'] ); ?>', sans-serif;
	font-size: <?php echo esc_html( $best_listing_typo_h6['font-size'] . 'px' ); ?>;
	font-weight : <?php echo esc_html( $best_listing_typo_h6['font-weight'] ); ?>;
}

.theme-header-menu-area .theme-main-navigation ul li a{
	font-family: '<?php echo esc_html( $best_listing_menu_typo['font-family'] ); ?>', sans-serif;
	font-size: <?php echo esc_html( $best_listing_menu_typo['font-size'] . 'px' ); ?>;
	font-weight : <?php echo esc_html( $best_listing_menu_typo['font-weight'] ); ?>;
}
