<?php
/*
Plugin Name: Bank Transfer Confirmation Form
Plugin URI: http://www.iampiya.com
Description: Building confirmation payment form for e-commerce website that has direct bank payment.
Author: Nattawud Sinprasert (PiYA)
Author URI: http://www.iampiya.com
Version: 0.0.2
tags: confirm payment, payment, e-commerce, woo commerce
*/

/**
* 
*/

// foreach (glob('models/**/*') as $filename) require_once $filename;

require_once 'models/input_field.php';
require_once 'models/inputs/form_input_field.php';
require_once 'models/inputs/setting_input_field.php';
require_once 'models/setting.php';
require_once 'models/form.php';
require_once 'models/bank-transfer.php';

require_once 'bank-transfer-setting.php';
require_once 'confirm-payment-page.php';

add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );

if( is_admin() ) {
  $BankTransferSetting = new BankTransferSetting();
}


