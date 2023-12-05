<?php
   include "../bootstrap/init.php";

   if (!isAjaxRequst() ){ // اگر درخواست به این صفحه ایجکس نباشد
      diePage("request inavalid");
   }


   switch ($_POST['action']) {
      case 'addFolder':
         if(isset($_POST['folderName']) && strlen ($_POST['folderName']) > 3){
            echo addFolder($_POST['folderName']);
         }else{
            echo "folderName should be longer than 3 letters";
         }
      break;
      case 'addTask':
         if(($_POST['folderId']) == null ){
            echo "please select a folder";
            die();
         }
         if(strlen($_POST['taskTitle']) < 3 ){
            echo "Task Title should be more than 2 letters :)";
            die();
         }
            echo addTask($_POST['taskTitle'],$_POST['folderId']);
      break;
         // print_r($_POST);
         
      case 'taskSwitch':
         $taskId = $_POST['taskId'];
         changeTaskStatus($taskId);
      break;
      default:
         diePage("request invalid");
         break;
   }

   