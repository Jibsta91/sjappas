<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * 
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 * @package best-listing
 */

use \BestListing\wpWax\Helper as ThemeHelper;
?>

<div class="<?php ThemeHelper::the_sidebar_class(); ?>">

	<aside class="sidebar-widget-area">

		<?php
		do_action( 'best_listing_before_sidebar' );

		dynamic_sidebar( 'sidebar' );

		do_action( 'best_listing_after_sidebar' );
		?>

	</aside>

</div>
