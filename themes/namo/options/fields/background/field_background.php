<?php
require_once(NHP_OPTIONS_DIR.'fields/color/field_color.php');	// Include Colorbox
require_once(NHP_OPTIONS_DIR.'fields/checkbox/field_checkbox.php');	// Include Chkbox
require_once(NHP_OPTIONS_DIR.'fields/select/field_select.php');	// Include Select
require_once(NHP_OPTIONS_DIR.'fields/img_select/field_img_select.php');	// Include Img Select
require_once(NHP_OPTIONS_DIR.'fields/upload/field_upload.php');	// Include Uploader
require_once(NHP_OPTIONS_DIR.'fields/slider/field_slider.php');	// Include Slider
require_once(NHP_OPTIONS_DIR.'fields/hidden/field_hidden.php');	// Include Hidden
class NHP_Options_background extends NHP_Options {
	function __construct($field = array(), $value ='', $parent){
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		$this->parent = $parent;
	}//function
	
	function render() {
		$class = (isset($this->field['class']))?$this->field['class']:'';
		$values = $this->background_values('value');
		$bgoptions = $this->background_values('bgoptions');
		$this->field['options']['recur'] = $values['recur'];  // Assign Select box values
		$this->field['options']['attach'] = $values['attach'];
		$this->field['options']['position'] = $values['position'];
		$chkbox_array = array('none' , 'scale' , 'custom'); // Checkboxes array 
		echo '<div class="background">'; // Set Initial value
			if(empty($this->value)) {
				$this->value = array();
				$this->value['background'] = Null;
				$this->value['patterncolor'] = Null;
				$this->value['patternrecur'] = Null;
				$this->value['patternattach'] = Null;
				$this->value['patternposition'] = Null;
				$this->value['bgdefault'] = Null;
				$this->value['color'] = Null;
			}
			$hidden_array1 = array(  'class' => "bgdefault" , 'id' => $this->field['id'].'][background' );	// Standard BG Value
			$hidden_field1 = new NHP_Options_hidden( $hidden_array1 , $this->value['bgdefault'] , $this->parent);	
			$hidden_field1->render();
			$hidden_array2 = array(  'class' => "field-id" , 'id' => "field-id" );
			$hidden_field2 = new NHP_Options_hidden( $hidden_array2 , $this->field['id'] , $this->parent);	// Field Id
			$hidden_field2->render();
			foreach($chkbox_array as $chkbox) {
				if(!isset($this->value[$chkbox]))
					$this->value[$chkbox] = 0; 
				if($chkbox == 'custom') { 
					$label = 'Custom Background';  
					$class = 'bg-hide-below'; 
				} else { 
					$label = 'Background '.ucfirst($chkbox);
				}
				$chkbox_array = array('id'=> $this->field['id'].']['.$chkbox , 'desc' => $label , 'class' => $class );
				$chkbox_field = new NHP_Options_checkbox( $chkbox_array, $this->value[$chkbox], $this->parent);	 // Call Chk Box
				$chkbox_field->render();
			}
			echo '<br/>';
			echo '<div class="basic-option">';
				foreach($this->field['defaults'] as $k => $v) {
					$hidden_pattern_values = '<input type="hidden" id="'.$this->field['id'].'-defaults-'.$k.'" value="';
					if(isset($v['color'])) { 
						$temp =$v['color'].'/';
					} else { 
						$temp =''.'/';
					}
					if(isset($v['recur'])) { 
						$temp .=$v['recur'].'/';
					} else { 
						$temp .=''.'/';
					}
					if(isset($v['attach'])) { 
						$temp .=$v['attach'].'/';
					} else { 
						$temp .=''.'/';
					}
					if(isset($v['position'])) { 
						$temp .=$v['position'].'/';
					} else { 
						$temp .=''.'/';
					}
					if(isset($v['opacity'])) { 
						$temp .=$v['opacity'].'/';
					} else { 
						$temp .=''.'/';
					}
					if(isset($v['scheme'])) { 
						$temp .=$v['scheme'];
					} else { 
						$temp .='';
					}
					$hidden_pattern_values .= $temp;
					$hidden_pattern_values .= '">';
					echo $hidden_pattern_values;
				}
				$img_select_array = array('id'=> $this->field['id'].'][bgdefault' , 'options' => $this->field['defaults'] , 'label' => 'Pattern' );
				$img_select_field = new NHP_Options_img_select( $img_select_array, $this->value['bgdefault'], $this->parent);	 // Call image select box
				$img_select_field->enqueue();
				$img_select_field->render();
			echo '</div>'; // "Basic options"
			echo '<div class="advance-option">';	
				$select_array = array( 'id' => $this->field['id'].'-bgpattern' , 'label' => 'Custom Pattern', 'name' => $this->field['id'].'][bgpattern' );
				$upload_field = new NHP_Options_upload( $select_array , $this->value['bgpattern'] , $this->parent);	 // Call Chk Box
				$upload_field->render();
			echo '</div>'; // Advance Option
			$color_picker = new NHP_Options_color(array('id'=> $this->field['id'].'][color' , 'label' => 'Background Color'),$this->value['color'], $this->parent);	 // Call Color Box
			$color_picker->enqueue();
			$color_picker->render();
			echo '<div id="'.$this->field['id'].'bgoptions" class="bgoptions-wrapper">';
				$i = 0;
				foreach($this->field['options'] as $key => $option) {
					if(!isset($this->value['pattern'.$key])) { 
						$this->value['pattern'.$key] = null; 
					}
					$select_array = array( 'options' => $this->field['options'][$key] , 'id' => $this->field['id'].']['.$key , 'label' => $bgoptions[$i] );
					if(!isset($this->value[$key])) { 
						$this->value[$key] = null; 
					}
					/*$select_field = new NHP_Options_select( $select_array , $this->value[$key] , $this->parent);	 // Call Chk Box
					$select_field->render();*/
					echo '<div class="select-wrapper">';
					$class = (isset($select_array['class'])) ? 'class="'.$select_array['class'].'" ' : ''; 
					$field_id = preg_replace('#[^\w()/.%\-&]#',"", $select_array['id']);
					if(isset($select_array['label'])) {
						echo '<label class="select-desc">'.$select_array['label'].'</label>';
					}
					echo '<select id="'. $field_id.'" name="'.$this->args['opt_name'].'['.$select_array['id'].']" '.$class.'rows="6" >';
						foreach($select_array['options'] as $k => $v) {
							if( isset($this->value[$key])) {
								$selected_value = $this->value[$key];
							} else {
								$selected_value = '';
							}
							echo '<option value="'.$k.'" '.selected($selected_value, $k, false).'>'.$v.'</option>';
						}
					echo '</select>';
					echo (isset($select_array['desc']) && !empty($select_array['desc']))?' <span class="description">'.$select_array['desc'].'</span>':'';
					echo '</div>';
					$i++;
				}		
			echo '</div>'; // bg options
			if(!isset($this->value['opacity'])){
				$this->value['opacity'] = -1;
			}	
			$slider_array = array('id'=> $this->field['id'] );
			$slider_field = new NHP_Options_slider( $slider_array, $this->value['opacity'], $this->parent);	 // Call Chk Box
			$slider_field->enqueue();
			$slider_field->render();
			echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <p class="description">'.$this->field['desc'].'</p>':'';
		echo '</div>'; // Advance Options
		unset($slider_field);
		unset($select_field);
		unset($color_picker);
		unset($img_select_field);
		unset($chkbox_field);
		unset($hidden_field2);
		unset($hidden_field1);
		unset($this);
	}//function
	
