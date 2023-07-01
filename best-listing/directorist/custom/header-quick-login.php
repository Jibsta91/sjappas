<?php
/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

use BestListing\wpWax\Helper as ThemeHelper;
use BestListing\wpWax\Theme;

if ( ! class_exists( 'Directorist_Base' ) ) {
	return;
}

if ( ! Theme::$options['header_account'] && atbdp_is_page( 'login' ) && atbdp_is_page( 'registration' ) ) {
	return;
}
?>

<div class="theme-menu-action-box__author">

	<div class="theme-menu-action-box__author--access-area">

		<?php if ( ! is_user_logged_in() ) : ?>

				<div class="theme-menu-action-box__login">

					<div class="theme-menu-action-box__login--modal">

						<a href="#" class="btn theme-btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#theme-login-modal">
							<span class="d-none d-lg-block"><?php esc_html_e( 'Sign In', 'best-listing' ); ?></span>
							<i class="la la-user d-block d-lg-none"></i>
						</a>

					</div>

				</div>

		<?php else : ?>

			<?php ThemeHelper::get_template_part( 'directorist/custom/header-avatar' ); ?>

		<?php endif; ?>

	</div>

</div>
