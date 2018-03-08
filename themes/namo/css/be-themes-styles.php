/* ======================
    Backgrounds
   ====================== */
body {
    <?php be_themes_set_backgrounds('body'); ?>
}
#header-inner-wrap,
body.header-transparent #header #header-inner-wrap.no-transparent {
    <?php be_themes_set_backgrounds('header'); ?>
	box-shadow: 0 1px 1px rgba(0,0,0,0.15);
}
body.header-transparent #header #header-inner-wrap {
	-webkit-transition: background .25s ease, box-shadow .25s ease;
	-moz-transition: background .25s ease, box-shadow .25s ease;
	-o-transition: background .25s ease, box-shadow .25s ease;
	transition: background .25s ease, box-shadow .25s ease;
}
#content {
    <?php be_themes_set_backgrounds('content'); ?>
}
#bottom-widgets {
    <?php be_themes_set_backgrounds('bottom_widgets'); ?>
}
#footer {
    <?php be_themes_set_backgrounds('footer_background'); ?>
}
.page-title-module-custom {
	<?php be_themes_set_backgrounds('header_title_module'); ?>
	padding: 32px 0px;
}
#navigation .sub-menu,
#mobile-menu, #mobile-menu ul {
	background-color: <?php echo $be_themes_data['submenu_bg_color']; ?>;
}
.sb-slidebar {
	background-color: <?php echo $be_themes_data['sidebar_menu_bg_color']; ?>;
}

/* ======================
    Typography
   ====================== */
body {
    <?php be_themes_print_typography('body_text'); ?>
    -webkit-font-smoothing: antialiased; 
    -moz-osx-font-smoothing: grayscale;
}

h1 {
	<?php be_themes_print_typography('h1'); ?>
}
h2 {
	<?php be_themes_print_typography('h2'); ?>
}
h3 {
  <?php be_themes_print_typography('h3'); ?>
}
h4 {
  <?php be_themes_print_typography('h4'); ?>
}
h5, #reply-title {
  <?php be_themes_print_typography('h5'); ?>
}
h6 {
  <?php be_themes_print_typography('h6'); ?>
}
#navigation {
    <?php be_themes_print_typography('navigation_text'); ?>;
}
.thumb-title,
.full-screen-portfolio-overlay-title {
    <?php be_themes_print_typography('portfolio_title'); ?>;
}
#footer {
    <?php be_themes_print_typography('footer_text'); ?>
}
#bottom-widgets h6 {
    <?php be_themes_print_typography('bottom_widget_title'); ?>
    margin-bottom:20px;
}
#bottom-widgets {
    <?php be_themes_print_typography('bottom_widget_text'); ?>
}
.sidebar-widgets h6 {
   <?php be_themes_print_typography('sidebar_widget_title'); ?>
   margin-bottom:20px;
}
.sidebar-widgets {
	<?php be_themes_print_typography('sidebar_widget_text'); ?>
}
#navigation .sub-menu,
#mobile-menu {
	<?php be_themes_print_typography('submenu_text'); ?>
}

#slidebar-menu {
	<?php be_themes_print_typography('sidebar_menu_text'); ?>
}
.sb-slidebar .widget {
  <?php be_themes_print_typography('slidebar_widget_text'); ?>
}
.sb-slidebar .widget h6 {
  <?php be_themes_print_typography('slidebar_widget_title'); ?>
}
#bottom-widgets .widget ul li a, #bottom-widgets a {
	color: inherit;
}
#bottom-widgets .widget ul li a:hover, #bottom-widgets a:hover {
	color: <?php echo $be_themes_data['color_scheme']; ?>;
}

#mobile-menu a,
#navigation .menu > ul > li.mega > ul > li {
  border-color: <?php echo $be_themes_data['submenu_mobile_border']; ?>;
}
#slidebar-menu a {
  border-color: <?php echo $be_themes_data['slidebar_menu_border']; ?>;
}

.page-title-module-custom .page-title-custom {
  <?php be_themes_print_typography('page_title_module_typo'); ?>
}
.page-title-module-custom .header-breadcrumb {
  line-height: 36px;
}

.be-button {
	<?php 
	$button_font = explode( '/', $be_themes_data['button_font'] );
	$button_font_family = explode( ':', $button_font['1'] );
	?>
	font-family: "<?php echo $button_font_family[0]; ?>";
}

.ui-tabs .ui-tabs-nav li a,
.ui-accordion .ui-accordion-header,
.skill_name,
.be-notification, .wpcf7-response-output.wpcf7-validation-errors, .wpcf7-response-output.wpcf7-mail-sent-ok {
    font-size: 11px;
    letter-spacing: 2px;
    text-transform: uppercase;
}



