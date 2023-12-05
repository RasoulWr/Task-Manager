<?php
defined("ROOT_PATH") or die("<div style = '  margin: -5px; padding: 40px 30px; color: red; font-size: 50px;'> access denide!!</div>");
function getCurrentUserId(){
    
    return getLoggedInUser()->id;
}

function getFolder(){
    global $pdo;
    $currenId = getCurrentUserId();
    $sql = "SELECT * FROM folders WHERE user_id = $currenId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $tuples = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $tuples;

}

function  deleteFolder($folderId){
    global $pdo;
    $sql = "DELETE FROM folders WHERE id = $folderId;";
    // remember sizeof($task)
    //$sql = "DELETE folders, tasks FROM folders JOIN tasks ON folders.id =tasks.folder_id WHERE folders.id = $folderId ; "; for delete folder and any task in it
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();

}

function addFolder($folderName){
    global $pdo;
    $currentId = getCurrentUserId();
    $sql = "INSERT INTO folders (name,user_id) VALUES (:fname,:userid);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['fname'=>$folderName,'userid'=>$currentId]);
    return 1;
}


function getTask(){
   global $pdo;
   $currentId = getCurrentUserId();
   $folder = $_GET['folderId'] ?? null;
   $folderCondition = '';
   if(isset($folder) && is_numeric($folder)){
    $folderCondition ="AND folder_Id = $folder" ;

   }
     //    if($folderId == null){
     //     $sql = "SELECT * FROM tasks where user_id = $currentId ";
     //    }else{
     //     $sql = "SELECT * FROM tasks where user_id = $currentId AND folder_id = $folderId ; ";
     //    }
   $sql = "SELECT * FROM tasks where user_id = $currentId $folderCondition;";
   $stmt = $pdo->prepare($sql);
   $stmt->execute();
   $tuples = $stmt->fetchAll(PDO::FETCH_OBJ);
   return $tuples;
}

function deleteTask($taskId){
    global $pdo;
    $sql = "DELETE FROM tasks WHERE id = :task_id;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["task_id"=>$taskId]);
    return 1;
}

function addTask($taskTitle,$folderId){
    global $pdo;
    $currentId = getCurrentUserId();
    $sql = "INSERT INTO tasks (title,user_id,folder_id) VALUES (:taskTitle,:userid,:folderId);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['taskTitle'=>$taskTitle,'userid'=>$currentId,'folderId'=>$folderId]);
    return 1;
}
function changeTaskStatus($taskId){
    global $pdo;
    $currenId = getCurrentUserId();
    $sql = "UPDATE tasks SET is_done = 1-is_done where id = :taskId AND user_id = :currentuserId ;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['taskId'=>$taskId,'currentuserId'=>$currenId]);
    
};