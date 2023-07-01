<?php
/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

use BestListing\wpWax\Theme;
use \BestListing\wpWax\Helper as ThemeHelper;

get_header(); 

$bgimg = empty( Theme::$options['error_404img']['url'] ) ? ThemeHelper::get_img( '404.svg' ) : Theme::$options['error_404img']['url'];
?>

<div id="primary" class="content-area error-page-area">

	<div class="theme-container">

		<div class="row">

			<div class="col-lg-12">

				<div class="error-contents text-center">

					<figure><img src="<?php echo esc_url( $bgimg ); ?>" alt="<?php esc_attr_e( '404', 'best-listing' ); ?>"></figure>

					<?php if ( Theme::$options['error_title'] ) : ?>

						<h2><?php echo esc_html( Theme::$options['error_title'] ); ?></h2>

					<?php endif; ?>

					<div class="widget-wrapper">

						<div class="search-widget">

							<div class="row">

								<div class="col-md-6 offset-md-3">

									<?php get_search_form(); ?>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>
	
</div>

<?php
get_footer();
