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

<div class="directorist-search-form-action">

	<?php if ( $searchform->has_more_filters_button ) : ?>

		<div class="directorist-search-form-action__filter">
			<a href="#" class="directorist-btn directorist-btn-lg directorist-filter-btn">

				<?php 
				if ( $searchform->has_more_filters_icon() ) {
					directorist_icon( 'las la-filter' );
				} 
				?>

				<span class="directorist-btn-text">
					<?php echo esc_html( $searchform->more_filters_text ); ?>
				</span>
			</a>
		</div>

	<?php endif ?>

	<?php if ( $searchform->has_search_button ) : ?>

		<div class="directorist-search-form-action__submit">
			<button type="submit" class="directorist-btn directorist-btn-lg directorist-btn-dark directorist-btn-search">

				<?php 
				if ( $searchform->has_search_button_icon() ) {
					directorist_icon( 'las la-search' );
				} 
				?>

				<span class="directorist-btn-text">
					<?php echo esc_html( $searchform->search_button_text ); ?>
				</span>

			</button>
		</div>

	<?php endif; ?>

</div>
