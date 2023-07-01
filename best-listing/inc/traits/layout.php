<?php
/**
 * Theme layout
 * 
 * @package best-listing
 * @author  wpWax
 * @since   1.0
 * @version 1.0
 */

namespace BestListing\wpWax;

trait Layout_Trait {

	// Banner BG image.
	private function bgimg_option( $key, $is_single = true ) {
		$layout_key = $this->post_type . '_' . $key;
		$key_prefix = "{$this->prefix}_layout_settings_{$this->post_type}_";

		$meta      = ! empty( $this->meta_value[ $key_prefix . $key ] ) ? $this->meta_value[ $key_prefix . $key ] : 'default';
		$op_layout = Theme::$options[ $layout_key ];
		$op_global = Theme::$options[ $key ];

		if ( ! empty( $meta['url'] ) ) {
			$img = $meta['url'];
		} elseif ( ! empty( $op_layout['url'] ) ) {
			$img = $op_layout['url'];
		} elseif ( ! empty( $op_global['url'] ) ) {
			$img = $op_global['url'];
		} else {
			$img = Helper::get_img( 'banner.jpg' );
		}

		return $img;
	}

	// Layout.
	private function layout_option( $key ) {
		$layout_key = $this->post_type . '_' . $key;
		$op_layout  = Theme::$options[ $layout_key ];

		return $op_layout;
	}

	// Layout options.
	private function meta_layout_option( $key ) {
		$layout_key = $this->post_type . '_' . $key;
		$key_prefix = "{$this->prefix}_layout_settings_{$this->post_type}_";

		$meta      = ! empty( $this->meta_value[ $key_prefix . $key ] ) ? $this->meta_value[ $key_prefix . $key ] : 'default';
		$op_layout = Theme::$options[ $layout_key ];

		if ( 'default' !== $meta ) {
			$result = $meta;
		} else {
			$result = $op_layout;
		}

		return $result;
	}

	// Layout options in global.
	private function layout_global_option( $key, $is_bool = false ) {
		$layout_key = $this->post_type . '_' . $key;

		$op_layout = Theme::$options[ $layout_key ] ? Theme::$options[ $layout_key ] : 'default';
		$op_global = Theme::$options[ $key ];

		if ( 'default' !== $op_layout ) {
			$result = $op_layout;
		} else {
			$result = $op_global;
		}

		if ( $is_bool ) {
			$result = ( 1 === (int) $result || 'on' === $result ) ? true : false;
		}

		return $result;
	}

	// Post meta.
	private function meta_layout_global_option( $key, $is_bool = false ) {
		$layout_key = $this->post_type . '_' . $key;
		$key_prefix = "{$this->prefix}_layout_settings_{$this->post_type}_";

		$meta      = ! empty( $this->meta_value[ $key_prefix . $key ] ) ? $this->meta_value[ $key_prefix . $key ] : 'default';
		$op_layout = Theme::$options[ $layout_key ] ? Theme::$options[ $layout_key ] : 'default';
		$op_global = Theme::$options[ $key ];

		if ( 'default' !== $meta ) {
			$result = $meta;
		} elseif ( 'default' !== $op_layout ) {
			$result = $op_layout;
		} else {
			$result = $op_global;
		}

		if ( $is_bool ) {
			$result = ( 1 === (int) $result || 'on' === $result ) ? true : false;
		}

		return $result;
	}
}
