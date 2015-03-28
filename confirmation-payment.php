<?php
/*
Plugin Name: Bank Transfer Confirmation Form
Plugin URI: http://www.iampiya.com
Description: Building confirmation payment form for e-commerce website that has direct bank payment.
Author: Nattawud Sinprasert (PiYA)
Author URI: http://www.iampiya.com
Version: 0.0.3
tags: confirm payment, payment, e-commerce, woo commerce
*/

/**
* 
*/


define( "BCF_PATH", plugin_dir_path( __FILE__ ) );

foreach ( glob( BCF_PATH . "models/*.php" ) as $file ) require_once $file;
foreach ( glob( BCF_PATH . "models/**/*.php" ) as $file ) require_once $file;

require_once 'bank-transfer-setting.php';
require_once 'confirm-payment-page.php';

add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );
add_action( 'plugins_loaded', array( 'Shortcode', 'get_instance' ) );


if( is_admin() ) {
  $BankTransferSetting = new BankTransferSetting();
}


