<?php 

class BankTransferSetting {

  private $options;

  private $settings;
  private $form;
  
  public function __construct() {
    $this->options = get_option('bk_options');

    $this->settings = new Setting($this->options);
    $this->form = new Form($this->options);

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
      $this->settings->email_to->setting_attr_names['value'], 
      'Email To', 
      array( $this->settings->email_to, 'input_tag' ),
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
      $this->form->name->setting_attr_names['label'], 
      'Name', 
      array( $this->form->name, 'input_label_tag' ), 
      'my-setting-admin', 
      'form_setting_id'
    );

    add_settings_field(
      $this->form->email->setting_attr_names['label'], 
      'Email', 
      array( $this->form->email, 'input_label_tag' ),  
      'my-setting-admin', 
      'form_setting_id'
    );

    add_settings_field(
      $this->form->telephone->setting_attr_names['label'], 
      'Telephone', 
      array( $this->form->telephone, 'input_label_tag' ),  
      'my-setting-admin', 
      'form_setting_id'
    );

    add_settings_field(
      $this->form->order_number->setting_attr_names['label'], 
      'Order Number', 
      array( $this->form->order_number, 'input_label_tag' ),  
      'my-setting-admin', 
      'form_setting_id'
    );

    add_settings_field(
      $this->form->bank->setting_attr_names['label'], 
      'Bank', 
      array( $this->form->bank, 'input_label_tag' ),  
      'my-setting-admin', 
      'form_setting_id'
    );

    add_settings_field(
      $this->form->transfered_at->setting_attr_names['label'], 
      'Transfered At', 
      array( $this->form->transfered_at, 'input_label_tag' ),  
      'my-setting-admin', 
      'form_setting_id'
    );

    add_settings_field(
      $this->form->amount->setting_attr_names['label'], 
      'Amount', 
      array( $this->form->amount, 'input_label_tag' ),  
      'my-setting-admin', 
      'form_setting_id'
    );

    add_settings_field(
      $this->form->submit->setting_attr_names['label'], 
      'Submit', 
      array( $this->form->submit, 'input_label_tag' ),  
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

    if( isset( $input[$this->form->name->setting_attr_names['label']] ) )
      $new_input[$this->form->name->setting_attr_names['label']] = sanitize_text_field( $input[$this->form->name->setting_attr_names['label']] );
    
    if( isset( $input[$this->form->email->setting_attr_names['label']] ) )
      $new_input[$this->form->email->setting_attr_names['label']] = sanitize_text_field( $input[$this->form->email->setting_attr_names['label']] );
    
    if( isset( $input[$this->form->telephone->setting_attr_names['label']] ) )
      $new_input[$this->form->telephone->setting_attr_names['label']] = sanitize_text_field( $input[$this->form->telephone->setting_attr_names['label']] );
    
    if( isset( $input[$this->form->order_number->setting_attr_names['label']] ) )
      $new_input[$this->form->order_number->setting_attr_names['label']] = sanitize_text_field( $input[$this->form->order_number->setting_attr_names['label']] );
    
    if( isset( $input[$this->form->bank->setting_attr_names['label']] ) )
      $new_input[$this->form->bank->setting_attr_names['label']] = sanitize_text_field( $input[$this->form->bank->setting_attr_names['label']] );
    
    if( isset( $input[$this->form->transfered_at->setting_attr_names['label']] ) )
      $new_input[$this->form->transfered_at->setting_attr_names['label']] = sanitize_text_field( $input[$this->form->transfered_at->setting_attr_names['label']] );
    
    if( isset( $input[$this->form->amount->setting_attr_names['label']] ) )
      $new_input[$this->form->amount->setting_attr_names['label']] = sanitize_text_field( $input[$this->form->amount->setting_attr_names['label']] );

    if( isset( $input[$this->form->submit->setting_attr_names['label']] ) )
      $new_input[$this->form->submit->setting_attr_names['label']] = sanitize_text_field( $input[$this->form->submit->setting_attr_names['label']] );

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

