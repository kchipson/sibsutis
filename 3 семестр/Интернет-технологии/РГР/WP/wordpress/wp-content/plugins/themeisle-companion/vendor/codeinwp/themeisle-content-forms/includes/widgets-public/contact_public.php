<?php
/**
 * This class handles the action part of the Contact Widget, build and sent the email.
 *
 * @package ContentForms
 */

namespace ThemeIsle\ContentForms\Includes\Widgets_Public;

use ThemeIsle\ContentForms\Form_Manager;
use ThemeIsle\ContentForms\Includes\Admin\Widget_Actions_Base;

require_once TI_CONTENT_FORMS_PATH . '/includes/widgets-public/widget_actions_base.php';

/**
 * Class Contact_Public
 *
 * @package ThemeIsle\ContentForms\Includes\Widgets\Elementor\Contact
 */
class Contact_Public extends Widget_Actions_Base {

	/**
	 * Get current form type.
	 *
	 * @return string
	 */
	function get_form_type() {
		return 'contact';
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

		$settings        = $this->get_widget_settings( $widget_id, $post_id, $builder );
		$success_message = array_key_exists( 'success_message', $settings ) && ! empty( $settings['success_message'] ) ? $settings['success_message'] : esc_html__( 'Your message has been sent!', 'themeisle-companion' );
		$error_message   = array_key_exists( 'error_message', $settings ) && ! empty( $settings['error_message'] ) ? $settings['error_message'] : esc_html__( 'We failed to send your message!', 'themeisle-companion' );
		if ( empty( $settings ) ) {
			return $return;
		}

		/**
		 * Bail if there is nowhere to send the email.
		 */
		if ( ! isset( $settings['to_send_email'] ) || ! is_email( $settings['to_send_email'] ) ) {
			$return['message'] = esc_html__( 'Wrong email configuration! Please contact administration!', 'themeisle-companion' );
			return $return;
		}

		$fields = array_key_exists( 'form_fields', $settings ) ? $settings['form_fields'] : ( array_key_exists( 'fields', $settings ) ? $settings['fields'] : array() );
		if ( empty( $fields ) ) {
			return $return;
		}

		foreach ( $fields as $field ) {
			$field          = (array) $field;
			$key            = Form_Manager::get_field_key_name( $field );
			$required_field = array_key_exists( 'requirement', $field ) ? $field['requirement'] : ( array_key_exists( 'required', $field ) ? $field['required'] : '' );

			if ( 'required' === $required_field && empty( $data[ $key ] ) ) {
				$return['message'] = sprintf( esc_html__( 'Missing %s', 'themeisle-companion' ), $key );
				return $return;
			}

			if ( 'email' === $field['type'] && ! is_email( $data[ $key ] ) ) {
				$return['message'] = esc_html__( 'Invalid email.', 'themeisle-companion' );
				return $return;
			}
		}

		$from = isset( $data['email'] ) ? $data['email'] : null;
		$name = isset( $data['name'] ) ? $data['name'] : null;

		// prepare settings for submit
		$result = $this->_send_mail( $settings['to_send_email'], $from, $name, $data );

		$return['message'] = $error_message;
		if ( $result ) {
			$return['success'] = true;
			$return['message'] = $success_message;
		}

		return $return;
	}

	/**
	 * Mail sender method
	 *
	 * @param string $mailto Recipient email.
	 * @param string $mailfrom Sender email.
	 * @param string $name Name field.
	 * @param array $extra_data Form data.
	 *
	 * @return bool
	 */
	private function _send_mail( $mailto, $mailfrom, $name, $extra_data = array() ) {

		$name     = sanitize_text_field( $name );
		$subject  = 'Website inquiry from ' . ( ! empty( $name ) ? $name : 'N/A' );
		$mailto   = sanitize_email( $mailto );
		$mailfrom = sanitize_email( $mailfrom );
		$headers  = array();

		$headers[] = 'From: Admin <' . $mailto . '>';
		if ( ! empty( $mailfrom ) ) {
			$headers[] = 'Reply-To: ' . $name . ' <' . $mailfrom . '>';
		}
		$headers[] = 'Content-Type: text/html; charset=UTF-8';

		$body = $this->prepare_body( $extra_data );

		ob_start();

		$success = wp_mail( $mailto, $subject, $body, $headers );

		if ( ! $success ) {
			return ob_get_clean();
		}

		return $success;
	}

	/**
	 * Body template preparation
	 *
	 * @param array $data
	 *
	 * @return string
	 */
	private function prepare_body( $data ) {
		ob_start(); ?>
		<!doctype html>
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="Content-Type" content="text/html;" charset="utf-8"/>
			<!-- view port meta tag -->
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
			<title><?php echo esc_html__( 'Mail From: ', 'themeisle-companion' ) . isset( $data['name'] ) ? esc_html( $data['name'] ) : 'N/A'; ?></title>
		</head>
		<body>
		<table>
			<thead>
			<tr>
				<th>
					<h3>
						<?php esc_html_e( 'Content Form submission from ', 'themeisle-companion' ); ?>
						<a href="<?php echo esc_url( get_site_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
					</h3>
					<hr/>
				</th>
			</tr>
			</thead>
			<tbody>
			<?php
			foreach ( $data as $key => $value ) {
				?>
				<tr>
					<td>
						<strong><?php echo esc_html( $key ); ?> : </strong>
						<p><?php echo esc_html( $value ); ?></p>
					</td>
				</tr>
			<?php } ?>
			</tbody>
			<tfoot>
			<tr>
				<td>
					<hr/>
					<?php esc_html_e( 'You received this email because your email address is set in the content form settings on ', 'themeisle-companion' ); ?>
					<a href="<?php echo esc_url( get_site_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
				</td>
			</tr>
			</tfoot>
		</table>
		</body>
		</html>
		<?php
		return ob_get_clean();
	}


}
