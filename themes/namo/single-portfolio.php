<?php
/*
	The template for displaying a Portfolio Item.
*/
?>
<?php
$single_portfolio_style = get_post_meta(get_the_ID(), 'be_themes_portfolio_single_page_style', true);
if ((!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') && ($single_portfolio_style == 'style1' || $single_portfolio_style == 'style2' || $single_portfolio_style == 'style3' || $single_portfolio_style == 'style4')) {
	$single_portfolio_style = get_post_meta(get_the_ID(), 'be_themes_portfolio_single_page_style', true);
	if($single_portfolio_style) {
		get_template_part( 'portfolio/single', $single_portfolio_style );
	} else {
		get_template_part( 'portfolio/single', 'style1' );
	}
} else {
	get_header();
	while (have_posts() ) : the_post();
		if($single_portfolio_style == 'floting-right' || $single_portfolio_style == 'floting-left' || $single_portfolio_style == 'normal-left'|| $single_portfolio_style == 'normal-right') {
			get_template_part( 'portfolio/single', $single_portfolio_style );
		} else {
			get_template_part( 'portfolio/single', 'normal' );
		}
	endwhile;
	get_footer();
}