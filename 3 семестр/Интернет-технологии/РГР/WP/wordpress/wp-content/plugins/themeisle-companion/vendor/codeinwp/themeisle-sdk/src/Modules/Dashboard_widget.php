<?php
/**
 * The blog dashboard model class for ThemeIsle SDK
 *
 * @package     ThemeIsleSDK
 * @subpackage  Modules
 * @copyright   Copyright (c) 2017, Marius Cristea
 * @license     http://opensource.org/licenses/gpl-3.0.php GNU Public License
 * @since       1.0.0
 */

namespace ThemeisleSDK\Modules;

use ThemeisleSDK\Common\Abstract_Module;
use ThemeisleSDK\Product;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Blog dashboard widget module for ThemeIsle SDK.
 */
class Dashboard_Widget extends Abstract_Module {

	/**
	 * Fetched feeds items.
	 *
	 * @var array Feed items.
	 */
	private $items = array();

	/**
	 * Dashboard widget title.
	 *
	 * @var string $dashboard_name Dashboard name.
	 */
	private $dashboard_name = '';

	/**
	 * Dashboard widget feed sources.
	 *
	 * @var array $feeds Feed url.
	 */
	private $feeds = [];

	/**
	 * Should we load this module.
	 *
	 * @param Product $product Product object.
	 *
	 * @return bool
	 */
	public function can_load( $product ) {
		if ( $this->is_from_partner( $product ) ) {
			return false;
		}

		if ( ! apply_filters( $product->get_slug() . '_load_dashboard_widget', true ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Registers the hooks.
	 *
	 * @param Product $product Product to load.
	 *
	 * @return Dashboard_Widget Module instance.
	 */
	public function load( $product ) {
		if ( apply_filters( 'themeisle_sdk_hide_dashboard_widget', false ) ) {
			return;
		}
		$this->product        = $product;
		$this->dashboard_name = apply_filters( 'themeisle_sdk_dashboard_widget_name', 'WordPress Guides/Tutorials' );
		$this->feeds          = apply_filters(
			'themeisle_sdk_dashboard_widget_feeds',
			[
				'https://themeisle.com/blog/feed',
			]
		);
		add_action( 'wp_dashboard_setup', array( &$this, 'add_widget' ) );
		add_action( 'wp_network_dashboard_setup', array( &$this, 'add_widget' ) );
		add_filter( 'themeisle_sdk_recommend_plugin_or_theme', array( &$this, 'recommend_plugin_or_theme' ) );

		return $this;
	}


	/**
	 * Add widget to the dashboard
	 *
	 * @return string|void
	 */
	function add_widget() {
		global $wp_meta_boxes;
		if ( isset( $wp_meta_boxes['dashboard']['normal']['core']['themeisle'] ) ) {
			return;
		}
		wp_add_dashboard_widget(
			'themeisle',
			$this->dashboard_name,
			[
				$this,
				'render_dashboard_widget',
			]
		);
	}

	/**
	 * Render widget content
	 */
	function render_dashboard_widget() {
		$this->setup_feeds();
		if ( empty( $this->items ) || ! is_array( $this->items ) ) {
			return;
		}
		?>
		<style type="text/css">
			#themeisle ul li.ti-dw-recommend-item {
				padding-left: 7px;
				border-top: 1px solid #eee;
				margin-bottom: 0px;
				padding-top: 6px;
			}

			#themeisle h2.hndle {
				background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEgAAABbCAMAAADncTNAAAAAtFBMVEVHcEyAgIB/f3+xsbGgoaGBgYGCgoKKioqAgIC1tbW5ubnFx8iAgIDU1taBgYGCgoKAgIC0tLXW19jW2NiAgIC3uLiBgYHLzMy4uLhycnLW19d/f3/T1NW0tLTX19mVlZWvr6+BgYHl5eWKiottbW5JSUnW2Nm5ubnh4eHT1NWVlZVjY2N4eHh9fX6pqqq+v79PT0/39/fu7u7Nzc7Z2ttYWFgBAQHDw8P////JysoZGRk0NTZqJc/sAAAAIXRSTlMA0FL7/oEnEPL6eibivm9gwJya76/enFq2CXI+2lFAyM8GATmPAAADj0lEQVR4Xu2YaW/iOhSGAwRCWDosnXa6znjJvm8svf//f12TuARyhiR2pfnUR6gSEnr0+uT4xK7yRb755pvhHePli5K7Bfpkuhoq8ozRJdMH+WWha6Z3sqYparCSLRJqspjImVbANJU03cNMMpofAwQZCGsmpQYyFvVM0Q00OQ9koMl5IPcCoro+RA1Dt2Ea9n9eZ0+YHJLkgIlkDywQx00wCTyaReiKH8LbNU9ybJOdkchV6QFxyCFLbVvdfaREqgUWg/tx2UbqIcK2Hex2TdGLwFTjIj3XP3YfCZFsb23KRZn/3263oymSFI0/a5S4PqUBjoBIJBDjeEhCN0wxQSRybIxtJ3K5SGzuE/vAwIQc8ZmMMJFAIM4oikZItfEFtorGgoE43FObwqHU68OtPCnOz8KZ2Jbl5LgkSW0Tc7YyIz/EFWmS4jMbiZU5mJOmKRaJpKGGyLZtDJh3iyaNUu/3+xyKnrtFL71EG+FTiMpENhQtxUQ8kSOXCIr2tnCNhg/gTX0SHYFp0t7TCwQZ7U841yoHrW6rtGroUwTWVnLMssxx+H4bgZcSOFf5MYx0Ae8FghomMDyC2EBNImBywPkNTDNqGLQpIg2TjUNU8tBy9DQMo0DAZF16rAi7vJAtFTIYFAHUc6hIRW6OuOhJgaCSwmDEAYK4oa7ro+qIEyJU/US7KTJKPNSFT9tFgVFBu0SF1y7yjX4masRA9Da7EFGj28R/BkQz6xGIOurkx38T/bKs9Uk8aIiMwm/Jw0VP1yLrJwt13xAxvABBgsK4KWLov35DkRF7ZaqgzuZ7MQ8MOntmVYyAqKTwaICKqvSUFnVccMN5sziEP/5+xGDTahbH5Q3ZB76zr8fI+nJtvUUU3t3ml5GKviK/npCg3CGodnuJ4JVkfRFJYGVDBZrqKnn9RLf+CzDTS5PaN5J38+auzX4ykU4Qoj0rdKfcYs5ijfo9OL/uRUgZyQr7NCWtWwiUSLc4arfJa7lpszTA1OJZAQ8w8dXFrR5YHzCWSnS3pZ18tOi4Ps4vl/c7i/6qomjRecN+UubrPyPGn/VEMU3T0UFHkaPzpgjxmJsnjmrtionlMDZiog0TsY/DPtn8SXtlBvbtxKtwopy7lqW3smQO+yoGE1Uu55GJ3pmI8ygoejZNnqj0vnIRCyTKfLstRdtStGQi09myUsvwvlkuzSUXbV+Xz5ryBebV33fln/A/moud69FZiEYAAAAASUVORK5CYII=');
				background-repeat: no-repeat;
				background-position: 92% 50%;
				background-size: 25px;
			}

			#themeisle .inside {
				padding: 0;
			}

			.ti-feed-list {
				padding: 0 12px 5px;
				margin-bottom: 10px;
				border-bottom: 1px solid #eee;
			}

			.ti-dw-feed-item a {
				display: flex;
				align-items: center;
				margin-bottom: 5px;
				padding: 5px;
				transition: .2s ease;
				border-radius: 3px;
			}

			.ti-dw-feed-item a:hover {
				background-color: #f8f8f8;
			}

			.ti-dw-feed-item a:hover .ti-dw-date-container {
				opacity: .9;
			}

			.ti-dw-feed-item .ti-dw-month-container {
				margin-top: -5px;
				text-transform: uppercase;
				font-size: 10px;
				letter-spacing: 1px;
				font-weight: 700;
			}

			.ti-dw-feed-item .ti-dw-date-container {
				border-radius: 3px;
				transition: .2s ease;
				min-height: 35px;
				margin-right: 5px;
				min-width: 35px;
				text-align: center;
				border: 1px solid #2a6f97;
				color: #fff;
				background: #2ea2cc;
				display: flex;
				flex-direction: column;
				justify-content: center;
			}

			.ti-dw-footer {
				padding: 0 12px 5px;
				text-align: center;
			}

			.ti-dw-recommend-item {
				display: block;
			}

			.ti-dw-recommend-item span {
				color: #72777c;
			}

			.ti-dw-powered-by {
				font-size: 11px;
				margin-top: 3px;
				display: block;
				color: #72777c;
			}

			.ti-dw-powered-by span {
				font-weight: 600;
			}

		</style>
		<?php do_action( 'themeisle_sdk_dashboard_widget_before', $this->product ); ?>

		<ul class="ti-feed-list">
			<?php

			foreach ( $this->items as $item ) {
				?>
				<li class="ti-dw-feed-item">
					<a href="
						<?php
						echo add_query_arg(
							array(
								'utm_source'   => 'wpadmin',
								'utm_campaign' => 'feed',
								'utm_medium'   => 'dashboard_widget',
							),
							$item['link']
						);
						?>
						" target="_blank">
							<span class="ti-dw-date-container"><span
										class="ti-dw-day-container"><?php echo date( 'd', $item['date'] ); ?></span> <span
										class="ti-dw-month-container"><?php echo substr( date( 'M', $item['date'] ), 0, 3 ); ?></span></span><?php echo $item['title']; ?>
					</a>
				</li>
				<?php
			}
			?>
		</ul>
		<?php
		$recommend = apply_filters( 'themeisle_sdk_recommend_plugin_or_theme', array() );
		if ( ! is_array( $recommend ) || empty( $recommend ) ) {
			return;
		}

		$type = $recommend['type'];

		if ( ( 'theme' === $type && ! current_user_can( 'install_themes' ) ) ) {
			return;
		}
		if ( ( 'plugin' === $type && ! current_user_can( 'install_plugins' ) ) ) {
			return;
		}

		add_thickbox();
		$url = add_query_arg(
			[
				'theme' => $recommend['slug'],
			],
			network_admin_url( 'theme-install.php' )
		);

		if ( 'plugin' === $type ) {

			$url = add_query_arg(
				array(
					'tab'    => 'plugin-information',
					'plugin' => $recommend['slug'],
				),
				network_admin_url( 'plugin-install.php' )
			);
		}
		?>
		<div class="ti-dw-footer">
					<span class="ti-dw-recommend-item ">
							<span class="ti-dw-recommend"><?php echo apply_filters( 'themeisle_sdk_dashboard_popular_label', sprintf( 'Popular %s', ucwords( $type ) ) ); ?>
								: </span>
						<?php
						echo trim(
							str_replace(
								array(
									'lite',
									'Lite',
									'(Lite)',
									'(lite)',
								),
								'',
								$recommend['name']
							)
						);
						?>
						(<a class="thickbox open-plugin-details-modal"
							href="<?php echo $url . '&TB_iframe=true&width=600&height=500'; ?>"><?php echo apply_filters( 'themeisle_sdk_dashboard_install_label', 'Install' ); ?></a>)
					</span>
			<span class="ti-dw-powered-by"><span><?php echo apply_filters( 'themeisle_sdk_dashboard_widget_powered_by', esc_attr( sprintf( 'Powered by %s', $this->product->get_friendly_name() ) ) ); ?></span></span>
		</div>

		<?php

	}

