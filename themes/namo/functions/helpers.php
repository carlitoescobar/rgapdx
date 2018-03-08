<?php

/* ---------------------------------------------  */
// Function to print pagination 
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_pagination' ) ) :
	function be_themes_pagination( $pages = '', $range = 3 ) {  
		$showitems = ( $range * 2 ) + 1;  
		global $paged;
		if( empty( $paged ) ) { 
			$paged = 1;
		}
		if( $pages == '' ) {
		    global $wp_query;
		    $pages = $wp_query->max_num_pages;
		    if( !$pages ) {
		        $pages = 1;
		    }
		}   
		if( 1 != $pages ) {
		    echo '<div class="pagination secondary_text"><span class="sec-bg sec-color">Page '.$paged.' of '.$pages.'</span>';
		    if( $paged > 2 && $paged > $range+1 && $showitems < $pages ) {
		    	echo "<a href='".get_pagenum_link(1)."' class='sec-bg sec-color'>&laquo; ".__('First','be-themes')."</a>";
		    }
		    if( $paged > 1 && $showitems < $pages ) { 
		    	echo "<a href='".get_pagenum_link($paged - 1)."' class='sec-bg sec-color'>&lsaquo; ".__('Prev','be-themes')."</a>";
		    }

		    for ( $i=1; $i <= $pages; $i++ ) {
		        if ( 1 != $pages && ( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ) ) {
		            echo ( $paged == $i) ? "<span class='current alt-bg alt-bg-text-color'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive sec-bg sec-color' >".$i."</a>";
		        }
		    }

		    if ( $paged < $pages && $showitems < $pages ) {
		    	echo "<a href='".get_pagenum_link($paged + 1)."' class='sec-bg sec-color'>".__('Next','be-themes')." &rsaquo;</a>";  
		    }
		    if ( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages ) { 
		    	echo "<a href='".get_pagenum_link($pages)."' class='sec-bg sec-color'>".__('Last','be-themes')." &raquo;</a>";
		    }
		    echo "</div>\n";
		}
	}
endif;
/* ---------------------------------------------  */
// Function to customize archives widget
/* ---------------------------------------------  */
if ( ! function_exists( 'be_archives' ) ) :
	function be_archives( $args ) {
		$args['format'] = "custom";
		$args['before'] = "<li class='swap_widget_archive'>";
		$args['after'] = "</li>";
		return $args;
	}
	add_filter( 'widget_archives_args', 'be_archives' );
endif;
/* ---------------------------------------------  */
// Function to trim content to the required characters
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_trim_content' ) ) :
	function be_themes_trim_content( $content, $count ) {
		if(strlen( $content ) > $count ) {
			return substr( $content, 0, $count ).'. . .';
		} else {
			return substr( $content, 0, $count );
		}
	}
endif;
/* ---------------------------------------------  */
// Function to return pagination markup  */
/* ---------------------------------------------  */
if ( ! function_exists( 'get_be_themes_pagination' ) ) :
	function get_be_themes_pagination( $pages = '', $range = 3 ) {  
	    $showitems = ( $range * 2 ) + 1;  

	    global $paged;
	    if( empty( $paged ) ) $paged = 1;

	    if( $pages == '' ) {
	        global $wp_query;
	        $pages = $wp_query->max_num_pages;
	        if( !$pages ) {
	            $pages = 1;
			}
	    }      

	    if( 1 != $pages ){
	        $returnvalue='<div class="pagination secondary_text">';//Page '.$paged.' of '.$pages;
	        if( $paged > 2 && $paged > $range+1 && $showitems < $pages ) { 
	        	$returnvalue.="<a href='".get_pagenum_link(1)."' class='sec-bg sec-color'>&laquo; ".__('First','be-themes')."</a>";
	        }
	        if( $paged > 1 && $showitems < $pages ) { 
	        	$returnvalue.="<a href='".get_pagenum_link($paged - 1)."' class='sec-bg sec-color'>&lsaquo; ".__('Prev','be-themes')."</a>";
	        }
	        for ( $i=1; $i <= $pages; $i++ ) {
	            if (  1 != $pages && ( !( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) ) {
	                $returnvalue.= ( $paged == $i ) ? "<span class='current alt-bg alt-bg-text-color'>".$i."</span>":"<a href='".get_pagenum_link( $i )."' class='inactive sec-bg sec-color' >".$i."</a>";
	            }
	        }
	        if ( $paged < $pages && $showitems < $pages ) { 
	        	$returnvalue.= "<a href='".get_pagenum_link( $paged + 1 )."' class='sec-bg sec-color'>".__( 'Next', 'be-themes' )." &rsaquo;</a>";
	        }  
	        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) { 
	        	$returnvalue.= "<a href='".get_pagenum_link($pages)."' class='sec-bg sec-color'>".__( 'Last', 'be-themes' )." &raquo;</a>";
	        }
	        $returnvalue.= "</div>\n";
			return $returnvalue;
	    }
	}
