<?php

/**
 * Popularis Theme Customizer
 *
 */
$popularis_sections = array('info', 'demo');

foreach ($popularis_sections as $section) {
    require get_template_directory() . '/inc/admin/customizer/' . $section . '.php';
}

function popularis_customizer_scripts() {
    wp_enqueue_style('popularis-customize', get_template_directory_uri() . '/inc/admin/customizer/css/customize.css', '', 'screen');
    wp_enqueue_script('popularis-customize', get_template_directory_uri() . '/inc/admin/customizer/js/customize.js', array('jquery'), '20170404', true);
}

add_action('customize_controls_enqueue_scripts', 'popularis_customizer_scripts');

require get_template_directory() . '/inc/admin/customizer/customizer-notice/class-customizer-notice.php';

require get_template_directory() . '/inc/admin/customizer/plugin-install/class-plugin-install-helper.php';

$theme_data = wp_get_theme();

$config_customizer = array(
    'recommended_plugins' => array(
        'popularis-extra' => array(
            'recommended' => true,
            /* translators: %s: Plugin name string */
            'description' => sprintf(esc_html__('To take full advantage of all the features this theme has to offer, please install and activate the %s plugin.', 'popularis'), '<strong>Popularis Extra</strong>'),
        ),
    ),
    /* translators: %s: Theme name */
    'recommended_plugins_title' => sprintf(esc_html__('Welcome to %1$s - Version %2$s', 'popularis'), esc_html($theme_data->Name), esc_html($theme_data->Version)),
    'install_button_label' => esc_html__('Install now', 'popularis'),
    'activate_button_label' => esc_html__('Activate', 'popularis'),
);
Popularis_Customizer_Notice::init(apply_filters('popularis_customizer_notice_array', $config_customizer));
