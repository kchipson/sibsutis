<?php
/**
 *
 */

namespace ThemeIsle\ContentForms\Includes\Widgets_Public;

use ThemeIsle\ContentForms\Includes\Admin\Widget_Actions_Base;

require_once TI_CONTENT_FORMS_PATH . '/includes/widgets-public/widget_actions_base.php';

class Registration_Public extends Widget_Actions_Base {

	/**
	 * Get current form type.
	 *
	 * @return string
	 */
	function get_form_type() {
		return 'registration';
	}

	/**
	 * This method is passed to the rest controller and it is responsible for submitting the data.
	 *
	 * @param array $return Return format.
	 * @param array $data Form data.
	 * @param string $widget_id Widget id.
	 * @param int $post_id Post id.
	 * @param string $builder Page builder.
	 *
	 * @return array
	 */
	public function rest_submit_form( $return, $data, $widget_id, $post_id, $builder ) {
		if ( empty( $data['USER_EMAIL'] ) || ! is_email( $data['USER_EMAIL'] ) ) {
			$return['message'] = esc_html__( 'Invalid email.', 'themeisle-companion' );

			return $return;
		}

		$widget_settings = $this->get_widget_settings( $widget_id, $post_id, $builder );

		$settings['user_email']             = sanitize_email( $data['USER_EMAIL'] );
		$settings['user_login']             = ! empty( $data['USER_LOGIN'] ) ? $data['USER_LOGIN'] : $data['email'];
		$settings['user_pass']              = ! empty( $data['USER_PASS'] ) ? $data['USER_PASS'] : wp_generate_password(
			$length                         = 12,
			$include_standard_special_chars = false
		);
		$settings['display_name'] = ! empty( $data['DISPLAY_NAME'] ) ? $data['DISPLAY_NAME'] : '';
		$settings['first_name']   = ! empty( $data['FIRST_NAME'] ) ? $data['FIRST_NAME'] : '';
		$settings['last_name']    = ! empty( $data['LAST_NAME'] ) ? $data['LAST_NAME'] : '';
		$settings['role']         = array_key_exists( 'user_role', $widget_settings ) ? $widget_settings['user_role'] : 'subscriber';

		$return = $this->_register_user( $return, $settings );

		return $return;
	}

	/**
	 * Add a new user for the given details
	 *
	 * @param array $return Return array.
	 * @param array $settings Settings array.
	 *
	 * @return array mixed
	 */
	private function _register_user( $return, $settings ) {

		if ( ! get_option( 'users_can_register' ) ) {
			$return['message'] = esc_html__( 'This website does not allow registrations at this moment!', 'themeisle-companion' );

			return $return;
		}

		if ( ! validate_username( $settings['user_login'] ) ) {
			$return['message'] = esc_html__( 'Invalid user name', 'themeisle-companion' );

			return $return;
		}

		if ( username_exists( $settings['user_login'] ) ) {
			$return['message'] = esc_html__( 'Username already exists', 'themeisle-companion' );

			return $return;
		}

		if ( email_exists( $settings['user_email'] ) ) {
			$return['message'] = esc_html__( 'This email is already registered', 'themeisle-companion' );
			return $return;
		}

		$user_id = wp_insert_user( $settings );

		if ( ! is_wp_error( $user_id ) ) {

			if ( ! empty( $extra_data ) ) {
				foreach ( $extra_data as $key => $value ) {
					update_user_meta( $user_id, sanitize_title( $key ), sanitize_text_field( $value ) );
				}
			}

			$return['success'] = true;
			$return['message'] = esc_html__( 'Welcome, ', 'themeisle-companion' ) . $settings['user_login'] . '!';
		}

		return $return;
	}
}
