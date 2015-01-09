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

    $stmt = db()->prepare('SELECT * FROM `'.EVENTS_TABLE.'` WHERE id=:eid');
    $stmt->bindParam(':eid', $id);
    $stmt->execute();


    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $arr;
}

function getPhotosForEventWithId($id){

    $stmt = db()->prepare('SELECT photo_id FROM `'.EVENTS_PHOTOS_TABLE.'` WHERE event_id=:eid');
    $stmt->bindParam(':eid', $id);
    $stmt->execute();

    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $arr;
}


function newEventWithParams(){

    $params = array('name', 'date_time_open', 'date_time_close', 'win_ovrd');
    if(!checkParamsSetPOST($params)){
        return false;
    }


    $format = 'Y-m-d H:i:s';

    if(DateTime::createFromFormat($format, $_POST['date_time_open']) == false){
        return false;
    }

    if(DateTime::createFromFormat($format, $_POST['date_time_close']) == false){
        return false;
    }

    $stmt = db()->prepare('INSERT INTO `'.EVENTS_TABLE.'`(name, win_open, win_close, win_ovrd) VALUES (:nm, :wo, :wc, :wov)');
    $stmt->bindParam(':nm', $_POST['name']);
    $stmt->bindParam(':wo', $_POST['date_time_open']);
    $stmt->bindParam(':wc', $_POST['date_time_close']);
    $stmt->bindParam(':wov', $_POST['win_ovrd']);

    $res = $stmt->execute();

    if(!res){
        var_dump($stmt->errorInfo());
    }

    return $res;
}





