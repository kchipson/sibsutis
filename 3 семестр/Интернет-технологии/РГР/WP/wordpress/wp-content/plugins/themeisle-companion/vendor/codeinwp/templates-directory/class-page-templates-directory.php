<?php

namespace ThemeIsle;

if ( ! class_exists( '\ThemeIsle\PageTemplatesDirectory' ) ) {
	class PageTemplatesDirectory {

		/**
		 * @var PageTemplatesDirectory
		 */

		protected static $instance = null;

		/**
		 * The version of this library
		 * @var string
		 */
		public static $version = '1.0.9';

		/**
		 * Holds the module slug.
		 *
		 * @since   1.0.0
		 * @access  protected
		 * @var     string $slug The module slug.
		 */
		protected $slug = 'templates-directory';

		protected $source_url;

		/**
		 * Defines the library behaviour
		 */
		protected function init() {
			add_action( 'rest_api_init', array( $this, 'register_endpoints' ) );
			//Add dashboard menu page.
			add_action( 'admin_menu', array( $this, 'add_menu_page' ), 100 );
			//Add rewrite endpoint.
			add_action( 'init', array( $this, 'demo_listing_register' ) );
			//Add template redirect.
			add_action( 'template_redirect', array( $this, 'demo_listing' ) );
			//Enqueue admin scripts.
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_template_dir_scripts' ) );
			// Get the full-width pages feature
			add_action( 'init', array( $this, 'load_full_width_page_templates' ), 11 );
			// Remove the blank template from the page template selector
			add_filter( 'fwpt_templates_list', array( $this, 'filter_fwpt_templates_list' ) );
			// Filter to add fetched.
			add_filter( 'template_directory_templates_list', array( $this, 'filter_templates' ), 99 );


			$default_source_url = apply_filters( 'templates_directory_source_url', 'https://raw.githubusercontent.com/Codeinwp/obfx-templates/master/' );
			$this->set_source_url( $default_source_url );
		}

		/**
		 * Enqueue the scripts for the dashboard page of the
		 */
		public function enqueue_template_dir_scripts() {
			$current_screen = get_current_screen();
			if ( $current_screen->id === 'orbit-fox_page_obfx_template_dir' || $current_screen->id === 'sizzify_page_sizzify_template_dir' ) {
				if ( $current_screen->id === 'orbit-fox_page_obfx_template_dir' ) {
					$plugin_slug = 'obfx';
				} else {
					$plugin_slug = 'sizzify';
				}
				$script_handle = $this->slug . '-script';
				wp_enqueue_script( 'plugin-install' );
				wp_enqueue_script( 'updates' );
				wp_register_script( $script_handle, plugin_dir_url( $this->get_dir() ) . $this->slug . '/js/script.js', array( 'jquery' ), $this::$version );
				wp_localize_script( $script_handle, 'importer_endpoint',
					array(
						'url'                 => $this->get_endpoint_url( '/import_elementor' ),
						'plugin_slug'         => $plugin_slug,
						'fetch_templates_url' => $this->get_endpoint_url( '/fetch_templates' ),
						'nonce'               => wp_create_nonce( 'wp_rest' ),
					) );
				wp_enqueue_script( $script_handle );
				wp_enqueue_style( $this->slug . '-style', plugin_dir_url( $this->get_dir() ) . $this->slug . '/css/admin.css', array(), $this::$version );
			}
		}

		/**
		 *
		 *
		 * @param string $path
		 *
		 * @return string
		 */
		public function get_endpoint_url( $path = '' ) {
			return rest_url( $this->slug . $path );
		}

		/**
		 * Register Rest endpoint for requests.
		 */
		public function register_endpoints() {
			register_rest_route( $this->slug, '/import_elementor', array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'import_elementor' ),
				'permission_callback' => function () {
					return current_user_can( 'manage_options' );
				},
			) );
			register_rest_route( $this->slug, '/fetch_templates', array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'fetch_templates' ),
				'permission_callback' => function () {
					return current_user_can( 'manage_options' );
				},
			) );
		}

		/**
		 * Function to fetch templates.
		 *
		 * @return array|bool|\WP_Error
		 */
		public function fetch_templates( \WP_REST_Request $request ) {
			if ( ! current_user_can( 'manage_options' ) ) {
				return false;
			}

			$params = $request->get_params();

			if ( empty ( $params['plugin_slug'] ) ) {
				return false;
			}

			$plugin_slug = $params['plugin_slug'];
			$query_args  = array( 'license' => '', 'url' => get_home_url(), 'name' => $plugin_slug );

			$license = get_option( 'eaw_premium_license_data', '' );

			if ( ! empty ( $license ) ) {
				$license               = isset( $license->key ) ? $license->key : '';
				$query_args['license'] = $license;
				$query_args['_']       = time();
			}
			$url = add_query_arg( $query_args, 'https://themeisle.com/?edd_action=get_templates' );

			$request  = wp_remote_retrieve_body( wp_remote_post( esc_url_raw( $url ) ) );
			$response = json_decode( $request, true );

			if ( ! empty( $response ) ) {
				update_option( $plugin_slug . '_synced_templates', $response );
			}
			die();
		}

		public function filter_templates( $templates ) {
			$current_screen = get_current_screen();
			if ( $current_screen->id === 'orbit-fox_page_obfx_template_dir' ) {
				$fetched = get_option( 'obfx_synced_templates' );
			} else {
				$fetched = get_option( 'sizzify_synced_templates' );
			}
			if ( empty( $fetched ) ) {
				return $templates;
			}
			if ( ! is_array( $fetched ) ) {
				return $templates;
			}
			$new_templates = array_merge( $templates, $fetched['templates'] );

			return $new_templates;
		}

		/**
		 * The templates list.
		 *
		 * @return array
		 */
		public function templates_list() {
			$defaults_if_empty = array(
				'title'            => __( 'A new Orbit Fox Template', 'themeisle-companion' ),
				'screenshot'       => esc_url( 'https://raw.githubusercontent.com/Codeinwp/obfx-templates/master/placeholder.png' ),
				'description'      => __( 'This is an awesome Orbit Fox Template.', 'themeisle-companion' ),
				'demo_url'         => esc_url( 'https://demo.themeisle.com/hestia-pro-demo-content/demo-placeholder/' ),
				'import_file'      => '',
				'required_plugins' => array( 'elementor' => array( 'title' => __( 'Elementor Page Builder', 'themeisle-companion' ) ) ),
			);

			$templates_list = array(
				'about-our-business-elementor' => array(
					'title'       => __( 'About Our Business', 'themeisle-companion' ),
					'description' => __( 'Use this layout to present your business in a fancy way. Add an interactive header, shwocase your services via progress bars, introduce your team members, and locate your headquarters on Google Maps. Last but not least, beautify the design by adding catchy images.', 'themeisle-companion' ),
					'demo_url'    => 'https://demo.themeisle.com/hestia-pro-demo-content/about-our-business-elementor/',
					'screenshot'  => esc_url( $this->get_source_url() . 'about-our-business-elementor/screenshot.png' ),
					'import_file' => esc_url( $this->get_source_url() . 'about-our-business-elementor/template.json' ),
				),
				'contact-us-elementor'         => array(
					'title'       => __( 'Contact Us', 'themeisle-companion' ),
					'description' => __( 'A clean and simple template for your Contact page, where we integrated our Pirate Forms plugin. It will let your customers send you a message using an intuitive form. A Google map, together with a few other details about your business, completes the section.', 'themeisle-companion' ),
					'demo_url'    => 'https://demo.themeisle.com/hestia-pro-demo-content/contact-us-elementor/',
					'screenshot'  => esc_url( $this->get_source_url() . 'contact-us-elementor/screenshot.png' ),
					'import_file' => esc_url( $this->get_source_url() . 'contact-us-elementor/template.json' ),
				),
				'pricing-elementor'            => array(
					'title'       => __( 'Pricing', 'themeisle-companion' ),
					'description' => __( 'If you plan to sell your products online, this layout offers you elegant pricing tables so you can differentiate the features and services for your clients. Also, for a better clarification, the template provides a FAQ area where you can answer people\'s questions.', 'themeisle-companion' ),
					'demo_url'    => 'https://demo.themeisle.com/hestia-pro-demo-content/pricing-elementor/',
					'screenshot'  => esc_url( $this->get_source_url() . 'pricing-elementor/screenshot.png' ),
					'import_file' => esc_url( $this->get_source_url() . 'pricing-elementor/template.json' ),
				),
				'material-homepage-elementor'  => array(
					'title'       => __( 'Material Homepage', 'themeisle-companion' ),
					'description' => __( 'This layout could be your main website homepage (or you can use it as an alternative homepage, if you wish). It was built on material design and comes with call to action, catchy icons, testimonials, blog posts, pricing plans, and other sections that you can add yourself by customizing it.', 'themeisle-companion' ),
					'demo_url'    => 'https://demo.themeisle.com/hestia-pro-demo-content/material-homepage-elementor/',
					'screenshot'  => esc_url( $this->get_source_url() . 'material-homepage-elementor/screenshot.png' ),
					'import_file' => esc_url( $this->get_source_url() . 'material-homepage-elementor/template.json' ),
				),
				'ether-elementor'              => array(
					'title'       => __( 'Ether - Landing Page', 'themeisle-companion' ),
					'description' => __( 'An elegant and modern landing page for e-commerce, coming with a clean interface, beautiful typography, photo galleries, and call to action. If you have an online shop and want to promote a certain product, use this layout to tell people why they should buy it.', 'themeisle-companion' ),
					'demo_url'    => 'https://demo.themeisle.com/hestia-pro-demo-content/ether-elementor/',
					'screenshot'  => esc_url( $this->get_source_url() . 'ether-elementor/screenshot.png' ),
					'import_file' => esc_url( $this->get_source_url() . 'ether-elementor/template.json' ),
				),
				'jason-elementor'              => array(
					'title'       => __( 'Jason - Landing Page', 'themeisle-companion' ),
					'description' => __( 'A classy template for freelancers, where you can put your skills and knowldge in the spotlight for potential clients. Talk about yourself, your projects, awards, and let people contact you easily. The template is designed to feature one-page scrolling.', 'themeisle-companion' ),
					'demo_url'    => 'https://demo.themeisle.com/hestia-pro-demo-content/jason-elementor/',
					'screenshot'  => esc_url( $this->get_source_url() . 'jason-elementor/screenshot.png' ),
					'import_file' => esc_url( $this->get_source_url() . 'jason-elementor/template.json' ),
				),
				'pulse-elementor'              => array(
					'title'       => __( 'Pulse - Landing Page', 'themeisle-companion' ),
					'description' => __( 'A good-looking landing page for products and apps, built to mark the features and services that they offer. The layout provides customer reviews, call to action, beautiful pricing tables, an About section, and a creative design. If you want to promote and sell your brand product, this template might help.', 'themeisle-companion' ),
					'demo_url'    => 'https://demo.themeisle.com/hestia-pro-demo-content/pulse-elementor/',
					'screenshot'  => esc_url( $this->get_source_url() . 'pulse-elementor/screenshot.png' ),
					'import_file' => esc_url( $this->get_source_url() . 'pulse-elementor/template.json' ),
				),
				'ascend-elementor'             => array(
					'title'       => __( 'Ascend - Landing Page', 'themeisle-companion' ),
					'description' => __( 'A resume-like template, built for outdoor enthusiasts and nature lovers. Its design and layout make it flexible for any other purpose too, so do not hesitate to showcase any kind of skills and activities, even business-oriented.', 'themeisle-companion' ),
					'demo_url'    => 'https://demo.themeisle.com/hestia-pro-demo-content/ascend-elementor/',
					'screenshot'  => esc_url( $this->get_source_url() . 'ascend-elementor/screenshot.png' ),
					'import_file' => esc_url( $this->get_source_url() . 'ascend-elementor/template.json' ),
				),
				'path-elementor'               => array(
					'title'       => __( 'Path - Landing Page', 'themeisle-companion' ),
					'description' => __( 'If you are a business consultant - agency or working on your own - have a look at this template! It comes with a clean design, call to action, statistics, and sections that put your services first.', 'themeisle-companion' ),
					'demo_url'    => 'https://demo.themeisle.com/hestia-pro-demo-content/path-elementor/',
					'screenshot'  => esc_url( $this->get_source_url() . 'path-elementor/screenshot.png' ),
					'import_file' => esc_url( $this->get_source_url() . 'path-elementor/template.json' ),
				),
				'mocha-elementor'              => array(
					'title'       => __( 'Mocha - Landing Page', 'themeisle-companion' ),
					'description' => __( 'An elegant and modern template for cafes and pubs, where you can display your menu in a mouth-watering way. Call to action, blog posts, attractive images, tabbed menus, and a catchy design will help you convince more people to stop by.', 'themeisle-companion' ),
					'demo_url'    => 'https://demo.themeisle.com/hestia-pro-demo-content/mocha-elementor/',
					'screenshot'  => esc_url( $this->get_source_url() . 'mocha-elementor/screenshot.png' ),
					'import_file' => esc_url( $this->get_source_url() . 'mocha-elementor/template.json' ),
				),
				'rik-landing'                  => array(
					'title'       => __( 'Rik - Landing Page', 'themeisle-companion' ),
					'description' => __( 'This is a clean Landing page, ready to be used for an app presentation. It features beautiful gradients and great layouts for showcasing your product.', 'themeisle-companion' ),
					'demo_url'    => 'https://demo.themeisle.com/hestia-pro-demo-content/rik-elementor/',
					'screenshot'  => esc_url( $this->get_source_url() . 'rik-elementor/screenshot.jpg' ),
					'import_file' => esc_url( $this->get_source_url() . 'rik-elementor/template.json' ),
				),
				'zelle-lite'                   => array(
					'title'       => __( 'Zelle Lite - One Page Template', 'themeisle-companion' ),
					'description' => __( 'A friendly one-page multipurpose page, with a full-width image in the background. It comes with an elegant and modern design, which could fit very well any kind of business. Zelle Lite has an interactive and colorful interface, with classy parallax effect and lively animations. You can use it for your online shop as well.', 'themeisle-companion' ),
					'demo_url'    => 'https://demo.themeisle.com/hestia-pro-demo-content/zelle-lite/',
					'screenshot'  => esc_url( $this->get_source_url() . 'zelle-lite/screenshot.jpg' ),
					'import_file' => esc_url( $this->get_source_url() . 'zelle-lite/template.json' ),
				),
				'notify'                       => array(
					'title'       => __( 'Notify - Landing Page', 'themeisle-companion' ),
					'description' => __( 'A beautiful landing page to showcase your new application. It has a features section to present your app, a subscribe section where you can also add a video showcasing your new app and a testimonials section so you can present the feedback from your beta testers.', 'themeisle-companion' ),
					'demo_url'    => 'https://demo.themeisle.com/hestia-pro-demo-content/notify-elementor/',
					'screenshot'  => esc_url( $this->get_source_url() . 'notify-elementor/screenshot.jpg' ),
					'import_file' => esc_url( $this->get_source_url() . 'notify-elementor/template.json' ),
				)
			);

			foreach ( $templates_list as $template => $properties ) {
				$templates_list[ $template ] = wp_parse_args( $properties, $defaults_if_empty );
			}

			return apply_filters( 'template_directory_templates_list', $templates_list );
		}

		/**
		 * Register endpoint for themes page.
		 */
		public function demo_listing_register() {
			add_rewrite_endpoint( 'obfx_templates', EP_ROOT );
		}

		/**
		 * Return template preview in customizer.
		 *
		 * @return bool|string
		 */
		public function demo_listing() {
			$flag = get_query_var( 'obfx_templates', false );

			if ( $flag !== '' ) {
				return false;
			}
			if ( ! current_user_can( 'customize' ) ) {
				return false;
			}
			if ( ! is_customize_preview() ) {
				return false;
			}

			return $this->render_view( 'template-directory-render-template' );
		}

		/**
		 * Add the 'Template Directory' page to the dashboard menu.
		 */
		public function add_menu_page() {
			$products = apply_filters( 'obfx_template_dir_products', array() );
			foreach ( $products as $product ) {
				add_submenu_page(
					$product['parent_page_slug'], $product['directory_page_title'], __( 'Template Directory', 'themeisle-companion' ), 'manage_options', $product['page_slug'],
					array( $this, 'render_admin_page' )
				);
			}

		}

		/**
		 * Render the template directory admin page.
		 */
		public function render_admin_page() {
			$data = array(
				'templates_array' => $this->templates_list(),
			);
			echo $this->render_view( 'template-directory-page', $data );
		}

		/**
		 * Utility method to call Elementor import routine.
		 *
		 * @param \WP_REST_Request $request the async request.
		 *
		 * @return string
		 */
		public function import_elementor( \WP_REST_Request $request ) {
			if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
				return 'no-elementor';
			}

			$params        = $request->get_params();
			$template_name = $params['template_name'];
			$template_url  = $params['template_url'];

			require_once( ABSPATH . 'wp-admin' . '/includes/file.php' );
			require_once( ABSPATH . 'wp-admin' . '/includes/image.php' );

			// Mime a supported document type.
			$elementor_plugin = \Elementor\Plugin::$instance;
			$elementor_plugin->documents->register_document_type( 'not-supported', \Elementor\Modules\Library\Documents\Page::get_class_full_name() );

			$template                   = download_url( esc_url( $template_url ) );
			$name                       = $template_name;
			$_FILES['file']['tmp_name'] = $template;
			$elementor                  = new \Elementor\TemplateLibrary\Source_Local;
			$elementor->import_template( $name, $template );
			unlink( $template );

			$args = array(
				'post_type'        => 'elementor_library',
				'nopaging'         => true,
				'posts_per_page'   => '1',
				'orderby'          => 'date',
				'order'            => 'DESC',
				'suppress_filters' => true,
			);

			$query = new \WP_Query( $args );

			$last_template_added = $query->posts[0];
			//get template id
			$template_id = $last_template_added->ID;

			wp_reset_query();
			wp_reset_postdata();

			//page content
			$page_content = $last_template_added->post_content;
			//meta fields
			$elementor_data_meta      = get_post_meta( $template_id, '_elementor_data' );
			$elementor_ver_meta       = get_post_meta( $template_id, '_elementor_version' );
			$elementor_edit_mode_meta = get_post_meta( $template_id, '_elementor_edit_mode' );
			$elementor_css_meta       = get_post_meta( $template_id, '_elementor_css' );

			$elementor_metas = array(
				'_elementor_data'      => ! empty( $elementor_data_meta[0] ) ? wp_slash( $elementor_data_meta[0] ) : '',
				'_elementor_version'   => ! empty( $elementor_ver_meta[0] ) ? $elementor_ver_meta[0] : '',
				'_elementor_edit_mode' => ! empty( $elementor_edit_mode_meta[0] ) ? $elementor_edit_mode_meta[0] : '',
				'_elementor_css'       => $elementor_css_meta,
			);

			// Create post object
			$new_template_page = array(
				'post_type'     => 'page',
				'post_title'    => $template_name,
				'post_status'   => 'publish',
				'post_content'  => $page_content,
				'meta_input'    => $elementor_metas,
				'page_template' => apply_filters( 'template_directory_default_template', 'templates/builder-fullwidth-std.php' )
			);

			$current_theme = wp_get_theme();

			switch ( $current_theme->get_template() ) {
				case 'hestia-pro':
				case 'hestia':
					$new_template_page['page_template'] = 'page-templates/template-pagebuilder-full-width.php';
					break;
				case 'zerif-lite':
				case 'zerif-pro':
					$new_template_page['page_template'] = 'template-fullwidth-no-title.php';
					break;
			}

			$post_id = wp_insert_post( $new_template_page );

			$redirect_url = add_query_arg( array(
				'post'   => $post_id,
				'action' => 'elementor',
			), admin_url( 'post.php' ) );

			return ( $redirect_url );
		}

		/**
		 * Generate action button html.
		 *
		 * @param string $slug plugin slug.
		 *
		 * @return string
		 */
		public function get_button_html( $slug ) {
			$button = '';
			$state  = $this->check_plugin_state( $slug );
			if ( ! empty( $slug ) ) {
				switch ( $state ) {
					case 'install':
						$nonce  = wp_nonce_url(
							add_query_arg(
								array(
									'action' => 'install-plugin',
									'from'   => 'import',
									'plugin' => $slug,
								),
								network_admin_url( 'update.php' )
							),
							'install-plugin_' . $slug
						);
						$button .= '<a data-slug="' . $slug . '" class="install-now obfx-install-plugin button button-primary" href="' . esc_url( $nonce ) . '" data-name="' . $slug . '" aria-label="Install ' . $slug . '">' . __( 'Install and activate', 'themeisle-companion' ) . '</a>';
						break;
					case 'activate':
						$plugin_link_suffix = $slug . '/' . $slug . '.php';
						$nonce              = add_query_arg(
							array(
								'action'   => 'activate',
								'plugin'   => rawurlencode( $plugin_link_suffix ),
								'_wpnonce' => wp_create_nonce( 'activate-plugin_' . $plugin_link_suffix ),
							), network_admin_url( 'plugins.php' )
						);
						$button             .= '<a data-slug="' . $slug . '" class="activate-now button button-primary" href="' . esc_url( $nonce ) . '" aria-label="Activate ' . $slug . '">' . __( 'Activate', 'themeisle-companion' ) . '</a>';
						break;
				}// End switch().
			}// End if().
			return $button;
		}

		/**
		 * Getter method for the source url
		 * @return mixed
		 */
		public function get_source_url() {
			return $this->source_url;
		}

		/**
		 * Setting method for source url
		 *
		 * @param $url
		 */
		protected function set_source_url( $url ) {
			$this->source_url = $url;
		}

		/**
		 * Check plugin state.
		 *
		 * @param string $slug plugin slug.
		 *
		 * @return bool
		 */
		public function check_plugin_state( $slug ) {
			if ( file_exists( WP_CONTENT_DIR . '/plugins/' . $slug . '/' . $slug . '.php' ) || file_exists( WP_CONTENT_DIR . '/plugins/' . $slug . '/index.php' ) ) {
				require_once( ABSPATH . 'wp-admin' . '/includes/plugin.php' );
				$needs = ( is_plugin_active( $slug . '/' . $slug . '.php' ) ||
				           is_plugin_active( $slug . '/index.php' ) ) ?
					'deactivate' : 'activate';

				return $needs;
			} else {
				return 'install';
			}
		}

		/**
		 * If the composer library is present let's try to init.
		 */
		public function load_full_width_page_templates() {
			if ( class_exists( '\ThemeIsle\FullWidthTemplates' ) ) {
				\ThemeIsle\FullWidthTemplates::instance();
			}
		}

		/**
		 * By default the composer library "Full Width Page Templates" comes with two page templates: a blank one and a full
		 * width one with the header and footer inherited from the active theme.
		 * OBFX Template directory doesn't need the blonk one, so we are going to ditch it.
		 *
		 * @param array $list
		 *
		 * @return array
		 */
		public function filter_fwpt_templates_list( $list ) {
			unset( $list['templates/builder-fullwidth.php'] );

			return $list;
		}

		/**
		 * Utility method to render a view from module.
		 *
		 * @codeCoverageIgnore
		 *
		 * @since   1.0.0
		 * @access  protected
		 *
		 * @param   string $view_name The view name w/o the `-tpl.php` part.
		 * @param   array  $args      An array of arguments to be passed to the view.
		 *
		 * @return string
		 */
		protected function render_view( $view_name, $args = array() ) {
			ob_start();
			$file = $this->get_dir() . '/views/' . $view_name . '-tpl.php';
			if ( ! empty( $args ) ) {
				foreach ( $args as $obfx_rh_name => $obfx_rh_value ) {
					$$obfx_rh_name = $obfx_rh_value;
				}
			}
			if ( file_exists( $file ) ) {
				include $file;
			}

			return ob_get_clean();
		}

		/**
		 * Method to return path to child class in a Reflective Way.
		 *
		 * @since   1.0.0
		 * @access  protected
		 * @return string
		 */
		protected function get_dir() {
			return dirname( __FILE__ );
		}

		/**
		 * @static
		 * @since  1.0.0
		 * @access public
		 * @return PageTemplatesDirectory
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
				self::$instance->init();
			}

			return self::$instance;
		}

		/**
		 * Throw error on object clone
		 *
		 * The whole idea of the singleton design pattern is that there is a single
		 * object therefore, we don't want the object to be cloned.
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'themeisle-companion' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function __wakeup() {
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'themeisle-companion' ), '1.0.0' );
		}
	}
}
