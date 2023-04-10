<?php
require_once '../bootstrap.php';
use CT446\qld\QLdiem;
session_start();

$qldiem = new QLDiem($PDO);
if(isset($_GET['submit'])){
    $qld = $qldiem->dsdiemtheomon($_SESSION['mlopcn'], $_GET['mmon'],$_GET['hocky']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem điểm theo môn học</title>
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
        <?php include('../partials/navbar2.php') ?>
    </header>
    <main class="container" >
        <div>
            <h3>Lớp <?php echo $_SESSION['tenlopcn']?></h3>
        </div>
        <div class="pd">
            <ul class="nav nav-pills navbar-right">
                <li><a href="<?=BASE_URL_PATH . 'lopchunhiem.php'?>">Danh sách lớp</a></li>
                <li class="active"><a href="<?=BASE_URL_PATH . 'xemdiemtheomon.php'?>">Xem điểm môn</a></li>
            </ul>
        </div>
        <br>
        <div>
            <form class="form-inline" action="" method="get">
                <div class="form-group ">
                    Môn học:     
                    <select class="form-control" name="mmon" id="">
                        <option value="toan">Toán</option>
                        <option value="ly">Vật lý</option>
                        <option value="hoa">Hóa học</option>
                        <option value="sinh">Sinh Học</option>
                        <option value="tin">Tin học</option>
                        <option value="cn">Công nghệ</option>
                        <option value="van">Ngữ văn</option>
                        <option value="su">Lịch sử</option>
                        <option value="dia">Địa lý</option>
                        <option value="nn">Ngoại ngữ</option>
                        <option value="gdcd">GDCD</option>
                        <option value="td">Thể dục</option>
                        <option value="gdqp">GDQP</option>
                    </select>
                    Học kỳ:
                    <select class="form-control" name="hocky" id="">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                    <input class="btn btn-default" type="submit" name="submit" value="Xác nhận">
                </div>
            </form>
        </div>
        <br>
        <div>
            <h3 class="section-heading text-center wow fadeIn" data-wow-duration="1s">Bảng điểm môn <?php if(isset($_GET['submit'])) echo $qldiem->gettenmon($_GET['mmon']) ?> học kì <?php if(isset($_GET['submit'])) echo $qldiem->hocky ?> năm học <?php if(isset($_GET['submit'])) echo $qldiem->mnamhoc ?></h3>
        </div>
        <br>
        <table id="table"  class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">STT</th>
                    <th rowspan="2">MSHS</th>
                    <th rowspan="2">Họ tên</th>
                    <th rowspan="2">Ngày sinh</th>
                    <th rowspan="2">Điểm miệng</th>
                    <th class="text-center" colspan="3">Điểm 15p</th>
                    <th class="text-center" colspan="3">Điểm 1 tiết</th>
                    <th rowspan="2">Học kỳ</th>
                    <th rowspan="2">TBM</th>
                </tr>
                <tr>
                    <th>Lần 1</th>
                    <th>Lần 2</th>
                    <th>Lần 3</th>
                    <th>Lần 1</th>
                    <th>Lần 2</th>
                    <th>Lần 3</th>
                </tr>
            </thead>
            <tbody>
            
                <?php $stt=0; if(isset($_GET['submit'])) foreach($qld as $qldiem): ?>
                <tr>
                    <td><?php echo ++$stt ?></td>
                    <td><?=htmlspecialchars($qldiem->getmshs())?></td>
                    <td><?=htmlspecialchars($qldiem->hoten)?></td>
                    <td><?=htmlspecialchars($qldiem->ngaysinh)?></td>
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
    </main>
    <?php include('../partials/footer.php') ?>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="//cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<script src="<?= BASE_URL_PATH . "js/wow.min.js" ?>"></script>
	<script>
		$(document).ready(function() {
			new WOW().init();
			$('#table').DataTable();
		});
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
	</script>
</body>
</html>