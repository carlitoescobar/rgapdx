<?php 
global $be_themes_data;
global $blog_style;
if( has_post_thumbnail() ) :
	$blog_image_size = ( 'style2' == $blog_style ) ? 'blog-image-2' : 'large';
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $blog_image_size );
    $thumb_full = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );    
	$url = $thumb['0'];
	$attachment_full_url = $thumb_full[0];
endif;
$class = '';
if((isset($be_themes_data['open_to_lightbox']) && 1 == $be_themes_data['open_to_lightbox']) || is_single()) {
	$link = $attachment_full_url;
	$class = 'image-popup-vertical-fit mfp-image';
} else {
	$link = get_permalink();
}
if( !empty( $url ) ) : ?>
<div class="post-thumb">	
	<div class="element-inner">        	
		<a href="<?php echo $link ?>" class="<?php echo $class; ?> thumb-wrap">
			<?php the_post_thumbnail( $blog_image_size ); ?>
			<div class="thumb-overlay">
				<div class="thumb-bg">
					<div class="thumb-title fadeIn animated">
						<i class="portfolio-ovelay-icon"></i>
					</div>
				</div>
			</div>
		</a>
	</div>			
</div>
<?php endif; ?>