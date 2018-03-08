<?php

// windows-proof constants: replace backward by forward slashes - thanks to: https://github.com/peterbouwmeester
$fslashed_dir = trailingslashit(str_replace('\\','/',dirname(__FILE__)));
$fslashed_abs = trailingslashit(str_replace('\\','/',ABSPATH));

if(!defined('BE_PAGE_BUILDER_DIR')){
	define('BE_PAGE_BUILDER_DIR', $fslashed_dir);
}

if(!defined('BE_PAGE_BUILDER_URL')){
	define('BE_PAGE_BUILDER_URL', site_url(str_replace( $fslashed_abs, '', $fslashed_dir )));
}

get_template_part('be-page-builder/be', 'pb-options');
get_template_part('be-page-builder/be', 'pb-backend-output');

global $row_controls;
global $section_controls;
global $blank_row;
global $blank_section;
global $paste_shortcode_name;

				
$row_controls = '<div class="be-pb-row-controls clearfix toggled">
					<div class="left row-column-controls">	
						<span class="rows-title">
						    Rows
  						  </span>
					      <a class="med-btn mini-btn-light btn-icon-one-col-wrap" title="one" role="button" data-col-name="one_col" data-col-count="1">
						      <span class="btn-icon-one-col">Full</span>
  						  </a>
  						  <a class="med-btn mini-btn-light btn-icon-one-half-wrap" title="1/2" role="button" data-col-name="one_half" data-col-count="2">
					      	<span class="btn-icon-one-half">One Half</span>
					      </a>
  						  <a class="med-btn mini-btn-light btn-icon-one-third-wrap" title="1/3" role="button" data-col-name="one_third" data-col-count="3">
					      	<span class="btn-icon-one-third">One Third</span>
					      </a>
  						  <a class="med-btn mini-btn-light btn-icon-one-fourth-wrap" title="1/4" role="button" data-col-name="one_fourth" data-col-count="4">
					      	<span class="btn-icon-one-fourth">One Fourth</span>
					      </a>
  						  <a class="med-btn mini-btn-light btn-icon-one-fifth-wrap" title="1/5" role="button" data-col-name="one_fifth" data-col-count="5">
					      	<span class="btn-icon-one-fifth">One Fifth</span>
					      </a>					      
  						  <a class="med-btn mini-btn-light btn-icon-two-third-wrap" title="2/3" role="button" data-col-name="two_third" data-col-count="2">
					      	<span class="btn-icon-two-third">Two third</span>
					      </a>
  						  <a class="med-btn mini-btn-light btn-icon-three-fourth-wrap" title="3/4" role="button" data-col-name="three_fourth" data-col-count="2">
					      	<span class="btn-icon-three-fourth">Three Fourth</span>
					      </a>
  						  <a class="med-btn mini-btn-light btn-icon-one-half-fourth-wrap" title="1/2-1/4" role="button" data-col-name="one_half_fourth" data-col-count="3">
					      	<span class="btn-icon-one-half-fourth">Mixed Columns</span>
					      </a>					      
					 </div>
						<div class="right row-controls">
							<a class="med-btn mini-btn-light copy-shortcode" title="Copy" data-action="copy">
								<span class="btn-icon-row-view"><i class="font-icon icon-download"></i>Copy Row</span>
							</a>
							<a class="med-btn mini-btn-light" title="View" data-action="view">
								<span class="btn-icon-row-view"><i class="font-icon icon-eye"></i>View Row</span>
							</a>
							<a class="med-btn mini-btn-light" title="Duplicate" data-action="duplicate">
								<span class="btn-icon-row-duplicate"><i class="font-icon icon-book-open"></i>Duplicate Row</span>
							</a>
							<a class="med-btn mini-btn-light edit-shortcode" title="Edit" data-action="edit"  data-shortcode="row">
								<span class="btn-icon-row-edit"><i class="font-icon icon-cog"></i>Edit Row</span>
							</a>   						  
							<a class="med-btn mini-btn-light" title="Delete" data-action="delete">
								<span class="btn-icon-row-delete"><i class="font-icon icon-cancel"></i>Delete Row</span>
							</a>						 		
						</div>   
				</div>';

$section_controls = '<div class="be-pb-section-controls clearfix toggled">
						<div class="section-header clearfix">
							<div class="left">
								<h3>Section</h3>
							</div>
							<div class="right section-controls">
								<a class="med-btn mini-btn-light copy-shortcode" title="Copy" data-action="view">
									<span class="btn-icon-section-view"><i class="font-icon icon-download"></i>Copy Section</span>
								</a>
								<a class="med-btn mini-btn-light" title="View" data-action="view">
									<span class="btn-icon-section-view"><i class="font-icon icon-eye"></i>View Section</span>
								</a>
								<a class="med-btn mini-btn-light" title="Duplicate" data-action="duplicate">
									<span class="btn-icon-section-duplicate"><i class="font-icon icon-duplicate icon-paste icon-book-open"></i>Duplicate Section</span>
								</a>
								<a class="med-btn mini-btn-light edit-shortcode" title="Edit" data-action="edit"  data-shortcode="section">
									<span class="btn-icon-section-edit"><i class="font-icon icon-cog"></i>Edit Section</span>
								</a>      						  
								<a class="med-btn mini-btn-light" title="Delete" data-action="delete">
									<span class="btn-icon-section-delete"><i class="font-icon icon-cancel"></i>Delete Section</span>
								</a>
							</div>
						</div>
					</div>';

