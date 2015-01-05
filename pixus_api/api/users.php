<?php
/**
 * Created by PhpStorm.
 * User: Akshat
 * Date: 12/29/14
 * Time: 5:54 PM
 */
require_once(CORE_LIB.'/db/includes.php');

function getUserWithId($id){

    echo 'getting user with id: '.$id." \n";

    $stmt = db()->prepare('SELECT * FROM `USERS_TABLE` WHERE id=:uid');
    $stmt->bindParam(':uid', $id);
    $stmt->execute();


    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $arr;
}

function getEventsForUserWithId($id){

    $stmt = db()->prepare('SELECT event_id FROM `USERS_EVENTS_TABLE` WHERE id=:uid');
    $stmt->bindParam(':uid', $id);
    $stmt->execute();

    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $arr;
}


function newUserWithParams(){

    $params = array('first_name', 'last_name', 'username', 'password');

    foreach($params as $p){
        if(!isset($_POST[$p])){
            return false;
        }
    }

    $stmt = db()->prepare('INSERT INTO `USERS_TABLE` (first_name, last_name, username, password, cinnamon) VALUES (:fn. :ln, :un, :pw, :cnm)');
    $stmt->bindParam(':fn', $_POST['first_name']);
    $stmt->bindParam(':ln', $_POST['last_name']);
    $stmt->bindParam(':un', $_POST['username']);

    $cnm = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);

    $stmt->bindParam(':cnm', $cnm);

    $pw = password_hash($_POST['password'].$cnm, PASSWORD_DEFAULT);

    $stmt->bindParam(':pw', $pw);
    $stmt->execute();
}







