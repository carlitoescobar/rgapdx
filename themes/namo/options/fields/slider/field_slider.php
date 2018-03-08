<?php
class NHP_Options_slider extends NHP_Options{	
	
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
		
		$field_id = preg_replace('#[^\w()/.%\-&]#',"", $this->field['id']);

		if(!isset($this->value))
			$this->value = 0;
		
		echo '<p>
				<label for="opacity">Background Opacity:</label>
				<input type="text" class="opacity '.$class.'" style="border:0; color:#f6931f; font-weight:bold;" />
			</p>
			<div class="slider" id="'.$field_id.'slider"></div> 
			<input type="hidden" name="'.$this->args['opt_name'].'['.$this->field['id'].'][opacity]" value="'.$this->value.'" id="'.$field_id.'opacity" class="opacity-value" />';
		
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <span class="description">'.$this->field['desc'].'</span>':'';
		
	}//function

	function enqueue(){
		
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-slider');
		wp_register_script( 'nhp-opts-field-slider-js',
			NHP_OPTIONS_URL.'fields/slider/field_slider.js', 
			array('jquery','jquery-ui-slider','jquery-ui-core'), time(),
			true );
		wp_enqueue_script('nhp-opts-field-slider-js');
		wp_register_style( 'slider-style', NHP_OPTIONS_URL.'fields/slider/field_slider.css', array(), time(), 'all' );  
		wp_enqueue_style('slider-style');
	
	}//function

	
	
}//class
?>