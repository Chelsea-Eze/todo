<?php

session_start();

$user_id = $_SESSION['userId'];

if(isset($_POST['title'])){
    require 'db.inc.php';

    $title = $_POST['title'];
    $dueDate = $_POST['dueDate'];

    if(empty($title)){
        header("Location: task.php?mess=error");
    }else {
        
        // $stmt = $conn->prepare("INSERT INTO todos(title) VALUE(?)");
        $stmt = $conn->prepare("INSERT INTO todos(title, dueDate, user_id) VALUE(?,?,?)");
        // $stmt = $conn->prepare("SELECT * FROM `todos` where user_id = $user_id");
        $res = $stmt->execute([$title,$dueDate,$user_id]);

        if($res){
            header("Location: task.php?mess=success");
        }else {
            header("Location: task.php");
        }
        $conn = null;
        exit();
    }
}else{
    header("Location: task.php?mess=error");
}
