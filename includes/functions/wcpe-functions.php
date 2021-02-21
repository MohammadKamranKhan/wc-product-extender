<?php
    /**
     *  class-wcpe-mainsetup.php
     */
    // Exit if directly access
    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    function wcpe_settings_page_cb(){
    ?> 
    
    <h3>Woocommerce Product Extender Plugin</h3>

    <p>
        Please go to woocommerce <strong>Products > Add New </strong> and Add extra information under <strong>( Woocommerce Product  Extender )</strong> related to products.
    </p>

    <?php   
    }