endif;
/* ---------------------------------------------  */
// Function to find youtube and Vimeo videos
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_video_type' ) ) :
	function be_themes_video_type( $url ) {
		if (strpos( $url, 'youtube' ) > 0) {
			return 'youtube';
		} 
		elseif ( strpos( $url, 'vimeo' ) > 0) {
			return 'vimeo';
		} 
		else {
			return '';
		}
	}
endif;
/* ---------------------------------------------  */
// Function to print categories
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_category_list' ) ) :
	function be_themes_category_list( $id ) {
		$numItems = count( get_the_category( $id ) );
		$i = 0;
		foreach( ( get_the_category( $id ) ) as $category ) {
			if( ++$i === $numItems ) {
				echo '<a href="'.get_category_link( $category->cat_ID ).'" title="'.__('View all posts in','be-themes').' '.$category->cat_name.'"> '.$category->cat_name.'</a>' ;
			} else {
				echo '<a href="'.get_category_link( $category->cat_ID ).'" title="'.__('View all posts in','be-themes').' '.$category->cat_name.'"> '.$category->cat_name.'</a> , ' ;
			}
		}
	}
endif;
/* ---------------------------------------------  */
// Function to print categories
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_get_category_list' ) ) :
	function be_themes_get_category_list( $id ) {
		$numItems = count( get_the_category( $id ) );
		$i = 0;
		foreach( ( get_the_category( $id ) ) as $category ) {
			if( ++$i === $numItems ) {
				return '<a href="'.get_category_link( $category->cat_ID ).'" title="'.__('View all posts in','be-themes').' '.$category->cat_name.'"> '.$category->cat_name.'</a>' ;
			} else {
				return '<a href="'.get_category_link( $category->cat_ID ).'" title="'.__('View all posts in','be-themes').' '.$category->cat_name.'"> '.$category->cat_name.'</a>' ;
			}
		}
	}
endif;
/* ---------------------------------------------  */
//  Function to retrieve categories
/* ---------------------------------------------  */
if ( ! function_exists( 'get_be_themes_category_list' ) ) :
	function get_be_themes_category_list( $id ) {
		$terms = wp_get_object_terms( $id, 'portfolio_categories' );
		$category = "";
		$taxonomies = get_the_term_list( $id, 'portfolio_categories', '', ' / ', '' );
		$taxonomies = strip_tags( $taxonomies );
		$term_count = count( $terms );
		$i = 0;
		foreach ( $terms as $term ) {
			if( ++$i === $term_count )
				$category .= $term->slug;
			else 
				$category .= $term->slug." | ";
		}
		return $category;
	}
endif;
/* ---------------------------------------------  */
// Function to retrieve post slug
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_get_the_slug' ) ) :
	function be_themes_get_the_slug( $post_id ) {
	    $post_data = get_post( $post_id, ARRAY_A );
	    $slug = $post_data['post_name'];
	    return $slug; 
	}
endif;
/* ---------------------------------------------  */
// Function to retrieve post ID from slug
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_get_id_by_slug' ) ) :
	function be_themes_get_id_by_slug( $post_slug ) {
		$args=array(
			'post_type' => 'portfolio',
			'name' => $post_slug,
			'post_status' => 'publish',
			'showposts' => 1,
			'ignore_sticky_posts'=> 1,
		);
		$my_posts = get_posts( $args );
		if( $my_posts )
			return $my_posts[0]->ID;
		else
			return null;
	}
endif;
/* ---------------------------------------------  */
// Functions for like, tweet and plusone buttons 
/* ---------------------------------------------  */
if (!function_exists('be_themes_get_facebook_button')) {
	function be_themes_get_facebook_button( $url ){
		$out = "<iframe src='//www.facebook.com/plugins/like.php?href=".urlencode($url)."&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=35&amp;appId=173868296037629' scrolling='no' frameborder='0' style='border:none; overflow:hidden; width:100px; height:20px;' allowTransparency='true'></iframe>";
		return $out;
	}
}
if (!function_exists('be_themes_get_twitter_button')) {
	function be_themes_get_twitter_button( $url ){
		$out = '<iframe allowtransparency="true" data-count="true" frameborder="0" scrolling="no" src="http://platform.twitter.com/widgets/tweet_button.html?url='.$url.'&via=xtapit&text=test" style="width:90px; height:20px;"></iframe>';
		return $out;
	}
}
if (!function_exists('be_themes_get_googleplus_button')) {
	function be_themes_get_googleplus_button( $url ){
		$out = "<iframe src='https://plusone.google.com/_/+1/fastbutton?url='".$url."'&amp;size=medium&amp;count=true&amp;lang='en' scrolling='no' frameborder='0' style='border:none; overflow:hidden; width:65px; height:24px;'></iframe>";
		return $out;
	}
}
/* ---------------------------------------------  */
// Display Next and Previous posts links in blog
/* ---------------------------------------------  */
if ( ! function_exists( 'be_content_nav' ) ) :
	function be_themes_content_nav( $nav_id ) {
		global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) : ?>
			<nav id="<?php echo $nav_id; ?>" class="blog-nav clearfix">
			<div class="nav-previous left"><?php next_posts_link( __( 'Older posts', 'be-themes' ) ); ?></div>
			<div class="nav-next right"><?php previous_posts_link( __( 'Newer posts', 'be-themes' ) ); ?></div>
			</nav><!-- #nav-above -->
		<?php endif;
	}
