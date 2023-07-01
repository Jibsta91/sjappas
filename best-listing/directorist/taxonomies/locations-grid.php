<?php
/**
 * @author  wpWax
 * @since   6.6
 * @version 7.3.1
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
	do_action( 'atbdp_before_all_locations_loop', $taxonomy );
	?>

	<div class="<?php Helper::directorist_container_fluid(); ?>">

		<div class="atbd_location_grid_wrap atbdp-no-margin">

			<div class="<?php Helper::directorist_row(); ?>">

				<?php 
				if ( $locations ) : 

					foreach ( $locations as $key => $location ) :
						$loc_class = $location['img'] ? '' : ' atbd_location_grid-default';
						$col_key   = apply_filters(
							'best_listing_directorist_column_key',
							array(
								'key'     => $key,
								'columns' => $columns,
							) 
						);
						?>

						<div class="<?php Helper::directorist_column( $col_key['columns'] ); ?>">

							<a class="atbd_location_grid<?php echo esc_attr( $loc_class ); ?>" href="<?php echo esc_url( $location['permalink'] ); ?>">
								
								<figure>

									<?php if ( $location['img'] ) : ?>

										<img src="<?php echo esc_url( $location['img'] ); ?>" title="<?php echo esc_attr( $location['name'] ); ?>" alt="<?php echo esc_attr( $location['name'] ); ?>">
									
									<?php endif; ?>

									<figcaption>
										
										<div class="directorist-location-content">

											<?php if ( ThemeSupport::has_parent_name( $location ) ) : ?>

												<p class="directorist-location-parent"><?php echo esc_html( ThemeSupport::has_parent_name( $location ) ); ?></p>

											<?php endif; ?>

											<h3 class="directorist-location"><?php echo esc_html( $location['name'] ); ?><?php directorist_icon( 'las la-arrow-right' ); ?></h3>

											<p class="directorist-listing-count">

												<?php $num_items = ThemeSupport::remove_bracket( $location['grid_count_html'], true ); ?>

												<?php printf( esc_html( _nx( '%s listing', '%s listings', intval( $num_items ), '', 'best-listing' ) ), wp_kses_post( $num_items ) ); ?>

											</p>

										</div>
									
									</figcaption>

								</figure>

							</a>

						</div>

						<?php 
					endforeach;
						
				else :
					?>
					<p><?php esc_html_e( 'No Results found!', 'best-listing' ); ?></p>
					<?php 
				endif; 
				?>

			</div>

		</div>

	</div>

</div>
