<?php
require_once '../bootstrap.php';
use CT446\qld\QLdiem;
session_start();
if(!isset($_SESSION["quantri"])){
    header('location: loginquantri.php');
}
$qldiem = new QLDiem($PDO);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="css/sticky-footer.css" rel=" stylesheet">
	<link href="css/font-awesome.min.css" rel=" stylesheet">
	<link href="css/animate.css" rel=" stylesheet">
    <link href="css/style.css" rel=" stylesheet">
</head>
<body>
    <header>
        <?php include('../partials/navbarquantri.php') ?>
    </header>
    
    <br>
    
    <br>
    
</body>
</html>