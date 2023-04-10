<?php
require_once '../bootstrap.php';
require_once('../Classes/PHPExcel.php');
use CT446\qld\QLdiem;
session_start();
$qldiem = new QLDiem($PDO);
$qld = $qldiem->dsdiem();

if(isset($_POST['import'])){
    $conn = $PDO;
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $file = $_FILES['file']['tmp_name'];
    $objReader = PHPExcel_IOFactory::createReaderForFile($file);
    $listWorkSheets = $objReader->listWorksheetNames($file);
    foreach($listWorkSheets as $name){
        if ($name == $_REQUEST['mlop']){
            $objReader->setLoadSheetsOnly($name);

            $objExcel = $objReader->load($file);
            $sheetData = $objExcel->getActiveSheet()->toArray('null',true,true,true);
            $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();
            for($i = 2; $i<=$highestRow; $i++ ){
                $mshs = $sheetData[$i]['A'];
                $hoten = $sheetData[$i]['B'];
                $m = $sheetData[$i]['C'];
                $p15_1 = $sheetData[$i]['D'];
                $p15_2 = $sheetData[$i]['E'];
                $p15_3 = $sheetData[$i]['F'];
                $t1_1 = $sheetData[$i]['G'];
                $t1_2 = $sheetData[$i]['H'];
                $t1_3 = $sheetData[$i]['I'];
                $hk = $sheetData[$i]['J'];

                //tao ma diem
                $mmon = $_SESSION['mmon'];
                $msgv = $_SESSION['msgv'];
                $sql = "SELECT * FROM diem WHERE mshs= $mshs AND mmon= '$mmon' AND mnamhoc= '$qldiem->mnamhoc' AND hocky= $qldiem->hocky AND msgv= $msgv";

                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $count = $stmt->rowCount();
                if($count==0){
                    $sql = "INSERT INTO diem (mshs, mmon, mnamhoc, hocky, msgv) VALUES ($mshs, '$mmon', '$qldiem->mnamhoc', $qldiem->hocky, $msgv)";
                    $stmt = $conn->exec($sql);
                    $md = $conn->lastInsertId();

                    $sql= "SELECT mdiem FROM diem WHERE mshs = $mshs AND msgv = $msgv AND mmon = '$mmon' AND mnamhoc = '$qldiem->mnamhoc' AND hocky = $qldiem->hocky";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $count = $stmt->rowCount();
                    
                    if($count>0){
                        $stmt = $conn->exec("INSERT INTO chitietdiem (mdiem) VALUES ($md)");
                    }
                }
                if($count ==1){
                    $sql= "SELECT mdiem FROM diem WHERE mshs = $mshs AND msgv = $msgv AND mmon = '$mmon' AND mnamhoc = '$qldiem->mnamhoc' AND hocky = $qldiem->hocky";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    while ($row = $stmt->fetch()) {
                        $md = $row['mdiem'];
                    }
                    // echo $md, $highestRow;
                }

                // Luu diem

                $x = array(
                    $md,
                    $m,
                    $p15_1,
                    $p15_2,
                    $p15_3,
                    $t1_1,
                    $t1_2,
                    $t1_3,
                    $hk
                );
                $y = array(
                    'mdiem',
                    'M',
                    '15p1',
                    '15p2',
                    '15p3',
                    '1t1',
                    '1t2',
                    '1t3',
                    'hk',
                );
                $sum = 0;
                $dem = 0;
                for ( $j =1 ; $j < count($x) ; $j++  ) {
                    if ($x[$j] !='' && $x[$j] !='null'){
                        $stmt = $conn->prepare("UPDATE chitietdiem
                            SET $y[$j] = '$x[$j]'  WHERE $y[0] = '$x[0]'");
                        $stmt->execute();
                        if($j==5 || $j==6 || $j==7){
                            $sum += $x[$j]*2;
                            $dem += 2;
                        }
                        if($j==8){
                            $sum += $x[$j]*3;
                            $dem +=3;
                        }
                        else {
                            $sum += $x[$j];
                            $dem ++;
                        }
                    }
                    
                    else{
                        $stmt = $conn->prepare("UPDATE chitietdiem SET $y[$j] = NULL WHERE $y[0] = '$x[0]'");   
                        $stmt->execute();
                    }
                }
                $tbhk='';
                if($sum>0)
                    $tbhk = round($sum/$dem,2);
                if($tbhk >=0 && $tbhk <= 10){    
                    $stmt2 = $conn->prepare("UPDATE chitietdiem
                        SET tbhk = '$tbhk'  WHERE $y[0] = '$x[0]'");
                    $stmt2->execute();
                }else {
                    $stmt = $conn->prepare("UPDATE chitietdiem SET tbhk = NULL WHERE $y[0] = '$x[0]'");
                    $stmt->execute();
                }
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
    <title>Danh Sách Điểm</title>

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
        <?php include('../partials/navbar.php') ?>
    </header>
    <main class="container">
        <h3>Môn học: <?php echo $_SESSION['tenmon'] ?></h3>
        <div class="pd">
            <ul class="nav nav-pills navbar-right">
                <li><a href="<?=BASE_URL_PATH . 'dslop.php?mlop=' . $_REQUEST['mlop']?>">Danh sách lớp</a></li>
                <li class="active"><a href="<?=BASE_URL_PATH . 'dsdiem.php?mlop=' . $_REQUEST['mlop']?>">Danh sách điểm</a></li>
            </ul>
        </div>
        <br>
        <label for="file">Nhập điểm từ file excel</label>
        <form class="form-inline" action="" method="post" enctype="multipart/form-data">
            <div class="form-group ">
                <input class="form-control" id="file" type="file" name = "file">
                <input class="btn btn-default" type="submit" value="Import" name ="import">
            </div>
        </form>
        <br>
        <h2 class="section-heading text-center wow fadeIn" data-wow-duration="1s">Danh sách lớp <?php print_r ($qldiem->gettenlop($_REQUEST['mlop'])) ?></h2>
        <table id="table"  class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">MSHS</th>
                    <th rowspan="2">Họ Tên</th>
                    <th rowspan="2">Miệng</th>
                    <th class="text-center" colspan="3">15 phút</th>
                    <th class="text-center" colspan="3">1 tiết</th>
                    <th rowspan="2">Học kỳ</th>
                    <th rowspan="2">TBM</th>
                    <th rowspan="2">Action</th>
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
            <?php foreach($qld as $qldiem): if($qldiem->gioitinh ==1) $gt = 'Nam'; else $gt = 'Nữ'?>
                <tr>
                    <td><?=htmlspecialchars($qldiem->getmshs())?></td>
                    <td><?=htmlspecialchars($qldiem->hoten)?></td>
                    <td><?=htmlspecialchars($qldiem->m)?></td>
                    <td><?=htmlspecialchars($qldiem->p15_1)?></td>
                    <td><?=htmlspecialchars($qldiem->p15_2)?></td>
                    <td><?=htmlspecialchars($qldiem->p15_3)?></td>
                    <td><?=htmlspecialchars($qldiem->t1_1)?></td>
                    <td><?=htmlspecialchars($qldiem->t1_2)?></td>
                    <td><?=htmlspecialchars($qldiem->t1_3)?></td>
                    <td><?=htmlspecialchars($qldiem->hk)?></td>
                    <td><?=htmlspecialchars($qldiem->tbhk)?></td>
                    <td><a class="btn btn-xs btn-warning" href="<?=BASE_URL_PATH . 'nhapdiem.php?mshs=' . $qldiem->getmshs()?>">Sửa điểm</a></td>
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