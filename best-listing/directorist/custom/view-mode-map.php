<?php
/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

use BestListing\wpWax\ThemeSupport;

global $bdmv_listings;
?>
<div class="theme-view-mode view-mode-2 view-as">

	<a data-view="grid" class="action-btn-2 ab-grid map-view-grid <?php echo ThemeSupport::get_map_view_mode( $bdmv_listings, 'grid' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>">

		<?php directorist_icon( 'las la-grip-horizontal' ); ?>

	</a>

	<a data-view="list" class="action-btn-2 ab-list map-view-list <?php echo ThemeSupport::get_map_view_mode( $bdmv_listings, 'list' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>">

		<?php directorist_icon( 'las la-list' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>

	</a>

</div>
