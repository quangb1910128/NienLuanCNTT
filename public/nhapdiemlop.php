<?php
require_once '../bootstrap.php';
use CT446\qld\QLdiem;
session_start();
$qldiem = new QLDiem($PDO);
$qld = $qldiem->nhapdiemlop();

$codiem ='';
if(isset($_POST["cotdiem"])){
    $codiem = $_POST["cotdiem"];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập điểm cho lớp</title>
</head>
<body>

    <div>
        <a href="lopphutrach.php">Lớp phụ trách</a>
        <a href="lopchunhiem.php">Lớp chủ nhiệm</a>
    </div>
    <div>
        <h3>Môn học: <?php echo $_SESSION['tenmon'] ?></h3>
 
        <div>Nhập điểm cho lớp 10A1</div>
        <form action="<?=BASE_URL_PATH . 'nhapdiemlop.php?mlop=' . $_REQUEST['mlop']?>" method="post">
            <select name="cotdiem" id="">
                <option value="M">Điểm miệng</option>
                <option value="15p1">Điểm 15p lần 1</option>
                <option value="15p2">Điểm 15p lần 2</option>
                <option value="15p3">Điểm 15p lần 3</option>
                <option value="1t1">Điểm 1 tiết lần 1</option>
                <option value="1t2">Điểm 1 tiết lần 2</option>
                <option value="1t3">Điểm 1 tiết lần 3</option>
                <option value="hk">Điểm HK</option>
            </select>
            <input type="submit" value="Xác nhận">
        <table border="1">
            <thead>
                <tr>
                    <th>MSHS</th>
                    <th>Họ Tên</th>
                    <th>Ngày sinh</th>
                    <th><?php echo $codiem ?></th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($qld as $qldiem): ?>
                <tr>

                
                        <td><?=htmlspecialchars($qldiem->getmshs())?></td>
                        <td><?=htmlspecialchars($qldiem->hoten)?></td>
                        <td><?=htmlspecialchars($qldiem->ngaysinh)?></td>
                        
                        <form action="" method="post">
                        <td><input name="diemso" type="number" min="0" max="10" step=".25"></td>
                        <td><input name="submit" type="submit" value="Lưu"></td>
                        </form>
                <?php endforeach ?>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>