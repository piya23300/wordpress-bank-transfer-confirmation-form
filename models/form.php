<?php 

/**
* Form Object
*/
class Form {

  private $data;

  public $contact_name;
  public $email;
  public $telephone;
  public $order_number;
  public $bank;
  public $transfered_at;
  public $amount;
  public $submit;
  
  function __construct($data=null) {
    $this->data = $data;
    
    $this->contact_name = new FormInputField( 'contact_name', $this->data);
    $this->email = new FormInputField( 'email', $this->data);
    $this->telephone = new FormInputField( 'telephone', $this->data);
    $this->order_number = new FormInputField( 'order_number', $this->data);
    $this->bank = new FormInputField( 'bank', $this->data);
    $this->transfered_at = new FormInputField( 'transfered_at', $this->data);
    $this->amount = new FormInputField( 'amount', $this->data);
    $this->submit = new FormInputField( 'submit', $this->data);
  }

}