<?php
/**
 * Registering meta boxes
 *
 * Using Meta Box plugin: http://www.deluxeblogtips.com/meta-box/
 *
 * @see https://docs.metabox.io/
 *
 * @param array $meta_boxes Default meta boxes. By default, there are no meta boxes.
 *
 * @return array All registered meta boxes
 */

function onum_register_meta_boxes( $meta_boxes ) {

	// Page Settings
	$meta_boxes[] = array(
		'id'       => 'page-settings',
		'title'    => esc_html__( 'Page Settings', 'onum' ),
		'pages'    => array( 'page' ),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(
            array(
                'id'        => 'page_layout',
                'name'      => esc_html__( 'Page Layout', 'onum' ),
                'type'      => 'image_select',
                'options'   => array(
                    'full-content'    => get_template_directory_uri() . '/inc/backend/images/full.png',
                    'content-sidebar' => get_template_directory_uri() . '/inc/backend/images/right.png',
                    'sidebar-content' => get_template_directory_uri() . '/inc/backend/images/left.png',
                ),
                'std'       => 'full-content'
            ),
            array(
                'name'             => esc_html__( 'Page Header On/Off', 'onum' ),
                'id'               => 'pheader_switch',
                'type'             => 'switch',
                'style'            => 'rounded',
                'on_label'         => 'On',
                'off_label'        => 'Off',
                'std'              => 'on'
            ),
            array(
                'name'             => esc_html__( 'Background Page Header', 'onum' ),
                'id'               => 'pheader_bg_image',
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
            )
		),
	);
    $meta_boxes[] = array(
        'id'       => 'extra-settings',
        'title'    => esc_html__( 'Extra Settings', 'onum' ),
        'pages'    => array( 'ot_service', 'ot_portfolio' ),
        'context'  => 'normal',
        'priority' => 'high',
        'autosave' => true,
        'fields'   => array(
            array(
                'name'             => esc_html__( 'Page Header On/Off', 'onum' ),
                'id'               => 'pheader_switch',
                'type'             => 'switch',
                'style'            => 'rounded',
                'on_label'         => 'On',
                'off_label'        => 'Off',
                'std'              => 'on'
            ),
            array(
                'name'             => esc_html__( 'Background Page Header', 'onum' ),
                'id'               => 'pheader_bg_image',
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
            )
        ),
    );
	$meta_boxes[] = array (
      'id' => 'select-header-footer',
      'title' => 'General Settings',
      'pages' =>   array ('page',),
      'context' => 'normal',
      'priority' => 'high',
      'autosave' => false,
      'fields' =>   array (  
        array (
        	'name' => 'Footer Version',
			'id' => 'select_footer',
			'type'        => 'post',

		    // Post type.
		    'post_type'   => 'ot_footer_builders',

		    // Field type.
		    'field_type'  => 'select_advanced',

		    // Placeholder, inherited from `select_advanced` field.
		    'placeholder' => 'Select a footer',

		    // Query arguments. See https://codex.wordpress.org/Class_Reference/WP_Query
		    'query_args'  => array(
		        'post_status'    => 'publish',
		        'posts_per_page' => - 1,
		        'orderby' => 'date',
		        'order' => 'ASC',
		    ),
        ),
      ),
    );

	// Post format's meta box
	$meta_boxes[] = array(
		'id'       => 'format_detail',
		'title'    => esc_html__( 'Format Details', 'onum' ),
		'pages'    => array( 'post' ),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(
			array(
			    'name'          => 'Page Header Background Overlay',
			    'id'            => 'pheader_bgcolor_overlay',
			    'type'          => 'color',
			    // Add alpha channel?
			    'alpha_channel' => true,
			    'class' => 'gallery link image quote video audio standard',
			),
			array(
				'name'             => esc_html__( 'Image', 'onum' ),
				'id'               => 'post_image',
				'type'             => 'image_advanced',
				'class'            => 'image',
				'max_file_uploads' => 1,
				// Image size that displays in the edit page. Possible sizes small,medium,large,original
    			'image_size'       => 'thumbnail',
			),
			array(
				'name'  => esc_html__( 'Gallery', 'onum' ),
				'id'    => 'post_gallery',
				'type'  => 'image_advanced',
				'class' => 'gallery',
				// Image size that displays in the edit page. Possible sizes small,medium,large,original
    			'image_size'       => 'thumbnail',
			),			
			array(
				'name'  => esc_html__( 'Audio', 'onum' ),
				'id'    => 'post_audio',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'audio',
				'desc'  => 'Example: https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/139083759',
			),
			array(
				'name'  => esc_html__( 'Video', 'onum' ),
				'id'    => 'post_video',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'video',
				'desc'  => 'Example: https://vimeo.com/87959439',
			),
			array(
				'name'  => esc_html__( 'Background Video', 'onum' ),
				'id'    => 'bg_video',
				'type'  => 'image_advanced',
				'class' => 'video',
				'max_file_uploads' => 1,
			),
			array(
				'name'  => esc_html__( 'Link', 'onum' ),
				'id'    => 'post_link',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'link',
			),
			array(
				'name'  => esc_html__( 'Text Link', 'onum' ),
				'id'    => 'text_link',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'link',
			),
			array(
				'name'  => esc_html__( 'Quote', 'onum' ),
				'id'    => 'post_quote',
				'type'  => 'textarea',
				'class' => 'quote',
			),
			array(
				'name'  => esc_html__( 'Quote Name', 'onum' ),
				'id'    => 'quote_name',
				'type'  => 'text',
				'class' => 'quote',
			)		
		),
	);

	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'onum_register_meta_boxes' );
