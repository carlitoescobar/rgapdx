<?php
class NHP_Options_typo_preview extends NHP_Options{	
	
	function __construct($field = array(), $value ='', $parent){
		
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		$this->google_fonts = $parent->google_font;
	}//function
	
	
	function render(){

		// Reset Selected Fonts
		$fonts = null;
		update_option('be_themes_selected_fonts',$fonts);

		$values = $this->typo_values(); //Get The Value of Element's Value from function typo_values
		
		$this->field['options']['family'] = $values['family'];
		
		$class = (isset($this->field['class']))?$this->field['class']:'regular-text';
		
		echo '<div class="farb-popup-wrapper typo" >';
		
			echo '<input type="hidden" value="'.$this->field['id'].'" class="hidden-id">'; // ID
			echo '<input type="hidden" value="'.NHP_OPTIONS_URL.'fields/typo_preview/preview.php" class="hidden-url">'; //Iframe Url 

			echo '<select id="'.$this->field['id'].'family" name="'.$this->args['opt_name'].'['.$this->field['id'].'][family]" '.$class.'rows="6" class="font-family">';
				echo '<option value="" disabled="disabled"> Font Family </option>';
	 		// 	foreach($this->field['options']['family'] as $k => $v){
				// 	echo '<option value="default/'.$k.'" '.selected($this->value['family'], 'default/'.$k, false).'>'.$v.'</option>';
				// }//foreach

				// foreach($this->google_fonts->items as $cut){
				
				// 	foreach($cut->variants as $variant){
						
				// 		echo '<option value="google'.$cut->family.':'.$variant.'" '.selected($this->value['family'], 'google'.$cut->family.':'.$variant, false).'>'.$cut->family.' - '.$variant.'</option>';
				
				// 	}
				// }
				foreach ($this->google_fonts as $key => $value) {
					echo '<option value="'.$key.'">'.$value.'</option>';
				}

		
			echo '</select> <br />';
			echo '<iframe src="" id="'.$this->field['id'].'-preview"></iframe>';
			
			echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <span class="description">'.$this->field['desc'].'</span>':'';	

		
		echo '</div>'; // Field Type Wrapper
		
	}//function

	
	function typo_values(){
		$values = array();
		$values['family'] = array('Arial' => 'Arial' , 'Arial Black' => 'Arial Black' , 'Times New Roman' => 'Times New Roman' , 'Comic Sans MS' => 'Comic Sans MS' , 'Courier New' => 'Courier New' , 'Georgia' => 'Georgia' , 'Impact' => 'Impact' , 'Lucida Console' => 'Lucida Console' , 'Lucida Sans Unicode' => 'Lucida Sans Unicode' , 'Palatino Linotype' => 'Palatino Linotype' , 'Tahoma' => 'Tahoma' , 'Trebuchet MS' => 'Trebuchet MS' , 'Verdana' => 'Verdana' , 'MS Sans Serif' => 'MS Sans Serif' , 'MS Serif' => 'MS Serif');
		return $values;
	}

	
	function enqueue(){
		
		wp_enqueue_script( 'typo-js-preview',NHP_OPTIONS_URL.'fields/typo_preview/field_typo_preview.js');
  		wp_enqueue_style( 'typo-style-preview',NHP_OPTIONS_URL.'fields/typo/field_typo_preview.css' );  
	}//function

}//class
?>