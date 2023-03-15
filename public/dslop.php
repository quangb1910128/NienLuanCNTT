<?php
require_once '../bootstrap.php';
use CT446\qld\QLdiem;
session_start();
$qldiem = new QLDiem($PDO);
$qld = $qldiem->dslop();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Lớp</title>
</head>
<body>
    <div>
        <a href="lopphutrach.php">Lớp phụ trách</a>
        <a href="lopchunhiem.php">Lớp chủ nhiệm</a>
    </div>
    <div>
        <h3>Môn học: <?php echo $_SESSION['tenmon'] ?></h3>
        <a href="<?=BASE_URL_PATH . 'nhapdiemlop.php?mlop=' . $_REQUEST['mlop']?>">
            Nhập điểm cho lớp
        </a>
        <a href="suadiem.php">Sửa điểm</a>
        <br><br>    
        <div>Danh sách lớp 10A1</div>
        <table border="1">
            <thead>
                <tr>
                    <th>MSHS</th>
                    <th>Họ Tên</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php foreach($qld as $qldiem): ?>
            <tbody>
                
                <tr>
                    <td><?=htmlspecialchars($qldiem->getmshs())?></td>
                    <td><?=htmlspecialchars($qldiem->hoten)?></td>
                    <td><?=htmlspecialchars($qldiem->ngaysinh)?></td>
                    <td><?=htmlspecialchars($qldiem->gioitinh)?></td>
                    <td><a href="<?=BASE_URL_PATH . 'nhapdiem.php?mshs=' . $qldiem->getmshs()?>">Nhập điểm</a></td>
                </tr>
            </tbody>
            <?php endforeach ?>
        </table>
    </div>
</body>
</html>