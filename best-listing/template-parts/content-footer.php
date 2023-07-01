<?php
/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

use BestListing\wpWax\Theme;

// Return is elementor footer.
if ( ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'footer' ) ) ) {
	return;
}

if ( class_exists( 'Directorist_Base' ) ) {
	if ( is_user_logged_in() && atbdp_is_page( 'dashboard' ) ) {
		return;
	}
}

// Return is listings with map page.
$best_listing_is_l_w_m = class_exists( 'BD_Map_View' ) && strpos( get_the_content(), 'listings_with_map' ) ? true : false;
if ( $best_listing_is_l_w_m ) {
	return;
}

$best_listing_active_sidebar = 0;

foreach ( range( 1, 4 ) as $i ) {

	if ( is_active_sidebar( 'footer-' . $i ) ) {
		$best_listing_active_sidebar++;
	}
}

switch ( $best_listing_active_sidebar ) {
	case '1':
		$best_listing_footer_class = 'col-sm-12 col-12';
		break;
	case '2':
		$best_listing_footer_class = 'col-sm-6 col-12';
		break;
	case '3':
		$best_listing_footer_class = 'col-md-4 col-sm-12 col-12';
		break;
	case '4':
		$best_listing_footer_class = 'col-lg-3 col-sm-6 col-12';
		break;
	default:
		$best_listing_footer_class = 'col-lg-12 col-sm-6 col-12';
		break;
}
?>

<footer class="site-footer">

	<?php if ( Theme::$options['footer_area'] && $best_listing_active_sidebar ) : ?>

		<div class="theme-footer-top-area">

			<div class="theme-container">

				<div class="row">

					<?php foreach ( range( 1, 4 ) as $i ) : ?>

						<?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>

							<div class="<?php echo esc_attr( $best_listing_footer_class ); ?>">

								<?php dynamic_sidebar( 'footer-' . $i ); ?>

							</div>

						<?php endif; ?>

					<?php endforeach; ?>

				</div>

			</div>

		</div>

	<?php endif; ?>

	<?php if ( Theme::$options['copyright_area'] ) : ?>

		<div class="theme-footer-bottom-area">

			<div class="theme-container">

				<div class="row">

					<div class="col-md-12">

						<div class="theme-copyright-text">
							<?php echo do_shortcode( Theme::$options['copyright_text'] ); ?>
						</div>

					</div>

				</div>

			</div>

		</div>

	<?php endif; ?>

</footer>