$blank_row = '<div class="be-pb-row-wrap be-pb-element clearfix be-pb-module-wrap">
	    				'.$row_controls.'
	    				<pre class="shortcode">[row]</pre>
						<div class="be-pb-row be-pb-sortable clearfix">
							<div class="portlet be-pb-element be-pb-col-wrap one_col" data-col-name="one_col">
								<pre class="shortcode">[one_col]</pre>
								<div class="portlet-header column-header">
									<div class="left">
										Column
									</div>
									<div class="portlet-header-column-controls-wrap right">
										<span class="be-pb-control-icon icon-pencil icon-edit edit-shortcode  column-edit-control clear" title="Edit" data-shortcode="one_col" data-action="edit"></span>
									</div>
								</div>
								<div class="be-pb-column be-pb-shortcode-col"></div>
								<div class="be-pb-controls">
									<a class="mini-btn mini-btn-dark choose-shortcode" title="Add" role="button">
										<span class="btn-icon-plus"><i class="font-icon icon-plus"></i>Add</span>
									</a>
									<a class="mini-btn mini-btn-dark paste-shortcode" data-shortcode-name="module" title="Paste Module" role="button">
										<span class="btn-icon-plus"><i class="font-icon icon-upload"></i>Add</span>
									</a>
								</div>
								<pre class="shortcode">[/one_col]</pre>
							</div>	
						</div>
						<pre class="shortcode">[/row]</pre>
				</div>';

$blank_section = '<div class="be-pb-section-wrap be-pb-element clearfix be-pb-module-wrap">
								'.$section_controls.'
								<pre class="shortcode">[section padding_top="100" padding_bottom="100"]</pre>	
								<div class="be-pb-section-inner-wrap"><div class="be-pb-section">
									'.$blank_row.'
								</div><a href="#" class="bluefoose-button-dark be-pb-add-row">+ Row</a><a href="#" class="bluefoose-button-dark be-pb-paste-row" data-shortcode-name="row">+ Paste Row Shortcode</a></div>
							 	<pre class="shortcode">[/section]</pre>	
						</div>';													

function get_shortcode_form() {
	global $be_shortcode;
	extract($_POST);
	if(!array_key_exists('options', $be_shortcode[$shortcode]) && empty($be_shortcode[$shortcode]['options'])) {
		get_shortcode_block($shortcode, $be_shortcode[$shortcode]['type']);
	}
	else {
		be_pb_print_form($shortcode);
	}
	die();
}

function get_multi_shortcode_block($shortcode_name, $output = '', $inner_shortcode ='') {
	global $be_shortcode;
	$hide = '';
	if(!array_key_exists('options', $be_shortcode[$shortcode_name]) && empty($be_shortcode[$shortcode_name]['options'])) {
		$hide = 'hidden';
	}
	$html = '';
	$html .= '<div class="be-pb-multi-wrap be-pb-element toggled be-pb-module-wrap" data-shortcode="'.$shortcode_name.'">';
	$html .= '<pre class="shortcode">'.$output.'</pre>';
	$html .= '<div class="be-pb-multi-fields-header-wrap clearfix"><h4>'.$be_shortcode[$shortcode_name]['name'].'<span class="be-pb-control-icon icon-cancel-circled icon-delete icon-trash bottom-border" title="Delete"></span><span class="be-pb-control-icon icon-duplicate icon-book-open bottom-border" title="Duplicate"></span><span class="be-pb-control-icon icon-pencil edit-shortcode '.$hide.' clear" title="Edit" data-shortcode="'.$shortcode_name.'" data-action="edit"></span><span class="be-pb-control-icon icon-eye" title="View"></span><span class="be-pb-control-icon icon-download copy-shortcode" title="Copy"></span></h4></div>';
	$html .= '<div class="be-pb-multi-fields-wrap"><div class="be-pb-multi-fields be-pb-shortcode-col be-pb-sortable">';
	if(!empty($inner_shortcode)){
		$html .= $inner_shortcode;
	}
	$html .= '</div>';
	$html .= '<div class="be-pb-controls"><a class="mini-btn mini-btn-dark add-multi-field" title="Add" role="button" data-single-field='.$be_shortcode[$shortcode_name]['single_field'].'><span class="btn-icon-plus"><i class="font-icon icon-plus"></i>Add</span></a><a class="mini-btn mini-btn-dark paste-shortcode" data-shortcode-name="multi-module" title="Paste Module" role="button"><span class="btn-icon-plus"><i class="font-icon icon-upload"></i>Add</span></a>';
	$html .= '</div><pre class="shortcode">[/'.$shortcode_name.']</pre></div>';
	return $html;
}

