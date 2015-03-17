<?php
/*
Plugin Name: Bank Transfer
Plugin URI: http://www.iampiya.com
Description: tag to show opening or closing your shop on e-commerce
Author: Nattawud Sinprasert (PiYA)
Author URI: http://www.iampiya.com
Version: 0.0.1
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


