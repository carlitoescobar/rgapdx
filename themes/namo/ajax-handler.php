<?php
/*
 * Ajax Request handler
 */

/* ---------------------------------------------  */
// Function for processing contact form submission
/* ---------------------------------------------  */
add_action( 'wp_ajax_nopriv_contact_authentication', 'be_themes_contact_authentication' );
add_action( 'wp_ajax_contact_authentication', 'be_themes_contact_authentication' );
function be_themes_contact_authentication() {
	global $be_themes_data;
	$contact_name = $_POST['contact_name'];
	$contact_email = $_POST['contact_email'];
	$contact_comment = $_POST['contact_comment'];
	$contact_subject = $_POST['contact_subject'];
	if(empty($contact_name) || empty($contact_email) || empty($contact_comment) || empty($contact_subject) ) {
		$result['status']="error";
		$result['data']= __('All fields are required','be-themes');
	}
	else if(!preg_match ('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $contact_email)) {
		$result['status']="error";
		$result['data']=__('Please enter a valid email address','be-themes');
	}
	else if(!empty($contact_name) && !empty($contact_email) && !empty($contact_comment) && !empty($contact_subject) ) {
		if ( !empty( $be_themes_data['mail_id'] ) ) {
			$to = $be_themes_data['mail_id'];
		} else {
			$to = get_option('admin_email');
		}		
		$subject= $contatc_subject;
		$from = $contact_email;
		$headers = "From:" . $from;
		mail($to,$subject,$contact_comment,$headers);
		$result['status']="success";
		$result['data']=__('Your message was sent sucessfully','be-themes');
	}
	header('Content-type: application/json');
	echo json_encode($result);
	die();
}
add_action( 'wp_ajax_nopriv_get_ajax_boxed_portfolio', 'be_themes_get_ajax_boxed_portfolio' );
add_action( 'wp_ajax_get_ajax_boxed_portfolio', 'be_themes_get_ajax_boxed_portfolio' );
function be_themes_get_ajax_boxed_portfolio() {
	extract($_POST);
	$output='';
	$filter_to_use = 'portfolio_'.$filter;
	$offset = ( ( $showposts * $paged ) - $showposts );
	if( $paged == 0 ) {
		$offset=0; 
	} else {
		$offset = ( ( $showposts * $paged ) - $showposts ); 
	}
	$selected_categorey = explode(',', $category);
	if($category) {
		$args = array (
			'post_type' => 'portfolio',
			'status' => 'publish',
			'posts_per_page' => $showposts,
			'offset' => $offset,
			'tax_query' => array (
				array (
					'taxonomy' => 'portfolio_categories',
					'field' => 'slug',
					'terms' => $selected_categorey,
					'operator' => 'IN'
				)
			),
			'orderby'=>'date'
		);
	}
	else {
		$args = array (
			'post_type' => 'portfolio',
			'status' => 'publish',
			'posts_per_page' => $showposts,
			'offset' => $offset,
			'orderby'=>'menu_order',
			'order'=>'ASC',
		);
	}
	$the_query = new WP_Query( $args );
	while ( $the_query->have_posts() ) : $the_query->the_post();
		$filter_classes = '';
		$post_terms = get_the_terms( get_the_ID(), $filter_to_use );
		if( $show_filters == 'yes' && is_array( $post_terms ) ) {
			foreach ( $post_terms as  $term ) {
				$filter_classes .=$term->slug." ";
			}
		} else {
			$filter_classes='';
		}
		$attachment_id = get_post_thumbnail_id(get_the_ID());
		$image_atts = get_portfolio_image(get_the_ID(), $col);
		if($masonry) {
			$image_size = 'portfolio-masonry';
		} else {
			$image_size = $image_atts['size'];
		}
		$attachment_thumb=wp_get_attachment_image_src( $attachment_id, $image_size);
		$attachment_full = wp_get_attachment_image_src( $attachment_id, 'full');
		$attachment_thumb_url = $attachment_thumb[0];
		$attachment_full_url = $attachment_full[0];
	
		$video_url = get_post_meta( $attachment_id, 'be_themes_featured_video_url', true );
		$visit_site_url = get_post_meta( get_the_ID(), 'be_themes_portfolio_external_url', true );
		$link_to = get_post_meta( get_the_ID(), 'be_themes_portfolio_link_to', true );
		$open_with = get_post_meta( get_the_ID(), 'be_themes_portfolio_single_page_style', true );
		$permalink = '';
		if( $link_to == 'external_url' ) {
			$permalink = $visit_site_url;
		} else {
			$permalink = get_permalink();
		}
		$mfp_class='mfp-image';
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
		} else if( isset($open_with) && ($open_with == 'style1' || $open_with == 'style2' || $open_with == 'style3')) {
			$thumb_class = 'custom-slider';
			$attachment_full_url = get_permalink();
		} else {
			$thumb_class = '';
			$attachment_full_url = $permalink;
		}
		$overlay_color = get_post_meta( get_the_ID(), 'be_themes_portfolio_overlay_color', true );
		if($overlay_color) {
			$overlay_color = 'background: '.$overlay_color.';';
		} else {
			$overlay_color = '';
		}
		$overlay_opacity = get_post_meta( get_the_ID(), 'be_themes_portfolio_overlay_opacity', true );
		if($overlay_opacity) {
			$overlay_opacity = 'opacity: '.(intval($overlay_opacity)/100).';filter: alpha(opacity='.(intval($overlay_opacity)/100).');';
		} else {
			$overlay_opacity = '';
		}
		if( isset($open_with) && ($open_with == 'style1' || $open_with == 'style2' || $open_with == 'style3')) {
			$link_to_thumbnail = '#'.be_get_the_slug(get_the_ID());
		} else {
			$link_to_thumbnail = $attachment_full_url;
		}
		$output .='<div class="element be-hoverlay '.$image_atts['class'].' '.$filter_classes.'" id="'.be_get_the_slug(get_the_ID()).'">';
		$output .= '<div class="element-inner">';
		$output .= '<a href="'.$link_to_thumbnail.'" data-href="'.$attachment_full_url.'" class="thumb-wrap '.$thumb_class.' '.$mfp_class.'"><img src="'.$attachment_thumb_url.'" alt />';
		$output .= '<div class="thumb-overlay"><div class="thumb-bg" style="background-color:'.$thumb_overlay_color.';">';
		$output .= '<div class="thumb-title fadeInLeft animated">';
		$output .= get_the_title();
		$output .= '</div>';	
		$output .= '</div></div>';//end thumb overlay & bg
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
	echo $output;
	die();
}

