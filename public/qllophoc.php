<?php
require_once '../bootstrap.php';
use CT446\qld\QLdiem;
session_start();
$qldiem = new QLDiem($PDO);
$qld = $qldiem->alllop();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý lớp học</title>
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
<body >
    <header>
        <?php include('../partials/navbarquantri3.php') ?>
    </header>
    <main class="container">
        <h3>Danh sách tất cả các lớp</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Lớp</th>
                    <th>Sỉ số</th>
                    <th>Acction</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($qld as $qldiem): ?>
                <tr>
                    <td><?=htmlspecialchars($qldiem->tenlop)?></td>
                    <td><?=htmlspecialchars($qldiem->siso)?></td>
                    <td><a href="">Xem</a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </main>
    <?php include('../partials/footer.php') ?>
</body>
</html>