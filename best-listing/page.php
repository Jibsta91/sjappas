<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package best-listing
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

use \BestListing\wpWax\Helper as ThemeHelper;

get_header();
?>

<?php if ( class_exists( 'Directorist_Base' ) && atbdp_is_page( 'dashboard' ) ) : ?>

	<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">

		<?php the_content(); ?>

	</div>

<?php else : ?>

	<div id="primary" class="content-area">

		<div class="theme-container">

			<div class="row">

				<?php ThemeHelper::left_sidebar(); ?>

				<div class="<?php ThemeHelper::the_layout_class(); ?>">

					<div class="main-content">

						<?php
						while ( have_posts() ) {
							the_post();

							get_template_part( 'template-parts/content', 'page' );

							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}
						}
						?>

					</div>

				</div>

				<?php ThemeHelper::right_sidebar(); ?>

			</div>

		</div>

	</div>

<?php endif; ?>

<?php
get_footer();
