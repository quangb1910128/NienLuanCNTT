<?php
require_once '../bootstrap.php';
use CT446\qld\QLdiem;
session_start();
if(!isset($_SESSION['msgv']))
$_SESSION['msgv'] = $_REQUEST['msgv']; 

$qldiem = new QLDiem($PDO);
$qld = $qldiem->dslophocchuaphancongcn();
$qld2 = $qldiem->dslophocdaphancongcn();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phân công chủ nhiệm</title>
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
</head>
<body>
    <header>
        <?php include('../partials/navbarquantri2.php') ?>
    </header>
    <main class="container">
        <h4>Phân công chủ nhiệm cho giáo viên <b><?php echo $qldiem->gettengv($_REQUEST['msgv']) ?></b></h4>
        <br><br>
        <div class="row">
            <div class="col col-xs-4">
            <h4 class="text-center">Danh sách lớp chưa có giáo viên chủ nhiệm</h4>
            <br>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Lớp</th>
                            <th>Acction</th>
                        </tr>
                    </thead>
                    <?php foreach($qld as $qldiem): ?>
                    <tbody>
                        <tr>
                            <td><?=htmlspecialchars($qldiem->tenlop)?></td>
                            <td><a href="<?=BASE_URL_PATH . 'phancongcn2.php?mlop=' . $qldiem->getmlop() . '&msgv=' . $_REQUEST['msgv']?>">Chọn</a></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="col col-xs-1"></div>
            <div class="col col-xs-7">
            <h4 class="text-center">Danh sách lớp đã có giáo viên chủ nhiệm</h4>
            <br>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Lớp</th>
                            <th>Chủ nhiệm</th>
                            <th>Acction</th>
                        </tr>
                    </thead>
                    <?php foreach($qld2 as $qldiem): ?>
                    <tbody>
                        <tr>
                            <td><?=htmlspecialchars($qldiem->tenlop)?></td>
                            <td><?=htmlspecialchars($qldiem->hoten)?></td>
                            <td><a href="<?=BASE_URL_PATH . 'huyphancongcn.php?mchunhiem=' . $qldiem->getmchunhiem() . '&msgv=' . $_REQUEST['msgv']?>">Xóa</a></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php include('../partials/footer.php') ?>
</body>
</html>