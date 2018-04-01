<?php include "../includes/db.php" ?>
<?php include "functions.php" ?>

<?php date_default_timezone_set('Europe/Moscow'); ?>
<?php ob_start(); ?>
<?php session_start(); ?>
<?php if(!isset($_SESSION['user_role'])){
        header("Location: ../index.php");
}?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMS Admin</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">


    <link href="css/sb-admin.css" rel="stylesheet">


    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/styles.css" rel="stylesheet">



    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>




    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>






    <script src="js/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
</head>

<body>
