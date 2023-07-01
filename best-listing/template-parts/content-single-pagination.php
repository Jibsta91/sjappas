<?php
/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

use BestListing\wpWax\Theme;

if ( empty( Theme::$options['post_pagination'] ) ) {
	return;
}

$previous    = get_previous_post();
$next        = get_next_post();
$date_format = apply_filters( 'best_listing_post_pagination_date_format', 'F j, Y' );
?>

<div class="theme-post-pagination">

	<?php if ( $previous ) : ?>

		<?php $post_obj = $previous; ?>

		<div class="theme-post-pagination__each theme-post-pagination__prev">

			<span class="theme-post-pagination__label">

				<?php esc_html_e( 'Previous Post:', 'best-listing' ); ?>

			</span>

			<a class="theme-post-pagination__title" href="<?php echo esc_url( get_permalink( $post_obj ) ); ?>">
				<?php echo esc_html( get_the_title( $post_obj ) ); ?>
			</a>

			<p class="theme-post-pagination__meta">
				<span class="theme-post-pagination-time"><?php echo esc_html( get_post_time( $date_format, false, $post_obj ) ); ?></span>
				<span class="theme-post-pagination-sep"><?php esc_html_e( '- In', 'best-listing' ); ?></span>
				<span class="theme-post-pagination-cats"><?php echo get_the_category_list( ', ', '', $post_obj->ID ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
			</p>

		</div>

	<?php endif; ?>

	<?php if ( $next ) : ?>

		<?php $post_obj = $next; ?>

		<div class="theme-post-pagination__each theme-post-pagination__next">

			<span class="theme-post-pagination__label">

				<?php esc_html_e( 'Next Post:', 'best-listing' ); ?>

			</span>

			<a class="theme-post-pagination__title" href="<?php echo esc_url( get_permalink( $post_obj ) ); ?>">
				<?php echo esc_html( get_the_title( $post_obj ) ); ?>
			</a>

			<p class="theme-post-pagination__meta">
				<span class="theme-post-pagination-time">
					<?php echo esc_html( get_post_time( $date_format, false, $post_obj ) ); ?>
				</span>

				<span class="theme-post-pagination-sep">
					<?php esc_html_e( '- In', 'best-listing' ); ?>
				</span>

				<span class="theme-post-pagination-cats">
					<?php echo get_the_category_list( ', ', '', $post_obj->ID ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</span>
			</p>

		</div>

	<?php endif; ?>

</div>
