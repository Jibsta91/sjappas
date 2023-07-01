<?php
/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

use BestListing\wpWax\Helper as ThemeHelper;
use BestListing\wpWax\Theme;

if ( ! class_exists( 'BestListing_Toolkit' ) ) {
	return;
}

if ( empty( Theme::$options['post_share'] ) ) {
	return;
}

$selected           = Theme::$options['post_share'];
$url                = urlencode( get_permalink() );
$best_listing_title = urlencode( get_the_title() );
$sharers            = array();

$all = array(
	'facebook'  => array(
		'url'   => "//www.facebook.com/sharer.php?u=$url",
		'icon'  => ThemeHelper::get_svg_icon( 'facebook' ),
		'label' => __( 'Share', 'best-listing' ),
		'class' => __( 'facebook', 'best-listing' ),
	),
	'twitter'   => array(
		'url'   => "//twitter.com/intent/tweet?source=$url&text=$title:$url",
		'icon'  => ThemeHelper::get_svg_icon( 'twitter' ),
		'label' => __( 'Tweet', 'best-listing' ),
		'class' => __( 'twitter', 'best-listing' ),
	),
	'linkedin'  => array(
		'url'   => "//www.linkedin.com/shareArticle?mini=true&url=$url&title=$title",
		'icon'  => ThemeHelper::get_svg_icon( 'linkedin' ),
		'label' => __( 'Share', 'best-listing' ),
		'class' => __( 'linkedin', 'best-listing' ),
	),
	'pinterest' => array(
		'url'   => "//pinterest.com/pin/create/button/?url=$url&description=$title",
		'icon'  => ThemeHelper::get_svg_icon( 'pinterest' ),
		'label' => __( 'Share', 'best-listing' ),
		'class' => __( 'pinterest', 'best-listing' ),
	),
	'tumblr'    => array(
		'url'   => "//www.tumblr.com/share?v=3&u=$url&quote=$title",
		'icon'  => ThemeHelper::get_svg_icon( 'tumblr' ),
		'label' => __( 'Share', 'best-listing' ),
		'class' => __( 'tumblr', 'best-listing' ),
	),
	'reddit'    => array(
		'url'   => "//www.reddit.com/submit?url=$url&title=$title",
		'icon'  => ThemeHelper::get_svg_icon( 'reddit' ),
		'label' => __( 'Share', 'best-listing' ),
		'class' => __( 'reddit', 'best-listing' ),
	),
	'vk'        => array(
		'url'   => "//vkontakte.ru/share.php?url=$url",
		'icon'  => ThemeHelper::get_svg_icon( 'vk' ),
		'label' => __( 'Share', 'best-listing' ),
		'class' => __( 'vk', 'best-listing' ),
	),
	'copy_url'  => array(
		'url'   => "$url",
		'icon'  => ThemeHelper::get_svg_icon( 'link-solid' ),
		'label' => __( 'Copy', 'best-listing' ),
		'class' => __( 'copy', 'best-listing' ),
	),
);

foreach ( $selected as $value ) {
	$sharers[ $value ] = $all[ $value ];
}

$sharers = apply_filters( 'best_listing_social_sharing_icons', $sharers );
?>

<div class="theme-post-social">

	<span class="theme-post-social__title"><?php esc_html_e( 'Share this article:', 'best-listing' ); ?></span>

	<ul class="theme-post-social__list list-unstyled">

		<?php foreach ( $sharers as $key => $sharer ) : ?>

			<?php if ( 'copy_url' === $key ) : ?>

				<li>
					<input type="hidden" value="<?php the_permalink(); ?>" id="copyUrl">

					<div class="toolip_wrapper">
						<a href="#" class="theme-post-social-<?php echo esc_html( $sharer['class'] ); ?>" id="copyBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to clipboard">
							<?php echo $sharer['icon']; // phpcs:ignore WordPress.Security.EscapeOutput ?>
							<?php echo esc_html( $sharer['label'] ); ?>
						</a>
					</div>
				</li>

			<?php else : ?>

				<li>
					<a href="<?php echo esc_url( $sharer['url'] ); ?>" class="theme-post-social-<?php echo esc_html( $sharer['class'] ); ?>" target="_blank">
						<?php echo $sharer['icon']; // phpcs:ignore WordPress.Security.EscapeOutput ?>
						<span><?php echo esc_html( $sharer['label'] ); ?></span>
					</a>
				</li>

			<?php endif; ?>

		<?php endforeach; ?>

	</ul>

</div>
