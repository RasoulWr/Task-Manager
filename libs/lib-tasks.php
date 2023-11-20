<?php

function getCurrentUserId(){
    /***** it will be completed soon */
    return 2;
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
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();

}


function getTask(){
    return 1;
}