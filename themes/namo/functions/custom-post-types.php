<?php 

get_template_part( 'functions/custom-post-types/PostType' );

/***********************************************
					PORTFOLIO
***********************************************/	

//Create Post Type

$portfolio = Create_Custom_Post_Type( 'portfolio' );

//Add Categories Style Taxonomy
$portfolio->Add_Categories_Style_Taxonomy( 'portfolio_categories' );

//Add Tags Style Taxonomy
$portfolio->Add_Tags_Style_Taxonomy( 'portfolio_tags' );

$portfolio->args['supports'] = array( 'title', 'editor','thumbnail','excerpt' );
?>