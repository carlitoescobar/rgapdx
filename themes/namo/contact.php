<?php
/*
 *
 * Template Name: Contact
 *
*/
?>
<?php get_header(); 

global $be_themes_data; 

while(have_posts()): the_post(); 
	$sidebar = get_post_meta(get_the_ID(),'be_themes_page_layout',true);
	if(empty($sidebar))
		$sidebar = 'right';
?>
			<section id="content" class="<?php echo $sidebar; ?>-sidebar-page">
				<div id="content-wrap" class="be-wrap clearfix">

					<section id="page-content" class="content-single-sidebar">
						<div class="clearfix">
							<?php the_content(); ?>
							<div class="contact_form">
								<form method="post" class="contact">
									<fieldset class="contact_fieldset">
										<input type="text" name="contact_name" class="txt autoclear" placeholder="<?php _e('Name','be-themes'); ?>" />
									</fieldset>
									<fieldset class="contact_fieldset">
										<input type="text" name="contact_email" class="txt autoclear" placeholder="<?php _e('Email','be-themes'); ?>" />
									</fieldset>
									<fieldset class="contact_fieldset">
										<input type="text" name="contact_subject" class="txt autoclear" placeholder="<?php _e('Subject','be-themes'); ?>" />
									</fieldset>
									<fieldset class="contact_fieldset">
										<textarea name="contact_comment" class="txt_area autoclear" placeholder="<?php _e('Message','be-themes'); ?>" ></textarea>
									</fieldset>
									<fieldset class="contact_fieldset submit-fieldset">
										<input type="submit" name="contact_submit" value="<?php _e('Submit','be-themes'); ?>" class="contact_submit"/>
										<div class="contact_loader"></div>
									</fieldset>
									<div class="contact_status be-notification"></div>
								</form>
							</div>  <!-- End Contact Form -->

						</div> <!--  End Page Content -->

					</section>

					<section id="<?php echo $sidebar; ?>-sidebar" class="sidebar-widgets">
						<?php get_sidebar($sidebar); ?>
					</section>

				</div>
			</section>					 
<?php endwhile; ?>
<?php get_footer(); ?>