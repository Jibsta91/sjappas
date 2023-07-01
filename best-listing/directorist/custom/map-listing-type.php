<?php

use Directorist\Helper;

if ( ! Helper::multi_directory_enabled() ) {
	return;
}

global $bdmv_listings;
?>

<div class="directorist-type-nav directorist-type-nav--listings-map">

	<ul class="directorist-type-nav__list">

		<?php if ( $bdmv_listings->data['listings']->listing_types ) : ?>
			
			<?php foreach ( $bdmv_listings->data['listings']->listing_types as $id => $value ) : ?>

				<li class="<?php echo ( $bdmv_listings->data['listings']->current_listing_type == $value['term']->term_id ) ? esc_attr( 'current' ) : ''; ?> bdmv-directorist-type">
					<a class="directorist-type-nav__link" data-id="<?php echo esc_attr( $value['term']->term_id ); ?>"><span class="<?php echo esc_html( $value['data']['icon'] ); ?>"></span><?php echo esc_html( $value['name'] ); ?></a>
				</li>

			<?php endforeach; ?>

		<?php endif; ?>

	</ul>

</div>
