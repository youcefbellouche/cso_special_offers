<?php

/**
 *
 * Plugin Name: Cod Special Offers
 * Author: Youcef Bellouche
 * Author URI: https://www.facebook.com/bellou.fecuoy2000/
 * Version: 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// Define Constants
define( 'CSO_PLUGIN_VERSION', '1.0.0' );
define( 'CSO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'CSO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'CSO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

// Custom Cod Order  Form

require_once CSO_PLUGIN_DIR . 'inc/cod-order/cod-order-custom-form.php';


// CSO Enqueue Functions
require_once CSO_PLUGIN_DIR . 'inc/cso-enqueue/cso-enqueue.php';

// CSO Product Meta Box
require_once CSO_PLUGIN_DIR . 'inc/cod-product/cod-product-custom-meta.php';

// CSO Ajax Functions
require_once CSO_PLUGIN_DIR . 'inc/ajax/core-cso-ajax.php';

//CSO Order Creation
require_once CSO_PLUGIN_DIR.'inc/cod-order/cod-order-create.php';