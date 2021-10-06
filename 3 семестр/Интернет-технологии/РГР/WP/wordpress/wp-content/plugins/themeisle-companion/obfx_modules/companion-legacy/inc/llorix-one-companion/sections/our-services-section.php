<!-- =========================
 SECTION: SERVICES
============================== -->
<?php

$llorix_one_lite_our_services_show     = get_theme_mod( 'llorix_one_lite_our_services_show' );
$llorix_one_lite_our_services_title    = get_theme_mod( 'llorix_one_lite_our_services_title', esc_html__( 'Our Services', 'themeisle-companion' ) );
$llorix_one_lite_our_services_subtitle = get_theme_mod( 'llorix_one_lite_our_services_subtitle', esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'themeisle-companion' ) );
$default = '';
if( function_exists('llorix_one_companion_sevices_get_default_content')){
    $default = llorix_one_companion_sevices_get_default_content();
}
$llorix_one_lite_services              = get_theme_mod( 'llorix_one_lite_services_content', $default );
if ( function_exists( 'llorix_one_lite_general_repeater_is_empty' ) ){
    $content_is_empty = llorix_one_lite_general_repeater_is_empty( $llorix_one_lite_services );
} else {
    $content_is_empty = empty( $llorix_one_lite_services );
}
$section_is_empty                      = ! isset( $llorix_one_lite_our_services_show ) || $llorix_one_lite_our_services_show == 1 || ( empty( $llorix_one_lite_our_services_title ) && empty( $llorix_one_lite_our_services_subtitle ) && $content_is_empty );
if(!$section_is_empty) { ?>

    <section class="services <?php if ($section_is_empty) {
        echo 'llorix_one_lite_only_customizer';
    } ?>" id="services" role="region" aria-label="<?php esc_html_e('Services', 'themeisle-companion') ?>">
        <div class="section-overlay-layer">
            <div class="container">

                <!-- SECTION HEADER -->
                <div class="section-header">
                    <?php
                    if (!empty($llorix_one_lite_our_services_title)) { ?>
                        <h2 class="dark-text"><?php echo wp_kses_post($llorix_one_lite_our_services_title); ?></h2>
                        <div class="colored-line"></div>
                        <?php
                    } elseif (is_customize_preview()) { ?>
                        <h2 class="dark-text llorix_one_lite_only_customizer"></h2>
                        <div class="colored-line llorix_one_lite_only_customizer"></div>
                        <?php
                    }

                    if (!empty($llorix_one_lite_our_services_subtitle)) { ?>
                        <div class="sub-heading"><?php echo wp_kses_post($llorix_one_lite_our_services_subtitle); ?></div>
                        <?php
                    } elseif (is_customize_preview()) { ?>
                        <div class="sub-heading llorix_one_lite_only_customizer"></div>
                        <?php
                    } ?>
                </div>


                <?php
                if (!$content_is_empty) {
                    $llorix_one_lite_services_decoded = json_decode($llorix_one_lite_services); ?>
                    <div id="our_services_wrap" class="services-wrap">
                        <?php
                        foreach ($llorix_one_lite_services_decoded as $llorix_one_lite_service_box) {

                            $choice = !empty($llorix_one_lite_service_box->choice) ? $llorix_one_lite_service_box->choice : '';
                            $icon = !empty($llorix_one_lite_service_box->icon_value) ? apply_filters('llorix_one_lite_translate_single_string', $llorix_one_lite_service_box->icon_value, 'Services section') : '';
                            $image = !empty($llorix_one_lite_service_box->image_url) ? apply_filters('llorix_one_lite_translate_single_string', $llorix_one_lite_service_box->image_url, 'Services section') : '';
                            $title = !empty($llorix_one_lite_service_box->title) ? apply_filters('llorix_one_lite_translate_single_string', $llorix_one_lite_service_box->title, 'Services section') : '';
                            $text = !empty($llorix_one_lite_service_box->text) ? apply_filters('llorix_one_lite_translate_single_string', $llorix_one_lite_service_box->text, 'Services section') : '';
                            $link = !empty($llorix_one_lite_service_box->link) ? apply_filters('llorix_one_lite_translate_single_string', $llorix_one_lite_service_box->link, 'Services section') : '';
                            $section_is_empty = (empty($icon) || $icon === 'No Icon' && $choice === 'llorix_one_lite_icon') && (empty($image) && $choice === 'llorix_one_lite_image') && empty($title) && empty($text);

                            if (!$section_is_empty) { ?>
                                <div class="service-box">
                                    <div class="single-service border-bottom-hover">
                                        <?php
                                        if (!empty($choice) && $choice !== 'llorix_one_lite_none') {

                                            if ($choice === 'llorix_one_lite_icon') {
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

                                            if ($choice === 'llorix_one_lite_image') {
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