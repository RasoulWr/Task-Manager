<?php
include "bootstrap/init.php";

if(isset($_GET['deletefolderId']) && is_numeric($_GET['deletefolderId'])){
   $deletedCount = deleteFolder($_GET['deletefolderId']);
   # echo "$deletedCount folder was successfuly deleted";
}

$folders = getFolder();

# $tasks = getTask();
include "tpl/tpl-index.php";