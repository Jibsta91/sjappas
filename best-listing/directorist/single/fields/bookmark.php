<?php
/**
 * @author  wpWax
 * @since   6.7
 * @version 7.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="directorist-action-save-wrap">

	<div class="directorist-single-listing-header__right--btn directorist-action-save directorist-tooltip" data-label="<?php esc_attr_e( 'Save', 'best-listing' ); ?>" id="atbdp-favourites">
		<?php echo wp_kses_post( the_atbdp_favourites_link() ); ?>
	</div> 
	
	<span class="directorist-single-listing-action-text">
		<?php esc_html_e( 'Save', 'best-listing' ); ?>
	</span>

</div>
