<?php
/**
 * Hooks for importer
 *
 * @package ONUM
 */


/**
 * Importer the demo content
 *
 * @since  1.0
 *
 */
function onum_importer() {
	return array(
		array(
			'name'       => 'Home 1',
			'preview'    => get_template_directory_uri().'/inc/backend/data/home1.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/widgets.wie',
			'pages'      => array(
				'front_page' => 'Home 1',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home 2',
			'preview'    => get_template_directory_uri().'/inc/backend/data/home2.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/widgets.wie',
			'sliders'    => get_template_directory_uri().'/inc/backend/data/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 2',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home 3',
			'preview'    => get_template_directory_uri().'/inc/backend/data/home3.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/widgets.wie',
			'pages'      => array(
				'front_page' => 'Home 3',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
	);
}

add_filter( 'soo_demo_packages', 'onum_importer', 30 );