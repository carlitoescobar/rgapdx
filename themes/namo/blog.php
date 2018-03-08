<?php
/*
 *
 * Template Name: Blog
 *
*/
?>
<?php
get_header();
$page_id = be_get_page_id();
global $blog_style;
$sidebar = get_post_meta( $page_id, 'be_themes_page_layout', true );
$blog_style = get_post_meta( $page_id, 'be_themes_blog_style', true );
$blog_column = get_post_meta( $page_id, 'be_themes_blog_column', true );
if( empty( $sidebar ) ) {
	$sidebar = 'right';
}
if( empty( $blog_style ) ) {
	$blog_style = 'style1';
}
if( empty( $blog_column ) ) {
	$blog_column = 'three-col';
}
if($blog_style == 'style3') {
	$sidebar = 'no';
	$blog_style_class = $blog_style.'-blog portfolio-container '.$blog_column;
} else {
	$blog_style_class = $blog_style.'-blog';
}
?>
<div class="clearfix">
<?php the_content($page_id); ?>
</div>
<section id="content" class="<?php echo $sidebar; ?>-sidebar-page">
	<div id="content-wrap" class="be-wrap clearfix"> 
		<section id="page-content" class="<?php echo ($blog_style == 'style3') ? 'content-no-sidebar' : 'content-single-sidebar'; ?>">
			<div class="clearfix <?php echo $blog_style_class; ?>">
				<?php
				query_posts('post_type=post&paged='.$paged);
				if( have_posts() ) : 
					while ( have_posts() ) : the_post();
						get_template_part( 'blog', 'loop' ); 
					endwhile;
				else:
					echo '<p class="inner-content">'.__( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'be-themes' ).'</p>';
				endif;
				?>
			</div> 
			<div class="pagination_parent"><?php echo get_be_themes_pagination(); ?> </div> 
		</section> <?php
		if($blog_style != 'style3') { ?>
			<section id="<?php echo $sidebar; ?>-sidebar" class="sidebar-widgets">
				<?php get_sidebar( $sidebar ); ?>
			</section> <?php 
		} ?>
	</div>
</section>					
<?php get_footer(); ?>