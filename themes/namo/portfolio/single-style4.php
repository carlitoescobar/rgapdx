<?php
	//global $post;
	global $be_themes_data;
	$be_pb_class = 'page-builder';
	$be_pb_disabled = get_post_meta( get_the_ID(), '_be_pb_disable', true );
	//var_dump($be_pb_disabled);
	if( true === $be_pb_disabled || 'yes' == $be_pb_disabled || !isset( $be_themes_data['enable_pb'] ) || 0 == $be_themes_data['enable_pb'] ) {
		$be_pb_class = 'be-wrap no-page-builder';
		get_template_part( 'page-breadcrumb' );
	}
?>
<div class="clearfix single-page-lightbox-content">
	<?php
		the_content();			
	?>
	<span class="single_portfolio_close"><i class="font-icon icon-cancel"></i></span>
</div> <!--  End Page Content -->