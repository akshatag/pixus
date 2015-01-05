<?php
/**
 * Created by PhpStorm.
 * User: Akshat
 * Date: 12/29/14
 * Time: 6:14 PM
 */

require_once('database.php');

define('USERS_TABLE', 'users');
define('EVENTS_TABLE', 'events');
define('PHOTOS_TABLE', 'photos');
define('USERS_EVENTS_TABLE', 'users_events_map');
define('EVENTS_PHOTOS_TABLE', 'events_photos_map');

function db(){
    global $DB;
    return $DB;
}

echo 'includes done!'."\n";