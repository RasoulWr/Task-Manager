<?php
include "vendor/autoload.php";
include "constant.php";
include "libs/helpers.php";
include "config.php";

try{
    $pdo = new PDO("mysql:host={$database_config->host};dbname=$database_config->db","{$database_config->user}","{$database_config->pass}");

}catch(PDOException $e){
    diePage("connection is faild!!"."{$e->getMessage()}"."in line {$e->getLine()}");

}


include "libs/lib-tasks.php";
include "libs/lib-auth.php";
