<?php
/**
 * Created by PhpStorm.
 * User: jlroberts
 * Date: 11/19/15
 * Time: 1:56 PM
 */

class TrapEngine {

    function __construct() {

    }

    function run() {

        WPTrap_Data::$trapData['uniqid'] = uniqid('trap');

    }
}