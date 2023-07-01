<?php
/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

use BestListing\wpWax\Theme;
use \BestListing\wpWax\Helper;

$thumb_size  = 'wpwaxtheme-size1';
$author_id   = get_the_author_meta( 'ID' );
$author_name = get_the_author_meta( 'display_name' );
$author_slug = get_the_author_meta( 'user_login' );
$author_bio  = get_the_author_meta( 'description' );

$facebook  = get_user_meta( $author_id, 'atbdp_facebook', true );
$twitter   = get_user_meta( $author_id, 'atbdp_twitter', true );
$linked_in = get_user_meta( $author_id, 'atbdp_linkedin', true );
$youtube   = get_user_meta( $author_id, 'atbdp_youtube', true );
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'theme-post-single' ); ?>>

	<div class="theme-post-details">

		<?php if ( has_post_thumbnail() ) : ?>

			<figure class="theme-post-thumbnail"><?php the_post_thumbnail( $thumb_size ); ?></figure>

		<?php endif; ?>

		<div class="theme-post-content">

			<div class="theme-post-header">

				<?php the_title( '<h1 class="theme-post-title">', '</h1>' ); ?>

				<div class="theme-post-meta">

					<ul>

						<?php if ( Theme::$options['post_date'] ) : ?>

							<li><span class="updated published"><?php the_time( get_option( 'date_format' ) ); ?></span></li>

						<?php endif; ?>

						<?php if ( Theme::$options['post_cats'] && has_category() ) : ?>

							<li><?php the_category( ', ' ); ?></li>

						<?php endif; ?>

						<?php if ( Theme::$options['single_average_reading_time'] ) : ?>

							<li><?php echo Helper::get_reading_time( get_the_content(), 'span' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></li>

						<?php endif; ?>

					</ul>

				</div>

			</div>

			<div class="theme-post-body">
				<?php the_content(); ?>
			</div>

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

		<div class="theme-post-bottom">

			<?php if ( Theme::$options['post_tags'] && has_tag() ) : ?>

				<div class="theme-post-tags">

					<ul class="d-flex list-unstyled">

						<?php echo get_the_term_list( $post->ID, 'post_tag', '<li>', '</li><li>', '</li>' ); ?>

					</ul>

				</div>

			<?php endif; ?>

			<?php get_template_part( 'template-parts/social-share' ); ?>

		</div>

	</div>

	<?php
	get_template_part( 'template-parts/content-author' );
	get_template_part( 'template-parts/content-single-pagination' );
	get_template_part( 'template-parts/content-single-related' );
	?>

</div>
