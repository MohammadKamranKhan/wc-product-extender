<?php
    /**
     *  class-wcpe-mainsetup.php
     */
    // Exit if directly access
    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }
    /**
    * Define Class PCF_Main
    */
    class Wcpe_Setup_Class { 
       
        // adding main menu action hook here
        public function wcpe_add_register_menu(){
            // registering menu
            add_menu_page(
                "WC Product Extender",  // page  title
                "WC PE",   // menu title
                "manage_options", // capability
                "wcpe_settings_page", // plugin admin page slug
                "wcpe_settings_page_cb", // function (templates/wcpe_admin_settings_page.php) to be executed on activating plugin"
                "dashicons-edit", // menu icon 
                40  // position of plugin in dashboard
            );
        }

        // custome meta box callback function
        public function wcpe_custom_metabox(){
            // calling function add_meta_box($id,$title,$cbFunction,$screen,$context,$priority,$callback_args)
            add_meta_box('wcpe_custome_metabox_id','Woocommerce Product Extender',array($this,'wcpe_add_metabox_cb'),'product','normal','high');
        }
        // add_metabox callback function 
        public function wcpe_add_metabox_cb( $post ){
            // showing form for products
            // getting post meta data
            $wcpe_product_source = get_post_meta($post->ID,'wcpe_product_source',true);
            $wcpe_product_mx = get_post_meta($post->ID,'wcpe_product_max',true);
            $wcpe_product_mn = get_post_meta($post->ID,'wcpe_product_min',true);
            $wcpe_product_supplier = get_post_meta($post->ID,'wcpe_product_supplier',true);

            ?>

            <strong>You can add extra information related to product.</strong>
            <br><br>
            <table>
              <tr>
                 <td>
                   <label><strong>Product Source  </strong></label>
                 </td>
                 <td>
                    <select style='width:100%' name='wcpe_product_source'>
                    <option  <?php echo ( empty( $wcpe_product_source ) ) ? "" : "disabled"  ?> >Select A company</option>
                    <option value='Amazon' <?php echo ( $wcpe_product_source == "Amazon" ) ? "selected" : ""  ?> >Amazon</option>
                    <option value='Ali Baba' <?php echo ( $wcpe_product_source == "Ali Baba" ) ? "selected" : ""  ?> >Ali Baba</option>
                    <option value='Etsy' <?php echo ( $wcpe_product_source == "Etsy" ) ? "selected" : ""  ?> >Etsy</li>
                    <option value='Ali Express' <?php echo ( $wcpe_product_source == "Ali Express" ) ? "selected" : ""  ?> >Ali Express</option>
                    </select>
                 </td>
              </tr>
            
              <!-- row -->
              <tr>
                <td>
                    <label><strong> Max Quantity   </strong></label>
                </td>
                <td>
                    <input type='text' size='40' name='wcpe_product_max' value="<?php echo ( !empty( $wcpe_product_mx ) ) ?  $wcpe_product_mx : ""; ?>">
                </td>
              </tr>

              <!-- row -->
              <tr>
                <td>
                    <label><strong>Min Quantity   </strong></label>
                </td>
                <td>
                    <input type='text' size='40' name='wcpe_product_min' value="<?php echo ( !empty( $wcpe_product_mn ) ) ?  $wcpe_product_mn : ""; ?>">
                </td>
              </tr>

              <!-- row -->
              <tr>
                <td>
                    <label><strong>Supplier Name   </strong></label>
                </td>
                <td>
                    <input type='text' size='40' name='wcpe_product_supplier' value="<?php echo ( !empty( $wcpe_product_supplier ) ) ?  $wcpe_product_supplier : ""; ?>">
                </td>
              </tr>

            </table>
            
            <?php
            
        }

        // function for savind metabox values into database
        public function wpce_save_metabox_data( $post_id ){
            if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
                return ;
            }
            // saving product source add_post_meta($post->id,$meta_key,$meta_value)
            if(isset($_POST['wcpe_product_source']) ) {
                add_post_meta( $post_id, 'wcpe_product_source', esc_html($_POST['wcpe_product_source']));
            }
            // saving product max quantity add_post_meta($post->id,$meta_key,$meta_value)
            if(isset($_POST['wcpe_product_max']) ) {
                add_post_meta( $post_id, 'wcpe_product_max', esc_html($_POST['wcpe_product_max']));
            }
            // saving product min quantity add_post_meta($post->id,$meta_key,$meta_value)
            if(isset($_POST['wcpe_product_min']) ) {
                add_post_meta( $post_id, 'wcpe_product_min', esc_html($_POST['wcpe_product_min']));
            }
            // saving product min quantity add_post_meta($post->id,$meta_key,$meta_value)
            if(isset($_POST['wcpe_product_supplier']) ) {
                add_post_meta( $post_id, 'wcpe_product_supplier', esc_html($_POST['wcpe_product_supplier']));
            }
        }
       
        // showing meta data on singple product page
        public function wpce_show_meta_data(  ){
            global $post;

            $wcpe_product_source = get_post_meta($post->ID,'wcpe_product_source',true);
            $wcpe_product_mx = get_post_meta($post->ID,'wcpe_product_max',true);
            $wcpe_product_mn = get_post_meta($post->ID,'wcpe_product_min',true);
            $wcpe_product_supplier = get_post_meta($post->ID,'wcpe_product_supplier',true);

            ?>

            <table class="wpce-product-page-info">

               <tr>
                   <td>Product Source</td>
                   <td><?php echo ( !empty($wcpe_product_source ) ? $wcpe_product_source : "") ?></td>
               </tr>

               <tr>
                   <td>Max Quantity</td>
                   <td><?php echo ( !empty($wcpe_product_mx ) ? $wcpe_product_mx : "") ?></td>
               </tr>

               <tr>
                   <td>Min Quantity</td>
                   <td><?php echo ( !empty($wcpe_product_mn ) ? $wcpe_product_mn : "") ?></td>
               </tr>

               <tr>
                   <td>Product Supplier</td>
                   <td><?php echo ( !empty($wcpe_product_supplier ) ? $wcpe_product_supplier : "") ?></td>
               </tr>

            </table>

            <?php 
    
        }

        // Add CSS and JS for wp_enqueue_scripts hook
        public function wpce_inc_css_js(){
            // main css file 
            wp_enqueue_style( 'cf-custom-css' , plugins_url( '/wc-product-extender/assets/css/style.css') ) ;
            wp_enqueue_style( 'google-fonts' , 'https://fonts.googleapis.com/css2?family=Roboto&display=swap' ) ;

        }
    }
  