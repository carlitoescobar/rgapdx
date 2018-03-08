<div id="gallery-container-wrap" class="clearfix">
	<div id="gallery-container">
		<?php
			$attachments = get_post_meta(get_the_ID(),'be_themes_single_portfolio_slider_images');			if(!empty($attachments)) {				foreach ( $attachments as $attachment_id ) {					$attach_img = wp_get_attachment_image_src($attachment_id, 'full');					$video_url = get_post_meta($attachment_id, 'be_themes_featured_video_url', true);					if($video_url) {						$data_source = 'video';					} else {						$data_source = $attach_img[0];					}					echo '<div class="placeholder load center show-title" data-source="'.$data_source.'">';					if($video_url) {						echo be_gal_video($video_url);					}					echo '</div>';				}			}
		?>
	</div>
</div>
<?php 
get_template_part( 'portfolio/gallery', 'content' );
be_slider_carousel(false);
?>