function get_single_shortcode_block($shortcode_name, $output = ''){
	global $be_shortcode;
	$hide = '';
	if(!array_key_exists('options', $be_shortcode[$shortcode_name]) && empty($be_shortcode[$shortcode_name]['options'])) {
		$hide = 'hidden';	
	}
	$html ='';
	$html .='<div class="portlet be-pb-element be-pb-module-wrap">';
	$html .= '<div class="portlet-header"><div class="portlet-header-controls-wrap right"><span class="be-pb-control-icon icon-cancel-circled icon-delete icon-trash bottom-border" title="Delete"></span><span class="be-pb-control-icon icon-duplicate icon-book-open bottom-border" title="Duplicate"></span><span class="be-pb-control-icon icon-pencil icon-edit edit-shortcode '.$hide.' clear" title="Edit" data-shortcode="'.$shortcode_name.'" data-action="edit"></span><span class="be-pb-control-icon icon-eye" title="View"></span><span class="be-pb-control-icon icon-download copy-shortcode" title="Copy"></span></div>'.$be_shortcode[$shortcode_name]['name'].'</div>';
	if(isset($be_shortcode[$shortcode_name]['backend_output']) && $be_shortcode[$shortcode_name]['backend_output'] === true) {
		$html .='<div class="portlet-content clearfix">'.be_pb_output($output, $shortcode_name).'</div>';
	}
	$html .= '<pre class="shortcode">'.$output.'</pre>';
	$html .= '</div>';
	return $html;
}

function get_shortcode_block($shortcode = '',$shortcode_type = '') {
	global $be_shortcode;
	$shortcode_action = '';
	extract($_POST);
	$output = '';
	$has_content = false;
	if(!empty($shortcode_name)) 
		$shortcode = $shortcode_name;

	if(array_key_exists('options', $be_shortcode[$shortcode])) {
		foreach ($be_shortcode[$shortcode]['options'] as $att => $value) {
			if(array_key_exists('content', $value)){
				if($value['content'] == true) {
					$has_content = true;
					$content_att = $att;
					break;
				}
			}
			else {
				$has_content = false;
			}
		 }
	}
	

	if(!empty($be_shortcode_atts)) {
		 $output .='['.$shortcode;
		 if($has_content == true) {
		 	foreach ($be_shortcode_atts as $att => $value) {
		 		if($att != $content_att){
		 			if(is_array($value)){
		 				$value = implode(',', $value);
		 			}
		 			$output .=' '.$att.'= "'.$value.'"';
		 		}
		 	}
		 	$output .=' ]'.shortcode_unautop(stripslashes_deep($be_shortcode_atts[$content_att])).'[/'.$shortcode.']';	
		} else {
		 	foreach ($be_shortcode_atts as $att => $value) {
	 			if(is_array($value)) {
	 				$value = implode(',', $value);
	 			}
	 			$output .=' '.$att.'= "'.$value.'"';
		 	}
		 	$output .=']';
		}
	} else {
		$output .='['.$shortcode.']';
	}

	if($shortcode == 'section' || $shortcode == 'row' || $shortcode == 'one_col' || $shortcode == 'one_half' || $shortcode == 'one_third' || $shortcode == 'one_fourth' || $shortcode == 'two_third' || $shortcode == 'three_fourth' || $shortcode == 'one_fifth'|| ( $shortcode_action == 'edit' && $be_shortcode[$shortcode]['type']=='multi' )){
		echo $output;
	} else {
	 	if($shortcode_type == 'multi'){
			echo get_multi_shortcode_block($shortcode, $output);
	 	}
	 	else {
			echo get_single_shortcode_block($shortcode, $output);
		} 
	}
	die();
}

function edit_shortcode_form() {
	global $be_shortcode;
	$post = stripslashes_deep($_POST);
	$shortcode = $post['shortcode'];
	$pattern = get_shortcode_regex();
	preg_match("/$pattern/s", $shortcode, $parsed_value );
	if (preg_last_error() == PREG_BACKTRACK_LIMIT_ERROR) {
    	print 'Backtrack limit was exhausted!';
	}
	$shortcode_name = $post['shortcode_name'];
	$atts = shortcode_parse_atts($parsed_value[3]);
	if(!empty($parsed_value[5])){
		$content = $parsed_value[5];	
	} else {
		$content = '';
	}
	be_pb_print_form($shortcode_name, 'edit', $atts, $content);
	die();
}

function paste_shortcode_form() {
	global $shortcode_tags;
	global $paste_shortcode_name;
	$post = stripslashes_deep($_POST);
	$shortcode = $post['shortcode'];
	$paste_shortcode_name = $post['shortcode_name'];
	if (empty($shortcode_tags) || !is_array($shortcode_tags))
		return $shortcode;
	$pattern = get_shortcode_regex();
	echo preg_replace_callback( "/$pattern/s", 'be_pb_do_paste_shortcode_tag', $shortcode );
	die();
}

