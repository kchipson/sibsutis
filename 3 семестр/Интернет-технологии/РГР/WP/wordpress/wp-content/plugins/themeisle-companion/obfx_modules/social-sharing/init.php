<?php
/**
 * Social Sharing Core Orbit Fox Module.
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    Social_Sharing_OBFX_Module
 */

/**
 * The class defines a new module to be used by Orbit Fox plugin.
 *
 * @package    Social_Sharing_OBFX_Module
 * @author     Themeisle <friends@themeisle.com>
 * @codeCoverageIgnore
 */
class Social_Sharing_OBFX_Module extends Orbit_Fox_Module_Abstract {

	private $social_share_links = array();

	/**
	 * Social_Sharing_OBFX_Module  constructor.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function __construct() {
		parent::__construct();
		$this->name               = __( 'Social Sharing Module', 'themeisle-companion' );
		$this->description        = sprintf( __( 'Add basic social sharing to your posts and pages. Check out the %s to learn more!', 'themeisle-companion' ), sprintf( '<a href="https://demo.themeisle.com/orbit-fox/2018/01/15/social-sharing-modules/" rel="nofollow" target="_blank">%s</a>', __( 'demo', 'themeisle-companion' ) ) );
	}

	/**
	 * Define the array that contains the social networks.
	 */
	private function define_networks() {
    	$post_categories = strip_tags( get_the_category_list( ',' ) );
		$post_title = get_the_title();
		$post_link = get_the_permalink();

		$this->social_share_links = array(
			'facebook'  => array(
				'link'     => 'https://www.facebook.com/sharer.php?u=' . $post_link,
				'nicename' => 'Facebook',
				'icon'     => 'facebook',
			),
			'twitter'   => array(
				'link'     => 'https://twitter.com/intent/tweet?url=' . $post_link . '&text=' . $post_title . '&hashtags=' . $post_categories,
				'nicename' => 'Twitter',
				'icon'     => 'twitter',
			),
			'g-plus'    => array(
				'link'     => 'https://plus.google.com/share?url=' . $post_link,
				'nicename' => 'Google Plus',
				'icon'     => 'googleplus',
			),
			'pinterest' => array(
				'link'     => 'https://pinterest.com/pin/create/bookmarklet/?media=' . get_the_post_thumbnail_url() . '&url=' . $post_link . '&description=' . $post_title,
				'nicename' => 'Pinterest',
				'icon'     => 'pinterest',
			),
			'linkedin'  => array(
				'link'     => 'https://www.linkedin.com/shareArticle?url=' . $post_link . '&title=' . $post_title,
				'nicename' => 'LinkedIn',
				'icon'     => 'linkedin',
			),
			'tumblr'    => array(
				'link'     => 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=' . $post_link . '&title=' . $post_title,
				'nicename' => 'Tumblr',
				'icon'     => 'tumblr',
			),
			'reddit'    => array(
				'link'     => 'https://reddit.com/submit?url=' . $post_link . '&title=' . $post_title,
				'nicename' => 'Reddit',
				'icon'     => 'reddit',
			),
			'whatsapp'     => array(
				'link'     => 'whatsapp://send?text=' . $post_link,
				'nicename' => 'WhatsApp',
				'icon'     => 'whatsapp',
				'target'   => '0',
			),
			'mail'     => array(
				'link'     => 'mailto:?&subject=' . $post_title . '&body=' . $post_link,
				'nicename' => 'Email',
				'icon'     => 'mail',
				'target'   => '0'
			),
			'sms'     => array(
				'link'     => 'sms://?&body=' . $post_title . ' - ' . $post_link,
				'nicename' => 'SMS',
				'icon'     => 'viber',
				'target'   => '0',
			),
			'vk'        => array(
				'link'     => 'http://vk.com/share.php?url=' . $post_link,
				'nicename' => 'VKontakte',
				'icon'     => 'vkontakte',
			),
			'okru'      => array(
				'link'     => 'https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&st.shareUrl=' . $post_link . '&title=' . $post_title,
				'nicename' => 'OK.ru',
				'icon'     => 'odnoklassniki',
			),
			'douban'    => array(
				'link'     => 'http://www.douban.com/recommend/?url=' . $post_link . '&title=' . $post_title,
				'nicename' => 'Douban',
				'icon'     => 'douban',
			),
			'baidu'     => array(
				'link'     => 'http://cang.baidu.com/do/add?it=' . $post_title . '&iu=' . $post_link,
				'nicename' => 'Baidu',
				'icon'     => 'baidu',
			),
			'xing'      => array(
				'link'     => 'https://www.xing.com/app/user?op=share&url=' . $post_link,
				'nicename' => 'Xing',
				'icon'     => 'xing',
			),
			'renren'    => array(
				'link'     => 'http://widget.renren.com/dialog/share?resourceUrl=' . $post_link . '&srcUrl=' . $post_link . '&title=' . $post_title,
				'nicename' => 'RenRen',
				'icon'     => 'renren',
			),
			'weibo'     => array(
				'link'     => 'http://service.weibo.com/share/share.php?url=' . $post_link . '&appkey=&title=' . $post_title . '&pic=&ralateUid=',
				'nicename' => 'Weibo',
				'icon'     => 'weibo',
			),
		);
	}

