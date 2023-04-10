<?php
require_once '../bootstrap.php';
use CT446\qld\QLdiem;
session_start();

$qldiem = new QLDiem($PDO);
$qld1 = $qldiem->hienthidiem1($_SESSION['mshs']);
$qld2 = $qldiem->hienthidiem2($_SESSION['mshs']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tra cứu điểm</title>
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
    <main class="container">
        <div class="row">
            <div class="col-xs-2"></div>
            <div class="col-xs-8">
                <br><br>
                <div>
                    <p>Kết quả học tập của <b><?php echo $qldiem->gettenhs($_SESSION['mshs']) ?></b> trong học kỳ 1</p>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td>Điểm TB</td>
                                    <td><?=htmlspecialchars($qldiem->diemtbhk1)?></td>
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
                    </div>
                    <div class="col-xs-6"></div>
                </div>
                <br>
                <p class="text-center"><b>Bảng điểm các môn học kỳ 1</b></p>
                <table class="table table-striped table-bordered" width="500">
                    <thead>
                        <tr class="bg-primary">
                            <th>Môn học</th>
                            <th>Miệng</th>
                            <th class="text-center" colspan="3">15 phút</th>
                            <th class="text-center" colspan="3">1 tiết</th>
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
                    <p?>Kết quả học tập của <b><?php echo $qldiem->gettenhs($_SESSION['mshs']) ?></b> trong học kỳ 2</p>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td>Điểm TB</td>
                                    <td><?=htmlspecialchars($qldiem->diemtbhk2)?></td>
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
                    </div>
                    <div class="col-xs-6"></div>
                </div>
                <br>
                <p class="text-center"><b>Bảng điểm các môn học kỳ 2</b></p>
                <table class="table table-striped table-bordered" width="500">
                    <thead>
                        <tr class="bg-primary">
                            <th>Môn học</th>
                            <th>Miệng</th>
                            <th class="text-center" colspan="3">15 phút</th>
                            <th class="text-center" colspan="3">1 tiết</th>
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
                    <p?>Kết quả học tập cả năm của <b><?php echo $qldiem->gettenhs($_SESSION['mshs']) ?></b></p>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td>Điểm TB</td>
                                    <td></td>
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
                    </div>
                    <div class="col-xs-6"></div>
                </div>
                <br>
                <div>
                    Bảng điểm cả năm
                </div>
                <div class="">
                    <table class="table table-bordered table-striped" >
                        <thead >
                            <tr class="bg-primary">
                                <th>Môn học</th>
                                <th>TBM</th>
                            </tr>
                        </thead>
                        <tbody>
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
                </div>
            </div>
            <div class="col-xs-2">
            </div>
        </div>
    </main>
    <br><br>
</body>
</html>