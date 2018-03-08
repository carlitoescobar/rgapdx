<?php
class NHP_Options_pattern_button extends NHP_Options{	
	
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
		
		$field_id = preg_replace('#[^\w()/.%\-&]#',"", $this->field['id']);
		echo '<input type="button" id="'.$field_id.'" name="'.$this->args['opt_name'].'['.$this->field['id'].']" value="'.$this->field['value'].'" class=" pattern_button button-primary" />';
		
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <span class="description">'.$this->field['desc'].'</span>':'';

		echo '<div id="'.$field_id.'dialog" title="BEAT PATTERNS" class="pattern-wrapper">
					<img src="'.$this->field['url'].'" class="pattern-images" />		
				</div>';	
		
		
		
	}//function

	function enqueue(){

		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-dialog');

		
		wp_enqueue_script( 'pattern-button-js',NHP_OPTIONS_URL.'fields/pattern_button/field_pattern_button.js' );
		wp_enqueue_style( 'pattern-button-css',NHP_OPTIONS_URL.'fields/pattern_button/field_pattern_button.css' );		

	}
	
}//class
?>