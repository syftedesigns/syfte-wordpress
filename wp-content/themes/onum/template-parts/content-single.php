<?php
/**
 * Template part for displaying single post content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ONUM
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-box blog-post'); ?>>
    <div class="inner-post no-padding-top">
        <div class="entry-summary">

            <?php

                the_content(sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'onum'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ));

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'onum'),
                    'after' => '</div>',
                ));
            ?>

        </div>
        <div class="entry-footer clearfix">
            <?php onum_entry_footer(); ?>
        </div>
        <?php if( onum_get_option('author_box') ) onum_author_info_box(); ?>
        <?php if( onum_get_option('post_nav') ) onum_single_post_nav(); ?>
        <?php if( onum_get_option('related_post') ) onum_related_posts(); ?>
    </div>
</article>