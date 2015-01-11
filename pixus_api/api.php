<?php

header('Content-type: text/json');
define('PIXUS_API', 1);

require_once('defines.php');
require_once(CORE_LIB.'/functions.php');

echo 'api.php reached'."\n";

$apiReq = getAPIRequest();

echo $_SERVER['REQUEST_METHOD']."\n";
echo $apiReq."\n";

$urlTable = array(

    '/users/$' => array(API_LIB.'/users.php', 'getUserWithId', 'GET'),
    '/users/new' => array(API_LIB.'/users.php', 'newUserWithParams', 'POST'),
    '/users/login' => array(API_LIB.'/users.php', 'getUserWithLogin', 'POST'),
    '/users/$/photos' => array(API_LIB.'/users.php', 'getPhotosForUserWithId', 'GET'),
    '/users/$/events' => array(API_LIB.'/users.php', 'getEventsForUserWithId', 'GET'),
    '/users/$/events/$/invite' => array(API_LIB.'/users.php', 'inviteUserWithIdToEventWithId', 'POST'),
    '/users/$/events/$/status' => array(API_LIB.'/users.php', 'updateStatusForEventWithId', 'POST'),
    '/users/$/events/$/upload' => array(API_LIB.'/photos.php', 'uploadPhotoWithParams', 'POST'),

    '/events/$' => array(API_LIB.'/events.php', 'getEventWithId', 'GET'),
    '/events/new' => array(API_LIB.'/events.php', 'newEventWithParams', 'POST'),
    '/events/$/photos' => array(API_LIB.'/events.php', 'getPhotosForEventWithId', 'GET'),

    '/photos/$' => array(API_LIB.'/photos.php', 'getPhotoWithId', 'GET'),

);

$handler = parseAPIRequest($apiReq, $urlTable);

echo $handler[0]."\n";

//if(!is_array($handler)){
//    die($handler);
//    //TODO: Configure error messages
//}

//include class where function stored
include($handler[0]);

//call appropriate function with params
$arr = call_user_func_array($handler[1], $handler[3]);
if(!$handler){
    echo 'no handler';
}

//echo "\n".'results: '."\n";
echo (is_array($arr) ? printQueryResults($arr) : $arr);
return $arr;