	/**
	 * Setup feed items.
	 */
	private function setup_feeds() {
		if ( false === ( $items_normalized = get_transient( 'themeisle_sdk_feed_items' ) ) ) {
			// Load SimplePie Instance.
			$feed = fetch_feed( $this->feeds );
			// TODO report error when is an error loading the feed.
			if ( is_wp_error( $feed ) ) {
				return;
			}

			$items = $feed->get_items( 0, 5 );
			foreach ( (array) $items as $item ) {
				$items_normalized[] = array(
					'title' => $item->get_title(),
					'date'  => $item->get_date( 'U' ),
					'link'  => $item->get_permalink(),
				);
			}
			set_transient( 'themeisle_sdk_feed_items', $items_normalized, 48 * HOUR_IN_SECONDS );
		}
		$this->items = $items_normalized;
	}

	/**
	 * Either the current product is installed or not.
	 *
	 * @param array $val The current recommended product.
	 *
	 * @return bool Either we should exclude the plugin or not.
	 */
	public function remove_current_products( $val ) {
		if ( 'theme' === $val['type'] ) {
			$exist = wp_get_theme( $val['slug'] );

			return ! $exist->exists();
		} else {
			$all_plugins = array_keys( get_plugins() );
			foreach ( $all_plugins as $slug ) {
				if ( strpos( $slug, $val['slug'] ) !== false ) {
					return false;
				}
			}

			return true;
		}
	}

