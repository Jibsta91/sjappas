<?php
/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

use BestListing\wpWax\Helper as ThemeHelper;
use BestListing\wpWax\Theme;

$best_listing_menu_align     = class_exists( 'Directorist_Base' ) && ( Theme::$options['add_listing_button'] || Theme::$options['header_account'] ) ? '' : 'menu-right';
$best_listing_container_type = ( Theme::$options['container_type'] ) ? Theme::$options['container_type'] : 'theme-container';

$best_listing_has_site_logo = has_custom_logo();
$best_listing_site_title    = get_bloginfo( 'name' );
$best_listing_site_tagline  = get_bloginfo( 'description', 'display' );
?>

<div class="theme-header-menu-area">

	<div class="<?php echo esc_html( $best_listing_container_type ); ?>">

		<div class="theme-header-menu-full">

			<?php if ( $best_listing_has_site_logo || $best_listing_site_title || $best_listing_site_tagline ) : ?>

				<div class="theme-header-logo-wrap">

					<div class="theme-header-logo-inner site-branding">

						<div class="navbar-brand theme-header-logo-brand order-sm-1 order-1">

							<?php
							if ( $best_listing_has_site_logo ) {
								printf( '<a href="%s">%s</a>', esc_url( home_url( '/' ) ), get_custom_logo() ); // phpcs:ignore WordPress.Security.EscapeOutput
							} else {
								if ( display_header_text() && $best_listing_site_title ) {

									printf( '<h1><a href="%s" class="site-title">%s</a></h1>', esc_url( home_url( '/' ) ), esc_html( $best_listing_site_title ) );

									if ( $best_listing_site_tagline ) {
										printf( '<p>%s</p>', esc_html( $best_listing_site_tagline ) );
									}
								}
							}
							?>

						</div>

					</div>

				</div>

			<?php endif; ?>

			<div class="theme-menu-container">

				<?php if ( has_nav_menu( 'primary' ) ) : ?>

					<div class="theme-main-navigation <?php echo esc_attr( $best_listing_menu_align ); ?>">
						<button class="theme-mobile-menu-trigger d-none"><span></span><span></span><span></span></button>
						<div class="theme-main-navigation-inner">

							<a href="#" class="theme-mobile-menu-close"><i class="las la-times"></i></a>

							<?php
							wp_nav_menu(
								array(
									'theme_location'  => 'primary',
									'container'       => 'nav',
									'fallback_cb'     => false,
									'container_class' => 'menu-main-menu-container',
									'items_wrap'      => '<ul id="%1$s" class="%2$s theme-main-menu">%3$s</ul>',
								)
							);
							?>

						</div>

					</div>

				<?php endif; ?>

				</div>

			<?php if ( class_exists( 'Directorist_Base' ) ) : ?>

				<div class="theme-menu-action-box">

					<?php ThemeHelper::get_template_part( 'directorist/custom/popup-search' ); ?>
					<?php ThemeHelper::get_template_part( 'directorist/custom/header-quick-login' ); ?>

					<?php if ( Theme::$options['add_listing_button'] && isset( Theme::$options['add_listing_button_text'] ) && class_exists( 'ATBDP_Permalink' ) ) : ?>
					
					<div class="theme-menu-action-box__add-listing">

						<a href="<?php echo esc_url( \ATBDP_Permalink::get_add_listing_page_link() ); ?>" class="btn theme-btn btn-sm btn-primary btn-add-listing">
							<?php directorist_icon( 'la la-plus' ); ?>
							<span class="d-none d-lg-block">
								<?php echo esc_html( Theme::$options['add_listing_button_text'] ); ?>
							</span>
						</a>

					</div>

				<?php endif; ?>

				</div>

			<?php endif; ?>

		</div>

	</div>

</div>