function be_pb_do_paste_shortcode_tag( $shortcode ) {
	global $paste_shortcode_name;
	global $be_shortcode;
	$shortcode_name = $shortcode[2];
	if((($paste_shortcode_name == 'section') || ($paste_shortcode_name == 'row')) && ($shortcode_name == $paste_shortcode_name)) {
		return be_pb_do_shortcode( $shortcode[0] );
	}
	if( $paste_shortcode_name == 'module' ) {
		if(($shortcode_name != 'section') && ($shortcode_name != 'row') && ($be_shortcode[$shortcode_name]['type'] != 'multi_single')) {
			return be_pb_do_shortcode( $shortcode[0] );
		}
	}
	if( $paste_shortcode_name == 'multi-module' ) {
		if(($shortcode_name != 'section') && ($shortcode_name != 'row') && ($be_shortcode[$shortcode_name]['type'] == 'multi_single')) {
			return be_pb_do_shortcode( $shortcode[0] );
		}
	}
}

function be_pb_add_field(){
	extract($_POST);
	be_pb_print_form($single_field);
	die();	
}


function be_pb_print_form($shortcode_name,$action='generate', $atts = array(), $content='') {
	global $be_shortcode;
	$chosen_shortcode = $be_shortcode[$shortcode_name];
	echo '<h2>'.$chosen_shortcode['name'].'</h2>';
	echo '<form data-shortcode-name="'.$shortcode_name.'" data-shortcode-type="'.$chosen_shortcode['type'].'">';

	if(!empty($chosen_shortcode['options']) && $chosen_shortcode['options']) {
		foreach ($chosen_shortcode['options'] as $option_key => $option) {
			$default = isset( $option['default'] ) ? $option['default'] : '';
			if($action == 'edit'){
				if(is_array($atts) && array_key_exists($option_key, $atts)){
					$att_value = $atts[$option_key];
				}
				else{
					$att_value='';
				}
			}
			else {
				$att_value = $default;
				$content = $default;
			}
			
			echo '<fieldset class="clearfix">';
					if ($option['type'] == 'text' || $option['type'] == 'select')
				$label_class = "padding-top-5";
			else
				$label_class = "padding-top-0";
				echo '<div class="left-section '.$label_class.'"><label for="be_shortcode_atts['.$option_key.']" class="be-pb-label">'.$option['title'].'</label></div>';
			switch ($option['type']) {
					case 'textarea':
						echo '<div class="right-section"><textarea name="be_shortcode_atts['.$option_key.']" id="#'.$option_key.'" class="be-shortcode-atts" rows="10" cols="70">'.$content.'</textarea></div>';
						break;
					case 'text':
						echo '<div class="right-section"><input type="text" name="be_shortcode_atts['.$option_key.']" id="#'.$option_key.'" value="'.$att_value.'" class="be-shortcode-atts be-pb-text" /></div>';
						break;
					case 'number':
						echo '<div class="right-section"><input type="number" name="be_shortcode_atts['.$option_key.']" id="#'.$option_key.'" value="'.$att_value.'" class="be-shortcode-atts be-pb-text" /></div>';
						break;
					case 'select':		
						echo
						'<div class="right-section"><select name="be_shortcode_atts['.$option_key.']" id="#'.$option_key. '" class="be-shortcode-atts be-pb-select">';
						if(empty($att_value) || $att_value == 'none'){
							echo '<option value="none" disabled="disabled">'.esc_html__('Select', 'be-themes').'</option>';
						}
						
						foreach ($option['options'] as $value) {
							if( is_array( $value ) ) {
								echo '<option value="'.$value['value'].'" '.selected( $value['value'], $att_value, false ).'>'.ucfirst(esc_html($value['label'])).'</option>';
							} else {
								echo '<option value="'.$value.'" '.selected( $value, $att_value, false ).'>'.ucfirst(esc_html($value)).'</option>';
							}
						}
						echo '</select></div>';
						break;
					case 'tinymce':
						$content = wpautop($content);
						wp_editor($content, 'textblockcontent', array('textarea_name'=> 'be_shortcode_atts['.$option_key.']', 'quicktags' => true, 'editor_class'=>'be-shortcode-atts be-pb-editor', 'media_buttons' => true,'wpautop'=>false ,'textarea_rows'=>20));
						
						break;
					case 'checkbox':
						echo '<input type="checkbox" name="be_shortcode_atts['.$option_key.']" value="1" class="be-shortcode-atts be-pb-checkbox" '.checked($att_value,'1',false).' />';
						break;	
					case 'multi_check':
						if(empty($att_value)){
							$att_value = array();
						}
						else {
							if(!is_array($att_value)){
								$att_value = explode(',', $att_value);
							}
						}
						echo '<div class="right-section">';
						foreach ($option['options'] as $value) {
							
							$checkbox_option = '<div class="margin-bottom-5"><input type="checkbox" name="be_shortcode_atts['.$option_key.'][]" value="'.$value.'" class="be-shortcode-atts be-pb-checkbox" ';
							if(in_array($value, $att_value)){
								$checkbox_option .= 'checked="checked" />';	
							}
							else{
								$checkbox_option .='/>';
							}
							echo $checkbox_option;
							echo '<label for="'.$value.'">'.$value.'</label></div>';
						}
						echo '</div>';
						break;
					case 'radio':
						echo '<div class="right-section">';
						foreach ($option['options'] as $value) {
							echo '<div class="margin-bottom-5"><input type="radio" name="be_shortcode_atts['.$option_key.'][]" value="'.$value.'" class="be-shortcode-atts be-pb-radio" '.checked($value,$att_value,false).' />';
							echo '<label for="'.$value.'">'.$value.'</label></div>';
						}
						break;
					case 'media':
						if(empty($att_value)){
							$att_value = array();
						}
						else {
							if(!is_array($att_value)){
								$att_value = explode(',', $att_value);
							}
						}									
						echo '<div class="right-section"><a href="#" class="button-secondary btn_browse_files '.$option['select'].'">Browse Files</a>
							<div class="browsed-images-container clearfix be-pb-sortable" data-name="be_shortcode_atts['.$option_key.']">';
							foreach ($att_value as $attachment_id) {
								echo '<div class="seleced-images-wrap">
									<input type="hidden" name="be_shortcode_atts['.$option_key.'][]" value="'.$attachment_id.'">
									<img src="'.wp_get_attachment_url( $attachment_id ).'">
									<span class="remove"></span>
									</div>';
							}
						echo '</div></div>';
						break;
					case 'color':
						echo '<div class="right-section"><input type="text" name="be_shortcode_atts['.$option_key.']" id="#'.$option_key.'" value="'.$att_value.'" class="be-pb-color-field be-shortcode-atts" /></div>';
						break;
					case 'taxo':
						if(empty($att_value)){
							$att_value = array();
						}
						else {
							if(!is_array($att_value)){
								$att_value = explode(',', $att_value);
							}
						}
						echo '<div class="right-section">';
						$taxonomy = get_terms($option['taxonomy']);
						foreach ($taxonomy as $term) {
							
							$checkbox_option = '<div class="margin-bottom-5"><input type="checkbox" name="be_shortcode_atts['.$option_key.'][]" value="'.$term->slug.'" class="be-shortcode-atts be-pb-checkbox" ';
							if(in_array($term->slug, $att_value)){
								$checkbox_option .= 'checked="checked" />';	
							}
							else{
								$checkbox_option .='/>';
							}
							echo $checkbox_option;
							echo '<label for="'.$term->name.'">'.$term->name.'</label></div>';
						}
						echo '</div>';
						break;
					case 'page':
						$pages = get_pages(array('post_type'=>'page'));	
						echo '<div class="right-section"><select name="be_shortcode_atts['.$option_key.']" id="#'.$option_key. '" class="be-shortcode-atts be-pb-select">';
						

						if(empty($att_value) || $att_value == 'none'){
							echo '<option value="none" disabled="disabled">'.esc_html__('Select', 'be-themes').'</option>';
						}
						
						foreach ($pages as $page) {
							echo '<option value="'.$page->ID.'" '.selected( $page->ID, $att_value, false ).'>'.esc_html($page->post_title).'</option>';
						}
							
						echo '</select></div>';
						break;																
				}
			echo "</fieldset>";		
		}
	}
	echo '<input type="submit" class="bluefoose-button-light add-shortcode" data-action="'.$action.'" />
	</form>';
}

