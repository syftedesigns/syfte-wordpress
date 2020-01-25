<?php

function preloader_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'onum',
	);

	$panels = array(

	);

	$sections = array(
		'preload_section'     => array(
			'title'       => esc_attr__( 'Preloader', 'onum' ),
			'description' => '',
			'priority'    => 22,
			'capability'  => 'edit_theme_options',
		),
	);

	$fields = array(	
        // Preloader Setting
        'preload'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Preloader', 'onum' ),
            'section'     => 'preload_section',
            'default'     => '1',
            'priority'    => 10,
        ),
        'preload_logo'    => array(
            'type'     => 'image',
            'label'    => esc_html__( 'Logo Preload', 'onum' ),
            'section'  => 'preload_section',
            'default'  => trailingslashit( get_template_directory_uri() ) . 'images/logo-dark.svg',
            'priority' => 11,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_logo_width'     => array(
            'type'     => 'slider',
            'label'    => esc_html__( 'Logo Width', 'onum' ),
            'section'  => 'preload_section',
            'default'  => 124,
            'priority' => 12,
            'choices'   => array(
                'min'  => 0,
                'max'  => 400,
                'step' => 1,
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_logo_height'    => array(
            'type'     => 'slider',
            'label'    => esc_html__( 'Logo Height', 'onum' ),
            'section'  => 'preload_section',
            'default'  => 50,
            'priority' => 13,
            'choices'   => array(
                'min'  => 0,
                'max'  => 200,
                'step' => 1,
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_text_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Percent Text Color', 'onum' ),
            'section'  => 'preload_section',
            'default'  => '#0a0f2b',
            'priority' => 14,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_bgcolor'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'onum' ),
            'section'  => 'preload_section',
            'default'  => '#fff',
            'priority' => 15,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'preload_typo' => array(
            'type'        => 'typography',
            'label'       => esc_attr__( 'Percent Preload Font', 'onum' ),
            'section'     => 'preload_section',
            'default'     => array(
                'font-family'    => 'Roboto',
                'variant'        => 'regular',
                'font-size'      => '13px',
                'line-height'    => '40px',
                'letter-spacing' => '2px',
                'subsets'        => array( 'latin-ext' ),                
                'text-transform' => 'none',
                'text-align'     => 'center'
            ),
            'priority'    => 16,
            'output'      => array(
                array(
                    'element' => '#royal_preloader.royal_preloader_logo .royal_preloader_percentage',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
	);

	$settings['panels']   = apply_filters( 'onum_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'onum_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'onum_customize_fields', $fields );

	return $settings;
}

$onum_customize = new ONUM_Customize( preloader_customize_settings() );

if( onum_get_option('preload') != false ){

    function onum_body_classes( $classes ) {

    	$classes[] = 'royal_preloader';
    	return $classes;
        
    }
    add_filter( 'body_class', 'onum_body_classes' );

    if(!function_exists('onum_custom_frontend_scripts')){
        function onum_custom_frontend_scripts(){ ?>
        <script type="text/javascript">
            window.jQuery = window.$ = jQuery;  
            (function($) { "use strict";
            	//Preloader
    			Royal_Preloader.config({
    				mode           : 'logo',
    				logo           : '<?php echo onum_get_option('preload_logo'); ?>',
    				logo_size      : [<?php echo onum_get_option('preload_logo_width'); ?>, <?php echo onum_get_option('preload_logo_height'); ?>],
    				showProgress   : true,
    				showPercentage : true,
    		        text_colour: '<?php echo onum_get_option('preload_text_color'); ?>',
                    background:  '<?php echo onum_get_option('preload_bgcolor'); ?>'
    			});
            })(jQuery);
        </script>  
    <?php        
        }
    }
    add_action('wp_footer', 'onum_custom_frontend_scripts');

    function onum_preload_scripts() {
    	wp_enqueue_style('onum-preload', get_template_directory_uri().'/css/royal-preload.css');
    	wp_enqueue_script('onum-royal-preloader', get_template_directory_uri()."/js/royal_preloader.min.js",array('jquery'), '1.0', false); 
    }
    add_action( 'wp_enqueue_scripts', 'onum_preload_scripts' );

}