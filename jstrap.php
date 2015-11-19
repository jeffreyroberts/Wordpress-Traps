<?php
/**
 * Created by PhpStorm.
 * User: jlroberts
 * Date: 11/19/15
 * Time: 1:31 PM
 */
?>

function microtime(get_as_float) {

    var now = new Date()
    .getTime() / 1000;
    var s = parseInt(now, 10);

    return (get_as_float) ? now : (Math.round((now - s) * 1000) / 1000) + ' ' + s;
}

jQuery.post( "/wp-content/plugins/wpTraps/traps.php", { name: "jsTrap", time: microtime(), code: "<?php echo WPTrap_Data::$trapData['uniqid']; ?>" } );