/* ======================
    Layout 
   ====================== */


body #header-inner-wrap.top-animate #navigation, 
body #header-inner-wrap.top-animate .header-controls, 
body #header-inner-wrap.stuck #navigation, 
body #header-inner-wrap.stuck .header-controls {
	-webkit-transition: line-height 0.5s ease;
	-moz-transition: line-height 0.5s ease;
	-ms-transition: line-height 0.5s ease;
	-o-transition: line-height 0.5s ease;
	transition: line-height 0.5s ease;
}
	
.header-cart-controls .cart-contents {
	background: <?php echo $be_themes_data['header_cart_count_background']; ?>;
}
.header-cart-controls .cart-contents {
	color: <?php echo $be_themes_data['header_cart_count_color']; ?>;
}

.left-sidebar-page,.right-sidebar-page, .no-sidebar-page .be-section-pad:first-child, .page-template-page-940-php #content , .blog .no-sidebar-page #content-wrap, .portfolio-archives.no-sidebar-page #content-wrap {
    padding-top: 80px;
}  
.left-sidebar-page .be-section:first-child, .right-sidebar-page .be-section:first-child, .dual-sidebar-page .be-section:first-child {
    padding-top:0 !important;
}


/* ======================
    Colors 
   ====================== */


.sec-bg {
  background-color: <?php echo $be_themes_data['sec_bg']; ?>;
}
.sec-color,
.post-meta a,
.pagination a, .pagination span, .pages_list a {
  color: <?php echo $be_themes_data['sec_color']; ?>;
}

.sec-border {
  border: 1px solid <?php echo $be_themes_data['sec_border']; ?>;
}

.pricing-table li {
  border-bottom: 1px solid <?php echo $be_themes_data['sec_border']; ?>;
}

.separator {
  border:0;
  height:1px;
  color: <?php echo $be_themes_data['sec_border']; ?>;
  background-color: <?php echo $be_themes_data['sec_border']; ?>;
}


.alt-color,
li.ui-tabs-active h6 a,
#navigation a:hover,
#header-top-menu a:hover,
#navigation .current-menu-item > a,
#slidebar-menu .current-menu-item > a,
a,
a:visited,
.social_media_icons a:hover,
.post-title a:hover,
.fn a:hover,
a.team_icons:hover,
.recent-post-title a:hover,
.widget_nav_menu ul li.current-menu-item a,
.widget_nav_menu ul li.current-menu-item:before,
.filters .current_choice,
.woocommerce ul.cart_list li a:hover,
.woocommerce ul.product_list_widget li a:hover,
.woocommerce-page ul.cart_list li a:hover,
.woocommerce-page ul.product_list_widget li a:hover,
.woocommerce-page .product-categories li a:hover,
.woocommerce ul.products li.product .product-meta-data h3:hover,
.woocommerce table.cart a.remove:hover, .woocommerce #content table.cart a.remove:hover, .woocommerce-page table.cart a.remove:hover, .woocommerce-page #content table.cart a.remove:hover,
td.product-name a:hover,
.woocommerce-page #content .quantity .plus:hover,
.woocommerce-page #content .quantity .minus:hover,
.post-category a:hover {
    color: <?php echo $be_themes_data['color_scheme']; ?>;
}

.post-title a:hover {
    color: <?php echo $be_themes_data['color_scheme']; ?> !important;
}

.alt-bg,
input[type="submit"],
.tagcloud a:hover,
.pagination a:hover,
.widget_tag_cloud a:hover,
#navigation .sub-menu a:hover,
.flex-direction-nav a:hover,
.pagination .current,
#navigation .sub-menu .current-menu-item > a {
    background-color: <?php echo $be_themes_data['color_scheme']; ?>;
    transition: 0.2s linear all;
}
.mejs-controls .mejs-time-rail .mejs-time-current ,
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
.woocommerce span.onsale, 
.woocommerce-page span.onsale, 
.woocommerce a.add_to_cart_button.button.product_type_simple.added,
.woocommerce-page .widget_shopping_cart_content .buttons a.button:hover,
.woocommerce nav.woocommerce-pagination ul li span.current, 
.woocommerce nav.woocommerce-pagination ul li a:hover, 
.woocommerce nav.woocommerce-pagination ul li a:focus,
.woocommerce .button.alt,.woocommerce-page #respond input#submit.alt,
.woocommerce .button.alt:hover,.woocommerce-page #respond input#submit.alt:hover,
.woocommerce a.button:hover,
.woocommerce input.button:hover,
.woocommerce-page #content input.button.alt#place_order:hover,
.testimonial-flex-slider .flex-control-paging li a.flex-active,
.woocommerce .widget_shopping_cart_content .button.checkout {
  background: <?php echo $be_themes_data['color_scheme']; ?> !important;
}

