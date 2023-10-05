<?php
class WPSACI_Smart_ActiveCampaign_Public {
  
    public function __construct() {
        
        $this->loadCustomerAction();
        $this->loadOrderAction();
        $this->loadProductAction();
    }


    private function loadCustomerAction() {
        add_action( 'user_register', array($this, 'addUserToActiveCampaign') );
        add_action( 'profile_update', array($this, 'addUserToActiveCampaign'), 10, 1 );
        add_action( 'woocommerce_update_customer', array($this, 'addUserToActiveCampaign'), 10, 1 );
    }


    private function loadOrderAction() {
        add_action( 'save_post', array( $this, 'addOrderToActiveCampaign' ), 10, 1 );
        add_action('woocommerce_thankyou', array( $this, 'addOrderToActiveCampaign' ), 10, 1);
    }


    private function loadProductAction() {
        add_action( 'woocommerce_update_product', array( $this, 'addProductToActiveCampaign' ), 10, 1 );
    }

    public function addUserToActiveCampaign( $user_id ){
        global $wpdb;
        $data       = array();
        $user_info  = get_userdata($user_id);

        $default_wp_module = "customers";

        $wpsaci_smart_activecampaign_settings = get_option( 'wpsaci_smart_activecampaign_settings' );
        $synch_settings         = !empty( $wpsaci_smart_activecampaign_settings['synch'] ) ? $wpsaci_smart_activecampaign_settings['synch'] : array();

        foreach ($synch_settings as $wp_activecampaign_module => $enable) {
            
            $wp_activecampaign_module = explode('_', $wp_activecampaign_module);
            $wp_module      = $wp_activecampaign_module[0];
            $activecampaign_module    = $wp_activecampaign_module[1];

            if($default_wp_module == $wp_module){
                
                $get_activecampaign_field_mapping = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}smart_activecampaign_field_mapping WHERE wp_module ='".$wp_module."' AND activecampaign_module = '".$activecampaign_module."' AND status='active'");

                foreach ($get_activecampaign_field_mapping as $key => $value) {
                    $wp_field   = $value->wp_field;
                    $activecampaign_field = $value->activecampaign_field;

                    if ( $activecampaign_field ) {
                        if ( isset( $user_info->{$wp_field} ) ) {
                            if ( is_array( $user_info->{$wp_field} ) ) {
                                $user_info->{$wp_field} = implode(';', $user_info->{$wp_field} );
                            }
                            $data[$activecampaign_module][$activecampaign_field] = strip_tags( $user_info->{$wp_field} );
                        }
                    }
                }
            }   
        }

