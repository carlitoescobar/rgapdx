<?php
/******************************************
			SHORTCODES 
******************************************/
if (!function_exists('be_themes_formatter')) {
	function be_themes_formatter( $content ) {
		$new_content = '';
		$pattern_full = '{(\[raw\].*?\[/raw\])}is';
		$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
		$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

		foreach ( $pieces as $piece ) {
			$new_content .= ( 1 == preg_match( $pattern_contents, $piece, $matches ) ? $matches[1] : wptexturize( wpautop( $piece ) ) );
		}

		return $new_content;
	}
}
/**************************************LAYOUT MODULES**************************************/

/**************************************
			SECTION
**************************************/
if (!function_exists('be_section')) {
	function be_section( $atts, $content ) {
		extract( shortcode_atts( array(
	        'bg_color'=>'',
	        'bg_image' => '',
	        'bg_repeat' => 'repeat',
	        'bg_attachment' => 'scroll',
	        'bg_position' => 'left top',
	        'bg_stretch'=>0,
	        'bg_parallax'=>0,
	        'bg_mousemove_parallax' => 0,
	        'border_size' => '1',
	        'border_color' =>'',
	        'padding_top'=>'',
	        'padding_bottom'=>'',
	        'bg_video'=>0,
	        'bg_video_mp4_src'=>'',
	        'bg_video_mp4_src_ogg'=>'',
	        'bg_video_mp4_src_webm'=>'',
			'bg_overlay'=>0,
			'overlay_color'=>'',
			'overlay_opacity'=>'',
			'section_id'=>'',
			'full_screen'=> 0,
			'full_screen_header_scheme' => 'background--dark'
	    ),$atts));

	    $background = '';
	    $border = '';
	    $bg_video_class = '';
	    $bg_overlay_class = '';
	    $output = '';

	    if(empty( $bg_image  ) ){
	    	if( ! empty( $bg_color ) )
	    		$background = 'background-color: '.$bg_color.';';	
	    } else{
			$attachment_info=wp_get_attachment_image_src($bg_image,'full');
			$attachment_url = $attachment_info[0];
			if( ! empty( $attachment_url ) ) {
				if( (isset( $bg_parallax ) && 1 == $bg_parallax) || (isset( $bg_mousemove_parallax ) && 1 == $bg_mousemove_parallax) ) {
					$bg_position = 'center center';
				}
	    		$background = 'background:'.$bg_color.' url('.$attachment_url.') '.$bg_repeat.' '.$bg_attachment.' '.$bg_position.';';
	    	}
	    }

	    $border = ( ! empty( $border_color ) ) ? 'border-top:'.$border_size.'px solid '.$border_color.';border-bottom:'.$border_size.'px solid '.$border_color.';' : $border;
	    $padding_top  = ( isset( $padding_top ) && $padding_top != '' ) ? 'padding-top:'.$padding_top.'px;' : $padding_top;
	    $padding_bottom = ( isset( $padding_bottom ) && $padding_bottom != '' ) ? 'padding-bottom:'.$padding_bottom.'px;' : $padding_bottom;
	    $bg_stretch = ( isset( $bg_stretch ) && 1 == $bg_stretch ) ? 'be-bg-cover' : '' ;
	    $bg_parallax = ( $bg_mousemove_parallax != 1 && isset( $bg_parallax ) && 1 == $bg_parallax ) ? 'be-bg-parallax' : '' ;
	    $bg_mousemove_parallax = ( isset( $bg_mousemove_parallax ) && 1 == $bg_mousemove_parallax ) ? 'be-bg-mousemove-parallax' : '' ;
	    $bg_overlay_class = ( isset( $bg_overlay ) && 1 == $bg_overlay ) ? 'be-bg-overlay' : '' ;
	    $bg_video_class =  ( isset( $bg_video ) && 1 == $bg_video ) ? 'be-video-section' : '' ;
 	    $section_skew = ( isset( $skew ) && 1 == $skew ) ? 'section-skew' : '' ;
		$section_id = !empty($section_id) ? 'id = "'.$section_id.'"' : '';
		if( isset( $full_screen_header_scheme ) && $full_screen_header_scheme ) {
			$full_screen_header_scheme = 'data-headerscheme="'.$full_screen_header_scheme.'"';
		} else {
			$full_screen_header_scheme = 'data-headerscheme="background--dark"';
		}
		$full_screen = ( isset( $full_screen ) && 1 == $full_screen ) ? 'full-screen-section' : '' ;

	    $output .= '<div class="be-section '.$bg_stretch.' '.$bg_parallax.' '.$bg_mousemove_parallax.' '.$bg_overlay_class.' '.$bg_video_class.' '.$full_screen.' clearfix" '.$full_screen_header_scheme.' style="'.$background.$border.'" '.$section_id.'>';
	    if( 'full-screen-section' == $full_screen ) {
	    	$output .= '<div class="full-screen-section-wrap">';
	    }
	    $output .= '<div class="be-section-pad clearfix" style="'.$padding_top.$padding_bottom.'">';
		$output .=  ( isset( $skew ) && 1 == $skew ) ? '<div class="section-skew-normal">' : '' ;
		if( isset( $bg_video ) && 1 == $bg_video ) {
			$output .= '<video class="be-bg-video" autoplay="autoplay" loop="loop" muted="muted" preload="auto">';
			$output .=  ($bg_video_mp4_src) ? '<source src="'.$bg_video_mp4_src.'" type="video/mp4">' : '' ;
			$output .=  ($bg_video_mp4_src_ogg) ? '<source src="'.$bg_video_mp4_src_ogg.'" type="video/ogg">' : '' ;
			$output .=  ($bg_video_mp4_src_webm) ? '<source src="'.$bg_video_mp4_src_webm.'" type="video/webm">' : '' ;
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
	    $output .= do_shortcode( $content );
		if( isset( $skew ) && 1 == $skew ) {
			$output .= '</div>';
		}
		$output .= '</div>';
		if( 'full-screen-section' == $full_screen ) {
	    	$output .= '</div>';
	    }
	    $output .= '</div>';
	    return $output;
	}
	add_shortcode( 'section', 'be_section' );
}

/**************************************
			ROW
**************************************/
if (!function_exists('be_row')) {
	function be_row( $atts, $content ) {
		extract( shortcode_atts( array(
	        'no_wrapper'=>0,
	        'no_margin_bottom'=>0,
	        'no_space_columns'=>0,
	    ),$atts ) );
		$class = 'be-wrap ';
		$class = ( isset( $no_wrapper ) &&  1 == $no_wrapper ) ? '' : $class ;
	    $class .= ( isset( $no_margin_bottom ) &&  1 == $no_margin_bottom ) ? ' zero-bottom' : '' ;
	    $class .= ( isset( $no_space_columns ) &&  1 == $no_space_columns ) ? ' be-no-space' : '' ;
		
		return '<div class="be-row clearfix '.$class.'">'.do_shortcode( $content ).'</div>';
	}
	add_shortcode( 'row','be_row' );
}

/**************************************
			COLUMNS
**************************************/
if (!function_exists('columns_extract')) {
	function columns_extract($atts) {
		extract( shortcode_atts( array (
			'bg_color'=>'',
			'bg_image' => '',
			'bg_repeat' => 'repeat',
			'bg_attachment' => 'scroll',
			'bg_position' => 'left top',
			'bg_stretch'=> 0,
			'center_pad'=> 0,
		),$atts ) );
		$column_atts = array();
		$column_atts['background'] = '';		
		if(empty( $bg_image  ) ) {
			$column_atts['background'] = ( ! empty( $bg_color ) ) ? 'background-color: '.$bg_color.';' : $column_atts['background'] ; 
			} else {
			$attachment_info=wp_get_attachment_image_src($bg_image,'full');
			$attachment_url = $attachment_info[0];
			if( ! empty( $attachment_url ) ) {
				$bg_position = ( isset( $bg_parallax ) && 1 == $bg_parallax ) ? 'center center' : $bg_position ; 
				$column_atts['background'] = 'background:'.$bg_color.' url('.$attachment_url.') '.$bg_repeat.' '.$bg_attachment.' '.$bg_position.';';
			} 
		}
		$column_atts['bg_stretch'] = ( isset( $bg_stretch ) && 1 == $bg_stretch ) ? 'be-bg-cover' : '' ;
		$column_atts['center_pad'] = ( isset( $center_pad ) && 1 == $center_pad ) ? 'be-column-pad' : '' ;
		
		return $column_atts;
	}
}
if (!function_exists('be_one_col')) {
	function be_one_col( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output .= '<div class="one-col column-block clearfix '.$column_atts['bg_stretch'].' '.$column_atts['center_pad'].'" style="'.$column_atts['background'].'">'.do_shortcode( $content ).'</div>';
		return $output;
	}
	add_shortcode( 'one_col', 'be_one_col' );
}
/***********ONE THIRD**************/
if (!function_exists('be_one_third')) {
	function be_one_third( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output .= '<div class="one-third column-block '.$column_atts['bg_stretch'].'  '.$column_atts['center_pad'].'" style="'.$column_atts['background'].'">'.do_shortcode( $content ).'</div>';
		return $output;
	}
	add_shortcode( 'one_third', 'be_one_third' );
}
if (!function_exists('be_one_third_last')) {
	function be_one_third_last( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output .= '<div class="one-third column-block last '.$column_atts['bg_stretch'].'  '.$column_atts['center_pad'].'" style="'.$column_atts['background'].'">'.do_shortcode( $content ).'</div>';
		$output .= '<div class="clear"></div>';
		return $output;
	}
	add_shortcode( 'one_third_last', 'be_one_third_last' );
}
/***********ONE FOURTH**************/
if (!function_exists('be_one_fourth')) {
	function be_one_fourth( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output = '<div class="one-fourth column-block '.$column_atts['bg_stretch'].'  '.$column_atts['center_pad'].'" style="'.$column_atts['background'].'">'.do_shortcode( $content ).'</div>';
		return $output;
	}
	add_shortcode( 'one_fourth', 'be_one_fourth' );
}
if (!function_exists('be_one_fourth_last')) {
	function be_one_fourth_last( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output .= '<div class="one-fourth column-block last '.$column_atts['bg_stretch'].'  '.$column_atts['center_pad'].'" style="'.$column_atts['background'].'">'.do_shortcode( $content ).'</div>';
		$output .= '<div class="clear"></div>';
		return $output;
	}
	add_shortcode( 'one_fourth_last', 'be_one_fourth_last' );
}
if (!function_exists('be_one_fifth')) {
	function be_one_fifth( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output = '<div class="one-fifth column-block '.$column_atts['bg_stretch'].'  '.$column_atts['center_pad'].'" style="'.$column_atts['background'].'">'.do_shortcode( $content ).'</div>';
		return $output;
	}
	add_shortcode( 'one_fifth', 'be_one_fifth' );
}
if (!function_exists('be_one_fifth_last')) {
	function be_one_fifth_last( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output = '<div class="one-fifth column-block last '.$column_atts['bg_stretch'].'  '.$column_atts['center_pad'].'" style="'.$column_atts['background'].'">'.do_shortcode( $content ).'</div>';
		return $output;
	}
	add_shortcode( 'one_fifth_last', 'be_one_fifth_last' );
}
/***********ONE HALF**************/
if (!function_exists('be_one_half')) {
	function be_one_half( $atts, $content )  {
		$column_atts = columns_extract($atts);
		$output = '';
		$output = '<div class="one-half column-block '.$column_atts['bg_stretch'].'  '.$column_atts['center_pad'].'" style="'.$column_atts['background'].'">'.do_shortcode( $content ).'</div>';
		return $output;
	}
	add_shortcode( 'one_half', 'be_one_half' );
}
if (!function_exists('be_one_half_last')) {
	function be_one_half_last( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output .= '<div class="one-half column-block last '.$column_atts['bg_stretch'].'  '.$column_atts['center_pad'].'" style="'.$column_atts['background'].'">'.do_shortcode( $content ).'</div>';
		$output .= '<div class="clear"></div>';
		return $output;
	}
	add_shortcode('one_half_last','be_one_half_last');
}
/***********TWO THIRD**************/
if (!function_exists('be_two_third')) {
	function be_two_third( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output = '<div class="two-third column-block '.$column_atts['bg_stretch'].'  '.$column_atts['center_pad'].'" style="'.$column_atts['background'].'">'.do_shortcode( $content ).'</div>';
		return $output;
	}
	add_shortcode( 'two_third', 'be_two_third' );
}
if (!function_exists('be_two_third_last')) {
	function be_two_third_last( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output = '<div class="two-third column-block last '.$column_atts['bg_stretch'].'  '.$column_atts['center_pad'].'" style="'.$column_atts['background'].'">'.do_shortcode( $content ).'</div>';
		$output .= '<div class="clear"></div>';
		return $output;
	}
	add_shortcode('two_third_last','be_two_third_last');
}
/***********THREE FOURTH**************/	
if (!function_exists('be_three_fourth')) {
	function be_three_fourth( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output = '<div class="three-fourth column-block '.$column_atts['bg_stretch'].'  '.$column_atts['center_pad'].'" style="'.$column_atts['background'].'">'.do_shortcode( $content ).'</div>';
		return $output;
	}
	add_shortcode( 'three_fourth', 'be_three_fourth' );
}
if (!function_exists('be_three_fourth_last')) {
	function be_three_fourth_last( $atts, $content ) {
		$column_atts = columns_extract($atts);
		$output = '';
		$output = '<div class="three-fourth column-block last '.$column_atts['bg_stretch'].'  '.$column_atts['center_pad'].'" style="'.$column_atts['background'].'">'.do_shortcode( $content ).'</div>';
		$output .= '<div class="clear"></div>';
		return $output;
	}
	add_shortcode('three_fourth_last','be_three_fourth_last');
}

/**************************************
			TEXT BLOCK
**************************************/
if (!function_exists('be_text')) {
	function be_text( $atts, $content ) {
		extract( shortcode_atts( array(
	        'scroll_to_animate' => 0,
	        'animate' => 0,
	        'animation_type' => 'fadeIn',
	    ),$atts ) );

	    $output = '';
	    $bool = false;
		if( isset( $animate ) && 1 == $animate ) {
			$animate = 'be-animate';
			$bool = true;
		} else {
			$animate = '';
		}
		if( isset( $scroll_to_animate ) && 1 == $scroll_to_animate ) {
	    	$scroll_to_animate = 'scrollToFade';
	    	$bool = true;
	    } else {
			$scroll_to_animate = '';
		}
		$output .= ( true === $bool ) ? '<div class="be-text-block '.$animate.' '.$scroll_to_animate.'" data-animation="'.$animation_type.'">' : '' ;
		$output .= be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) );
	    $output .= ( true ===  $bool ) ? '</div>' : '' ;
	    
	    return $output;
	}
	add_shortcode( 'text', 'be_text' );
}

