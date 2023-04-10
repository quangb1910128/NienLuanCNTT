<?php
require_once '../bootstrap.php';
require_once('../Classes/PHPExcel.php');
use CT446\qld\QLdiem;
session_start();
$qldiem = new QLDiem($PDO);
$qld = $qldiem->dsgv();


if(isset($_POST['import'])){
    $conn = $PDO;
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $file = $_FILES['file']['tmp_name'];
    $objReader = PHPExcel_IOFactory::createReaderForFile($file);
    $listWorkSheets = $objReader->listWorksheetNames($file);
    foreach($listWorkSheets as $name){
        $objReader->setLoadSheetsOnly($name);

        $objExcel = $objReader->load($file);
        $sheetData = $objExcel->getActiveSheet()->toArray('null',true,true,true);
        $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();
        for($i = 2; $i<=$highestRow; $i++ ){
            $hoten = $sheetData[$i]['A'];
            $ngaysinh = $sheetData[$i]['B'];
            $gioitinh = $sheetData[$i]['C'];
            $diachi = $sheetData[$i]['D'];
            
            $sql = "SELECT * FROM giaovien WHERE hoten= '$hoten' AND ngaysinh = '$ngaysinh'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $count = $stmt->rowCount();
            if($count==0){
                $sql = "INSERT INTO giaovien(hoten, ngaysinh, gioitinh, diachi, chuyenmon) VALUE('$hoten','$ngaysinh',$gioitinh,'$diachi','$name')";
                $stmt = $conn->exec($sql);
                $msgv = $conn->lastInsertId();
                
                $qldiem->themtkgv($msgv);
            }
        }   
    }
    header("refresh: 0");

    $message = "Cập nhật thành công";
    echo "<script type='text/javascript'>alert('$message');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý giáo viên</title>
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
        <?php include('../partials/navbarquantri2.php') ?>
    </header>
    <main class="container">
        <br>
        <div class="row">
            <div class="col col-xs-6">
                <label for="file">Thêm giáo viên từ file excel</label>
                <form class="form-inline" action="" method="post" enctype="multipart/form-data">
                    <div classs="form-group">
                        <input class="form-control" type="file" name = "file">
                        <input class="btn btn-default" type="submit" value="Import" name ="import">
                    </div>
                </form>
            </div>
            
            <div class="pd col col-xs-6">
                <ul class="nav nav-pills navbar-right">
                    <li><a href="<?=BASE_URL_PATH . 'themgiaovien.php'?>">Thêm giáo viên</a></li>
                    <li><a href="<?=BASE_URL_PATH . 'xoagiaovien.php'?>">Xóa giáo viên</a></li>
                </ul>
            </div>
        </div>
        
        <br>
        <h2 class="section-heading text-center wow fadeIn" data-wow-duration="1s">Danh sách giáo viên</h2>
        <table id="table"  class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>MSGV</th>
                    <th>Họ Tên</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Chuyên môn</th>
                    <th>Giảng dạy</th>
                    <th>Chủ nhiệm</th>
                </tr>
            </thead>
            
            <tbody>
                <?php $stt =0; foreach($qld as $qldiem): if($qldiem->gioitinh ==1) $gt = 'Nam'; else $gt = 'Nữ' ?>
                <tr>
                    <td><?php echo ++$stt?></td>
                    <td><?=htmlspecialchars($qldiem->getmsgv())?></td>
                    <td><?=htmlspecialchars($qldiem->hoten)?></td>
                    <td><?=htmlspecialchars($qldiem->ngaysinh)?></td>
                    <td><?=htmlspecialchars($gt)?></td>
                    <td><?=htmlspecialchars($qldiem->chuyenmon)?></td>
                    <td>
                        <a class="btn btn-xs btn-warning" href="<?=BASE_URL_PATH . 'phanconggd.php?msgv=' . $qldiem->getmsgv()?>"><i alt="Edit" class="fa fa-pencil">Chọn</i></a>
                    </td>
                    <td>
                        <a class="btn btn-xs btn-warning" href="<?=BASE_URL_PATH . 'phancongcn.php?msgv=' . $qldiem->getmsgv()?>"><i alt="Edit" class="fa fa-pencil">Chọn</i></a>
                    </td>
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
	</script>
</body>

	
</html>