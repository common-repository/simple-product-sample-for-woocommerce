<?php
/**
 * Plugin Name: Simple Product Sample for WooCommerce
 * Plugin URI: https://mci-desarrollo.es/simple-product-sample-pro/?lang=en
 * Author: MCI Desarrollo
 * Version: 2.4.0
 * Author URI: https://mci-desarrollo.es
 * Text Domain: simple-product-sample
 * Domain Path: /languages
 * Description: Add a button to "Request sample" on the WooCommerce product page. It is possible to activate the sample and configure its price for each product.
 * Also Customize the button's text, the button's background, text, and border colors by viewing the changes in a button preview.
 **/
if ( !defined( 'ABSPATH' ) ) {exit;}

//=======================================================================
define( 'MCISPS_VERSION', '2.4.0' );
define( 'MCISPS_REAL_ENVIRONMENT', true );
//=======================================================================

define( 'MCISPS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'MCISPS_PLUGIN_BASE_DIR', plugin_basename( __DIR__ ) );
define( 'MCISPS_PLUGIN_BASE_URL', plugin_basename( __FILE__ ) );
define( 'MCISPS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

////////////////////////////////////////////////////////////////////////////
//Load the plugin
require_once MCISPS_PLUGIN_PATH . 'includes/master.php';
$mcisps_master = new McispsMaster();
$mcisps_master->init();

//=========================================================================
//Includes activate functions
function mcisps_activate()
{
    require_once MCISPS_PLUGIN_PATH . 'includes/activate.php';
    $mcisps_activate = new McispsActivate();
    $mcisps_activate->init();
}

register_activation_hook( __FILE__, 'mcisps_activate' );
//=========================================================================
//Execute activation if the version is different
if ( MCISPS_VERSION != get_option( 'mcisps_version' ) ) {
    mcisps_activate();
}

//=========================================================================
//Includes uninstall function
function mcisps_uninstall()
{
    require_once MCISPS_PLUGIN_PATH . 'includes/mcisps_uninstall.php';
    new McispsUninstall();
}

register_uninstall_hook( __FILE__, 'mcisps_uninstall' );

//==========================================================================