/**************************************
			Html
**************************************/
if (!function_exists('be_html')) {
	function be_html( $atts, $content ) {
		extract( shortcode_atts( array (
	        'scroll_to_animate' => 0,
	        'animate' => 0,
	        'animation_type' => 'fadeIn',
	    ),$atts ) );

	    $output = '';
	    $bool = false;
		if( isset( $animate ) && 1 == $animate ) {
			$animate = 'be-animate';
			$bool = true;
		} else {
			$animate = '';
		}
		if( isset( $scroll_to_animate ) && 1 == $scroll_to_animate ) {
	    	$scroll_to_animate = 'scrollToFade';
	    	$bool = true;
	    } else {
			$scroll_to_animate = '';
		}
		$output .= ( true === $bool ) ? '<div class="be-text-block '.$animate.' '.$scroll_to_animate.'" data-animation="'.$animation_type.'">' : '' ;
		$output .= $content;
	    $output .= ( true ===  $bool ) ? '</div>' : '' ;
	    
	    return $output;
	}
	add_shortcode( 'html', 'be_html' );
}

/**************************************STYLING MODULES**************************************/

/**************************************
			ACCORDION
**************************************/
if (!function_exists('be_accordion')) {
	function be_accordion( $atts, $content ){
		return '<div class="accordion be-shortcode be-accordion">'.do_shortcode($content).'</div>';
	}
	add_shortcode( 'accordion', 'be_accordion' );
}
if (!function_exists('be_toggle')) {
	function be_toggle( $atts, $content ){
		extract (
			shortcode_atts ( array ( 
				'title' => '',
				'title_bg_color' => '',
				'title_color' => '',
				'title_border_color' => '',
				'content_bg_color' => '',
				'content_border_color' => '',
			), $atts)
		);
		$title_style = $content_style = '';
		$title_style .= ($title_bg_color) ? 'background: '.$title_bg_color.';' : '' ;
		$title_style .= ($title_color) ? 'color: '.$title_color.';' : '' ;
		$title_style .= ($title_border_color) ? 'border-color: '.$title_border_color.';' : '' ;
		$content_style .= ($content_bg_color) ? 'background: '.$content_bg_color.';' : '' ;
		$content_style .= ($content_border_color) ? 'border-color: '.$content_border_color.';' : '' ;
		return '<h3 class="accordion-head" style="'.$title_style.'">'.$title.'</h3><div style="'.$content_style.'">'.do_shortcode($content).'</div>';
	}
	add_shortcode( 'toggle', 'be_toggle' );
}

/**************************************
			ANIMATED CHARTS
**************************************/
if (!function_exists('be_chart')) {
	function be_chart( $atts, $content ) {
		extract( shortcode_atts( array (
			'percentage' => '70',
			'caption' => '',
			'percentage_color' => '',
			'percentage_font_size' => '',
			'caption_color' => '',
			'percentage_bar_color' => '',
			'percentage_track_color' => '',
			'percentage_scale_color' => '',
			'size' => 100,
			'linewidth' => 3,
		),$atts ));
		$style = '';
		$style = ($size) ? 'style="width: '.$size.'px;height: '.$size.'px;line-height: '.$size.'px;"' : $style ; 
		
		return '<div class="chart-wrap"><div class="chart" data-percent="'.$percentage.'" data-percentage-bar-color="'.$percentage_bar_color.'" data-percentage-track-color="'.$percentage_track_color.'" data-percentage-scale-color="'.$percentage_scale_color.'" data-size="'.$size.'" data-linewidth="'.$linewidth.'" '.$style.'><span style="color: '.$percentage_color.'; font-size: '.$percentage_font_size.'px;"><span class="percentage">0</span>%</span></div><h6><span style="color: '.$caption_color.'">'.$caption.'</span></h6></div>';
	}
	add_shortcode( 'chart', 'be_chart' );
}

/**************************************
			ANIMATED NUMBERS
**************************************/
if (!function_exists('be_animated_numbers')) {
	function be_animated_numbers( $atts, $content ) {
		extract( shortcode_atts( array(
			'number' => '',
			'caption' => '',
	        'number_size' => '45',
	        'number_color' => '#141414',
	        'caption_size' => '13',
	        'caption_color' => '#141414',
	    ), $atts ) );
		$output = '';
		$output = '<div class="animate-number-wrap">';
		$output .= '<span class="animate-number animate" data-number="'.$number.'" style="color:'.$number_color.';font-size:'.$number_size.'px;line-height:1"></span>';
		$output .= '<h6><span class="animate-number-caption" style="color:'.$caption_color.';font-size:'.$caption_size.'px;">'.$caption.'</span></h6>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'animated_numbers', 'be_animated_numbers' );
}

/**************************************
		BLOG MASONRY
**************************************/
if (!function_exists('be_blog')) {
	function be_blog( $atts ) {
		extract( shortcode_atts( array (
			'col' => 'three',
		) , $atts ) );
		$output = '';
		$output .= '<section class="content-no-sidebar">';
		$output .= '<div class="clearfix style3-blog portfolio-container '.$col.'-col">';
		global $paged, $blog_style;
		$blog_style = 'style3';
		$args = array( 'post_type' => 'post', 'paged' => $paged );
		$the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) : 
				while ( $the_query->have_posts() ) : $the_query->the_post();
					ob_start();  
					get_template_part( 'blog', 'loop' ); 
					$output .= ob_get_contents();  
					ob_end_clean();
				endwhile;
			else:
				$output .= '<p class="inner-content">'.__( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'be-themes' ).'</p>';
			endif;
		$output .= '</div>';
		$output .= ($the_query->max_num_pages > 1) ? '<div class="pagination_parent">'.get_be_themes_pagination($the_query->max_num_pages).'</div>' : '' ;
		$output .= '</section>';
		wp_reset_postdata();
		return $output;
	}
	add_shortcode( 'blog' , 'be_blog' );
}

/**************************************
			BUTTON
**************************************/
if (!function_exists('be_button')) {
	function be_button( $atts, $content ) {
		extract( shortcode_atts( array (
			'button_text'=>'',
			'url'=>'',
			'type'=>'small',
			'alignment'=>'',							 
			'bg_color'=> '',
			'hover_bg_color'=> '',
			'color'=> '',
			'hover_color'=> '',
			'border_width' => 0,			
			'border_color'=> '',
			'hover_border_color'=> '',
			'rounded'=>'',			
			'image' => '',
			'new_tab' => 0,
			'animate'=>0,
			'animation_type'=>'fadeIn',
		), $atts ) );
		
		$mfp_class = '';
		$output = '';
		if($bg_color) {
			$data_bg_color = 'data-bg-color="'.$bg_color.'"';
		} else {
			$data_bg_color = 'data-bg-color="inherit"';
			$bg_color = 'inherit';
		}
		$data_hover_bg_color = ($hover_bg_color) ? 'data-hover-bg-color="'.$hover_bg_color.'"' : 'data-hover-bg-color="'.$bg_color.'"'; 
		if($color) {
			$data_color = 'data-color="'.$color.'"';
		} else {
			$data_color = 'data-color=""';
			$color = '';
		}
		$data_hover_color = ($hover_color) ? 'data-hover-color="'.$hover_color.'"' : 'data-hover-color="'.$color.'"' ; 
		if($border_color) {
			$data_border_color = 'data-border-color="'.$border_color.'"';
		} else {
			$data_border_color = 'data-border-color="transparent"';
			$border_color = 'transparent';
		}	
		$border_style = ("block" != $type) ? 'border-style: solid; border-width:'.$border_width.'px; border-color: '.$border_color : '';
		$alignment = ("block" == $type) ? 'center' : $alignment;
		if( isset($alignment) && $alignment != 'none') {
			$alignment = 'align-block block-'.$alignment;
		}
		$new_tab = ( isset( $new_tab ) && 1 == $new_tab ) ? 'target="_blank"' : '' ;
		$data_hover_border_color = ($hover_border_color) ? 'data-hover-border-color="'.$hover_border_color.'"' : 'data-hover-border-color="'.$border_color.'"'; 
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : ''; 
		$rounded = ( $rounded == "1" && "block" != $type) ? "rounded" : '' ; 
		$url = ( empty( $url ) ) ? '#' : $url ; 
		if ( !empty( $image ) ) {
			$mfp_class='mfp-image image-popup-vertical-fit';
			$attachment_info = wp_get_attachment_image_src( $image, 'full' );
			$url = $attachment_info[0];
			$video_url = get_post_meta( $image, 'be_themes_featured_video_url', true );
			if(!empty( $video_url )) {
				$url = $video_url;
				$mfp_class = 'mfp-iframe image-popup-vertical-fit';
			}
		}
		if ( !empty( $content ) ) {
			$mfp_class ='popup-with-content';
			$output .= '<div class="mfp-hide white-popup-block be-wrap clearfix" id="test"><div class="white-popup-block-content">'.$content.'</div></div>';
			$url = '#test';
		}
		$output .= '<div class="be-button-wrap '.$alignment.'">';
		$output .= '<a class="be-shortcode '.$type.'btn be-button '.$rounded.' '.$animate.' '.$mfp_class.'" '.$new_tab.' href="'.$url.'" style= "'.$border_style.';background-color: '.$bg_color.'; color: '.$color.';" data-animation="'.$animation_type.'" '.$data_bg_color.' '.$data_hover_bg_color.' '.$data_color.' '.$data_hover_color.' '.$data_border_color.' '.$data_hover_border_color.'>'.$button_text.'</a>' ; 
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'button', 'be_button' );
}

/**************************************
			CALL TO ACTION
**************************************/	
if ( ! function_exists( 'be_call_to_action' ) ) {
	function be_call_to_action( $atts, $content ) {
		extract( shortcode_atts( array(
			'bg_color'=> '',
			'title' => '',
			'h_tag' => 'h4',
			'title_color' => '',
			'button_text'=>'Click Here',
			'button_link'=> '',			
			'new_tab'=> 0,
			'button_bg_color'=> '',
			'hover_bg_color'=> '',
			'color'=> '',
			'hover_color'=> '',
			'border_width' => 0,			
			'border_color'=> '',
			'hover_border_color'=> '',
			'image' => '',
			'animate'=> 0,
			'animation_type'=> 'fadeIn',
	    ), $atts ) );

		$output = '';
		$mfp_class = '';
		if($button_bg_color) {
			$data_bg_color = 'data-bg-color="'.$button_bg_color.'"';
		} else {
			$data_bg_color = 'data-bg-color="inherit"';
			$button_bg_color = 'inherit';
		}

		$data_hover_bg_color = ($hover_bg_color) ? 'data-hover-bg-color="'.$hover_bg_color.'"' : 'data-hover-bg-color="'.$button_bg_color.'"' ; 
		
		if($color) {
			$data_color = 'data-color="'.$color.'"';
		} else {
			$data_color = 'data-color=""';
			$color = '';
		}
		$data_hover_color = ($hover_color) ? 'data-hover-color="'.$hover_color.'"' : 'data-hover-color="'.$color.'"' ; 
		
		if($border_color) {
			$data_border_color = 'data-border-color="'.$border_color.'"';
		} else {
			$data_border_color = 'data-border-color="transparent"';
			$border_color = 'transparent';
		}
		$data_hover_border_color = ($hover_border_color) ? 'data-hover-border-color="'.$hover_border_color.'"' : 'data-hover-border-color="'.$border_color.'"' ; 
		
		if ( !empty( $image ) ) {
			$mfp_class='mfp-image image-popup-vertical-fit';
			$attachment_info = wp_get_attachment_image_src( $image, 'full' );
			$button_link = $attachment_info[0];
			$video_url = get_post_meta( $image, 'be_themes_featured_video_url', true );
			if(!empty( $video_url )) {
				$button_link = $video_url;
				$mfp_class = 'mfp-iframe image-popup-vertical-fit';
			}
		}
		$new_tab = ( isset( $new_tab ) && 1 == $new_tab ) ? 'target="_blank"' : '' ;
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ; 

		$output .= '<div class="call-to-action be-shortcode clearfix '.$animate.'" data-animation="'.$animation_type.'" style="background: '.$bg_color.'">';
		$output .= '<'.$h_tag.' class="action-content" style="color:'.$title_color.';">'.$title.'</'.$h_tag.'>';
		$output .= ( ! empty( $button_link ) ) ? '<a class="mediumbtn be-button rounded action-button '.$mfp_class.'" href="'.$button_link.'" style="border-style: solid; border-width: '.$border_width.'px; border-color: '.$border_color.'; background-color: '.$button_bg_color.'; color: '.$color.';" '.$data_bg_color.' '.$data_hover_bg_color.' '.$data_color.' '.$data_hover_color.' '.$data_border_color.' '.$data_hover_border_color.' '.$new_tab.'>'.$button_text.'</a>' : '' ;
		$output .= '</div>';
		return $output;	
	}
	add_shortcode( 'call_to_action', 'be_call_to_action' );
}

/**************************************
			CLIENTS
**************************************/
if ( ! function_exists( 'be_clients' ) ) {
	function be_clients($atts,$content){
		global $be_themes_data;
		$output = '<div class="carousel-wrap clearfix">';
		$output .='<ul class="be-carousel client-carousel">';
		$output .=do_shortcode($content);
		$output .='</ul>';
		$output .='<a class="prev be-carousel-nav icon-left-open" href="#"></a><a class="next be-carousel-nav icon-right-open" href="#"></a>';
		$output .='</div>';
		return $output;
	}
	add_shortcode('clients','be_clients');
}
if ( ! function_exists( 'be_client' ) ) {
	function be_client( $atts, $content ) {
		extract( shortcode_atts( array(
			'image'=>'',
			'link' =>'',
			'new_tab'=> 'yes',
	    ), $atts ) );

	    $output =  '';
	    $attachment = wp_get_attachment_image_src( $image , 'full');
	    $url = $attachment[0];
	    $output .= ( $url ) ? '<li class="carousel-item"><a href="'.$link.'"><img src="'.$url.'" alt="" /></a></li>' : '' ;
	    return $output;
	}
	add_shortcode( 'client', 'be_client' );
}

/**************************************
			DIVIDER
**************************************/
if ( ! function_exists( 'be_separator' ) ) {
	function be_separator( $atts ) {
		extract( shortcode_atts( array(
	        'height' => '1',
	        'color' => '#dedede',
	    ),$atts ) );
		$output = '';
		$style = '';
		$style = ( ! empty( $color ) ) ? 'background-color:'.$color.';color:'.$color.';' : $style ;
		$style .= ( ! empty( $height ) ) ? 'height:'.$height.'px;' : '' ;
		
		$output .='<hr class="be-shortcode separator" style="'.$style.'" />';
		return $output;
	}
	add_shortcode( 'separator', 'be_separator' );
}

