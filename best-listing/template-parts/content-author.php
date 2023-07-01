<?php
/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

use BestListing\wpWax\Helper as ThemeHelper;
use BestListing\wpWax\Theme;

$author_bio = get_the_author_meta( 'description' );

if ( empty( Theme::$options['post_about_author'] ) || empty( $author_bio ) ) {
	return;
}

$author_id   = get_the_author_meta( 'ID' );
$author_name = get_the_author_meta( 'display_name' );
$author_slug = get_the_author_meta( 'user_login' );

$facebook  = get_user_meta( $author_id, 'atbdp_facebook', true );
$twitter   = get_user_meta( $author_id, 'atbdp_twitter', true );
$linked_in = get_user_meta( $author_id, 'atbdp_linkedin', true );
$youtube   = get_user_meta( $author_id, 'atbdp_youtube', true );
?>

<div class="theme-post-author cardify">

	<div class="theme-post-author__thumb">

		<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
			<?php echo get_avatar( $author_id, 100 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</a>

	</div>

	<div class="theme-post-author__info">

		<h5 class="theme-post-author__name">
			<?php printf( '<a href="%s">%s</a>', esc_url( home_url( "/author/{$author_slug}/" ) ), esc_html( $author_name ) ); ?>
		</h5>

		<p class="theme-post-author__bio">
			<?php echo wp_kses_post( $author_bio ); ?>
		</p>

		<?php if ( ! empty( $facebook || $twitter || $linked_in || $youtube ) ) : ?>

			<ul class="list-unstyled theme-post-author__social">
				<?php
				if ( $facebook ) {
					printf( '<li><a target="_blank" href="%s">%s</a></li>', esc_url( $facebook ), ThemeHelper::get_svg_icon( 'facebook' ) ); // phpcs:ignore WordPress.Security.EscapeOutput
				}
				if ( $twitter ) {
					printf( '<li><a target="_blank" href="%s">%s</a></li>', esc_url( $twitter ), ThemeHelper::get_svg_icon( 'twitter' ) ); // phpcs:ignore WordPress.Security.EscapeOutput
				}
				if ( $linked_in ) {
					printf( '<li><a target="_blank" href="%s">%s</a></li>', esc_url( $linked_in ), ThemeHelper::get_svg_icon( 'linkedin' ) ); // phpcs:ignore WordPress.Security.EscapeOutput
				}
				if ( $youtube ) {
					printf( '<li><a target="_blank" href="%s">%s</a></li>', esc_url( $youtube ), ThemeHelper::get_svg_icon( 'youtube' ) ); // phpcs:ignore WordPress.Security.EscapeOutput
				}
				?>
			</ul>

		<?php endif; ?>

	</div>

</div>
