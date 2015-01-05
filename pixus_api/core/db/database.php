<?php
/**
 * Created by PhpStorm.
 * User: Akshat
 * Date: 12/29/14
 * Time: 6:02 PM
 */

$info = array(
    'host' => 'localhost',
    'user' => 'lynbnuqv_pixus',
    'password' => 'pixus123',
    'database' => 'lynbnuqv_pixus'
);

$DB = new PDO('mysql:host='.$info['host'].';dbname='.$info['database'], $info['user'], $info['password']);

echo 'logged into database!'."\n";