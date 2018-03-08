<?php
/*
 *  The template for displaying a Blog Post.
 * 
 *
*/
get_header(); 
$sidebar = get_post_meta( get_the_ID(), 'be_themes_page_layout', true );
if( empty( $sidebar ) ) {
	$sidebar = 'right';
}
while ( have_posts() ) : the_post(); ?>
	<section id="content" class="<?php echo $sidebar; ?>-sidebar-page">
		<div id="content-wrap" class="be-wrap clearfix">
			<section id="page-content" class="content-single-sidebar">
				<div class="clearfix">
					<?php get_template_part( 'loop' ); ?>
				</div> <!--  End Page Content -->
				<div class="be-themes-comments">
					<?php comments_template( '', true ); ?>
				</div> <!--  End Optional Page Comments -->
			</section>
			<section id="<?php echo $sidebar; ?>-sidebar" class="sidebar-widgets">
				<?php get_sidebar(); ?>
			</section>
		</div>
	</section> <?php 
endwhile;
get_footer(); 
?>