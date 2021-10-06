<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<script type="text/template" id="tmpl-elementor-panel-elements">
	<div id="elementor-panel-elements-loading">
		<i class="eicon-loading eicon-animation-spin"></i>
	</div>
	<div id="elementor-panel-elements-navigation" class="elementor-panel-navigation">
		<div class="elementor-component-tab elementor-panel-navigation-tab" data-tab="categories"><?php echo __( 'Elements', 'elementor' ); ?></div>
		<div class="elementor-component-tab elementor-panel-navigation-tab" data-tab="global"><?php echo __( 'Global', 'elementor' ); ?></div>
	</div>
	<div id="elementor-panel-elements-search-area"></div>
	<div id="elementor-panel-elements-wrapper"></div>
</script>

<script type="text/template" id="tmpl-elementor-panel-categories">
	<div id="elementor-panel-categories"></div>

	<div id="elementor-panel-get-pro-elements" class="elementor-nerd-box">
		<i class="elementor-nerd-box-icon eicon-hypster" aria-hidden="true"></i>
		<div class="elementor-nerd-box-message"><?php echo __( 'Get more with Elementor Pro', 'elementor' ); ?></div>
		<a class="elementor-button elementor-button-default elementor-nerd-box-link" target="_blank" href="<?php echo Utils::get_pro_link( 'https://elementor.com/pro/?utm_source=panel-widgets&utm_campaign=gopro&utm_medium=wp-dash' ); ?>"><?php echo __( 'Go Pro', 'elementor' ); ?></a>
	</div>
</script>

<script type="text/template" id="tmpl-elementor-panel-elements-category">
	<div class="elementor-panel-category-title">{{{ title }}}</div>
	<div class="elementor-panel-category-items"></div>
</script>

<script type="text/template" id="tmpl-elementor-panel-element-search">
	<label for="elementor-panel-elements-search-input" class="screen-reader-text"><?php echo __( 'Search Widget:', 'elementor' ); ?></label>
	<input type="search" id="elementor-panel-elements-search-input" placeholder="<?php esc_attr_e( 'Search Widget...', 'elementor' ); ?>" autocomplete="off"/>
	<i class="eicon-search-bold" aria-hidden="true"></i>
</script>

<script type="text/template" id="tmpl-elementor-element-library-element">
	<div class="elementor-element">
		<div class="icon">
			<i class="{{ icon }}" aria-hidden="true"></i>
		</div>
		<div class="elementor-element-title-wrapper">
			<div class="title">{{{ title }}}</div>
		</div>
	</div>
</script>

<script type="text/template" id="tmpl-elementor-panel-global">
	<div class="elementor-nerd-box">
		<i class="elementor-nerd-box-icon eicon-hypster" aria-hidden="true"></i>
		<div class="elementor-nerd-box-title"><?php echo __( 'Meet Our Global Widget', 'elementor' ); ?></div>
		<div class="elementor-nerd-box-message"><?php echo __( 'With this feature, you can save a widget as global, then add it to multiple areas. All areas will be editable from one single place.', 'elementor' ); ?></div>
		<div class="elementor-nerd-box-message"><?php echo __( 'This feature is only available on Elementor Pro.', 'elementor' ); ?></div>
		<a class="elementor-button elementor-button-default elementor-nerd-box-link" target="_blank" href="<?php echo Utils::get_pro_link( 'https://elementor.com/pro/?utm_source=panel-global&utm_campaign=gopro&utm_medium=wp-dash' ); ?>"><?php echo __( 'Go Pro', 'elementor' ); ?></a>
	</div>
</script>
