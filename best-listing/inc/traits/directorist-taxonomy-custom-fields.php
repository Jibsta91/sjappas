<?php
/**
 * Category custom options
 * 
 * @package best-listing
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

namespace BestListing\wpWax;

trait Directorist_Taxonomy_Custom_Fields {

	// Category custom field.
	public function directorist_taxonomy_custom_fields_init() {
		/*show the select box form field to select an icon*/
		add_action( ATBDP_CATEGORY . '_add_form_fields', array( $this, 'add_category_color_field' ) );
		/*Updating A Term With Meta Data*/
		add_action( ATBDP_CATEGORY . '_edit_form_fields', array( $this, 'edit_category_color_field' ) );

		/*create the meta data*/
		add_action( 'created_' . ATBDP_CATEGORY, array( $this, 'save_termmeta' ), 10, 2 );
		// update or save the meta data of the term.
		add_action( 'edited_' . ATBDP_CATEGORY, array( $this, 'save_termmeta' ), 10, 2 );

		// Assets
		add_action( 'admin_enqueue_scripts', array( $this, 'category_colorpicker_enqueue' ) );
		add_action( 'admin_print_scripts', array( $this, 'colorpicker_init_inline' ), 20 );
	}

	// Add field.
	public function add_category_color_field( $taxonomy ) {?>

		<div class="form-field term-colorpicker-wrap">
			<label for="term-colorpicker"><?php esc_html_e( 'Category Color', 'best-listing' ); ?></label>
			<input name="best_listing_category_color" value="#ffffff" class="colorpicker" id="term-colorpicker" />
		</div>

		<?php 
	}

	// Edit field.
	public function edit_category_color_field( $term ) {
		$color = get_term_meta( $term->term_id, 'best_listing_category_color', true );
		$color = ( ! empty( $color ) ) ? "#{$color}" : '#000000';
		?>

		<tr class="form-field term-colorpicker-wrap">
			<th scope="row"><label for="term-colorpicker"><?php esc_html_e( 'Category Color', 'best-listing' ); ?></label></th>
			<td>
				<input name="best_listing_category_color" value="<?php echo esc_html( $color ); ?>" class="colorpicker" id="term-colorpicker" />
			</td>
		</tr>

		<?php 
	}

	// Save meta.
	public function save_termmeta( $term_id ) {
		
		if ( isset( $_POST['best_listing_category_color'] ) && ! empty( $_POST['best_listing_category_color'] ) ) { // @codingStandardsIgnoreLine
			update_term_meta( $term_id, 'best_listing_category_color', sanitize_hex_color_no_hash( wp_unslash( $_POST['best_listing_category_color'] ) ) ); // @codingStandardsIgnoreLine
		} else {
			delete_term_meta( $term_id, 'best_listing_category_color' ); // phpcs:ignore WordPress.Security.EscapeOutput
		}
	}

	// Scripts.
	public function category_colorpicker_enqueue( $taxonomy ) {

		if ( null !== ( $screen = get_current_screen() ) && 'edit-at_biz_dir-category' !== $screen->id ) {
			return;
		}

		// Colorpicker Scripts.
		wp_enqueue_script( 'wp-color-picker' );

		// Colorpicker Styles.
		wp_enqueue_style( 'wp-color-picker' );
	}

	// Custom js.
	public function colorpicker_init_inline() {

		if ( null !== ( $screen = get_current_screen() ) && 'edit-at_biz_dir-category' !== $screen->id ) {
			return;
		}
		?>

		<script>
			jQuery(document).ready( function($) {
				$( '.colorpicker' ).wpColorPicker();
			});
		</script>

		<?php 
	}
}
