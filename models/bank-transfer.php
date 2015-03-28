<?php 
/**
* Bank Transfer Model
*/
class BankTransfer {

  public $settings;

  public $order_number;
  public $email;
  public $telephone;
  public $contact_name;
  public $bank;
  public $amount;
  public $transfered_at;

  public $email_to;

  public $error_messages;
  public $email_sent = false;

  public function __construct( $args ) {
    $this->settings = get_option('bk_options');

    // setting email to
    $setting_email_to = new SettingInputField( 'email_to', $this->settings );
    $this->email_to = !empty( $setting_email_to->value ) ? $setting_email_to->value : get_bloginfo('admin_email');

    // setting field for report
    $this->order_number = $this->init_params( "order_number", $args );
    $this->email = $this->init_params( "email", $args );
    $this->telephone = $this->init_params( "telephone", $args );
    $this->contact_name = $this->init_params( "contact_name", $args );
    $this->bank = $this->init_params( "bank", $args );
    $this->amount = $this->init_params( "amount", $args );
    $this->transfered_at = $this->init_params( "transfered_at", $args );
  }

  function valid() {
    $this->param_required("contact_name");
    $this->valid_email("email");
    $this->param_required("order_number");
    $this->param_required("telephone");
    $this->param_required("bank");
    $this->param_required("transfered_at");
    $this->param_required("amount");

    return empty( $this->error_messages ) ? true : false;
  }

  public function send_email() {
    if( $this->valid() ) {
      $subject = "[Bank Transfer] Order Number #$this->order_number";
      $body = "
                Order Number: $this->order_number \n
                Name: $this->contact_name \n
                email: $this->email \n
                telephone: $this->telephone \n
                bank: $this->bank \n
                transfered_at: $this->transfered_at \n
                amount: $this->amount \n
              ";
      $headers = 'From: Bank Transfer Plugin <'.get_bloginfo('admin_email').'>' . "\r\n" . 'Reply-To: ' . $emailTo;

      wp_mail($this->email_to, $subject, $body, $headers);
      $this->email_sent = true;
    } else {
      $this->email_sent = false;
    }
  }

  private function param_required( $param_name ) {
    if( $this->$param_name == '' || $this->$param_name == null ) {
      $this->error_messages[$param_name] = 'required!';
    }
  }

  private function valid_email( $param_name ) {
    $email_address = $this->$param_name;
    if( !filter_var( $email_address, FILTER_VALIDATE_EMAIL ) ) {
      $this->error_messages[$param_name] = 'incorrect email pattern!';
    }
  }

  private function init_params( $param_name, $params ) {
    return array_key_exists( $param_name, $params ) ? $params[$param_name] : '';
  }

}
