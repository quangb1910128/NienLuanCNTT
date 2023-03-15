<?php
require_once '../bootstrap.php';
use CT446\qld\QLdiem;
session_start();
$qldiem = new QLDiem($PDO);
$qld = $qldiem->luugv();
$qld2 = $qldiem->themtk();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm giáo viên</title>
</head>
<body>
        
        <form action="" method="post">
            <table border="1">
                <thead>
                    <tr>
                        <th>Họ tên</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Địa chỉ</th>
                        <th>Chuyên môn</th>
                        <th>Acction</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input name="hoten" type="text"></td>
                        <td><input name="ngaysinh" type="text"></td>
                        <td><input name="gioitinh" type="text"></td>
                        <td><input name="diachi" type="text"></td>
                        <td><input name="chuyenmon" type="text"></td>
                        <td><input name="submit"type="submit" value="Lưu"></td>
                    </tr>
                </tbody>
            </table>
        </form>
</body>
</html>