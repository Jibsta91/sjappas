<?php
// prevent direct access to the file
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

$checked = ! empty( $_GET['open_now'] ) && 'open_now' == $_GET['open_now'] ? 'checked' : ''; // @codingStandardsIgnoreLine
?>
<div class="directorist-search-field">
	<div class="form-group open_now">

		<?php if ( ! empty( $field_data['label'] ) && isset( $field_data['archive_sidebar'] ) ) : ?>

			<label><?php echo esc_html( $field_data['label'] ); ?></label>

		<?php endif; ?>

		<div class="check-btn">
			<div class="btn-checkbox">
				<label>

					<input type="checkbox" name="open_now" value="open_now" <?php echo esc_attr( $checked ); ?>>
					<span><i class="far fa-clock"></i><?php echo esc_html( $field_data['label'] ); ?> </span>

				</label>
			</div>
		</div>

	</div>
</div>
