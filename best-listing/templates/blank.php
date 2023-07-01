<?php
/**
 * A Full Width blank template file
 *
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 * @package best-listing
 *
 * Template Name: Full Width
 */

get_header();
?>

<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">

	<?php the_content(); ?>

</div>

<?php
get_footer();
