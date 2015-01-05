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







