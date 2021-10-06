<!-- =========================
 SECTION: CUSTOMERS   
============================== -->
<?php

$llorix_one_lite_happy_customers_show     = get_theme_mod( 'llorix_one_lite_happy_customers_show' );
$llorix_one_lite_happy_customers_title    = get_theme_mod( 'llorix_one_lite_happy_customers_title', esc_html__( 'Happy Customers', 'themeisle-companion' ) );
$llorix_one_lite_happy_customers_subtitle = get_theme_mod( 'llorix_one_lite_happy_customers_subtitle', esc_html__( 'Cloud computing subscription model out of the box proactive solution.', 'themeisle-companion' ) );
$default = '';
if( function_exists('llorix_one_companion_testimonials_get_default_content')){
    $default = llorix_one_companion_testimonials_get_default_content();
}
$llorix_one_lite_testimonials_content     = get_theme_mod( 'llorix_one_lite_testimonials_content', $default );
if ( function_exists( 'llorix_one_lite_general_repeater_is_empty' ) ){
    $content_is_empty = llorix_one_lite_general_repeater_is_empty( $llorix_one_lite_testimonials_content );
} else {
    $content_is_empty = empty( $llorix_one_lite_testimonials_content );
}
$section_is_empty = ! isset( $llorix_one_lite_happy_customers_show ) || $llorix_one_lite_happy_customers_show == 1 || ( empty( $llorix_one_lite_happy_customers_title ) && empty( $llorix_one_lite_happy_customers_subtitle ) && $content_is_empty );
if( !$section_is_empty) { ?>
    <section class="testimonials <?php if ($section_is_empty) {
        echo 'llorix_one_lite_only_customizer';
    } ?>" id="customers" role="region" aria-label="<?php esc_attr_e('Testimonials', 'themeisle-companion') ?>">
        <div class="section-overlay-layer">
            <div class="container">
                <!-- SECTION HEADER -->
                <?php
                if (!empty($llorix_one_lite_happy_customers_title) || !empty($llorix_one_lite_happy_customers_subtitle)) { ?>
                    <div class="section-header">
                        <?php
                        if (!empty($llorix_one_lite_happy_customers_title)) { ?>
                            <h2 class="dark-text"><?php echo wp_kses_post($llorix_one_lite_happy_customers_title); ?></h2>
                            <div class="colored-line"></div>
                            <?php
                        } elseif (is_customize_preview()) { ?>
                            <h2 class="dark-text llorix_one_lite_only_customizer"></h2>
                            <div class="colored-line llorix_one_lite_only_customizer"></div>
                            <?php
                        }

                        if (!empty($llorix_one_lite_happy_customers_subtitle)) { ?>
                            <div class="sub-heading"><?php echo wp_kses_post($llorix_one_lite_happy_customers_subtitle); ?></div>
                            <?php
                        } elseif (is_customize_preview()) { ?>
                            <div class="sub-heading llorix_one_lite_only_customizer"></div>
                            <?php
                        } ?>
                    </div>
                    <?php
                }

                if (!$content_is_empty) { ?>
                    <div id="happy_customers_wrap" class="testimonials-wrap">
                        <?php
                        $llorix_one_lite_testimonials_content_decoded = json_decode($llorix_one_lite_testimonials_content);
                        foreach ($llorix_one_lite_testimonials_content_decoded as $llorix_one_lite_testimonial) {
                            $image = !empty($llorix_one_lite_testimonial->image_url) ? apply_filters('llorix_one_lite_translate_single_string', $llorix_one_lite_testimonial->image_url, 'Testimonials section') : '';
                            $title = !empty($llorix_one_lite_testimonial->title) ? apply_filters('llorix_one_lite_translate_single_string', $llorix_one_lite_testimonial->title, 'Testimonials section') : '';
                            $subtitle = !empty($llorix_one_lite_testimonial->subtitle) ? apply_filters('llorix_one_lite_translate_single_string', $llorix_one_lite_testimonial->subtitle, 'Testimonials section') : '';
                            $text = !empty($llorix_one_lite_testimonial->text) ? apply_filters('llorix_one_lite_translate_single_string', $llorix_one_lite_testimonial->text, 'Testimonials section') : '';
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
                                                         alt="<?php echo(!empty($title) ? esc_attr($title) : esc_attr('Avatar', 'llorix-one-companion')); ?>">
                                                    <?php
                                                } else {
                                                    $default_image = llorix_one_lite_get_file('/images/clients/client-no-image.jpg'); ?>
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
    </section><!-- customers -->
    <?php
}