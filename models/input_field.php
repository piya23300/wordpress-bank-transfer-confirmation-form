<?php 

/**
* input object
*/
class InputField
{
  protected $prefix_attr = '';
  protected $settings_data;
  public $setting_attr_names;
  public $label;
  public $value;

  function __construct($field_name, $settings=null)
  {
    $this->setting_attr_names['value'] = $this->prefix_attr.$field_name;
    $this->setting_attr_names['label'] = $this->prefix_attr.$field_name.'_label';

    if( $settings != null ) {
      $this->settings_data = $settings;

      $this->label = $this->get_value('label');
      $this->value = $this->get_value('value');
    }
    
  }

  protected function get_value($attr_type) {
    return $this->settings_data[$this->setting_attr_names[$attr_type]];
  }

  public function input_tag($options) {
    printf(
      '<input type="text" id="%s" name="bk_options[%s]" value="%s" />',
      $this->setting_attr_names['value'], $this->setting_attr_names['value'],
      !empty( $this->value ) ? esc_attr( $this->value ) : ''
    );
  }

  public function input_label_tag($options) {
    printf(
      '<input type="text" id="%s" name="bk_options[%s]" value="%s" />',
      $this->setting_attr_names['label'], $this->setting_attr_names['label'],
      !empty( $this->label ) ? esc_attr( $this->label ) : ''
    );
  }
}