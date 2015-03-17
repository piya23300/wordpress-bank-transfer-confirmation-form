<?php 
/**
* Bank Transfer Model
*/
class BankTransfer {

  public $settings;
  public $order_number;
  public $telephone;
  public $contact_name;
  public $bank_account;
  public $amount;
  public $transfer_at;

  public $error_messages;
  public $email_sent = false;

  public function __construct( $args ) {
    add_action( 'plugins_loaded', array( $this, 'send_email') );

    $this->settings = get_option('bk_options');

    $this->order_number = $this->init_params( "order_number", $args );
    $this->telephone = $this->init_params( "telephone", $args );
    $this->contact_name = $this->init_params( "contact_name", $args );
    $this->bank_account = $this->init_params( "bank_account", $args );
    $this->amount = $this->init_params( "amount", $args );
    $this->transfer_at = $this->init_params( "transfer_at", $args );
  }

  function valid() {
    $this->param_required("order_number");
    $this->param_required("telephone");
    $this->param_required("contact_name");
    $this->param_required("bank_account");
    $this->param_required("amount");
    $this->param_required("transfer_at");

    return empty( $this->error_messages ) ? true : false;
  }

  public function send_email() {
    if( $this->valid() ) {
      // $emailTo = get_option('tz_email');
      $emailTo = $this->settings['email_to'];
      $subject = "[Bank Transfer] Order Number #$this->order_number";
      $body = "
                Order Number: $this->contact_name \n
                Name: $this->contact_name \n
                telephone: $this->telephone \n
                bank_account: $this->bank_account \n
                transfer_at: $this->transfer_at \n
                amount: $this->amount \n
              ";
      $headers = 'From: reporting bank transfer <'.get_bloginfo('admin_email').'>' . "\r\n" . 'Reply-To: ' . $emailTo;

      wp_mail($emailTo, $subject, $body, $headers);
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

  private function init_params( $param_name, $params ) {
    return array_key_exists( $param_name, $params ) ? $params[$param_name] : '';
  }

}
