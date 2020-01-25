<?php
/**
 * Theme customizer
 *
 * @package ONUM
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ONUM_Customize {
	/**
	 * Customize settings
	 *
	 * @var array
	 */
	protected $config = array();

	/**
	 * The class constructor
	 *
	 * @param array $config
	 */
	public function __construct( $config ) {
		$this->config = $config;

		if ( ! class_exists( 'Kirki' ) ) {
			return;
		}

		$this->register();
	}

	/**
	 * Register settings
	 */
	public function register() {

		/**
		 * Add the theme configuration
		 */
		if ( ! empty( $this->config['theme'] ) ) {
			Kirki::add_config(
				$this->config['theme'], array(
					'capability'  => 'edit_theme_options',
					'option_type' => 'theme_mod',
				)
			);
		}

		/**
		 * Add panels
		 */
		if ( ! empty( $this->config['panels'] ) ) {
			foreach ( $this->config['panels'] as $panel => $settings ) {
				Kirki::add_panel( $panel, $settings );
			}
		}

		/**
		 * Add sections
		 */
		if ( ! empty( $this->config['sections'] ) ) {
			foreach ( $this->config['sections'] as $section => $settings ) {
				Kirki::add_section( $section, $settings );
			}
		}

		/**
		 * Add fields
		 */
		if ( ! empty( $this->config['theme'] ) && ! empty( $this->config['fields'] ) ) {
			foreach ( $this->config['fields'] as $name => $settings ) {
				if ( ! isset( $settings['settings'] ) ) {
					$settings['settings'] = $name;
				}

				Kirki::add_field( $this->config['theme'], $settings );
			}
		}
	}

	/**
	 * Get config ID
	 *
	 * @return string
	 */
	public function get_theme() {
		return $this->config['theme'];
	}

	/**
	 * Get customize setting value
	 *
	 * @param string $name
	 *
	 * @return bool|string
	 */
	public function get_option( $name ) {

		$default = $this->get_option_default( $name );

		return get_theme_mod( $name, $default );
	}

	/**
	 * Get default option values
	 *
	 * @param $name
	 *
	 * @return mixed
	 */
	public function get_option_default( $name ) {
		if ( ! isset( $this->config['fields'][ $name ] ) ) {
			return false;
		}

		return isset( $this->config['fields'][ $name ]['default'] ) ? $this->config['fields'][ $name ]['default'] : false;
	}
}

/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function onum_get_option( $name ) {
	global $onum_customize;

	$value = false;

	if ( class_exists( 'Kirki' ) ) {
		$value = Kirki::get_option( 'onum', $name );
	} elseif ( ! empty( $onum_customize ) ) {
		$value = $onum_customize->get_option( $name );
	}

	return apply_filters( 'onum_get_option', $value, $name );
}

/**
 * Get default option values
 *
 * @param $name
 *
 * @return mixed
 */
function onum_get_option_default( $name ) {
	global $onum_customize;

	if ( empty( $onum_customize ) ) {
		return false;
	}

	return $onum_customize->get_option_default( $name );
}

/**
 * Move some default sections to `general` panel that registered by theme
 *
 * @param object $wp_customize
 */
function onum_customize_modify( $wp_customize ) {
	$wp_customize->get_section( 'title_tagline' )->panel     = 'general';
	$wp_customize->get_section( 'static_front_page' )->panel = 'general';
}

add_action( 'customize_register', 'onum_customize_modify' );


/**
 * Get customize settings
 *
 * Priority (Order) WordPress Live Customizer default: 
 * @link https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @return array
 */
