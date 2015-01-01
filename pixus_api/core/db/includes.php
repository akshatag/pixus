<?php
/**
 * Created by PhpStorm.
 * User: Akshat
 * Date: 12/29/14
 * Time: 6:14 PM
 */

require_once('database.php');

define('USERS_TABLE', 'users');

function db(){
    global $DB;
    return $DB;
}