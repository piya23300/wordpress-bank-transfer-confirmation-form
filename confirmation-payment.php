<?php
/*
Plugin Name: Confirmation Payment Form
Plugin URI: http://www.iampiya.com
Description: form for confirm payment page
Author: Nattawud Sinprasert (PiYA)
Author URI: http://www.iampiya.com
Version: 0.0.1
tags: confirm payment, payment, e-commerce, woo commerce
*/

/**
* 
*/
require 'bank-transfer-setting.php';
require 'confirm-payment-page.php';

add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );

if( is_admin() ) {
  $BankTransferSetting = new BankTransferSetting();
}


