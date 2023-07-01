<?php
/**
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

namespace BestListing\wpWax;

class Helper {

	use URI_Trait;
	use Sidebar_Trait;

	public static function has_breadcrumb_support() {
		return true;
	}

	public static function the_breadcrumb() {

		if ( function_exists( 'bcn_display' ) ) {
			bcn_display(); // Added support Breadcrumb NavXT plugin
		} else {
			$args       = array(
				'show_browse'   => false,
				'post_taxonomy' => array(
					'at_biz_dir' => 'at_biz_dir-category',
					'product'    => 'product_cat',
				),
			);
			$breadcrumb = new \BestListing\WpWax\Lib\Breadcrumb\Breadcrumb( $args );

			return $breadcrumb->trail();
		}
	}

	public static function get_nav_menu_args() {

		$nav_menu_args = array(
			'theme_location'  => 'primary',
			'container'       => 'nav',
			'fallback_cb'     => false,
			'container_class' => 'menu-main-menu-container',
			'items_wrap'      => '<ul id="%1$s" class="%2$s theme-main-menu">%3$s</ul>',
		);

		return $nav_menu_args;
	}

	public static function get_page_title() {

		if ( is_search() ) {
			$title = esc_html__( 'Search Results for : ', 'best-listing' ) . get_search_query();
		} elseif ( is_404() ) {
			$title = esc_html__( 'Page not Found', 'best-listing' );
		} elseif ( is_home() ) {

			if ( get_option( 'page_for_posts' ) ) {
				$title = get_the_title( get_option( 'page_for_posts' ) );
			} else {
				$title = apply_filters( 'best_listing_blog_title', esc_html__( 'Blog', 'best-listing' ) );
			}       
		} elseif ( is_archive() ) {
			$title = get_the_archive_title();
		} else {
			$title = get_the_title();
		}

		return apply_filters( 'best_listing_page_title', $title );
	}

	public static function get_primary_color() {
		$primary_color = Theme::$options['primary_color'];

		return apply_filters( 'best_listing_primary_color', $primary_color );
	}

	public static function comments_callback( $comment, $args, $depth ) {
		self::get_template_part( 'template-parts/comments-callback', compact( 'comment', 'args', 'depth' ) );
	}

	public static function hex2rgb( $hex ) {
		$hex = str_replace( '#', '', $hex );

		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}

		$rgb = "$r, $g, $b";

		return $rgb;
	}

	public static function user_textfield( $label, $field, $value ) {
		?>

		<tr>

			<th>
				<label><?php echo esc_html( $label ); ?></label>
			</th>

			<td>
				<input class="regular-text" type="text" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $field ); ?>">
			</td>

		</tr>

		<?php
	}

	public static function uniqueid() {
		$time = microtime();
		$time = str_replace( array( ' ', '.' ), '-', $time );
		$id   = 'u-' . $time;

		return $id;
	}

	public static function get_reading_time( $content, $tag ) {
		$stripped_content = strip_tags( $content );
		$total_word       = str_word_count( $stripped_content );
		$reading_minute   = floor( $total_word / 200 );
		$reading_seconds  = floor( $total_word % 200 / ( 200 / 60 ) );

		if ( ! $reading_minute ) {
			$reading_time = $reading_seconds;
			$unit_name    = __( 'secs', 'best-listing' );
		} else {
			$reading_time = $reading_minute;
			$unit_name    = __( 'mins', 'best-listing' );
		}

		$reading_time_html = sprintf( '<%s>%s %s %s </%s>', $tag, $reading_time, $unit_name, __( 'read', 'best-listing' ), $tag );

		return $reading_time_html;
	}

	public static function get_paginate_links() {
		$args = array(
			'prev_text' => '<span class="themeicon themeicon-angle-left-solid"></span>',
			'next_text' => '<span class="themeicon themeicon-angle-right-solid"></span>',
		);

		echo paginate_links( $args ); // phpcs:ignore WordPress.Security.EscapeOutput
	}

	public static function get_svg_icon( $filename ) {
		$dir      = 'assets/icons';
		$filename = $filename . '.svg';
		$file     = self::get_file_path( $filename, $dir );
		$svg      = file_get_contents( $file );
		$svg      = trim( $svg );

		return $svg;
	}

	// Author avatar
	public static function avatar_image( $size = 40 ) {

		if ( ! class_exists( 'Directorist_Base' ) ) {
			return;
		}

		$gravatar      = get_avatar( get_current_user_id(), $size, null, null, array( 'class' => 'rounded-circle' ) );
		$author_id     = get_user_meta( get_current_user_id(), 'pro_pic', true );
		$profile_image = wp_get_attachment_image_src( $author_id );

		if ( empty( $profile_image ) ) {

			echo wp_kses_post( $gravatar );

			if ( atbdp_is_page( 'dashboard' ) ) {
				printf( '<span> %s,<span/> %s ', esc_html__( 'Hi', 'best-listing' ), esc_html( get_the_author_meta( 'display_name', get_current_user_id() ) ) );
			}       
		} else {

			echo sprintf( '<img width="%s" src="%s" alt="%s" class="img-fluid"/>', esc_attr( $size ), esc_url( $profile_image[0] ), esc_html( get_the_author_meta( 'display_name', get_current_user_id() ) ) );

			if ( atbdp_is_page( 'dashboard' ) ) {
				printf( '<span> %s,<span/> %s ', esc_html__( 'Hi', 'best-listing' ), esc_html( get_the_author_meta( 'display_name', get_current_user_id() ) ) );
			}
		}
	}
}
