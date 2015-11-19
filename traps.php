<?php
/**
 * Created by PhpStorm.
 * User: jlroberts
 * Date: 11/19/15
 * Time: 1:33 PM
 */

class WPTraps_Trap {

    function __construct() {

    }

    function run() {

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            // If JSTrap ->
            //      Decrement JS Miss Counter

        } else if($_SERVER['REQUEST_METHOD'] == 'GET') {

            // If IMGTrap ->
            //      Decrement IMG Miss Counter
            // If CSSTrap ->
            //      Decrement CSS Miss Counter
        }
    }
}