	/**
	 * Determine if module should be loaded.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return bool
	 */
	public function enable_module() {
		return true;
	}

	/**
	 * The loading logic for the module.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function load() {
    }

    /**
     * Method to define hooks needed.
     *
     * @since   1.0.0
     * @access  public
     * @return mixed | array
     */
    public function hooks() {
	    $this->loader->add_filter('kses_allowed_protocols', $this, 'custom_allowed_protocols', 1000 );

	    if( $this -> get_option( 'socials_position' ) == 2 ) {
		    $this->loader->add_filter('hestia_filter_blog_social_icons', $this, 'social_sharing_function' );
		    return true;
	    }
	    $this->loader->add_action('wp_footer', $this, 'social_sharing_function' );
    }

	/**
     * Display method for the Social Sharing.
     *
     * @since   1.0.0
     * @access  public
     */
    public function social_sharing_function() {
        if ( ( $this->get_option('display_on_posts') && is_single() ) || ( $this->get_option('display_on_pages') && is_page() ) ) {
        	$class_desktop = 'obfx-sharing-left ';
        	switch ( $this->get_option( 'socials_position' ) ) {
		        case '1':
			        $class_desktop = 'obfx-sharing-right ';
			        break;
		        case '2':
		        	$class_desktop = 'obfx-sharing-inline ';
	        }

	        $class_mobile = '';
        	if( $this->get_option( 'mobile_position' ) == '0' ) {
	            $class_mobile = 'obfx-sharing-bottom';
	        }
		    $data = array(
		    	'desktop_class' => $class_desktop,
		    	'mobile_class'  => $class_mobile,
		    	'show_name' => $this->get_option( 'network_name' ),
		    	'social_links_array' => $this->social_links_array(),
		    );

	        if( $this -> get_option( 'socials_position' ) == 2 ) {
	            return $this->render_view( 'hestia-social-sharing', $data );
	        }
		        echo $this->render_view( 'social-sharing', $data );
	    }
    }

	/**
	 * Create the social links array to be passed to the front end view.
	 *
	 * @since   1.0.0
	 * @access  private
	 * @return array
	 */
    private function social_links_array() {
    	$social_links = array();
		foreach ( $this->social_share_links as $network => $network_links ) {
			if( $this->get_option( $network ) ) {
				$social_links[ $network ] = $network_links;
				$social_links[ $network ][ 'show_mobile' ] = $this->get_option( $network . '-mobile-show' );
				$social_links[ $network ][ 'show_desktop' ] = $this->get_option( $network . '-desktop-show' );
			}
		}
	    return $social_links;
    }

    /**
     * Add extra protocols to list of allowed protocols.
     *
	 * @param array $protocols List of protocols from core.
     *
     * @return array Updated list including extra protocols added.
     */
    public function custom_allowed_protocols( $protocols ){
    	$protocols[] = 'whatsapp';
	    $protocols[] = 'sms';
	    return $protocols;
    }

	/**
	 * Method that returns an array of scripts and styles to be loaded
	 * for the front end part.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array
	 */
	public function public_enqueue() {
		$data = get_option( 'obfx_data' );
		$display_on_posts = true;
		$display_on_pages = false;
		if( isset( $data['module_settings']) && isset( $data['module_settings']['social-sharing']) ){
			if( isset( $data['module_settings']['social-sharing']['display_on_posts'] ) ){
				$display_on_posts = (bool)$data['module_settings']['social-sharing']['display_on_posts'];
			}
			if( isset( $data['module_settings']['social-sharing']['display_on_pages'] ) ){
				$display_on_pages = (bool)$data['module_settings']['social-sharing']['display_on_pages'];
			}
		}

		if( ( $display_on_posts === false || ! is_single() ) && ( $display_on_pages === false || ! is_page() ) ) {
			return array();
		}

	    return array(
		    'css' => array(
				'public' => false,
				'vendor/socicon/socicon' => false,
		    ),
		    'js' => array(
				'public' => array( 'jquery' ),
		    ),
	    );
	}

