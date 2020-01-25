<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Icon Box
 */
class Onum_Process extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'iprocessbox';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Onum Process Box', 'onum' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-number-field';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_onum' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Process', 'onum' ),
			]
		);

		$this->add_responsive_control(
			'text_align',
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
				],
				// 'prefix_class' => 'onum%s-align-',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'dynamic' => [
					'active' => true,
				],
				'default' => 'center',
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label' => __( 'Icon Type', 'onum' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'image',
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
					'url' => get_template_directory_uri().'/images/process1.png',
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
			'number_box',
			[
				'label' => __( 'Box Number', 'onum' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '01', 'onum' ),
				'label_block' => true,
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
				'default' => __( 'Project Introduction', 'onum' ),
				'label_block' => true,
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
				'default' => __( 'We are a team of non-cynics who truly care for our work and for each other.', 'onum' ),
			]
		);

		$this->add_control(
	       'arrow_image',
	        [
	           'label' => esc_html__( 'Arrow', 'onum' ),
	           'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => get_template_directory_uri().'/images/p-arrow1.png',
			  	],
		    ]
	    );

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_box_section',
			[
				'label' => __( 'Box', 'onum' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'box_color',
			[
				'label' => __( 'Background', 'onum' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .process-box' => 'background: {{VALUE}};',
				],
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
					'{{WRAPPER}} .process-box' => 'border-radius: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .process-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'pos_arrow',
			[
				'label' => __( 'Arrow Position', 'onum' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .p-arrow' => 'top: {{TOP}}{{UNIT}};',
					'{{WRAPPER}} .p-arrow' => 'right: {{RIGHT}}{{UNIT}};',
				],
				'allowed_dimensions' => [ 'top', 'right' ],
				'separator' => 'before',
			]
		);

		//Hover
		$this->start_controls_tabs( 'tabs_box_style' );

		$this->start_controls_tab(
			'tab_box_normal',
			[
				'label' => __( 'Normal', 'onum' ),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_box_shadow',
				'selector' => '{{WRAPPER}} .process-box',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_box_hover',
			[
				'label' => __( 'Hover', 'onum' ),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_hover_box_shadow',
				'selector' => '{{WRAPPER}} .process-box:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		//Number
		$this->start_controls_section(
			'style_number_section',
			[
				'label' => __( 'Number', 'onum' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'number_color',
			[
				'label' => __( 'Color', 'onum' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .number-box' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'number_bg',
				'label' => __( 'Background', 'onum' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .number-box',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .number-box',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_content_section',
			[
				'label' => __( 'Content', 'onum' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Icon
		$this->add_control(
			'heading_icon',
			[
				'label' => __( 'Icon/Image', 'onum' ),
				'type' => Controls_Manager::HEADING,
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
				]
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
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-main i, {{WRAPPER}} .icon-main span:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
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
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-main' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
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
					'{{WRAPPER}} .process-box h5' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .process-box h5' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .process-box h5',
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
					'{{WRAPPER}} .process-box p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'des_typography',
				'selector' => '{{WRAPPER}} .process-box p',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<div class="process-box">
			<?php if( $settings['arrow_image']['url'] ) { ?><img class="p-arrow" src="<?php echo esc_attr( $settings['arrow_image']['url'] ); ?>" alt="arrow"><?php } ?>
			<div class="number-box">
		        <?php echo $settings['number_box']; ?>
	        </div>
	        <div class="icon-main">
		        <?php if( $settings['icon_font']['value'] ) { ?><i class="<?php echo esc_attr( $settings['icon_font']['value'] ); ?>"></i><?php } ?>
			    <?php if( $settings['icon_image']['url'] ) { ?><img src="<?php echo esc_attr( $settings['icon_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['title'] ); ?>"><?php } ?>
		        <?php if( $settings['icon_class'] ) { ?><span class="<?php echo esc_attr( $settings['icon_class'] ); ?>"></span><?php } ?>
	        </div>
	        <div class="content-box">
	            <h5><?php echo $settings['title']; ?></h5>
	            <p><?php echo $settings['des']; ?></p>
	        </div>
		</div>

	    <?php
	}

	protected function _content_template() {}
}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register_widget_type( new Onum_Process() );