<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * 
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 * @package best-listing
 */

use \BestListing\wpWax\Helper as ThemeHelper;

$best_listing_post_class = ThemeHelper::has_sidebar() ? 'col-md-6 col-12' : 'col-lg-4 col-md-6 col-12';

get_header(); 
?>

<div id="primary" class="content-area site-index">

	<div class="theme-blog-grid-area">

		<div class="theme-container">

			<div class="row">

				<?php ThemeHelper::left_sidebar(); ?>

				<div class="<?php ThemeHelper::the_layout_class(); ?>">

					<div id="main-content" class="main-content">

						<?php if ( have_posts() ) : ?>

							<div class="row " data-masonry='{"percentPosition": true }'>

								<?php 
								while ( have_posts() ) :
									the_post(); 
									?>

									<div class="<?php echo esc_html( $best_listing_post_class ); ?>">

										<?php get_template_part( 'template-parts/content-blog' ); ?>

									</div>

								<?php endwhile; ?>

							</div>

						<?php else : ?>

							<?php get_template_part( 'template-parts/content', 'none' ); ?>

						<?php endif; ?>

					</div>

					<div class="theme-pagination-area">

						<?php ThemeHelper::get_paginate_links(); ?>

					</div>

				</div>

				<?php ThemeHelper::right_sidebar(); ?>

			</div>

		</div>

	</div>

</div>

<?php
get_footer();
