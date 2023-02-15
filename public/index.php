<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>login</title>
</head>
<body>
	<form action="lopphutrach.php" method="post">
		<table>
			<tbody>
				<tr>
					<td>
						User:
					</td>
					<td>
						<input type="text">
					</td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password"></td>
				</tr>
				<tr>
					<td>Dành cho:</td>
					<td>
						<select name="" id="">
							<option value="">Học sinh</option>
							<option value="">Giáo viên</option>
							<option value="">Quản trị</option>

						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Đăng nhập"></td>
				</tr>
			</tbody>
		</table>
	</form>
</body>
</html>

