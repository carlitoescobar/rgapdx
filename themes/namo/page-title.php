<?php 
if(is_category()) {
	echo __('Category: ','be-themes').single_cat_title( '', false );
} elseif(is_tag()) {
	echo __('Articles Tagged with: ','be-themes').single_tag_title( '', false );
} elseif (is_search()) {
	echo __('Search Results for: ','be-themes').get_search_query();
} elseif(is_archive() && (is_tax( 'portfolio_categories' ) || is_tax( 'portfolio_tags' ))) {
	$term =	$wp_query->queried_object;
	if(is_tax( 'portfolio_categories' ))
		echo __('Portfolio Category : ','be-themes').$term->name;
	elseif(is_tax( 'portfolio_tags' ))
		echo __('Portfolio Tag : ','be-themes').$term->name;
	else
		echo __('Portfolio Archives','be-themes');
} elseif(is_archive()) {
	if ( is_day() ) :
		printf( __( 'Daily Archives: <span>%s</span>', 'be-themes' ), get_the_date() ); 
	elseif ( is_month() ) :
		printf( __( 'Monthly Archives: <span>%s</span>', 'be-themes' ), get_the_date( 'F Y' ) ); 
	elseif ( is_year() ) : 
		printf( __( 'Yearly Archives: <span>%s</span>', 'be-themes' ), get_the_date( 'Y' ) ); 
	else : 
		_e( 'Blog Archives', 'be-themes' );
	endif;
} elseif(is_singular('post')) {
	echo __('Blog','be-themes');
} elseif(is_home()){
	echo __('Blog','be-themes');
} else {
	the_title();
}
?>