/**************************************
			Add Section
**************************************/

function be_pb_add_section(){
	global $blank_section;
	echo $blank_section;
}


/**************************************
			Add Row
**************************************/

function be_pb_add_row(){
	global $blank_row;
	echo $blank_row;
}


/**************************************
			Save Page Builder
**************************************/

add_action( 'wp_ajax_save_be_pb_builder', 'save_be_pb_builder' );
add_action( 'wp_ajax_save_be_pb_builder', 'save_be_pb_builder' );

function save_be_pb_builder(){
	extract($_POST);

	if (!wp_verify_nonce($nonce, 'be_pb_save_nonce')) {
    	exit();	
    }	

  //   if(get_post_meta($post_id,'_be_pb_html',true)) {
  //   	$return['html'] = update_post_meta($post_id,'_be_pb_html',$html);
  //   } else {
  //   	$return['html'] = add_post_meta($post_id,'_be_pb_html',$html,true);
 	// }

    if(get_post_meta($post_id, '_be_pb_content')) { 
		$return['output'] = update_post_meta($post_id,'_be_pb_content',$content);
	} else {
		$return['output'] = add_post_meta($post_id,'_be_pb_content',$content,true);
	}

    if(get_post_meta($post_id, '_be_pb_disable')) { 
		$return['disabled'] = update_post_meta($post_id,'_be_pb_disable',$disable_pb);
	} else {
		$return['disabled'] = add_post_meta($post_id,'_be_pb_disable',$disable_pb,true);
	}		

	if($return['output'] > 0 || $return['disabled'] > 0 ) {
		echo "success";
	} else { 
		echo "no_changes";
	}
	
	die();
}



add_action( 'wp_ajax_nopriv_edit_shortcode_form', 'edit_shortcode_form' );
add_action( 'wp_ajax_edit_shortcode_form', 'edit_shortcode_form' );

add_action( 'wp_ajax_nopriv_paste_shortcode_form', 'paste_shortcode_form' );
add_action( 'wp_ajax_paste_shortcode_form', 'paste_shortcode_form' );

