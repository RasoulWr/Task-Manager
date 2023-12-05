<?php
//defined("ROOT_PATH") OR die("permission denide!!");
include "bootstrap/init.php";
// dd($_SESSION);
$user = getLoggedInUser();
if(isset($_GET['logOut'])){
   logOut();
}
if(!isLoggedIn()){
   header("location:".siteUrl("auth.php")); // redirect to the written address
}

//delete folder with folderID in get Methode
if(isset($_GET['deletefolderId']) && is_numeric($_GET['deletefolderId'])){
   $deletedCount = deleteFolder($_GET['deletefolderId']);
   # echo "$deletedCount folder was successfuly deleted";
}
//delete taske with TaskID in get Methode
if(isset($_GET['deleteTaskId']) ){
   $deletedCount = deleteTask($_GET['deleteTaskId']);
   //echo "$deletedCount task was successfuly deleted";
}

$folders = getFolder();

 /**
  ENOTEHR WAY FOR SHOWING SPECIFIC TASK FOR ENY FOLDERS
  
      if(isset($_GET['folderId'])){
       $tasks = getTask($_GET['folderId']);}
       else{
       $tasks = getTask();
       }
     
  */
$tasks = getTask();

// dd($tasks);
include "tpl/tpl-index.php";