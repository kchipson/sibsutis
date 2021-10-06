<?php

/**
 * Populate Zerif frontpage widgets areas with default widgets
 */
function themeisle_populate_with_default_widgets() {

	$zerif_lite_sidebars = array(
	'sidebar-ourfocus'     => 'sidebar-ourfocus',
		'sidebar-testimonials' => 'sidebar-testimonials',
		'sidebar-ourteam'      => 'sidebar-ourteam',
		'sidebar-aboutus'      => 'sidebar-aboutus',
	);

	$active_widgets = get_option( 'sidebars_widgets' );

	/**
	 * Populate the Our Focus sidebar
	 */
	if ( empty( $active_widgets[ $zerif_lite_sidebars['sidebar-ourfocus'] ] ) ) {

		$zerif_lite_counter = 1;

		/* our focus widget #1 */

		$active_widgets['sidebar-ourfocus'][0] = 'ctup-ads-widget-' . $zerif_lite_counter;

		if ( file_exists( get_stylesheet_directory() . '/images/parallax.png' ) ) {
			$ourfocus_content[ $zerif_lite_counter ] = array(
				'title'     => 'PARALLAX EFFECT',
				'text'      => 'Create memorable pages with smooth parallax effects that everyone loves. Also, use our lightweight content slider offering you smooth and great-looking animations.',
				'link'      => '#',
				// Custom code with stylesheet_direc
				'image_uri' => apply_filters( 'zerif_ourfocus_icon_default_filter', get_stylesheet_directory_uri() . '/images/parallax.png', 'first' ),
			);
		} else {
			$ourfocus_content[ $zerif_lite_counter ] = array(
				'title'     => 'PARALLAX EFFECT',
				'text'      => 'Create memorable pages with smooth parallax effects that everyone loves. Also, use our lightweight content slider offering you smooth and great-looking animations.',
				'link'      => '#',
				// Custom code with template_direc
				'image_uri' => apply_filters( 'zerif_ourfocus_icon_default_filter', get_template_directory_uri() . '/images/parallax.png', 'first' ),
			);
		}

		update_option( 'widget_ctup-ads-widget', $ourfocus_content );

		$zerif_lite_counter ++;

		/* our focus widget #2 */

		$active_widgets['sidebar-ourfocus'][] = 'ctup-ads-widget-' . $zerif_lite_counter;

		if ( file_exists( get_stylesheet_directory() . '/images/woo.png' ) ) {
			$ourfocus_content[ $zerif_lite_counter ] = array(
				'title'     => 'WOOCOMMERCE',
				'text'      => 'Build a front page for your WooCommerce store in a matter of minutes. The neat and clean presentation will help your sales and make your store accessible to everyone.',
				'link'      => '#',
				// Custom code with stylesheet_direc
				'image_uri' => apply_filters( 'zerif_ourfocus_icon_default_filter', get_stylesheet_directory_uri() . '/images/woo.png', 'second' ),
			);
		} else {
			$ourfocus_content[ $zerif_lite_counter ] = array(
				'title'     => 'WOOCOMMERCE',
				'text'      => 'Build a front page for your WooCommerce store in a matter of minutes. The neat and clean presentation will help your sales and make your store accessible to everyone.',
				'link'      => '#',
				// Custom code with template_direc
				'image_uri' => apply_filters( 'zerif_ourfocus_icon_default_filter', get_template_directory_uri() . '/images/woo.png', 'second' ),
			);
		}

		update_option( 'widget_ctup-ads-widget', $ourfocus_content );

		$zerif_lite_counter ++;

		/* our focus widget #3 */

		$active_widgets['sidebar-ourfocus'][] = 'ctup-ads-widget-' . $zerif_lite_counter;

		if ( file_exists( get_stylesheet_directory() . '/images/ccc.png' ) ) {
			$ourfocus_content[ $zerif_lite_counter ] = array(
				'title'     => 'CUSTOM CONTENT BLOCKS',
				'text'      => 'Showcase your team, products, clients, about info, testimonials, latest posts from the blog, contact form, additional calls to action. Everything translation ready.',
				'link'      => '#',
				// Custom code with stylesheet_direc
				'image_uri' => apply_filters( 'zerif_ourfocus_icon_default_filter', get_stylesheet_directory_uri() . '/images/ccc.png', 'third' ),
			);
		} else {
			$ourfocus_content[ $zerif_lite_counter ] = array(
				'title'     => 'CUSTOM CONTENT BLOCKS',
				'text'      => 'Showcase your team, products, clients, about info, testimonials, latest posts from the blog, contact form, additional calls to action. Everything translation ready.',
				'link'      => '#',
				// Custom code with template_direc
				'image_uri' => apply_filters( 'zerif_ourfocus_icon_default_filter', get_template_directory_uri() . '/images/ccc.png', 'third' ),
			);
		}

		update_option( 'widget_ctup-ads-widget', $ourfocus_content );

		$zerif_lite_counter ++;

		/* our focus widget #4 */

		$active_widgets['sidebar-ourfocus'][] = 'ctup-ads-widget-' . $zerif_lite_counter;

		if ( file_exists( get_stylesheet_directory() . '/images/ti-logo.png' ) ) {
			$ourfocus_content[ $zerif_lite_counter ] = array(
				'title'     => 'GO PRO FOR MORE FEATURES',
				'text'      => 'Get new content blocks: pricing table, Google Maps, and more. Change the sections order, display each block exactly where you need it, customize the blocks with whatever colors you wish.',
				'link'      => '#',
				// Custom code with stylesheet_direc
				'image_uri' => apply_filters( 'zerif_ourfocus_icon_default_filter', get_stylesheet_directory_uri() . '/images/ti-logo.png', 'fourth' ),
			);
		} else {
			$ourfocus_content[ $zerif_lite_counter ] = array(
				'title'     => 'GO PRO FOR MORE FEATURES',
				'text'      => 'Get new content blocks: pricing table, Google Maps, and more. Change the sections order, display each block exactly where you need it, customize the blocks with whatever colors you wish.',
				'link'      => '#',
				// Custom code with template_direc
				'image_uri' => apply_filters( 'zerif_ourfocus_icon_default_filter', get_template_directory_uri() . '/images/ti-logo.png', 'fourth' ),
			);
		}

		update_option( 'widget_ctup-ads-widget', $ourfocus_content );

		$zerif_lite_counter ++;

		update_option( 'sidebars_widgets', $active_widgets );

	}// End if().

	/**
	 * Populate the Testimonials sidebar
	 */
	if ( empty( $active_widgets[ $zerif_lite_sidebars['sidebar-testimonials'] ] ) ) {

		$zerif_lite_counter = 1;

		/* testimonial widget #1 */

		$active_widgets['sidebar-testimonials'][0] = 'zerif_testim-widget-' . $zerif_lite_counter;

		if ( file_exists( get_stylesheet_directory() . '/images/testimonial1.jpg' ) ) {
			$testimonial_content[ $zerif_lite_counter ] = array(
				'title'     => 'Dana Lorem',
				'text'      => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur nec sem vel sapien venenatis mattis non vitae augue. Nullam congue commodo lorem vitae facilisis. Suspendisse malesuada id turpis interdum dictum.',
				'image_uri' => get_stylesheet_directory_uri() . '/images/testimonial1.jpg',
			);
		} else {
			$testimonial_content[ $zerif_lite_counter ] = array(
				'title'     => 'Dana Lorem',
				'text'      => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur nec sem vel sapien venenatis mattis non vitae augue. Nullam congue commodo lorem vitae facilisis. Suspendisse malesuada id turpis interdum dictum.',
				'image_uri' => get_template_directory_uri() . '/images/testimonial1.jpg',
			);
		}

		update_option( 'widget_zerif_testim-widget', $testimonial_content );

		$zerif_lite_counter ++;

		/* testimonial widget #2 */

		$active_widgets['sidebar-testimonials'][] = 'zerif_testim-widget-' . $zerif_lite_counter;

		if ( file_exists( get_stylesheet_directory() . '/images/testimonial2.jpg' ) ) {
			$testimonial_content[ $zerif_lite_counter ] = array(
				'title'     => 'Linda Guthrie',
				'text'      => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur nec sem vel sapien venenatis mattis non vitae augue. Nullam congue commodo lorem vitae facilisis. Suspendisse malesuada id turpis interdum dictum.',
				'image_uri' => get_stylesheet_directory_uri() . '/images/testimonial2.jpg',
			);
		} else {
			$testimonial_content[ $zerif_lite_counter ] = array(
				'title'     => 'Linda Guthrie',
				'text'      => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur nec sem vel sapien venenatis mattis non vitae augue. Nullam congue commodo lorem vitae facilisis. Suspendisse malesuada id turpis interdum dictum.',
				'image_uri' => get_template_directory_uri() . '/images/testimonial2.jpg',
			);
		}

		update_option( 'widget_zerif_testim-widget', $testimonial_content );

		$zerif_lite_counter ++;

		/* testimonial widget #3 */

		$active_widgets['sidebar-testimonials'][] = 'zerif_testim-widget-' . $zerif_lite_counter;

		if ( file_exists( get_stylesheet_directory() . '/images/testimonial3.jpg' ) ) {
			$testimonial_content[ $zerif_lite_counter ] = array(
				'title'     => 'Cynthia Henry',
				'text'      => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur nec sem vel sapien venenatis mattis non vitae augue. Nullam congue commodo lorem vitae facilisis. Suspendisse malesuada id turpis interdum dictum.',
				'image_uri' => get_stylesheet_directory_uri() . '/images/testimonial3.jpg',
			);
		} else {
			$testimonial_content[ $zerif_lite_counter ] = array(
				'title'     => 'Cynthia Henry',
				'text'      => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur nec sem vel sapien venenatis mattis non vitae augue. Nullam congue commodo lorem vitae facilisis. Suspendisse malesuada id turpis interdum dictum.',
				'image_uri' => get_template_directory_uri() . '/images/testimonial3.jpg',
			);
		}

		update_option( 'widget_zerif_testim-widget', $testimonial_content );

		$zerif_lite_counter ++;

		update_option( 'sidebars_widgets', $active_widgets );
	}// End if().

	/**
	 * Populate the Our team sidebar
	 */
	if ( empty( $active_widgets[ $zerif_lite_sidebars['sidebar-ourteam'] ] ) ) {

		$zerif_lite_counter = 1;

		/* our team widget #1 */

		$active_widgets['sidebar-ourteam'][0] = 'zerif_team-widget-' . $zerif_lite_counter;

		$ourteam_content[ $zerif_lite_counter ] = array(
			'name'        => 'ASHLEY SIMMONS',
			'position'    => 'Project Manager',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc dapibus, eros at accumsan auctor, felis eros condimentum quam, non porttitor est urna vel neque',
			'fb_link'     => '#',
			'tw_link'     => '#',
			'bh_link'     => '#',
			'db_link'     => '#',
			'ln_link'     => '#',
			'image_uri'   => get_template_directory_uri() . '/images/team1.png',
		);

		update_option( 'widget_zerif_team-widget', $ourteam_content );

		$zerif_lite_counter ++;

		/* our team widget #2 */

		$active_widgets['sidebar-ourteam'][] = 'zerif_team-widget-' . $zerif_lite_counter;

		$ourteam_content[ $zerif_lite_counter ] = array(
			'name'        => 'TIMOTHY SPRAY',
			'position'    => 'Art Director',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc dapibus, eros at accumsan auctor, felis eros condimentum quam, non porttitor est urna vel neque',
			'fb_link'     => '#',
			'tw_link'     => '#',
			'bh_link'     => '#',
			'db_link'     => '#',
			'ln_link'     => '#',
			'image_uri'   => get_template_directory_uri() . '/images/team2.png',
		);

		update_option( 'widget_zerif_team-widget', $ourteam_content );

		$zerif_lite_counter ++;

		/* our team widget #3 */

		$active_widgets['sidebar-ourteam'][] = 'zerif_team-widget-' . $zerif_lite_counter;

		$ourteam_content[ $zerif_lite_counter ] = array(
			'name'        => 'TONYA GARCIA',
			'position'    => 'Account Manager',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc dapibus, eros at accumsan auctor, felis eros condimentum quam, non porttitor est urna vel neque',
			'fb_link'     => '#',
			'tw_link'     => '#',
			'bh_link'     => '#',
			'db_link'     => '#',
			'ln_link'     => '#',
			'image_uri'   => get_template_directory_uri() . '/images/team3.png',
		);

		update_option( 'widget_zerif_team-widget', $ourteam_content );

		$zerif_lite_counter ++;

		/* our team widget #4 */

		$active_widgets['sidebar-ourteam'][] = 'zerif_team-widget-' . $zerif_lite_counter;

		$ourteam_content[ $zerif_lite_counter ] = array(
			'name'        => 'JASON LANE',
			'position'    => 'Business Development',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc dapibus, eros at accumsan auctor, felis eros condimentum quam, non porttitor est urna vel neque',
			'fb_link'     => '#',
			'tw_link'     => '#',
			'bh_link'     => '#',
			'db_link'     => '#',
			'ln_link'     => '#',
			'image_uri'   => get_template_directory_uri() . '/images/team4.png',
		);

		update_option( 'widget_zerif_team-widget', $ourteam_content );

		$zerif_lite_counter ++;

		update_option( 'sidebars_widgets', $active_widgets );
	}// End if().

	/**
	 * Populate the Aboutus sidebar with Client widgets
	 */
	if ( empty( $active_widgets[ $zerif_lite_sidebars['sidebar-aboutus'] ] ) ) {

		$zerif_lite_counter = 1;

		/* client widget #1 */

		$active_widgets['sidebar-aboutus'][0] = 'zerif_clients-widget-' . $zerif_lite_counter;

		$client_content[ $zerif_lite_counter ] = array(
			'link'      => '#',
			'image_uri' => get_template_directory_uri() . '/images/clients1.png',
		);

		update_option( 'widget_zerif_clients-widget', $client_content );

		$zerif_lite_counter ++;

		/* client widget #2 */

		$active_widgets['sidebar-aboutus'][] = 'zerif_clients-widget-' . $zerif_lite_counter;

		$client_content[ $zerif_lite_counter ] = array(
			'link'      => '#',
			'image_uri' => get_template_directory_uri() . '/images/clients2.png',
		);

		update_option( 'widget_zerif_clients-widget', $client_content );

		$zerif_lite_counter ++;

		update_option( 'sidebars_widgets', $active_widgets );

		/* client widget #3 */

		$active_widgets['sidebar-aboutus'][] = 'zerif_clients-widget-' . $zerif_lite_counter;

		$client_content[ $zerif_lite_counter ] = array(
			'link'      => '#',
			'image_uri' => get_template_directory_uri() . '/images/clients3.png',
		);

		update_option( 'widget_zerif_clients-widget', $client_content );

		$zerif_lite_counter ++;

		update_option( 'sidebars_widgets', $active_widgets );

		/* client widget #4 */

		$active_widgets['sidebar-aboutus'][] = 'zerif_clients-widget-' . $zerif_lite_counter;

		$client_content[ $zerif_lite_counter ] = array(
			'link'      => '#',
			'image_uri' => get_template_directory_uri() . '/images/clients4.png',
		);

		update_option( 'widget_zerif_clients-widget', $client_content );

		$zerif_lite_counter ++;

		update_option( 'sidebars_widgets', $active_widgets );

		/* client widget #5 */

		$active_widgets['sidebar-aboutus'][] = 'zerif_clients-widget-' . $zerif_lite_counter;

		$client_content[ $zerif_lite_counter ] = array(
			'link'      => '#',
			'image_uri' => get_template_directory_uri() . '/images/clients5.png',
		);

		update_option( 'widget_zerif_clients-widget', $client_content );

		$zerif_lite_counter ++;

		update_option( 'sidebars_widgets', $active_widgets );

	}// End if().

	update_option( 'themeisle_companion_flag', 'installed' );

}
