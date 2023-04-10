<?php
require_once '../bootstrap.php';
use CT446\qld\QLdiem;
session_start();
$qldiem = new QLDiem($PDO);
$qld = $qldiem->luugv();
$qld2 = $qldiem->themtk();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm giáo viên</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="<?= BASE_URL_PATH . "css/sticky-footer.css" ?>" rel=" stylesheet">
    <link href="<?= BASE_URL_PATH . "css/font-awesome.min.css" ?>" rel=" stylesheet">
    <link href="<?= BASE_URL_PATH . "css/animate.css" ?>" rel=" stylesheet">
    <link href="<?= BASE_URL_PATH . "css/style.css" ?>" rel=" stylesheet">

    <link href="//cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <?php include('../partials/navbarquantri2.php') ?>
    </header>
    <main class="container"> 
        <br>
        <div class="pd">
            <ul class="nav nav-pills navbar-right">
                <li class="active"><a href="<?=BASE_URL_PATH . 'themgiaovien.php'?>">Thêm giáo viên</a></li>
                <li><a href="<?=BASE_URL_PATH . 'xoagiaovien.php'?>">Xóa giáo viên</a></li>
            </ul>
        </div>
        <br>
        <h3 class="text-center">Nhập thông tin giáo viên</h3>
            <form action="" method="post">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Họ tên</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>Địa chỉ</th>
                            <th>Chuyên môn</th>
                            <th>Acction</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input name="hoten" type="text"></td>
                            <td><input name="ngaysinh" type="text"></td>
                            <td><input name="gioitinh" type="text"></td>
                            <td><input name="diachi" type="text"></td>
                            <td><input name="chuyenmon" type="text"></td>
                            <td><input name="submit"type="submit" value="Lưu"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
    </main>
    <?php include('../partials/footer.php') ?>

</body>
</html>