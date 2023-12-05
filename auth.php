<?php

include "bootstrap/init.php";
 
$homeUrl = siteUrl();
if($_SERVER['REQUEST_METHOD']=='POST'){ // check if form submitted or not
    //dd($_POST)
    $action = $_GET['action'];
    $params = $_POST;
    if($action == 'register'){
        $result = register($params);
        if($result == 1){
            redirect(siteUrl("auth.php"));
        }else{
            errorMessage($result);
        }
    }elseif($action == 'login'){
       if($result = login($params['email'],$params['password'])){
        redirect(siteUrl());
       }else{
        errorMessage(" password or email is wrong!!!");
       }
        
    }
}

include "tpl/tpl-auth.php";
