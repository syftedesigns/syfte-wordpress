<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Icon Box
 */
class Onum_IconBox_Grid extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'iiconbox_grid';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Onum Icon Box Grid', 'onum' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-gallery-grid';
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
			]
		);
		$this->add_control(
			'column_grid',
			[
				'label' => __( 'Columns', 'onum' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'col-md-4',
				'options' => [
					'col-md-12' => __( '1', 'onum' ),
					'col-md-6'  => __( '2', 'onum' ),
					'col-md-4'  => __( '3', 'onum' ),
					'col-md-3'  => __( '4', 'onum' ),
				]
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
			'title',
			[
				'label' => __( 'Title', 'onum' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Content Marketing', 'onum' ),
			]
		);

		$repeater->add_control(
			'des',
			[
				'label' => 'Description',
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'You can provide the answers that your potential customers are trying to find, so you can become the industry.', 'onum' ),
			]
		);

		$repeater->add_control(
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
		    'icon_boxes',
		    [
		        'label'       => '',
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => false,
		        'default'     => [
		            [
		            	'icon_type'  => __( 'class', 'onum' ),
		            	'icon_class' => __( 'flaticon-world', 'onum' ),
		             	'title' => esc_html__( 'Content Marketing', 'onum' ),
		                'des'	=> esc_html__( 'You can provide the answers that your potential customers are trying to find, so you can become the industry.', 'onum' ),
		             	'link' => '',
		            ],
		            [
		            	'icon_type'  => __( 'class', 'onum' ),
		            	'icon_class' => __( 'flaticon-world', 'onum' ),
		             	'title' => esc_html__( 'Content Marketing', 'onum' ),
		                'des'	=> esc_html__( 'You can provide the answers that your potential customers are trying to find, so you can become the industry.', 'onum' ),
		             	'link' => '',
		            ],
		            [
		            	'icon_type'  => __( 'class', 'onum' ),
		            	'icon_class' => __( 'flaticon-world', 'onum' ),
		             	'title' => esc_html__( 'Content Marketing', 'onum' ),
		                'des'	=> esc_html__( 'You can provide the answers that your potential customers are trying to find, so you can become the industry.', 'onum' ),
		             	'link' => '',
		            ]
		        ],
		        'fields'      => array_values( $repeater->get_controls() ),
		        'title_field' => '{{{title}}}',
		    ]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_box_section',
			[
				'label' => __( 'Boxes', 'onum' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'heading_bg',
			[
				'label' => __( 'Background Grid', 'onum' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bg_color',
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .icon-box-grid',
			]
		);

		$this->add_control(
			'heading_bg_hover',
			[
				'label' => __( 'Background Hover Box', 'onum' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bg_hover_color',
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .icon-box:hover',
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
					'{{WRAPPER}} .icon-box-grid' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
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
				'selector' => '{{WRAPPER}} .icon-box-grid',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_icon_section',
			[
				'label' => __( 'Icon', 'onum' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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

		$this->end_controls_section();

		$this->start_controls_section(
			'style_content_section',
			[
				'label' => __( 'Content', 'onum' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .icon-box h5' => 'color: {{VALUE}};',
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
		?>
		<div class="icon-box-grid">
			<?php if ( ! empty( $settings['icon_boxes'] ) ) : foreach ( $settings['icon_boxes'] as $boxes ) : ?>
			<div class="<?php echo esc_attr( $settings['column_grid'] ); ?> no-padding">
				<div class="icon-box">
					<div class="icon-main">
				        <?php if( $boxes['icon_type'] == 'font' ) { ?><i class="<?php echo esc_attr( $boxes['icon_font']['value'] ); ?>"></i><?php } ?>
					    <?php if( $boxes['icon_type'] == 'image' ) { ?><img src="<?php echo esc_attr( $boxes['icon_image']['url'] ); ?>" alt="<?php echo esc_attr( $boxes['title'] ); ?>"><?php } ?>
				        <?php if( $boxes['icon_type'] == 'class' ) { ?><span class="<?php echo esc_attr( $boxes['icon_class'] ); ?>"></span><?php } ?>
			        </div>
			        <div class="content-box">
			        	<?php 
			        		$title = $boxes['title'];
							if ( ! empty( $boxes['link']['url'] ) ) {
								$this->add_render_attribute( 'iconbox', 'href', $boxes['link']['url'] );

								if ( $boxes['link']['is_external'] ) {
									$this->add_render_attribute( 'iconbox', 'target', '_blank' );
								}

								if ( $boxes['link']['nofollow'] ) {
									$this->add_render_attribute( 'iconbox', 'rel', 'nofollow' );
								}
								$title = '<a '. $this->get_render_attribute_string( 'iconbox' ).'>'. $boxes['title'] . '</a>';
							}
			        	?>
			            <h5><?php echo $title; ?></h5>
			            <p><?php echo $boxes['des']; ?></p>
			        </div>
			    </div>
		    </div>
		    <?php endforeach; endif; ?>
		</div>
	    <?php
	}

	protected function _content_template() {}
}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register_widget_type( new Onum_IconBox_Grid() );