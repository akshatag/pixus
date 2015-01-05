<?php
/**
 * Created by PhpStorm.
 * User: Akshat
 * Date: 12/29/14
 * Time: 5:54 PM
 */
require_once(CORE_LIB.'/db/includes.php');

function getEventWithId($id){

    echo 'getting event with id: '.$id." \n";

    $stmt = db()->prepare('SELECT * FROM `EVENTS_TABLE` WHERE id=:eid');
    $stmt->bindParam(':eid', $id);
    $stmt->execute();


    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $arr;
}

function getPhotosForEventWithId($id){

    $stmt = db()->prepare('SELECT photo_id FROM `EVENTS_PHOTOS_TABLE` WHERE id=:eid');
    $stmt->bindParam(':eid', $id);
    $stmt->execute();

    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $arr;
}


function newEventWithParams(){

}





