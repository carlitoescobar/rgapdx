<div id="gallery-container-wrap" class="clearfix">
	<div id="gallery-container" class="inline-wrap">
		<?php
			$args = array(
				'post_type' => 'attachment',
				'numberposts' => -1,
				'post_status' => null,
				'post_parent' => get_the_ID()
			);
			$attachments = get_post_meta(get_the_ID(),'be_themes_single_portfolio_slider_images');
			if(!empty($attachments)) {
				foreach ( $attachments as $attachment_id ) {
					$attach_img = wp_get_attachment_image_src($attachment_id, 'full');
					$video_url = get_post_meta($attachment_id, 'be_themes_featured_video_url', true);
					if($video_url) {
						$data_source = 'video';
					} else {
						$data_source = $attach_img[0];
					}
					echo '<div class="placeholder style1_placehloder load show-title" data-source="'.$data_source.'">';
					if($video_url) {
						echo be_gal_video($video_url);
					} else {
						echo '<img src="" style="opacity: 0; display: block;" />';
					}
					echo '<div class="overlay_placeholder"></div></div>';
				}
			}
		?>
	</div>
</div>
<?php 
	get_template_part( 'portfolio/gallery', 'content' );
	be_slider_carousel();
?>