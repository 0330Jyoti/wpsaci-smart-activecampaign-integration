<?php
class WPSACI_Smart_ActiveCampaign {

	protected $plugin_name;

	protected $version;

	public function __construct() {
		$this->version = '1.0.0';
		$this->plugin_name = 'wpsaci-smart-activecampaign';
	}

	public function run() {
		/*
			Load all class files
		*/
		require_once WPSACI_PLUGIN_PATH . 'includes/class-wpsaci-smart-activecampaign-api.php';
        require_once WPSACI_PLUGIN_PATH . 'admin/class.wpsaci-smart-activecampaign-admin.php';
		require_once WPSACI_PLUGIN_PATH . 'public/class.wpsaci-smart-activecampaign-public.php';
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}
	
	public function get_version() {
		return $this->version;
	}

	public function get_wp_modules(){
		return array(
                'customers' => esc_html__('Customers','wpsaci-smart-activecampaign'),
                'orders'    => esc_html__('Orders','wpsaci-smart-activecampaign'),
                'products'  => esc_html__('Products','wpsaci-smart-activecampaign'),
            );
	}

	public function get_activecampaign_modules(){

		$activecampaign_api_obj   = new WPSACI_Smart_Zoho_API();
       
        /*get list modules*/
        $getListModules = $activecampaign_api_obj->getListModules();
        
        return $getListModules;
	}

	public static function get_customer_fields(){
    	
    	global $wpdb;
		$wc_fields = array(
		    'first_name'            => esc_html__('First Name', 'wpsaci-smart-activecampaign'),
		    'last_name'             => esc_html__('Last Name', 'wpsaci-smart-activecampaign'),
		    'user_email'            => esc_html__('Email', 'wpsaci-smart-activecampaign'),
		    'billing_first_name'    => esc_html__('Billing First Name', 'wpsaci-smart-activecampaign'),
		    'billing_last_name'     => esc_html__('Billing Last Name', 'wpsaci-smart-activecampaign'),
		    'billing_company'       => esc_html__('Billing Company', 'wpsaci-smart-activecampaign'),
		    'billing_address_1'     => esc_html__('Billing Address 1', 'wpsaci-smart-activecampaign'),
		    'billing_address_2'     => esc_html__('Billing Address 2', 'wpsaci-smart-activecampaign'),
		    'billing_city'          => esc_html__('Billing City', 'wpsaci-smart-activecampaign'),
		    'billing_state'         => esc_html__('Billing State', 'wpsaci-smart-activecampaign'),
		    'billing_postcode'      => esc_html__('Billing Postcode', 'wpsaci-smart-activecampaign'),
		    'billing_country'       => esc_html__('Billing Country', 'wpsaci-smart-activecampaign'),
		    'billing_phone'         => esc_html__('Billing Phone', 'wpsaci-smart-activecampaign'),
		    'billing_email'         => esc_html__('Billing Email', 'wpsaci-smart-activecampaign'),
		    'shipping_first_name'   => esc_html__('Shipping First Name', 'wpsaci-smart-activecampaign'),
		    'shipping_last_name'    => esc_html__('Shipping Last Name', 'wpsaci-smart-activecampaign'),
		    'shipping_company'      => esc_html__('Shipping Company', 'wpsaci-smart-activecampaign'),
		    'shipping_address_1'    => esc_html__('Shipping Address 1', 'wpsaci-smart-activecampaign'),
		    'shipping_address_2'    => esc_html__('Shipping Address 2', 'wpsaci-smart-activecampaign'),
		    'shipping_city'         => esc_html__('Shipping City', 'wpsaci-smart-activecampaign'),
		    'shipping_postcode'     => esc_html__('Shipping Postcode', 'wpsaci-smart-activecampaign'),
		    'shipping_country'      => esc_html__('Shipping Country', 'wpsaci-smart-activecampaign'),
		    'shipping_state'        => esc_html__('Shipping State', 'wpsaci-smart-activecampaign'),
		    'user_url'              => esc_html__('Website', 'wpsaci-smart-activecampaign'),
		    'description'           => esc_html__('Biographical Info', 'wpsaci-smart-activecampaign'),
		    'display_name'          => esc_html__('Display name publicly as', 'wpsaci-smart-activecampaign'),
		    'nickname'              => esc_html__('Nickname', 'wpsaci-smart-activecampaign'),
		    'user_login'            => esc_html__('Username', 'wpsaci-smart-activecampaign'),
		    'user_registered'       => esc_html__('Registration Date', 'wpsaci-smart-activecampaign')
		);

		return $wc_fields;
    }


