<?php
require_once '../bootstrap.php';
use CT446\qld\QLdiem;
session_start();
$qldiem = new QLDiem($PDO);
$qld = $qldiem->dsgv();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa giáo viên</title>
</head>
<body>
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
                    <td><a href="<?=BASE_URL_PATH . 'delete.php?msgv=' . $qldiem->getmsgv()?>">Xóa</a></td>
                </tr>
            </tbody>
            <?php endforeach ?>
        </table>
    </div>
</body>
</html>