	function enqueue() {
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-slider');
		wp_register_script( 'nhp-opts-field-background-js',
			NHP_OPTIONS_URL.'fields/background/field_background.js', 
			array('jquery','jquery-ui-slider','jquery-ui-core','farbtastic','nhp-opts-field-img-select-js','nhp-opts-field-slider-js'), time(),
			true );
		wp_enqueue_script('nhp-opts-field-background-js');
		wp_register_style( 'background-style', NHP_OPTIONS_URL.'fields/background/field_background.css', array(), time(), 'all' );  
		wp_enqueue_style('background-style');
	}//function


	public function background_values($options){  // Function returns the values of select boxes in background field type
		$values = array(); $bgoptions = array();
		$values['recur'] = array('repeat' => 'Repeat' , 'repeat-x' => 'Repeat-x' , 'repeat-y' => 'Repeat-y' , 'no-repeat' => 'No-Repeat' , 'inherit' => 'Inherit');
		$values['position'] = array('left top' => 'Left Top','left center' => 'Left Center','left bottom' => 'Left Bottom','right top' => 'Right Top','right center' => 'Right Center','right bottom' => 'Right Bottom','center top' => 'Center Top','center center' => 'Center Center','center bottom' => 'Center Bottom');
		$values['attach'] = array('scroll' => 'Scroll' , 'fixed' => 'Fixed' );
		$bgoptions = array('Pattern Repeat' , 'Pattern Position' , 'Pattern Alignment');
		switch ($options) {
			case 'value':
				return $values;
				break;
			
			default:
				return $bgoptions;
				break;
		}
	}
}//class
?>

