<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package best-listing
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

use \BestListing\wpWax\Helper as ThemeHelper;

get_header();
?>

<div id="primary" class="content-area theme-single-blog">

	<div class="theme-container">

		<div class="row">

			<?php ThemeHelper::left_sidebar(); ?>

			<div class="<?php ThemeHelper::the_layout_class(); ?>">

				<div class="main-content">

					<?php 
					while ( have_posts() ) :
						the_post(); 
						?>

						<?php
						get_template_part( 'template-parts/content-single' );

						if ( comments_open() || get_comments_number() ) : 
							?>

							<div class="comments-wrapper">

								<?php comments_template(); ?>

							</div>

							<?php 
						endif;

					endwhile; 
					?>

				</div>

			</div>

			<?php ThemeHelper::right_sidebar(); ?>

		</div>

	</div>

</div>

<?php
get_footer();
