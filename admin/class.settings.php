<?php
class WPSACI_Smart_ActiveCampaign_Admin_Settings {

    public function processSettingsForm($POST = array()){
       
        $client_id = $client_secret = "";
        
       	if ( isset( $_POST['submit'] ) ) {

            if(isset($_REQUEST['tab']) && $_REQUEST['tab'] == "general"){
                $client_id                  = sanitize_text_field($_REQUEST['wpsaci_smart_activecampaign_settings']['client_id']);
                $client_secret              = sanitize_text_field($_REQUEST['wpsaci_smart_activecampaign_settings']['client_secret']);
                $wpsaci_smart_activecampaign_data_center  = sanitize_text_field($_REQUEST['wpsaci_smart_activecampaign_settings']['data_center']);    
            }
                        
            $wpsaci_smart_activecampaign_settings  = !empty(get_option( 'wpsaci_smart_activecampaign_settings' )) ? get_option( 'wpsaci_smart_activecampaign_settings' ) : array();

            $wpsaci_smart_activecampaign_settings = array_merge($wpsaci_smart_activecampaign_settings, $_REQUEST['wpsaci_smart_activecampaign_settings']);
            
            update_option( 'wpsaci_smart_activecampaign_settings', $wpsaci_smart_activecampaign_settings );
            
            if ( $client_id && $client_secret ) {
                $redirect_uri = esc_url(WPSACI_REDIRECT_URI);
                $redirect_url = "$wpsaci_smart_activecampaign_data_center/oauth/v2/auth?client_id=$client_id&redirect_uri=$redirect_uri&response_type=code&scope=ActiveCampaignCRM.modules.all,ActiveCampaignCRM.settings.all&access_type=offline";
                if ( wp_redirect( $redirect_url ) ) {
				    exit;
				}
            }
            
        }
    }

    public function displaySettingsForm(){
        require_once WPSACI_PLUGIN_PATH . 'admin/partials/settings.php';
    }
}
?>