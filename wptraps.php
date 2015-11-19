<?php

/**
 * The plugin bootstrap file
 *
 * @link              http://www.jeffreylroberts.com
 * @since             1.0.0
 * @package           JeffreyLRoberts
 *
 * @wordpress-plugin
 * Plugin Name:       WP-Traps
 * Plugin URI:        http://github.com/jeffreyroberts/Wordpress-Traps
 * Description:       Basic Bot Trap w/ Dashboard Counters
 * Version:           1.0.0
 * Author:            Jeffrey.L.Roberts@gmail.com
 * Author URI:        http://jeffreylroberts.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wordpress traps
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

require_once plugin_dir_path( __FILE__ ) . 'includes/trap-data.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/trap-engine.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/dashboard.php';

function activate_traps() {

    add_post_meta('1', '_jstraps', '0', true);
    add_post_meta('1', '_visits', '0', true);
    add_post_meta('1', '_live', '0', true);

}

if(!isset($_COOKIE['wptraps'])) {

    global $wpdb;
    $post_ID = '1';

    $total_visits = get_post_meta($post_ID, '_visits', true) != '' ? get_post_meta($post_ID, '_visits', true) : '0';
    $total_visitsNew = $total_visits + 1;
    update_post_meta($post_ID, '_visits', $total_visitsNew);

    setcookie('wptraps','wptraps',time() + (86400 * 7));
}

function deactivate_traps() {

}

register_activation_hook( __FILE__, 'activate_traps' );

register_deactivation_hook( __FILE__, 'deactivate_traps' );

if ( is_plugin_active( 'wpTraps/wptraps.php' ) ) {

    add_action('admin_menu', 'wptraps_menu');
    add_action('wp_footer', 'add_wp_traps');

    function add_wp_traps()
    {
        if(!isset($_COOKIE['wptraps'])) {

            $post_ID = '1';
            $jstraps = get_post_meta($post_ID, '_jstraps', true) != '' ? get_post_meta($post_ID, '_jstraps', true) : '0';
            $jstrapsNew = $jstraps + 1;
            update_post_meta($post_ID, '_jstraps', $jstrapsNew);

            echo '<script type="text/javascript" src="/wp-content/plugins/wpTraps/jstrap.php"></script>';
        }
    }

    function wptraps_menu()
    {
        add_dashboard_page('Wordpress Traps', 'WP Traps', 'manage_options', 'wp-traps-view', 'wp_traps_view');
    }

    function wp_traps_view()
    {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        $dashboard = new WPTraps_Dashboard();
        $dashboard->run();
    }

    function run_plugin_name()
    {

        $plugin = new TrapEngine();
        $plugin->run();

    }

    run_plugin_name();
}
else {

    remove_action( 'wptraps_menu' );
    remove_action( 'add_wp_traps' );
}