/**************************************
			DROP CAPS
**************************************/
if ( ! function_exists( 'be_dropcap' ) ) {
	function be_dropcap( $atts, $content ) {
		extract( shortcode_atts( array(
	        'type'=>'circle',
	        'color'=>'',
	        'size' =>'small',
	        'letter'=>'',
	        'icon'=>'none',
			'animate'=>0,
	        'animation_type'=>'fadeIn',
	    ), $atts ) );
		$output="";
		$background_color="";
		$letter = ( $icon != 'none' ) ? '<i class="font-icon icon-'.$icon.'"></i>' : $letter ;
		$background_color .= ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : "" ; 
		
	 	if( 'rounded' == $type) {
	 		$background_color .=  ( $color ) ? '" style="background-color:'.$color.';"' : ' alt-bg alt-bg-text-color"' ;
	 		return '<span class="dropcap dropcap-rounded '.$size.$background_color.' data-animation="'.$animation_type.'">'.$letter.'</span>'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) );
	 	}
	 	if( 'circle' == $type) {
	 		$background_color .=  ( $color ) ? '" style="background-color:'.$color.';"' : ' alt-bg alt-bg-text-color"' ;
	 		return '<span class="dropcap dropcap-circle '.$size.$background_color.' data-animation="'.$animation_type.'">'.$letter.'</span>'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) );
	 	}
	 	if( 'letter' == $type) {
	 		$background_color .= ( $color ) ? '" style="color:'.$color.';"' : '' ;
			return '<span class="dropcap dropcap-letter '.$size.$background_color.' data-animation="'.$animation_type.'">'.$letter.'</span>'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) );
		}
	}
	add_shortcode( 'dropcap', 'be_dropcap' );
}

/**************************************
			FLEX SLIDER
**************************************/
if (!function_exists('be_flex_slider')) {
	function be_flex_slider( $atts, $content ) {
		extract( shortcode_atts( array(
	        'animation'=> 'fade',
	        'auto_slide'=> 'no',                //Boolean: Animate slider automatically
			'slide_interval'=> '1000',          //Integer: Set the speed of the slideshow cycling, in milliseconds
	    ), $atts ) );
	    $output = "";
	    $output .= '<div class="be-flex-slider flexslider flex-loading" data-animation="'.$animation.'" data-auto-slide='.$auto_slide.' data-slide-interval="'.$slide_interval.'"><ul class="slides">';
		$output .= do_shortcode( $content );
	    $output .= '</ul><i class="font-icon icon-cog icon-spin"></i></div>';
	    return $output;
	}
	add_shortcode( 'flex_slider', 'be_flex_slider' );
}
if (!function_exists('be_flex_slide')) {
	function be_flex_slide( $atts, $content ){
			extract( shortcode_atts( array(
				'image'=>'',
				'video'=>'',
	        	'size'=>'full',
	    	), $atts ) );

			$output = '';
	    	$output .= '<li>';
			if( ! empty( $video ) ) {	
				$videoType = be_themes_video_type( $video );
				if( $videoType == "youtube" ) {
					$video_id = ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video, $match ) ) ? $match[1] : $video_id ; 
					$output.='<iframe width="940" height="450" src="http://www.youtube.com/embed/'.$video_id.'" allowfullscreen></iframe>';
				}
				elseif( $videoType == "vimeo" ) {
					sscanf( parse_url( $video, PHP_URL_PATH ), '/%d', $video_id );
					$output.='<iframe src="http://player.vimeo.com/video/'.$video_id.'" width="500" height="281" allowFullScreen></iframe>';
				}
			} else {
				if ( !empty( $image ) ) { // check if the post has a Post Thumbnail assigned to it.
					$attachment_info = wp_get_attachment_image_src( $image, $size );
					$attachment_url = $attachment_info[0];
					$output .=  '<img src="'.$attachment_url.'" alt="" />';
				}
			}
	        $output .='</li>';

	        return $output;
	}
	add_shortcode( 'flex_slide', 'be_flex_slide' );
}

/**************************************
		FULL WIDTH PORTFOLIO
**************************************/
if (!function_exists('be_full_screen_portfolio')) {
	function be_full_screen_portfolio( $atts ) {
		global $be_themes_data;
		extract( shortcode_atts( array (
			'col' => 'three',
	        'show_filters' => 'yes',
	        'tax_name' => 'portfolio_categories',
	        'filter' => 'categories',
	        'category' => '',
	        'items_per_page' => '-1',
			'masonry' => '0',
			'gallery' => '0',
			'pagination' => 'none',
			'overlay_color' => $be_themes_data['color_scheme'],
			'overlay_opacity' => '85'
	    ) , $atts ) );
		global $be_themes_data;
		$output = '';
		$overlay_color = be_themes_hexa_to_rgb( $overlay_color );
		$thumb_overlay_color = 'rgba('.$overlay_color[0].','.$overlay_color[1].','.$overlay_color[2].','.(intval($overlay_opacity) / 100 ).')';	
		$output .= '<div class="portfolio full-screen '.$col.'-col" data-action="get_ajax_full_screen_portfolio" data-category="'.$category.'" data-masonry="'.$masonry.'" data-showposts="'.$items_per_page.'" data-paged="2" data-col="'.$col.'" data-gallery="'.$gallery.'" data-filter="'.$filter.'" data-show_filters="'.$show_filters.'" data-thumbnail-bg-color="'.$thumb_overlay_color.'">';
		$filter_to_use = 'portfolio_'.$filter;
		$category = explode(',', $category);
		if($filter_to_use == 'portfolio_tag' || empty( $category ) ) {
			$terms = get_terms( $filter_to_use );
		} else{
	    	$args_cat = array( 'taxonomy' => array( $filter_to_use ) );
			$stack = array();
			foreach(get_categories( $args_cat ) as $single_category ){
				if ( in_array( $single_category->slug, $category ) ) {
					array_push( $stack, $single_category->cat_ID );
				}
			}
			$terms = get_terms($filter_to_use, array('include' => $stack) );
		}
	    if( ! empty( $terms ) && $show_filters == 'yes') {	
		    $output .='<div class="filters clearfix">';
	    	$output .='<h6><span class="sort current_choice" data-id="element">'.__( 'All', 'be-themes' ).'</span></h6>';
	    	foreach ($terms as $term) {
	    		$output .='<h6>';    		
	    		$output .= '<span class="sort" data-id="'.$term->slug.'">'.$term->name.'</span>';    		
	    		$output .= '</h6>';
	    	}
		    
	    	$output .='</div>';
		}
		$output .='<div class="portfolio-container clickable clearfix">';
		$items_per_page = (empty($items_per_page)) ? -1 : $items_per_page ;
		$tax_name = (isset($tax_name) && !empty($tax_name)) ? $tax_name : 'portfolio_categories' ;
		if( empty( $category[0] ) ) {
			$args = array(
				'post_type' => 'portfolio',
				'status' => 'publish',
				'posts_per_page' => $items_per_page,
				'orderby'=>'date',				
			);
		} else {
			$args = array (
				'post_type' => 'portfolio',
				'status' => 'publish',
				'posts_per_page' => $items_per_page,
				'tax_query' => array(
					array(
						'taxonomy' => $tax_name,
						'field' => 'slug',
						'terms' => $category,
						'operator' => 'IN',
					)
				),
				'orderby'=>'date',	
			);	
		}	
		$the_query = new WP_Query( $args );
		while ( $the_query->have_posts() ) : $the_query->the_post();
			$filter_classes = '';
			$permalink = '';
			$mfp_class='mfp-image';
			$post_terms = get_the_terms( get_the_ID(), $filter_to_use );
			if( $show_filters == 'yes' && is_array( $post_terms ) ) {
				foreach ( $post_terms as  $term ) {
					$filter_classes .=$term->slug." ";
				}
			} else{
				$filter_classes='';
			}
			$attachment_id = get_post_thumbnail_id(get_the_ID());
			$image_atts = get_full_screen_portfolio_image(get_the_ID(), $col);
			$image_size = ($masonry) ? 'portfolio-masonry' : $image_atts['size'] ;
			$attachment_thumb=wp_get_attachment_image_src( $attachment_id, $image_size);
			$attachment_full = wp_get_attachment_image_src( $attachment_id, 'full');
			$attachment_thumb_url = $attachment_thumb[0];
			$attachment_full_url = $attachment_full[0];
			
			$video_url = get_post_meta( $attachment_id, 'be_themes_featured_video_url', true );
			$visit_site_url = get_post_meta( get_the_ID(), 'be_themes_portfolio_external_url', true );
			$link_to = get_post_meta( get_the_ID(), 'be_themes_portfolio_link_to', true );
			$open_with = get_post_meta( get_the_ID(), 'be_themes_portfolio_single_page_style', true );
			$permalink = ( $link_to == 'external_url' ) ? $visit_site_url : get_permalink() ; 
			
			if( ! empty( $video_url ) ) {
				$attachment_full_url = $video_url;
				$mfp_class = 'mfp-iframe';
			}
			if( isset($gallery) && $gallery == 'yes') {
				$thumb_class = 'be-lightbox-gallery';
			} else if( isset($open_with) && $open_with == 'lightbox') {
				$thumb_class = 'image-popup-vertical-fit';
			} else if( isset($open_with) && $open_with == 'none') {
				$thumb_class = 'no-link';
				$attachment_full_url = '#';
			} else if( isset($open_with) && ($open_with == 'style1' || $open_with == 'style2' || $open_with == 'style3' || $open_with == 'style4')) {
				$thumb_class = 'custom-slider';
				$attachment_full_url = get_permalink();
			} else {
				$thumb_class = '';
				$attachment_full_url = $permalink;
			}
			$link_to_thumbnail = ( isset($open_with) && ($open_with == 'style1' || $open_with == 'style2' || $open_with == 'style3' || $open_with == 'style4')) ? '#'.be_get_the_slug(get_the_ID()) : $attachment_full_url ; 
			
			$output .='<div class="element be-hoverlay '.$filter_classes.' '.$image_atts['class'].' '.$image_atts['alt_class'].'" id="'.be_get_the_slug(get_the_ID()).'">';
			$output .= '<div class="element-inner">';
			$output .= '<a href="'.$link_to_thumbnail.'" data-href="'.$attachment_full_url.'" class="thumb-wrap '.$thumb_class.' '.$mfp_class.'"><img src="'.$attachment_thumb_url.'" alt />';
			$output .= '<span class="thumb-overlay"><span class="thumb-bg" style="background-color:'.$thumb_overlay_color.';">';
			$output .= '<span class="thumb-title fadeInLeft animated">'.get_the_title().'</span>';
			$output .= '</span></span>';//end thumb overlay & bg
			$output .= '</a>';//end thumb wrap
			if( isset($gallery) && $gallery == 'yes' ):
				$output .='<div class="popup-gallery">';
				$attachment_args = array ( 
					'post_type' => 'attachment', 
					'posts_per_page' => -1, 
					'post_status' => 'any', 
					'post_parent'=> get_the_ID(), 
					'orderby' => 'menu_order' , 
					'order'=>'ASC' 
				);
				$attachments = get_posts( $attachment_args );
				if( $attachments ) {
					foreach ( $attachments as $att ) {
						$video_url = get_post_meta( $att->ID, 'be_themes_featured_video_url', true );
						$mfp_class='mfp-image';
						if( ! empty( $video_url ) ) {
							$url = $video_url;
							$mfp_class = 'mfp-iframe';
						} else {
							$url = wp_get_attachment_image_src($att->ID,'full');
							$url = $url[0];
						}
						$output .='<a href="'.$url.'" class="'.$mfp_class.'"></a>';
					}
				} else {
					$attachment_id = get_post_thumbnail_id(get_the_ID());
					$video_url = get_post_meta( $attachment_id, 'be_themes_featured_video_url', true );
					$mfp_class='mfp-image';
					if( ! empty( $video_url ) ) {
						$url = $video_url;
						$mfp_class = 'mfp-iframe';
					} else {
						$url = wp_get_attachment_image_src($attachment_id, 'full');
						$url = $url[0];
					}
					$output .='<a href="'.$url.'" class="'.$mfp_class.'"></a>';
				}
				$output .= '</div>';
			endif;
			$output .= '</div>'; //end element inner
			$output .= '</div>';//end element
		endwhile;
		wp_reset_postdata();
		$output .='</div>'; //end portfolio-container
		if( $pagination == 'infinite' && ( $items_per_page != '-1' || $items_per_page == $the_query->found_posts ) ) {
			$output .='<div class="trigger_infinite_scroll"></div>';
		} elseif( $pagination == 'loadmore' && ( $items_per_page != '-1' || $items_per_page == $the_query->found_posts ) ) {
			$output .='<div class="trigger_load_more" data-total-items="'.($the_query->found_posts-$items_per_page).'"><a class="be-shortcode mediumbtn be-button rounded" href="#">Load More</a></div>';
		}
		$output .='</div>'; //end portfolio
		return $output;
	}
	add_shortcode( 'portfolio_full_screen' , 'be_full_screen_portfolio' );
}

