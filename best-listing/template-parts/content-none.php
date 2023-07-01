<?php
/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */
?>

<section class="no-results not-found theme-no-result">

	<h2 class="page-title"><?php esc_html_e( 'Nothing Found', 'best-listing' ); ?></h2>

	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<?php printf( '<p>%s <a href="%s">%s</a></p>', esc_html__( 'Ready to publish your first post?', 'best-listing' ), esc_url( admin_url( 'post-new.php' ) ), esc_html__( 'Get started here', 'best-listing' ) ); ?>
	
	<?php elseif ( is_search() ) : ?>

		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'best-listing' ); ?></p>

		<?php get_search_form(); ?>

	<?php else : ?>

		<p><?php esc_html_e( "It seems we can't find what you're looking for. Perhaps searching can help.", 'best-listing' ); ?></p>

		<?php get_search_form(); ?>

	<?php endif; ?>

</section>
