<div class="post-thumb">
	<div class="thumb-wrap">
		<?php 
			$video_url = get_post_meta(get_the_ID(),'be_themes_video_url',true);
			if(!empty($video_url)) {
				$video_type = be_themes_video_type($video_url);
				if(!empty($video_type)) {
					echo do_shortcode('[video source="'.$video_type.'" url="'.$video_url.'"]');
				}			
			}
		?>
	</div>
</div>