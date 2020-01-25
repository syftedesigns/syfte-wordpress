<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Button
 */
class Onum_Button extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ibutton';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Onum Button', 'onum' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-button';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_onum' ];
	}

	/**
	 * Get button sizes.
	 *
	 * Retrieve an array of button sizes for the button widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @return array An array containing button sizes.
	 */
	public static function get_button_style() {
		return [
			'btn-main' 	=> __( 'Normal Button', 'onum' ),
			'btn-icon'  => __( 'Button With Icon', 'onum' ),
		];
	}

	public static function get_button_color() {
		return [
			'primary' 	=> __( 'Primary Color', 'onum' ),
			'secondary' => __( 'Second Color', 'onum' ),
			'third'   	=> __( 'Third Color', 'onum' ),
			'white'   	=> __( 'White Color', 'onum' ),
		];
	}

	protected function _register_controls() {

		//Content Service box
		$this->start_controls_section(
			'button_section',
			[
				'label' => __( 'Button', 'onum' ),
			]
		);

		$this->add_control(
			'btn_style_color',
			[
				'label' => __( 'Style Color', 'onum' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'primary',
				'options' => self::get_button_color(),
				'style_transfer' => true,
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
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'onum' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'onum' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'default' => '',
			]
		);

		$this->add_control(
			'text',
			[
				'label' => __( 'Text', 'onum' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Click here <i class="flaticon-right-arrow-1"></i>', 'onum' ),
				'placeholder' => __( 'Click here', 'onum' ),
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
				'default' => [
					'url' => '#',
				],
			]
		);
		$this->add_control(
			'btn_style',
			[
				'label' => __( 'Type', 'onum' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'btn-icon',
				'options' => self::get_button_style(),
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'btn_icon',
			[
				'label' => __( 'Icon', 'onum' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'fa4compatibility' => 'icon',
				'condition' => [
					'btn_style' => 'btn-icon',
				],
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'General', 'onum' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Hover
		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'onum' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'onum' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.octf-btn, {{WRAPPER}} .octf-btn' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'onum' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.octf-btn, {{WRAPPER}} .octf-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .octf-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'onum' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'onum' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.octf-btn:hover, {{WRAPPER}} .octf-btn:hover, {{WRAPPER}} a.octf-btn:focus, {{WRAPPER}} .octf-btn:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} a.octf-btn:hover svg, {{WRAPPER}} .octf-btn:hover svg, {{WRAPPER}} a.octf-btn:focus svg, {{WRAPPER}} .octf-btn:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' => __( 'Background Color', 'onum' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.octf-btn:hover, {{WRAPPER}} .octf-btn:hover, {{WRAPPER}} a.octf-btn:focus, {{WRAPPER}} .octf-btn:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .octf-btn',
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'onum' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'style_icon',
			[
				'label' => __( 'Icon', 'onum' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'btn_style' => 'btn-icon',
				],
			]
		);

		//Hover
		$this->start_controls_tabs( 'tabs_button_icon_style' );

		$this->start_controls_tab(
			'tab_button_icon_normal',
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
					'{{WRAPPER}} .octf-btn i' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_bg',
			[
				'label' => __( 'Background', 'onum' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn i' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_icon_hover',
			[
				'label' => __( 'Hover', 'onum' ),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Hover Color', 'onum' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn:hover i, {{WRAPPER}} .octf-btn:focus i' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_hover_bg',
			[
				'label' => __( 'Hover Background', 'onum' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn:hover i, {{WRAPPER}} .octf-btn:focus i' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'button', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'button', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'button', 'rel', 'nofollow' );
			}
		}

		$this->add_render_attribute( 'button', 'class', 'octf-btn' );

		$this->add_render_attribute( 'button', 'class', 'octf-btn-'.$settings['btn_style_color'] );

		if( $settings['btn_style'] == 'btn-icon' ) {
			$this->add_render_attribute( 'button', 'class', 'octf-btn-icon' );
		}else{
			$this->add_render_attribute( 'button', 'class', 'octf-btn-no-icon' );
		}

		if( $settings['btn_icon']['value'] ) {
			$this->add_render_attribute( 'button', 'class', 'awesome-icon' );
		}

		if ( $settings['hover_animation'] ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['hover_animation'] );
		}

		?>
		<div class="ot-button">
			<a <?php echo $this->get_render_attribute_string( 'button' ); ?>><span><?php echo $settings['text'].'</span>'; if( ! empty( $settings['btn_icon']['value'] ) ) { ?> <i class="<?php echo esc_attr( $settings['btn_icon']['value'] ); ?>"></i><?php } ?></a>
	    </div>
	    <?php
	}

	protected function _content_template() {}
}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register_widget_type( new Onum_Button() );