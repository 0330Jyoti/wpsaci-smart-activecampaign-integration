<?php
class WPSACI_Smart_ActiveCampaign_Admin_Synchronization {

    public function processSynch($POST = array()){
       
       	if ( isset( $_POST['submit'] ) ) {

            if(isset($_REQUEST['tab']) && $_REQUEST['tab'] == "general"){
                $client_id                  = sanitize_text_field($_REQUEST['wpsaci_smart_activecampaign_settings']['client_id']);
                $client_secret              = sanitize_text_field($_REQUEST['wpsaci_smart_activecampaign_settings']['client_secret']);
                $wpsaci_smart_activecampaign_data_center  = sanitize_text_field($_REQUEST['wpsaci_smart_activecampaign_settings']['data_center']);
            }
                        
            $wpsaci_smart_activecampaign_settings  = !empty(get_option( 'wpsaci_smart_activecampaign_settings' )) ? get_option( 'wpsaci_smart_activecampaign_settings' ) : array();

            $wpsaci_smart_activecampaign_settings = array_merge($wpsaci_smart_activecampaign_settings, $_REQUEST['wpsaci_smart_activecampaign_settings']);
            
            update_option( 'wpsaci_smart_activecampaign_settings', $wpsaci_smart_activecampaign_settings );
            
        }


        /*Synch product*/
        if( isset( $_POST['smart_synch'] ) && $_POST['smart_synch'] == 'activecampaign' ){

           
            $id = $_POST['id'];

            switch ($_POST['wp_module']) {
                
                case 'products':
                    
                    $WPSACI_Smart_Zoho_Public = new WPSACI_Smart_Zoho_Public();
                    $WPSACI_Smart_Zoho_Public->addProductToZoho( $id );

                    break;

                case 'orders':
                    
                    $WPSACI_Smart_Zoho_Public = new WPSACI_Smart_Zoho_Public();
                    $WPSACI_Smart_Zoho_Public->addOrderToZoho( $id );

                    break;

                case 'customers':
                    
                    $WPSACI_Smart_Zoho_Public = new WPSACI_Smart_Zoho_Public();
                    $WPSACI_Smart_Zoho_Public->addUserToZoho( $id );

                    break;    
                
                default:
                    # code...
                    break;
            }
            
        }
        

    }

    public function displaySynchData(){
        require_once WPSACI_PLUGIN_PATH . 'admin/partials/synchronization.php';
    }
}
?>