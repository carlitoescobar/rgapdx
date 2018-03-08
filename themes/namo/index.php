<?php
get_header();
$page_id = be_get_page_id();
global $blog_style;
global $be_themes_data;
$sidebar = $be_themes_data['blog_sidebar'];
if( empty( $sidebar ) ) {
	$sidebar = 'right';
}
$blog_style = $be_themes_data['blog_style'];
if( empty( $blog_style ) ) {
	$blog_style = 'style1';
}
$blog_column = $be_themes_data['blog_column'];
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
<section id="content" class="<?php echo $sidebar; ?>-sidebar-page">
	<div id="content-wrap" class="be-wrap clearfix"> 
		<section id="page-content" class="<?php echo ($blog_style == 'style3') ? 'content-no-sidebar' : 'content-single-sidebar'; ?>">
			<div class="clearfix <?php echo $blog_style_class; ?>">
				<?php 			
				if( have_posts() ) : 
					while ( have_posts() ) : the_post();
						get_template_part( 'loop' );
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
				<?php get_sidebar(); ?>
			</section> <?php 
		} ?>
	</div>
</section>					
<?php get_footer(); ?>