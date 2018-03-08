<?php
class NHP_Options_img_select extends NHP_Options{	
	
	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since NHP_Options 1.0
	*/
	function __construct($field = array(), $value ='', $parent){
		
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		//$this->render();
		
	}//function
	


	/**
	 * Field Render Function.
	 *
	 * Takes the vars and outputs the HTML for the field in the settings
	 *
	 * @since NHP_Options 1.0
	*/
	function render(){
		
		$class = (isset($this->field['class']))?'class="'.$this->field['class'].'" ':''; $field_id = preg_replace('#[^\w()/.%\-&]#',"", $this->field['id']);
		
		if(isset($this->field['label'])){ echo '<label class="img-select-label">'.$this->field['label'].'</label>'; }

		echo '<select id="'.$field_id.'" name="'.$this->args['opt_name'].'['.$this->field['id'].']" '.$class.' class="be-img-select">';
			
			foreach($this->field['options'] as $k => $v){
				
				echo '<option value="'.$k.'" '.selected($this->value, $k, false).' title="'.$v['img'].'">'.$v['title'].'</option>';
				
			}//foreach

		echo '</select>';

		echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <span class="description">'.$this->field['desc'].'</span>':'';
		
	}//function

	function enqueue(){
		
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('dd-js',NHP_OPTIONS_URL.'fields/img_select/stylish_dropdown.js');
		wp_enqueue_script('nhp-opts-field-img-select-js',NHP_OPTIONS_URL.'fields/img_select/field_img_select.js', 
			array('jquery'),
			time(),
			true);
		
		wp_enqueue_style( 'dd-css',NHP_OPTIONS_URL.'fields/img_select/stylish_dropdown.css'); 
		
	}//function
	
}//class
?>