<div class="post-thumb">
	<?php
		//echo '<div class="gal-wrap">';
		$gallery_images = get_post_meta(get_the_ID(),'be_themes_gal_post_format');
		if(!empty($gallery_images)){
			$output = '[flex_slider]';
			foreach ($gallery_images as $image) {
				$output .='[flex_slide image="'.$image.'" size="blog-image"]';
			}
			$output .='[/flex_slider]';
			echo do_shortcode($output);
		}
		// echo '</div>';
	?>
</div>