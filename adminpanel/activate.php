<?php
include("query.php");

if(isset($_GET['token'])){
    $token=$_GET['token'];
    $query=$pdo->query("update admin SET status='active' WHERE token='$token'");

    if($query->execute()){
        if(isset($_SESSION['msg'])){
            $_SESSION['msg'] = "Account Activated Successfully";
            header("location: signin.php");
        }else{
            $_SESSION['msg'] = "You Are Logged out";
            header("location: signin.php");
        }
        exit;
    }else{
        $_SESSION['msg'] = "Account not Activated";
        header("location: signin.php");
        exit;
    }
}


?>