    public static  function get_order_fields(){
    	
    	global $wpdb;


        $wc_fields =  array(
                'get_id'                       => esc_html__('Order Number', 'wpsaci-smart-activecampaign'),
                'get_order_key'                => esc_html__('Order Key', 'wpsaci-smart-activecampaign'),
                'get_billing_first_name'       => esc_html__('Billing First Name', 'wpsaci-smart-activecampaign'),
                'get_billing_last_name'        => esc_html__('Billing Last Name', 'wpsaci-smart-activecampaign'),
                'get_billing_company'          => esc_html__('Billing Company', 'wpsaci-smart-activecampaign'),
                'get_billing_address_1'        => esc_html__('Billing Address 1', 'wpsaci-smart-activecampaign'),
                'get_billing_address_2'        => esc_html__('Billing Address 2', 'wpsaci-smart-activecampaign'),
                'get_billing_city'             => esc_html__('Billing City', 'wpsaci-smart-activecampaign'),
                'get_billing_state'            => esc_html__('Billing State', 'wpsaci-smart-activecampaign'),
                'get_billing_postcode'         => esc_html__('Billing Postcode', 'wpsaci-smart-activecampaign'),
                'get_billing_country'          => esc_html__('Billing Country', 'wpsaci-smart-activecampaign'), 
                'get_billing_phone'            => esc_html__('Billing Phone', 'wpsaci-smart-activecampaign'),
                'get_billing_email'            => esc_html__('Billing Email', 'wpsaci-smart-activecampaign'),
                'get_shipping_first_name'      => esc_html__('Shipping First Name', 'wpsaci-smart-activecampaign'),
                'get_shipping_last_name'       => esc_html__('Shipping Last Name', 'wpsaci-smart-activecampaign'),
                'get_shipping_company'         => esc_html__('Shipping Company', 'wpsaci-smart-activecampaign'),
                'get_shipping_address_1'       => esc_html__('Shipping Address 1', 'wpsaci-smart-activecampaign'),
                'get_shipping_address_2'       => esc_html__('Shipping Address 2', 'wpsaci-smart-activecampaign'),
                'get_shipping_city'            => esc_html__('Shipping City', 'wpsaci-smart-activecampaign'),
                'get_shipping_state'           => esc_html__('Shipping State', 'wpsaci-smart-activecampaign'),
                'get_shipping_postcode'        => esc_html__('Shipping Postcode', 'wpsaci-smart-activecampaign'),
                'get_shipping_country'         => esc_html__('Shipping Country',  'wpsaci-smart-activecampaign'),
                'get_formatted_order_total'     => esc_html__('Formatted Order Total', 'wpsaci-smart-activecampaign'),
                'get_cart_tax'                  => esc_html__('Cart Tax', 'wpsaci-smart-activecampaign'),
                'get_currency'                  => esc_html__('Currency', 'wpsaci-smart-activecampaign'),
                'get_discount_tax'              => esc_html__('Discount Tax', 'wpsaci-smart-activecampaign'),
                'get_discount_to_display'       => esc_html__('Discount to Display', 'wpsaci-smart-activecampaign'),
                'get_discount_total'            => esc_html__('Discount Total', 'wpsaci-smart-activecampaign'),
                'get_shipping_tax'              => esc_html__('Shipping Tax', 'wpsaci-smart-activecampaign'),
                'get_shipping_total'            => esc_html__('Shipping Total', 'wpsaci-smart-activecampaign'),
                'get_subtotal'                  => esc_html__('SubTotal', 'wpsaci-smart-activecampaign'),
                'get_subtotal_to_display'       => esc_html__('SubTotal to Display', 'wpsaci-smart-activecampaign'),
                'get_total'                     => esc_html__('Get Total', 'wpsaci-smart-activecampaign'),
                'get_total_discount'            => esc_html__('Get Total Discount', 'wpsaci-smart-activecampaign'),
                'get_total_tax'                 => esc_html__('Total Tax', 'wpsaci-smart-activecampaign'),
                'get_total_refunded'            => esc_html__('Total Refunded', 'wpsaci-smart-activecampaign'),
                'get_total_tax_refunded'        => esc_html__('Total Tax Refunded', 'wpsaci-smart-activecampaign'),
                'get_total_shipping_refunded'   => esc_html__('Total Shipping Refunded', 'wpsaci-smart-activecampaign'),
                'get_item_count_refunded'       => esc_html__('Item count refunded', 'wpsaci-smart-activecampaign'),
                'get_total_qty_refunded'        => esc_html__('Total Quantity Refunded', 'wpsaci-smart-activecampaign'),
                'get_remaining_refund_amount'   => esc_html__('Remaining Refund Amount', 'wpsaci-smart-activecampaign'),
                'get_item_count'                => esc_html__('Item count', 'wpsaci-smart-activecampaign'),
                'get_shipping_method'           => esc_html__('Shipping Method', 'wpsaci-smart-activecampaign'),
                'get_shipping_to_display'       => esc_html__('Shipping to Display', 'wpsaci-smart-activecampaign'),
                'get_date_created'              => esc_html__('Date Created', 'wpsaci-smart-activecampaign'),
                'get_date_modified'             => esc_html__('Date Modified', 'wpsaci-smart-activecampaign'),
                'get_date_completed'            => esc_html__('Date Completed', 'wpsaci-smart-activecampaign'),
                'get_date_paid'                 => esc_html__('Date Paid', 'wpsaci-smart-activecampaign'),
                'get_customer_id'               => esc_html__('Customer ID', 'wpsaci-smart-activecampaign'),
                'get_user_id'                   => esc_html__('User ID', 'wpsaci-smart-activecampaign'),
                'get_customer_ip_address'       => esc_html__('Customer IP Address', 'wpsaci-smart-activecampaign'),
                'get_customer_user_agent'       => esc_html__('Customer User Agent', 'wpsaci-smart-activecampaign'),
                'get_created_via'               => esc_html__('Order Created Via', 'wpsaci-smart-activecampaign'),
                'get_customer_note'             => esc_html__('Customer Note', 'wpsaci-smart-activecampaign'),
                'get_shipping_address_map_url'  => esc_html__('Shipping Address Map URL', 'wpsaci-smart-activecampaign'),
                'get_formatted_billing_full_name'   => esc_html__('Formatted Billing Full Name', 'wpsaci-smart-activecampaign'),
                'get_formatted_shipping_full_name'  => esc_html__('Formatted Shipping Full Name', 'wpsaci-smart-activecampaign'),
                'get_formatted_billing_address'     => esc_html__('Formatted Billing Address', 'wpsaci-smart-activecampaign'),
                'get_formatted_shipping_address'    => esc_html__('Formatted Shipping Address', 'wpsaci-smart-activecampaign'),
                'get_payment_method'            => esc_html__('Payment Method', 'wpsaci-smart-activecampaign'),
                'get_payment_method_title'      => esc_html__('Payment Method Title', 'wpsaci-smart-activecampaign'),
                'get_transaction_id'            => esc_html__('Transaction ID', 'wpsaci-smart-activecampaign'),
                'get_checkout_payment_url'      => esc_html__( 'Checkout Payment URL', 'wpsaci-smart-activecampaign'),
                'get_checkout_order_received_url'   => esc_html__('Checkout Order Received URL', 'wpsaci-smart-activecampaign'),
                'get_cancel_order_url'          => esc_html__('Cancel Order URL', 'wpsaci-smart-activecampaign'),
                'get_cancel_order_url_raw'      => esc_html__('Cancel Order URL Raw', 'wpsaci-smart-activecampaign'),
                'get_cancel_endpoint'           => esc_html__('Cancel Endpoint', 'wpsaci-smart-activecampaign'),
                'get_view_order_url'            => esc_html__('View Order URL', 'wpsaci-smart-activecampaign'),
                'get_edit_order_url'            => esc_html__('Edit Order URL', 'wpsaci-smart-activecampaign'),
                'get_status'                    => esc_html__('Status', 'wpsaci-smart-activecampaign'),
            );
        
        return $wc_fields;
    }


