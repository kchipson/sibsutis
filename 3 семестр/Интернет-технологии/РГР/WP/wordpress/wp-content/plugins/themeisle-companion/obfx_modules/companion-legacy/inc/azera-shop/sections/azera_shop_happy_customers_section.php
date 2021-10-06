<!-- =========================
 SECTION: CUSTOMERS   
============================== -->
<?php
$azera_shop_happy_customers_show = get_theme_mod( 'azera_shop_happy_customers_show' );
$azera_shop_happy_customers_title    = get_theme_mod( 'azera_shop_happy_customers_title', esc_html__( 'Happy Customers', 'themeisle-companion' ) );
$azera_shop_happy_customers_subtitle = get_theme_mod( 'azera_shop_happy_customers_subtitle', esc_html__( 'Cloud computing subscription model out of the box proactive solution.', 'themeisle-companion' ) );
$default = '';
if( function_exists('azera_shop_companion_testimonials_get_default_content')){
    $default = azera_shop_companion_testimonials_get_default_content();
}
$azera_shop_testimonials_content     = get_theme_mod( 'azera_shop_testimonials_content', $default );
if ( function_exists( 'azera_shop_general_repeater_is_empty' ) ){
    $content_is_empty = azera_shop_general_repeater_is_empty( $azera_shop_testimonials_content );
} else {
    $content_is_empty = empty( $azera_shop_testimonials_content );
}
$section_is_empty = ! isset( $azera_shop_happy_customers_show ) || $azera_shop_happy_customers_show == 1 || ( empty( $azera_shop_happy_customers_title ) && empty( $azera_shop_happy_customers_subtitle ) && $content_is_empty );
if( !$section_is_empty) { ?>

    <section class="testimonials <?php if ($section_is_empty) {
        echo 'azera_shop_only_customizer';
    } ?>" id="customers" role="region" aria-label="<?php esc_attr_e('Testimonials', 'themeisle-companion') ?>">
        <div class="section-overlay-layer">
            <div class="container">

                <!-- SECTION HEADER -->
                <?php
                if (!empty($azera_shop_happy_customers_title) || !empty($azera_shop_happy_customers_subtitle)) { ?>
                    <div class="section-header">
                        <?php
                        if (!empty($azera_shop_happy_customers_title)) { ?>
                            <h2 class="dark-text"><?php echo wp_kses_post($azera_shop_happy_customers_title); ?></h2>
                            <div class="colored-line"></div>
                            <?php
                        } elseif (is_customize_preview()) { ?>
                            <h2 class="dark-text azera_shop_only_customizer"></h2>
                            <div class="colored-line azera_shop_only_customizer"></div>
                            <?php
                        }

                        if (!empty($azera_shop_happy_customers_subtitle)) { ?>
                            <div class="sub-heading"><?php echo wp_kses_post($azera_shop_happy_customers_subtitle); ?></div>
                            <?php
                        } elseif (is_customize_preview()) { ?>
                            <div class="sub-heading azera_shop_only_customizer"></div>
                            <?php
                        } ?>
                    </div>
                    <?php
                }


                if (!empty($azera_shop_testimonials_content)) { ?>
                    <div id="happy_customers_wrap" class="testimonials-wrap">
                        <?php
                        $azera_shop_testimonials_content_decoded = json_decode($azera_shop_testimonials_content);
                        foreach ($azera_shop_testimonials_content_decoded as $azera_shop_testimonial) {
                            $image = !empty($azera_shop_testimonial->image_url) ? apply_filters('azera_shop_translate_single_string', $azera_shop_testimonial->image_url, 'Testimonials section') : '';
                            $title = !empty($azera_shop_testimonial->title) ? apply_filters('azera_shop_translate_single_string', $azera_shop_testimonial->title, 'Testimonials section') : '';
                            $subtitle = !empty($azera_shop_testimonial->subtitle) ? apply_filters('azera_shop_translate_single_string', $azera_shop_testimonial->subtitle, 'Testimonials section') : '';
                            $text = !empty($azera_shop_testimonial->text) ? apply_filters('azera_shop_translate_single_string', $azera_shop_testimonial->text, 'Testimonials section') : '';
                            $section_is_empty = empty($image) && empty($title) && empty($subtitle) && empty($text);

                            if (!$section_is_empty) { ?>
                                <!-- SINGLE FEEDBACK -->
                                <div class="testimonials-box">
                                    <div class="feedback border-bottom-hover">
                                        <div class="pic-container">
                                            <div class="pic-container-inner">
                                                <?php
                                                if (!empty($image)) { ?>
                                                    <img src="<?php echo esc_url($image); ?>"
                                                         alt="<?php echo(!empty($title) ? esc_attr($title) : esc_attr('Avatar', 'themeisle-companion')); ?>">
                                                    <?php
                                                } else {
                                                    $default_image = azera_shop_get_file('/images/clients/client-no-image.jpg'); ?>
                                                    <img src="<?php echo esc_url($default_image); ?>"
                                                         alt="<?php esc_attr_e('Avatar', 'themeisle-companion'); ?>">
                                                    <?php
                                                } ?>
                                            </div>
                                        </div>
                                        <?php
                                        if (!empty($title) || !empty($subtitle) || !empty($text)) { ?>
                                            <div class="feedback-text-wrap">
                                                <?php
                                                if (!empty($title)) { ?>
                                                    <h5 class="colored-text">
                                                        <?php
                                                        echo wp_kses_post($title); ?>
                                                    </h5>
                                                    <?php
                                                }

                                                if (!empty($subtitle)) { ?>
                                                    <div class="small-text">
                                                        <?php
                                                        echo wp_kses_post($subtitle); ?>
                                                    </div>
                                                    <?php
                                                }

                                                if (!empty($text)) { ?>
                                                    <p>
                                                        <?php
                                                        echo wp_kses_post($text); ?>
                                                    </p>
                                                    <?php
                                                } ?>
                                            </div>
                                            <?php
                                        } ?>
                                    </div>
                                </div><!-- .testimonials-box -->
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