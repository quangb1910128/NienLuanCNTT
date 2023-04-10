<?php
require_once '../bootstrap.php';
use CT446\qld\QLdiem;
session_start();

$qldiem = new QLDiem($PDO);
$qld = $qldiem->lopphutrach();
$qld2 = $qldiem->mongd();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lớp phụ trách</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="css/sticky-footer.css" rel=" stylesheet">
	<link href="css/font-awesome.min.css" rel=" stylesheet">
	<link href="css/animate.css" rel=" stylesheet">
    <link href="css/style.css" rel=" stylesheet">
</head>
<body >
    <header>
        <?php include('../partials/navbar.php') ?>
    </header>
    <main class="container" >
        <div>
            <h3>Môn học: <?php echo $_SESSION['tenmon'] ?></h3>
            <br>
            <div>Danh sách các lớp phụ trách</div>
            <table class="table table-hover  ">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Lớp phụ trách</th>
                        <th>Sỉ số</th>
                    </tr>
                </thead>
                <tbody>
                <?php $stt = 0; foreach($qld as $qldiem): ?>
                    <tr>
                        <td><?php echo ++$stt ?></td>
                        <td>
                            <a href="<?=BASE_URL_PATH . 'dslop.php?mlop=' . $qldiem->getmlop()?>">
                                <?=htmlspecialchars($qldiem->tenlop)?>
                            </a>
                        </td>
                        <td><?=htmlspecialchars($qldiem->siso)?></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include('../partials/footer.php') ?>
    <script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    </script>
</body>
</html>