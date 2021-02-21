<?php
    /**
     * Plugin Name: Woocommerce Product Extender
     * Description: this plugin will add details related to woocommerce products.
     * Plugin URI : https://www.example.com
     * Version: 1.0.0
     * Author: XfinitySoft
     * Author URI: https://www.example.com
     * Text Domain: wc-pe
    */
    // Exit if directly access
    if ( !defined( 'ABSPATH' ) ) {
    exit;
    }
    // Define  PCF_PLUGIN_FILE
    if ( ! defined( 'WC_PE_PATH' ) ) {
        define( 'WC_PE_PATH' , __FILE__ );
    }
    /**
    *  including main class located : includes/class-wcpe-main.php
    */
     
    // define function for deactivation hook
    function wpce_plugin_deactivate(){
        // deactivating own plugin
        deactivate_plugins( __FILE__ );   
    }
    // define function for register activation hook
    function wpce_check_woocommerce(){
        // check if woocommerce plugin is active or not
        // if woocommerce is not active then deactivate own plugin
        if ( ! class_exists( 'woocommerce' ) ) { 
           register_deactivation_hook( __FILE__ , "wpce_plugin_deactivate" );
           echo "<strong>Please activate / install  woocommerce plugin first!. Then try to activate Woocommerce Product Extender plugin!</strong>";
           exit; 
        }    
    }
    
    register_activation_hook( __FILE__ , "wpce_check_woocommerce"  ); 

    if ( ! class_exists( 'Wcpe_Main_Class' ) ) {
        include_once dirname( __FILE__ ) . '/includes/classes/class-wcpe-main.php';
        $object_wcpe_class = new Wcpe_Main_Class;
    }
