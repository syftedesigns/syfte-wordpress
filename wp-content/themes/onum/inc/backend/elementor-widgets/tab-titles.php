<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Section Heading 
 */
class ONUM_Tab_Titles extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'itabtitle';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Onum Tab Titles', 'onum' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-site-title';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_onum' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Titles', 'onum' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
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
		$repeater->add_control(
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
		$repeater->add_control(
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
	    $repeater->add_control(
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

		$repeater->add_control(
			'titles',
			[
				'label' => __( 'Title', 'onum' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Content Marketing',
			]
		);
		$repeater->add_control(
			'title_link',
			[
				'label' => __( 'Link to ID Content', 'onum' ),
				'type' => Controls_Manager::TEXT,
				'default' => '#tab-1',
			]
		);

		$this->add_control(
		    'title_boxes',
		    [
		        'label'       => '',
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => false,
		        'default'     => [
		            [
						'title_box'	 => 'Content Marketing',
		 
		            ],
		            [
						'title_box'	 => 'Media Marketing',
		 
		            ],
		            [
						'title_box'	 => 'Add Development',
		 
		            ],
		            [
						'title_box'	 => 'SEO Optimization',
		 
		            ],
		            
		        ],
		        'fields'      => array_values( $repeater->get_controls() ),
		        'title_field' => '{{{titles}}}',
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
				],
				// 'prefix_class' => 'onum%s-align-',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'default' => 'center',
			]
		);

		$this->end_controls_section();

		//Styling
		$this->start_controls_section(
			'style_boxes',
			[
				'label' => __( 'Boxes', 'onum' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'boxes_space',
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
					'{{WRAPPER}} .tab-titles .col-md' => 'padding: 0 calc({{SIZE}}{{UNIT}}/2);',
					'{{WRAPPER}} .tab-titles' => 'margin: 0 calc(-{{SIZE}}{{UNIT}}/2);',
				],
			]
		);
		$this->add_control(
			'bgbox_color',
			[
				'label' => __( 'Background', 'onum' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-item' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'bgbox_active_color',
			[
				'label' => __( 'Background Active/Hover', 'onum' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-item:hover, {{WRAPPER}} .title-item.tab-active, {{WRAPPER}} .title-item.tab-active:after' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding Box', 'onum' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .title-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//Content
		$this->start_controls_section(
			'style_icon_section',
			[
				'label' => __( 'Content', 'onum' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Title
		$this->add_control(
			'heading_icon',
			[
				'label' => __( 'Icon', 'onum' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
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
					'{{WRAPPER}} .icon-main i, {{WRAPPER}} .icon-main span:before' => 'font-size: {{SIZE}}{{UNIT}};'
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
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-main' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
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
				'label' => __( 'Icon Color', 'onum' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-main' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'onum' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title-item h6' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_hover',
			[
				'label' => __( 'Active/Hover', 'onum' ),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Icon Color', 'onum' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title-item:hover i, {{WRAPPER}} .title-item:hover span, {{WRAPPER}} .title-item.tab-active i, {{WRAPPER}} .title-item.tab-active span' => 'color: {{VALUE}}; text-shadow: none;',
				],
			]
		);
		$this->add_control(
			'title_active_color',
			[
				'label' => __( 'Title Color', 'onum' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title-item:hover h6, {{WRAPPER}} .title-item.tab-active h6' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		//Title
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'onum' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .title-item h6',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<div class="tab-titles row">
			<?php foreach ( $settings['title_boxes'] as $box ) : ?>
			<div>
				<div class="col-md">
					<a class="title-item" href="<?php echo esc_url($box['title_link']); ?>">
						<div class="icon-main">
					        <?php if( $box['icon_type'] == 'font' ) { ?><i class="<?php echo esc_attr( $box['icon_font']['value'] ); ?>"></i><?php } ?>
						    <?php if( $box['icon_type'] == 'image' ) { ?><img src="<?php echo esc_attr( $box['icon_image']['url'] ); ?>" alt="<?php echo esc_attr( $box['title'] ); ?>"><?php } ?>
					        <?php if( $box['icon_type'] == 'class' ) { ?><span class="<?php echo esc_attr( $box['icon_class'] ); ?>"></span><?php } ?>
				        </div>
						<h6><?php echo $box['titles']; ?></h6>
					</a>
				</div>
			</div>
			<?php endforeach; ?>
		</div>

	    <?php
	}

	protected function _content_template() {}
}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register_widget_type( new ONUM_Tab_Titles() );