/*****************************************************
			FULL WIDTH PORTFOLIO WITH GUTTER
*****************************************************/
if (!function_exists('be_full_screen_portfolio_with_gutter')) {
	function be_full_screen_portfolio_with_gutter( $atts ) {
		global $be_themes_data;
		extract( shortcode_atts( array (
			'col' => 'three',
	        'show_filters' => 'yes',
	        'tax_name' => 'portfolio_categories',
	        'filter' => 'categories',        
	        'category' => '',
	        'items_per_page' => '-1',
			'masonry' => '0',
			'gallery' => '0',
			'pagination' => 'none',
			'overlay_color' => $be_themes_data['color_scheme'],
			'overlay_opacity' => '85'
	    ) , $atts ) );

		global $be_themes_data;
		$output = '';
		$overlay_color = be_themes_hexa_to_rgb( $overlay_color );
		$thumb_overlay_color = 'rgba('.$overlay_color[0].','.$overlay_color[1].','.$overlay_color[2].','.(intval($overlay_opacity) / 100 ).')';	
		$output .= '<div class="portfolio full-screen full-screen-gutter '.$col.'-col" data-action="get_ajax_full_screen_gutter_portfolio" data-category="'.$category.'" data-masonry="'.$masonry.'" data-showposts="'.$items_per_page.'" data-paged="2" data-col="'.$col.'" data-gallery="'.$gallery.'" data-filter="'.$filter.'" data-show_filters="'.$show_filters.'" data-thumbnail-bg-color="'.$thumb_overlay_color.'">';
		$filter_to_use = 'portfolio_'.$filter;
		$category = explode(',', $category);
		if($filter_to_use == 'portfolio_tag' || empty( $category ) ) {
			$terms = get_terms( $filter_to_use );
		} else{
	    	$args_cat = array( 'taxonomy' => array( $filter_to_use ) );
			$stack = array();
			foreach(get_categories( $args_cat ) as $single_category ){
				if ( in_array( $single_category->slug, $category ) ) {
					array_push( $stack, $single_category->cat_ID );
				}
			}
			$terms = get_terms($filter_to_use, array('include' => $stack) );
		}
	    if( ! empty( $terms ) && $show_filters == 'yes') {	
		    $output .='<div class="filters clearfix">';
	    	$output .='<h6><span class="sort current_choice" data-id="element">'.__( 'All', 'be-themes' ).'</span></h6>';
	    	foreach ($terms as $term) {
	    		$output .='<h6>';    		
	    		$output .= '<span class="sort" data-id="'.$term->slug.'">'.$term->name.'</span>';		
	    		$output .= '</h6>';
	    	}
		    
	    	$output .='</div>';
		}
		$output .='<div class="portfolio-container clickable clearfix">';
		$items_per_page = (empty($items_per_page)) ? -1 : $items_per_page ; 
		$tax_name = (isset($tax_name) && !empty($tax_name)) ? $tax_name : 'portfolio_categories' ;
		if( empty( $category[0] ) ) {
			$args = array(
				'post_type' => 'portfolio',
				'status' => 'publish',
				'posts_per_page' => $items_per_page,
				'orderby'=>'date',			
			);
		} else {
			$args = array (
				'post_type' => 'portfolio',
				'status' => 'publish',
				'posts_per_page' => $items_per_page,
				'tax_query' => array(
					array(
						'taxonomy' => $tax_name,
						'field' => 'slug',
						'terms' => $category,
						'operator' => 'IN',
					)
				),
				'orderby'=>'date',	
			);	
		}
		$the_query = new WP_Query( $args );
		while ( $the_query->have_posts() ) : $the_query->the_post();
			$filter_classes = '';
			$permalink = '';
			$mfp_class='mfp-image';
			$post_terms = get_the_terms( get_the_ID(), $filter_to_use );
			if( $show_filters == 'yes' && is_array( $post_terms ) ) {
				foreach ( $post_terms as  $term ) {
					$filter_classes .=$term->slug." ";
				}
			} else{
				$filter_classes='';
			}
			$attachment_id = get_post_thumbnail_id(get_the_ID());
			$image_atts = get_portfolio_image(get_the_ID(), $col);
			$image_size = ($masonry) ? 'portfolio-masonry' : $image_atts['size'] ; 
			$attachment_thumb=wp_get_attachment_image_src( $attachment_id, $image_size);
			$attachment_thumb=wp_get_attachment_image_src( $attachment_id, $image_size);
			$attachment_full = wp_get_attachment_image_src( $attachment_id, 'full');
			$attachment_thumb_url = $attachment_thumb[0];
			$attachment_full_url = $attachment_full[0];
			
			$video_url = get_post_meta( $attachment_id, 'be_themes_featured_video_url', true );
			$visit_site_url = get_post_meta( get_the_ID(), 'be_themes_portfolio_external_url', true );
			$link_to = get_post_meta( get_the_ID(), 'be_themes_portfolio_link_to', true );
			$open_with = get_post_meta( get_the_ID(), 'be_themes_portfolio_single_page_style', true );
			$permalink = ( $link_to == 'external_url' ) ? $visit_site_url : get_permalink() ; 
			
			if( ! empty( $video_url ) ) {
				$attachment_full_url = $video_url;
				$mfp_class = 'mfp-iframe';
			}
			if( isset($gallery) && $gallery == 'yes') {
				$thumb_class = 'be-lightbox-gallery';
			} else if( isset($open_with) && $open_with == 'lightbox') {
				$thumb_class = 'image-popup-vertical-fit';
			} else if( isset($open_with) && $open_with == 'none') {
				$thumb_class = 'no-link';
				$attachment_full_url = '#';
			} else if( isset($open_with) && ($open_with == 'style1' || $open_with == 'style2' || $open_with == 'style3' || $open_with == 'style4')) {
				$thumb_class = 'custom-slider';
				$attachment_full_url = get_permalink();
			} else {
				$thumb_class = '';
				$attachment_full_url = $permalink;
			}
			$link_to_thumbnail = ( isset($open_with) && ($open_with == 'style1' || $open_with == 'style2' || $open_with == 'style3' || $open_with == 'style4')) ? '#'.be_get_the_slug(get_the_ID()) : $attachment_full_url ;
			
			$output .='<div class="element be-hoverlay '.$filter_classes.' '.$image_atts['class'].' '.$image_atts['alt_class'].'" id="'.be_get_the_slug(get_the_ID()).'">';
			$output .= '<div class="element-inner">';
			$output .= '<a href="'.$link_to_thumbnail.'" data-href="'.$attachment_full_url.'" class="thumb-wrap '.$thumb_class.' '.$mfp_class.'"><img src="'.$attachment_thumb_url.'" alt />';
			$output .= '<span class="thumb-overlay"><span class="thumb-bg" style="background-color:'.$thumb_overlay_color.';">';
			$output .= '<span class="thumb-title fadeInLeft animated">'.get_the_title().'</span>';
			$output .= '</span></span>';//end thumb overlay & bg
			$output .= '</a>';//end thumb wrap
			if( isset($gallery) && $gallery == 'yes' ):
				$output .='<div class="popup-gallery">';
				$attachment_args = array ( 
					'post_type' => 'attachment', 
					'posts_per_page' => -1, 
					'post_status' => 'any', 
					'post_parent'=> get_the_ID(), 
					'orderby' => 'menu_order' , 
					'order'=>'ASC' 
				);
				$attachments = get_posts( $attachment_args );
				if( $attachments ) {
					foreach ( $attachments as $att ) {
						$video_url = get_post_meta( $att->ID, 'be_themes_featured_video_url', true );
						$mfp_class='mfp-image';
						if( ! empty( $video_url ) ) {
							$url = $video_url;
							$mfp_class = 'mfp-iframe';
						} else {
							$url = wp_get_attachment_image_src($att->ID,'full');
							$url = $url[0];
						}
						$output .='<a href="'.$url.'" class="'.$mfp_class.'"></a>';
					}
				} else {
					$attachment_id = get_post_thumbnail_id(get_the_ID());
					$video_url = get_post_meta( $attachment_id, 'be_themes_featured_video_url', true );
					$mfp_class='mfp-image';
					if( ! empty( $video_url ) ) {
						$url = $video_url;
						$mfp_class = 'mfp-iframe';
					} else {
						$url = wp_get_attachment_image_src($attachment_id, 'full');
						$url = $url[0];
					}
					$output .='<a href="'.$url.'" class="'.$mfp_class.'"></a>';
				}
				$output .= '</div>';
			endif;
			$output .= '</div>'; //end element inner
			$output .= '</div>';//end element
		endwhile;
		wp_reset_postdata();
		$output .='</div>'; //end portfolio-container
		if( $pagination == 'infinite' && ( $items_per_page != '-1' || $items_per_page == $the_query->found_posts ) ) {
			$output .='<div class="trigger_infinite_scroll"></div>';
		} elseif( $pagination == 'loadmore' && ( $items_per_page != '-1' || $items_per_page == $the_query->found_posts ) ) {
			$output .='<div class="trigger_load_more" data-total-items="'.($the_query->found_posts-$items_per_page).'"><a class="be-shortcode mediumbtn be-button rounded" href="#">Load More</a></div>';
		}
		$output .='</div>'; //end portfolio
		return $output;
	}
	add_shortcode( 'portfolio_full_screen_with_gutter' , 'be_full_screen_portfolio_with_gutter' );
}

/*****************************************************
		GALLERY
*****************************************************/
if (!function_exists('be_gallery')) {
	function be_gallery( $atts ) {
		global $be_themes_data;
		extract( shortcode_atts( array (
			'col' => 'three',
			'images' => '',
			'masonry'=> '',
			'overlay_color' => $be_themes_data['color_scheme'],
			'overlay_opacity' => '85'
		) , $atts ) );
		global $be_themes_data;
		$overlay_color = be_themes_hexa_to_rgb( $overlay_color );
		$thumb_overlay_color = 'rgba('.$overlay_color[0].','.$overlay_color[1].','.$overlay_color[2].','.(intval($overlay_opacity) / 100 ).')';		
		$output = '';
		$output .= '<div class="portfolio '.$col.'-col">';
		$output .='<div class="portfolio-container clickable clearfix">';
		$images = explode(",",$images);
		if($images) {
			foreach($images as $image) {
				$image_atts = get_portfolio_image(get_the_ID(), $col);
				$image_size = ($masonry) ? 'portfolio-masonry' : $image_atts['size'] ; 
				$attachment_thumb=wp_get_attachment_image_src( $image, $image_size);
				$attachment_full = wp_get_attachment_image_src( $image, 'full');
				$attachment_thumb_url = $attachment_thumb[0];
				$attachment_full_url = $attachment_full[0];
				$video_url = get_post_meta( $image, 'be_themes_featured_video_url', true );
				$mfp_class='mfp-image';
				if( ! empty( $video_url ) ) {
					$attachment_full_url = $video_url;
					$mfp_class = 'mfp-iframe';
				}
				$thumb_class = 'image-popup-vertical-fit';
				$output .='<div class="element be-hoverlay not-wide">';
				$output .= '<div class="element-inner">';
				$output .= '<a href="'.$attachment_full_url.'" class="thumb-wrap '.$thumb_class.' '.$mfp_class.'"><img src="'.$attachment_thumb_url.'" alt />';
				$output .= '<span class="thumb-overlay"><span class="thumb-bg" style="background:'.$thumb_overlay_color.';">';
				$output .= '<span class="thumb-title fadeIn animated"><i class="portfolio-ovelay-icon"></i></span>';
				$output .= '</span></span>';
				$output .= '</a>';//end thumb wrap
				$output .= '</div>'; //end element inner
				$output .= '</div>';//end element
			}
		}
		$output .='</div>'; //end portfolio-container
		$output .='</div>'; //end portfolio
		return $output;
	}
	add_shortcode( 'be_gallery' , 'be_gallery' );
}

/**************************************
		GALLERY FULL WIDTH
**************************************/
if (!function_exists('be_gallery_full_screen')) {
	function be_gallery_full_screen( $atts ) {
		global $be_themes_data;
		extract( shortcode_atts( array (
			'col' => 'three',
			'images' => '',
			'masonry'=> '',
			'overlay_color' => $be_themes_data['color_scheme'],
			'overlay_opacity' => '85'
		) , $atts ) );
		global $be_themes_data;
		$overlay_color = be_themes_hexa_to_rgb( $overlay_color );
		$thumb_overlay_color = 'rgba('.$overlay_color[0].','.$overlay_color[1].','.$overlay_color[2].','.(intval($overlay_opacity) / 100 ).')';		
		$output = '';
		$output .= '<div class="portfolio full-screen '.$col.'-col">';
		$output .='<div class="portfolio-container clickable clearfix">';
		$images = explode(",",$images);
		if($images) {
			foreach($images as $image) {
				$image_atts = get_full_screen_portfolio_image($image, $col);
				$image_size = ($masonry) ? 'portfolio-masonry' : $image_atts['size'] ;
				$attachment_thumb=wp_get_attachment_image_src( $image, $image_size);
				$attachment_full = wp_get_attachment_image_src( $image, 'full');
				$attachment_thumb_url = $attachment_thumb[0];
				$attachment_full_url = $attachment_full[0];
				$video_url = get_post_meta( $image, 'be_themes_featured_video_url', true );
				$mfp_class='mfp-image';
				if( ! empty( $video_url ) ) {
					$attachment_full_url = $video_url;
					$mfp_class = 'mfp-iframe';
				}
				$thumb_class = 'image-popup-vertical-fit';
				$output .='<div class="element be-hoverlay not-wide">';
				$output .= '<div class="element-inner">';
				$output .= '<a href="'.$attachment_full_url.'" class="thumb-wrap '.$thumb_class.' '.$mfp_class.'"><img src="'.$attachment_thumb_url.'" alt />';
				$output .= '<span class="thumb-overlay"><span class="thumb-bg" style="background:'.$thumb_overlay_color.';">';
				$output .= '<span class="thumb-title fadeIn animated"><i class="portfolio-ovelay-icon"></i></span>';
				$output .= '</span></span>';
				$output .= '</a>';//end thumb wrap
				$output .= '</div>'; //end element inner
				$output .= '</div>';//end element
			}
		}
		$output .='</div>'; //end portfolio-container
		$output .='</div>'; //end portfolio
		return $output;
	}
	add_shortcode( 'gallery_full_screen' , 'be_gallery_full_screen' );
}

/*****************************************************
		GALLERY FULL SCREEN WITH GUTTER
*****************************************************/
if (!function_exists('be_gallery_with_gutter')) {
	function be_gallery_with_gutter( $atts ) {
		global $be_themes_data;
		extract( shortcode_atts( array (
			'col' => 'three',
			'images' => '',
			'masonry'=> '',
			'overlay_color' => $be_themes_data['color_scheme'],
			'overlay_opacity' => '85'	
		) , $atts ) );
		global $be_themes_data;
		$overlay_color = be_themes_hexa_to_rgb( $overlay_color );
		$thumb_overlay_color = 'rgba('.$overlay_color[0].','.$overlay_color[1].','.$overlay_color[2].','.(intval($overlay_opacity) / 100 ).')';		
		$output = '';
		$output .= '<div class="portfolio full-screen full-screen-gutter '.$col.'-col">';
		$output .='<div class="portfolio-container clickable clearfix">';
		$images = explode(",",$images);
		if($images) {
			foreach($images as $image) {
				$image_atts = get_portfolio_image($image, $col);
				$image_size = ($masonry) ? 'portfolio-masonry' : $image_atts['size'] ;
				$attachment_thumb=wp_get_attachment_image_src( $image, $image_size);
				$attachment_full = wp_get_attachment_image_src( $image, 'full');
				$attachment_thumb_url = $attachment_thumb[0];
				$attachment_full_url = $attachment_full[0];
				$video_url = get_post_meta( $image, 'be_themes_featured_video_url', true );
				$mfp_class='mfp-image';
				if( ! empty( $video_url ) ) {
					$attachment_full_url = $video_url;
					$mfp_class = 'mfp-iframe';
				}
				$thumb_class = 'image-popup-vertical-fit';
				$output .='<div class="element be-hoverlay not-wide">';
				$output .= '<div class="element-inner">';
				$output .= '<a href="'.$attachment_full_url.'" class="thumb-wrap '.$thumb_class.' '.$mfp_class.'"><img src="'.$attachment_thumb_url.'" alt />';
				$output .= '<span class="thumb-overlay"><span class="thumb-bg" style="background:'.$thumb_overlay_color.';">';
				$output .= '<span class="thumb-title fadeIn animated"><i class="portfolio-ovelay-icon"></i></span>';
				$output .= '</span></span>';
				$output .= '</a>';//end thumb wrap
				$output .= '</div>'; //end element inner
				$output .= '</div>';//end element
			}
		}
		$output .='</div>'; //end portfolio-container
		$output .='</div>'; //end portfolio
		return $output;
	}
	add_shortcode( 'gallery_full_screen_with_gutter' , 'be_gallery_with_gutter' );
}

