<?php
/**
 * Created by PhpStorm.
 * User: Akshat
 * Date: 12/29/14
 * Time: 6:02 PM
 */

$info = array(
    'host' => 'localhost',
    'user' => 'root',
    'password' => 'root',
    'database' => 'pixus'
);

$DB = new PDO('mysql:host='.$info['host'].';dbname='.$info['database'], $info['user'], $info['password']);
