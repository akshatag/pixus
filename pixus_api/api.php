<?php

header('Content-type: text/json');
define('PIXUS_API', 1);

require_once('defines.php');
require_once(CORE_LIB.'/functions.php');

$apiReq = getAPIRequest();

echo $_SERVER['REQUEST_METHOD'];
echo $apiReq;

$urlTable = array(

    '/users/$' => array(API_LIB.'/users.php', 'getUserWithId', 'GET'),
    '/users/$/photos' => array(API_LIB.'/users.php', 'getPhotosForUserWithId', 'GET'),
    '/users/$/events' => array(API_LIB.'/users.php', 'getEventsForUserWithId', 'GET'),
    '/events/$' => array(API_LIB.'/events.php', 'getEventWithId', 'GET'),
    '/events/$/photos' => array(API_LIB.'/events.php', 'getPhotosForEventWithId', 'GET'),
    '/photos/$' => array(API_LIB.'/photos.php', 'getPhotoWithId', 'GET'),
    '/users/' => array(API_LIB.'/users.php', 'newUserWithParams', 'POST'),
    '/events/' => array(API_LIB.'/events.php', 'newEventWithParams', 'POST'),
    '/photos/' => array(API_LIB.'/photos.php', 'newPhotoWithParams', 'POST')

);

$handler = parseAPIRequest($apiReq, $urlTable);

echo $handler[0];

//if(!is_array($handler)){
//    die($handler);
//    //TODO: Configure error messages
//}

//include class where function stored
include($handler[0]);

//call appropriate function with params
$res = call_user_func_array($handler[1], $handler[3]);
if(!$handler){
    echo 'no handler';
}
echo json_encode($res, JSON_PRETTY_PRINT);