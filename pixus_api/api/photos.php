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


function uploadPhotoWithParams($uid, $eid){

    echo 'uploading photo from user with id '.$uid.' to event with id '.$eid."\n";

    if(!checkUserInvitedToEvent($uid, $eid)){
        echo 'invalid user event param';
        return false;
    }

    if(!isset($_FILES['userfile'])){
        echo 'cannot find file';
        return false;
    }

    if($_FILES['userfile']['error'] > 0){
        echo 'error: '.$_FILES['userfile']['error'];
        return false;
    }

    $stmt = db()->prepare('INSERT INTO `'.PHOTOS_TABLE.'` (user_id, event_id, url_path) VALUES (:uid, :eid, :url)');
    $stmt->bindParam(':uid', $uid);
    $stmt->bindParam(':eid', $eid);

    $url = MEDIA_LIB.'/'.$eid;
    $stmt->bindParam(':url', $url);
    $res = $stmt->execute();

    echo 'prelim insert into table complete '."\n";

    if(!$res){
        var_dump($stmt->errorInfo());
    }

    $id = db()->lastInsertId();

    $arr = explode('.', $_FILES['userfile']['name']);
    $newFileName =  $id.'.'.end($arr);

    $url = $url.'/'.$newFileName;
    $res = move_uploaded_file($_FILES['userfile']['tmp_name'], $url);

    echo ($res ? "MUF success!" : "MUF failure!");
    echo "\n";

    $stmt = db()->prepare('UPDATE `'.PHOTOS_TABLE.'` SET url_path=:url WHERE id=:id');
    $stmt->bindParam(':url', $url);
    $stmt->bindParam(':id', $id);
    $res = $stmt->execute();

    if(!$res){
        var_dump($stmt->errorInfo());
    }

    $stmt = db()->prepare('INSERT INTO `'.EVENTS_PHOTOS_TABLE.'` (event_id, photo_id) VALUES (:eid, :pid)');
    $stmt->bindParam(':eid', $eid);
    $stmt->bindParam(':pid', $id);
    $res = $stmt->execute();

    if(!$res){
        var_dump($stmt->errorInfo());
    }

    return $res;
}








