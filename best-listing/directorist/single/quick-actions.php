<?php
/**
 * @author  wpWax
 * @since   6.7
 * @version 6.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$count         = count( $actions );
$more_than_two = array();

if ( $count > 2 ) {
	$more_than_two = array_splice( $actions, 2 );
}
?>

<div class="directorist-single-listing-action directorist-single-listing-action-quick directorist-flex directorist-align-center">

	<?php
	foreach ( $actions as $action ) {
		$listing->field_template( $action );
	}
	?>

	<?php if ( $more_than_two ) : ?>

		<div class="directorist-single-listing-action__extra">

			<div class="dropdown theme-dropdown">

				<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="la la-ellipsis-h"></i></a>

				<div class="dropdown-menu">

					<?php foreach ( $more_than_two as $action ) : ?>

						<?php $listing->field_template( $action ); ?>

					<?php endforeach; ?>

				</div>

			</div>

		</div>

	<?php endif; ?>

</div>

<?php foreach ( $args['actions'] as $key => $action ) : ?>

	<?php if ( isset( $action['widget_key'] ) && 'report' == $action['widget_key'] ) : ?>

		<div class="directorist-modal directorist-modal-js directorist-fade directorist-report-abuse-modal">

			<div class="directorist-modal__dialog">

				<div class="directorist-modal__content">

					<form id="directorist-report-abuse-form">

						<div class="directorist-modal__header">

							<h3 class="directorist-modal-title" id="directorist-report-abuse-modal__label"><?php esc_html_e( 'Report Abuse', 'best-listing' ); ?></h3>

							<a href="" class="directorist-modal-close directorist-modal-close-js"><span aria-hidden="true">&times;</span></a>

						</div>

						<div class="directorist-modal__body">

							<div class="directorist-form-group">

								<label for="directorist-report-message"><?php esc_html_e( 'Your Complain', 'best-listing' ); ?><span class="directorist-report-star">*</span></label>

								<textarea class="directorist-form-element" id="directorist-report-message" rows="3" placeholder="<?php esc_attr_e( 'Message...', 'best-listing' ); ?>" required></textarea>

							</div>

							<div id="directorist-report-abuse-g-recaptcha"></div>

							<div id="directorist-report-abuse-message-display"></div>

						</div>

						<div class="directorist-modal__footer">

							<button type="submit" class="directorist-btn directorist-btn-primary directorist-btn-sm"><?php esc_html_e( 'Submit', 'best-listing' ); ?></button>

						</div>

					</form>

				</div>

			</div>

		</div>

	<?php endif; ?>

<?php endforeach; ?>
