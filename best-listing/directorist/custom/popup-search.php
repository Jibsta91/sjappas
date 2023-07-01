<?php
/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

use BestListing\wpWax\Theme;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ( ! class_exists( 'Directorist_Base' ) && atbdp_is_page( 'add_listing' ) ) || ! Theme::$options['header_search'] ) {
	return;
}
?>

<div class="theme-menu-action-box__search">

	<a href="" class="theme-menu-action-box__search--trigger" data-bs-toggle="modal" data-bs-target="#theme-search-popup">

		<?php directorist_icon( 'las la-search', 'search-icon' ); ?>

	</a>

</div>

<div id="theme-search-popup" class="theme-search-popup modal fade" tabindex="-1" aria-labelledby="theme-search-popupLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen h-auto">
		<div class="modal-content">
			<div class="modal-header border-0">
				<button class="theme-popup-close btn-close" data-bs-dismiss="modal" aria-label="Close"><span><?php esc_html_e( '×', 'best-listing' ); ?></span></button>
			</div>
			<div class="modal-body py-0">
				<div class="theme-search-popup-box">

					<div class="container">

						<div class="row">

							<div class="col-12">

								<?php echo do_shortcode( '[directorist_search_listing more_filters_button="no" show_title_subtitle="no" show_popular_category="no"]' ); ?>

							</div>

						</div>

					</div>

				</div>
			</div>
		</div>
	</div>
</div>