    public static function get_product_fields(){
    	global $wpdb;
		$wc_fields = array(
		    'get_id'              		=> esc_html__('Product Id', 'wpsaci-smart-activecampaign'),
            'get_type'       			=> esc_html__('Product Type', 'wpsaci-smart-activecampaign'),
            'get_name'       			=> esc_html__('Name', 'wpsaci-smart-activecampaign'),
            'get_slug'          		=> esc_html__('Slug', 'wpsaci-smart-activecampaign'),
            'get_date_created'      	=> esc_html__('Date Created', 'wpsaci-smart-activecampaign'),
            'get_date_modified'     	=> esc_html__('Date Modified', 'wpsaci-smart-activecampaign'),
            'get_status'            	=> esc_html__('Status', 'wpsaci-smart-activecampaign'),
            'get_featured'          	=> esc_html__('Featured', 'wpsaci-smart-activecampaign'),
            'get_catalog_visibility'	=> esc_html__('Catalog Visibility', 'wpsaci-smart-activecampaign'),
            'get_description'       	=> esc_html__('Description', 'wpsaci-smart-activecampaign'),
            'get_short_description' 	=> esc_html__('Short Description', 'wpsaci-smart-activecampaign'),
            'get_sku'            		=> esc_html__('Sku', 'wpsaci-smart-activecampaign'),
            'get_menu_order'      		=> esc_html__('Menu Order', 'wpsaci-smart-activecampaign'),
            'get_virtual'       		=> esc_html__('Virtual', 'wpsaci-smart-activecampaign'),
            'get_permalink'         	=> esc_html__('Product Permalink', 'wpsaci-smart-activecampaign'),
            'get_price'       			=> esc_html__('Price', 'wpsaci-smart-activecampaign'),
            'get_regular_price'       	=> esc_html__('Regular Price', 'wpsaci-smart-activecampaign'),
            'get_sale_price'            => esc_html__('Sale Price', 'wpsaci-smart-activecampaign'),
            'get_date_on_sale_from'     => esc_html__('Date on Sale From', 'wpsaci-smart-activecampaign'),
            'get_date_on_sale_to'       => esc_html__('Date on Sale To', 'wpsaci-smart-activecampaign'),
            'get_total_sales'         	=> esc_html__('Total Sales', 'wpsaci-smart-activecampaign'),
            'get_tax_status'     		=> esc_html__('Tax Status', 'wpsaci-smart-activecampaign'),
            'get_tax_class'           	=> esc_html__('Tax Class', 'wpsaci-smart-activecampaign'),
            'get_manage_stock'          => esc_html__('Manage Stock', 'wpsaci-smart-activecampaign'),
            'get_stock_quantity'        => esc_html__('Stock Quantity', 'wpsaci-smart-activecampaign'),
            'get_stock_status'          => esc_html__('Stock Status', 'wpsaci-smart-activecampaign'),
            'get_backorders'       		=> esc_html__('Backorders', 'wpsaci-smart-activecampaign'),
            'get_sold_individually'     => esc_html__('Sold Individually', 'wpsaci-smart-activecampaign'),
            'get_purchase_note'         => esc_html__('Purchase Note', 'wpsaci-smart-activecampaign'),
            'get_shipping_class_id'     => esc_html__('Shipping Class ID', 'wpsaci-smart-activecampaign'),
            'get_weight'               	=> esc_html__('Weight', 'wpsaci-smart-activecampaign'),
            'get_length'              	=> esc_html__('Length', 'wpsaci-smart-activecampaign'),
            'get_width'            		=> esc_html__('Width', 'wpsaci-smart-activecampaign'),
            'get_height'            	=> esc_html__('Height', 'wpsaci-smart-activecampaign'),
            'get_categories'            => esc_html__('Categories', 'wpsaci-smart-activecampaign'),
            'get_category_ids'          => esc_html__('Categories IDs', 'wpsaci-smart-activecampaign'),
            'get_tag_ids'            	=> esc_html__('Tag IDs', 'wpsaci-smart-activecampaign'),
		);
        
		return $wc_fields;
    }

