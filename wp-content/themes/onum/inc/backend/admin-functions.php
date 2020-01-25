<?php

//Admin Style
if ( ! function_exists( 'onum_custom_wp_admin_style' ) ) :
    function onum_custom_wp_admin_style() {
        wp_register_style( 'onum_custom_wp_admin_css', get_template_directory_uri() . '/inc/backend/css/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'onum_custom_wp_admin_css' );

        wp_enqueue_script( 'onum_custom_wp_admin_js', get_template_directory_uri()."/inc/backend/js/admin-script.js", array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script( 'onum_custom_wp_admin_js' );
    }
    add_action( 'admin_enqueue_scripts', 'onum_custom_wp_admin_style' );
endif;

//Upload SVG file
function onum_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  $mimes['svgz'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'onum_mime_types', 10, 1);

// Load the theme's custom Widgets so that they appear in the Elementor element panel.
add_action( 'elementor/widgets/widgets_registered', 'onum_register_elementor_widgets' );
function onum_register_elementor_widgets() {
    // We check if the Elementor plugin has been installed / activated.
    if ( defined( 'ELEMENTOR_PATH' ) && class_exists('Elementor\Widget_Base') ) {
        // Include Elementor Widget files here.
        
        // Remove this 2 require_once line below after completed the theme.
        require_once( get_template_directory() . '/inc/backend/elementor-widgets/ot-widget.php' );
    }
}

// Add a custom 'category_otcore' category for to the Elementor element panel so that our theme's widgets have their own category.
add_action( 'elementor/init', function() {
    \Elementor\Plugin::$instance->elements_manager->add_category( 
        'category_onum',
        [
            'title' => __( 'ONUM', 'onum' ),
            'icon' => 'fa fa-plug', //default icon
        ],
        1 // position
    );
});

/**
 * Add Font Group
 */
add_filter( 'elementor/fonts/groups', function( $font_groups ) {
    $font_groups['onum_fonts'] = __( 'ONUM Fonts' );
    return $font_groups;
} );

/* Filters the fonts used by Elementor to add additional fonts. */
add_filter( 'elementor/fonts/additional_fonts', function ( $additional_fonts ) {
    $additional_fonts['Red Hat Display'] = 'onum_fonts';
    $additional_fonts['Red Hat Text'] = 'onum_fonts';
    return $additional_fonts;
} );

function onum_add_cpt_support() {
    
    //if exists, assign to $cpt_support var
    $cpt_support = get_option( 'elementor_cpt_support' );
    
    //check if option DOESN'T exist in db
    if( ! $cpt_support ) {
        $cpt_support = [ 'page', 'post', 'ot_portfolio', 'ot_service', 'ot_header_builders', 'ot_footer_builders' ]; //create array of our default supported post types
        update_option( 'elementor_cpt_support', $cpt_support ); //write it to the database
    }
    
    //if it DOES exist, but portfolio is NOT defined
    else if( ! in_array( array('ot_portfolio', 'ot_service', 'ot_header_builders', 'ot_footer_builders'), $cpt_support ) ) {
        $cpt_support[] = 'ot_portfolio'; //append to array
        $cpt_support[] = 'ot_service'; //append to array
        $cpt_support[] = 'ot_header_builders'; //append to array
        $cpt_support[] = 'ot_footer_builders'; //append to array
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }
    
    //otherwise do nothing, portfolio already exists in elementor_cpt_support option
}
add_action( 'after_switch_theme', 'onum_add_cpt_support' );

add_action( 'init', 'onum_create_footer_builder' ); 
function onum_create_footer_builder() {
    register_post_type( 'ot_footer_builders',
        array(
            'labels' => array(
                'name' => 'Footer Builders',
                'singular_name' => 'Footer Builder',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Footer Builder',
                'edit' => 'Edit',
                'edit_item' => 'Edit Footer Builder',
                'new_item' => 'New Footer Builder',
                'view' => 'View',
                'view_item' => 'View Footer Builder',
                'search_items' => 'Search Footer Builders',
                'not_found' => 'No Footer Builders found',
                'not_found_in_trash' => 'No Footer Builders found in Trash',
                'parent' => 'Parent Footer Builder'
            ),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'menu_position' => 60,
            'supports' => array( 'title', 'editor' ),
            'menu_icon' => 'dashicons-editor-kitchensink',
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            'capability_type' => 'post'
        )
    );
}

/*Add options to sections*/
add_action('elementor/element/section/section_typo/after_section_end', function( $section, $args ) {

    /*Particles*/
    $section->start_controls_section(
        'section_custom_class',
        [
            'label' => __( 'Particles', 'onum' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    $section->add_control(
        'particles_class',
        [
            'label'        => __( 'Particles On/Off', 'onum' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'return_value' => 'particles-js',
            'prefix_class' => '',
        ]
    );
    $section->add_control(
        'add_particles_color',
        [
            'label'        => __( 'Particles Colors', 'onum' ),
            'type'         => Elementor\Controls_Manager::TEXT,
            'default'      => '#fe4c1c,#00c3ff,#0160e7',
            'condition' => [
                'particles_class' => 'particles-js',
            ]
        ]
    );
    $section->end_controls_section();

    /*Grid Lines*/
    $section->start_controls_section(
        'section_custom_lines',
        [
            'label' => __( 'Grid Lines', 'onum' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    $section->add_control(
        'lines_class',
        [
            'label'        => __( 'Grid Lines On/Off', 'onum' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'return_value' => 'has-lines',
            'prefix_class' => '',
        ]
    );
    $section->add_control(
        'heading_line1',
        [
            'label' => __( 'Line Left', 'onum' ),
            'type' => Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'lines_class' => 'has-lines',
            ],
        ]
    );
    $section->add_responsive_control(
        'line1_space',
        [
            'label' => __( 'Position Line', 'onum' ),
            'type' => Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => -200,
                    'max' => 0,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .line-left' => 'top: {{SIZE}}{{UNIT}}; height: calc(100% - {{SIZE}}{{UNIT}});',
            ],
            'condition' => [
                'lines_class' => 'has-lines',
            ],
        ]
    );
    $section->add_control(
        'line1_color',
        [
            'label'        => __( 'Line Color', 'onum' ),
            'type'         => Elementor\Controls_Manager::COLOR,
            'default'      => '',
            'selectors'    => [
                '{{WRAPPER}} .line-left' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'lines_class' => 'has-lines',
            ],
        ]
    );
    $section->add_responsive_control(
        'dot1_space',
        [
            'label' => __( 'Position Dot', 'onum' ),
            'type' => Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .line-left span' => 'top: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'lines_class' => 'has-lines',
            ],
        ]
    );
    $section->add_control(
        'dot1_color',
        [
            'label'        => __( 'Dot Left Color', 'onum' ),
            'type'         => Elementor\Controls_Manager::COLOR,
            'default'      => '',
            'selectors'    => [
                '{{WRAPPER}} .line-left span' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'lines_class' => 'has-lines',
            ],
        ]
    );

    $section->add_control(
        'heading_line2',
        [
            'label' => __( 'Line Center Left', 'onum' ),
            'type' => Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'lines_class' => 'has-lines',
            ],
        ]
    );
    $section->add_responsive_control(
        'line2_space',
        [
            'label' => __( 'Position Line', 'onum' ),
            'type' => Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => -200,
                    'max' => 0,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .line-cleft' => 'top: {{SIZE}}{{UNIT}}; height: calc(100% - {{SIZE}}{{UNIT}});',
            ],
            'condition' => [
                'lines_class' => 'has-lines',
            ],
        ]
    );
    $section->add_control(
        'line2_color',
        [
            'label'        => __( 'Line Color', 'onum' ),
            'type'         => Elementor\Controls_Manager::COLOR,
            'default'      => '',
            'selectors'    => [
                '{{WRAPPER}} .line-cleft' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'lines_class' => 'has-lines',
            ],
        ]
    );
    $section->add_responsive_control(
        'dot2_space',
        [
            'label' => __( 'Position Dot', 'onum' ),
            'type' => Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .line-cleft span' => 'top: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'lines_class' => 'has-lines',
            ],
        ]
    );
    $section->add_control(
        'dot2_color',
        [
            'label'        => __( 'Dot Color', 'onum' ),
            'type'         => Elementor\Controls_Manager::COLOR,
            'default'      => '',
            'selectors'    => [
                '{{WRAPPER}} .line-cleft span' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'lines_class' => 'has-lines',
            ],
        ]
    );

    $section->add_control(
        'heading_line3',
        [
            'label' => __( 'Line Center Right', 'onum' ),
            'type' => Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'lines_class' => 'has-lines',
            ],
        ]
    );
    $section->add_responsive_control(
        'line3_space',
        [
            'label' => __( 'Position Line', 'onum' ),
            'type' => Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => -200,
                    'max' => 0,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .line-cright' => 'top: {{SIZE}}{{UNIT}}; height: calc(100% - {{SIZE}}{{UNIT}});',
            ],
            'condition' => [
                'lines_class' => 'has-lines',
            ],
        ]
    );
    $section->add_control(
        'line3_color',
        [
            'label'        => __( 'Line Color', 'onum' ),
            'type'         => Elementor\Controls_Manager::COLOR,
            'default'      => '',
            'selectors'    => [
                '{{WRAPPER}} .line-cright' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'lines_class' => 'has-lines',
            ],
        ]
    );
    $section->add_responsive_control(
        'dot3_space',
        [
            'label' => __( 'Position Dot', 'onum' ),
            'type' => Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .line-cright span' => 'top: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'lines_class' => 'has-lines',
            ],
        ]
    );
    $section->add_control(
        'dot3_color',
        [
            'label'        => __( 'Dot Color', 'onum' ),
            'type'         => Elementor\Controls_Manager::COLOR,
            'default'      => '',
            'selectors'    => [
                '{{WRAPPER}} .line-cright span' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'lines_class' => 'has-lines',
            ],
        ]
    );

    $section->add_control(
        'heading_line4',
        [
            'label' => __( 'Line Right', 'onum' ),
            'type' => Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'lines_class' => 'has-lines',
            ],
        ]
    );
    $section->add_responsive_control(
        'line4_space',
        [
            'label' => __( 'Position Line', 'onum' ),
            'type' => Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => -200,
                    'max' => 0,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .line-right' => 'top: {{SIZE}}{{UNIT}}; height: calc(100% - {{SIZE}}{{UNIT}});',
            ],
            'condition' => [
                'lines_class' => 'has-lines',
            ],
        ]
    );
    $section->add_control(
        'line4_color',
        [
            'label'        => __( 'Line Color', 'onum' ),
            'type'         => Elementor\Controls_Manager::COLOR,
            'default'      => '',
            'selectors'    => [
                '{{WRAPPER}} .line-right' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'lines_class' => 'has-lines',
            ],
        ]
    );
    $section->add_responsive_control(
        'dot4_space',
        [
            'label' => __( 'Position Dot', 'onum' ),
            'type' => Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .line-right span' => 'top: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'lines_class' => 'has-lines',
            ],
        ]
    );
    $section->add_control(
        'dot4_color',
        [
            'label'        => __( 'Dot Color', 'onum' ),
            'type'         => Elementor\Controls_Manager::COLOR,
            'default'      => '',
            'selectors'    => [
                '{{WRAPPER}} .line-right span' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'lines_class' => 'has-lines',
            ],
        ]
    );
    $section->end_controls_section();

}, 10, 2 );

add_action( 'elementor/frontend/section/before_render',function( $element ) {
    // Make sure we are in a section element
    if( 'section' !== $element->get_name() ) {
        return;
    }
    $section = $element->get_settings_for_display();
    if( $section['add_particles_color'] ){
        $element->add_render_attribute( '_wrapper', 'data-color', $section['add_particles_color'] );
    }
    
});