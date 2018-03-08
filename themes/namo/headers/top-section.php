<?php
	$post_id = be_get_page_id();
	global $be_themes_data;
	if(is_singular( 'post' ) && is_single($post_id) && isset($be_themes_data['single_blog_hero_section_from']) && $be_themes_data['single_blog_hero_section_from'] == 'inherit_option_panel') {
		$hero_section = $be_themes_data['single_blog_hero_section'];
		if($hero_section && !empty($hero_section) && $hero_section != 'none') {
			echo '<div class="header-hero-section" id="hero-section">';
			if($hero_section == 'slider') {
				$hero_section_slider = $be_themes_data['single_blog_hero_section_slider_shortcode'];
				if($hero_section_slider) {
					echo do_shortcode($hero_section_slider);
				}
			}
			if($hero_section == 'custom') {
				echo '<div class="header-hero-custom-section">';
				$hero_section_with_header = $be_themes_data['single_blog_hero_section_with_header'];
				$hero_section_custom_height = $be_themes_data['single_blog_hero_section_custom_height'];
				if( !empty( $hero_section_custom_height ) ) {
					$full = '';
				} else {
					$full = 'full-screen-height';
				}
				$bg_color = $be_themes_data['single_blog_hero_section_bg_color'];
				$bg_image = $be_themes_data['single_blog_hero_section_bg_image'];
				$bg_repeat = $be_themes_data['single_blog_hero_section_bg_repeat'];
				$bg_attachment = $be_themes_data['single_blog_hero_section_bg_attachment'];
				$bg_position = $be_themes_data['single_blog_hero_section_bg_position'];
				if(!empty($be_themes_data['single_blog_hero_section_bg_scale']) && isset($be_themes_data['single_blog_hero_section_bg_scale']) && $be_themes_data['single_blog_hero_section_bg_scale'] ) {
					$bg_stretch = $be_themes_data['single_blog_hero_section_bg_scale'];
				} else {
					$bg_stretch = 0;
				}
				if(!empty($be_themes_data['single_blog_hero_section_bg_parallax']) && isset($be_themes_data['single_blog_hero_section_bg_parallax']) && $be_themes_data['single_blog_hero_section_bg_parallax'] ) {
					$bg_parallax = $be_themes_data['single_blog_hero_section_bg_parallax'];
				} else {
					$bg_parallax = 0;
				}
				if(!empty($be_themes_data['single_blog_hero_section_bg_mouse_move_parallax']) && isset($be_themes_data['single_blog_hero_section_bg_mouse_move_parallax']) && $be_themes_data['single_blog_hero_section_bg_mouse_move_parallax'] ) {
					$bg_mouse_move_parallax = $be_themes_data['single_blog_hero_section_bg_mouse_move_parallax'];
				} else {
					$bg_mouse_move_parallax = 0;
				}
				if(!empty($be_themes_data['single_blog_hero_section_bg_video']) && isset($be_themes_data['single_blog_hero_section_bg_video']) && $be_themes_data['single_blog_hero_section_bg_video'] ) {
					$bg_video = $be_themes_data['single_blog_hero_section_bg_video'];
				} else {
					$bg_video = 0;
				}
				$bg_video_mp4_src = $be_themes_data['single_blog_hero_section_bg_video_mp4'];
				$bg_video_mp4_src_ogg = $be_themes_data['single_blog_hero_section_bg_video_ogg'];
				$bg_video_mp4_src_webm = $be_themes_data['single_blog_hero_section_bg_video_webm'];
				if(!empty($be_themes_data['single_blog_hero_section_overlay']) && isset($be_themes_data['single_blog_hero_section_overlay']) && $be_themes_data['single_blog_hero_section_overlay'] ) {
					$bg_overlay = $be_themes_data['single_blog_hero_section_overlay'];
				} else {
					$bg_overlay = 0;
				}
				$overlay_color = $be_themes_data['single_blog_hero_section_bg_overlay_color'];
				$overlay_opacity = $be_themes_data['single_blog_hero_section_bg_overlay_opacity'];
				$content = stripslashes_deep(htmlspecialchars_decode( $be_themes_data['single_blog_hero_section_content'], ENT_QUOTES ) );
				if(!empty($be_themes_data['single_blog_hero_section_container_wrap']) && isset($be_themes_data['single_blog_hero_section_container_wrap']) && $be_themes_data['single_blog_hero_section_container_wrap'] ) {
					$section_container_wrap = $be_themes_data['single_blog_hero_section_container_wrap'];
				} else {
					$section_container_wrap = 0;
				}
				if($section_container_wrap == 'yes') {
					$be_wrap = 'be-wrap';
				} else {
					$be_wrap = '';
				}
				
				$background = '';
				if(empty( $bg_image  ) ){
					if( ! empty( $bg_color ) )
						$background = 'background-color: '.$bg_color.';';	
				} else {
					$attachment_url = $bg_image;
					if( ! empty( $attachment_url ) ) {
						if( (isset( $bg_parallax ) && 1 == $bg_parallax ) || (isset( $bg_mouse_move_parallax ) && 1 == $bg_mouse_move_parallax ) ) {
							$bg_position = 'center center';
						}
						$background = 'background:'.$bg_color.' url('.$attachment_url.') '.$bg_repeat.' '.$bg_attachment.' '.$bg_position.';';
					}
				}
				if( isset( $bg_stretch ) && 1 == $bg_stretch ) {
					$bg_stretch = 'be-bg-cover';
				} else {
					$bg_stretch = '';
				}
				if( $bg_mouse_move_parallax !=1 && isset( $bg_parallax ) && 1 == $bg_parallax ) {
					$bg_parallax = 'be-bg-parallax';
				} else {
					$bg_parallax = '';
				}
				if( isset( $bg_mouse_move_parallax ) && 1 == $bg_mouse_move_parallax ) {
					$bg_mouse_move_parallax = 'be-bg-mousemove-parallax';
				} else {
					$bg_mouse_move_parallax = '';
				}	

				$bg_overlay_class = '';
				$bg_video_class = '';
				if( isset( $bg_overlay ) && 1 == $bg_overlay ) {
					$bg_overlay_class = 'be-bg-overlay';
				}    
				if( isset( $bg_video ) && 1 == $bg_video ) {
					$bg_video_class = 'be-video-section';
				}

				$output = '';
				$output .= '<div class="hero-section-wrap be-section '.$full.' full-'.$hero_section_with_header.' '.$bg_stretch.' '.$bg_parallax.' '.$bg_mouse_move_parallax.' '.$bg_overlay_class.' '.$bg_video_class.' clearfix" style="'.$background.'; height: '.$hero_section_custom_height.'px !important;">';
				if( isset( $bg_video ) && 1 == $bg_video ) {
					$output .= '<video class="be-bg-video" autoplay="autoplay" loop="loop" muted="muted" preload="auto">';
					if($bg_video_mp4_src) {
						$output .= '<source src="'.$bg_video_mp4_src.'" type="video/mp4">';
					}
					if($bg_video_mp4_src_ogg) {
						$output .= '<source src="'.$bg_video_mp4_src_ogg.'" type="video/ogg">';
					}
					if($bg_video_mp4_src_webm) {
						$output .= '<source src="'.$bg_video_mp4_src_webm.'" type="video/webm">';
					}
					$output .= '</video>';
				}	   
				if( isset( $bg_overlay ) && 1 == $bg_overlay ) {
					$opacity = '';
					if($overlay_opacity) {
						$opacity .= '-ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity='.floatval($overlay_opacity).');';
						$opacity .= 'filter: alpha(opacity='.floatval($overlay_opacity).');';
						$opacity .= '-moz-opacity: '.floatval($overlay_opacity/100).';';
						$opacity .= '-khtml-opacity: '.floatval($overlay_opacity/100).';';
						$opacity .= 'opacity: '.floatval($overlay_opacity/100).';';
					}
					$output .= '<div class="section-overlay" style="background: '.$overlay_color.'; '.$opacity.'"></div>';
				}
				$output .= '<div class="be-row '.$be_wrap.'">';
				$output .= '<div class="hero-section-inner-wrap">';
				$output .= '<div class="hero-section-inner">'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) ).'</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				echo $output;
				echo '</div>';
			}
			echo '</div>';
		} else {
			echo '<div class="header-hero-section"></div>';
		}
	} else if((in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_product($post_id)) && isset($be_themes_data['single_shop_hero_section_from']) && $be_themes_data['single_shop_hero_section_from'] == 'inherit_option_panel') {
		$hero_section = $be_themes_data['single_shop_hero_section'];
		if($hero_section && !empty($hero_section) && $hero_section != 'none') {
			echo '<div class="header-hero-section" id="hero-section">';
			if($hero_section == 'slider') {
				$hero_section_slider = $be_themes_data['single_shop_hero_section_slider_shortcode'];
				if($hero_section_slider) {
					echo do_shortcode($hero_section_slider);
				}
			}
			if($hero_section == 'custom') {
				echo '<div class="header-hero-custom-section">';
				$hero_section_with_header = $be_themes_data['single_shop_hero_section_with_header'];
				$hero_section_custom_height = $be_themes_data['single_shop_hero_section_custom_height'];
				if( !empty( $hero_section_custom_height ) ) {
					$full = '';
				} else {
					$full = 'full-screen-height';
				}
				$bg_color = $be_themes_data['single_shop_hero_section_bg_color'];
				$bg_image = $be_themes_data['single_shop_hero_section_bg_image'];
				$bg_repeat = $be_themes_data['single_shop_hero_section_bg_repeat'];
				$bg_attachment = $be_themes_data['single_shop_hero_section_bg_attachment'];
				$bg_position = $be_themes_data['single_shop_hero_section_bg_position'];
				if(!empty($be_themes_data['single_shop_hero_section_bg_scale']) && isset($be_themes_data['single_shop_hero_section_bg_scale']) && $be_themes_data['single_shop_hero_section_bg_scale'] ) {
					$bg_stretch = $be_themes_data['single_shop_hero_section_bg_scale'];
				} else {
					$bg_stretch = 0;
				}
				if(!empty($be_themes_data['single_shop_hero_section_bg_parallax']) && isset($be_themes_data['single_shop_hero_section_bg_parallax']) && $be_themes_data['single_shop_hero_section_bg_parallax'] ) {
					$bg_parallax = $be_themes_data['single_shop_hero_section_bg_parallax'];
				} else {
					$bg_parallax = 0;
				}
				if(!empty($be_themes_data['single_shop_hero_section_bg_mouse_move_parallax']) && isset($be_themes_data['single_shop_hero_section_bg_mouse_move_parallax']) && $be_themes_data['single_shop_hero_section_bg_mouse_move_parallax'] ) {
					$bg_mouse_move_parallax = $be_themes_data['single_shop_hero_section_bg_mouse_move_parallax'];
				} else {
					$bg_mouse_move_parallax = 0;
				}
				if(!empty($be_themes_data['single_shop_hero_section_bg_video']) && isset($be_themes_data['single_shop_hero_section_bg_video']) && $be_themes_data['single_shop_hero_section_bg_video'] ) {
					$bg_video = $be_themes_data['single_shop_hero_section_bg_video'];
				} else {
					$bg_video = 0;
				}
				$bg_video_mp4_src = $be_themes_data['single_shop_hero_section_bg_video_mp4'];
				$bg_video_mp4_src_ogg = $be_themes_data['single_shop_hero_section_bg_video_ogg'];
				$bg_video_mp4_src_webm = $be_themes_data['single_shop_hero_section_bg_video_webm'];
				if(!empty($be_themes_data['single_shop_hero_section_overlay']) && isset($be_themes_data['single_shop_hero_section_overlay']) && $be_themes_data['single_shop_hero_section_overlay'] ) {
					$bg_overlay = $be_themes_data['single_shop_hero_section_overlay'];
				} else {
					$bg_overlay = 0;
				}
				$overlay_color = $be_themes_data['single_shop_hero_section_bg_overlay_color'];
				$overlay_opacity = $be_themes_data['single_shop_hero_section_bg_overlay_opacity'];
				$content = stripslashes_deep(htmlspecialchars_decode( $be_themes_data['single_shop_hero_section_content'], ENT_QUOTES ) );
				if(!empty($be_themes_data['single_shop_hero_section_container_wrap']) && isset($be_themes_data['single_shop_hero_section_container_wrap']) && $be_themes_data['single_shop_hero_section_container_wrap'] ) {
					$section_container_wrap = $be_themes_data['single_shop_hero_section_container_wrap'];
				} else {
					$section_container_wrap = 0;
				}
				if($section_container_wrap == 'yes') {
					$be_wrap = 'be-wrap';
				} else {
					$be_wrap = '';
				}
				
				$background = '';
				if(empty( $bg_image  ) ){
					if( ! empty( $bg_color ) )
						$background = 'background-color: '.$bg_color.';';	
				} else {
					$attachment_url = $bg_image;
					if( ! empty( $attachment_url ) ) {
						if( (isset( $bg_parallax ) && 1 == $bg_parallax ) || (isset( $bg_mouse_move_parallax ) && 1 == $bg_mouse_move_parallax ) ) {
							$bg_position = 'center center';
						}
						$background = 'background:'.$bg_color.' url('.$attachment_url.') '.$bg_repeat.' '.$bg_attachment.' '.$bg_position.';';
					}
				}
				if( isset( $bg_stretch ) && 1 == $bg_stretch ) {
					$bg_stretch = 'be-bg-cover';
				} else {
					$bg_stretch = '';
				}
				if( $bg_mouse_move_parallax != 1 && isset( $bg_parallax ) && 1 == $bg_parallax ) {
					$bg_parallax = 'be-bg-parallax';
				} else {
					$bg_parallax = '';
				}
				if( isset( $bg_mouse_move_parallax ) && 1 == $bg_mouse_move_parallax ) {
					$$bg_mouse_move_parallax = 'be-bg-mousemove-parallax';
				} else {
					$$bg_mouse_move_parallax = '';
				}	

				$bg_overlay_class = '';
				$bg_video_class = '';
				if( isset( $bg_overlay ) && 1 == $bg_overlay ) {
					$bg_overlay_class = 'be-bg-overlay';
				}    
				if( isset( $bg_video ) && 1 == $bg_video ) {
					$bg_video_class = 'be-video-section';
				}

				$output = '';
				$output .= '<div class="hero-section-wrap be-section '.$full.' full-'.$hero_section_with_header.' '.$bg_stretch.' '.$bg_parallax.' '.$bg_mouse_move_parallax.' '.$bg_overlay_class.' '.$bg_video_class.' clearfix" style="'.$background.'; height: '.$hero_section_custom_height.'px !important;">';
				if( isset( $bg_video ) && 1 == $bg_video ) {
					$output .= '<video class="be-bg-video" autoplay="autoplay" loop="loop" muted="muted" preload="auto">';
					if($bg_video_mp4_src) {
						$output .= '<source src="'.$bg_video_mp4_src.'" type="video/mp4">';
					}
					if($bg_video_mp4_src_ogg) {
						$output .= '<source src="'.$bg_video_mp4_src_ogg.'" type="video/ogg">';
					}
					if($bg_video_mp4_src_webm) {
						$output .= '<source src="'.$bg_video_mp4_src_webm.'" type="video/webm">';
					}
					$output .= '</video>';
				}	   
				if( isset( $bg_overlay ) && 1 == $bg_overlay ) {
					$opacity = '';
					if($overlay_opacity) {
						$opacity .= '-ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity='.floatval($overlay_opacity).');';
						$opacity .= 'filter: alpha(opacity='.floatval($overlay_opacity).');';
						$opacity .= '-moz-opacity: '.floatval($overlay_opacity/100).';';
						$opacity .= '-khtml-opacity: '.floatval($overlay_opacity/100).';';
						$opacity .= 'opacity: '.floatval($overlay_opacity/100).';';
					}
					$output .= '<div class="section-overlay" style="background: '.$overlay_color.'; '.$opacity.'"></div>';
				}
				$output .= '<div class="be-row '.$be_wrap.'">';
				$output .= '<div class="hero-section-inner-wrap">';
				$output .= '<div class="hero-section-inner">'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) ).'</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				echo $output;
				echo '</div>';
			}
			echo '</div>';
		} else {
			echo '<div class="header-hero-section"></div>';
		}
	} else {
		$hero_section = get_post_meta($post_id, 'be_themes_hero_section', true);
		if($hero_section && !empty($hero_section) && $hero_section != 'none') {
			echo '<div class="header-hero-section" id="hero-section">';
			if($hero_section == 'slider') {
				$hero_section_slider = get_post_meta($post_id, 'be_themes_hero_section_slider_shortcode', true);
				if($hero_section_slider) {
					echo do_shortcode($hero_section_slider);
				}
			}
			if($hero_section == 'custom') {
				echo '<div class="header-hero-custom-section">';
				$hero_section_with_header = get_post_meta($post_id, 'be_themes_hero_section_with_header', true);
				$hero_section_custom_height = get_post_meta($post_id, 'be_themes_hero_section_custom_height', true);
				if( !empty( $hero_section_custom_height ) ) {
					$full = '';
				} else {
					$full = 'full-screen-height';
				}
				$bg_color = get_post_meta($post_id, 'be_themes_hero_section_bg_color', true);
				$bg_image = get_post_meta($post_id, 'be_themes_hero_section_bg_image', true);
				$bg_repeat = get_post_meta($post_id, 'be_themes_hero_section_bg_repeat', true);
				$bg_attachment = get_post_meta($post_id, 'be_themes_hero_section_bg_attachment', true);
				$bg_position = get_post_meta($post_id, 'be_themes_hero_section_bg_position', true);
				$bg_stretch = get_post_meta($post_id, 'be_themes_hero_section_bg_scale', true);
				$bg_parallax = get_post_meta($post_id, 'be_themes_hero_section_bg_parallax', true);
				$bg_mouse_move_parallax = get_post_meta($post_id, 'be_themes_hero_section_bg_mouse_move_parallax', true);
				$bg_video = get_post_meta($post_id, 'be_themes_hero_section_bg_video', true);
				$bg_video_mp4_src = get_post_meta($post_id, 'be_themes_hero_section_bg_video_mp4', true);
				$bg_video_mp4_src_ogg = get_post_meta($post_id, 'be_themes_hero_section_bg_video_ogg', true);
				$bg_video_mp4_src_webm = get_post_meta($post_id, 'be_themes_hero_section_bg_video_webm', true);
				$bg_overlay = get_post_meta($post_id, 'be_themes_hero_section_overlay', true);
				$overlay_color = get_post_meta($post_id, 'be_themes_hero_section_bg_overlay_color', true);
				$overlay_opacity = get_post_meta($post_id, 'be_themes_hero_section_bg_overlay_opacity', true);
				$content = get_post_meta($post_id, 'be_themes_hero_section_content', true);
				$section_container_wrap = get_post_meta($post_id, 'be_themes_hero_section_container_wrap', true);
				if($section_container_wrap == 'yes') {
					$be_wrap = 'be-wrap';
				} else {
					$be_wrap = '';
				}
				
				$background = '';
				if(empty( $bg_image  ) ){
					if( ! empty( $bg_color ) )
						$background = 'background-color: '.$bg_color.';';	
				} else{
					$attachment_info=wp_get_attachment_image_src($bg_image,'full');
					$attachment_url = $attachment_info[0];
					if( ! empty( $attachment_url ) ) {
						if( (isset( $bg_parallax ) && 1 == $bg_parallax ) || (isset( $bg_mouse_move_parallax ) && 1 == $bg_mouse_move_parallax ) ) {
							$bg_position = 'center center';
						}
						$background = 'background:'.$bg_color.' url('.$attachment_url.') '.$bg_repeat.' '.$bg_attachment.' '.$bg_position.';';
					}
				}
				if( isset( $bg_stretch ) && 1 == $bg_stretch ) {
					$bg_stretch = 'be-bg-cover';
				} else {
					$bg_stretch = '';
				}
				if( $bg_mouse_move_parallax != 1 &&  isset( $bg_parallax ) && 1 == $bg_parallax ) {
					$bg_parallax = 'be-bg-parallax';
				} else {
					$bg_parallax = '';
				}
				if( isset( $bg_mouse_move_parallax ) && 1 == $bg_mouse_move_parallax ) {
					$bg_mouse_move_parallax = 'be-bg-mousemove-parallax';
				} else {
					$bg_mouse_move_parallax = '';
				}		

				$bg_overlay_class = '';
				$bg_video_class = '';
				if( isset( $bg_overlay ) && 1 == $bg_overlay ) {
					$bg_overlay_class = 'be-bg-overlay';
				}    
				if( isset( $bg_video ) && 1 == $bg_video ) {
					$bg_video_class = 'be-video-section';
				}

				$output = '';
				$output .= '<div class="hero-section-wrap be-section '.$full.' full-'.$hero_section_with_header.' '.$bg_stretch.' '.$bg_parallax.' '.$bg_mouse_move_parallax.' '.$bg_overlay_class.' '.$bg_video_class.' clearfix" style="'.$background.'; height: '.$hero_section_custom_height.'px !important;">';
				if( isset( $bg_video ) && 1 == $bg_video ) {
					$output .= '<video class="be-bg-video" autoplay="autoplay" loop="loop" muted="muted" preload="auto">';
					if($bg_video_mp4_src) {
						$output .= '<source src="'.$bg_video_mp4_src.'" type="video/mp4">';
					}
					if($bg_video_mp4_src_ogg) {
						$output .= '<source src="'.$bg_video_mp4_src_ogg.'" type="video/ogg">';
					}
					if($bg_video_mp4_src_webm) {
						$output .= '<source src="'.$bg_video_mp4_src_webm.'" type="video/webm">';
					}
					$output .= '</video>';
				}	   
				if( isset( $bg_overlay ) && 1 == $bg_overlay ) {
					$opacity = '';
					if($overlay_opacity) {
						$opacity .= '-ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity='.floatval($overlay_opacity).');';
						$opacity .= 'filter: alpha(opacity='.floatval($overlay_opacity).');';
						$opacity .= '-moz-opacity: '.floatval($overlay_opacity/100).';';
						$opacity .= '-khtml-opacity: '.floatval($overlay_opacity/100).';';
						$opacity .= 'opacity: '.floatval($overlay_opacity/100).';';
					}
					$output .= '<div class="section-overlay" style="background: '.$overlay_color.'; '.$opacity.'"></div>';
				}
				$output .= '<div class="be-row '.$be_wrap.'">';
				$output .= '<div class="hero-section-inner-wrap">';
				$output .= '<div class="hero-section-inner">'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) ).'</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				echo $output;
				echo '</div>';
			}
			echo '</div>';
		} else {
			echo '<div class="header-hero-section"></div>';
		}
	}
?>