    public function store_required_field_mapping_data(){

        global $wpdb;
        $activecampaign_api_obj   = new WPSACI_Smart_Zoho_API();
        $wp_modules     = $this->get_wp_modules();
        $getListModules = $this->get_activecampaign_modules();

        if($getListModules['modules']){
            foreach ($getListModules['modules'] as $key => $singleModule) {
                if( $singleModule['deletable'] &&  $singleModule['creatable'] ){
        
                    $activecampaign_fields = $activecampaign_api_obj->getFieldsMetaData( $singleModule['api_name'] );
        
                    if($activecampaign_fields){
                        foreach ($activecampaign_fields['fields'] as $activecampaign_field_key => $activecampaign_field_data) {
                            if($activecampaign_field_data['field_read_only'] == NULL){
                                if( $activecampaign_field_data['system_mandatory'] == 1 ){
                                    if($wp_modules){
                                        foreach ($wp_modules as $wpModuleSlug => $wpModuleLabel) {
        
                                            switch ( $wpModuleSlug ) {
                                                case 'customers':
                                                    $wp_field = "first_name";
                                                    break;
                                                
                                                case 'orders':
                                                    $wp_field = "get_id";
                                                    break;

                                                case 'products':
                                                    $wp_field = "get_name";
                                                    break;

                                                default:
                                                    $wp_field = "";
                                                    break;
                                            }

                                            $status         = 'active';
                                            $description    = '';

                                            $record_exists = $wpdb->get_row( 
                                                $wpdb->prepare(
                                                    "
                                                    SELECT * FROM ".$wpdb->prefix ."smart_activecampaign_field_mapping  WHERE wp_module = %s AND wp_field = %s  AND activecampaign_module = %s AND activecampaign_field = %s
                                                    " ,
                                                    $wpModuleSlug, $wp_field, $singleModule['api_name'], $activecampaign_field_data['api_name']
                                                    )
                                                
                                            );

                                            if ( null !== $record_exists ) {
                                                
                                              $reccord_id       = $record_exists->id;
                                              $is_predefined    = $record_exists->is_predefined;
                                              

                                                $wpdb->update(
                                                    $wpdb->prefix . 'smart_activecampaign_field_mapping', 
                                                    array( 
                                                        'wp_module'     => sanitize_text_field($wpModuleSlug),
                                                        'wp_field'      => sanitize_text_field($wp_field),
                                                        'activecampaign_module'   => sanitize_text_field($singleModule['api_name']),
                                                        'activecampaign_field'    => sanitize_text_field($activecampaign_field_data['api_name']), 
                                                        'status'        => sanitize_text_field($status),
                                                        'description'   => sanitize_text_field($description), 
                                                        'is_predefined' => sanitize_text_field($is_predefined), 
                                                    ), 
                                                    array( 'id' => $reccord_id ), 
                                                    array( 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s'
                                                    ),
                                                    array( '%d' )
                                                );

                                            }else{
                                                $wpdb->insert( 
                                                    $wpdb->prefix . 'smart_activecampaign_field_mapping', 
                                                    array( 
                                                        'wp_module'     => sanitize_text_field($wpModuleSlug),
                                                        'wp_field'      => sanitize_text_field($wp_field),
                                                        'activecampaign_module'   => sanitize_text_field($singleModule['api_name']),
                                                        'activecampaign_field'    => sanitize_text_field($activecampaign_field_data['api_name']), 
                                                        'status'        => sanitize_text_field($status),
                                                        'description'   => sanitize_text_field($description), 
                                                        'is_predefined' => 'yes', 
                                                    ),
                                                    array( 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s'
                                                    ) 
                                                );
                                            }
                                            
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
?>