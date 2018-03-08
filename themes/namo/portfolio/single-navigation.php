<?php
/*
	The template for displaying a Portfolio Item.
*/
if((!is_page_template( 'gallery.php' )) || (!is_page_template( 'portfolio.php' ))) {
    echo '<div id="nav-below" class="single-page-nav align-center">';
        previous_post_link( '%link', '<i class="font-icon icon-arrow_left" title="%title"></i>' );
        if ( is_singular( 'portfolio' ) ) {
            global $be_themes_data;
            if(!empty($be_themes_data['portfolio_url']) && $be_themes_data['portfolio_url']) {
                $url = $be_themes_data['portfolio_url'];
            } else {
                $url = site_url();
            }
        } else {
            $url = be_get_posts_page_url();
        }
        echo '<a href="'.$url.'"><i class="font-icon icon-icon_grid-2x2" title="Posts"></i></a>';
        next_post_link( '%link', '<i class="font-icon icon-arrow_right" title="%title"></i>' );
    echo '</div>';
}
?>