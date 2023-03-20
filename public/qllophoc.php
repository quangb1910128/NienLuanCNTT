<?php
require_once '../bootstrap.php';
use CT446\qld\QLdiem;
session_start();
$_SESSION['msgv']=NULL;
$qldiem = new QLDiem($PDO);
$qld = $qldiem->dslophocchuaphancongcn();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body >
    <h3>Danh sách lớp chưa có giáo viên chủ nhiệm</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Tên lớp</th>
                <th>Sỉ số</th>
                <th>Acction</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($qld as $qldiem): ?>
            <tr>
                <td><?=htmlspecialchars($qldiem->tenlop)?></td>
                <td><?=htmlspecialchars($qldiem->siso)?></td>
                <td><a href="">Chọn chủ nhiệm</a></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>

    <h3>Danh sách lớp đã có giáo viên chủ nhiệm</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Tên lớp</th>
                <th>Sỉ số</th>
                <th>Acction</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($qld as $qldiem): ?>
            <tr>
                <td><?=htmlspecialchars($qldiem->tenlop)?></td>
                <td><?=htmlspecialchars($qldiem->siso)?></td>
                <td><a href="">Chọn chủ nhiệm</a></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>