	/**
	 * Method that returns an array of scripts and styles to be loaded
	 * for the admin part.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array
	 */
	public function admin_enqueue() {

		$current_screen = get_current_screen();
		if ( ! isset( $current_screen->id ) ) {
			return array();
		}
		if ( $current_screen->id != 'toplevel_page_obfx_companion' ) {
			return array();
		}

		return array(
			'css' => array(
				'admin' => false,
				'vendor/socicon/socicon' => false,
			),
			'js' => array(
				'admin' => array( 'jquery' ),
			),
		);
	}

	/**
	 * Method to define the options fields for the module
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array
	 */
	public function options() {
		$options = array(
			array(
				'id'      => 'display_on_posts',
				'title'   => 'Display On',
				'name'    => 'display_on_posts',
				'type'    => 'checkbox',
				'label'   => 'Posts',
				'class'   => 'inline-setting',
				'default' => '1',
			),
			array(
				'id'      => 'display_on_pages',
				'title'   => '',
				'name'    => 'display_on_pages',
				'type'    => 'checkbox',
				'label'   => 'Pages',
				'class'   => 'inline-setting',
				'default' => '0',
			),
			array(
				'id'      => 'socials_position',
				'title'   => 'Desktop Position',
				'name'    => 'socials_position',
				'type'    => 'radio',
				'options' => array(
					'0' => 'Left',
					'1' => 'Right',
				),
				'default' => '0',
			),
			array(
				'id'      => 'mobile_position',
				'name'    => 'mobile_position',
				'title'   => 'Mobile Position',
				'type'    => 'radio',
				'options' => array(
					'0' => 'Pinned to bottom',
					'1' => 'Same as desktop',
				),
				'default' => '1',
			),
			array(
				'id'      => 'network_name',
				'name'    => 'network_name',
				'title'   => 'Show name',
				'type'    => 'toggle',
				'label'   => 'Show network name on hover',
				'default' => '0',
			),
		);

		$this->define_networks();

		foreach ( $this->social_share_links as $network => $data_array ) {
			$options[] = array(
				'before_wrap' => '<div class="obfx-row">',
				'title'       => ( $network == 'facebook' ) ? 'Networks' : '',
				'id'          => $network,
				'name'        => $network,
				'label'       => '<i class="socicon-' . $data_array['icon'] . '"></i>  - ' . $data_array['nicename'],
				'type'        => 'toggle',
				'default'     => ( $network == 'facebook' ) ? '1' : '',
				'class'       => 'inline-setting network-toggle',
			);

			$options[] = array(
				'title'   => ( $network == 'facebook' ) ? 'Show on' : '',
				'id'      => $network . '-desktop-show',
				'name'    => $network . '-desktop-show',
				'label'   => 'desktop',
				'type'    => 'checkbox',
				'default' => '1',
				'class'   => 'inline-setting show',
			);

			$options[] = array(
				'id'         => $network . '-mobile-show',
				'name'       => $network . '-mobile-show',
				'label'      => 'mobile',
				'type'       => 'checkbox',
				'default'    => '1',
				'class'      => 'inline-setting show last',
				'after_wrap' => '</div>',
			);
		}

		$options = $this->add_hestia_options( $options );

		return $options;
	}

	/**
	 * Add hestia options.
	 */
	private function add_hestia_options( $options ) {
		if( defined( 'HESTIA_VERSION' ) ) {
			$option_id = $this->search_for_id( 'socials_position', $options );
			$options[$option_id]['options']['2'] = 'Inline after content';
		}
		return $options;
	}

	/**
	 * Search for module option by id.
	 *
	 * @param $index
	 *
	 * @return int|null|string
	 */
	private function search_for_id( $index, $options ) {
		foreach ( $options as $key => $val ) {
			if ( $val['id'] === $index ) {
				return $key;
			}
		}
		return null;
	}

}
