<?php
require_once '../bootstrap.php';
use CT446\qld\QLdiem;
$qldiem = new QLDiem($PDO);
session_start();
$qld = $qldiem->loginquantri();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
	<!-- <form action="loginquantri.php" method="post">
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
					<td></td>
					<td><input type="submit" name="submit" value="Đăng nhập"></td>
				</tr>
			</tbody>
		</table>
	</form> -->
	<br><br><br><br>
	<section class="vh-100">
		<div class="container-fluid h-custom">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col-md-9 col-lg-6 col-xl-5">
					<img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
					class="img-fluid" alt="Sample image">
				</div>
				<div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
					<form action="#" method="post">
						<div class="divider d-flex align-items-center my-4">
							<p class="lead fw-normal text-center fw-bold mb-0 me-3">Sign in</p>
						</div>

						<!-- Email input -->
						<div class="form-outline mb-4">
							<label class="form-label" for="form3Example3">User</label>
							<input type="text" id="form3Example3" name="taikhoan" class="form-control form-control-lg"
								placeholder="Nhập tài khoản" />
						</div>

						<!-- Password input -->
						<div class="form-outline mb-3">
							<label class="form-label" for="form3Example4">Password</label>
							<input type="password" id="form3Example4" name="matkhau" class="form-control form-control-lg"
								placeholder="Nhập mật khẩu" />
						</div>

						<div class="text-center text-lg-start mt-4 pt-2">
							<input type="submit" class="btn btn-primary btn-lg" name="submit" value="Login"
								style="padding-left: 2.5rem; padding-right: 2.5rem;">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</body>
</html>

