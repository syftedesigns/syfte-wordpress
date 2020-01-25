<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ONUM
 */

get_header();
?>

<div class="container">
    <div class="error-404 not-found text-center">
		<h2>404 <img class="error-image" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/404.png" alt="404"></h2>
        <h1><?php wp_kses( _e( 'Sorry! Page Not Found!', 'onum' ), wp_kses_allowed_html('post')  ); ?></h1>
        <div class="content-404">
            <p><?php wp_kses( _e( 'Oops! The page you are looking for does not exist. Please return to the site is homepage.', 'onum' ), wp_kses_allowed_html('post')  ); ?></p>
            <?php get_search_form(); ?>
            <a class="octf-btn octf-btn-third octf-btn-icon" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Take Me Home', 'onum' ); ?><i class="flaticon-right-arrow-1"></i></a>
        </div>
    </div>
</div>

<?php
get_footer();