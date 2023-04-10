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
    <title>Nhập điểm</title>
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
        <h4>Học sinh: <?php echo $qldiem->gettenhs() ?></h4>
    
        <br>
        <div>Bảng điểm</div>
        <form class="" action="" method="post">
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-primary">
                        <th>Miệng</th>
                        <th class="text-center" colspan=3>15 phút</th>
                        <th class="text-center" colspan=3>1 tiết</th>
                        <th>Học kỳ</th>
                        <th>TBHK</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($qld as $qldiem): ?>
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
                    <?php endforeach ?>
                </tbody>
            </table>
        </form>
    </main>
    <?php include('../partials/footer.php') ?>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</body>
</html>