function onum_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'onum',
	);

	$panels = array(
		'general'     	=> array(
			'priority' 		=> 5,
			'title'    		=> esc_html__( 'General', 'onum' ),
		),
		'header'        => array(
			'title'      	=> esc_html__( 'Header', 'onum' ),
			'priority'   	=> 9,
			'capability' 	=> 'edit_theme_options',
		),
		'blog'        	=> array(
			'title'      	=> esc_html__( 'Blog', 'onum' ),
			'priority'   	=> 10,
			'capability' 	=> 'edit_theme_options',
		),
	);

	$sections = array(
		//Header
		'main_header'           => array(
            'title'       => esc_html__( 'General', 'onum' ),
            'description' => '',
            'priority'    => 15,
            'capability'  => 'edit_theme_options',
            'panel'       => 'header',
        ),
		'topbar_header'           => array(
			'title'       => esc_html__( 'Top Bar', 'onum' ),
			'description' => '',
			'priority'    => 16,
			'capability'  => 'edit_theme_options',
			'panel'       => 'header',
		),
        'logo_header'           => array(
            'title'       => esc_html__( 'Logos', 'onum' ),
            'description' => '',
            'priority'    => 17,
            'capability'  => 'edit_theme_options',
            'panel'       => 'header',
        ),
        'menu_header'           => array(
            'title'       => esc_html__( 'Menus', 'onum' ),
            'description' => '',
            'priority'    => 18,
            'capability'  => 'edit_theme_options',
            'panel'       => 'header',
        ),
        'cta_header'           => array(
            'title'       => esc_html__( 'Call To Action', 'onum' ),
            'description' => '',
            'priority'    => 19,
            'capability'  => 'edit_theme_options',
            'panel'       => 'header',
        ),
	    'header_styling'  => array(
			'title'       => esc_html__( 'Styling', 'onum' ),
			'description' => '',
			'priority'    => 20,
			'capability'  => 'edit_theme_options',
			'panel'       => 'header',
		),

		//Page Header
		'page_header'     => array(
            'title'       => esc_html__( 'Page Header', 'onum' ),
            'description' => '',
            'priority'    => 9,
            'capability'  => 'edit_theme_options',
        ),

        // Footer
	    'footer'         => array(
			'title'      => esc_html__( 'Footer', 'onum' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		),

	    //Blog
		'blog_page'           => array(
			'title'       => esc_html__( 'Blog Page', 'onum' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
        'single_post'           => array(
			'title'       => esc_html__( 'Single Post', 'onum' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),

		//Project
		'portfolio_page'           => array(
			'title'       => esc_html__( 'Portfolios', 'onum' ),
			'description' => '',
			'priority'    => 10,
			'capability'  => 'edit_theme_options',			
		),

		//Typography
		'typography'           => array(
            'title'       => esc_html__( 'Typography', 'onum' ),
            'description' => '',
            'priority'    => 15,
            'capability'  => 'edit_theme_options',
        ),

	    //Color Scheme
		'color_scheme'   => array(
			'title'      => esc_html__( 'Color Scheme', 'onum' ),
			'priority'   => 200,
			'capability' => 'edit_theme_options',
		),
	);

	$fields = array(
		/* Header TopBar */
		'topbar_switch'     => array(
			'type'        => 'toggle',
			'label'       => esc_attr__( 'Top Bar On/Off', 'onum' ),
			'section'     => 'topbar_header',
			'default'     => 1,
			'priority'    => 1,
		),

		// Topbar Menu
		'topbar_menu'     => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Menu', 'onum' ), 
	 		'description' => esc_attr__( 'Choose a menu to show on topbar here.', 'onum' ), 
	 		'section'     => 'topbar_header', 
	 		'default'     => '', 
	 		'priority'    => 1,
	 		'placeholder' => esc_attr__( 'Select a menu', 'onum' ),  
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_terms( 'nav_menu', array( 'hide_empty' => true ) ) : array(),
		),

		// Header Contact Info
		'info_separator'     => array(
			'type'        => 'custom',
			'label'       => '',
			'section'     => 'topbar_header',
			'default'     => '<hr>',
			'priority'    => 2,
		),
		'info_switch'     => array(
			'type'        => 'toggle',
			'label'       => esc_attr__( 'Contact Info On/Off', 'onum' ),
			'section'     => 'topbar_header',
			'default'     => 1,
			'priority'    => 3,
		),
		'header_contact_info'     => array(
			'type'     => 'repeater',
			'label'    => esc_html__( 'Contact Info', 'onum' ),
			'section'  => 'topbar_header',
			'priority' => 4,
			'active_callback' => array(
				array(
					'setting'  => 'info_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
			'row_label' => array(
				'type' => 'field',
				'value' => esc_attr__('Contact Info', 'onum' ),
				'field' => 'info_name',
			),
			'default'  => array(),
			'fields'   => array(
				'info_name' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Contact info name', 'onum' ),
					'description' => esc_html__( 'This will be the contact info name', 'onum' ),
					'default'     => '',
				),
				'info_icon' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Icon class name', 'onum' ),
					'description' => esc_html__( 'This will be the contact info icon: https://fontawesome.com/icons?d=gallery , ex: fas fa-phone', 'onum' ),
					'default'     => '',
				),
				'info_content' => array(
					'type'        => 'textarea',
					'label'       => esc_html__( 'Contact info content', 'onum' ),
					'description' => esc_html__( 'This will be the contact info content', 'onum' ),
					'default'     => '',
				),				
			),
		),

		// Header Social
		'social_separator'     => array(
			'type'        => 'custom',
			'label'       => '',
			'section'     => 'topbar_header',
			'default'     => '<hr>',
			'priority'    => 5,
		),
		'social_switch'     => array(
			'type'        => 'toggle',
			'label'       => esc_attr__( 'Social Network On/Off', 'onum' ),
			'section'     => 'topbar_header',
			'default'     => 1,
			'priority'    => 6,
		),
		'header_socials'     => array(
			'type'     => 'repeater',
			'label'    => esc_html__( 'Socials Network', 'onum' ),
			'section'  => 'topbar_header',
			'priority' => 7,
			'active_callback' => array(
				array(
					'setting'  => 'social_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
			'row_label' => array(
				'type' => 'field',
				'value' => esc_attr__('social', 'onum' ),
				'field' => 'social_name',
			),
			'default'  => array(),
			'fields'   => array(
				'social_name' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Social network name', 'onum' ),
					'description' => esc_html__( 'This will be the social network name', 'onum' ),
					'default'     => '',
				),
				'social_icon' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Icon class name', 'onum' ),
					'description' => esc_html__( 'This will be the social icon: https://fontawesome.com/icons?d=gallery , ex: fab fa-facebook', 'onum' ),
					'default'     => '',
				),
				'social_link' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Link url', 'onum' ),
					'description' => esc_html__( 'This will be the social link', 'onum' ),
					'default'     => '',
				),
			),
		),
		'social_target_link'    => array(
			'type'        => 'select',
			'label'       => esc_attr__( 'HTML a target Attribute for Socials.', 'onum' ),
			'section'     => 'topbar_header',
			'default'     => '_self',
			'priority'    => 8,
			'multiple'    => 1,
			'active_callback' => array(
				array(
					'setting'  => 'social_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
			'choices'     => array(
				'_self' => esc_attr__( 'Same Frame', 'onum' ),
				'_blank' => esc_attr__( 'New Window', 'onum' ),
			),
		),

		/* Main Header */
		'header_layout'    => array(
            'type'        => 'radio-image',
            'label'       => esc_attr__( 'Header Layout', 'onum' ),
            'section'     => 'main_header',
            'default'     => 'header1',
            'priority'    => 1,
            'multiple'    => 1,
            'choices'     => array(
                'header1' => get_template_directory_uri() . '/inc/backend/images/header1.png',
                'header2' => get_template_directory_uri() . '/inc/backend/images/header2.png',
				'header3' => get_template_directory_uri() . '/inc/backend/images/header3.png',
            ),
        ),        
        'header_homepage'    => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Header transparent for homepage only?', 'onum' ),
			'section'     => 'main_header',
			'default'     => '0',
			'priority'    => 2,
        ), 
        'header_width'    => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Header Width: Wide/Boxes', 'onum' ),
			'section'     => 'main_header',
			'default'     => '1',
			'priority'    => 2,
        ),    
        'header_spacing' => array(
            'type'     => 'dimensions',
            'label'    => esc_html__( 'Header Padding (ex: 10px)', 'onum' ),
            'section'  => 'main_header',
            'priority' => 3,
            'default'  => array(
                'padding-left'   => '',
				'padding-right'  => '',
            ),
            'choices'     => array(
				'labels' => array(
					'padding-left' => esc_html__( 'Padding Left', 'onum' ),
					'padding-right' => esc_html__( 'Padding Right', 'onum' ),
				),
			),           
			'active_callback' => array(
				array(
					'setting'  => 'header_width',
					'operator' => '==',
					'value'    => '1',
				),
			), 
			'output'    => array(
                array(
                    'element'  => '.header-fullwidth .octf-area-wrap'
                ),
            ),
        ),
        'header_desktop_sticky'        => array(
            'type'     => 'toggle',
            'label'    => esc_html__( 'Sticky Header', 'onum' ),
            'section'  => 'main_header',
            'default'  => '1',
            'priority' => 4,
        ),
        'header_mobile_sticky' => array(
            'type'     => 'toggle',
            'label'    => esc_html__( 'Sticky Header On Mobile', 'onum' ),
            'section'  => 'main_header',
            'default'  => '0',
            'priority' => 5,
            'active_callback' => array(
				array(
					'setting'  => 'header_desktop_sticky',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),        

        /* Call To Action Header */
        'search_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Search Button On/Off', 'onum' ),
            'section'     => 'cta_header',
            'default'     => 0,
            'priority'    => 1,
        ),      
        'cart_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Cart Button On/Off', 'onum' ),
            'section'     => 'cta_header',
            'default'     => 0,
            'priority'    => 2,
        ),          
        'separator_ctahead'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'cta_header',
            'default'     => '<hr>',
            'priority'    => 3,
        ),  
        'header_cta_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Call To Action Button On/Off', 'onum' ),
            'section'     => 'cta_header',
            'default'     => 0,
            'priority'    => 4,
        ),  
        'cta_text_header'    => array(
            'type'     => 'text',
            'label'    => esc_html__( 'CTA Button Text', 'onum' ),
            'section'  => 'cta_header',
            'default'  => '',
            'priority' => 5,            
            'active_callback' => array(
				array(
					'setting'  => 'header_cta_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),
        'cta_link_header'    => array(
            'type'     => 'link',
            'label'    => esc_html__( 'CTA Button Link', 'onum' ),
            'section'  => 'cta_header',
            'default'  => '',
            'priority' => 6,            
            'active_callback' => array(
				array(
					'setting'  => 'header_cta_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),
        'cta_bgcolor_header'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'CTA Button Background Color', 'onum' ),
            'section'  => 'cta_header',
            'default'  => '',
            'priority' => 7,
            'output'    => array(
                array(
                    'element'  => '.site-header .btn-cta-header a, .site-header .btn-cta-header a:visited, .site-header .btn-cta-header a:focus, .site-header .btn-cta-header a:hover',
                    'property' => 'background'
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_cta_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),
        'cta_textcolor_header'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'CTA Button Text Color', 'onum' ),
            'section'  => 'cta_header',
            'default'  => '',
            'priority' => 8,
            'output'    => array(
                array(
                    'element'  => '.site-header .btn-cta-header a, .site-header .btn-cta-header a:visited, .site-header .btn-cta-header a:focus, .site-header .btn-cta-header a:hover',
                    'property' => 'color'
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'header_cta_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),
        'cta_box_shadow_header'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'CTA Button box-shadow color', 'onum' ),
            'section'  => 'cta_header',
            'default'  => '',
            'priority' => 9,
            'active_callback' => array(
				array(
					'setting'  => 'header_cta_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),     

		/* Header Logos Setting */
		'logo'         => array(
			'type'     => 'image',
			'label'    => esc_attr__( 'Upload Your Static Logo Image on Header Static (.jpg, .png, .svg)', 'onum' ),
			'section'  => 'logo_header',
			'default'  => trailingslashit( get_template_directory_uri() ) . 'images/logo.svg',
			'priority' => 2,
		),
		'logo_scroll'  => array(
			'type'     => 'image',
			'label'    => esc_attr__( 'Upload Your Logo Image on Header Scroll (.jpg, .png, .svg)', 'onum' ),
			'section'  => 'logo_header',
			'default'  => trailingslashit( get_template_directory_uri() ) . 'images/logo-dark.svg',
			'priority' => 3,
		),
        'logo_width'   => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Logo Width(px)', 'onum' ),
            'section'  => 'logo_header',
            'priority' => 4,
            'default'  => '',
            'output'    => array(
                array(
                    'element'  => '#site-logo a img',
                    'property' => 'width',
                    'units'	   => 'px'
                ),
            ),
        ),
        'logo_height'  => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Logo Height(px)', 'onum' ),
            'section'  => 'logo_header',
            'priority' => 5,
            'default'  => '',
            'output'    => array(
                array(
                    'element'  => '#site-logo a img',
                    'property' => 'height',
                    'units'	   => 'px'
                ),
            ),
        ),
        'logo_spacing' => array(
            'type'     => 'dimensions',
            'label'    => esc_html__( 'Logo Margin (ex: 10px)', 'onum' ),
            'section'  => 'logo_header',
            'priority' => 6,
            'default'  => array(
                'top'    => '30px',
                'bottom' => '30px',
                'left'   => '0',
                'right'  => '0',
            ),
            'output'    => array(
                array(
                    'element'  => '#site-logo',
                    'property' => 'padding',
                    'units'	   => 'px'
                ),
            ),
        ),

		//Header Styling  
        'bg_topbar'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Top Bar Background Color', 'onum' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 1,
            'output'    => array(
                array(
                    'element'  => '.header-topbar',
                    'property' => 'background'
                ),
            ),
        ),        
        'color_topbar'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Top Bar Text Color', 'onum' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 2,
            'output'    => array(
                array(
                    'element'  => '.header-topbar, .header-topbar a',
                    'property' => 'color'
                ),
            ),
        ),
        'border_topbar'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Top Bar Border Bottom Color', 'onum' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 3,
            'output'    => array(
                array(
                    'element'  => '.header-topbar',
                    'property' => 'border-color'
                ),
            ),
        ),
        'separator_1'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'header_styling',
            'default'     => '<hr>',
            'priority'    => 4,
        ),
        'bg_menu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Main Navigation Background Color Static', 'onum' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 5,
            'output'    => array(
                array(
                    'element'  => '.site-header .octf-main-header',
                    'property' => 'background'
                ),
            ),
        ),
        'color_menu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Menu Item Color Static', 'onum' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 6,
            'output'    => array(
                array(
                    'element'  => '.site-header .main-navigation > ul > li > a',
                    'property' => 'color'
                ),
            ),
        ),
        'bdcolor_menu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Border Color Static', 'onum' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 6,
            'output'    => array(
                array(
                    'element'  => '.site-header, .site-header.header-style-1',
                    'property' => 'border-bottom-color'
                ),
            ),
        ),
        'separator_2'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'header_styling',
            'default'     => '<hr>',
            'priority'    => 7,
        ),
        'bg_menu_scroll'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Main Navigation Background Color Scroll', 'onum' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 8,
            'output'    => array(
                array(
                    'element'  => '.site-header .octf-main-header.is-stuck',
                    'property' => 'background'
                ),
            ),
        ),
        'color_menu_scroll'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Menu Item Color Scroll', 'onum' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 9,
            'output'    => array(
                array(
                    'element'  => '.site-header .octf-main-header.is-stuck .main-navigation > ul > li > a',
                    'property' => 'color'
                ),
            ),
        ),
		'bdcolor_menu_scroll'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Border Color Scroll', 'onum' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 9,
            'output'    => array(
                array(
                    'element'  => '.site-header .octf-main-header.is-stuck',
                    'property' => 'border-bottom-color'
                ),
            ),
        ),
        'separator_3'     => array(
            'type'        => 'custom',
            'label'       => '',
            'section'     => 'header_styling',
            'default'     => '<hr>',
            'priority'    => 10,
        ),
        'bg_smenu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color for Dropdown Menu', 'onum' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 11,
            'output'    => array(
                array(
                    'element'  => '.main-navigation ul ul',
                    'property' => 'background'
                ),                
            ),
        ),        
        'color_smenu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Text Color for Dropdown Menu Item', 'onum' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 12,
            'output'    => array(
                array(
                    'element'  => '.main-navigation ul li li a',
                    'property' => 'color'
                ),
            ),
        ),
        'arrow_smenu'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Arrow Color for Dropdown Menu Item has submenu', 'onum' ),
            'section'  => 'header_styling',
            'default'  => '',
            'priority' => 13,
            'output'    => array(
                array(
                    'element'  => '.main-navigation ul > li li.menu-item-has-children > a:after',
                    'property' => 'color'
                ),
            ),
        ),
        'menu_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Menu Parent Font', 'onum' ),
            'section'  => 'header_styling',
            'priority' => 14,
            'default'  => array(
                'font-family'    => 'Red Hat Display',
                'variant'        => '700',                
                'font-size'      => '16px',                            
                'line-height'    => '1.875',
                'letter-spacing' => '0',
                'color'          => '#1a1b1e',
                'text-transform' => 'none',
                'subsets'        => array( 'latin', 'latin-ext' ),
            ),
            'output'      => array(
                array(
                    'element' => '.main-navigation a',
                ),
            ),
        ),
        'submenu_typo' => array(
            'type'        => 'typography',
            'label'       => esc_attr__( 'Menu Dropdown Font', 'onum' ),
            'section'     => 'header_styling',
            'default'     => array(
                'font-family'    => 'Red Hat Text',
                'variant'        => '500',
                'font-size'      => '16px',
                'line-height'    => '1.875',
                'letter-spacing' => 'normal',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'text-transform' => 'none',
                'color'          => '#1a1b1e',                    
            ),
            'priority'    => 15,
            'output'      => array(
                array(
                    'element' => '.main-navigation ul ul a',
                ),
            ),
        ),

        //Page Header
        'pheader_switch'  => array(
            'type'        => 'toggle',
            'label'       => esc_html__( 'Page Header On/Off', 'onum' ),
            'section'     => 'page_header',
            'default'     => 1,
            'priority'    => 10,
        ),
        'breadcrumbs'     => array(
            'type'        => 'toggle',
            'label'       => esc_html__( 'Breadcrumbs On/Off', 'onum' ),
            'section'     => 'page_header',
            'default'     => 1,
            'priority'    => 10,
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_align'    => array(
            'type'     => 'radio',
            'label'    => esc_html__( 'Text Align', 'onum' ),
            'section'  => 'page_header',
            'default'  => 'text-center',
            'priority' => 10,
            'choices'     => array(
                'text-center'   => esc_html__( 'Center', 'onum' ),
                'text-left'     => esc_html__( 'Left', 'onum' ),
                'text-right'    => esc_html__( 'Right', 'onum' ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_img'  => array(
            'type'     => 'image',
            'label'    => esc_html__( 'Background Image', 'onum' ),
            'section'  => 'page_header',
            'default'  => get_template_directory_uri() . '/images/bg-page-header.jpg',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.page-header',
                    'property' => 'background-image'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'onum' ),
            'section'  => 'page_header',
            'default'  => '',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.page-header',
                    'property' => 'background-color'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'ptitle_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Page Title Color', 'onum' ),
            'section'  => 'page_header',
            'default'  => '',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.page-title, .page-header, .page-header .breadcrumbs li a, .page-header .breadcrumbs li:before',
                    'property' => 'color'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_height'  => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Page Header Height', 'onum' ),
            'section'  => 'page_header',
            'default'  => '300',
            'priority' => 10,
            'output'   => array(
                array(
                    'element'  => '.page-header',
                    'property' => 'height',
                    'units'    => 'px'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'head_size'  => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Page Title Size', 'onum' ),
            'section'  => 'page_header',
            'default'  => '',
            'priority' => 10,
            'output'   => array(
                array(
                    'element'  => '.page-title',
                    'property' => 'font-size',
                    'units'    => 'px'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),

        // Footer
		'footer_layout'     => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Footer', 'onum' ), 
	 		'description' => esc_attr__( 'Choose a footer for all site here.', 'onum' ), 
	 		'section'     => 'footer', 
	 		'default'     => '', 
	 		'priority'    => 1,
	 		'placeholder' => esc_attr__( 'Select a footer', 'onum' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_footer_builders' ) ) : array(),
		),
		'backtotop_separator'     => array(
			'type'        => 'custom',
			'label'       => '',
			'section'     => 'footer',
			'default'     => '<hr>',
			'priority'    => 2,
		),
		'backtotop'  => array(
            'type'        => 'toggle',
            'label'       => esc_html__( 'Back To Top On/Off?', 'onum' ),
            'section'     => 'footer',
            'default'     => 1,
            'priority'    => 3,
        ),
        'bg_backtotop'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Back-To-Top Background Color', 'onum' ),
            'section'  => 'footer',
            'priority' => 4,
            'default'     => '',
            'output'    => array(
                array(
                    'element'  => '#back-to-top',
                    'property' => 'background',
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'backtotop',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),
        'color_backtotop' => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Back-To-Top Color', 'onum' ),
            'section'  => 'footer',
            'priority' => 5,
            'default'     => '',
            'output'    => array(
                array(
                    'element'  => '#back-to-top > i:before',
                    'property' => 'color',
                )
            ),
            'active_callback' => array(
				array(
					'setting'  => 'backtotop',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),
        'spacing_backtotop' => array(
            'type'     => 'dimensions',
            'label'    => esc_html__( 'Back-To-Top Spacing', 'onum' ),
            'section'  => 'footer',
            'priority' => 6,
            'default'     => array(
				'bottom'  => '',
				'left' => '',
				'right' => '',
			),
			'choices'     => array(
				'labels' => array(
					'bottom'  => esc_html__( 'Bottom', 'onum' ),
					'left' => esc_html__( 'Left', 'onum' ),
					'right' => esc_html__( 'Right', 'onum' ),
				),
			),
            'output'    => array(
                array(
                    'element'  => '#back-to-top.show',
                )
            ),
            'active_callback' => array(
				array(
					'setting'  => 'backtotop',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),

        // Blog Page
		'blog_layout'           => array(
			'type'        => 'radio-image',
			'label'       => esc_html__( 'Blog Layout', 'onum' ),
			'section'     => 'blog_page',
			'default'     => 'content-sidebar',
			'priority'    => 7,
			'description' => esc_html__( 'Select default sidebar for the blog page.', 'onum' ),
			'choices'     => array(
				'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
				'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
				'full-content' 		=> get_template_directory_uri() . '/inc/backend/images/full.png',
			)
		),
		'blog_style'           => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Blog Style', 'onum' ),
			'section'     => 'blog_page',
			'default'     => 'style1',
			'priority'    => 8,
			'description' => esc_html__( 'Select default style for the blog page.', 'onum' ),
			'choices'     => array(
				'style1' => esc_attr__( 'Blog List', 'onum' ),
				'style2' => esc_attr__( 'Blog Grid', 'onum' ),
			),
		),
		'blog_column'           => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Blog Column', 'onum' ),
			'section'     => 'blog_page',
			'default'     => '3cl',
			'priority'    => 9,
			'description' => esc_html__( 'Select default column for the blog page.', 'onum' ),
			'choices'     => array(
				'2cl' => esc_attr__( '2 Column', 'onum' ),
				'3cl' => esc_attr__( '3 Column', 'onum' ),
				'4cl' => esc_attr__( '4 Column', 'onum' ),
				'5cl' => esc_attr__( '5 Column', 'onum' ),
			),
			'active_callback' => array(
                array(
                    'setting'  => 'blog_style',
                    'operator' => '==',
                    'value'    => 'style2',
                ),
            ),
		),				
		'post_entry_meta'              => array(
            'type'     => 'multicheck',
            'label'    => esc_html__( 'Entry Meta', 'onum' ),
            'section'  => 'blog_page',
            'default'  => array( 'author', 'date', 'comm' ),
            'choices'  => array(
                'author'  => esc_html__( 'Author', 'onum' ),
                'date'    => esc_html__( 'Date', 'onum' ),
                'comm'     => esc_html__( 'Comments', 'onum' ),
            ),
            'priority' => 10,
        ),

        // Single Post
        'single_post_layout'           => array(
            'type'        => 'radio-image',
            'label'       => esc_html__( 'Layout', 'onum' ),
            'section'     => 'single_post',
            'default'     => 'content-sidebar',
            'priority'    => 10,
            'choices'     => array(
				'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
				'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
				'full-content' 		=> get_template_directory_uri() . '/inc/backend/images/full.png',
			)
        ),
        'single_separator1'     => array(
			'type'        => 'custom',
			'label'       => esc_html__( 'Social Share', 'onum' ),
			'section'     => 'single_post',
			'default'     => '<hr>',
			'priority'    => 10,
		),
        'post_socials'              => array(
            'type'     => 'multicheck',
            'section'  => 'single_post',
            'default'  => array( 'twitter', 'facebook', 'pinterest', 'linkedin' ),
            'choices'  => array(
                'twit'  	=> esc_html__( 'Twitter', 'onum' ),
                'face'    	=> esc_html__( 'Facebook', 'onum' ),
                'pint'     	=> esc_html__( 'Pinterest', 'onum' ),
                'link'     	=> esc_html__( 'Linkedin', 'onum' ),
                'google'  	=> esc_html__( 'Google Plus', 'onum' ),
                'tumblr'    => esc_html__( 'Tumblr', 'onum' ),
                'reddit'    => esc_html__( 'Reddit', 'onum' ),
                'vk'     	=> esc_html__( 'VK', 'onum' ),
            ),
            'priority' => 10,
        ),
        'single_separator2'     => array(
			'type'        => 'custom',
			'label'       => esc_html__( 'Entry Footer', 'onum' ),
			'section'     => 'single_post',
			'default'     => '<hr>',
			'priority'    => 10,
		),
        'author_box'     => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__( 'Author Info Box', 'onum' ),
			'section'     => 'single_post',
			'default'     => true,
			'priority'    => 10,
		),
		'post_nav'     => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__( 'Post Navigation', 'onum' ),
			'section'     => 'single_post',
			'default'     => true,
			'priority'    => 10,
		),
		'related_post'     => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__( 'Related Posts', 'onum' ),
			'section'     => 'single_post',
			'default'     => true,
			'priority'    => 10,
		),

		// Portfolio Page
		'portfolio_archive'           => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Archive', 'onum' ),
			'section'     => 'portfolio_page',
			'default'     => 'archive_default',
			'priority'    => 1,
			'description' => esc_html__( 'Select page default for the portfolio archive page.', 'onum' ),
			'choices'     => array(
				'archive_default' => esc_attr__( 'Archive page default', 'onum' ),
				'archive_custom' => esc_attr__( 'Archive page custom', 'onum' ),
			),
		),
		'archive_page_custom'     => array(
			'type'        => 'dropdown-pages',  
	 		'label'       => esc_attr__( 'Select Page', 'onum' ), 
	 		'description' => esc_attr__( 'Choose a custom page for archive portfolio page.', 'onum' ), 
	 		'section'     => 'portfolio_page', 
	 		'default'     => '', 
	 		'priority'    => 2,	 		
	 		'active_callback' => array(
				array(
					'setting'  => 'portfolio_archive',
					'operator' => '==',
					'value'    => 'archive_custom',
				),
			),
		),
		'portfolio_column'           => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Column', 'onum' ),
			'section'     => 'portfolio_page',
			'default'     => '3cl',
			'priority'    => 3,
			'description' => esc_html__( 'Select default column for the portfolio page.', 'onum' ),
			'choices'     => array(
				'2cl' => esc_attr__( '2 Column', 'onum' ),
				'3cl' => esc_attr__( '3 Column', 'onum' ),
				'4cl' => esc_attr__( '4 Column', 'onum' ),
				'5cl' => esc_attr__( '5 Column', 'onum' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_archive',
					'operator' => '==',
					'value'    => 'archive_default',
				),
			),
		),
		'portfolio_style'           => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Style', 'onum' ),
			'section'     => 'portfolio_page',
			'default'     => 'style1',
			'priority'    => 4,
			'description' => esc_html__( 'Select default style for the portfolio page.', 'onum' ),
			'choices'     => array(
				'style1' => esc_attr__( 'Grid Normal', 'onum' ),
				'style2' => esc_attr__( 'Grid Masonry', 'onum' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_archive',
					'operator' => '==',
					'value'    => 'archive_default',
				),
			),
		),
		'portfolio_posts_per_page' => array(
			'type'        => 'number',
			'section'     => 'portfolio_page',
			'priority'    => 5,
			'label'       => esc_html__( 'Posts per page', 'onum' ),			
			'description' => esc_html__( 'Change Posts Per Page for Portfolio Archive, Taxonomy.', 'onum' ),
			'default'     => '',
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_archive',
					'operator' => '==',
					'value'    => 'archive_default',
				),
			),
		),
		'portfolio_separator'     => array(
			'type'        => 'custom',
			'label'       => 'Single Portfolio Page',
			'section'     => 'portfolio_page',
			'default'     => '<hr>',
			'priority'    => 6,
		),
		'pf_related_switch'     => array(
			'type'        => 'toggle',
			'label'       => esc_attr__( 'Related Projects On/Off', 'onum' ),
			'section'     => 'portfolio_page',
			'default'     => 1,
			'priority'    => 7,
		),

		// Typography
        'typography_switch'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Typography Customize?', 'onum' ),
            'section'     => 'typography',
            'default'     => 0,
            'priority'    => 1,
        ),
        'body_typo'    => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Body Font', 'onum' ),
            'section'  => 'typography',
            'priority' => 2,
            'default'  => array(
                'font-family'    => 'Red Hat Text',
                'variant'        => 'regular',
                'font-size'      => '16px',
                'line-height'    => '1.875',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#606060',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'body',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading1_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 1', 'onum' ),
            'section'  => 'typography',
            'priority' => 3,
            'default'  => array(
                'font-family'    => 'Red Hat Display',
                'variant'        => '900',
                'font-size'      => '42px',
                'line-height'    => '1.2',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#1a1b1e',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'h1',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading2_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 2', 'onum' ),
            'section'  => 'typography',
            'priority' => 4,
            'default'  => array(
                'font-family'    => 'Red Hat Display',
                'variant'        => '900',
                'font-size'      => '36px',
                'line-height'    => '1.2',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#1a1b1e',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'h2',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading3_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 3', 'onum' ),
            'section'  => 'typography',
            'priority' => 5,
            'default'  => array(
                'font-family'    => 'Red Hat Display',
                'variant'        => '900',
                'font-size'      => '30px',
                'line-height'    => '1.2',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#1a1b1e',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'h3',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading4_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 4', 'onum' ),
            'section'  => 'typography',
            'priority' => 6,
            'default'  => array(
                'font-family'    => 'Red Hat Display',
                'variant'        => '900',
                'font-size'      => '24px',
                'line-height'    => '1.2',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#1a1b1e',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'h4',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading5_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 5', 'onum' ),
            'section'  => 'typography',
            'priority' => 7,
            'default'  => array(
                'font-family'    => 'Red Hat Display',
                'variant'        => '900',
                'font-size'      => '20px',
                'line-height'    => '1.2',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#1a1b1e',
                'text-transform' => 'none',
            ),
            'output'      => array(
                array(
                    'element' => 'h5',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'heading6_typo'=> array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 6', 'onum' ),
            'section'  => 'typography',
            'priority' => 8,
            'default'  => array(
                'font-family'    => 'Red Hat Display',
                'variant'        => '700',
                'font-size'      => '18px',
                'line-height'    => '1.2',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin', 'latin-ext' ),
                'color'          => '#1a1b1e',
                'text-transform' => 'h6',
            ),
            'output'      => array(
                array(
                    'element' => 'h6',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'typography_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),

		//Color Scheme
        'bg_body'      => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Body', 'onum' ),
            'section'  => 'color_scheme',
            'default'  => '',
            'priority' => 10,
            'output'   => array(
                array(
                    'element'  => 'body, .site-content',
                    'property' => 'background-color',
                ),
            ),
        ),
        'main_color'   => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Primary Color', 'onum' ),
            'section'  => 'color_scheme',
            'default'  => '#fe4c1c',
            'priority' => 10,
        ),
        'second_color' => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Second Color', 'onum' ),
            'section'  => 'color_scheme',
            'default'  => '#00c3ff',
            'priority' => 10,
        ),
        'third_color' => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Third Color', 'onum' ),
            'section'  => 'color_scheme',
            'default'  => '#0160e7',
            'priority' => 10,
        ),
	);
	$settings['panels']   = apply_filters( 'onum_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'onum_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'onum_customize_fields', $fields );

	return $settings;
}

$onum_customize = new ONUM_Customize( onum_customize_settings() );