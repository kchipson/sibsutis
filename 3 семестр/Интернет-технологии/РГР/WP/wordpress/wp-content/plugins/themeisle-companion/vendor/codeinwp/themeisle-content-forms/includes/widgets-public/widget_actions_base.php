<?php
/**
 *
 */

namespace ThemeIsle\ContentForms\Includes\Admin;

use Elementor\Plugin;

/**
 * Class Widget_Actions_Base
 * @package ThemeIsle\ContentForms\Includes\Widgets\Elementor
 */
abstract class Widget_Actions_Base {

	/**
	 * The type of form.
	 *
	 * @var $form_type
	 */
	public $form_type;

	/**
	 * Initialization function.
	 */
	public function init() {
		$this->form_type = $this->get_form_type();
		add_filter( 'content_forms_submit_' . $this->form_type, array( $this, 'rest_submit_form' ), 10, 5 );
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
	abstract function rest_submit_form( $return, $data, $widget_id, $post_id, $builder );

	/**
	 * Get form type.
	 * @return string
	 */
	abstract function get_form_type();

	/**
	 * Extract widget settings based on a widget id and a page id
	 *
	 * @param int $post_id The id of the post.
	 * @param string $widget_id The widget id.
	 * @param string $builder Page builder.
	 *
	 * @return array|bool
	 */
	static function get_widget_settings( $widget_id, $post_id, $builder ) {

		if ( $builder === 'elementor' ) {
			return self::get_elementor_module_settings_by_id( $widget_id, $post_id );
		}

		if ( $builder === 'beaver' ) {
			return self::get_beaver_module_settings_by_id( $widget_id, $post_id );
		}

		return false;
	}

	/**
	 * Extract Elementpr widget settings based on a widget id and a page id
	 *
	 * @param int $post_id The id of the post.
	 * @param string $widget_id The widget id.
	 *
	 * @return array|bool
	 */
	private static function get_elementor_module_settings_by_id( $widget_id, $post_id ) {
		$document      = Plugin::$instance->documents->get( $post_id );
		$elements_data = $document->get_elements_data();

		//Filters the builder content in the frontend.
		$elements_data = apply_filters( 'elementor/frontend/builder_content_data', $elements_data, $post_id );
		if ( ! empty( $elements_data ) ) {
			$data = self::get_widget_data_by_id( $widget_id, $elements_data );
			if ( array_key_exists( 'settings', $data ) ) {
				return $data['settings'];
			}
		}

		return $elements_data;
	}

	/**
	 * Recursively look through Elementor data and extract the settings for a specific widget.
	 *
	 * @param string $widget_id Widget id.
	 * @param array $elements_data Elements data.
	 *
	 * @return array|bool
	 */
	private static function get_widget_data_by_id( $widget_id, $elements_data ) {
		if ( empty( $elements_data ) ) {
			return false;
		}

		foreach ( $elements_data as $el ) {

			if ( $el['elType'] === 'widget' && $el['id'] === $widget_id ) {
				return $el;
			}

			if ( ! empty( $el['elements'] ) ) {
				$el = self::get_widget_data_by_id( $widget_id, $el['elements'] );

				if ( $el ) {
					return $el;
				}
			}
		}

		return false;
	}

	/**
	 * Each beaver module has data saved in the post metadata, and we need to extract it by its id.
	 *
	 * @param $node_id
	 * @param $post_id
	 *
	 * @return array|bool
	 */
	public static function get_beaver_module_settings_by_id( $node_id, $post_id ) {
		$post_data = \FLBuilderModel::get_layout_data( null, $post_id );
		if ( isset( $post_data[ $node_id ] ) ) {
			$module = $post_data[ $node_id ];
			return (array) $module->settings;
		}
		return false;
	}
}
