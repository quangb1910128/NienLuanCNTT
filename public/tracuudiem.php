<?php
require_once '../bootstrap.php';
use CT446\qld\QLdiem;
session_start();

$qldiem = new QLDiem($PDO);
$qld = $qldiem->gettenhs();
$qld1 = $qldiem->hienthidiem1();
$qld2 = $qldiem->hienthidiem2();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tra cứu điểm</title>
</head>
<body>
    <form action="">
        <table>
            <tbody>
                <tr>Tra cứu điểm học sinh <b><?php echo $_SESSION['hoten'] ?></b></tr>
                <tr>
                    <td>Chọn năm học</td>
                    <td>
                        <select name="" id="">
                            <option value="2018">2018-2019</option>
                            <option value="2019">2019-2020</option>
                            <option value="2020">2020-2021</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="Xác nhận"></td>
                    
                </tr>
            </tbody>
        </table>
    </form>
    <br>
    <div>
        Kết quả học tập của <b><?php echo $_SESSION['hoten'] ?></b> trong học kỳ 1
    </div>
    <table border="1">
        <tbody>
            <tr>
                <td>Điểm TB</td>
                <td  width="200"><?=htmlspecialchars($qldiem->diemtbhk1)?></td>
            </tr>
             <tr>
                <td>Xếp hạng</td>
                <td></td>
            </tr>
             <tr>
                <td>Danh hiệu</td>
                <td></td>
            </tr>
             <tr>
                <td>Học lực</td>
                <td></td>
            </tr>
    
        </tbody>
    </table>
    <br>
    <div>
        Bảng điểm các môn học kỳ 1
    </div>
    <table border="1" width="500">
        <thead>
            <tr>
                <th>Môn học</th>
                <th>Miệng</th>
                <th colspan="3">15 phút</th>
                <th colspan="3">1 tiết</th>
                <th>Học Kỳ</th>
                <th>TBM</th>
            </tr>
        </thead>
        <tbody>
        <?php if($qld1!=1) foreach($qld1 as $qldiem): ?>
            <tr>
                <td><?=htmlspecialchars($qldiem->tenmon)?></td>
                <td><?=htmlspecialchars($qldiem->m)?></td>
                <td><?=htmlspecialchars($qldiem->p15_1)?></td>
                <td><?=htmlspecialchars($qldiem->p15_2)?></td>
                <td><?=htmlspecialchars($qldiem->p15_3)?></td>
                <td><?=htmlspecialchars($qldiem->t1_1)?></td>
                <td><?=htmlspecialchars($qldiem->t1_2)?></td>
                <td><?=htmlspecialchars($qldiem->t1_3)?></td>
                <td><?=htmlspecialchars($qldiem->hk)?></td>
                <td><?=htmlspecialchars($qldiem->tbhk)?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>

    <br>
    <div>
        Kết quả học tập của <b>Đoàn Minh Quang</b> trong học kỳ 2
    </div>
    <table border="1">
        <tbody>
            <tr>
                <td>Điểm TB</td>
                <td  width="200"></td>
            </tr>
             <tr>
                <td>Xếp hạng</td>
                <td></td>
            </tr>
             <tr>
                <td>Danh hiệu</td>
                <td></td>
            </tr>
             <tr>
                <td>Học lực</td>
                <td></td>
            </tr>
    
        </tbody>
    </table>
    <br>
    <div>
        Bảng điểm các môn học kỳ 2
    </div>
    <table border="1" width="500">
        <thead>
            <tr>
                <th>Môn học</th>
                <th>Miệng</th>
                <th colspan="3">15 phút</th>
                <th colspan="3">1 tiết</th>
                <th>Học Kỳ</th>
                <th>TBM</th>
            </tr>
        </thead>
        <tbody>
        
        <?php if($qld2!=1)foreach($qld2 as $qldiem): ?>
            <tr>
                <td><?=htmlspecialchars($qldiem->tenmon)?></td>
                <td><?=htmlspecialchars($qldiem->m)?></td>
                <td><?=htmlspecialchars($qldiem->p15_1)?></td>
                <td><?=htmlspecialchars($qldiem->p15_2)?></td>
                <td><?=htmlspecialchars($qldiem->p15_3)?></td>
                <td><?=htmlspecialchars($qldiem->t1_1)?></td>
                <td><?=htmlspecialchars($qldiem->t1_2)?></td>
                <td><?=htmlspecialchars($qldiem->t1_3)?></td>
                <td><?=htmlspecialchars($qldiem->hk)?></td>
                <td><?=htmlspecialchars($qldiem->tbhk)?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    <br>
    <div>
        Kết quả học tập cả năm của <b>Đoàn Minh Quang</b>
    </div>
     <table border="1">
        <tbody>
            <tr>
                <td>Điểm TB</td>
                <td  width="200"><?=htmlspecialchars($qldiem->diemtbhk2)?></td>
            </tr>
             <tr>
                <td>Xếp hạng</td>
                <td></td>
            </tr>
             <tr>
                <td>Danh hiệu</td>
                <td></td>
            </tr>
             <tr>
                <td>Học lực</td>
                <td></td>
            </tr>
    
        </tbody>
    </table>
    <br>
     <div>
        Bảng điểm cả năm
    </div>
    <table border="1" width="500">
        <tbody>
            <tr>
                <th>Môn học</th>
                <th>TBM</th>
            </tr>
            <tr>
                <td>Toán Học</td>
                <td></td>
            </tr>
            <tr>
                <td>Vật Lý</td>
                <td></td>
            </tr>
            <tr>
                <td>Hóa Học</td>
                <td></td>
            </tr>
            <tr>
                <td>Sinh học</td>
                <td></td>
            </tr>
            <tr>
                <td>Tin học</td>
                <td></td>
            </tr>
            <tr>
                <td>Công nghệ</td>
                <td></td>
            </tr>
            <tr>
                <td>Ngữ văn</td>
                <td></td>
            </tr>
            <tr>
                <td>Lịch sử</td>
                <td></td>
            </tr>
            <tr>
                <td>Địa lý</td>
                <td></td>
            </tr>
            <tr>
                <td>Ngoại ngữ</td>
                <td></td>
            </tr>
            <tr>
                <td>GDCD</td>
                <td></td>
            </tr>
            <tr>
                <td>Thể dục</td>
                <td></td>
            </tr>
            <tr>
                <td>GDQP</td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>