endif;
/* ---------------------------------------------  */
//
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_custom_excerpt_length' ) ) :
	function be_themes_custom_excerpt_length( $length ) {
		return 70;
	}
	add_filter( 'excerpt_length', 'be_themes_custom_excerpt_length', 999 );
endif;
/* ---------------------------------------------  */
// HTML5 Search & Comment Forms
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_html5_search_form' ) ) :
	function be_themes_html5_search_form( $form ) {
	    $form = '<form role="search" method="get" class="searchform" action="' . home_url( '/' ) . '" >
	    <input type="text" placeholder="'.__( "Search ..." ).'" value="' . get_search_query() . '" name="s" class="s" />
	    <i class="search-icon icon-search font-icon"></i>
	    <input type="submit" class="search-submit" value="" />
	    </form>';

	    return $form;
	}
	add_filter( 'get_search_form', 'be_themes_html5_search_form' );
endif;
//HTML5 comment form
if ( ! function_exists( 'be_themes_comments_form' ) ) :
	function be_themes_comments_form() {
		$req = get_option( 'require_name_email' );
		$fields =  array (
			'author' => '<p class="no-margin"><input id="author" name="author" type="text" value="" aria-required="true" placeholder = "'.__('Name', 'be-themes').'"' . ( $req ? ' required' : '' ) . '/></p>',
			'email'  => '<p class="no-margin"><input id="email" name="email" type="text" value="" aria-required="true" placeholder="'.__('Email', 'be-themes').'"' . ( $req ? ' required' : '' ) . ' /></p>',
			'url'    => '<p class="no-margin"><input id="url" name="url" type="text" value="" placeholder="'.__('Website', 'be-themes').'" /></p>',
		);
		return $fields;
	}
	add_filter( 'comment_form_default_fields', 'be_themes_comments_form' );
endif;
/* ---------------------------------------------  */
// Function to handle blog comments
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_comments' ) ) :
	function be_themes_comments( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li class="post pingback clearfix">
			<p><?php echo ucfirst( $comment->comment_type ).":  "; comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'be-themes' ) , '<span class="edit-link">', '</span>' ); ?></p>
		<?php
				break;
			default :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment sec-border-bottom clearfix">
				<div class="comment-author vcard">
						<div class="comment-author-inner">
						<?php
							$avatar_size = 68;
							if ( '0' != $comment->comment_parent ) {
								$avatar_size = 60;
							}
							echo get_avatar( $comment, $avatar_size ); ?>
							<span class="reply"> <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __('Reply','be-themes'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
						</div>
				</div><!-- .comment-author .vcard -->
				
				<div class="comment-content">
				
					<footer class="comment-meta">
					<?php

							printf( __('%1$s','be-themes'),
								sprintf( '<h6 class="fn">%s Says</h6>', get_comment_author_link() )
							);
							printf( __('%1$s','be-themes'),
								sprintf( '<time datetime="%2$s">%3$s</time>',
									esc_url( get_comment_link( $comment->comment_ID ) ),
									get_comment_time( 'c' ),
									/* translators: 1: date, 2: time */
									sprintf( '%1$s', get_comment_date('d F Y') )
								)
							);
					

						?>

						
					

					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.','be-themes' ); ?></em>
						<br />
					<?php endif; ?>

					</footer>
					<div class="comment_text">
						<?php comment_text(); ?>
					</div>
					<ul class="comment-edit-reply clearfix">
						<?php edit_comment_link( __( 'Edit', 'be-themes' ), '<li class="edit-link">', '</li>' ); ?>
					</ul>
				</div>


			</article><!-- #comment-## -->

		<?php
				break;
		endswitch;
	}
endif;
/* ---------------------------------------------  */
// Filter to handle empty search query
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_request_filter' ) ) :
	function be_themes_request_filter( $query_vars ) {
	    if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
	        $query_vars['s'] = " ";
	    }
	    return $query_vars;
	}
	add_filter( 'request', 'be_themes_request_filter' );
endif;
/* ---------------------------------------------  */
// Filter to remove empty widget title <h> tags
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_empty_widget_title' ) ) :
	function be_themes_empty_widget_title($title) {
	    return $title == '&nbsp;' ? '' : $title;
	}
	add_filter( 'widget_title', 'be_themes_empty_widget_title' ); 