add_action( 'wp_ajax_nopriv_get_ajax_full_screen_portfolio', 'be_themes_get_ajax_full_screen_portfolio' );
add_action( 'wp_ajax_get_ajax_full_screen_portfolio', 'be_themes_get_ajax_full_screen_portfolio' );
function be_themes_get_ajax_full_screen_portfolio() {
	extract($_POST);
	$output='';
	$filter_to_use = 'portfolio_'.$filter;
	$offset = ( ( $showposts * $paged ) - $showposts );
	if( $paged == 0 ) {
		$offset=0; 
	} else {
		$offset = ( ( $showposts * $paged ) - $showposts ); 
	}
	$selected_categorey = explode(',', $category);
	if($category) {
		$args = array (
			'post_type' => 'portfolio',
			'status' => 'publish',
			'posts_per_page' => $showposts,
			'offset' => $offset,
			'tax_query' => array (
				array (
					'taxonomy' => 'portfolio_categories',
					'field' => 'slug',
					'terms' => $selected_categorey,
					'operator' => 'IN'
				)
			),
			'orderby'=>'date'
		);
	}
	else {
		$args = array (
			'post_type' => 'portfolio',
			'status' => 'publish',
			'posts_per_page' => $showposts,
			'offset' => $offset,
			'orderby'=>'menu_order',
			'order'=>'ASC',
		);
	}
	$the_query = new WP_Query( $args );
	while ( $the_query->have_posts() ) : $the_query->the_post();
		$filter_classes = '';
		$post_terms = get_the_terms( get_the_ID(), $filter_to_use );
		if( $show_filters == 'yes' && is_array( $post_terms ) ) {
			foreach ( $post_terms as  $term ) {
				$filter_classes .=$term->slug." ";
			}
		} else {
			$filter_classes='';
		}
		$attachment_id = get_post_thumbnail_id(get_the_ID());
		$image_atts = get_full_screen_portfolio_image(get_the_ID(), $col);
		if($masonry) {
			$image_size = 'portfolio-masonry';
		} else {
			$image_size = $image_atts['size'];
		}
		$attachment_thumb=wp_get_attachment_image_src( $attachment_id, $image_size);
		$attachment_full = wp_get_attachment_image_src( $attachment_id, 'full');
		$attachment_thumb_url = $attachment_thumb[0];
		$attachment_full_url = $attachment_full[0];
				
		$video_url = get_post_meta( $attachment_id, 'be_themes_featured_video_url', true );
		$visit_site_url = get_post_meta( get_the_ID(), 'be_themes_portfolio_external_url', true );
		$link_to = get_post_meta( get_the_ID(), 'be_themes_portfolio_link_to', true );
		$open_with = get_post_meta( get_the_ID(), 'be_themes_portfolio_single_page_style', true );
		$permalink = '';
		if( $link_to == 'external_url' ) {
			$permalink = $visit_site_url;
		} else {
			$permalink = get_permalink();
		}
		$mfp_class='mfp-image';
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
		} else if( isset($open_with) && ($open_with == 'style1' || $open_with == 'style2' || $open_with == 'style3')) {
			$thumb_class = 'custom-slider';
			$attachment_full_url = get_permalink();
		} else {
			$thumb_class = '';
			$attachment_full_url = $permalink;
		}
		$overlay_color = get_post_meta( get_the_ID(), 'be_themes_portfolio_overlay_color', true );
		if($overlay_color) {
			$overlay_color = 'background: '.$overlay_color.';';
		} else {
			$overlay_color = '';
		}
		$overlay_opacity = get_post_meta( get_the_ID(), 'be_themes_portfolio_overlay_opacity', true );
		if($overlay_opacity) {
			$overlay_opacity = 'opacity: '.(intval($overlay_opacity)/100).';filter: alpha(opacity='.(intval($overlay_opacity)/100).');';
		} else {
			$overlay_opacity = '';
		}
		if( isset($open_with) && ($open_with == 'style1' || $open_with == 'style2' || $open_with == 'style3')) {
			$link_to_thumbnail = '#'.be_get_the_slug(get_the_ID());
		} else {
			$link_to_thumbnail = $attachment_full_url;
		}
		$output .='<div class="element be-hoverlay '.$filter_classes.' '.$image_atts['class'].'" id="'.be_get_the_slug(get_the_ID()).'">';
		$output .= '<div class="element-inner">';
		$output .= '<a href="'.$link_to_thumbnail.'" data-href="'.$attachment_full_url.'" class="thumb-wrap '.$thumb_class.' '.$mfp_class.'"><img src="'.$attachment_thumb_url.'" alt />';
		$output .= '<div class="thumb-overlay"><div class="thumb-bg" style="background-color:'.$thumb_overlay_color.';">';
		$output .= '<div class="thumb-title">'.get_the_title().'</div>';
		$output .= '</div></div>';//end thumb overlay & bg
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
	echo $output;
	die();
}

