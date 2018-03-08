<?php
get_template_part('options/fields/color/field_color');	// Include Colorbox
get_template_part('options/fields/radio_img/field_radio_img');	// Include Select

class NHP_Options_skin extends NHP_Options{	
	
	
	function __construct($field = array(), $value = '', $parent = ''){
		
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		$this->parent = $parent;
	}//function
	
	

	function render(){
		
		if(!isset($this->value['skin'])){ $skin = NULL; }else{ $skin = $this->value['skin']; } //if cond "skin"
		if(!isset($this->value['color'])){ $color = NULL; }else{ $color = $this->value['color']; } //if cond "color"
		if(!isset($this->value['scheme'])){ $scheme = NULL; }else{ $scheme = $this->value['scheme']; } // if cond "scheme"
		
		
		$class = (isset($this->field['class']))?'class="'.$this->field['class'].'" ':'';
		echo '<input type="hidden" class="field-id" value="'.$this->field['id'].'">';
		echo '<input type="hidden" class="field-url" value="'.NHP_OPTIONS_URL.'">';
		echo '<input type="hidden" class="current-skin" value="'.$skin.'">';
			
		echo '<fieldset>';
			
			$radio = new NHP_Options_radio_img(array('id'=> $this->field['id'].'][skin' , 'options' => $this->field['skins'] ),$skin, $this->parent);	 // Call Color Box
			$radio->enqueue();
			$radio->render();

		echo '</fieldset>';
		
	}//function
	
	
	
	
	function enqueue(){

		wp_register_script( 'nhp-opts-field-skin-js', NHP_OPTIONS_URL.'fields/skin/field_skin.js', array('jquery') , true );
		wp_enqueue_script( 'nhp-opts-field-skin-js' );
		
	}//function

	
	function set_default_value($get_value){
		
		if(!isset($get_value)){
			$get_value = NULL;
		}
		return $get_value;
	}//function
	
}//class
?>