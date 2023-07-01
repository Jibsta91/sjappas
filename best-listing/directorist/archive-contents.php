<?php
/**
 * @author  wpWax
 * @since   6.6
 * @version 7.2.1
 */

use BestListing\wpWax\ThemeSupport;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div 
<?php 
$listings->wrapper_class();
$listings->data_atts(); 
?>
>

	<?php if ( ThemeSupport::show_title( get_the_ID() ) ) : ?>

		<div class="row">

			<div class="col-12">

				<h2 class="directorist-listing-map-title directorist-archive-title" data-post-id="<?php echo get_the_ID(); ?>">
					<?php echo ThemeSupport::get_header_title( get_the_ID() ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</h2>

			</div>

		</div>

	<?php endif; ?>

	<?php
	$listings->directory_type_nav_template();
	$listings->header_bar_template();
	$listings->archive_view_template();
	?>

</div>
