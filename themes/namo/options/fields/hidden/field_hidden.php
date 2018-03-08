<?php
class NHP_Options_hidden extends NHP_Options{	
	
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
		
		$class = (isset($this->field['class']))?$this->field['class']:'regular-hidden'; $field_id = preg_replace('#[^\w()/.%\-&]#',"", $this->field['id']);
		
		echo '<input type="hidden" id="'.$field_id.'" name="'.$this->args['opt_name'].'['.$this->field['id'].']" value="'.esc_attr($this->value).'" class="'.$class.'" />';
		
		
	}//function
	
}//class
?>