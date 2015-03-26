<?php 

/**
* Setting Object
*/
class Setting {

  private $data;

  public $email_to;
  
  function __construct($data=null) {
    $this->data = $data;
    
    $this->email_to = new SettingInputField( 'email_to', $this->data );
  }

}