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
					echo '<div class="placeholder style2_placehloder load show-title" data-source="'.$attach_img[0].'"></div>';
				}
			}
		?>
	</div>
</div>
<?php 
get_template_part( 'portfolio/gallery', 'content' );
be_slider_carousel(false);
?>