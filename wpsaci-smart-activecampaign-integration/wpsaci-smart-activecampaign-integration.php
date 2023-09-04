<?php
/**
 * Plugin Name:       WPSACI Smart ActiveCampaign Integration
 * Plugin URI:        https://profiles.wordpress.org/iqbal1486/
 * Description:       WP Smart Zoho help you to manage and synch possible WordPress data like customers, orders, products to the Zoho modules as per your settings options.
 * Version:           2.1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Geekerhub
 * Author URI:        https://profiles.wordpress.org/iqbal1486/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wpsaci-smart-activecampaign
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit( 'restricted access' );
}

define( 'WPSACI_VERSION', '1.0.0' );

if (! defined('WPSACI_ADMIN_URL') ) {
    define('WPSACI_ADMIN_URL', get_admin_url());
}

if (! defined('WPSACI_PLUGIN_FILE') ) {
    define('WPSACI_PLUGIN_FILE', __FILE__);
}

if (! defined('WPSACI_PLUGIN_PATH') ) {
    define('WPSACI_PLUGIN_PATH', plugin_dir_path(WPSACI_PLUGIN_FILE));
}

if (! defined('WPSACI_PLUGIN_URL') ) {
    define('WPSACI_PLUGIN_URL', plugin_dir_url(WPSACI_PLUGIN_FILE));
}

if (! defined('WPSPI_REDIRECT_URI') ) {
    define('WPSACI_REDIRECT_URI', admin_url( 'admin.php?page=wpsaci_smart_activecampaign_process' ));
}

if (! defined('WPSACI_SETTINGS_URI') ) {
    define('WPSACI_SETTINGS_URI', admin_url( 'admin.php?page=wpsaci-smart-activecampaign-integration' ));
}

if (! defined('WPSACI_ACTIVECAMPAIGNAPIS_URL') ) {
    $tld = "com";
    // $wpspi_smart_pipedrive_settings  = get_option( 'wpspi_smart_pipedrive_settings' );
    // if( !empty($wpspi_smart_pipedrive_settings['data_center'])){
    //     $tld = end(explode(".", parse_url( $wpspi_smart_pipedrive_settings['data_center'], PHP_URL_HOST)));
    // }
    define('WPSACI_ACTIVECAMPAIGNAPISAPIS_URL', 'https://www.pipedriveapis.'.$tld);
}

function wpsaci_smart_activecampaign_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class.activator.php';
	$WPSACI_Smart_ActiveCampaign_Activator = new WPSACI_Smart_ActiveCampaign_Activator();
    $WPSACI_Smart_ActiveCampaign_Activator->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpszi-smart-zoho-deactivator.php
 */
function wpsaci_smart_activecampaign_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class.deactivator.php';
    WPSACI_Smart_ActiveCampaign_Deactivator::deactivate();
}


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wpsaci-smart-activecampaign.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function wpsaci_smart_activecampaign_run() {
    $plugin = new WPSACI_Smart_ActiveCampaign();
	$plugin->run();
}

register_activation_hook( __FILE__, 'wpsaci_smart_ActiveCampaign_activate' );
register_deactivation_hook( __FILE__, 'wpsaci_smart_ActiveCampaign_deactivate' );

wpsaci_smart_activecampaign_run();

function wpsaci_smart_activecampaign_textdomain_init() {
    load_plugin_textdomain( 'wpsaci-smart-activecampaign', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action('plugins_loaded', 'wpsaci_smart_activecampaign_textdomain_init');
?>