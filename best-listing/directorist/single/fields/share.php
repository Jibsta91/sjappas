<?php
/**
 * @author  wpWax
 * @since   6.7
 * @version 7.0.5.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="directorist-single-listing-header__right--btn">

	<div class="directorist-social-share directorist-tooltip" data-label="<?php esc_attr_e( 'Share', 'best-listing' ); ?>">

		<?php directorist_icon( $icon ); ?>

		<?php esc_html_e( 'Share', 'best-listing' ); ?>

		<ul class="directorist-social-share-links">

			<?php foreach ( $listing->social_share_data() as $social ) : ?>

				<li class="directorist-social-links__item">

					<a href="<?php echo ! empty( $social['link'] ) ? esc_url( $social['link'] ) : '#'; ?>">
						<?php directorist_icon( $social['icon'] ); ?>
						<?php echo esc_html( $social['title'] ); ?>
					</a>

				</li>

			<?php endforeach; ?>
			
		</ul>

	</div>

</div>
