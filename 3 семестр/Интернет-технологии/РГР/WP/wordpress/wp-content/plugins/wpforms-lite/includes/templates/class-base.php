<?php

/**
 * Base form template.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
 */
abstract class WPForms_Template {

	/**
	 * Full name of the template, eg "Contact Form".
	 *
	 * @since 1.0.0
	 * @var string
	 */
	public $name;

	/**
	 * Slug of the template, eg "contact-form" - no spaces.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	public $slug;

	/**
	 * Short description the template.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	public $description = '';

	/**
	 * Short description of the fields included with the template.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	public $includes = '';

	/**
	 * URL of the icon to display in the admin area.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	public $icon = '';

	/**
	 * Array of data that is assigned to the post_content on form creation.
	 *
	 * @since 1.0.0
	 * @var array
	 */
	public $data;

	/**
	 * Priority to show in the list of available templates.
	 *
	 * @since 1.0.0
	 * @var int
	 */
	public $priority = 20;

	/**
	 * Core or additional template.
	 *
	 * @since 1.4.0
	 * @var bool
	 */
	public $core = false;

	/**
	 * Modal message to display when the template is applied.
	 *
	 * @since 1.0.0
	 * @var array
	 */
	public $modal = '';

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Bootstrap.
		$this->init();

		$type = $this->core ? '_core' : '';

		add_filter( "wpforms_form_templates{$type}", array( $this, 'template_details' ), $this->priority );
		add_filter( 'wpforms_create_form_args', array( $this, 'template_data' ), 10, 2 );
		add_filter( 'wpforms_save_form_args', array( $this, 'template_replace' ), 10, 3 );
		add_filter( 'wpforms_builder_template_active', array( $this, 'template_active' ), 10, 2 );
	}

	/**
	 * Let's get started.
	 *
	 * @since 1.0.0
	 */
	public function init() {
	}

	/**
	 * Add basic template details to the Add New Form admin screen.
	 *
	 * @since 1.0.0
	 *
	 * @param array $templates
	 *
	 * @return array
	 */
	public function template_details( $templates ) {

		$templates[] = array(
			'name'        => $this->name,
			'slug'        => $this->slug,
			'description' => $this->description,
			'includes'    => $this->includes,
			'icon'        => $this->icon,
		);

		return $templates;
	}

	/**
	 * Add template data when form is created.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args
	 * @param array $data
	 *
	 * @return array
	 */
	public function template_data( $args, $data ) {

		if ( ! empty( $data ) && ! empty( $data['template'] ) ) {
			if ( $data['template'] === $this->slug ) {
				$args['post_content'] = wpforms_encode( $this->data );
			}
		}

		return $args;
	}

	/**
	 * Replace template on post update if triggered.
	 *
	 * @since 1.0.0
	 *
	 * @param array $form
	 * @param array $data
	 * @param array $args
	 *
	 * @return array
	 */
	public function template_replace( $form, $data, $args ) {

		if ( ! empty( $args['template'] ) ) {
			if ( $args['template'] === $this->slug ) {
				$new                  = $this->data;
				$new['settings']      = ! empty( $form['post_content']['settings'] ) ? $form['post_content']['settings'] : array();
				$form['post_content'] = wpforms_encode( $new );
			}
		}

		return $form;
	}

	/**
	 * Pass information about the active template back to the builder.
	 *
	 * @since 1.0.0
	 *
	 * @param array $details
	 * @param object $form
	 *
	 * @return array
	 */
	public function template_active( $details, $form ) {

		if ( empty( $form ) ) {
			return;
		}

		$form_data = wpforms_decode( $form->post_content );

		if ( empty( $this->modal ) || empty( $form_data['meta']['template'] ) || $this->slug !== $form_data['meta']['template'] ) {
			return $details;
		} else {
			$display = $this->template_modal_conditional( $form_data );
		}

		$template = array(
			'name'          => $this->name,
			'slug'          => $this->slug,
			'description'   => $this->description,
			'includes'      => $this->includes,
			'icon'          => $this->icon,
			'modal'         => $this->modal,
			'modal_display' => $display,
		);

		return $template;
	}

	/**
	 * Conditional to determine if the template informational modal screens
	 * should display.
	 *
	 * @since 1.0.0
	 *
	 * @param array $form_data Form data and settings.
	 *
	 * @return boolean
	 */
	public function template_modal_conditional( $form_data ) {

		return false;
	}
}
