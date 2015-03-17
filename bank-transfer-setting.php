<?php 

class BankTransferSetting {

  private $options;
  
  public function __construct() {
    add_action('admin_menu',  array( $this, 'add_plugin_page') );
    add_action('admin_init', array( $this, 'page_init' ) );
  }

  public function add_plugin_page() {
    add_options_page('Bank Transfer', 'Bank Transfer', 'manage_options', 'bank-transfer-setting-page.php',  array( $this, 'bank_transfer_setting_page' ) );
  }


  public function bank_transfer_setting_page(){
  // Set class property
    $this->options = get_option('bk_options');
    ?>
    <div class="wrap">
      <?php screen_icon(); ?>
      <h2>My Settings</h2>           
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
      'setting_section_id', // ID
      'My Custom Settings', // Title
      array( $this, 'print_section_info' ), // Callback
      'my-setting-admin' // Page
    );  


    add_settings_field(
      'email_to', 
      'Email To', 
      array( $this, 'email_to_callback' ), 
      'my-setting-admin', 
      'setting_section_id'
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
  
    if( isset( $input['email_to'] ) )
      $new_input['email_to'] = sanitize_text_field( $input['email_to'] );

    return $new_input;
  }

  /** 
   * Print the Section text
   */
  public function print_section_info()
  {
    print 'Enter your settings below:';
  }


  /** 
   * Get the settings option array and print one of its values
   */
  public function email_to_callback()
  {
    printf(
      '<input type="text" id="email_to" name="bk_options[email_to]" value="%s" />',
      isset( $this->options['email_to'] ) ? esc_attr( $this->options['email_to']) : ''
    );
  }

}

