<?php
require_once '../bootstrap.php';
use CT446\qld\QLdiem;
$qldiem = new QLDiem($PDO);
session_start();
$qld = $qldiem->login();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>login</title>
</head>
<body>
	<form action="index.php" method="post">
		<table>
			<tbody>
				<tr>
					<td>
						User:
					</td>
					<td>
						<input type="text" name="taikhoan">
					</td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="matkhau"></td>
				</tr>
				<tr>
					<td>Dành cho:</td>
					<td>
						<select name="quyen" id="">
							<option value="tkhs">Học sinh</option>
							<option value="tkgv">Giáo viên</option>
							<option value="">Quản trị</option>

						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" value="Đăng nhập"></td>
				</tr>
			</tbody>
		</table>
	</form>
</body>
</html>

