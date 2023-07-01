<?php
/**
 * @author  wpWax
 * @since   6.6
 * @version 7.3.2
 */

use BestListing\wpWax\ThemeSupport;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="directorist-favourite-items-wrap">

	<div class="directorist-favorite-items">

		<?php if ( $dashboard->fav_listing_items() ) : ?>

			<div class="directorist-dashboard-items-list">
				<?php foreach ( $dashboard->fav_listing_items() as $item ) : ?>

					<div class="directorist-dashboard-items-list__single directorist_favourite_<?php echo esc_attr( $item['obj']->ID ); ?>">

						<div class="directorist-dashboard-items-list__single--info">

							<div class="directorist-listing-img">
								<a href="<?php echo esc_url( $item['permalink'] ); ?>">
									<img src="<?php echo esc_url( $item['img_src'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>">
								</a>
							</div>

							<div class="directorist-listing-content">

								<?php 
								$_address = get_post_meta( $item['obj']->ID, '_address', true );
								$_price   = get_post_meta( $item['obj']->ID, '_price', true );
								?>

								<h4 class="directorist-listing-title"><a href="<?php echo esc_url( $item['permalink'] ); ?>"><?php echo esc_html( $item['title'] ); ?></a></h4>
								
								<?php if ( $_address ) : ?>

									<p class="directorist-listing-address"><?php printf( '%s', esc_html( $_address ) ); ?></p>
								
								<?php endif; ?>

								<?php if ( $_price ) : ?>

									   <p class="directorist-listing-price"><?php printf( '<span>%s</span>%s', ThemeSupport::get_currency_symbol(), esc_html( $_price ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
								
								<?php endif; ?>

							</div>

						</div>

						<div class="directorist-dashboard-items-list__single--action">
							<a href="#" id="directorist-fav_<?php echo esc_attr( $item['obj']->ID ); ?>" class="directorist-btn directorist-btn-sm directorist-btn-danger directorist-favourite-remove-btn" data-listing_id="<?php echo esc_attr( $item['obj']->ID ); ?>">
								<i class="la la-trash"></i>
								<span class="directorist-favourite-remove-text"><?php esc_html_e( 'Remove', 'best-listing' ); ?></span>
							</a>
						</div>

					</div>

				<?php endforeach; ?>
			</div>

		<?php else : ?>

			<div class="directorist-notfound"><?php esc_html_e( 'Nothing found!', 'best-listing' ); ?></div>

		<?php endif; ?>
		
	</div>

</div>