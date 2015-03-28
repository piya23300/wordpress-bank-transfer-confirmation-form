<?php 

/**
* Shortcode Object
*/
class Shortcode {

  public $BankTransfer;
  public $Form;

  /**
   * A reference to an instance of this class.
   */
  private static $instance;

  /**
   * Returns an instance of this class. 
   */
  public static function get_instance() {

    if( null == self::$instance ) {
      self::$instance = new Shortcode();
    } 

    return self::$instance;
  }
  
  public function __construct() {
    add_shortcode('bank_confirmation_form', array($this, 'bank_confirmation_form'));
  }

  public function bank_confirmation_form() {
    var_dump( $_POST );
    $this->BankTransfer = new BankTransfer( $_POST );
    $this->Form = new Form( get_option('bk_options') );
    if( isset($_POST['submitted']) && $_POST['submitted'] == true ) {
      $this->BankTransfer->send_email();
    }
    return $this->form_tag();
  }

  private function form_tag() {
    $html = "";
    if( !$this->BankTransfer->email_sent ) {
      $html .= $this->invalid_form();
      $html .= "<form action=\"". get_permalink() . "\" id=\"contactForm\" method=\"post\">";
      $html .= $this->input_group('name');
      $html .= $this->input_group('email');
      $html .= $this->input_group('telephone');
      $html .= $this->input_group('order_number');
      $html .= $this->input_group('bank');
      $html .= $this->input_group('transfered_at');
      $html .= $this->input_group('amount');
      $html .= $this->submit_tag($this->Form->submit->label);
      $html .= "</form>";
    } else {
      $html = $this->successfuly_send_email();
    }
    return $html;
  }

  private function input_group($attr_name) {
    $id = $this->Form->$attr_name->id;
    $display_label = $this->Form->$attr_name->label;

    $html = '<div>';
    $html .= $this->label_tag($display_label, $id) . $this->input_tag($id);
    $html .= '</div>';
    return $html;
  }

  private function label_tag($display_label, $for=null) {
    return '<label for="'.$for.'">'.$display_label.'</label>';
    
  }

  private function input_tag($attr_name, $value=null, $klass=null) {
    $html = '<input type="text" name="'.$attr_name.'" id="'.$attr_name.'" value="'.$value.'" class="'.$kalss.'" />';

    if( isset($this->BankTransfer->error_messages['amount'])) {
      $html .= '<span class="error">'.$this->BankTransfer->error_messages['amount'].'</span>';
    }
    return $html;
  }

  private function submit_tag($display, $klass=null) {
    $display = !empty( $display ) ? $display : 'Submit';
    $html = '<div><div>';
    $html .= '<button type="submit" class="'.$klass.'">'.$display.'</button>';
    $html .= '<input type="hidden" name="submitted" id="submitted" value="true" />';
    $html .= '</div></div>';
    return $html;
  }

  private function successfuly_send_email() {
    $html = '<div class="thanks">
                <p>Thanks, your email was sent successfully.</p>
              </div>';
    return $html;
  }

  private function invalid_form() {
    $html = "";
    if( !empty($this->BankTransfer->error_messages) ) {
      $html .= '<p class="error">Sorry, an error occured.<p>';
    }
    return $html;
  }
}


