<?php

function diePage($msg){
    echo "<div style = ' padding: 42px 169px; margin: 47px 89px; background: #d27272; color: white ; font-family: sans-serif; border: 1px solid black; border-radius: 5px; font-size:20px; '> $msg </div>";
    die();
}
function isAjaxRequst(){
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
        //request is ajax
        return true;
    }else{
        return false;
    }
}