endif;
/* ---------------------------------------------  */
// Filter to execute shortcodes in widgets
/* ---------------------------------------------  */
add_filter( 'widget_text', 'do_shortcode' );
/* ---------------------------------------------  */
// Filter to add custom Tiny MCE buttons
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_tinyplugin_add_button' ) ) :
	function be_themes_tinyplugin_add_button( $buttons ) {
	    array_push( $buttons, '|', 'tinyplugin', 'linebreak', 'letter-spacing', 'text-shadow' );
		return $buttons;
	}
	add_filter( 'mce_buttons', 'be_themes_tinyplugin_add_button', 0 );
endif;
if ( ! function_exists( 'be_themes_tinyplugin_register' ) ) :
	function be_themes_tinyplugin_register( $plugin_array ) {
	    $url = trim( get_template_directory_uri(), "/" )."/tinymce/editor_plugin_src.js";
	    $plugin_array['tinyplugin'] = $url;
		$plugin_array['letter-spacing'] = $url;
		$plugin_array['text-shadow'] = $url;
	    return $plugin_array;
	}
	add_filter( 'mce_external_plugins', 'be_themes_tinyplugin_register' );
endif;
if ( ! function_exists( 'be_themes_mce_buttons_2' ) ) :
	function be_themes_mce_buttons_2( $buttons ) {
		array_unshift( $buttons, 'fontsizeselect', 'styleselect' );
		return $buttons;
	}
	add_filter( 'mce_buttons_2', 'be_themes_mce_buttons_2' );
endif;
if ( ! function_exists( 'be_mce_before_init' ) ) :
	function be_mce_before_init( $settings ) {
		$style_formats = array (
			array (
				'title' => '1px',
				'inline' => 'span',
				'styles' => array(
					'letter-spacing' => '1px',
				)
			),
			array (
				'title' => '2px',
				'inline' => 'span',
				'styles' => array(
					'letter-spacing' => '2px',
				)
			),
			array (
				'title' => '3px',
				'inline' => 'span',
				'styles' => array(
					'letter-spacing' => '3px',
				)
			),
			array (
				'title' => '4px',
				'inline' => 'span',
				'styles' => array(
					'letter-spacing' => '4px',
				)
			),
			array (
				'title' => '5px',
				'inline' => 'span',
				'styles' => array(
					'letter-spacing' => '5px',
				)
			),
			array (
				'title' => '6px',
				'inline' => 'span',
				'styles' => array(
					'letter-spacing' => '6px',
				)
			),
			array (
				'title' => '7px',
				'inline' => 'span',
				'styles' => array(
					'letter-spacing' => '7px',
				)
			),
			array (
				'title' => '8px',
				'inline' => 'span',
				'styles' => array(
					'letter-spacing' => '8px',
				)
			),
			array (
				'title' => '9px',
				'inline' => 'span',
				'styles' => array(
					'letter-spacing' => '9px',
				)
			),
			array (
				'title' => '10px',
				'inline' => 'span',
				'styles' => array(
					'letter-spacing' => '10px',
				)
			)
		);
		$settings['style_formats'] = json_encode( $style_formats );
		return $settings;
	}
	add_filter( 'tiny_mce_before_init', 'be_mce_before_init' );
endif;
/* ---------------------------------------------  */
// Filter to prevent empty <p> from shortcodes
/* ---------------------------------------------  */
//add_filter( 'the_content', 'do_shortcode', 7 );
add_filter( "the_content", "be_shortcode_filter");
/* ---------------------------------------------  */
// Filter to remove empty p tags
/* ---------------------------------------------  */
function be_shortcode_filter($content) {
 
	// array of custom shortcodes requiring the fix 
	$block = join("|",array("text","shortcode_modules","section","row","one_col","one_third","one_third_last","one_fourth","one_fourth_last","one_fifth","one_fifth_last","one_half","one_half_last","two_third","two_third_last","three_fourth","three_fourth_last","toggle","accordion","chart","animated_numbers","blog","button","call_to_action","clients","client","separator","dropcap","flex_slide","portfolio_full_screen","portfolio_full_screen_with_gutter","be_gallery","gallery_full_screen","gallery_full_screen_with_gutter","gmaps","lightbox_image","icon","lists","list","notifications","portfolio","portfolio_carousel","project_details","pricing_column","pricing_feature","recent_posts","services","service","skills","skill","linebreak","special_heading","special_heading2","special_heading3","tabs","tab","team","testimonial","title_icon","video","rotates","rotate","be_slider","be_slide","contact_form"));
 
	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
		
	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
 
	return $rep;
 
}
/* ---------------------------------------------  */
// Filter to adjust tag could font size
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_tag_font' ) ) :
	function be_themes_tag_font( $args ) {
	  $args['smallest'] = 10;
	  $args['largest'] = 10;
	  $args['unit'] =  'px';	  
	  return $args;
	}
	add_filter( 'widget_tag_cloud_args' , 'be_themes_tag_font' );
