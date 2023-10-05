<?php

class WPSACI_Smart_ActiveCampaign_Deactivator
{
    public function deactivate() {
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		
		$smart_activecampaign_report_table_name 			= $wpdb->prefix . 'smart_activecampaign_report';
		$smart_activecampaign_field_mapping_table_name 	= $wpdb->prefix . 'smart_activecampaign_field_mapping';

		delete_option('wpsaci_smart_activecampaign_settings');
		delete_option('wpsaci_smart_activecampaign');
		delete_option('wpsaci_smart_activecampaign_modules_fields');
	}
}
?>