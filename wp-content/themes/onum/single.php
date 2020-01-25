<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ONUM
 */

get_header();
$format = get_post_format();
$link_video  = get_post_meta(get_the_ID(),'post_video', true);
$link_audio  = get_post_meta(get_the_ID(),'post_audio', true);
$link_link   = get_post_meta(get_the_ID(),'post_link', true);
$text_link   = get_post_meta(get_the_ID(),'text_link', true);
$quote_text  = get_post_meta(get_the_ID(),'post_quote', true);
$quote_name  = get_post_meta(get_the_ID(),'quote_name', true);
$pheader_bgcolor = '';
if( function_exists( 'rwmb_meta' ) ) {
	if ( rwmb_meta( 'pheader_bgcolor_overlay' ) ) {
		$pheader_bgcolor .= 'style="background: ' . rwmb_meta( 'pheader_bgcolor_overlay' ) . '"';
	}
}
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="single-page-header post-box" <?php if( $format == 'link' || $format == 'quote' || $format == 'standard' ){ echo $pheader_bgcolor; } ?> >
	<?php if( $format == 'gallery' || $format == 'image' || $format == 'video' ){ echo '<div class="single-bg-overlay" '. $pheader_bgcolor .'></div>'; } ?>
	<?php if( $format == 'gallery' ) { ?>
		<div class="entry-media">			
			<div class="gallery-post">
			<?php if( function_exists( 'rwmb_meta' ) ) { ?>
	            <?php $images = rwmb_meta( 'post_gallery', array( 'size' => 'onum-blog-single-post-page-header' ) ); ?>
	            <?php if($images){ ?>              
	                <?php foreach ( $images as $image ) {  ?>		                    
	                    <div>
	                    	<div class="item-image">
		                    	<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
		                    </div>
	                    </div>                    
	                <?php } ?>                
	            <?php } ?>
	        <?php } ?>
	        </div>
		</div>			
    <?php }elseif( $format == 'image' ) { ?>
    	<div class="entry-media">
			<?php if( function_exists( 'rwmb_meta' ) ) { ?>
			    <?php $images = rwmb_meta( 'post_image', array( 'size' => 'onum-blog-single-post-page-header' ) ); ?>
			    <?php if($images){ ?>              
			        <?php foreach ( $images as $image ) {  ?>				            			            
			            <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">			            
			        <?php } ?>                
			    <?php } ?>
			<?php } ?>
		</div>
    <?php }elseif( $format == 'audio' ){ ?>
    	<div class="container">
			<div class="row">	
				<div class="col-md-12">
					<div class="audio-box">
						<iframe scrolling="no" frameborder="no" src="<?php echo esc_url( $link_audio ); ?>"></iframe>
					</div>
				</div>
	    	</div>
		</div>		
    <?php }elseif( $format == 'video' ){ ?>
    	<a class="btn-play" href="<?php echo esc_url( $link_video ); ?>">
			<i class="fas fa-play"></i>
		</a>
		<div class="entry-media">			
			<?php if( function_exists( 'rwmb_meta' ) ) { ?>
			    <?php $images = rwmb_meta( 'bg_video', array( 'size' => 'onum-blog-single-post-page-header' ) ); ?>
			    <?php if($images){ ?>              
			        <?php  foreach ( $images as $image ) {  ?>
			            <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>">
			        <?php } ?>                
			    <?php } ?>
			<?php } ?>
		</div>
    <?php }elseif( $format == 'link' ){ ?>
    	<div class="container">
			<div class="row">	
				<div class="col-md-12">
					<div class="link-box">
						<i class="flaticon-link"></i>
						<a href="<?php echo esc_url( $link_link ); ?>"><?php echo esc_html( $text_link ); ?></a>
					</div>
				</div>
	    	</div>
		</div>
    <?php }elseif( $format == 'quote' ){ ?>
    	<div class="container">
			<div class="row">	
				<div class="col-md-12">
					<div class="quote-box font-second">
						<i class="flaticon-quotation"></i>
						<div class="quote-text">
							<?php echo esc_html( $quote_text ); ?>
							<span><?php echo esc_html( $quote_name ); ?></span>
						</div>
					</div>
				</div>
	    	</div>
		</div>
    <?php } ?>

    <div class="<?php if( $format == 'gallery' || $format == 'image' || $format == 'video' ){ echo 'sing-page-header-content'; }else{ echo 'padding-top-40 audio-post'; } ?>">
    	<div class="container">
			<div class="row">	
				<div class="col-md-12">
				    <?php onum_posted_in(); ?>
				    <div class="entry-header">			        
				        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				        <?php if ( 'post' === get_post_type() ) : if( onum_get_option( 'post_entry_meta' ) ) { ?>
					        <div class="entry-meta">
					            <?php onum_post_meta(); ?>
					            <?php echo do_shortcode( '[otfliker]' ); ?>
					        </div><!-- .entry-meta -->
				        <?php } endif; ?>
				    </div>
			    </div>
	    	</div>
		</div>
    </div>
</div>
<?php endwhile; endif; // End of the loop. ?>

<div class="entry-content">
	<div class="container">
		<div class="row">
			<div id="primary" class="content-area <?php onum_content_columns(); ?>">
				<main id="main" class="site-main">
									
					<?php
						if ( have_posts() ) : while ( have_posts() ) : the_post();							
							get_template_part( 'template-parts/content', 'single' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; endif; // End of the loop.
					?>

				</main><!-- #main -->
			</div><!-- #primary -->
			
			<?php get_sidebar(); ?>
		</div>
	</div>	
</div>

<?php
get_footer();
