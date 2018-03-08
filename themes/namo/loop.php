<?php
$page_id = be_get_page_id();
global $blog_style;
$post_classes = get_post_class();
$post_classes = implode( ' ', $post_classes );
if($blog_style == 'style3') {
	$post_classes .= ' element not-wide';
}
?>	
<article id="post-<?php the_ID(); ?>" class="blog-post clearfix <?php echo $post_classes; ?>">
	<div class="post-content-wrap">
		<?php 
			$post_format = get_post_format();
			if( $post_format != 'quote' && $post_format != 'audio' && $post_format !='image' && !is_search() ) {
				get_template_part( 'content', $post_format ); 
			} 
		?>
		<div class="article-details">
			<header class="post-header clearfix">
				<?php
				if( $post_format == 'quote' ) : 
					$quote = get_post_meta(get_the_ID(),'be_themes_quote_title',true);
					$quote_author = get_post_meta(get_the_ID(),'be_themes_quote_author',true);
					echo '<h2 class="alt-color"><i class="font-icon icon-quote"></i></h2>';
					echo '<h5 class="post-title"><a href="'.get_permalink(get_the_ID()).'">'.get_the_title().'</a></h5>';
				elseif( $post_format == 'link' ): 
					$link = get_post_meta(get_the_ID(),'be_themes_link_format',true);
					if( empty( $link ) ) {
						$link = '#';
					}
					?>
					<h2 class="alt-color"><i class="font-icon icon-link"></i></h2>
					<h5 class="post-title">
						<a href="<?php echo $link; ?>" target="_blank"> 
							<?php echo get_the_title(get_the_ID()); ?>
						</a>
					</h5>
				<?php
				elseif( $post_format == 'image' ):
					get_template_part( 'content', $post_format );		
				else: 
					if( $post_format == 'audio' ) {
						get_template_part( 'content', 'audio' ); 
					}
					if( $post_format !='aside' && $post_format !='image'):	
					?>
					<h5 class="post-title">
						<a href="<?php echo get_permalink(get_the_ID()); ?>"> 
							<?php echo get_the_title(get_the_ID()); ?>
						</a>
					</h5>
					<?php 
					endif;
				endif; 
				?>
			</header>
			<?php get_template_part( 'post-details' ); ?>
			<?php if( $post_format != 'quote' && $post_format != 'link' ): ?>
				<div class="post-details">
					<div class="post-content">
						<?php
							if( !is_search() ) {
								the_content( __( 'Continue Reading ->', 'be-themes' ) );
							}
							if( is_single() ): 
								$args = array(
								'before'           => '<div class="pages_list margin-40">',
								'after'            => '</div>',
								'link_before'      => '',
								'link_after'       => '',
								'next_or_number'   => 'next',
								'nextpagelink'     => __('Next >','be-themes'),
								'previouspagelink' => __('< Prev','be-themes'),
								'pagelink'         => '%',
								'echo'             => 1 );
								wp_link_pages( $args );

								echo '<div class="post-tags">';
								the_tags();
								echo '</div>';	
							endif; 
						?>
					</div>
				</div>
			<?php endif; ?>	
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="blog-separator clearfix">
		<hr class="separator" />
	</div>
</article>