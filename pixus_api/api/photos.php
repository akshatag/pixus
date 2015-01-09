<?php
/**
 * Created by PhpStorm.
 * User: Akshat
 * Date: 12/29/14
 * Time: 5:54 PM
 */
require_once(CORE_LIB.'/db/includes.php');

function getPhotoWithId($id){

    echo 'getting photo with id: '.$id." \n";

    $stmt = db()->prepare('SELECT * FROM `PHOTOS_TABLE` WHERE id=:pid');
    $stmt->bindParam(':pid', $id);
    $stmt->execute();

    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $arr;
}


function uploadPhotoWithParams($id){

    $params = array('user_id', 'event_id');

    if(!checkParamsSetPOST($params)){
        return false;
    };

    if(!checkUserInvitedToEvent($_POST['user_id'], $_POST['event_id'])){
        return false;
    }







}






