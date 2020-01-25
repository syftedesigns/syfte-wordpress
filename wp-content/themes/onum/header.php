<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ONUM
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="site-header" class="site-header <?php onum_header_class(); ?>" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
		<?php if ( onum_get_option('topbar_switch') != false ) { ?>
			<!-- Top bar start -->
			<div class="header-topbar">
				<div class="octf-area-wrap">
					<div class="<?php onum_header_width_class(); ?>">				
						<!-- Header Topbar Menus -->
						<?php 
							wp_nav_menu( array(
							    'menu'           => onum_get_option('topbar_menu'), // Do not fall back to first non-empty menu.
							    'theme_location' => '__no_such_location',
							    'fallback_cb'    => false, // Do not fall back to wp_page_menu()
							    'container_class' => 'topbar_menu',
							    'menu_class'      => 'menu clearfix'
							) );
						?>						
						<?php if ( onum_get_option('social_switch') != false ){ ?>
		                    <!-- social icons -->
		                    <ul class="social-list">
		                        <?php $socials = onum_get_option( 'header_socials', array() ); ?>
		                        <?php foreach ( $socials as $social ) { ?>
		                            <li><a href="<?php echo esc_url($social['social_link']); ?>" target="<?php echo esc_attr( onum_get_option( 'social_target_link' ) ); ?>" ><i class="<?php echo esc_attr($social['social_icon']); ?>"></i></a>
		                            </li>
		                        <?php } ?>
		                    </ul>
		                    <!-- social icons close -->
		                <?php } ?>		

		                <?php if ( is_active_sidebar( 'topbar_widget' ) ) : ?>
				        	<div class="topbar_languages">
				        		<?php dynamic_sidebar( 'topbar_widget' ); ?>
				        	</div>
						<?php endif; ?>	

		                <?php if ( onum_get_option('info_switch') != false ){ ?>
				            <!-- contact info -->
				            <ul class="topbar-info clearfix">
				                <?php $contact_infos = onum_get_option( 'header_contact_info', array() ); ?>
				                <?php foreach ( $contact_infos as $contact_info ) { ?>
				                    <li>
				                        <?php if($contact_info['info_icon'] != ''){ ?><i class="<?php echo esc_attr($contact_info['info_icon']); ?>"></i><?php } ?>
				                        <?php echo wp_specialchars_decode($contact_info['info_content']); ?>
				                    </li>
				                <?php } ?>
				            </ul>
				            <!-- contact info close -->
				        <?php } ?>				        
					</div>
				</div>
			</div>
			<!-- Top bar close -->
		<?php } ?>

		<!-- Main header start -->
		<div class="octf-main-header">
			<div class="octf-area-wrap">
				<div class="<?php onum_header_width_class(); ?> octf-mainbar-container">
					<div class="octf-mainbar">
						<div class="octf-mainbar-row octf-row">
							<div class="octf-col">
								<div id="site-logo" class="site-logo">
									<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>">
										<img itemprop="image" <?php if ( onum_get_option('logo_scroll') != '' ) { ?>class="logo-static"<?php } ?> src="<?php echo esc_url( onum_get_option('logo') ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
										<?php if ( onum_get_option('logo_scroll') != '' ) { ?>
											<img itemprop="image" class="logo-scroll" src="<?php echo esc_url( onum_get_option('logo_scroll') ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
										<?php } ?>
									</a>
								</div>
							</div>
							<div class="octf-col">
								<nav id="site-navigation" class="main-navigation">			
									<?php
										wp_nav_menu( array(
											'theme_location' => 'primary',
											'menu_id'        => 'primary-menu',
											'container'      => 'ul',
										) );
									?>
								</nav><!-- #site-navigation -->
							</div>
							<div class="octf-col text-right">
								<!-- Call To Action -->
								<div class="octf-btn-cta">
									<?php if ( onum_get_option('cart_switch') == true ){ ?>
									<div class="octf-header-module cart-btn-hover">
										<?php if ( class_exists( 'woocommerce' ) ) { ?>
											<div class="h-cart-btn octf-cta-icons">
												<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'onum' ); ?>"><i class="flaticon-supermarket"></i> <span class="count"><?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span>
												</a>	
											</div>	
											<?php if( !is_cart() && !is_checkout() ) { ?>
											<div class="site-header-cart">
												<?php the_widget( 'WC_Widget_Cart', array( 'title' => '' ) ); ?>
											</div>	
											<?php } ?>
										<?php } ?>
									</div>
									<?php } ?>
									<?php if ( onum_get_option('search_switch') == true ){ ?>
									<div class="octf-header-module">
										<div class="toggle_search octf-cta-icons">
											<i class="flaticon-search"></i>
										</div>
										<!-- Form Search on Header -->
										<div class="h-search-form-field">
											<div class="h-search-form-inner">
												<?php get_search_form(); ?>
											</div>									
										</div>
									</div>
									<?php } ?>
									<?php if ( onum_get_option('header_cta_switch') == true ){ ?>
									<div class="octf-header-module">
										<div class="btn-cta-group btn-cta-header">
											<a class="octf-btn octf-btn-third" href="<?php echo esc_url_raw( onum_get_option('cta_link_header') ); ?>"><?php echo onum_get_option('cta_text_header'); ?></a>
										</div>
									</div>
									<?php } ?>
								</div>								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
		<!-- Main header close -->

		<!-- Header mobile open -->
		<?php get_template_part('inc/frontend/header-mobile');  ?>
		<!-- Header mobile close -->

	</header><!-- #site-header -->

	<div id="content" class="site-content">
	<?php onum_page_header(); ?>