endif;
/* ---------------------------------------------  */
// Filter to generate slug for custom sidebars
/* ---------------------------------------------  */
if ( ! function_exists( 'generateSlug' ) ) :
	function generateSlug( $phrase, $maxLength ) {
		$result = strtolower($phrase);
		$result = preg_replace( "/[^a-z0-9\s-]/", "", $result );
		$result = trim( preg_replace( "/[\s-]+/", " ", $result ) );
		$result = trim( substr( $result, 0, $maxLength ) );
		$result = preg_replace( "/\s/", "-", $result );
		return $result;
	}
endif;
if ( ! function_exists( 'be_themes_get_excerpt' ) ) :
	function be_themes_get_excerpt( $post_id, $length=45 ) {
	    $the_post = get_post( $post_id ); //Gets post ID
	    $the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
	    $excerpt_length = $length; //Sets excerpt length by word count
	    $the_excerpt = strip_tags( strip_shortcodes( $the_excerpt ) ); //Strips tags and images
	    $words = explode( ' ', $the_excerpt, $excerpt_length + 1 );

	    if( count( $words ) > $excerpt_length ) :
	        array_pop( $words );
	        array_push( $words, '...' );
	        $the_excerpt = implode( ' ', $words );
	    endif;

	    return $the_excerpt;
	}
endif;
/* ---------------------------------------------  */
// Add Video URL field to media uploader
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_attachment_field_add' ) ) :
	function be_themes_attachment_field_add( $form_fields, $post ) {
		$form_fields['be-themes-featured-video-url'] = array(
			'label' => 'Youtube/Vimeo URL',
			'input' => 'text',
			'value' => get_post_meta( $post->ID, 'be_themes_featured_video_url', true ),
			'helps' => 'Enter a Youtube/Vimeo URL to be linked to the featured image',
		);

		return $form_fields;
	}
	add_filter( 'attachment_fields_to_edit', 'be_themes_attachment_field_add', 10, 2 );
endif;
if ( ! function_exists( 'be_themes_attachment_field_save' ) ) :
	function be_themes_attachment_field_save( $post, $attachment ) {
		if( isset( $attachment['be-themes-featured-video-url'] ) ) {
			update_post_meta( $post['ID'], 'be_themes_featured_video_url', $attachment['be-themes-featured-video-url'] );
		}

		return $post;
	}
	add_filter( 'attachment_fields_to_save', 'be_themes_attachment_field_save', 10, 2 );
endif;
/* ---------------------------------------------  */
// Breadcrumbs
/* ---------------------------------------------  */
if ( ! function_exists( 'be_themes_breadcrumb' ) ) :
	function be_themes_breadcrumb() {
		global $post;
	    $sep = '  /  ';
	    if ( ! is_front_page() ) {
	        echo '<div class="breadcrumbs">';
	        echo '<a href="';
	        echo home_url();
	        echo '">';
	        echo __( 'Home', 'be-themes' );
	        echo '</a>' . $sep;
	        if ( ( is_category() || is_single() ) && ! is_singular( 'portfolio' ) ) {
	            the_category( ' / ' );
	        } elseif ( ( is_archive() || is_single() ) && is_singular( 'portfolio' ) ) {
	            if ( is_day() ) {
	                printf( __( '%s', 'be-themes' ), get_the_date() );
	            } elseif ( is_month() ) {
	                printf( __( '%s', 'be-themes' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'be-themes' ) ) );
	            } elseif ( is_year() ) {
	                printf( __( '%s', 'be-themes' ), get_the_date( _x( 'Y', 'yearly archives date format', 'be-themes' ) ) );
	            } else {
	                _e( 'Portfolio Archives', 'be-themes' );
	            }
	        } elseif ( ( is_archive() || is_single() ) && !is_singular( 'portfolio' ) ) {
	            if ( is_day() ) {
	                printf( __( '%s', 'be-themes' ), get_the_date() );
	            } elseif ( is_month() ) {
	                printf( __( '%s', 'be-themes' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'be-themes' ) ) );
	            } elseif ( is_year() ) {
	                printf( __( '%s', 'be-themes' ), get_the_date( _x( 'Y', 'yearly archives date format', 'be-themes' ) ) );
	            } else {
	                _e( 'Blog Archives', 'be-themes' );
	            }
	        }

	        if( is_singular('portfolio') ) {
	            echo get_the_term_list( $post->ID, 'portfolio_categories','','  /  ' ); 
	        }

	        if ( is_single() ) {
	            echo $sep;
	            the_title();
	        }

	        if ( is_page() ) {
	        	$parents = get_ancestors( get_the_ID(),'page' );
	        	$parents_rev = array_reverse($parents);
	        	if( !empty( $parents_rev ) ){
	        		foreach ( $parents_rev as $parent ) {
	        			echo '<a href="'.get_permalink($parent).'">'.get_the_title( $parent ).'</a> / ';
	        		}
	        	}
	            echo the_title();
	        }

	        if ( is_home() ){
	            global $post;
	            $page_for_posts_id = get_option( 'page_for_posts' );
	            if ( $page_for_posts_id ) { 
	                $post = get_page( $page_for_posts_id );
	                setup_postdata( $post );
	                the_title();
	                rewind_posts();
	            }
	        }

	        echo '</div>';
	    }
	}
