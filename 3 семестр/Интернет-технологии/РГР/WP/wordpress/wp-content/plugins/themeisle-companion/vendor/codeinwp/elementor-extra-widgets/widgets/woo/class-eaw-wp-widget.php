<?php
/**
 * Created by Coti.
 */

/**
 * Class EAW_WP_Widget
 */
class EAW_WP_Widget extends WP_Widget {

	/**
	 * Call a shortcode function by tag name.
	 *
	 * @since  1.0.3
	 *
	 * @param string $tag     The shortcode whose function to call.
	 * @param array  $atts    The attributes to pass to the shortcode function. Optional.
	 * @param array  $content The shortcode's content. Default is null (none).
	 *
	 * @return string|bool False on failure, the result of the shortcode on success.
	 */
	function do_shortcode( $tag, array $atts = array(), $content = null ) {
		global $shortcode_tags;
		if ( ! isset( $shortcode_tags[ $tag ] ) ) {
			return false;
		}
		return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
	}
}