<div>
	<span class="arrow_prev"><i class="font-icon icon-left-open-big"></i></span>
	<span class="arrow_next"><i class="font-icon icon-right-open-big"></i></span>
	<?php
		global $be_themes_data;
		if(!empty($be_themes_data['back_to_portfolio']) && $be_themes_data['back_to_portfolio']) {
			echo '<a class="single_portfolio_back" href="'.$be_themes_data['back_to_portfolio'].'"><i class="font-icon icon-th"></i></a>';
		}
	?>
	<span class="single_portfolio_close"><i class="font-icon icon-cancel"></i></span>
	<div class="gallery_content">
		<div class="gallery_content_area_wrap">
			<div class="gallery_content_area">
				<h3 class="post-title gallery-title"><?php echo get_the_title(); ?></h3>
				<div class="gallery_scrollable_content">
					<?php the_content(); ?>
				</div>
				<?php
					$postcontent = '';
					$post_id = get_the_ID();
					if(get_post_meta($post_id,'be_themes_portfolio_client_name',true)  || get_post_meta($post_id,'be_themes_portfolio_project_date',true) || get_be_themes_category_list($post_id) || get_post_meta($post_id,'be_themes_portfolio_visitsite_url',true)) {
						$postcontent .= '<nav><ul class="post-header clearfix">';
						if(get_be_themes_category_list($post_id, true)) {
							$postcontent .= '<li class="date_post project-cats"><i class="font-icon icon-tag"></i>'.get_be_themes_category_list($post_id, true).' </li>';
						}
						if(get_post_meta($post_id,'be_themes_portfolio_client_name',true)) {
							$postcontent .= '<li class="date_post"><i class="font-icon icon-doc-text"></i><span class="project_client">'.get_post_meta($post_id,'be_themes_portfolio_client_name',true).'</span></li>';
						}
						// if(get_post_meta($post_id,'be_themes_portfolio_project_date',true)) {
						// 	$postcontent .= '<li class="date_post">'.get_post_meta($post_id,'be_themes_portfolio_project_date',true).'<span class="backslash">/</span></li>';
						// }
						if(get_post_meta($post_id,'be_themes_portfolio_visitsite_url',true)) {
							$postcontent .= '<li class="visit-site"><a href="'.get_post_meta($post_id,'be_themes_portfolio_visitsite_url',true).'" target="_blank"><i class="font-icon icon-link"></i>'.get_post_meta($post_id,'be_themes_portfolio_visitsite_url',true).'</a></li>';
						}
						$postcontent .='</ul></nav>';
					}
					echo $postcontent;
				?>
			</div>
		</div>
		<span class="single_portfolio_info_close"><i class="font-icon icon-menu"></i></span>
	</div>
</div>
