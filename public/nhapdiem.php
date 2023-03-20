<?php
require_once '../bootstrap.php';
use CT446\qld\QLdiem;
session_start();
$qldiem = new QLDiem($PDO);
$qld = $qldiem->taomdiem();
$qld = $qldiem->diemcanhan();
$qld2 = $qldiem->luudiem2();
$qld = $qldiem->diemcanhan();

$_SESSION['mshs'] = $_REQUEST['mshs'];
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
        <h4>Học sinh: MSHS: <?php echo $_REQUEST['mshs'] ?></h4>
    
        <br>
        <div>Bảng điểm</div>
        <!-- <table border="1">
            <thead>
                <tr>
                    <th>Miệng</th>
                    <th colspan=3>15 phút</th>
                    <th colspan=3>1 tiết</th>
                    <th>Học kỳ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($qld as $qldiem): ?>
                <tr>
                    <td><?=htmlspecialchars($qldiem->m)?></td>
                
                    <td><?=htmlspecialchars($qldiem->p15_1)?></td>
                
                    <td><?=htmlspecialchars($qldiem->p15_2)?></td>
                
                    <td><?=htmlspecialchars($qldiem->p15_3)?></td>
                
                    <td><?=htmlspecialchars($qldiem->t1_1)?></td>
                
                    <td><?=htmlspecialchars($qldiem->t1_2)?></td>
                
                    <td><?=htmlspecialchars($qldiem->t1_3)?></td>
                
                    <td><?=htmlspecialchars($qldiem->hk)?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table> -->
        <form action="" method="post">
            <table border="1">
                <thead>
                    <tr>
                        <th>Miệng</th>
                        <th colspan=3>15 phút</th>
                        <th colspan=3>1 tiết</th>
                        <th>Học kỳ</th>
                        <th>TBHK</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input name="M" type="number" min="0" max="10" step=".05" value="<?=htmlspecialchars($qldiem->m)?>"></td>
                        <td><input name="15p1" type="number" min="0" max="10" step=".05" value="<?=htmlspecialchars($qldiem->p15_1)?>"></td>
                        <td><input name="15p2" type="number" min="0" max="10" step=".05" value="<?=htmlspecialchars($qldiem->p15_2)?>"></td>
                        <td><input name="15p3" type="number" min="0" max="10" step=".05" value="<?=htmlspecialchars($qldiem->p15_3)?>"></td>
                        <td><input name="1t1" type="number" min="0" max="10" step=".05" value="<?=htmlspecialchars($qldiem->t1_1)?>"></td>
                        <td><input name="1t2" type="number" min="0" max="10" step=".05" value="<?=htmlspecialchars($qldiem->t1_2)?>"></td>
                        <td><input name="1t3" type="number" min="0" max="10" step=".05" value="<?=htmlspecialchars($qldiem->t1_3)?>"></td>
                        <td><input name="hk" type="number" min="0" max="10" step=".05" value="<?=htmlspecialchars($qldiem->hk)?>"></td>
                        <td><input name="tb" type="number" min="0" max="10" step=".01" disabled value="<?=htmlspecialchars($qldiem->tbhk)?>"></td>
                        <td><input type="submit" value="Lưu"></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</body>
</html>