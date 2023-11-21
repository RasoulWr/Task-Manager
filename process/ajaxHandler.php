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
      
      default:
         diePage("request invalid");
         break;
   }

   