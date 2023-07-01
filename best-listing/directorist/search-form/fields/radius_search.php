<?php
/**
 * @author  wpWax
 * @since   6.6
 * @version 7.3.1
 */

use BestListing\wpWax\ThemeSupport;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$default_distance = $data['default_radius_distance'];
$value            = ! empty( $_REQUEST['miles'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['miles'] ) ) : $default_distance; // @codingStandardsIgnoreLine
?>

<?php if ( ThemeSupport::has_field_in_search_form( 'radius_search', $searchform, 'advance' ) ) : ?>

	<div class="directorist-search-field">

		<?php if ( ! empty( $data['label'] ) ) : ?>
			<label><?php echo esc_html( $data['label'] ); ?></label>
		<?php endif; ?>

		<div class="directorist-range-slider-wrap">
			<div class="directorist-range-slider" data-default-radius="<?php echo esc_attr( $default_distance ); ?>" data-slider-unit="<?php echo esc_attr( $searchform->range_slider_unit( $data ) ); ?>"></div>
			<p class="directorist-range-slider-current-value"></p>
			<input type="hidden" class="directorist-range-slider-value" name="miles" value="<?php echo esc_attr( $value ); ?>" />
		</div>
		
	</div>

<?php else : ?>

	<div class="directorist-search-field theme-search-dropdown">

		<div class="theme-search-dropdown__label">

			<label><?php echo esc_html( ! empty( $data['label'] ) ) ? esc_html( $data['label'] ) : esc_html__( 'Radius Search', 'best-listing' ); ?></label>

		</div>

		<div class="theme-search-dropdown-toggle">

			<div class="directorist-range-slider-wrap">
				<div class="directorist-range-slider" data-default-radius="<?php echo esc_attr( $default_distance ); ?>" data-slider-unit="<?php echo esc_attr( $searchform->range_slider_unit( $data ) ); ?>"></div>
				<p class="directorist-range-slider-current-value"></p>
				<input type="hidden" class="directorist-range-slider-value" name="miles" value="<?php echo esc_attr( $value ); ?>" />
			</div>

		</div>

	</div>

<?php endif; ?>