	/**
	 * Contact the API and fetch the recommended plugins/themes
	 */
	function recommend_plugin_or_theme() {
		$products = $this->get_product_from_api();
		if ( ! is_array( $products ) ) {
			$products = array();
		}
		$products = array_filter( $products, array( $this, 'remove_current_products' ) );
		$products = array_merge( $products );
		if ( count( $products ) > 1 ) {
			shuffle( $products );
			$products = array_slice( $products, 0, 1 );
		}
		$to_recommend = isset( $products[0] ) ? $products[0] : $products;

		return $to_recommend;
	}

	/**
	 * Fetch products from the recomended section.
	 *
	 * @return array|mixed The list of products to use in recomended section.
	 */
	function get_product_from_api() {
		if ( false === ( $products = get_transient( 'themeisle_sdk_products' ) ) ) {
			$products                = array();
			$all_themes              = $this->get_themes_from_wporg( 'themeisle' );
			$all_plugins             = $this->get_plugins_from_wporg( 'themeisle' );
			static $allowed_products = [
				'hestia'              => true,
				'neve'                => true,
				'visualizer'          => true,
				'feedzy-rss-feeds'    => true,
				'wp-product-review'   => true,
				'otter-blocks'        => true,
				'themeisle-companion' => true,
			];
			foreach ( $all_themes as $theme ) {
				if ( $theme->active_installs < 4999 ) {
					continue;
				}
				if ( ! isset( $allowed_products[ $theme->slug ] ) ) {
					continue;
				}
				$products[] = array(
					'name'     => $theme->name,
					'type'     => 'theme',
					'slug'     => $theme->slug,
					'installs' => $theme->active_installs,
				);
			}
			foreach ( $all_plugins as $plugin ) {
				if ( $plugin->active_installs < 4999 ) {
					continue;
				}
				if ( ! isset( $allowed_products[ $plugin->slug ] ) ) {
					continue;
				}
				$products[] = array(
					'name'     => $plugin->name,
					'type'     => 'plugin',
					'slug'     => $plugin->slug,
					'installs' => $plugin->active_installs,
				);
			}
			set_transient( 'themeisle_sdk_products', $products, 6 * HOUR_IN_SECONDS );
		}

		return $products;
	}

