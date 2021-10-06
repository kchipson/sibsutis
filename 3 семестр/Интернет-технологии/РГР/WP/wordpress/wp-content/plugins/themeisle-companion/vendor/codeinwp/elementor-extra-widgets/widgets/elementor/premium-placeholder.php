<?php

namespace ThemeIsle\ElementorExtraWidgets;

/**
 * Create an abstract class as a base for all the Premium Widgets
 * This way, we'll configure the a Placeholder Widget in Lite plugins which will be overwritten in the Pro plugin.
 */
abstract class Premium_Placeholder extends \Elementor\Widget_Base {
	/**
	 * Each Placeholder must declare for which Premium Widget will keep the place warm
	 * @return mixed
	 */
	abstract public function get_pro_element_name();

	/**
	 * The widget's name will probably be the pro_element_name.
	 * @return mixed|string
	 */
	public function get_name() {
		return 'eaw-' . $this->get_pro_element_name();
	}

	/**
	 * Returns the up-sell link for premium widgets.
	 * It should be overwritten in the extended class.
	 *
	 * @return string
	 */
	public function get_upsell_link() {
		if ( ! defined( 'SIZZIFY_UPSELL_LINK' ) ) {
			return 'https://themeisle.com/wordpress-plugins';
		}
		return SIZZIFY_UPSELL_LINK;
	}

	/**
	 * Get widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-insert-image';
	}

	/**
	 * The Widget Category is filterable, so we need some extra logic to handle it better.
	 * Premium category is suffixed with `-pro` string.
	 *
	 * @return array
	 */
	public function get_categories() {
		$category_args = apply_filters( 'elementor_extra_widgets_category_args', array() );
		$slug          = isset( $category_args['slug'] ) ? $category_args['slug'] : 'obfx-elementor-widgets';

		return array( $slug . '-pro' );
	}

	/**
	 * Register Elementor Controls.
	 *
	 * Because this is just a placeholder widget, we need to output this to the Lite users.
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => $this->get_title()
			]
		);

		$this->add_control(
			'inform_about_placeholder',
			[
				'raw'             => sprintf(
					'<div><h3>%s</h3><a href="%s" target="_blank">%s</a></div>',
					__( 'This widget is part of the pro version of Sizzify.', 'themeisle-companion' ),
					$this->get_upsell_link(),
					__( 'Upgrade Here!', 'themeisle-companion' )
				),
				'type'            => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$this->end_controls_section(); // end section-title

	}

	/**
	 * A placeholder should not output anything in front-end.
	 * Only on the editor side will output a message about it's type.
	 */
	public function render() {
		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) { ?>
			<div class="elementor-premium-placeholder" role="tablist"
				 style="position: relative;
				background: #fff;
				color: red;
				text-align: center;"
			>
				<h3 style="color:red"><?php echo $this->get_title(); ?></h3>
				<i class="elementor-widget-empty-icon eicon-insert-image"
				   style="font-size: 100px;
					vertical-align: middle;
					color: grey"></i>
				<p>This is a Premium widget. You need to buy it to use it.</p>
			</div>
		<?php }
	}
}