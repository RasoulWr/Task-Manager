<?php
defined("ROOT_PATH") or die("<div style = '  margin: -5px; padding: 40px 30px; color: red; font-size: 50px;'> access denide!!</div>");
/**
 another instruction for above code
 if(!defined("ROOT_PATH")){
    echo "permission denide!!!";
}
 */

function diePage($msg){
    echo "<div style = ' padding: 42px 169px; margin: 47px 89px; background: #d27272; color: white ; font-family: sans-serif; border: 1px solid black; border-radius: 5px; font-size:20px; '> $msg </div>";
    die();
}
function isAjaxRequst(){
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
        // request is ajax
        return true;
    }else{
        // request is not ajax
        return false;
    }
}

function dd($tasks){
    echo "<pre style = 'background: #ffffff; color: #1668e4; font-size: 15px; padding: 15px 15px; margin: 5px 10px; border-radius: 7px; border-left: 2px  solid brown; border-right: 2px  solid brown; z-index: 999; position: relative;'>";
    var_dump($tasks);
    echo "</pre>";
    die();
}

function siteUrl($uri = ''){
    return URL_BASE.$uri;
}

function successMessage($msg ){
        echo "<div  style = ' padding: 42px 169px; margin: 47px 89px; background: green; color: white ; font-family: sans-serif; border: 1px solid black; border-radius: 5px; font-size:20px; '> $msg </div>";
}

function errorMessage($msg ){       
     echo "<div  style = ' padding: 42px 169px; margin: 47px 89px; background: #d27272; color: white ; font-family: sans-serif; border: 1px solid black; border-radius: 5px; font-size:20px; '> $msg </div>";
    }


function redirect($url){
    header("location:$url");
    die();
}
    

