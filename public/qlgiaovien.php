<?php
require_once '../bootstrap.php';
use CT446\qld\QLdiem;
session_start();
$_SESSION['msgv']=NULL;
$qldiem = new QLDiem($PDO);
$qld = $qldiem->dsgv();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý giáo viên</title>
</head>
<body>
    <a href="<?=BASE_URL_PATH . 'qlhocsinh.php'?>">Quản lý học sinh</a>
    <br>
    <a href="<?=BASE_URL_PATH . 'qlgiaovien.php'?>">Quản lý giáo viên</a>
    <br>
    <a href="<?=BASE_URL_PATH . 'qllophoc.php'?>">Quản lý lớp học</a>
    <div>
        <a href="<?=BASE_URL_PATH . 'themgiaovien.php'?>">Thêm giáo viên</a>
        <a href="<?=BASE_URL_PATH . 'xoagiaovien.php'?>">Xóa giáo viên</a>
    </div>
    <div>   
        <div>Danh sách giáo viên</div>
        <table border="1">
            <thead>
                <tr>
                    <th>MSGV</th>
                    <th>Họ Tên</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Chuyên môn</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php foreach($qld as $qldiem): ?>
            <tbody>
                
                <tr>
                    <td><?=htmlspecialchars($qldiem->getmsgv())?></td>
                    <td><?=htmlspecialchars($qldiem->hoten)?></td>
                    <td><?=htmlspecialchars($qldiem->ngaysinh)?></td>
                    <td><?=htmlspecialchars($qldiem->gioitinh)?></td>
                    <td><?=htmlspecialchars($qldiem->chuyenmon)?></td>
                    <td><a href="<?=BASE_URL_PATH . 'phanconggd.php?msgv=' . $qldiem->getmsgv()?>">Phân công giảng dạy</a></td>
                </tr>
            </tbody>
            <?php endforeach ?>
        </table>
    </div>
</body>
</html>