add_action( 'wp_ajax_nopriv_get_shortcode_form', 'get_shortcode_form' );
add_action( 'wp_ajax_get_shortcode_form', 'get_shortcode_form' );

add_action( 'wp_ajax_nopriv_get_shortcode_block', 'get_shortcode_block' );
add_action( 'wp_ajax_get_shortcode_block', 'get_shortcode_block' );

add_action( 'wp_ajax_nopriv_be_pb_add_field', 'be_pb_add_field' );
add_action( 'wp_ajax_be_pb_add_field', 'be_pb_add_field' );

add_action( 'wp_ajax_nopriv_be_pb_add_section', 'be_pb_add_section' );
add_action( 'wp_ajax_be_pb_add_section', 'be_pb_add_section' );

add_action( 'wp_ajax_nopriv_be_pb_add_row', 'be_pb_add_row' );
add_action( 'wp_ajax_be_pb_add_row', 'be_pb_add_row' );


function be_pb_output($output, $shortcode_name){

	global $be_shortcode;

	global $shortcode_tags;

	if (empty($shortcode_tags) || !is_array($shortcode_tags)) {
		return $output;
	}

	$pattern = get_shortcode_regex();

	if(isset($be_shortcode[$shortcode_name]['backend_output']) && $be_shortcode[$shortcode_name]['backend_output'] === true) {
		return preg_replace_callback( "/$pattern/s", 'be_pb_'.$shortcode_name.'_output', $output );
	}

}



/**************************************
		Setup Page Builder 
**************************************/

add_action( 'init', 'be_page_builder_init' );

function be_page_builder_init() {

	add_action( 'add_meta_boxes', 'be_page_builder_add_custom_box' ); 
	function be_page_builder_add_custom_box(){

	    $screens = array( 'page', 'portfolio' );
	    foreach ($screens as $screen) {
	        add_meta_box(
	            'be-page-builder',
	            __( 'Page Builder', 'be-themes' ),
	            'be_page_builder_custom_box',
	            $screen,
	            'normal',
	            'high'
	        );
	    }

	}

	function be_page_builder_custom_box() {
			global $be_shortcode;
			global $blank_section;
			wp_nonce_field('be_pb_save_nonce', 'be_pb_save_nonce');

		?>
		<input type="hidden" id="ajax_url" value="<?php echo admin_url(); ?>admin-ajax.php" />
		<input type="hidden" id="themefile_url" value="<?php echo get_bloginfo('template_url'); ?>/be-page-builder/js/jquery.clipboard/" />
		<div id="be-pb-disable">
			<?php $be_pb_disabled = get_post_meta(get_the_ID(),'_be_pb_disable',true); ?>
			<input type="checkbox" id="be-pb-disable-check"  name="be_pb_disable" value="yes" class="be-pb-checkbox" <?php echo checked($be_pb_disabled,'yes',false); ?> /><label for="be-pb-disable-check" class="be-pb-label">Disable Page Builder </label>
		</div>
		<h2><?php _e('Add Rows, organize content into column blocks and style the page using a myraid collection of shortcodes','be-themes') ?></h2>
		<div id="shortcodes" title="Modules" style="display:none;" class="be-jq-dialog">
			<?php 
				$be_sorted_shortcode = $be_shortcode;
				$be_sorted_shortcode = sort_2d_asc($be_sorted_shortcode, 'name'); 
			?>
			<div class="shortcode-btn-wrap">
				<?php
					foreach ($be_sorted_shortcode as $shortcode_key => $shortcode) {
						if(array_key_exists('options', $shortcode) && !empty($shortcode['options'])) {
							$shortcode_options = 'yes';
						} else {
							$shortcode_options = 'no';
						}
						if(!empty($shortcode['module_type']) && $shortcode['module_type'] == 'structure' && $shortcode['type'] != 'multi_single' && $shortcode_key != 'section' && $shortcode_key != 'row' && (empty($shortcode['exclude']) || $shortcode['exclude'] != true )) {
							echo '<div class="bluefoose-ui-button-light be-pb-choose-shortcode">
									  <a class="be-icon-'.$shortcode['name'].' insert-shortcode bluefoose-button-light" data-shortcode="'.$shortcode_key.'" data-action="insert" data-shortcode-type="'.$shortcode['type'].'" data-shortcode-options="'.$shortcode_options.'" />
										'.$shortcode['name'].'
									  </a>
									</div>';
						}
					}
				?>
			</div>
			<div class="shortcode-description clearfix">
				<h4><?php _e('Styling & Elements','be-themes') ?></h4>
				<p><?php _e('If you wish to adjust or add styling to your page or content, you can use the optional modules below.','be-themes') ?></p>
  			</div>
			<div class="shortcode-btn-wrap">
				<?php
					foreach ($be_sorted_shortcode as $shortcode_key => $shortcode) {
						if(array_key_exists('options', $shortcode) && !empty($shortcode['options'])) {
							$shortcode_options = 'yes';
						} else {
							$shortcode_options = 'no';
						}
						if((empty($shortcode['module_type']) || $shortcode['module_type'] != 'structure') && $shortcode['type'] != 'multi_single' && $shortcode_key != 'section' && $shortcode_key != 'row' && (empty($shortcode['exclude']) || $shortcode['exclude'] != true )) {
							echo '<div class="bluefoose-ui-button-light be-pb-choose-shortcode">
									<a class="be-icon-'.$shortcode['name'].' insert-shortcode bluefoose-button-light" data-shortcode="'.$shortcode_key.'" data-action="insert" data-shortcode-type="'.$shortcode['type'].'" data-shortcode-options="'.$shortcode_options.'" />
										'.$shortcode['name'].'
									</a>
								</div>';
						}
					}
				?>
			</div>
  			<div class="separator"></div>
			<div id="shortcode-form"></div>
		</div>

		<div id="edit-shortcode" title="Edit Shortcode Module" class="be-jq-dialog"></div>
		<div id="paste-shortcode" title="Paste Shortcode Module" class="be-jq-dialog">
			<div id="paste-shortcode-wrap">

			</div>
		</div>
		<div class="dialog-overlay-custom"></div>
		'
		<!--   Confirm Dialog  -->
		<div id="dialog-confirm" title="Delete Module / Section / Row" class="be-jq-dialog">
			<p class="dialog-confirm-content">
				<strong>Warning</strong>
				These items will be permanently deleted and cannot be recovered. Are you sure?
			</p>
		</div>

		<div id="be-pb-main" class="be-pb-sortable clearfix">
			<?php 
				global $post;

				$content = get_post_meta($post->ID,'_be_pb_content',true);

				//var_dump($content);	
				
				if(!empty($content)){

				 	echo be_pb_do_shortcode($content);
				}
				else{
					echo $blank_section;
				}
			?>

		</div>

		<div id="be-page-builder-controls"> <a href="#" class="bluefoose-button-dark" id="be-pb-add-section">+ Section</a><a href="#" class="bluefoose-button-dark" id="be-pb-paste-section" data-shortcode-name="section">+ Paste Section Shortcode</a></div>
		
		<div id="be-pb-save-wrap"><a href="#" class="bluefoose-button-dark" id="be-pb-save">Save Page Builder</a><span id="be-pb-loader"></div>

		<?php	
		
	} 

}

