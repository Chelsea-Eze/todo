\<?php
if (isset($_POST['signup-submit'])) {
    
    require 'db_conn.php';

    $username = $_POST['fullname'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: index.php?error=emptyfields&fullname=".$username."&mail=".$email);
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: index.php?error=invalidmailfullname");
        exit();                                                                                                                                            
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php?error=invalidmail&fullname=".$username);
        exit();
    }
    // elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    //     header("Location: index.php?error=invalidfullname&mail=".$email);
    //     exit();
    // }
    elseif ($password !== $passwordRepeat) {
        header("Location: index.php?error=Incorrect Password&fullname=".$username."&mail=".$email);
        exit();
    }
    else{

        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: index.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck >0){
                header("Location: index.php?error=usertaken&mail".$email);
                exit();
            }
            else{
                
                $sql = "INSERT INTO users (fullname, email, pwd) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: index.php?error=sqlerror");
                    exit();
                }
                else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                    header("Location: index.php?signup=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} 
else{
    header("Location: index.php");
    exit();
}