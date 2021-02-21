<?php
    /**
     *  class-wcpe-main.php
     */
    // Exit if directly access
    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }
    /**
    * Define Class PCF_Main
    */
    class Wcpe_Main_Class {
        public function __construct(){
            $this->wcpe_constants(); // calling method for defining constants
            $this->wcpe_include_files(); // calling method for including files
            $this->wcpe_hooks();     // hooks initilization  
            $this->wcpe_check_selected_options();      
        }

        // defineing constants
        public function wcpe_constants(){
            define( 'WC_PE_ABSPATH' , dirname( WC_PE_PATH ) );
            define( 'WC_PE_BASENAME' , plugin_basename( WC_PE_PATH ) );
        }

        // calling method for including files
        public function wcpe_include_files(){
            // including class for setting up all hooks functions and other formalities
            // PATH : wc-product-extender/includes/class-wepe-setup.php 
            include_once WC_PE_ABSPATH . '/includes/classes/class-wcpe-setup.php';
            // including templates file for admin settings page
            include_once WC_PE_ABSPATH . '/includes/functions/wcpe-functions.php';
            
        }

        // hooks initilization 
        public function wcpe_hooks(){
            // object declaration of class Wcpe_Main_Class 
            $obj_wcpe_setup = new Wcpe_Setup_Class;
            // adding main menu page hooks
            add_action( "admin_menu", array( $obj_wcpe_setup ,"wcpe_add_register_menu") );
            // adding custom meta box in woocommerce product post type
            add_action( 'add_meta_boxes', array(  $obj_wcpe_setup , 'wcpe_custom_metabox') );
            // saving saving metabox data 
            add_action( 'save_post', array(  $obj_wcpe_setup , 'wpce_save_metabox_data') );
            // displaying our custom meta data on product page
            add_action( 'woocommerce_product_meta_end', array(  $obj_wcpe_setup ,'wpce_show_meta_data' ) );
            // displaying our custom meta data on shop page
            add_action( 'woocommerce_after_shop_loop_item', array(  $obj_wcpe_setup ,'wpce_show_meta_data' ) );  
            // CSS and JS include files
            add_action( 'wp_enqueue_scripts', array(  $obj_wcpe_setup ,'wpce_inc_css_js' ) );
            
        }
        
        
        
    }
