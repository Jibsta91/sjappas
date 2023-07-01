<?php
/**
 * @author  wpWax
 * @since   6.6
 * @version 7.3.1.1
 */

 use \Directorist\Helper;
 use BestListing\wpWax\ThemeSupport;

$columns = floor( 12 / $taxonomy->columns );
?>
<div id="directorist" class="atbd_wrapper directorist-w-100">
	<?php
	/**
	 * @since 5.6.6
	 */
	do_action( 'atbdp_before_all_categories_loop', $taxonomy );
	?>
	<div class="<?php Helper::directorist_container_fluid(); ?>">

		<div class="atbd_all_categories atbdp-no-margin">
			<div class="<?php Helper::directorist_row(); ?>">
				<?php
				if ( $categories ) {
					foreach ( $categories as $category ) {
						$cat_class = ! $category['img'] ? ' atbd_category_no_image' : '';
						?>
						<div class="<?php Helper::directorist_column( $columns ); ?>">
							<a class="atbd_category_single<?php echo esc_attr( $cat_class ); ?>" href="<?php echo esc_url( $category['permalink'] ); ?>">

							<figure>

								<?php if ( $category['img'] ) { ?>
									<img src="<?php echo esc_url( $category['img'] ); ?>" title="<?php echo esc_attr( $category['name'] ); ?>" alt="<?php echo esc_attr( $category['name'] ); ?>">
									<?php
								}
								?>
							</figure>

									
								<div class="cat-box">

									<div class="cat-box__top">

										<?php if ( $category['has_icon'] ) : ?>
											<div class="icon">
												<?php directorist_icon( $category['icon_class'] ); ?>
											</div>
										<?php endif; ?>

										<div class="cat-info">

											<h4 class="cat-name"><?php echo esc_html( $category['name'] ); ?></h4>

										</div>

									</div>

									<div class="cat-box__bottom">

										<?php if ( $taxonomy->show_count ) { ?>

											<span class="cat-count">

												<?php echo wp_kses_post( ThemeSupport::remove_bracket( $category['grid_count_html'] ) ); ?>

												<span><?php echo ( ( $category['term']->count > 1 ) || ( $category['term']->count == 0 ) ) ? esc_html__( 'listings', 'best-listing' ) : esc_html__( 'listing', 'best-listing' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>

											</span>

										<?php } ?>

									</div>

								</div>

							</a>

						</div>

						<?php
					}
				} else {
					echo sprintf( '<p>%</p>', esc_html__( 'No Results found!', 'best-listing' ) );
				}
				?>
			</div>
		</div>
	</div>

	<?php
	/**
	 * @since 5.6.6
	 */
	do_action( 'atbdp_after_all_categories_loop' );
	?>
</div>