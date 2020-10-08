<?php

if (isset($_POST['login-submit'])) {
    

    require 'db_conn.php';

    $email = $_POST['mail'];
    $password = $_POST['pwd'];

    if (empty($email) || empty($password)) {
        header("Location: index.php?error=emptyfields");
    exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE email=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: index.php?error=sqlerror");
            exit(); 
        }
        else {
            
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                //echo password_verify($password, $row['pwd']); die;
                $pwdCheck = password_verify($password, $row['pwd']);
                if ($pwdCheck == false) {
                    header("Location: index.php?error=wrong password");
                    exit();
                }
                elseif ($pwdCheck == true) {
                    session_start();
                    $_SESSION['userId'] = $row['user_id'];
                    $_SESSION['fullname'] = $row['fullname'];
                    
                    header("Location: dashboard.php?login=success");
                    exit();
                }
                else {
                    header("Location: index.php?error=wrongpwd");
                    exit();
                }
            }
                else {
                    header("Location: index.php?error=nouser");
                    exit();
                }
        }
    }
}
// else {
//     header("Location: ../index.php");
//     exit();
// }