add_action( 'admin_enqueue_scripts', 'be_page_builder_enqueue');
function be_page_builder_enqueue() {

	wp_enqueue_media();
	wp_enqueue_script( 'custom-header' );

	wp_enqueue_style( 'wp-color-picker' );

	wp_enqueue_script( 'wp-color-picker' );

	wp_enqueue_script('jquery-uniform-js', BE_PAGE_BUILDER_URL.'/js/jquery.uniform.min.js');

	wp_enqueue_script('jquery-clipboard-js', BE_PAGE_BUILDER_URL.'/js/jquery.clipboard/jquery.clipboard.js');

	wp_enqueue_script('be-page-builder-js', BE_PAGE_BUILDER_URL.'/js/script.js', array('jquery','jquery-ui-core','jquery-ui-sortable','jquery-ui-draggable','jquery-ui-droppable','jquery-ui-dialog','wp-color-picker','jquery-uniform-js'));

	wp_register_style('be-page-builder', BE_PAGE_BUILDER_URL.'/css/be-pb-css.css');
	wp_enqueue_style('be-page-builder',array( 'jquery-ui-core', 'jquery-ui-theme' ), '1.8.17');

	//wp_enqueue_style('be-pb-backend-output',BE_PAGE_BUILDER_URL.'/css/be-pb-backend-output.css' );

	wp_enqueue_style('be-pb-backend-output',get_template_directory_uri().'/css/shortcodes.css' );

	wp_enqueue_style('be-fontello',get_template_directory_uri().'/fonts/fontello/be-themes.css' );
	//wp_enqueue_style('be-fontello');
} 

function be_pb_do_shortcode( $content ) {
	global $shortcode_tags;
	if (empty($shortcode_tags) || !is_array($shortcode_tags))
		return $content;
	$pattern = get_shortcode_regex();
	return preg_replace_callback( "/$pattern/s", 'be_pb_do_shortcode_tag', $content );
}

