<?php
include "constant.php"; //  در این خط برای این روت پت شناسایی نمیشود چون در داخل خود همین فایل تعریف شده است و فعلا قابل شناسایی نیست
include ROOT_PATH."/bootstrap/config.php";
include ROOT_PATH."/vendor/autoload.php";
include ROOT_PATH."/libs/helpers.php";


try{
    $pdo = new PDO("mysql:host={$database_config->host};dbname=$database_config->db","{$database_config->user}","{$database_config->pass}");

}catch(PDOException $e){
    diePage("connection is faild!!"."{$e->getMessage()}"."in line {$e->getLine()}");

}


include ROOT_PATH."/libs/lib-tasks.php";
include ROOT_PATH."/libs/lib-auth.php";