.tagcloud a:hover,
.testimonial-flex-slider .flex-control-paging li a.flex-active,
.testimonial-flex-slider .flex-control-paging li a {
  border-color: <?php echo $be_themes_data['color_scheme']; ?>;
}

<?php
  $overlay_color = be_themes_hexa_to_rgb( $be_themes_data['color_scheme'] );
?>

.thumb-bg {
  background-color: <?php echo 'rgba('.$overlay_color[0].','.$overlay_color[1].','.$overlay_color[2].',0.85)'; ?>;
}

.photostream_overlay,
.be-button {
	background-color: <?php echo $be_themes_data['color_scheme']; ?>;
}
.alt-bg-text-color,
input[type="submit"],
.tagcloud a:hover,
.pagination a:hover,
.widget_tag_cloud a:hover,
#navigation .sub-menu a:hover,
#navigation .sub-menu .menu-item:hover:before,
.pagination .current,
#navigation .sub-menu .current-menu-item > a,
.woocommerce nav.woocommerce-pagination ul li span.current, 
.woocommerce nav.woocommerce-pagination ul li a:hover, 
.woocommerce nav.woocommerce-pagination ul li a:focus {
    color: <?php echo $be_themes_data['alt_bg_text_color'];  ?> !important;
    transition: 0.2s linear all;
}

.be-button {
	color: <?php echo $be_themes_data['alt_bg_text_color'];  ?>;
	transition: 0.2s linear all;
}

.portfolio-title a {
    color: inherit;
}

pre {
    background-image: -webkit-repeating-linear-gradient(top, <?php echo $be_themes_data['content']['color']; ?> 0px, <?php echo $be_themes_data['content']['color']; ?> 30px, <?php echo $be_themes_data['sec_bg']; ?> 24px, <?php echo $be_themes_data['sec_bg']; ?> 56px);
    background-image: -moz-repeating-linear-gradient(top, <?php echo $be_themes_data['content']['color']; ?> 0px, <?php echo $be_themes_data['content']['color']; ?> 30px, <?php echo $be_themes_data['sec_bg']; ?> 24px, <?php echo $be_themes_data['sec_bg']; ?> 56px);
    background-image: -ms-repeating-linear-gradient(top, <?php echo $be_themes_data['content']['color']; ?> 0px, <?php echo $be_themes_data['content']['color']; ?> 30px, <?php echo $be_themes_data['sec_bg']; ?> 24px, <?php echo $be_themes_data['sec_bg']; ?> 56px);
    background-image: -o-repeating-linear-gradient(top, <?php echo $be_themes_data['content']['color']; ?> 0px, <?php echo $be_themes_data['content']['color']; ?> 30px, <?php echo $be_themes_data['sec_bg']; ?> 24px, <?php echo $be_themes_data['sec_bg']; ?> 56px);
    background-image: repeating-linear-gradient(top, <?php echo $be_themes_data['content']['color']; ?> 0px, <?php echo $be_themes_data['content']['color']; ?> 30px, <?php echo $be_themes_data['sec_bg']; ?> 24px, <?php echo $be_themes_data['sec_bg']; ?> 56px);
    display: block;
    line-height: 28px;
    margin-bottom: 50px;
    overflow: auto;
    padding: 0px 10px;
    border:1px solid <?php echo $be_themes_data['sec_border']; ?>;
}

@media only screen and (max-width : 767px ) {
    #hero-section h1 , 
    .full-screen-section-wrap h1 {
      font-size: 30px;
      line-height: 40px;
    }
    #hero-section h2,
    .full-screen-section-wrap h2 { 
      font-size: 25px;
      line-height: 35px;
    }
    #hero-section h4,
    .full-screen-section-wrap h4 {
      font-size: 16px;
      line-height: 30px;
    }
    #hero-section h5,
    .full-screen-section-wrap h5 {
      font-size: 16px;
      line-height: 30px;
    }    
}

<?php extract(be_themes_calculate_logo_height()); ?>
#navigation,
.header-controls, 
.mobile-nav-controller-wrap {
	line-height: <?php echo $logo_height; ?>px;
}
body.header-transparent #header-inner-wrap #navigation,
body.header-transparent #header-inner-wrap .header-controls, 
body.header-transparent #header-inner-wrap .mobile-nav-controller-wrap {
	line-height: <?php echo $logo_transparent_height; ?>px;
}
body #header-inner-wrap.top-animate #navigation, 
body #header-inner-wrap.top-animate .header-controls, 
body #header-inner-wrap.stuck #navigation, 
body #header-inner-wrap.stuck .header-controls {
	line-height: <?php echo $logo_sticky_height; ?>px;
}