/**************************************
			GOOGLE MAPS
**************************************/
if ( ! function_exists( 'be_gmaps' ) ) {
	function be_gmaps( $atts, $content ) {
		extract( shortcode_atts( array(
			'address'=>'',
			'latitude'=>'',
			'longitude'=>'',
			'height'=>'300',
			'zoom'=>'14',
			'style'=>'default',
			'animate'=>0,
			'animation_type'=>'fadeIn',
		), $atts ) );
		$output = '';
		$animate = ( isset( $animate ) && 1 == $animate ) ? 'be-animate' : '' ;
		if( ! empty( $address ) ) {
			$map_error = false;
			$transient_var = generateSlug($address, 10);
			$transient_result = get_transient( $transient_var );
			if(!$transient_result) {
				$coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
				$coordinates_check = json_decode($coordinates);
				if($coordinates_check->status == 'OK') {
					set_transient( $transient_var, $coordinates, 12 * HOUR_IN_SECONDS );
	    			$transient_result = get_transient( $transient_var );
				} else {
					$map_error = true;
					delete_transient( $transient_var );
				}
			}
			$coordinates = json_decode($transient_result);
			$latitude = $coordinates->results[0]->geometry->location->lat;
			$longitude = $coordinates->results[0]->geometry->location->lng;
		}
		if(!empty($latitude) && !empty($longitude)) {
			$map_error = false;
		}
		if($map_error) {
			$output .= __('Google Map API Error Please Try Again Later', 'be-themes');
		} else {
			$output .= '<div class="gmap-wrapper '.$animate.'" style="height:'.$height.'px;" data-animation="'.$animation_type.'"><div class="gmap map_960" data-address="'.$address.'" data-zoom="'.$zoom.'" data-latitude="'.$latitude.'" data-longitude="'.$longitude.'" data-style="'.$style.'"></div></div>';
		}
		
		return $output;
	}
	add_shortcode( 'gmaps', 'be_gmaps' );
}

if ( ! function_exists( 'be_lightbox_image' ) ) {
	function be_lightbox_image( $atts, $content ){
		extract( shortcode_atts( array(
			'image'=>'',
			'link'=>'',
		), $atts ) );

		$output = '';
		$full = wp_get_attachment_image_src( $image, 'full' );
		$attachment_thumb_url = $full[0];
		$attachment_full_url = $full[0];
		$video_url = get_post_meta( $image, 'be_themes_featured_video_url', true );
		$mfp_class='mfp-image';
		if( ! empty( $video_url ) ) {
			$attachment_full_url = $video_url;
			$mfp_class = 'mfp-iframe';
		}	
		$output .= '<div class="element-inner">';
		$output .='<div class="thumb-wrap"><img src="'.$attachment_thumb_url.'" alt />';
						$output .='<div class="thumb-overlay"><div class="thumb-bg">';
						$output .='<div class="thumb-icons">';
						$output .= ( ! empty( $link ) ) ? '<a href="'.$link.'"><i class="font-icon icon-link"></i></a>' : '' ;
						$output .='<a href="'.$attachment_full_url.'" class="image-popup-vertical-fit '.$mfp_class.'"><i class="font-icon icon-search"></i></a>';
						$output .= '</div>'; // end thumb icons								
						$output .='</div></div>';//end thumb overlay & bg
						$output .='</div>';//end thumb wrap
						$output .='</div>';
		return $output;
	}
	add_shortcode('lightbox_image','be_lightbox_image');
}

/**************************************
			FONT ICONS
**************************************/
if (!function_exists('be_icons')) {
	function be_icons( $atts, $content ) {
		extract(shortcode_atts(array(
			'name' => '',
			'size'=> 'small',
			'style'=> 'circle',
			'bg_color'=> '',
			'hover_bg_color'=> '',
			'color'=> '',
			'hover_color'=> '',
			'border_width' => 0,
			'border_color'=> '',
			'hover_border_color'=> '',
			'href'=> '#',
			'alignment' => '',
			'image' => '',
			'new_tab' => 0,
			'animate' => 0,
			'animation_type'=>'fadeIn',
		),$atts));

		$mfp_class = '';
		$output = '';
		if($bg_color) {
			$data_bg_color = 'data-bg-color="'.$bg_color.'"';
		} else {
			$data_bg_color = 'data-bg-color="inherit"';
			$bg_color = 'inherit';
		}
		$data_hover_bg_color = ($hover_bg_color) ? 'data-hover-bg-color="'.$hover_bg_color.'"' : 'data-hover-bg-color="'.$bg_color.'"' ; 
		if($color) {
			$data_color = 'data-color="'.$color.'"';
		} else {
			$data_color = 'data-color=""';
			$color = '';
		}
		$data_hover_color = ($hover_color) ? 'data-hover-color="'.$hover_color.'"' : 'data-hover-color="'.$color.'"' ; 
		if($border_color) {
			$data_border_color = 'data-border-color="'.$border_color.'"';
		} else {
			$data_border_color = 'data-border-color="transparent"';
			$border_color = 'transparent';
		}
		$data_hover_border_color = ($hover_border_color) ? 'data-hover-border-color="'.$hover_border_color.'"' : 'data-hover-border-color="'.$border_color.'"' ; 
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;
		$new_tab = ( isset( $new_tab ) && 1 == $new_tab ) ? 'target="_blank"' : '' ;
		$href = ( empty( $href ) ) ? '#' : $href ; 
		if ( !empty( $image ) ) {
			$mfp_class='mfp-image image-popup-vertical-fit';
			$attachment_info = wp_get_attachment_image_src( $image, 'full' );
			$href = $attachment_info[0];
			$video_url = get_post_meta( $image, 'be_themes_featured_video_url', true );
			if(!empty( $video_url )) {
				$href = $video_url;
				$mfp_class = 'mfp-iframe image-popup-vertical-fit';
			}
		}
		$output .= ( $alignment && $alignment != 'none' ) ? '<div class="icon-shortcode block-'.$alignment.'">' : '' ; 
		$output .= '<a href="'.$href.'" class="icon-shortcode '.$animate.' '.$mfp_class.'" data-animation="'.$animation_type.'" '.$new_tab.'>';
		$output .= ( $style == 'plain' ) ? '<i class="font-icon icon-'.$name.' '.$size.' '.$style.'" style="color:'.$color.';" data-color="'.$color.'" data-hover-color="'.$hover_color.'"></i></a>' : '<i class="font-icon icon-'.$name.' '.$size.' '.$style.'" style="border-style: solid; border-width: '.$border_width.'px; border-color: '.$border_color.'; background-color: '.$bg_color.'; color: '.$color.';" data-animation="'.$animation_type.'" '.$data_bg_color.' '.$data_hover_bg_color.' '.$data_color.' '.$data_hover_color.' '.$data_border_color.' '.$data_hover_border_color.'></i></a>' ;
		$output .= ( $alignment && $alignment != 'none' ) ? '</div>' : '' ;
		
		return $output;
	}
	add_shortcode( 'icon', 'be_icons' );
}

/**************************************
			LISTS
**************************************/
if (!function_exists('be_lists')) {
	function be_lists( $atts, $content ) {
		return '<ul class="custom-list">'.do_shortcode( $content ).'</ul>';
	}
	add_shortcode( 'lists', 'be_lists' );
}
if (!function_exists('be_list')) {
	function be_list( $atts, $content ) {
		global $be_themes_data;
		extract(shortcode_atts( array( 
			'icon'=>'',
			'circled'=>'',
			'icon_bg'=> $be_themes_data['color_scheme'], 
			'icon_color' => $be_themes_data['alt_bg_text_color'], 
		), $atts ) );
		if( $icon != 'none' ) { 
		 	if( 1 == $circled ){
		 		$circled = 'circled';
		 		$background_color = 'background-color:'.$icon_bg.';';
		 	} else {
		 		$circled = '';
		 		$background_color = ''; 		
		 	}
		} 
		return '<li class="custom-list-content"><i class="font-icon icon-'.$icon.' '.$circled.'" style="'.$background_color.'color:'.$icon_color.';"></i><span class="custom-list-content-inner">'.$content.'</span></li>';
	}
	add_shortcode( 'list', 'be_list' );
}

/**************************************
			NOTIFICATIONS
**************************************/
if (!function_exists('be_notifications')) {
	function be_notifications( $atts, $content ) {
		extract(shortcode_atts( array(
	        'bg_color'=>'',
			'animate'=>0,
	        'animation_type'=>'fadeIn',
	    ), $atts ) );
	    $style = '';
	    $animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;
		$style = ( ! empty( $bg_color ) ) ? 'background-color:'.$bg_color.';' : '' ;
		
		return '<div class="be-notification '.$animate.'" style="'.$style.'" data-animation="'.$animation_type.'"><span class="close"><i class="font-icon icon-cancel"></i></span>'.do_shortcode( $content ).'</div>';
	}
	add_shortcode( 'notifications', 'be_notifications' );
}

/**************************************
			PLUG IN SHORTCODES
**************************************/
if (!function_exists('be_shortcode_modules')) {
	function be_shortcode_modules( $atts, $content ) {
		extract( shortcode_atts( array(
	        'animate'=>0,
	        'animation_type'=>'fadeIn',
	    ),$atts ) );
		$output = '';
		$output .= ( isset( $animate ) && 1 == $animate ) ? '<div class="be-animate" data-animation="'.$animation_type.'">' : '' ;
		$output .= do_shortcode( $content );
		$output .= ( isset( $animate ) && 1 == $animate ) ? '</div>' : '' ;
		
		return $output;
	}
	add_shortcode( 'shortcode_modules', 'be_shortcode_modules' );
}

/**************************************
			PORTFOLIO
**************************************/
if (!function_exists('be_portfolio')) {
	function be_portfolio( $atts ) {
		global $be_themes_data;
		extract( shortcode_atts( array (
	        'col' => 'three',
	        'show_filters' => 'yes',
	        'filter' => 'categories',
	        'tax_name' => 'portfolio_categories',       
	        'category' => '',
	        'items_per_page' => '-1',
			'masonry' => '0',
			'gallery' => '0',
			'pagination' => 'none',
			'overlay_color' => $be_themes_data['color_scheme'],
			'overlay_opacity' => '85'
	    ) , $atts ) );
		$output = '';
		$overlay_color = be_themes_hexa_to_rgb( $overlay_color );
		$thumb_overlay_color = 'rgba('.$overlay_color[0].','.$overlay_color[1].','.$overlay_color[2].','.(intval($overlay_opacity) / 100 ).')';
		$output .= '<div class="portfolio '.$col.'-col" data-action="get_ajax_boxed_portfolio" data-category="'.$category.'" data-masonry="'.$masonry.'" data-showposts="'.$items_per_page.'" data-paged="2" data-col="'.$col.'" data-gallery="'.$gallery.'" data-filter="'.$filter.'" data-show_filters="'.$show_filters.'" data-thumbnail-bg-color="'.$thumb_overlay_color.'">';
		$filter_to_use = 'portfolio_'.$filter;
		$category = explode(',', $category);
		if($filter_to_use == 'portfolio_tag' || empty( $category ) ) {
			$terms = get_terms( $filter_to_use );
		} else{
	    	$args_cat = array( 'taxonomy' => array( $filter_to_use ) );
			$stack = array();
			foreach(get_categories( $args_cat ) as $single_category ){
				if ( in_array( $single_category->slug, $category ) ) {
					array_push( $stack, $single_category->cat_ID );
				}
			}
			$terms = get_terms($filter_to_use, array('include' => $stack) );
		}
	    if( ! empty( $terms ) && $show_filters == 'yes') {	
		    $output .='<div class="filters clearfix">';
	    	$output .='<h6><span class="sort current_choice" data-id="element">'.__( 'All', 'be-themes' ).'</span></h6>';
	    	foreach ($terms as $term) {
	    		$output .='<h6>';    		
	    		$output .= '<span class="sort" data-id="'.$term->slug.'">'.$term->name.'</span>';    		
	    		$output .= '</h6>';
	    	}
	    	$output .='</div>'; //end filters	
		}
		$output .='<div class="portfolio-container clickable clearfix">';
		$items_per_page = (empty($items_per_page)) ? -1 : $items_per_page ;
		$tax_name = (isset($tax_name) && !empty($tax_name)) ? $tax_name : 'portfolio_categories' ;
		if( empty( $category[0] ) ) {
			$args = array(
				'post_type' => 'portfolio',
				'status' => 'publish',
				'posts_per_page' => $items_per_page,
				'orderby'=>'date',				
			);
		} else {
			$args = array(
				'post_type' => 'portfolio',
				'status' => 'publish',
				'posts_per_page' => $items_per_page,
				'tax_query' => array (
					array (
						'taxonomy' => $tax_name,
						'field' => 'slug',
						'terms' => $category,
						'operator' => 'IN',
					)
				),
				'orderby'=>'date',	
			);	
		}
		$the_query = new WP_Query( $args );
		while ( $the_query->have_posts() ) : $the_query->the_post();
			$filter_classes = '';
			$permalink = '';
			$mfp_class='mfp-image';
			$post_terms = get_the_terms( get_the_ID(), $filter_to_use );
			
			if( $show_filters == 'yes' && is_array( $post_terms ) ) {
				foreach ( $post_terms as  $term ) {
					$filter_classes .=$term->slug." ";
				}
			} else{
				$filter_classes='';
			}
			$attachment_id = get_post_thumbnail_id(get_the_ID());
			$image_atts = get_portfolio_image(get_the_ID(), $col);
			$image_size = ($masonry) ? 'portfolio-masonry' : $image_atts['size'] ; 
			$attachment_thumb=wp_get_attachment_image_src( $attachment_id, $image_size);
			$attachment_full = wp_get_attachment_image_src( $attachment_id, 'full');
			$attachment_thumb_url = $attachment_thumb[0];
			$attachment_full_url = $attachment_full[0];
			
			$video_url = get_post_meta( $attachment_id, 'be_themes_featured_video_url', true );
			$visit_site_url = get_post_meta( get_the_ID(), 'be_themes_portfolio_external_url', true );
			$link_to = get_post_meta( get_the_ID(), 'be_themes_portfolio_link_to', true );
			$open_with = get_post_meta( get_the_ID(), 'be_themes_portfolio_single_page_style', true );
			$permalink = ( $link_to == 'external_url' ) ? $visit_site_url : get_permalink() ;
			
			if( ! empty( $video_url ) ) {
				$attachment_full_url = $video_url;
				$mfp_class = 'mfp-iframe';
			}

			if( isset($gallery) && $gallery == 'yes') {
				$thumb_class = 'be-lightbox-gallery';
			} else if( isset($open_with) && $open_with == 'lightbox') {
				$thumb_class = 'image-popup-vertical-fit';
			} else if( isset($open_with) && $open_with == 'none') {
				$thumb_class = 'no-link';
				$attachment_full_url = '#';
			} else if( isset($open_with) && ($open_with == 'style1' || $open_with == 'style2' || $open_with == 'style3' || $open_with == 'style4')) {
				$thumb_class = 'custom-slider';
				$attachment_full_url = get_permalink();
			} else {
				$thumb_class = '';
				$attachment_full_url = $permalink;
			}
			$link_to_thumbnail = ( isset($open_with) && ($open_with == 'style1' || $open_with == 'style2' || $open_with == 'style3' || $open_with == 'style4')) ? '#'.be_get_the_slug(get_the_ID()) : $attachment_full_url ; 
			
			$output .='<div class="element be-hoverlay '.$image_atts['class'].' '.$image_atts['alt_class'].' '.$filter_classes.'" id="'.be_get_the_slug(get_the_ID()).'">';
			$output .= '<div class="element-inner">';
			$output .= '<a href="'.$link_to_thumbnail.'" data-href="'.$attachment_full_url.'" class="thumb-wrap '.$thumb_class.' '.$mfp_class.'"><img src="'.$attachment_thumb_url.'" alt />';
			$output .= '<span class="thumb-overlay"><span class="thumb-bg" style="background-color:'.$thumb_overlay_color.';">';
			$output .= '<span class="thumb-title fadeInLeft animated">';
			$output .= get_the_title();
			$output .= '</span>';	
			$output .= '</span></span>';//end thumb overlay & bg
			$output .= '</a>';//end thumb wrap
			if( isset($gallery) && $gallery == 'yes' ):
				$output .='<div class="popup-gallery">';
				$attachment_args = array ( 
					'post_type' => 'attachment', 
					'posts_per_page' => -1, 
					'post_status' => 'any', 
					'post_parent'=> get_the_ID(), 
					'orderby' => 'menu_order' , 
					'order'=>'ASC' 
				);
				$attachments = get_posts( $attachment_args );
				if( $attachments ) {
					foreach ( $attachments as $att ) {
						$video_url = get_post_meta( $att->ID, 'be_themes_featured_video_url', true );
						$mfp_class='mfp-image';
						if( ! empty( $video_url ) ) {
							$url = $video_url;
							$mfp_class = 'mfp-iframe';
						} else {
							$url = wp_get_attachment_image_src($att->ID,'full');
							$url = $url[0];
						}
						$output .='<a href="'.$url.'" class="'.$mfp_class.'"></a>';
					}
				} else {
					$attachment_id = get_post_thumbnail_id(get_the_ID());
					$video_url = get_post_meta( $attachment_id, 'be_themes_featured_video_url', true );
					$mfp_class='mfp-image';
					if( ! empty( $video_url ) ) {
						$url = $video_url;
						$mfp_class = 'mfp-iframe';
					} else {
						$url = wp_get_attachment_image_src($attachment_id, 'full');
						$url = $url[0];
					}
					$output .='<a href="'.$url.'" class="'.$mfp_class.'"></a>';
				}
				$output .= '</div>';
			endif;
			$output .= '</div>'; //end element inner
			$output .= '</div>';//end element
		endwhile;
		wp_reset_postdata();
		$output .='</div>'; //end portfolio-container
		if( $pagination == 'infinite' && ( $items_per_page != '-1' || $items_per_page == $the_query->found_posts ) ) {
			$output .='<div class="trigger_infinite_scroll"></div>';
		} elseif( $pagination == 'loadmore' && ( $items_per_page != '-1' || $items_per_page == $the_query->found_posts ) ) {
			$output .='<div class="trigger_load_more" data-total-items="'.($the_query->found_posts-$items_per_page).'"><a class="be-shortcode mediumbtn be-button rounded" href="#">Load More</a></div>';
		}
		$output .='</div>'; //end portfolio
		return $output;
	}
	add_shortcode( 'portfolio' , 'be_portfolio' );
}

