<?php
/**
 * The template for displaying Comments.
 */
?>
	<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php echo __('This post is password protected. Enter the password to view any comments.','be-themes'); ?></p>
	</div><!-- #comments -->
	<?php
			return;
		endif;
	?>
	<?php if ( have_comments() ) : ?>
		<h5 id="comments-title">
			<?php
				printf( _n( 'One Comment', '%1$s Comments', get_comments_number(), 'be-themes' ),
					number_format_i18n( get_comments_number() ) );
			?>
		</h5>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above">
			<h1 class="assistive-text"><?php _e('Comment navigation','be-themes'); ?></h1>
			<div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments','be-themes')); ?></div>
			<div class="nav-next"><?php next_comments_link( __('Newer Comments &rarr;','be-themes')); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php
				wp_list_comments( array( 'callback' => 'be_themes_comments' ) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below">
		<h1 class="assistive-text"><?php _e('Comment navigation','be-themes'); ?></h1>
			<div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments','be-themes')); ?></div>
			<div class="nav-next"><?php next_comments_link( __('Newer Comments &rarr;','be-themes')); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
	<p class="nocomments"><?php _e('Comments are closed.','be-themes'); ?></p>
	<?php endif; ?>
	<?php 
	$defaults = array(
		'label_submit' => __('Submit','be-themes'),
		'comment_field' =>  '<p class="comment-form-comment"><textarea placeholder="'.__('Comment','be-themes').'" id="comment" name="comment" cols="45" rows="15" aria-required="true"></textarea></p>'
	);
	comment_form($defaults); 
	?>
</div><!-- #comments -->