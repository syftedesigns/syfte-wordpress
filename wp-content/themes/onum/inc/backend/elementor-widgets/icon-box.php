<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Icon Box
 */
class Onum_IconBox extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'iiconbox';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Onum Icon Box', 'onum' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-icon-box';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_onum' ];
	}

	protected function _register_controls() {

		//Content Service box
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Icon Box', 'onum' ),
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'onum' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'onum' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'onum' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'onum' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'onum' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				// 'prefix_class' => 'onum%s-align-',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'default' => 'center',
				'condition' => [
					'box_style' => ['s2', 's3'],
				]
			]
		);

		$this->add_control(
			'box_style',
			[
				'label' 	=> __( 'Box Style', 'onum' ),
				'type'  	=> Controls_Manager::SELECT,
				'default' 	=> 's1',
				'options' 	=> [
					's1'  => __( 'Style 1: Icon Left', 'onum' ),
					's2'  => __( 'Style 2: Icon Center', 'onum' ),
					's3'  => __( 'Style 3: Icon Center With Shadow', 'onum' ),
					's4'  => __( 'Style 4: Icon Right', 'onum' ),
				]
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label' => __( 'Icon Type', 'onum' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'font',
				'options' => [
					'font' 	=> __( 'Font Icon', 'onum' ),
					'image' => __( 'Image Icon', 'onum' ),
					'class' => __( 'Custom Icon', 'onum' ),
				]
			]
		);
		$this->add_control(
			'icon_font',
			[
				'label' => __( 'Icon', 'onum' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
				'condition' => [
					'icon_type' => 'font',
				]
			]
		);
		$this->add_control(
	       'icon_image',
	        [
	           'label' => esc_html__( 'Photo', 'onum' ),
	           'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => get_template_directory_uri().'/images/analysis.png',
			  	],
			  	'condition' => [
					'icon_type' => 'image',
				]
		    ]
	    );
	    $this->add_control(
			'icon_class',
			[
				'label' => __( 'Custom Class', 'onum' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'flaticon-world', 'onum' ),
				'condition' => [
					'icon_type' => 'class',
				]
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'onum' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Content Marketing', 'onum' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'des',
			[
				'label' => 'Description',
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'You can provide the answers that your potential customers are trying to find, so you can become the industry.', 'onum' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'onum' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'onum' ),
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label' => __( 'Bottom Button', 'onum' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Learn More', 'onum' ),
				'condition' => [
					'box_style' => 's3',
				]
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_box_section',
			[
				'label' => __( 'Box', 'onum' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'box_style' => ['s3', 's2'],
				]
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label' => __( 'Border Radius', 'onum' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding Box', 'onum' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'accs_box_shadow',
				'selector' => '{{WRAPPER}} .s2, {{WRAPPER}} .s3',
				'separator' => 'before',
			]
		);

		//Hover
		$this->start_controls_tabs( 'tabs_box_style' );

		$this->start_controls_tab(
			'tab_box_normal',
			[
				'label' => __( 'Normal', 'onum' ),
				'condition' => [
					'box_style' => ['s3', 's2'],
				]
			]
		);

		$this->add_control(
			'heading_bg_top',
			[
				'label' => __( 'Background Top Box', 'onum' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'before_bg_color',
				'label' => __( 'Background', 'onum' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .s3 .bg-before, {{WRAPPER}} .s2:before',
			]
		);
		$this->add_control(
			'heading_bg_bot',
			[
				'label' => __( 'Background Bottom Box', 'onum' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'after_bg_color',
				'label' => __( 'Background', 'onum' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .s3 .bg-after, {{WRAPPER}} .s2:after',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_box_hover',
			[
				'label' => __( 'Hover', 'onum' ),
				'condition' => [
					'box_style' => ['s3', 's2'],
				]
			]
		);

		$this->add_control(
			'heading_bg_hover_top',
			[
				'label' => __( 'Background Top Box', 'onum' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'before_bg_hover_color',
				'label' => __( 'Background', 'onum' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .s3:hover .bg-before, {{WRAPPER}} .s2:hover:before',
			]
		);
		$this->add_control(
			'heading_bg_hover_bot',
			[
				'label' => __( 'Background Bottom Box', 'onum' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'after_bg_hover_color',
				'label' => __( 'Background', 'onum' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .s3:hover .bg-after, {{WRAPPER}} .s2:hover:after',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		
		$this->start_controls_section(
			'style_icon_section',
			[
				'label' => __( 'Icon', 'onum' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'onum' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-main i, {{WRAPPER}} .icon-main span:before' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .icon-main img' => 'max-width : {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_width',
			[
				'label' => __( 'Width', 'onum' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-main' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .icon-main i' => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .s1 .content-box' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .s4 .content-box' => 'padding-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'box_style' => ['s1', 's4', 's3'],
				]
			]
		);
		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Spacing', 'onum' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .s2 .icon-main, {{WRAPPER}} .s3 .icon-main' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'box_style' => ['s2', 's3'],
				]
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .icon-main',
			]
		);

		//Hover
		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' => __( 'Normal', 'onum' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'onum' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-main i, {{WRAPPER}} .icon-main span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg_color',
				'label' => __( 'Background', 'onum' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .s1 .icon-main, {{WRAPPER}} .s3 .icon-main, {{WRAPPER}} .s4 .icon-main',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_hover',
			[
				'label' => __( 'Hover', 'onum' ),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Color', 'onum' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box:hover i, {{WRAPPER}} .icon-box:hover span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg_hover_color',
				'label' => __( 'Background', 'onum' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .s1:hover .icon-main, {{WRAPPER}} .s3:hover .icon-main, {{WRAPPER}} .s4:hover .icon-main',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'style_content_section',
			[
				'label' => __( 'Content', 'onum' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_space',
			[
				'label' => __( 'Content Spacing', 'onum' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .s1 .content-box' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .s4 .content-box' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'box_style' => ['s1', 's4'],
				]
			]
		);

		//Title
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'onum' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_space',
			[
				'label' => __( 'Spacing', 'onum' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box h5' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'onum' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box h5, {{WRAPPER}} .icon-box h5 a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Hover Color', 'onum' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box h5 a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'link[url]!' => ''
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .icon-box h5',
			]
		);

		//Description
		$this->add_control(
			'heading_des',
			[
				'label' => __( 'Description', 'onum' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'des_color',
			[
				'label' => __( 'Color', 'onum' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'des_typography',
				'selector' => '{{WRAPPER}} .icon-box p',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$title = $settings['title'];
		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'iconbox', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'iconbox', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'iconbox', 'rel', 'nofollow' );
			}
			if( !$settings['btn_text'] ) { 
				$title = '<a '. $this->get_render_attribute_string( 'iconbox' ).'>'. $settings['title'] . '</a>';
			}else{
				$title = $settings['title'];
			}
		}

		?>
		<div class="icon-box <?php echo $settings['box_style']; ?>">
			<div class="bg-s3"></div>
			<div class="bg-before"></div>
			<div class="bg-after"></div>
			<div class="icon-main">
		        <?php if( $settings['icon_font']['value'] ) { ?><i class="<?php echo esc_attr( $settings['icon_font']['value'] ); ?>"></i><?php } ?>
			    <?php if( $settings['icon_image']['url'] ) { ?><img src="<?php echo esc_attr( $settings['icon_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['title'] ); ?>"><?php } ?>
		        <?php if( $settings['icon_class'] ) { ?><span class="<?php echo esc_attr( $settings['icon_class'] ); ?>"></span><?php } ?>
	        </div>
	        <div class="content-box">
	            <h5><?php echo $title; ?></h5>
	            <p><?php echo $settings['des']; ?></p>
	        </div>
	        <?php if( $settings['btn_text'] ) { ?>
        	<div class="action-box">
        		<a class="octf-btn octf-btn-icon octf-btn-white" href="<?php echo $settings['link']['url']; ?>"><?php echo $settings['btn_text']; ?><i class="flaticon-right-arrow-1"></i></a>
        	</div>
	        <?php } ?>	
	    </div>
	    <?php
	}

	protected function _content_template() {}
}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register_widget_type( new Onum_IconBox() );