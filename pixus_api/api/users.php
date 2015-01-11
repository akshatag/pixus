<?php
/**
 * Created by PhpStorm.
 * User: Akshat
 * Date: 12/29/14
 * Time: 5:54 PM
 */
require_once(CORE_LIB.'/db/includes.php');

function getUserWithId($id){

    //echo 'getting user with id: '.$id." \n";

    $stmt = db()->prepare('SELECT * FROM `'.USERS_TABLE.'` WHERE id=:uid');
    $stmt->bindParam(':uid', $id);
    $res = $stmt->execute();

    if(!$res){
        var_dump($stmt->errorInfo());
    }

    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $arr;
}

function getEventsForUserWithId($id){

    echo 'getting events for user with id '.$id."\n";

    $stmt = db()->prepare('SELECT event_id FROM `'.USERS_EVENTS_TABLE.'` WHERE user_id=:uid');
    $stmt->bindParam(':uid', $id);
    $res = $stmt->execute();

    if(!$res){
        var_dump($stmt->errorInfo());
    }

    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $arr;
}


function newUserWithParams(){

    echo 'making new user with POST params';

    $params = array('first_name', 'last_name', 'username', 'password');
    checkParamsSetPOST($params);

    $stmt = db()->prepare('INSERT INTO `'.USERS_TABLE.'` (first_name, last_name, username, password, cinnamon) VALUES (:fn, :ln, :un, :pw, :cnm)');
    $stmt->bindParam(':fn', $_POST['first_name']);
    $stmt->bindParam(':ln', $_POST['last_name']);
    $stmt->bindParam(':un', $_POST['username']);

    $cnm = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
    $stmt->bindParam(':cnm', $cnm);

    $pw = hash('md5',$_POST['password'].$cnm);
    $stmt->bindParam(':pw', $pw);


    $res = $stmt->execute();

    if(!res){
        var_dump($stmt->errorInfo());
    }

    return $res;
}

function inviteUserWithIdToEventWithId($uid, $eid){
    echo 'inviting user with id '.$uid.' to event with id '.$eid;

    $stmt = db()->prepare('SELECT * FROM `'.USERS_EVENTS_TABLE.'` WHERE event_id=:eid AND user_id=:uid');

    $stmt->bindParam(':uid', $uid);
    $stmt->bindParam(':eid', $eid);

    $res = $stmt->execute();

    if(!res){
        var_dump($stmt->errorInfo());
    }

    if(count($stmt->fetchAll(PDO::FETCH_ASSOC)) != 0){
        return false;
    }

    $sts = 0;

    $stmt = db()->prepare('INSERT INTO `'.USERS_EVENTS_TABLE.'` (user_id, event_id, status) VALUES(:uid, :eid, :sts)');

    $stmt->bindParam(':uid', $uid);
    $stmt->bindParam(':eid', $eid);
    $stmt->bindParam(':sts', $sts);

    $res = $stmt->execute();

    if(!res){
        var_dump($stmt->errorInfo());
    }

    return $res;
}


function updateStatusForEventWithId($uid, $eid){

    echo 'updating status with POST param';

    $params = array('status');
    if(!checkParamsSetPOST($params)){
        return false;
    }

    $stmt = db()->prepare('UPDATE `'.USERS_EVENTS_TABLE.'` SET status=:sts WHERE event_id=:eid AND user_id=:uid');

    $stmt->bindParam(':uid', $uid);
    $stmt->bindParam(':eid', $eid);
    $stmt->bindParam(':sts', $_POST['status']);

    $res = $stmt->execute();

    if(!res){
        var_dump($stmt->errorInfo());
    }

    return $res;
}


function getUserWithLogin(){

    echo 'searching for user based on POST login credentials'."\n";

    $params = array('username', 'password');
    if(!checkParamsSetPOST($params)){
        echo 'unset params';
        return false;
    }


    $stmt = db()->prepare('SELECT * FROM `'.USERS_TABLE.'` WHERE username=:un');
    $stmt->bindParam(':un', $_POST['username']);
    $res = $stmt->execute();

    if(!$res){
        var_dump($stmt->errorInfo());
    }

    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($arr) != 1){
        echo 'no such user';
        return false;
    }

    $user = $arr[0];

    if(hash('md5', $_POST['password'].$user['cinnamon']) == $user['password']){
        echo 'we made it';
        return $arr;
    }
    else{
        echo 'invalid credentials';
        return false;
    }

}








