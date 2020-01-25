<?php 

class OT_Instagram_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'instagram_widget',
			'description' => esc_html__( 'Display Instagram posts from your Instagram accounts', 'onum' ),
		);
		parent::__construct(
			'instagram_widget', // Base ID
			esc_html__( 'OT Instagram Feeds', 'onum' ), // Name
			$widget_ops // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$instagram_id = uniqid('instagram-');
		$userid = ! empty( $instance['userid'] ) ? $instance['userid'] : '3562342745';
		$clientid = ! empty( $instance['clientid'] ) ? $instance['clientid'] : 'f7fc30e47288421caa53b0ac4000eba2';
		$accesstoken = ! empty( $instance['accesstoken'] ) ? $instance['accesstoken'] : '3562342745.1677ed0.687f4350c57f4af29e8aee0cd564b7b5';
		$limit = ! empty( $instance['limit'] ) ? $instance['limit'] : 6;

		if ( ! empty( $title ) ){
			echo $args['before_title'] . $title . $args['after_title'];
		}

		?>
		<div id="<?php echo esc_attr($instagram_id); ?>" class="widget-insta-feeds instafeed-gallery" 
			data-instafeed-widgetid="<?php echo esc_attr($instagram_id); ?>" 
			data-instafeed-userid="<?php echo esc_attr($userid); ?>" 
			data-instafeed-clientid="<?php echo esc_attr($clientid); ?>" 
			data-instafeed-accesstoken="<?php echo esc_attr($accesstoken); ?>"			 
			data-instafeed-limit="<?php echo esc_attr($limit); ?>"			
			></div>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$userid = ! empty( $instance['userid'] ) ? $instance['userid'] : '3562342745';
		$clientid = ! empty( $instance['clientid'] ) ? $instance['clientid'] : 'f7fc30e47288421caa53b0ac4000eba2';
		$accesstoken = ! empty( $instance['accesstoken'] ) ? $instance['accesstoken'] : '3562342745.1677ed0.687f4350c57f4af29e8aee0cd564b7b5';
		$limit = ! empty( $instance['limit'] ) ? $instance['limit'] : 6;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'onum' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'userid' ) ); ?>"><?php esc_attr_e( 'userId:', 'onum' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'userid' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'userid' ) ); ?>" type="text" value="<?php echo esc_attr( $userid ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'clientid' ) ); ?>"><?php esc_attr_e( 'clientId:', 'onum' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'clientid' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'clientid' ) ); ?>" type="text" value="<?php echo esc_attr( $clientid ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'accesstoken' ) ); ?>"><?php esc_attr_e( 'accessToken:', 'onum' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'accesstoken' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'accesstoken' ) ); ?>" type="text" value="<?php echo esc_attr( $accesstoken ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php esc_attr_e( 'Limit:', 'onum' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="text" value="<?php echo esc_attr( $limit ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['userid'] = ( ! empty( $new_instance['userid'] ) ) ? sanitize_text_field( $new_instance['userid'] ) : '';
		$instance['clientid'] = ( ! empty( $new_instance['clientid'] ) ) ? sanitize_text_field( $new_instance['clientid'] ) : '';
		$instance['accesstoken'] = ( ! empty( $new_instance['accesstoken'] ) ) ? sanitize_text_field( $new_instance['accesstoken'] ) : '';
		$instance['limit'] = ( ! empty( $new_instance['limit'] ) ) ? sanitize_text_field( $new_instance['limit'] ) : '';

		return $instance;
	}
}

// register OT_Instagram_Widget widget
function register_ot_instagramfeeds_widget() {
    register_widget( 'OT_Instagram_Widget' );
}
add_action( 'widgets_init', 'register_ot_instagramfeeds_widget' );