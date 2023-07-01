<?php
/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

use BestListing\wpWax\ThemeSupport;
use BestListing\wpWax\Helper as ThemeHelper;

?>

<div class="theme-header-action__author--info">

	<?php ThemeHelper::avatar_image( 40 ); ?>

	<div class="theme-header-author-navigation">

		<?php echo ThemeSupport::get_dashboard_navigation(); // phpcs:ignore WordPress.Security.EscapeOutput ?>

	</div>

</div>