	/**
	 * Fetch themes from wporg api.
	 *
	 * @param string $author The author name.
	 *
	 * @return array The list of themes.
	 */
	function get_themes_from_wporg( $author ) {
		$products = wp_remote_get(
			'https://api.wordpress.org/themes/info/1.1/?action=query_themes&request[author]=' . $author . '&request[per_page]=30&request[fields][active_installs]=true'
		);
		$products = json_decode( wp_remote_retrieve_body( $products ) );
		if ( is_object( $products ) ) {
			$products = isset( $products->themes ) ? $products->themes : array();
		} else {
			$products = array();
		}

		return (array) $products;
	}

	/**
	 * Fetch plugin from wporg api.
	 *
	 * @param string $author The author slug.
	 *
	 * @return array The list of plugins for the selected author.
	 */
	function get_plugins_from_wporg( $author ) {
		$products = wp_remote_get(
			'https://api.wordpress.org/plugins/info/1.1/?action=query_plugins&request[author]=' . $author . '&request[per_page]=40&request[fields][active_installs]=true'
		);
		$products = json_decode( wp_remote_retrieve_body( $products ) );
		if ( is_object( $products ) ) {
			$products = isset( $products->plugins ) ? $products->plugins : array();
		} else {
			$products = array();
		}

		return (array) $products;
	}
}
