
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title><?= SITE_TITLE?></title>
  <link rel="stylesheet" href="<?= URL_BASE?>assets/css/style.css">

</head>
<body>
<!-- partial:index.partial.html -->

<div class="page">
  <div class="pageHeader">
    <div class="title">Dashboard</div>
    <div class="userPanel"><a href="<?= "?logOut=1" ?>"><i class="fa fa-sign-out"></i></a><span class="username"><?= $user->name ?> </span>
    <img src="<?= $user->image ?>" width="40" height="40"/></div>
  </div>
  <div class="main">
    <div class="nav">
      <div class="searchbox">
        <div><i class="fa fa-search"></i>
          <input type="search" placeholder="Search"/>
        </div>
      </div>
      <div class="menu">
        <div class="title">Folders</div>
        <ul>
          <div id="list_wrapper">
          <li class= <?=(!isset($_GET['folderId'])) ?"active" : ''?>>
            <a href="<?= siteUrl() ?>"><i class="fa fa-tasks"></i>All Folders</a>
          </li>
            <?php  foreach ($folders as $folder):?>
            <li class =  <?= (isset($_GET['folderId']) && $_GET['folderId'] ==$folder->id)?"active" :'' ?>>
              <a href=" <?=siteUrl("?folderId=$folder->id")?>">  <i class="fa fa-folder"></i><?= $folder->name?></a>
              <a href="<?= siteUrl("?deletefolderId= $folder->id")?>"> <i class = "fa fa-trash-o" id="trashIcon" onclick="return confirm('sure about delete this folder?');"></i></a>
            </li>
            <?php endforeach;?>
          </div>
        </ul>
      </div>
      <div>
        <input type="text" id="AddFolderInput" placeholder=" add new folder">
        <button id="AddFolderBtn" class="btn" style="cursor: pointer;">+</button>
      </div>
    </div>
    <div class="view">
      <div class="viewHeader">
        <div class="title"><input type="text" id="AddTaskInput" placeholder=" add new Task" style="border: 1px solid green; width: 260%; padding: 7px  ; border-radius: 6px" ></div>
        <div class="functions">
          <div class="button active">Add New Task</div>
          <div class="button">Completed</div>
          <div class="button inverz"><i class="fa fa-trash-o"></i></div>
        </div>
      </div>
      <div class="content">
        <div class="list">
          <div class="title">Today</div>
          <?php if(sizeof($tasks)> 0): ?>
          <?php  foreach($tasks as $task):?>
          <ul class="task" style="display: contents;">
            <li class= <?= ($task->is_done) ?  "checked" :""?>>
            <i data-taskId="<?=$task->id ?>"  class="isDone fa <?= ($task->is_done) ? "fa-check-square-o" :"fa-square-o"?> "></i>
            <span><?= $task->title?></span>
             <div class="info">
             <span style="font-size: 12px; color: #34abab;"><?= $task->created_at ?></span>
             <a href="?deleteTaskId=<?=$task->id ?>"><i class = "fa fa-trash-o" id="trashIcon" onclick="return confirm('sure about delete this task?');"></i></a>
             </div> 
            </li>
            <?php  endforeach?>
            <?php else: ?>
              
              <p style="font-size: 20px;"> there is no task an here...</p>
            <?php  endif ?>

            
          </ul>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- partial -->
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="assets/js/script.js"></script>
  <script>
    $(document).ready(function(){
      $('#AddFolderBtn').click(function(e){
        var input = $('#AddFolderInput');
        $.ajax({
          url :'process/ajaxHandler.php',
          method:'post',
          data:{action:'addFolder', folderName:input.val()},
          success : function(response){
          if(response == '1'){
            $('<li> <a href="">  <i class="fa fa-folder"></i>'+input.val()+'</a> <i class = "fa fa-trash-o" id="trashIcon"></i></li>').appendTo('#list_wrapper');
          }else{
            alert(response);
          }
          }
           });
          });

          $('#AddTaskInput').keydown(function (e) {
            var input =  $('#AddTaskInput');
             if (e.keyCode == 13) { // if pressd enter
              $.ajax({
                url:'process/ajaxHandler.php',
                method:'post',
                // data:{action:'addTask',folderId:"<s?php  $_GET['folderId] ?? 0" ?>",taskTitle:input.val()} ; alternative for below code
                data:{action:'addTask',folderId:"<?php  echo (!isset($_GET['folderId'])) ? '': "{$_GET['folderId']}" ?>",taskTitle:input.val()},
                success:function(response){
                  if(response == 1) {
                    location.reload();
                  }else{
                    alert(response);
                  }
                  

                }
              });
             
            }
            });

            $('.isDone').click(function(){
             var tId=$(this).attr('data-taskId'); //tId meaning taskId
              // alert(taskId);
              $.ajax({
                url:'process/ajaxHandler.php',
                method:'post',
                data:{action:'taskSwitch',taskId:tId},
                success:function(){
                  location.reload();
                }
              })
            })
        
      });


    
       
  </script>

</body>
</html>
