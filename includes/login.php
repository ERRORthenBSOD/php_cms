<?php include "db.php";?>
<?php include "../admin/functions.php" ?>
<?php session_start(); ?>
<?php

if(isset($_POST['login'])){
    login_user($_POST['username'], $_POST['password']);
}
?>
<!--//    $password = crypt($password, $db_user_password);-->
<!---->
<!--//    if($username === $db_username && $password === $db_user_password){-->
<!--//        $_SESSION['username'] = $db_username;-->
<!--//        $_SESSION['firstname'] = $db_user_firstname;-->
<!--//        $_SESSION['lastname'] = $db_user_lastname;-->
<!--//        $_SESSION['user_role'] = $db_user_role;-->
<!--//        header("Location: ../admin");-->
<!--//    } else {-->
<!--//        header("Location: ../index.php");-->
<!--//    }-->
<!---->
