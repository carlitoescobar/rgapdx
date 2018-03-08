<?php
class NHP_Options_widget_color extends NHP_Options{	
	
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
		
		$array = array('bg_color','color','border_color');

		$class = (isset($this->field['class']))?$this->field['class']:''; $field_id = preg_replace('#[^\w()/.%\-&]#',"", $this->field['id']);

		
		if(!isset($this->value['transparant']))
			$this->value['transparant'] = 0;
		echo '<input type="checkbox" id="'.$field_id.'_transparant" name="'.$this->args['opt_name'].'['.$this->field['id'].'][transparant]" value="1" class="'.$class.'" '.checked($this->value['transparant'], '1', false).' /><label for="'.$field_id['transparant'].'">  No Border ?  </label>';
		echo '<br/></br>';
		echo '<div class="widget-color background">';
		foreach($array as $key){
			echo '<div class="farb-popup-wrapper widget_color_picker" >';
			if(!isset($this->value[$key])){ $this->value[$key] = '#000000'; }
				echo '<label>'.str_replace('_', ' ', $key).'</label>:';
				echo '<input type="text" id="'.$field_id.'_'.$key.'" name="'.$this->args['opt_name'].'['.$this->field['id'].']['.$key.']" value="'.$this->value[$key].'" class="'.$class.' popup-colorpicker" style="width:70px;"/>';
				echo '<div class="farb-popup"><div class="farb-popup-inside"><div id="'.$field_id.'_'.$key.'picker" class="color-picker"></div></div></div>  ';	
			echo '</div>';

		}
		
		if(!isset($this->value['opacity'])){
						$this->value['opacity'] = 0;
		}
			echo '<p>
					<label for="opacity">Opacity:</label>
					<input type="text" class="opacity" style="border:0; color:#f6931f; font-weight:bold;" />
					<input type="hidden" name="'.$this->args['opt_name'].'['.$this->field['id'].'][opacity]" value="'.$this->value['opacity'].'" id="'.$this->field['id'].'opacity" class="opacity-value" />
				</p>
				<div id="'.$this->field['id'].'slider" class="slider"></div><br/>';
		echo '</div>';

		echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <span class="description">'.$this->field['desc'].'</span>':'';
				
	}//function
	
	
	/**
	 * Enqueue Function.
	 *
	 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
	 *
	 * @since NHP_Options 1.0
	*/
	function enqueue(){
		
		wp_enqueue_script('nhp-opts-field-color-js');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-slider');
		
	}//function
	
}//class
?>