/**************************************
		PORTFOLIO CAROUSEL
**************************************/
if (!function_exists('be_portfolio_carousel')) {
	function be_portfolio_carousel( $atts ) {
		extract( shortcode_atts( array (
	        'category'=> '',
	        'items_per_page'=> '-1',
	    ) , $atts ) );
		$output = '';
		$category = explode(',', $category);
		$output .= '<div class="carousel-wrap portfolio-carousel"><div class="caroufredsel_wrapper clearfix"><ul class="be-carousel portfolios-carousel">';
		$items_per_page = (empty($items_per_page)) ? -1 : $items_per_page ; 
		if( empty( $category[0] ) ) {
			$args = array(
				'post_type' => 'portfolio',
				'status' => 'publish',
				'posts_per_page' => $items_per_page,
				'orderby'=>'date',				
			);
		} else {
			$args = array(
				'post_type' => 'portfolio',
				'status' => 'publish',
				'posts_per_page' => $items_per_page,
				'tax_query' => array(
					array(
						'taxonomy' => 'portfolio_categories',
						'field' => 'slug',
						'terms' => $category,
						'operator' => 'IN',
					)
				),
				'orderby'=>'date',
			);	
		}
		$the_query = new WP_Query( $args );
		while ( $the_query->have_posts() ) : $the_query->the_post();
			$post_terms = get_the_terms( get_the_ID(), 'portfolio_categories' );
			$attachment_id = get_post_thumbnail_id(get_the_ID());
			$attachment_thumb=wp_get_attachment_image_src( $attachment_id, 'portfolio');
			$attachment_full = wp_get_attachment_image_src( $attachment_id, 'full');
			$attachment_thumb_url = $attachment_thumb[0];
			$attachment_full_url = $attachment_full[0];
			$video_url = get_post_meta( $attachment_id, 'be_themes_featured_video_url', true );
			$visit_site_url = get_post_meta( get_the_ID(), 'be_themes_portfolio_external_url', true );
			$link_to = get_post_meta( get_the_ID(), 'be_themes_portfolio_link_to', true );
			$open_with = get_post_meta( get_the_ID(), 'be_themes_portfolio_single_page_style', true );
			$permalink = '';
			$permalink = ( $link_to == 'external_url' ) ? $visit_site_url : get_permalink() ; 
			$mfp_class='mfp-image';
			if( ! empty( $video_url ) ) {
				$attachment_full_url = $video_url;
				$mfp_class = 'mfp-iframe';
			}
			if( isset($open_with) && $open_with == 'lightbox') {
				$thumb_class = 'image-popup-vertical-fit';
			} else if( isset($open_with) && $open_with == 'none') {
				$thumb_class = 'no-link';
				$attachment_full_url = '#';
			} else if( isset($open_with) && ($open_with == 'style1' || $open_with == 'style2' || $open_with == 'style3' || $open_with == 'style4')) {
				$thumb_class = 'custom-slider';
				$attachment_full_url = get_permalink();
			} else {
				$thumb_class = '';
				$attachment_full_url = $permalink;
			}
			$link_to_thumbnail = ( isset($open_with) && ($open_with == 'style1' || $open_with == 'style2' || $open_with == 'style3' || $open_with == 'style4')) ? '#'.be_get_the_slug(get_the_ID()) : $attachment_full_url ; 
			
			$output .='<li class="carousel-item">';
			$output .= '<a href="'.$link_to_thumbnail.'" data-href="'.$attachment_full_url.'" class="thumb-wrap '.$thumb_class.' '.$mfp_class.'"><img src="'.$attachment_thumb_url.'" alt />';
			$output .= '<div class="thumb-overlay"><div class="thumb-bg">';
			$output .= '<div class="thumb-title">'.get_the_title().'</div>';
			$output .= '</div></div>';//end thumb overlay & bg
			$output .= '</a>';
			$output .= '</li>';
		endwhile;
		wp_reset_postdata();
		$output .='</ul>';
		$output .='<a class="prev be-carousel-nav icon-left-open" href="#"></a><a class="next be-carousel-nav icon-right-open" href="#"></a>';
		$output .='</div></div>';
		return $output;
	}
	add_shortcode( 'portfolio_carousel' , 'be_portfolio_carousel' );
}

/*****************************************************
		Portfolio Navigation
*****************************************************/
if (!function_exists('portfolio_navigation_module')) {
	function portfolio_navigation_module( $atts, $content ) {
		extract( shortcode_atts( array (
		    'nav_links_color' => '',
		    'animate' => 0,
			'animation_type'=>'fadeIn',
	    ), $atts ));
	    $output = "";
	    $animate = ( isset( $animate ) && 1 == $animate ) ? 'be-animate' : '' ;
		$output .= '<div class="single-page-nav-wrap '.$animate.'" data-animation="'.$animation_type.'" style="color : '.$nav_links_color.';">';
		ob_start();  
		get_template_part( 'single', 'navigation' ); 
		$output .= ob_get_contents();  
		ob_end_clean();
		$output .= '</div>';
	    return $output;
	}
	add_shortcode( 'portfolio_navigation_module', 'portfolio_navigation_module' );
}

/**************************************
			PORTFOLIO DETAILS
**************************************/
if ( ! function_exists( 'be_project_details' ) ) {
	function be_project_details( $atts, $content ) {
		global $post;
		$output = '';
		$post_type = get_post_type();
		if( $post_type != 'portfolio' ) {
			return '';
		} else {
			$client_name = get_post_meta( $post->ID, 'be_themes_portfolio_client_name', true );
			$project_date = get_post_meta( $post->ID, 'be_themes_portfolio_project_date', true );

			$cats = get_the_terms( $post->ID, 'portfolio_categories' );
			$portfolio_cats = array();
			if( $cats ) {
				foreach ( $cats as $value ) {
					array_push( $portfolio_cats, $value->name );
				}
			}
			$portfolio_cats = implode( ', ', $portfolio_cats );
			$visit_site_url = get_post_meta( $post->ID, 'be_themes_portfolio_visitsite_url' , true );
			$output .= '<ul class="project_details">';
			$output .= ( ! empty( $project_date ) ) ? '<li class="project_date"><i class="font-icon icon-clock"></i>'.$project_date.'</li>' : '' ;
			$output .= ( ! empty( $client_name ) ) ? '<li class="client_name"><i class="font-icon icon-doc-text"></i>'.$client_name.'</li>' : '' ;
			$output .= ( ! empty( $portfolio_cats ) ) ? '<li class="project_cats"><i class="font-icon icon-tag"></i>'.$portfolio_cats.'</li>' : '' ;
			$output .= ( ! empty( $visit_site_url ) ) ? '<li class="visit_site"><a href="'.$visit_site_url.'"><i class="font-icon icon-link"></i>'.$visit_site_url.'</a></li>' : '' ;
			$output .='</ul>';
			return $output;
		}

	}
	add_shortcode( 'project_details', 'be_project_details' );
}

/**************************************
			PRICING TABLE
**************************************/
if ( ! function_exists( 'be_pricing_column' ) ) {
	function be_pricing_column( $atts, $content ) {
		global $be_themes_data;
		extract( shortcode_atts( array(
			'title'=>'',
			'h_tag'=>'h5',
			'price'=>'',
			'duration'=>'',
			'currency'=>'$',
			'button_text'=>'',
			'button_color'=> $be_themes_data['color_scheme'],
			'button_hover_color' => '',
			'button_bg_color' => '',
			'button_bg_hover_color' => '',
			'button_border_color' => $be_themes_data['color_scheme'],
			'button_border_hover_color' => '',
			'button_link'=>'',
			'highlight'=>'no',
			'style'=>'style-1',
			'animate'=>0,
			'animation_type'=>'fadeIn',
	    ), $atts ) );

	    $output = '';
	    $animate = ( isset( $animate ) && 1 == $animate ) ? 'be-animate' : '' ;
		
		$output .= '<ul class="pricing-table sec-border highlight-'.$highlight.' '.$animate.'" data-animation="'.$animation_type.'">';
	    if( ! empty( $title ) ) {
	    	$output .= ( $style == 'style-1' ) ? '<li class="pricing-title sec-bg"><'.$h_tag.' class="sec-color">'.$title.'</'.$h_tag.'></li>' : '<li class="pricing-title alt-bg"><'.$h_tag.' class="alt-bg-text-color">'.$title.'</'.$h_tag.'></li>' ;
	    }
	    $output .= ( ! empty( $price ) ) ? '<li class="pricing-price"><span class="price">'.$price.'</span><span class="currency">'.$currency.'</span><span class="pricing-duration">'.$duration.'</span></li>' : '' ; 
	    $output .= do_shortcode( $content );
		$output .= 	( !empty( $button_text ) && !empty( $button_link ) ) ? '<li class="pricing-button">'.do_shortcode('[button button_text= "'.$button_text.'" type= "medium" gradient= "1" rounded= "1" icon= "" bg_color ="'.$button_bg_color.'" hover_bg_color = "'.$button_bg_hover_color.'"  border_width= "1" border_color = "'.$button_border_color.'" hover_border_color = "'.$button_border_hover_color.'" color= "'.$button_color.'" hover_color= "'.$button_hover_color.'" url="'.$button_link.'" ]').'</li>' : '' ;
	    $output .= '</ul>';

	    return $output;

	}
	add_shortcode( 'pricing_column', 'be_pricing_column' );
}
if ( ! function_exists( 'be_pricing_feature' ) ) {
	function be_pricing_feature( $atts, $column ) {
		extract( shortcode_atts( array(
			'feature' => '',
			'highlight' => '',
			'highlight_color' => '',
			'highlight_text_color' => ''
		), $atts ) );
		$output = '';
		if( ! empty( $feature ) ) {
			if($highlight) {
				$highlight_section = 'highlight';
				$highlight_color = (!$highlight_color) ? '#e5e5e5' : $highlight_color ; 
			} else {
				$highlight_section = 'no-highlight';
				$highlight_color = '';
				$highlight_text_color = '';
			}
			$output .='<li class="pricing-feature '.$highlight_section.'" style="background : '.$highlight_color.'; color : '.$highlight_text_color.'">'.$feature.'</li>';
		}
		return $output;
	}
	add_shortcode( 'pricing_feature', 'be_pricing_feature' );
}

