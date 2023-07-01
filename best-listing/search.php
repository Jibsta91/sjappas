<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 * @package best-listing
 */

use \BestListing\wpWax\Helper as ThemeHelper;

get_header();

$best_listing_post_class = ThemeHelper::has_sidebar() ? 'col-md-6 col-12' : 'col-lg-4 col-md-6 col-12';
?>

<div id="primary" class="content-area site-search">

	<div class="theme-container">

		<div class="row">

			<?php ThemeHelper::left_sidebar(); ?>

			<div class="<?php ThemeHelper::the_layout_class(); ?>">

				<div class="main-content">

					<?php if ( have_posts() ) : ?>

						<div class="row">

							<?php 
							while ( have_posts() ) :
								the_post(); 
								?>

								<div class="<?php echo esc_attr( $best_listing_post_class ); ?>">

									<?php get_template_part( 'template-parts/content', 'blog' ); ?>

								</div>

							<?php endwhile; ?>

						</div>

					<?php else : ?>

						<?php get_template_part( 'template-parts/content', 'none' ); ?>

					<?php endif; ?>

				</div>

				<?php get_template_part( 'template-parts/pagination' ); ?>

			</div>

			<?php ThemeHelper::right_sidebar(); ?>

		</div>

	</div>

</div>

<?php
get_footer();
