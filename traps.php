<?php
/**
 * Created by PhpStorm.
 * User: jlroberts
 * Date: 11/19/15
 * Time: 1:33 PM
 */

include_once '/opt/webapplications/RawPHP/wordpress/wp-config.php';
include_once '/opt/webapplications/RawPHP/wordpress/wp-includes/post.php';
include_once '/opt/webapplications/RawPHP/wordpress/wp-includes/meta.php';

class WPTraps_Trap {

    function __construct() {

    }

    function run() {

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            // If JSTrap ->
            //      Decrement JS Miss Counter

            global $wpdb;
            $post_ID = '1';
            $jstraps = get_post_meta($post_ID, '_jstraps', true) != '' ? get_post_meta($post_ID, '_jstraps', true) : '0';
            $jstrapsNew = $jstraps - 1;
            update_post_meta($post_ID, '_jstraps', $jstrapsNew);

        }
    }
}

$traps = new WPTraps_Trap();
$traps->run();