endif;
if ( ! function_exists( 'get_be_themes_breadcrumb' ) ) :
	function get_be_themes_breadcrumb() {
		global $post;
	    $sep = '  /  ';
		$output = '';
	    if ( ! is_front_page() ) {
	        $output .= '<div class="breadcrumbs">';
	        $output .= '<a href="';
	        $output .= home_url();
	        $output .= '">';
	        $output .= __( 'Home', 'be-themes' );
	        $output .= '</a>' . $sep;
	        if ( ( is_category() ) && ! is_singular( 'portfolio' ) ){
	            $output .= be_themes_get_category_list( get_the_ID() );
				$output .= $sep;
	        } else if( is_singular( 'post' ) ) {
				$blog_page_id = get_option( 'page_for_posts');
				if($blog_page_id) {
					$output .= '<a href="'.get_permalink($blog_page_id).'">'.__( 'Blog', 'be-themes' ).'</a>';
					$output .= $sep;
				}
			} else if( is_singular( 'product' ) ) {
				$shop_page_id = woocommerce_get_page_id( 'shop' );
				if($shop_page_id) {
					$output .= '<a href="'.get_permalink($shop_page_id).'">'.__( 'Shop', 'be-themes' ).'</a>';
					$output .= $sep;
				}
			}  elseif ( ( is_archive() || is_single() ) && (is_tax( 'portfolio_categories' ) || is_tax( 'portfolio_tags' ))) {
				global $wp_query;
				$term =	$wp_query->queried_object;
	            if ( is_day() ) {
	                $output .= __( get_the_date(), 'be-themes' );
	            } elseif ( is_month() ) {
	                $output .= __( get_the_date( _x( 'F Y', 'monthly archives date format', 'be-themes' ) ) );
	            } elseif ( is_year() ) {
	                $output .= __( get_the_date( _x( 'Y', 'yearly archives date format', 'be-themes' ) ) );
	            } elseif(is_tax( 'portfolio_categories' )) {
					$output .= __('Portfolio Category / ','be-themes').'<a href="'.get_term_link($term->term_id, 'portfolio_categories').'" >'.$term->name.'</a>';
	            } elseif(is_tax( 'portfolio_tags' )) {
					$output .= __('Portfolio Tag / ','be-themes').'<a href="'.get_term_link($term->term_id, 'portfolio_tags').'" >'.$term->name.'</a>';
				} else {
					$output .= __('Portfolio Archives','be-themes');
				}
	        } elseif ( ( is_archive() || is_single() ) && ! is_singular( 'portfolio' ) ) {
	            if ( is_day() ) {
	                $output .= __( get_the_date(), 'be-themes' );
	            } elseif ( is_month() ) {
	                $output .= __( get_the_date( _x( 'F Y', 'monthly archives date format', 'be-themes' ) ) );
	            } elseif ( is_year() ) {
	                $output .= __( get_the_date( _x( 'Y', 'yearly archives date format', 'be-themes' ) ) );
	            } else {
	                $output .= __( 'Blog Archives', 'be-themes' );
	            }
	        }
	        if( is_singular('portfolio') ) {
	            $output .= get_the_term_list( $post->ID, 'portfolio_categories','','  /  ' ); 
				$output .= $sep;
	        }
	        if ( is_single() ) {
	            $output .= __( 'Here', 'be-themes' );
	        }
	        if ( is_page() ) {
	        	$parents = get_ancestors( get_the_ID(),'page' );
	        	$parents_rev = array_reverse($parents);
	        	if( !empty( $parents_rev ) ){
	        		foreach ( $parents_rev as $parent ) {
	        			$output .= '<a href="'.get_permalink($parent).'">'.get_the_title( $parent ).'</a> / ';
	        		}
	        	}
	            $output .= get_the_title();
	        }
	        if ( is_home() ) {
	            global $post;
	            $page_for_posts_id = get_option( 'page_for_posts' );
	            if ( $page_for_posts_id ) { 
	                $post = get_page( $page_for_posts_id );
	                setup_postdata( $post );
	                get_the_title();
	                rewind_posts();
	            }
	        }
	        $output .= '</div>';
	    }
		return $output;
	}
endif;

