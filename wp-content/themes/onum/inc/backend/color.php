<?php 
//Custom Style Frontend
if(!function_exists('onum_color_scheme')){
    function onum_color_scheme(){
        $color_scheme = array();


        //Main Color
        if( onum_get_option('main_color') != '#fe4c1c' || onum_get_option('second_color') != '#00c3ff' || onum_get_option('third_color') != '#0160e7' ){
            $color_scheme[] = 
            '
            .bg-gradient,
            .bg-hover-gradient:hover,
            .author-widget_wrapper,
            .service-box .number-box,
            .service-box .overlay,
            .icon-box.s1 .icon-main, .icon-box.s4 .icon-main,
            .icon-box.s3 .icon-main,
            .icon-box.s3 .bg-s3,
            .icon-box-grid,
            .process-box .number-box,
            .ot-testimonials .testimonial-wrap .bg-block,
            .projects-box .portfolio-info .portfolio-info-inner{ 
                background-color: '.onum_get_option('third_color').';
                background-image:-moz-linear-gradient(145deg, '.onum_get_option('third_color').', '.onum_get_option('second_color').');
                background-image:-webkit-linear-gradient(145deg, '.onum_get_option('third_color').', '.onum_get_option('second_color').');
                background-image:linear-gradient(145deg, '.onum_get_option('third_color').', '.onum_get_option('second_color').'); 
            }

            /**** Main Color ****/

            	/* Background Color */
                blockquote:before,
                .bg-primary,
                .octf-btn,
                .octf-btn.octf-btn-white i,
                .octf-btn-primary,
                .post-box .post-cat a,
                .blog-post .share-post a,
                .widget-area .widget .widget-title:before,
                .search-form .search-submit i,
                .ot-pricing-table.s3 .title-table,
                .ot-tabs .tab-link,
                .ot-counter h6:before,
                .dc-text.dc-bg-primary .elementor-drop-cap,
                .mc4wp-form-fields .subscribe-inner-form .subscribe-btn-icon i{ background-color: '.onum_get_option('main_color').'; }
    			
    			/* Color */
                .text-primary,
                .octf-btn.octf-btn-white,
                .octf-btn.octf-btn-white:visited, .octf-btn.octf-btn-white:hover, .octf-btn.octf-btn-white:focus,
                .octf-btn-icon i,
                a:hover, a:focus, a:active,
                .header-topbar a:hover,
                .header-overlay .header-topbar a:hover,
                .header_mobile .mobile_nav .mobile_mainmenu li li a:hover,.header_mobile .mobile_nav .mobile_mainmenu ul > li > ul > li.current-menu-ancestor > a,
                .header_mobile .mobile_nav .mobile_mainmenu > li > a:hover, .header_mobile .mobile_nav .mobile_mainmenu > li.current-menu-item > a,.header_mobile .mobile_nav .mobile_mainmenu > li.current-menu-ancestor > a,
                .page-header .breadcrumbs li a:hover,
                .post-box .post-cat a:hover,
                .post-box .entry-meta a:hover i,
                .post-box .entry-title a:hover,
                .blog-post .author-bio .author-info .author-socials a:hover,
                .drop-cap span,
                .sl-wrapper .sl-icon svg,
                .comments-area .comment-item .comment-meta .comment-reply-link:hover,
                .comment-respond .comment-reply-title small a:hover,
                .comment-form .logged-in-as a:hover,
                .icon-box .content-box h5 a:hover,
                .icon-box.s3:hover h5 a:hover, .icon-box.s3:hover p a:hover,
                .icon-box-grid .icon-box .content-box h5 a:hover,
                .ot-pricing-table.s3 h2,
                .ot-tabs .tab-content ul.has-icon li i,
                .ot-counter h6,
                .video-popup a,
                .dc-text .elementor-drop-cap span{ color: '.onum_get_option('main_color').'; }
    			
    		/**** Second Color ****/
            
    		    /* Background Color */
                .bg-second,
                .slick-arrow:not(.slick-disabled):hover,
                .octf-btn-secondary,
                .octf-btn-secondary.octf-btn-white i,
                .main-navigation > ul > li:after,.main-navigation > ul > li:before,
                .main-navigation ul li li a:before,
                .cart-contents .count,
                .post-box .btn-play i:hover,
                .page-pagination li span, .page-pagination li a:hover,
                .blog-post .tagcloud a:hover,
                .widget .tagcloud a:hover,
                .widget-area .widget ul:not(.recent-news) > li a:hover:before,
                .search-form .search-submit i:hover,
                .ot-heading.text-light h6:before, .ot-heading.text-light h6:after,
                .team-wrap .team-social a, .team-wrap .team-social span,
                .ot-progress .progress-bar,
                .ot-pricing-table .title-table,
                .ot-tabs .tab-link.current, .ot-tabs .tab-link:hover,
                .ot-accordions .acc-item .acc-toggle i,
                .slider,
                .video-popup a:hover,
                .dc-text.dc-bg-second .elementor-drop-cap,
                div .custom .tp-bullet:after,
                .grid-lines .line-cleft .g-dot,
                .grid-lines .line-cright .g-dot,
                .project_filters li a:after{ background-color: '.onum_get_option('second_color').'; }        

                /* Color */            
                .text-second,
                .slick-arrow,
                .octf-btn-secondary i,
                .octf-btn-secondary.octf-btn-white,
                .octf-btn-secondary.octf-btn-white:visited, .octf-btn-secondary.octf-btn-white:hover, .octf-btn-secondary.octf-btn-white:focus,
                a,
                a:visited,
                .topbar-info li i,
                .main-navigation ul > li > a:hover,
                .main-navigation ul li li a:hover,.main-navigation ul ul li.current-menu-item > a,.main-navigation ul ul li.current-menu-ancestor > a,
                .header-style-1.header-overlay .btn-cta-header a,
                .post-box .link-box a:hover,
                .post-box .link-box i,
                .post-box .quote-box i,
                .post-box .btn-play i,
                .widget-area .widget ul:not(.recent-news) > li a:hover,
                .widget-area .widget ul:not(.recent-news) > li a:hover + span,
                .widget .recent-news h6 a:hover,
                .service-box:hover .number-box,
                .service-box-s2 .number-box,
                .active .service-box .number-box,
                .icon-box.s1:hover .icon-main, .icon-box.s4:hover .icon-main,
                .icon-box.s3:hover .icon-main,
                .active .icon-box.s1 .icon-main,
                .active .icon-box.s3 .icon-main,
                .team-wrap .team-social.active span,
                .ot-pricing-table .inner-table h2,
                .ot-accordions .acc-item .acc-toggle:hover,
                .ot-accordions .acc-item.current .acc-toggle,
                .slick-dots li.slick-active button:before,
                .real-numbers > span.active,
                .real-numbers .chart-boxs .chart-item h2,
                .dc-text.dc-text-second .elementor-drop-cap span,
                .projects-style-2 .projects-box .portfolio-info .portfolio-cates,
                .projects-style-2 .projects-box .portfolio-info .portfolio-cates a,
                .project_filters li a:hover, .project_filters li a.selected,
                .ot-countdown li.seperator,
                #back-to-top{ color: '.onum_get_option('second_color').'; }

                /* Border Color */
                .video-popup a:hover span{ border-color: '.onum_get_option('second_color').'; }

            /**** Third Color ****/
                
                /* Background Color */
                .bg-third,
                .octf-btn-third,
                .octf-btn-third.octf-btn-white i,
                .ot-pricing-table.s2 .title-table,
                .message-box .icon-main,
                input:checked + .slider,
                .dc-text.dc-bg-third .elementor-drop-cap,
                .grid-lines .g-dot{ background-color: '.onum_get_option('third_color').'; }

                /* Color */
                .text-third,
                .octf-btn-third i,
                .octf-btn-third.octf-btn-white,
                .octf-btn-third.octf-btn-white:visited, .octf-btn-third.octf-btn-white:hover, .octf-btn-third.octf-btn-white:focus,
                .post-nav a,
                .post-nav a:hover span,
                .icon-box.s2 .icon-main,
                .icon-box-grid .icon-box:hover .icon-main,
                .ot-pricing-table.s2 h2,
                .tab-titles .title-item:hover .icon-main, .tab-titles .title-item.tab-active .icon-main,
                .real-numbers > span.a-switch.active,
                .dc-text.dc-text-third .elementor-drop-cap span{ color: '.onum_get_option('third_color').'; }

			';
        }

        if (onum_get_option('cta_box_shadow_header') != '') {
            $color_scheme[] = '                
                /* CTA Button */
                .site-header .btn-cta-header a, .header-style-1.header-overlay .btn-cta-header a {
                    box-shadow: 12px 12px 20px 0px '.onum_get_option('cta_box_shadow_header').';
                    -webkit-box-shadow: 12px 12px 20px 0px '.onum_get_option('cta_box_shadow_header').';
                    -moz-box-shadow: 12px 12px 20px 0px '.onum_get_option('cta_box_shadow_header').';
                }
            ';
        }

        if(! empty($color_scheme)){
			echo '<style type="text/css">'. implode( ' ', $color_scheme ) .'</style>';
		}
    }
}
add_action('wp_head', 'onum_color_scheme');