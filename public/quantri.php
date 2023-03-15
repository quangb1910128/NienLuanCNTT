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
    <title>Document</title>
</head>
<body>
    <a href="<?=BASE_URL_PATH . 'qlhocsinh.php'?>">Quản lý học sinh</a>
    <br>
    <a href="<?=BASE_URL_PATH . 'qlgiaovien.php'?>">Quản lý giáo viên</a>
    <br>
    <a href="<?=BASE_URL_PATH . 'qllophoc.php'?>">Quản lý lớp học</a>
</body>
</html>