/* ---------------------------------------------  */
// Function to get image id from src url
/* ---------------------------------------------  */
if ( ! function_exists( 'get_attachment_id_from_src' ) ) :
	function get_attachment_id_from_src( $image_src ) {
	     global $wpdb;
	     $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
	     $id = $wpdb->get_var( $query );
	     return $id;
	}
endif;

if (!function_exists('be_themes_toggle_post_formats')) {
	function be_themes_page_menu_args( $args ) {
		if ( ! isset( $args['show_home'] ) ) {
			$args['show_home'] = true;
			$args['menu_class'] = 'menu';
		}
		return $args;
	}
	add_filter( 'wp_page_menu_args', 'be_themes_page_menu_args' );
}
if (!function_exists('get_portfolio_image')) {
	function get_portfolio_image($id, $column) {
		$image = array();
		$width_wide = get_post_meta( get_the_ID(), 'be_themes_width_wide', true );
		$height_wide = get_post_meta( get_the_ID(), 'be_themes_height_wide', true );
		switch($column) {
			case 'three' :
				if($width_wide && $height_wide) {
					$image['size'] = '3col-portfolio-wide-width-height';
				} else if($width_wide) {
					$image['size'] = '3col-portfolio-wide-width';
				} else if($height_wide) {
					$image['size'] = '3col-portfolio-wide-height';
				} else {
					$image['size'] = 'portfolio';
				}
				break;
			case 'four' :
				if($width_wide && $height_wide) {
					$image['size'] = '4col-portfolio-wide-width-height';
				} else if($width_wide) {
					$image['size'] = '4col-portfolio-wide-width';
				} else if($height_wide) {
					$image['size'] = '4col-portfolio-wide-height';
				} else {
					$image['size'] = 'portfolio';
				}
				break;
			case 'five' :
				if($width_wide && $height_wide) {
					$image['size'] = '5col-portfolio-wide-width-height';
				} else if($width_wide) {
					$image['size'] = '5col-portfolio-wide-width';
				} else if($height_wide) {
					$image['size'] = '5col-portfolio-wide-height';
				} else {
					$image['size'] = 'portfolio';
				}
				break;
			default :
				$image['size'] = 'portfolio';
		}
		if($width_wide) {
			$image['class'] = 'wide';
		} else {
			$image['class'] = 'not-wide';
		}
		if($width_wide && $height_wide) {
			$image['alt_class'] = 'wide-width-height';
		} else if($width_wide) {
			$image['alt_class'] = 'wide-width';
		} else if($height_wide) {
			$image['alt_class'] = 'wide-height';
		} else {
			$image['alt_class'] = 'no-wide-width-height';
		}
		return $image;
	}
}
if (!function_exists('get_full_screen_portfolio_image')) {
	function get_full_screen_portfolio_image($id, $column) {
		$image = array();
		$width_wide = get_post_meta( get_the_ID(), 'be_themes_width_wide', true );
		$height_wide = get_post_meta( get_the_ID(), 'be_themes_height_wide', true );
		if($width_wide && $height_wide) {
			$image['size'] = 'fluid-portfolio-wide-width-height';
		} else if($width_wide) {
			$image['size'] = 'fluid-portfolio-wide-width';
		} else if($height_wide) {
			$image['size'] = 'fluid-portfolio-wide-height';
		} else {
			$image['size'] = 'portfolio';
		}
		if($width_wide) {
			$image['class'] = 'wide';
		} else {
			$image['class'] = 'not-wide';
		}
		if($width_wide && $height_wide) {
			$image['alt_class'] = 'wide-width-height';
		} else if($width_wide) {
			$image['alt_class'] = 'wide-width';
		} else if($height_wide) {
			$image['alt_class'] = 'wide-height';
		} else {
			$image['alt_class'] = 'no-wide-width-height';
		}
		return $image;
	}
}
if( ! function_exists('be_gal_video')) :
	function be_gal_video($url) {
		if (strpos($url, 'youtube') > 0) {
			return be_gallery_youtube($url);
		} elseif (strpos($url, 'vimeo') > 0) {
			return be_gallery_vimeo($url);
		} else {
			return be_gallery_youtube($url);
		}
	}
