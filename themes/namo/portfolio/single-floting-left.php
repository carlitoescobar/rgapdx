<?php
	global $be_themes_data;
	$be_pb_class = 'be-wrap page-builder';
	$be_pb_disabled = get_post_meta( $post->ID, '_be_pb_disable', true );
	if( true === $be_pb_disabled || 'yes' == $be_pb_disabled || !isset( $be_themes_data['enable_pb'] ) || 0 == $be_themes_data['enable_pb'] ) {
		$be_pb_class = 'be-wrap no-page-builder';
		get_template_part( 'page-breadcrumb' );
	}
?>
<section id="content" class="left-sidebar-page">
	<div id="content-wrap" class="<?php echo $be_pb_class; ?> clearfix">
		<section id="page-content" class="content-single-sidebar">
			<div class="clearfix">				
				<?php the_content(); ?>
			</div> <!--  End Page Content -->
		</section>
		<section id="left-sidebar" class="clearfix floting-sidebar">
			<?php get_template_part( 'portfolio/gallery', 'sidebar' ); ?>
		</section>
	</div>
	<?php //get_template_part( 'portfolio/single', 'navigation' ); ?>
</section>