/**************************************
			RECENT POSTS
**************************************/
if ( ! function_exists( 'be_recent_posts' ) ) {
	function be_recent_posts( $atts, $content ) {
		extract( shortcode_atts( array(
			'number'=>'three',
	    ), $atts ) );
			
		if( $number == 'three' ) {
			$posts_per_page = 3;
			$column = 'third';
		} else {
			$posts_per_page = 4;
			$column = 'fourth';
		}

		$args=array(
			'post_type' => 'post',
			'posts_per_page'=> $posts_per_page,
			'orderby'=>'date',
			'ignore_sticky_posts'=>1,
			'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-quote' ),
					'operator' => 'NOT IN',
				)
			),
		);
		$output = '';
		$my_query = new WP_Query( $args  );
		if( $my_query->have_posts() ) {
			
			$output .= '<div class="clearfix related-items">';
			while ( $my_query->have_posts() ) : $my_query->the_post(); 
				 $output .= '<div class="one-'.$column.' column-block be-hoverlay">';
				ob_start();
				get_template_part( 'content', get_post_format() );
				$post_format_content = ob_get_clean();
				$output .= $post_format_content;
				$output .= '<header class="recent-post-header"><h6 class="recent-post-title"><a href="'.get_permalink(get_the_ID()).'">'.get_the_title().'</a></h6><nav class="post-nav meta-font"><span>'.get_the_date( "F j, Y" ).' |</span> <span><a href="'.get_comments_link().'">'.get_comments_number('0','1','%').__(' comments','be-themes').'</a></span></nav></header>';
				$output .= '<article class="recent-posts-content">'.be_themes_get_excerpt( get_the_ID(), 20 ).'</article>';
				$output .= '</div>'; // end column block
			endwhile;
			$output .= '</div>';
		}
		wp_reset_query();
		return $output;
	}
	add_shortcode( 'recent_posts', 'be_recent_posts' );
}

/**************************************
			SERVICES
**************************************/
if ( ! function_exists( 'be_services' ) ) {
	function be_services( $atts, $content ) {
		extract( shortcode_atts( array (
			'line_color' => '',
	    ),$atts ) );
		return '<div class="services-outer-wrap"><ul class="services">'.do_shortcode( $content ).'</ul><span class="timeline" style="background: '.$line_color.'"></span></div>';
	}
	add_shortcode( 'services', 'be_services' );
}

if ( ! function_exists( 'be_service' ) ) {
	function be_service( $atts, $content ) {
		extract( shortcode_atts( array (
			'icon' => '',
			'icon_size' => 'small',
			'icon_bg_color' => '',
			'icon_hover_bg_color' => '',
			'icon_color' => '',
			'icon_hover_color' => '',
	    ),$atts ) );
	    $icon_bg_color = (empty($icon_bg_color)) ? '#000' : $icon_bg_color ; 
		$icon_hover_bg_color = (empty($icon_hover_bg_color)) ? $icon_bg_color : $icon_hover_bg_color ; 
		$icon_color = (empty($icon_color)) ? '#fff' : $icon_color ; 
		$icon_hover_color = (empty($icon_hover_color)) ? $icon_color : $icon_hover_color ; 
		
		return '<li class="service"><div class="service-wrap" data-bg-color="'.$icon_bg_color.'" data-hover-bg-color="'.$icon_hover_bg_color.'" data-color="'.$icon_color.'" data-hover-color="'.$icon_hover_color.'"><i class="font-icon icon-'.$icon.' icon-size-'.$icon_size.'" style="background: '.$icon_bg_color.';color: '.$icon_color.';"></i>'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) ).'</div></li>';
	}
	add_shortcode( 'service', 'be_service' );
}

/**************************************
			SKILlS
**************************************/
if ( ! function_exists( 'be_skills' ) ) {
	function be_skills( $atts, $content ) {
		return '<div class="skill_container be-shortcode"><div class="col"><div id="skill">'.do_shortcode( $content ).'</div></div></div>';
	}
	add_shortcode( 'skills', 'be_skills' );
}
if ( ! function_exists( 'be_skill' ) ) {
	function be_skill( $atts, $content ) {
		global $be_themes_data;
		extract( shortcode_atts( array( 
			'title'=>'',
			'value'=>'',
			'fill_color'=>$be_themes_data['color_scheme'],
			'bg_color'=> '',
			'title_color'=> '',
		),$atts ) );
		$title_color = ( $title_color ) ? 'style="color: '.$title_color.'"' : '' ;
		
		return '<h6 class="skill_name" '.$title_color.'>'.$title.'</h6><div class="skill-bar" style="background:'.$bg_color.';"><span class="be-skill expand alt-bg alt-bg-text-color" data-skill-value="'.$value.'%" style="background:'.$fill_color.';"></span></div>';
	}
	add_shortcode( 'skill', 'be_skill' );
}

/**************************************
			LINEBREAK
**************************************/
if (!function_exists('be_linebreak')) {
	function be_linebreak( $atts ) {
		extract(shortcode_atts( array(
	        'height'=>'50',
	    ),$atts ) );	
		$output = '';
		$output .='<div class="linebreak" style="height:'.$height.'px;"></div>';
		return $output;
	}
	add_shortcode( 'linebreak', 'be_linebreak' );
}

/**************************************
			SPECIAL TITLE 1
**************************************/
if (!function_exists('be_special_heading')) {
	function be_special_heading( $atts, $content ) {
		extract( shortcode_atts( array(
			'title_content' => '',
			'h_tag' => 'h3',
			'title_color' => '',
	        'separator_color' => '#323232',
			'scroll_to_animate'=> 0,
			'animate'=> 0,
	        'animation_type'=> 'fadeIn',
	    ),$atts ) );
	    $output ='';
	    $animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;
		$scroll_to_animate = ( isset( $scroll_to_animate ) && 1 == $scroll_to_animate ) ? 'scrollToFade' : $scroll_to_animate ;
		$separator_color = ( ! empty( $separator_color ) ) ? 'style="background-color:'.$separator_color.';border-color:'.$separator_color.';color:'.$separator_color.';"' : $separator_color ;
		
		$output .='<div class="special-heading-wrap style1'.$animate.' '.$scroll_to_animate.'" data-animation="'.$animation_type.'"><div class="special-heading align-center">';
		$output .= ($title_content) ? '<'.$h_tag.' class="special-h-tag" style="color: '.$title_color.'">'.$title_content.'</'.$h_tag.'>' : '' ;
		$output .= ($content) ? '<div class="sub-title">'.$content.'</div>' : '' ;
		$output .='<hr class="separator style-2" '.$separator_color.' />';
		$output .='</div></div>';
		return $output;
	}
	add_shortcode( 'special_heading', 'be_special_heading' );
}

/**************************************
			SPECIAL TITLE 2
**************************************/
if (!function_exists('be_special_heading2')) {
	function be_special_heading2( $atts, $content ) {
		extract( shortcode_atts( array(
	        'title_content' => '',
	        'title_color' => '',
	        'h_tag' => 'h3',
	        'separator_color' => '#323232',
	        'border_color' => '',
	        'bg_color' => '',
	        'bg_opacity' => '',
			'scroll_to_animate'=> 0,
			'animate'=>0,
	        'animation_type'=>'fadeIn',
	    ),$atts ) );

		$output ='';
		$bg_opacity = $bg_opacity/100;
		$bg = be_themes_get_background_colors($bg_color, $bg_opacity);

		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;
		$scroll_to_animate = ( isset( $scroll_to_animate ) && 1 == $scroll_to_animate ) ? 'scrollToFade' : '' ;
		$separator_color = ( ! empty( $separator_color ) ) ? 'style="background-color:'.$separator_color.';border-color:'.$separator_color.';color:'.$separator_color.';"' : $separator_color ;
		
		$output.='<div class="special-heading-wrap style2'.$animate.' '.$scroll_to_animate.'" data-animation="'.$animation_type.'" style="border-color: '.$border_color.';">';
		$output.='<div class="special-heading align-center" style="'.$bg.'"><'.$h_tag.' class="special-h-tag" style="color: '.$title_color.'">'.$title_content.'</'.$h_tag.'>';
		$output.= ($content) ? '<hr class="separator style-2" '.$separator_color.' /><span class="sub-title">'.$content.'</span>' : '' ;
		$output .='</div></div>';
		return $output;
	}
	add_shortcode( 'special_heading2', 'be_special_heading2' );
}

/**************************************
			SPECIAL TITLE 3
**************************************/
if (!function_exists('be_special_heading3')) {
	function be_special_heading3( $atts, $content ) {
		extract( shortcode_atts( array(
	        'title_content' => '',
			'h_tag' => 'h3',
	        'title_color' => '',
	        'sub_title1' => '',
	        'sub_title2' => '',
	        'top_caption_color' => '',
	        'bottom_caption_color' => '',
	        'top_caption_separator_color' => '',
	        'bottom_caption_separator_color' => '',
			'scroll_to_animate'=> 0,
			'animate'=>0,
	        'animation_type'=>'fadeIn',
	    ),$atts ) );
		$output ='';
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ;
		$scroll_to_animate = ( isset( $scroll_to_animate ) && 1 == $scroll_to_animate ) ? 'scrollToFade' : '' ; 
		$top_caption_separator_color = ( ! empty( $top_caption_separator_color ) ) ? 'style="background-color:'.$top_caption_separator_color.';"' : '' ; 
		$bottom_caption_separator_color = ( ! empty($bottom_caption_separator_color) ) ? 'style="background-color:'.$bottom_caption_separator_color.';"' : '' ; 
		$top_caption_color = ( ! empty( $top_caption_color ) ) ? 'style="color:'.$top_caption_color.';"' : '' ;
		$bottom_caption_color = ( ! empty( $bottom_caption_color ) ) ? 'style="color:'.$bottom_caption_color.';"' : '' ;
		
		$output .='<div class="special-heading-wrap style3'.$animate.' '.$scroll_to_animate.'" data-animation="'.$animation_type.'">';
		$output .= ($sub_title1) ? '<div class="caption-wrap"><h6 class="caption" '.$top_caption_color.'>'.$sub_title1.'<span class="caption-inner" '.$top_caption_separator_color.'></span></h6></div>' : '' ;
		$output .='<div class="special-heading align-center"><'.$h_tag.' class="special-h-tag" style="color: '.$title_color.'">'.$title_content.'</'.$h_tag.'></div>';
		$output .= ($sub_title2) ? '<div class="caption-wrap"><h6 class="caption" '.$bottom_caption_color.'>'.$sub_title2.'<span class="caption-inner" '.$bottom_caption_separator_color.'></span></h6></div>' : '' ;
		$output .='</div>';
		return $output;
	}
	add_shortcode( 'special_heading3', 'be_special_heading3' );
}

/**************************************
			TABS
**************************************/
if (!function_exists('be_tabs')) {
	function be_tabs( $atts, $content ){
		$GLOBALS['tabs_cnt'] = 0;
		$tabs_cnt=0;
		$GLOBALS['tabs'] = array();
		$rand = rand();
		$content=do_shortcode( $content );
			
		if( is_array( $GLOBALS['tabs'] ) ){
			foreach( $GLOBALS['tabs'] as $tab ) {
				extract($tab);
				$title_style = $content_style = '';
				$title_style .= ($title_bg_color) ? 'background: '.$title_bg_color.';' : '' ;
				$title_style .= ($title_color) ? 'color: '.$title_color.';' : '' ;
				$title_style .= ($title_border_color) ? 'border-color: '.$title_border_color.';' : '' ;
				$content_style .= ($content_bg_color) ? 'background: '.$content_bg_color.';' : '' ;
				$content_style .= ($content_border_color) ? 'border-color: '.$content_border_color.';' : '' ;
				$tabs_cnt++;
				$class = ( ! empty($tab['icon']) && $tab['icon'] != 'none' ) ? "tab-icon icon-".$tab['icon'] : "" ;
				$tabs[] = '<li><a class="'.$class.'" href="#fragment-'.$tabs_cnt.'-'.$rand.'" style="'.$title_style.'">'.$tab['title'].'</a></li>';
				$panes[] = '<div id="fragment-'.$tabs_cnt.'-'.$rand.'" class="clearfix" style="'.$content_style.'"><p>'.$tab['content'].'</p></div>';
			}
			$return = ($panes || $tabs) ? "\n".'<div class="tabs be-tabs"><ul class="clearfix">'.implode( "\n", $tabs ).'</ul>'.implode( $panes ).'</div>'."\n" : '' ; 
		}
		return $return;
	}
	add_shortcode( 'tabs', 'be_tabs' );
}
if (!function_exists('be_tab')) {
	function be_tab( $atts, $content ){
		extract(shortcode_atts( array(
	        'icon'=>'',
	        'title'=>'',
	        'title_bg_color' => '',
	        'title_border_color' => '',
			'title_color' => '',
			'content_bg_color' => '',
			'content_border_color' => '',
	    ),$atts ) );
		$content= do_shortcode($content);
		$x = $GLOBALS['tabs_cnt'];
		$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tabs_cnt'] ), 'content' =>  $content, 'icon'=> $icon, 'title_bg_color'=> $title_bg_color, 'title_border_color'=> $title_border_color, 'title_color'=> $title_color, 'content_bg_color'=> $content_bg_color, 'content_border_color'=> $content_border_color);
		$GLOBALS['tabs_cnt']++;
	}
	add_shortcode( 'tab', 'be_tab' );
}

