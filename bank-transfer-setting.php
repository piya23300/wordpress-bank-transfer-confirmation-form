<?php 

require_once "models/setting_input_field.php";
require_once "models/form_input_field.php";

class BankTransferSetting {

  private $options;

  private $setting_email_to;
  private $input_name;
  private $input_email;
  private $input_telephone;
  private $input_order_number;
  private $input_bank;
  private $input_transfered_at;
  private $input_amount;
  
  public function __construct() {
    $this->options = get_option('bk_options');

    $this->setting_email_to = new SettingInputField( 'email_to', $this->options);

    $this->input_name = new FormInputField( 'name', $this->options);
    $this->input_email = new FormInputField( 'email', $this->options);
    $this->input_telephone = new FormInputField( 'telephone', $this->options);
    $this->input_order_number = new FormInputField( 'order_number', $this->options);
    $this->input_bank = new FormInputField( 'bank', $this->options);
    $this->input_transfered_at = new FormInputField( 'transfered_at', $this->options);
    $this->input_amount = new FormInputField( 'amount', $this->options);

    add_action('admin_menu',  array( $this, 'add_plugin_page') );
    add_action('admin_init', array( $this, 'page_init' ) );
  }

  public function add_plugin_page() {
    add_options_page('Bank Transfer', 'Bank Transfer', 'manage_options', 'bank-transfer-setting-page.php',  array( $this, 'bank_transfer_setting_page' ) );
  }


  public function bank_transfer_setting_page(){
?>
    <div class="wrap">
      <?php screen_icon(); ?>
      <form method="post" action="options.php">
      <?php
        // This prints out all hidden setting fields
        settings_fields( 'bk_option_group' );   
        do_settings_sections( 'my-setting-admin' );
        submit_button(); 
      ?>
      </form>
    </div>
    <?php
  }

  /**
   * Register and add settings
   */
  public function page_init()
  {        
    register_setting(
      'bk_option_group', // Option group
      'bk_options', // Option name
      array( $this, 'sanitize' ) // Sanitize
    );

    add_settings_section(
      'general_setting_id', // ID
      'Settings', // Title
      array( $this, 'print_section_info' ), // Callback
      'my-setting-admin' // Page
    );  


    add_settings_field(
      $this->setting_email_to->setting_attr_names['value'], 
      'Email To', 
      array( $this->setting_email_to, 'input_tag' ),
      'my-setting-admin', 
      'general_setting_id'
    );   

    add_settings_section(
      'form_setting_id', // ID
      'Form Settings', // Title
      array( $this, 'print_section_info' ), // Callback
      'my-setting-admin' // Page
    );

    add_settings_field(
      $this->input_name->setting_attr_names['label'], 
      'Name', 
      array( $this->input_name, 'input_label_tag' ), 
      'my-setting-admin', 
      'form_setting_id'
    );

    add_settings_field(
      $this->input_email->setting_attr_names['label'], 
      'Email', 
      array( $this->input_email, 'input_label_tag' ),  
      'my-setting-admin', 
      'form_setting_id'
    );

    add_settings_field(
      $this->input_telephone->setting_attr_names['label'], 
      'Telephone', 
      array( $this->input_telephone, 'input_label_tag' ),  
      'my-setting-admin', 
      'form_setting_id'
    );

    add_settings_field(
      $this->input_order_number->setting_attr_names['label'], 
      'Order Number', 
      array( $this->input_order_number, 'input_label_tag' ),  
      'my-setting-admin', 
      'form_setting_id'
    );

    add_settings_field(
      $this->input_bank->setting_attr_names['label'], 
      'Bank', 
      array( $this->input_bank, 'input_label_tag' ),  
      'my-setting-admin', 
      'form_setting_id'
    );

    add_settings_field(
      $this->input_transfered_at->setting_attr_names['label'], 
      'Transfered At', 
      array( $this->input_transfered_at, 'input_label_tag' ),  
      'my-setting-admin', 
      'form_setting_id'
    );

    add_settings_field(
      $this->input_amount->setting_attr_names['label'], 
      'Amount', 
      array( $this->input_amount, 'input_label_tag' ),  
      'my-setting-admin', 
      'form_setting_id'
    );
  }

  /**
   * Sanitize each setting field as needed
   *
   * @param array $input Contains all settings fields as array keys
   */
  public function sanitize( $input )
  {
    $new_input = array();
    
    if( isset( $input['setting_email_to'] ) )
      $new_input['setting_email_to'] = sanitize_text_field( $input['setting_email_to'] );

    if( isset( $input[$this->input_name->setting_attr_names['label']] ) )
      $new_input[$this->input_name->setting_attr_names['label']] = sanitize_text_field( $input[$this->input_name->setting_attr_names['label']] );
    
    if( isset( $input[$this->input_email->setting_attr_names['label']] ) )
      $new_input[$this->input_email->setting_attr_names['label']] = sanitize_text_field( $input[$this->input_email->setting_attr_names['label']] );
    
    if( isset( $input[$this->input_telephone->setting_attr_names['label']] ) )
      $new_input[$this->input_telephone->setting_attr_names['label']] = sanitize_text_field( $input[$this->input_telephone->setting_attr_names['label']] );
    
    if( isset( $input[$this->input_order_number->setting_attr_names['label']] ) )
      $new_input[$this->input_order_number->setting_attr_names['label']] = sanitize_text_field( $input[$this->input_order_number->setting_attr_names['label']] );
    
    if( isset( $input[$this->input_bank->setting_attr_names['label']] ) )
      $new_input[$this->input_bank->setting_attr_names['label']] = sanitize_text_field( $input[$this->input_bank->setting_attr_names['label']] );
    
    if( isset( $input[$this->input_transfered_at->setting_attr_names['label']] ) )
      $new_input[$this->input_transfered_at->setting_attr_names['label']] = sanitize_text_field( $input[$this->input_transfered_at->setting_attr_names['label']] );
    
    if( isset( $input[$this->input_amount->setting_attr_names['label']] ) )
      $new_input[$this->input_amount->setting_attr_names['label']] = sanitize_text_field( $input[$this->input_amount->setting_attr_names['label']] );

    return $new_input;
  }

  /** 
   * Print the Section text
   */
  public function print_section_info()
  {
    // print 'Enter your settings below:';
  }


  /** 
   * Get the settings option array and print one of its values
   */
  public function input_field($options) {
    printf(
      '<input type="text" id="%s" name="bk_options[%s]" value="%s" />',
      $options['attr_name'], $options['attr_name'],
      isset( $this->options[$options['attr_name']] ) ? esc_attr( $this->options[$options['attr_name']]) : ''
    );
  }

}

