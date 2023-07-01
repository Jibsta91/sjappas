<?php
/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>

		<figure class="theme-post-thumbnail"><?php the_post_thumbnail( 'wpwaxtheme-size4' ); ?></figure>

	<?php endif; ?>

	<?php the_content(); ?>

	<?php
	$args = array(
		'before'      => '<div class="page-links">',
		'after'       => '</div>',
		'link_before' => '<span class="page-number">',
		'link_after'  => '</span>',
	);

	wp_link_pages( $args );
	?>

</div>
