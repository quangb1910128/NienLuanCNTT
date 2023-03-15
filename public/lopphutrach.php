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
</head>
<body>
    <div>
        <a href="lopphutrach.php">Lớp phụ trách</a>
        <a href="lopchunhiem.php">Lớp chủ nhiệm</a>
    </div>
    <div>
        <h3>Môn học: <?php echo $_SESSION['tenmon'] ?></h3>
        <br>
        <div>Danh sách các lớp phụ trách</div>
        <table border="1">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Lớp phụ trách</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($qld as $qldiem): ?>
                <tr>
                    <td>1</td>
                    <td>
                        <a href="<?=BASE_URL_PATH . 'dslop.php?mlop=' . $qldiem->getmlop()?>">
                            <?=htmlspecialchars($qldiem->tenlop)?>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    
    </div>
</body>
</html>