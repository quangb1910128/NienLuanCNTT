<?php
require_once '../bootstrap.php';
use CT446\qld\QLdiem;
session_start();

$qldiem = new QLDiem($PDO);
$qld = $qldiem->dslopcn();
$qldiem->getlopcn();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lớp chủ nhiệm</title>
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
    <main class="container">

        <h3>Lớp <?php echo $_SESSION['tenlopcn'] ?></h3>
        <div class="pd">
            <ul class="nav nav-pills navbar-right">
                <li class="active"><a href="<?=BASE_URL_PATH . 'lopchunhiem.php'?>">Danh sách lớp</a></li>
                <li><a href="<?=BASE_URL_PATH . 'xemdiemtheomon.php'?>">Xem điểm môn</a></li>
            </ul>
        </div>
        <br>
        <h2 class="section-heading text-center wow fadeIn" data-wow-duration="1s">Danh sách lớp</h2>
        <table id="table"  class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>MSHS</th>
                    <th>Họ Tên</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Action</th>
                </tr>
            </thead>
            
            <tbody>
                <?php $stt =0; foreach($qld as $qldiem): if($qldiem->gioitinh ==1) $gt = 'Nam'; else $gt = 'Nữ'?>
                <tr>
                    <td><?php echo ++$stt ?></td>
                    <td><?=htmlspecialchars($qldiem->getmshs())?></td>
                    <td><?=htmlspecialchars($qldiem->hoten)?></td>
                    <td><?=htmlspecialchars($qldiem->ngaysinh)?></td>
                    <td><?=htmlspecialchars($gt)?></td>
                    <td><a class="btn btn-xs btn-warning" href="<?=BASE_URL_PATH . 'xemdiem.php?mshs=' . $qldiem->getmshs() . '&hoten=' . $qldiem->hoten ?>">Xem điểm</a></td>
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