endif;
if (!function_exists('be_gallery_youtube')) {
	function be_gallery_youtube( $url ) {
		$video_id = '';
		if( ! empty( $url ) ) {
			if ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match ) ) {
				$video_id = $match[1];
			}
			return '<iframe class="gallery" src="http://www.youtube.com/embed/'.$video_id.'?wmode=transparent" style="border: none;"></iframe>';		
		} else {
			return '';
		}
	}
}
if (!function_exists('be_gallery_vimeo')) {
	function be_gallery_vimeo( $url ) {
		$video_id = '';
		if( ! empty( $url ) ) {
			sscanf(parse_url($url, PHP_URL_PATH), '/%d', $video_id);
			return '<iframe class="gallery" src="http://player.vimeo.com/video/'.$video_id.'" width="500" height="281" style="border: none;"></iframe>';
		} else {
			return '';
		}
	}
}
if (!function_exists('be_slider_carousel')) {
	function be_slider_carousel( $video=true ) {
		$attachments = get_post_meta(get_the_ID(),'be_themes_single_portfolio_slider_images'); ?>
		<div class="carousel_bar_area clearfix">
			<div class="carousel_bar_wrap">
				<div class="carousel_bar">
					<ul id="carousel" class="elastislide-list">
						<?php
						$count = 0;
						if(!empty($attachments)) {
							foreach ( $attachments as $attachment_id ) {
								$attach_img = wp_get_attachment_image_src($attachment_id, 'carousel-thumb');
								$video_url = get_post_meta($attachment_id, 'be_themes_featured_video_url', true);
								if($video_url && $video) {
									$data_source = '<img width="75" height="50" src="'.get_template_directory_uri().'/img/video-placeholder.jpg" class="attachment-carousel-thumb" alt="hanging_on_reduced">';
								} else {
									$data_source = '<img width="75" height="50" src="'.$attach_img[0].'" class="attachment-carousel-thumb" alt="hanging_on_reduced">';
								}
								echo '<li><a href="#" class="gallery-thumb" data-target="'.$count.'">'.$data_source.'</a></li>';
								$count++;
							}
						}
						?>
					</ul>
				</div>
			</div>
		</div> <?php
	}
}
if (!function_exists( 'be_get_page_id' )) {
	function be_get_page_id() {
		global $post;
		if( !is_object($post) ) {
	        return;
	    }			
		if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && (is_shop() || is_product_category() || is_product_tag()) ) {
			$post_id = get_option('woocommerce_shop_page_id');
		} else if(is_home()) {
			$post_id = get_option( 'page_for_posts' );
		} else if(is_search() || is_tag() || is_archive() || is_category()) {
			$post_id = 0;
		} else {
			$post_id = get_the_ID();
		} 
		return $post_id;
	}
}

if (!function_exists( 'be_get_page_id' )) {
	function be_get_page_id() {
		global $post;
		if( !is_object($post) ) {
	        return;
	    }			
		if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_shop() ) {
			$post_id = get_option('woocommerce_shop_page_id');
		} else if(is_home()) {
			$post_id = get_option( 'page_for_posts' );
		} else if(is_search() || is_tag() || is_archive() || is_category()) {
			$post_id = 0;
		} else {
			$post_id = get_the_ID();
		} 
		return $post_id;
	}
}
	
if (!function_exists( 'be_get_id_by_slug' )) {
	function be_get_id_by_slug( $page_slug ) {
		$page = get_page_by_path($page_slug);
		if ($page) {
			return $page->ID;
		} else {
			return null;
		}
	}
}
if (!function_exists( 'be_get_the_slug' )) {
	function be_get_the_slug( $post_id = null ) {
		if( empty( $post_id ) ) {
			global $post;
			if( empty($post) ) {
				return '';
			}
			$post_id = $post->ID;
		}
		$post_data = get_post($post_id, ARRAY_A);
		$slug = $post_data['post_name'];
		return $slug; 
	}
}
if (!function_exists( 'be_excerpt_more' )) {
	function be_excerpt_more($output) {
	    return $output . '<p><a href="'. get_permalink() . '" class="more-link">'.__( 'Continue Reading', 'be-themes' ).'</a></p>';
	}
	add_filter('the_excerpt', 'be_excerpt_more');
}

if (!function_exists( 'be_themes_exclude_woo_from_ajax' )) {
		function be_themes_exclude_woo_from_ajax() {
			global $woocommerce;
			global $order_id;
				echo '<script>
						var no_ajax_pages = [];
					</script>';
			if($woocommerce) { 	
				$order = new WC_Order($order_id);
				echo '<script>
						no_ajax_pages.push("'.$woocommerce->cart->get_cart_url().'");
						no_ajax_pages.push("'.$woocommerce->cart->get_checkout_url().'");
						no_ajax_pages.push("'.get_permalink( woocommerce_get_page_id( 'shop' ) ).'");';
						if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
							echo 'no_ajax_pages.push("'.$order->get_checkout_payment_url().'");
							no_ajax_pages.push("'.$order->get_checkout_order_received_url().'");';
						} else {
							echo 'no_ajax_pages.push("'.get_permalink( woocommerce_get_page_id( 'pay' ) ).'");';
						}
						
						$args = array (
							'post_type' => 'product',
							'posts_per_page' => -1
						);
						$loop = new WP_Query( $args );
						if ( $loop->have_posts() ) {
							while ( $loop->have_posts() ) : $loop->the_post(); 
								echo 'no_ajax_pages.push("'.get_permalink( get_the_ID() ).'");';
							endwhile; 
						}
				echo '</script>';
			}	
		}
		add_action( 'wp_footer', 'be_themes_exclude_woo_from_ajax' );
	}
?>