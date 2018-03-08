<?php
class NHP_Options_be_checkbox extends NHP_Options{	
	
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
		
		$class = (isset($this->field['class']))?$this->field['class']:''; $field_id = preg_replace('#[^\w()/.%\-&]#',"", $this->field['id']);
		
		echo '<input type="checkbox" id="'.$field_id.'" name="'.$this->args['opt_name'].'['.$this->field['id'].']" value="1" class="on-off-button '.$class.'" checked/>';
		
		echo ($this->field['desc'] != '')?' <label for="'. $field_id.'">':'';

		echo (isset($this->field['desc']) && !empty($this->field['desc']))?' '.$this->field['desc'].'</label>':'';
		
	}//function

	function enqueue(){
		wp_register_script( 'nhp-jquery-chkbox-js', NHP_OPTIONS_URL.'fields/be_checkbox/jquery.checkbox.js', array( 'jquery' ));
		wp_enqueue_script( 'nhp-jquery-chkbox-js' );
		wp_register_script( 'nhp-be-chkbox-js', NHP_OPTIONS_URL.'fields/be_checkbox/field_be_checkbox.js', array( 'nhp-jquery-chkbox-js' ));
		wp_enqueue_script( 'nhp-be-chkbox-js' );

		wp_register_style('nhp-be-chkbox-css',NHP_OPTIONS_URL.'fields/be_checkbox/jquery.checkbox.css');
		wp_enqueue_style('nhp-be-chkbox-css');

	}
	
	
}//class
?>