/*********************************************************************
            LOADING
*********************************************************************/
.bubblingG {
  text-align: center;
  width:50px;
  height:30px;
  position: absolute;
  top: 50%;
  left: 50%;
  z-index: 2;
  margin: -15px 0px 0px -24px;
  display: none;
  overflow: hidden;
}
.bubblingG span {
  display: inline-block;
  vertical-align: middle;
  width: 6px;
  height: 6px;
  margin: 15px auto;
  background:<?php echo $be_themes_data['color_scheme']; ?> !important;
  -moz-border-radius: 30px;
  -moz-animation: bubblingG 0.4s infinite alternate;
  -webkit-border-radius: 30px;
  -webkit-animation: bubblingG 0.4s infinite alternate;
  -ms-border-radius: 30px;
  -ms-animation: bubblingG 0.4s infinite alternate;
  -o-border-radius: 30px;
  -o-animation: bubblingG 0.4s infinite alternate;
  border-radius: 30px;
  animation: bubblingG 0.4s infinite alternate;
}
#bubblingG_1 {
  -moz-animation-delay: 0s;
  -webkit-animation-delay: 0s;
  -ms-animation-delay: 0s;
  -o-animation-delay: 0s;
  animation-delay: 0s;
}
#bubblingG_2 {
  -moz-animation-delay: 0.12s;
  -webkit-animation-delay: 0.12s;
  -ms-animation-delay: 0.12s;
  -o-animation-delay: 0.12s;
  animation-delay: 0.12s;
}
#bubblingG_3 {
  -moz-animation-delay: 0.24s;
  -webkit-animation-delay: 0.24s;
  -ms-animation-delay: 0.24s;
  -o-animation-delay: 0.24s;
  animation-delay: 0.24s;
}
#bubblingG_1_1 {
    -moz-animation-delay: 0s;
    -webkit-animation-delay: 0s;
    -ms-animation-delay: 0s;
    -o-animation-delay: 0s;
    animation-delay: 0s;
}
#bubblingG_2_2 {
    -moz-animation-delay: 0.12s;
    -webkit-animation-delay: 0.12s;
    -ms-animation-delay: 0.12s;
    -o-animation-delay: 0.12s;
    animation-delay: 0.12s;
}
#bubblingG_3_3 {
    -moz-animation-delay: 0.24s;
    -webkit-animation-delay: 0.24s;
    -ms-animation-delay: 0.24s;
    -o-animation-delay: 0.24s;
    animation-delay: 0.24s;
}
.page-loader {
    position: fixed;
    z-index: 10;
}
@-moz-keyframes bubblingG {
  0% {
    width: 6px;
    height: 6px;
    background-color: <?php echo $be_themes_data['color_scheme']; ?>;
    -moz-transform: translateY(0);
  }
  100% {
    width: 14px;
    height: 14px;
    background-color:#000000;
    -moz-transform: translateY(-13px);
  }
}
@-webkit-keyframes bubblingG {
  0% {
    width: 6px;
    height: 6px;
    background-color: <?php echo $be_themes_data['color_scheme']; ?>;
    -webkit-transform: translateY(0);
  }
  100% {
    width: 14px;
    height: 14px;
    background-color:#000000;
    -webkit-transform: translateY(-13px);
  }
}
@-ms-keyframes bubblingG {
  0% {
    width: 6px;
    height: 6px;
    background-color: <?php echo $be_themes_data['color_scheme']; ?>;
    -ms-transform: translateY(0);
  }
  100% {
    width: 14px;
    height: 14px;
    background-color:#000000;
    -ms-transform: translateY(-13px);
  }
}
@-o-keyframes bubblingG {
  0% {
    width: 6px;
    height: 6px;
    background-color: <?php echo $be_themes_data['color_scheme']; ?>;
    -o-transform: translateY(0);
  }
  100% {
    width: 14px;
    height: 14px;
    background-color:#000000;
    -o-transform: translateY(-13px);
  }
}
@keyframes bubblingG {
  0% {
    width: 6px;
    height: 6px;
    background-color:#3A8C35;
    transform: translateY(0);
  }
  100% {
    width: 14px;
    height: 14px;
    background-color:#000000;
    transform: translateY(-13px);
  }
}

/*  Optiopn Panel Css */
<?php echo stripslashes_deep(htmlspecialchars_decode($be_themes_data['custom_css'],ENT_QUOTES));  ?>