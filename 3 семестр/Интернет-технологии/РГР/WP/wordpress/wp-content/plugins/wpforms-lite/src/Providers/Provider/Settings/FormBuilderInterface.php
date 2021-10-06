<?php

namespace WPForms\Providers\Provider\Settings;

/**
 * Interface FormBuilderInterface defines required method for builder to work properly.
 *
 * @package    WPForms\Providers\Provider\Settings
 * @author     WPForms
 * @since      1.4.7
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2018, WPForms LLC
 */
interface FormBuilderInterface {

	/**
	 * Every provider should display a title in a Builder.
	 *
	 * @since 1.4.7
	 */
	public function display_sidebar();

	/**
	 * Every provider should display a content of its settings in a Builder.
	 *
	 * @since 1.4.7
	 */
	public function display_content();

	/**
	 * Use this method to register own templates for form builder.
	 * Make sure, that you have `tmpl-` in template name in `<script id="tmpl-*">`.
	 *
	 * @since 1.4.7
	 */
	public function builder_custom_templates();
}