        if( $data != null ){
            $this->prepareAndActionOnData( $user_id, $data, $default_wp_module );
        }
    }


    public function addOrderToActiveCampaign( $order_id ){
        global $wpdb, $post_type; 
        $data       = array();

        if ( get_post_type( $order_id ) !== 'shop_order' ){
            return;
        }

        $order = wc_get_order( $order_id );
        
        $default_wp_module = "orders";

        $wpsaci_smart_activecampaign_settings = get_option( 'wpsaci_smart_activecampaign_settings' );
        $synch_settings         = !empty( $wpsaci_smart_activecampaign_settings['synch'] ) ? $wpsaci_smart_activecampaign_settings['synch'] : array();

        foreach ($synch_settings as $wp_activecampaign_module => $enable) {
            
            $wp_activecampaign_module = explode('_', $wp_activecampaign_module);
            $wp_module      = $wp_activecampaign_module[0];
            $activecampaign_module    = $wp_activecampaign_module[1];

            if($default_wp_module == $wp_module){
                
                $get_activecampaign_field_mapping = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}smart_activecampaign_field_mapping WHERE wp_module ='".$wp_module."' AND activecampaign_module = '".$activecampaign_module."' AND status='active'");

                foreach ($get_activecampaign_field_mapping as $key => $value) {
                    $wp_field   = $value->wp_field;
                    $activecampaign_field = $value->activecampaign_field;

                    if ( $activecampaign_field ) {

                        if ( null !== $order->{$wp_field}() ) {
                            $data[$activecampaign_module][$activecampaign_field] = strip_tags( $order->{$wp_field}() );
                        }
                    }
                }
            }   
        }
        
        if( $data != null ){
            $this->prepareAndActionOnData( $order_id, $data, $default_wp_module );
        }
    }


    public function addProductToActiveCampaign( $post_id ){
        global $wpdb, $post_type, $data; 
        $data = array();

        if ( get_post_type( $post_id ) !== 'product' ){
            return;
        }
        
        $product = wc_get_product( $post_id );

        $default_wp_module = "products";

        $wpsaci_smart_activecampaign_settings = get_option( 'wpsaci_smart_activecampaign_settings' );
        $synch_settings         = !empty( $wpsaci_smart_activecampaign_settings['synch'] ) ? $wpsaci_smart_activecampaign_settings['synch'] : array();

        foreach ($synch_settings as $wp_activecampaign_module => $enable) {
            
            $wp_activecampaign_module = explode('_', $wp_activecampaign_module);
            $wp_module      = $wp_activecampaign_module[0];
            $activecampaign_module    = $wp_activecampaign_module[1];

            if($default_wp_module == $wp_module){
                
                $get_activecampaign_field_mapping = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}smart_activecampaign_field_mapping WHERE wp_module ='".$wp_module."' AND activecampaign_module = '".$activecampaign_module."' AND status='active'");

                foreach ($get_activecampaign_field_mapping as $key => $value) {
                    $wp_field   = $value->wp_field;
                    $activecampaign_field = $value->activecampaign_field;

                    if ( $activecampaign_field ) {

                        if ( null !== $product->{$wp_field}() ) {
                            if(is_array($product->{$wp_field}())){
                                $data[$activecampaign_module][$activecampaign_field] = implode(',', $product->{$wp_field}());
                            }else{
                                $data[$activecampaign_module][$activecampaign_field] = strip_tags( $product->{$wp_field}() );    
                            }
                        }
                    }
                }
            }   
        }

        if($data != null ){
            $this->prepareAndActionOnData( $post_id, $data, $default_wp_module );
        }
    }


    public function prepareAndActionOnData($id, $data = array(), $default_wp_module = NULL){
        
        if( $default_wp_module == 'orders' ||  $default_wp_module == 'products' ){
            $smart_activecampaign_relation = get_post_meta( $id, 'smart_activecampaign_relation', true );
        }else{
            $smart_activecampaign_relation = get_user_meta( $id, 'smart_activecampaign_relation', true );    
        }
        

        if ( ! is_array( $smart_activecampaign_relation ) ) {
            $smart_activecampaign_relation = array();
        }

        $activecampaign_api_obj   = new WPSACI_Smart_ActiveCampaign_API();
        
        foreach ($data as $activecampaign_module => $activecampaign_data) {
            
            $record_id = ( isset( $smart_activecampaign_relation[$activecampaign_module] ) ? $smart_activecampaign_relation[$activecampaign_module] : 0 );

            if ( $record_id ) {
                $response = $activecampaign_api_obj->updateRecord($activecampaign_module, $activecampaign_data, $record_id);
            }else{
                $response = $activecampaign_api_obj->addRecord($activecampaign_module, $activecampaign_data);
            }
                        
            if ( isset( $response->data[0]->details->id ) ) {
                $record_id = $response->data[0]->details->id;
                $smart_activecampaign_relation[$activecampaign_module] = $record_id;
            }
        }

        if( $default_wp_module == 'orders' ||  $default_wp_module == 'products' ){
            update_post_meta( $id, 'smart_activecampaign_relation', $smart_activecampaign_relation );
        }else{
            update_user_meta( $id, 'smart_activecampaign_relation', $smart_activecampaign_relation );    
        }
        
    }
}

new WPSACI_Smart_ActiveCampaign_Public();
?>