add_action( 'wp_ajax_nopriv_get_ajax_full_screen_gutter_portfolio', 'be_themes_get_ajax_full_screen_gutter_portfolio' );
add_action( 'wp_ajax_get_ajax_full_screen_gutter_portfolio', 'be_themes_get_ajax_full_screen_gutter_portfolio' );
function be_themes_get_ajax_full_screen_gutter_portfolio() {
	extract($_POST);
	$output='';
	$filter_to_use = 'portfolio_'.$filter;
	$offset = ( ( $showposts * $paged ) - $showposts );
	if( $paged == 0 ) {
		$offset=0; 
	} else {
		$offset = ( ( $showposts * $paged ) - $showposts ); 
	}
	$selected_categorey = explode(',', $category);
	if($category) {
		$args = array (
			'post_type' => 'portfolio',
			'status' => 'publish',
			'posts_per_page' => $showposts,
			'offset' => $offset,
			'tax_query' => array (
				array (
					'taxonomy' => 'portfolio_categories',
					'field' => 'slug',
					'terms' => $selected_categorey,
					'operator' => 'IN'
				)
			),
			'orderby'=>'date'
		);
	}
	else {
		$args = array (
			'post_type' => 'portfolio',
			'status' => 'publish',
			'posts_per_page' => $showposts,
			'offset' => $offset,
			'orderby'=>'menu_order',
			'order'=>'ASC',
		);
	}
	$the_query = new WP_Query( $args );
	while ( $the_query->have_posts() ) : $the_query->the_post();
		$filter_classes = '';
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
		if($masonry) {
			$image_size = 'portfolio-masonry';
		} else {
			$image_size = $image_atts['size'];
		}
		$attachment_thumb=wp_get_attachment_image_src( $attachment_id, $image_size);
		$attachment_thumb=wp_get_attachment_image_src( $attachment_id, $image_size);
		$attachment_full = wp_get_attachment_image_src( $attachment_id, 'full');
		$attachment_thumb_url = $attachment_thumb[0];
		$attachment_full_url = $attachment_full[0];
		
		$video_url = get_post_meta( $attachment_id, 'be_themes_featured_video_url', true );
		$visit_site_url = get_post_meta( get_the_ID(), 'be_themes_portfolio_external_url', true );
		$link_to = get_post_meta( get_the_ID(), 'be_themes_portfolio_link_to', true );
		$open_with = get_post_meta( get_the_ID(), 'be_themes_portfolio_single_page_style', true );
		$permalink = '';
		if( $link_to == 'external_url' ) {
			$permalink = $visit_site_url;
		} else {
			$permalink = get_permalink();
		}
		$mfp_class='mfp-image';
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
		} else if( isset($open_with) && ($open_with == 'style1' || $open_with == 'style2' || $open_with == 'style3')) {
			$thumb_class = 'custom-slider';
			$attachment_full_url = get_permalink();
		} else {
			$thumb_class = '';
			$attachment_full_url = $permalink;
		}
		$overlay_color = get_post_meta( get_the_ID(), 'be_themes_portfolio_overlay_color', true );
		if($overlay_color) {
			$overlay_color = 'background: '.$overlay_color.';';
		} else {
			$overlay_color = '';
		}
		$overlay_opacity = get_post_meta( get_the_ID(), 'be_themes_portfolio_overlay_opacity', true );
		if($overlay_opacity) {
			$overlay_opacity = 'opacity: '.(intval($overlay_opacity)/100).';filter: alpha(opacity='.(intval($overlay_opacity)/100).');';
		} else {
			$overlay_opacity = '';
		}
		if( isset($open_with) && ($open_with == 'style1' || $open_with == 'style2' || $open_with == 'style3')) {
			$link_to_thumbnail = '#'.be_get_the_slug(get_the_ID());
		} else {
			$link_to_thumbnail = $attachment_full_url;
		}
		$output .='<div class="element be-hoverlay '.$filter_classes.' '.$image_atts['class'].'" id="'.be_get_the_slug(get_the_ID()).'">';
		$output .= '<div class="element-inner">';
		$output .= '<a href="'.$link_to_thumbnail.'" data-href="'.$attachment_full_url.'" class="thumb-wrap '.$thumb_class.' '.$mfp_class.'"><img src="'.$attachment_thumb_url.'" alt />';
		$output .= '<div class="thumb-overlay"><div class="thumb-bg" style="background-color:'.$thumb_overlay_color.';">';
		$output .= '<div class="thumb-title">'.get_the_title().'</div>';
		$output .= '</div></div>';//end thumb overlay & bg
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
	echo $output;
	die();
}
?>