<?php
require_once '../bootstrap.php';
use CT446\qld\QLdiem;
session_start();
if(!isset($_SESSION['msgv']))
$_SESSION['msgv'] = $_REQUEST['msgv']; 

$qldiem = new QLDiem($PDO);
$qld = $qldiem->laychuyenmon();
$qld = $qldiem->dslophocchuaphanconggd();
$qld2 = $qldiem->dslophocdaphanconggd();

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
    <table border="1">
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
                <td><a href="<?=BASE_URL_PATH . 'phanconggd2.php?mlop=' . $qldiem->getmlop()?>">Chọn</a></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>

    <table border="1">
        <thead>
            <tr>
                <th>Lớp</th>
                <th>Giáo viên giảng dạy</th>
                <th>Acction</th>
            </tr>
        </thead>
        <?php foreach($qld2 as $qldiem): ?>
        <tbody>
            <tr>
                <td><?=htmlspecialchars($qldiem->tenlop)?></td>
                <td><?=htmlspecialchars($qldiem->hoten)?></td>
                <td><a href="<?=BASE_URL_PATH . 'huyphancong.php?mgd=' . $qldiem->getmgd()?>">Xóa</a></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>