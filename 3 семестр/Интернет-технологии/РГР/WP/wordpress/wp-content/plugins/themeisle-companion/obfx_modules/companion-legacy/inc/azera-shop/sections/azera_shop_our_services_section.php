<?php
$azera_shop_our_services_show = get_theme_mod( 'azera_shop_our_services_show' );
$azera_shop_our_services_title    = get_theme_mod( 'azera_shop_our_services_title', esc_html__( 'Our Services', 'themeisle-companion' ) );
$azera_shop_our_services_subtitle = get_theme_mod( 'azera_shop_our_services_subtitle', esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'themeisle-companion' ) );
$default = '';
if( function_exists('azera_shop_companion_sevices_get_default_content')){
    $default = azera_shop_companion_sevices_get_default_content();
}
$azera_shop_services              = get_theme_mod( 'azera_shop_services_content', $default);
if ( function_exists( 'azera_shop_general_repeater_is_empty' ) ){
    $content_is_empty = azera_shop_general_repeater_is_empty( $azera_shop_services );
} else {
    $content_is_empty = empty( $azera_shop_services );
}
$section_is_empty = ! isset( $azera_shop_our_services_show ) || $azera_shop_our_services_show == 1 || ( empty( $azera_shop_our_services_title ) && empty( $azera_shop_our_services_subtitle ) && $content_is_empty );
if( !$section_is_empty ){ ?>

    <section class="services <?php if ($section_is_empty) {
    echo 'azera_shop_only_customizer';
} ?>" id="services" role="region" aria-label="<?php esc_attr_e('Services', 'themeisle-companion') ?>">
        <div class="section-overlay-layer">
            <div class="container">
                <div class="section-header">
                    <?php
                    if (!empty($azera_shop_our_services_title)) { ?>
                        <h2 class="dark-text"><?php echo wp_kses_post($azera_shop_our_services_title); ?></h2>
                        <div class="colored-line"></div>
                        <?php
                    } elseif (is_customize_preview()) { ?>
                        <h2 class="dark-text azera_shop_only_customizer"></h2>
                        <div class="colored-line azera_shop_only_customizer"></div>
                        <?php
                    }

                    if (!empty($azera_shop_our_services_subtitle)) { ?>
                        <div class="sub-heading"><?php echo wp_kses_post($azera_shop_our_services_subtitle); ?></div>
                        <?php
                    } elseif (is_customize_preview()) { ?>
                        <div class="sub-heading azera_shop_only_customizer"></div>
                        <?php
                    } ?>
                </div>

                <?php
                if (!$content_is_empty) {
                    $azera_shop_services_decoded = json_decode($azera_shop_services); ?>
                    <div id="our_services_wrap" class="services-wrap">
                        <?php
                        foreach ($azera_shop_services_decoded as $azera_shop_service_box) {
                            $choice = !empty($azera_shop_service_box->choice) ? $azera_shop_service_box->choice : '';
                            $icon = !empty($azera_shop_service_box->icon_value) ? apply_filters('azera_shop_translate_single_string', $azera_shop_service_box->icon_value, 'Services section') : '';
                            $image = !empty($azera_shop_service_box->image_url) ? apply_filters('azera_shop_translate_single_string', $azera_shop_service_box->image_url, 'Services section') : '';
                            $title = !empty($azera_shop_service_box->title) ? apply_filters('azera_shop_translate_single_string', $azera_shop_service_box->title, 'Services section') : '';
                            $text = !empty($azera_shop_service_box->text) ? apply_filters('azera_shop_translate_single_string', $azera_shop_service_box->text, 'Services section') : '';
                            $link = !empty($azera_shop_service_box->link) ? apply_filters('azera_shop_translate_single_string', $azera_shop_service_box->link, 'Services section') : '';
                            $section_is_empty = (empty($icon) || $icon === 'No Icon' && $choice === 'azera_shop_icon') && (empty($image) && $choice === 'azera_shop_image') && empty($title) && empty($text);

                            if (!$section_is_empty) { ?>
                                <div class="service-box">
                                    <div class="single-service border-bottom-hover">
                                        <?php
                                        if (!empty($choice) && $choice !== 'azera_shop_none') {

                                            if ($choice === 'azera_shop_icon') {
                                                if (!empty($icon)) {
                                                    if (!empty($link)) { ?>
                                                        <div class="service-icon colored-text">
                                                            <a href="<?php echo esc_url($link); ?>">
                                                                <i class="fa <?php echo esc_attr($icon); ?>"></i>
                                                            </a>
                                                        </div>
                                                        <?php
                                                    } else { ?>
                                                        <div class="service-icon colored-text">
                                                            <i class="fa <?php echo esc_attr($icon); ?>"></i>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                            }

                                            if ($choice === 'azera_shop_image') {
                                                if (!empty($image)) {
                                                    if (!empty($link)) { ?>
                                                        <a href="<?php echo esc_url($link); ?>">
                                                            <img src="<?php echo esc_url($image); ?>" <?php echo(!empty($title) ? 'alt="' . esc_attr($title) . '"' : ''); ?> />
                                                        </a>
                                                        <?php
                                                    } else { ?>
                                                        <img src="<?php echo esc_url($image); ?>" <?php echo(!empty($title) ? 'alt="' . esc_attr($title) . '"' : ''); ?> />
                                                        <?php
                                                    }
                                                }
                                            }
                                        }

                                        if (!empty($title)) {
                                            if (!empty($link)) { ?>
                                                <h3 class="colored-text">
                                                    <a href="<?php echo esc_url($link); ?>"><?php echo wp_kses_post($title); ?></a>
                                                </h3>
                                                <?php
                                            } else { ?>
                                                <h3 class="colored-text"><?php echo wp_kses_post($title); ?></h3>
                                                <?php
                                            }
                                        }

                                        if (!empty($text)) { ?>
                                            <p><?php echo wp_kses_post($text); ?></p>
                                            <?php
                                        } ?>
                                    </div>
                                </div>
                                <?php
                            }
                        } ?>
                    </div>
                    <?php
                } ?>
            </div>
        </div>
    </section>
<?php
}