function be_pb_do_shortcode_tag( $m ) {
	global $be_shortcode;
	global $row_controls;
	global $section_controls;
	//var_dump($m);
	// allow [[foo]] syntax for escaping a tag
	if( !array_key_exists($m[2], $be_shortcode) ) {
		return '';
	}
	if ( $m[1] == '[' && $m[6] == ']' ) {
		return substr($m[0], 1, -1);
	}

	if($m[2] == 'section') {
		return '<div class="be-pb-section-wrap be-pb-element clearfix be-pb-module-wrap">
					'.$section_controls.'
					<pre class="shortcode">['.$m[2].$m[3].']</pre>
					<div class="be-pb-section-inner-wrap"><div class="be-pb-section">'.be_pb_do_shortcode($m[5]).'</div><a href="#" class="bluefoose-button-dark be-pb-add-row">+ Row</a><a href="#" class="bluefoose-button-dark be-pb-paste-row" data-shortcode-name="row">+ Paste Row Shortcode</a></div>
				    <pre class="shortcode">[/'.$m[2].']</pre>
				</div>';
	} elseif($m[2] == 'row') {
    	return '<div class="be-pb-row-wrap be-pb-element clearfix be-pb-module-wrap">
    				'.$row_controls.'
    				<pre class="shortcode">['.$m[2].$m[3].']</pre>
					<div class="be-pb-row be-pb-sortable clearfix">'.be_pb_do_shortcode($m[5]).'
					</div>
				 	<pre class="shortcode">[/'.$m[2].']</pre>
			</div>';		
	} elseif($m[2] == 'one_col' || $m[2] == 'one_half' || $m[2] == 'one_third' || $m[2] == 'one_fourth' || $m[2] == 'two_third' || $m[2] == 'three_fourth' || $m[2] == 'one_fifth') {
		return	'<div class="portlet be-pb-element be-pb-col-wrap '.$m[2].'" data-col-name="'.$m[2].'">
			<pre class="shortcode">['.$m[2].$m[3].']</pre>
			<div class="portlet-header column-header">
				<div class="left">
					Column
				</div>
				<div class="portlet-header-column-controls-wrap right"><span class="be-pb-control-icon icon-pencil icon-edit edit-shortcode  column-edit-control clear" title="Edit" data-shortcode="'.$m[2].'" data-action="edit"></span></div>
			</div>
			<div class="be-pb-column be-pb-shortcode-col">'.be_pb_do_shortcode($m[5]).'</div>
			<div class="be-pb-controls"><a class="mini-btn mini-btn-dark choose-shortcode" title="Add Module" role="button"><span class="btn-icon-plus"><i class="font-icon icon-plus"></i>Add</span></a><a class="mini-btn mini-btn-dark paste-shortcode" data-shortcode-name="module" title="Paste Module" role="button"><span class="btn-icon-plus"><i class="font-icon icon-upload"></i>Add</span></a></div>
			<pre class="shortcode test">[/'.$m[2].']</pre>
		</div>';
	} elseif(array_key_exists($m[2], $be_shortcode) && $be_shortcode[$m[2]]['type']== 'multi') {
		$hide = '';
		if(!array_key_exists('options', $be_shortcode[$m[2]]) && empty($be_shortcode[$m[2]]['options'])) {
			$hide = 'hidden';
		}

		return 	 '<div class="be-pb-multi-wrap be-pb-element toggled be-pb-module-wrap" data-shortcode="'.$m[2].'">
				<pre class="shortcode">['.$m[2].$m[3].']</pre>
				<div class="be-pb-multi-fields-header-wrap clearfix"><h4>'.$be_shortcode[$m[2]]['name'].'<span class="be-pb-control-icon icon-cancel-circled icon-delete icon-trash bottom-border" title="Delete"></span><span class="be-pb-control-icon icon-duplicate icon-book-open bottom-border" title="Duplicate"></span><span class="be-pb-control-icon icon-pencil edit-shortcode '.$hide.' clear" title="Edit" data-shortcode="'.$m[2].'" data-action="edit"></span><span class="be-pb-control-icon icon-eye" title="View"></span><span class="be-pb-control-icon icon-download copy-shortcode" title="Copy"></span></h4></div>
		 <div class="be-pb-multi-fields-wrap"><div class="be-pb-multi-fields be-pb-shortcode-col be-pb-sortable">'.be_pb_do_shortcode($m[5]).'
		 </div>
		 <div class="be-pb-controls"><a class="mini-btn mini-btn-dark add-multi-field" title="Add" role="button" data-single-field='.$be_shortcode[$m[2]]['single_field'].'><span class="btn-icon-plus"><i class="font-icon icon-plus"></i>Add</span></a><a class="mini-btn mini-btn-dark paste-shortcode" data-shortcode-name="multi-module" title="Paste Module" role="button"><span class="btn-icon-plus"><i class="font-icon icon-upload"></i>Add</span></a></div>
		 <pre class="shortcode">[/'.$m[2].']</pre></div></div>';
	} else  {
		return get_single_shortcode_block($m[2],$m[0]);
	}

}

add_filter( 'the_content', 'be_pb_content_filter',1);

function be_pb_content_filter($content){
	global $post;
	global $be_themes_data;
	$be_pb_disabled = get_post_meta( $post->ID, '_be_pb_disable', true );
    if( (!isset($be_pb_disabled) || false == $be_pb_disabled || $be_pb_disabled == 'no') && ( $post->post_type =='page' || $post->post_type =='portfolio') && ( isset( $be_themes_data['enable_pb'] ) && 1 == $be_themes_data['enable_pb'] ) ) {
		$be_pb_content = get_post_meta($post->ID,'_be_pb_content',true);
		$content = $be_pb_content;
	}
	return $content;
}
function sort_2d_asc($array, $key) {
	$temp = Array(); 
	foreach($array as &$ma) {
		$temp[] = &$ma[$key];
	}
	array_multisort($temp, $array);
	return $array;
}

?>