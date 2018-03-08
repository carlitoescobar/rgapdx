<?php
	global $be_themes_data;
	$post_id = be_get_page_id();
	$show_bottom_widgets = get_post_meta($post_id, 'be_themes_bottom_widgets', true);
	$show_footer_area = get_post_meta($post_id, 'be_themes_footer_area', true);
	if($show_bottom_widgets != 'no') {
		$show_widgets = true;
	} else {
		$show_widgets = false;
	}
	if((is_home() || is_search() || is_tag() || is_archive() || is_category())){
		if(isset( $be_themes_data['show_bottom_widgets'] ) && 'yes' == $be_themes_data['show_bottom_widgets']) {
			$show_widgets = true;
		} else {
			$show_widgets = false;
		}
	}
	$col_class = "one-third";
	$i = 3;
	$active_sidebar = false;
	if($be_themes_data['bottom_widgets_layout'] == 'four-col') {
		$col_class = "one-fourth";
		$i = 4;
	}
	for($j = 1; $j <= $i; $j++) {
		if ( is_active_sidebar( 'footer-widget-'.$j ) ) {
			$active_sidebar = true;
			break;
		}
	}
	if( $show_widgets && $active_sidebar ) { ?>
		<footer id="bottom-widgets">
			<div id="bottom-widgets-wrap" class="be-wrap be-row clearfix">
				<?php for($j = 1; $j <= $i; $j++) : ?>
					<div class="<?php echo $col_class; ?> column-block clearfix">
						<?php 
							if ( is_active_sidebar( 'footer-widget-'.$j ) ) {
								dynamic_sidebar( 'footer-widget-'.$j );
							}
						?>
					</div>
				<?php endfor; ?>	
			</div>
		</footer>
	<?php } ?>
	<?php if('no' != $show_footer_area) { ?>
		<footer id="footer">
			<div id="footer-wrap" class="be-wrap clearfix">
				<div id="copyright">
					<?php echo $be_themes_data['copyright_text']; ?>
				</div>
			</div>
		</footer> <?php
	}
	?>
		<div class="gallery-slider-wrap">
			<div class="gallery-slider-content">
				
			</div>
			<div class="gallery-slider-controls">
				<div class="bubblingG loader">
					<span id="bubblingG_1"></span>
					<span id="bubblingG_2"></span>
					<span id="bubblingG_3"></span>
				</div>
			</div>
		</div>
	</div>
	<div class="bubblingG loader page-loader">
		<span id="bubblingG_1"></span>
		<span id="bubblingG_2"></span>
		<span id="bubblingG_3"></span>
	</div>
	<a href="#" id="back-to-top"><i class="font-icon icon-up-open-big"></i></a>
</div>
<?php if( isset( $be_themes_data['google_analytics_code'] ) && !empty ( $be_themes_data['google_analytics_code'] ) ) {  ?>
<script>
	var _gaq=[['_setAccount','<?php echo $be_themes_data['google_analytics_code'];  ?>'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
<?php } ?>
<!-- Option Panel Custom JavaScript -->
<script>
	jQuery(document).ready(function(){
		<?php echo stripslashes_deep(htmlspecialchars_decode($be_themes_data['custom_js'],ENT_QUOTES));  ?>
	});
</script>
<input type="hidden" id="ajax_url" value="<?php echo admin_url( 'admin-ajax.php' ); ?>" />
<?php wp_footer(); ?>
</body>
</html>