/**************************************
			TEAM
**************************************/
if ( ! function_exists( 'be_team' ) ) {
	function be_team( $atts, $content ) {
		global $be_themes_data;
		extract( shortcode_atts( array( 
			'title'=>'',
			'h_tag'=>'h5',
			'description'=>'',
			'designation'=>'',
			'image'=>'',
			'title_color'=> '',
			'description_color'=> '',
			'designation_color'=> '',			
			'facebook'=>'',
			'twitter'=>'',
			'dribbble'=>'',
			'google_plus'=>'',
			'linkedin'=>'',
			'youtube'=>'',
			'vimeo'=>'',
			'icon_color'=> $be_themes_data['color_scheme'],
			'icon_hover_color'=> $be_themes_data['color_scheme'],
			'animate'=>0,
	        'animation_type'=>'fadeIn',
		),$atts ) );

		$output = '';
		$url = wp_get_attachment_image_src( $image, 'portfolio-masonry' );
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : $animate ;
		if( $icon_color ) {
			$style = 'style="color: '.$icon_color.'"';
			$icon_color = 'data-default-color="'.$icon_color.'"';
		} else {
			$style = 'style="color: '.$be_themes_data['color_scheme'].'"';
			$icon_color = 'data-default-color="'.$be_themes_data['color_scheme'].'"';
		}
		$icon_hover_color = ( $icon_hover_color ) ? 'data-hover-color="'.$icon_hover_color.'"' : $icon_hover_color ;
		$designation_color = ( $designation_color ) ? 'style="color: '.$designation_color.'"' : $designation_color ;
		$description_color = ( $description_color ) ? 'style="color: '.$description_color.'"' : $description_color ;
		$title_color = ( $title_color ) ? 'style="color: '.$title_color.'"' : $title_color ;
		
		$output .= '<div class="team-shortcode-wrap"><div class="team-img '.$animate.'" data-animation="'.$animation_type.'"><img src="'.$url[0].'" alt="'.$title.'" /></div>
					<div class="team-wrap '.$animate.'" data-animation="'.$animation_type.'">
					<'.$h_tag.' class="team-title" '.$title_color.'>'.$title.'</'.$h_tag.'><p class="designation alt-color" '.$designation_color.'>'.$designation.'</p>
					<p class="team-description" '.$description_color.'>'.$description.'</p>';
		if( ! empty( $facebook ) || ! empty( $twitter ) || ! empty( $dribbble ) || ! empty( $google_plus ) || ! empty( $linkedin ) || ! empty( $youtube ) || ! empty( $vimeo ) || ! empty( $email )){
			$output .='<ul class="team-social clearfix">';
			$output .= ( ! empty( $facebook ) ) ? '<li><a href="'.$facebook.'" class="team_icons" target="_blank" '.$icon_color.' '.$icon_hover_color.' '.$style.'><i class="icon-facebook"></i></a></li>' : '' ;
			$output .= ( ! empty( $twitter ) ) ? '<li><a href="'.$twitter.'" class="team_icons" target="_blank" '.$icon_color.' '.$icon_hover_color.' '.$style.'><i class="icon-twitter"></i></a></li>' : '' ;
			$output .= ( ! empty( $google_plus ) ) ? '<li><a href="'.$google_plus.'" class="team_icons" target="_blank" '.$icon_color.' '.$icon_hover_color.' '.$style.'><i class="icon-gplus"></i></a></li>' : '' ;
			$output .= ( ! empty( $linkedin ) ) ? '<li><a href="'.$linkedin.'" class="team_icons" target="_blank" '.$icon_color.' '.$icon_hover_color.' '.$style.'><i class="icon-linkedin"></i></a></li>' : '' ;
			$output .= ( ! empty( $youtube ) ) ? '<li><a href="'.$youtube.'" class="team_icons" target="_blank" '.$icon_color.' '.$icon_hover_color.' '.$style.'><i class="icon-youtube"></i></a></li>' : '' ;
			$output .= ( ! empty( $dribbble ) ) ? '<li><a href="'.$dribbble.'" class="team_icons" target="_blank" '.$icon_color.' '.$icon_hover_color.' '.$style.'><i class="icon-dribbble"></i></a></li>' : '';
			$output .= ( ! empty( $vimeo ) ) ? '<li><a href="'.$vimeo.'" class="team_icons" target="_blank" '.$icon_color.' '.$icon_hover_color.' '.$style.'><i class="icon-vimeo"></i></a></li>' : '';
											
			$output .='</ul>';
		}			
		$output .='</div></div>';			
		return $output;		
	}
	add_shortcode( 'team', 'be_team' );
}

/**************************************
			TESTIMONIALS
**************************************/
if (!function_exists('be_testimonials')) {	
	function be_testimonials( $atts, $content ){
		global $be_themes_data;
		extract( shortcode_atts( array(
			'animate'=>0,
			'animation_type'=>'fadeIn',
		), $atts ) );
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : '' ; 
		$return = '<div class="testimonials_wrap '.$animate.'" data-animation="'.$animation_type.'"><div class="flexslider testimonial-flex-slider"><ul class="clearfix slides">'.do_shortcode( $content ).'</ul></div></div>';		
		return $return;	
	}	
	add_shortcode( 'testimonials', 'be_testimonials' );
}
if (!function_exists('be_testimonial')) {	
	function be_testimonial( $atts, $content ) {
		extract( shortcode_atts( array(
			'author' => '',
			'author_color'=> '',
		), $atts ) );
		$content= do_shortcode($content);		
		extract($atts);		
		$author_color = !empty( $author_color ) ? 'style="color:'.$author_color.';"' : '';
		$author = !empty( $author ) ? '<h6 class="testimonial-author" '.$author_color.'>'.$author.'</h6>' : '';
		return '<li class="testimonial_slide slide clearfix">'.$content.$author.'</li>';
	}	
	add_shortcode( 'testimonial', 'be_testimonial' );
}

/**************************************
			TITLE WITH ICON
**************************************/
if ( ! function_exists( 'be_title_icon' ) ) {
	function be_title_icon($atts,$content) {
		global $be_themes_data;
		extract(shortcode_atts(array(
			'icon'=>'none',
			'size' => 'small',
			'alignment'=>'left',	
			'style'=>'circled',
			'icon_bg'=> '',
			'icon_color'=> '',
			'icon_border_color'=> '',
			'animate'=> 0,
			'animation_type'=>'fadeIn',
		),$atts));
		$output ='';
		$background_color = ( $style == 'circled' || $style == 'rounded' ) ? 'background-color:'.$icon_bg.';' : '' ;
		$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : 0 ;
		$output .= '<i class="icon-'.$icon.' title-icon '.$style.' '.$size.' '.$animate.' align-'.$alignment.'" style="'.$background_color.'color:'.$icon_color.';border-color: '.$icon_border_color.'" data-animation="'.$animation_type.'"></i>';
		$output .= '<div class="title-with-icon '.$animate.' '.$size.' '.$style.' align-'.$alignment.'" data-animation="'.$animation_type.'">'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) ).'</div>';    		
		
		return $output; 
	}
	add_shortcode('title_icon','be_title_icon');
}

/**************************************
			VIDEO - YOUTUBE
**************************************/
if (!function_exists('be_video')) {
	function be_video( $atts, $content ) {
		extract(shortcode_atts( array(
			'source'=>'youtube',
	        'url'=>'',
			'animate'=>0,
	        'animation_type'=>'fadeIn',
	    ),$atts ) );
		$output ='';
	    switch ( $source ) {
	    	case 'youtube':
	    		$output .= ( isset( $animate ) && 1 == $animate ) ? '<div class="be-animate" data-animation="'.$animation_type.'">' : '' ;
				$output .= be_youtube( $url );
				$output .= ( isset( $animate ) && 1 == $animate ) ? '</div>' : '' ;
				
				return $output;
	    		break;
	    	default:
	    		$output .= ( isset( $animate ) && 1 == $animate ) ? '<div class="be-animate" data-animation="'.$animation_type.'">' : '' ; 
				$output .= be_vimeo( $url );
				$output .= ( isset( $animate ) && 1 == $animate ) ? '</div>' : '' ;
				
				return $output;
	    		break;
	    }
	}
	add_shortcode( 'video', 'be_video' );
}
if (!function_exists('be_youtube')) {
	function be_youtube( $url ) {
		$video_id = '';
		if( ! empty( $url ) ) {
			$video_id = ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match ) ) ? $match[1] : '' ;
			
			return '<iframe class="youtube" src="http://www.youtube.com/embed/'.$video_id.'?wmode=transparent" style="border: none;" allowfullscreen></iframe>';		
		} else {
			return '';
		}

	}
}

/**************************************
			VIDEO - VIMEO
**************************************/
if (!function_exists('be_vimeo')) {
	function be_vimeo( $url ) {
		$video_id = '';
		if( ! empty( $url ) ) {
			sscanf(parse_url($url, PHP_URL_PATH), '/%d', $video_id);
			return '<iframe src="http://player.vimeo.com/video/'.$video_id.'" width="500" height="281" style="border: none;" allowfullscreen></iframe>';
		} else {
			return '';
		}
	}
}

/**************************************
			ROTATES
**************************************/
if ( ! function_exists( 'be_rotates' ) ) {
	function be_rotates( $atts, $content ) {
		extract( shortcode_atts( array (
			'animation' => 'fade',
			'speed' => 1000,
	    ),$atts ) );
	    $animation = (empty($animation)) ? 'fade' : $animation ; 
		$speed = (empty($speed)) ? 1000 : $speed ;  
		
		return '<span class="rotates" data-animation="'.$animation.'" data-speed="'.$speed.'" >'.do_shortcode( $content ).'</span>';
	}
	add_shortcode( 'rotates', 'be_rotates' );
}
if ( ! function_exists( 'be_rotate' ) ) {
	function be_rotate( $atts, $content ) {
		extract( shortcode_atts( array (
			'rotate_text' => '',
	    ),$atts ) );
		return ' '.$content.'||';
	}
	add_shortcode( 'rotate', 'be_rotate' );
}

/**************************************
			CUSTOM SLIDER
**************************************/
if (!function_exists('be_custom_slider')) {
	function be_custom_slider( $atts, $content ) {
		extract( shortcode_atts( array (
				'animation_type' => 'fxSoftScale',
				'slider_height' => '',
	    	), $atts ) );
		$slider_height = ( !empty( $slider_height ) ) ? 'style="height: '.$slider_height.'px;"' : '' ;
	    $output = "";
	    $output .= '<div class="component component-fullwidth '.$animation_type.'" data-current="0" '.$slider_height.'>';
	    $output .= '<ul class="itemwrap">';
		$output .= do_shortcode( $content );
	    $output .= '</ul>';
	    $output .= '<nav>';
		$output .= '<a class="prev" href="#"><i class="font-icon icon-left-open"></i></a>';
		$output .= '<a class="next" href="#"><i class="font-icon icon-right-open"></i></a>';
		$output .= '</nav>';
	    $output .= '</div>';
	    return $output;
	}
	add_shortcode( 'be_slider', 'be_custom_slider' );
}
if (!function_exists('be_custom_slide')) {
	function be_custom_slide( $atts, $content ){
			extract( shortcode_atts( array (
				'image' => '',
				'bg_video'=>0,
		        'bg_video_mp4_src'=>'',
		        'bg_video_mp4_src_ogg'=>'',
		        'bg_video_mp4_src_webm'=>'',
		        'content_width' => '',
		        'content_alignment' => '',
	        	'title' => '',
	        	'h_tag' => 'h3',
	        	'title_color' => '',
	        	'title_animation_type' => 'fadeIn',
	        	'small_image' => '',
	        	'image_animation_type' => 'fadeIn',
	        	'content_animation_type'=>'fadeIn',
	    	), $atts ) );
	    	$animate = ( isset( $animate ) && 1 == $animate ) ? ' be-animate' : 0 ;
	    	$bg_video_slide = ( isset( $bg_video ) && 1 == $bg_video ) ? ' be-slider-video' : '' ;
			$output = '';
	    	$output .= '<li>';
			if ( !empty( $image ) || $bg_video ) {
				$attachment_info = wp_get_attachment_image_src( $image, 'full' );
				$attachment_url = $attachment_info[0];
				$output .=  '<div class="be-slide-bg-holder">
								<div class="be-slide-bg be-bg-cover be-bg-parallax '.$bg_video_slide.'" style="background: url('.$attachment_url.') 50% 0px no-repeat;">';
									if( isset( $bg_video ) && 1 == $bg_video ) {
										$output .= '<video class="be-bg-video" autoplay="autoplay" loop="loop" muted="muted" preload="auto">';
										$output .=  ($bg_video_mp4_src) ? '<source src="'.$bg_video_mp4_src.'" type="video/mp4">' : '' ;
										$output .=  ($bg_video_mp4_src_ogg) ? '<source src="'.$bg_video_mp4_src_ogg.'" type="video/ogg">' : '' ;
										$output .=  ($bg_video_mp4_src_webm) ? '<source src="'.$bg_video_mp4_src_webm.'" type="video/webm">' : '' ;
										$output .= '</video>';
									}
								$attachment_info = wp_get_attachment_image_src( $small_image, 'full' );
								$attachment_url = $attachment_info[0];
								$output .=  '</div>
								<div class="be-wrap">
									<div class="be-slider-content-wrap">
										<div class="be-slider-content clearfix">
											<div class="be-slider-content-inner-wrap '.$content_alignment.'" style="width: '.$content_width.'%;">';
											if( $small_image ) {
												$output .=  '<div class="be-animate '.$image_animation_type.' animated be-slider-content-inner"><img src="'.$attachment_url.'" /></div>';
											}
											if( $title ) {
												$output .=  '<div class="be-animate '.$title_animation_type.' animated be-slider-content-inner"><'.$h_tag.' style="color: '.$title_color.';">'.do_shortcode( $title ).'</'.$h_tag.'></div>';
											}
											if( $content ) {
												$output .=  '<div class="be-animate '.$content_animation_type.' animated be-slider-content-inner">'.do_shortcode( $content ).'</div>';
											}
											$output .=  '</div>
										</div>
									</div>
								</div>
							</div>';
			}
	        $output .='</li>';
	        return $output;
	}
	add_shortcode( 'be_slide', 'be_custom_slide' );
}
/**************************************
		Contact Form
**************************************/
if ( ! function_exists( 'be_contact_form' ) ) {
	function be_contact_form($atts,$content) {
		extract( shortcode_atts( array (
			'input_bg_color' => '',
			'input_color' => '',
		    'input_border_color' => ''
	    ), $atts ) );
		$output = '';
		$styles = 'style="';
		if( isset( $input_bg_color ) && !empty( $input_bg_color) ) {
			$styles .= 'background-color: '.$input_bg_color.';';
		}
		if( isset( $input_color ) && !empty( $input_color) ) {
			$styles .= 'color: '.$input_color.';';
		}
		if( isset( $input_border_color ) && !empty( $input_border_color) ) {
			$styles .= 'border-color: '.$input_border_color.';';
		}
		$styles .= '"';
		$output .= '<div class="contact_form contact_form_module">
						<form method="post" class="contact">
							<fieldset class="contact_fieldset">
								<input type="text" name="contact_name" class="txt autoclear" placeholder="'.__('Name','be-themes').'" '.$styles.' />
							</fieldset>
							<fieldset class="contact_fieldset">
								<input type="text" name="contact_email" class="txt autoclear" placeholder="'.__('Email','be-themes').'" '.$styles.' />
							</fieldset>
							<fieldset class="contact_fieldset">
								<input type="text" name="contact_subject" class="txt autoclear" placeholder="'.__('Subject','be-themes').'" '.$styles.' />
							</fieldset>
							<fieldset class="contact_fieldset">
								<textarea name="contact_comment" class="txt_area autoclear" placeholder="'.__('Message','be-themes').'" '.$styles.' ></textarea>
							</fieldset>
							<fieldset class="contact_fieldset submit-fieldset">
								<input type="submit" name="contact_submit" value="'.__('Submit','be-themes').'" class="contact_submit"/>
								<div class="contact_loader"></div>
							</fieldset>
							<div class="contact_status be-notification"></div>
						</form>
					</div>';
		return $output; 
	}
	add_shortcode('contact_form','be_contact_form');
}
?>