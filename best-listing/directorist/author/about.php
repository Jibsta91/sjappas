<?php
/**
 * @author  wpWax
 * @since   6.6
 * @version 6.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php do_action( 'directorist_before_author_about_section' ); ?>


<div class="directorist-card directorist-author-about">

	<div class="directorist-card__header">
		<h4 class="directorist-card__header--title"><?php esc_html_e( 'About this Author', 'best-listing' ); ?></h4>
	</div>

	<div class="directorist-card__body">
		<div class="directorist-author-about__content">
			<p><?php echo ! empty( $bio ) ? wp_kses_post( $bio ) : esc_html__( 'Nothing to show!', 'best-listing' ); ?></p>
		</div>
	</div>

</div>


<?php do_action( 'directorist_author_listing_after_about_section' ); ?>
