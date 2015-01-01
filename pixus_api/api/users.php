<?php
/**
 * Created by PhpStorm.
 * User: Akshat
 * Date: 12/29/14
 * Time: 5:54 PM
 */
require_once(CORE_LIB.'/db/includes.php');

function getUserWithId($id){

    //echo 'getUserWithId: Function reached';
    //echo $id;

    $stmt = db()->prepare('SELECT * FROM `users` WHERE id=:uid');
    $stmt->bindParam(':uid', $id);
    $stmt->execute();

    $arr = $stmt->fetch();
    return $arr;
}

