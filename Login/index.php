<?php
require_once "../_l_config.php";
if (isset($_POST['tendangnhap']) && isset($_POST['matkhau'])){
    $ketnoi = new _l_clsKetnoi();
    $us = $_POST['tendangnhap'];
    $pa = $_POST['matkhau'];
    switch ($ketnoi->checklogin($us, $pa)) {
    	case 'quantri':
    		session_start();
    		$_SESSION['us'] = $us;
    		$_SESSION['pa'] = $pa;
    		header("Location: ".$qld['HOST']."QuanTri");
    		break;
    	case 'phongdaotao':
    		session_start();
    		$_SESSION['us'] = $us;
    		$_SESSION['pa'] = $pa;
    		header("Location: ".$qld['HOST']."PhongDaoTao");
    		break;
    	case 'giaovien':
    		session_start();
    		$_SESSION['us'] = $us;
    		$_SESSION['pa'] = $pa;
    		header("Location: ".$qld['HOST']."GiaoVien");
    		break;
    	case 'sinhvien':
    		session_start();
    		$_SESSION['us'] = $us;
    		$_SESSION['pa'] = $pa;
    		header("Location: ".$qld['HOST']."SinhVien");
    		break;
    	default:
    		echo "<script type='text/javascript'>alert('Sai tên đăng nhập hoặc mật khẩu')</script>";
    		break;
    }
}
session_start();
$ketnoi = new _l_clsKetnoi();
if (isset($_SESSION['us']) && isset($_SESSION['pa']) && !empty($_SESSION['us']) && !empty($_SESSION['pa'])) {
    echo $ketnoi->checklogin($_SESSION['us'], $_SESSION['pa']);
	switch ($ketnoi->checklogin($_SESSION['us'], $_SESSION['pa'])) {
        case 'quantri':
            header("Location: ".$qld['HOST']."QuanTri");
            break;
        case 'phongdaotao':
            header("Location: ".$qld['HOST']."PhongDaoTao");
            break;
        case 'giangvien':
            header("Location: ".$qld['HOST']."GiaoVien");
            break;
        case 'sinhvien':
            header("Location: ".$qld['HOST']."SinhVien");
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
	<title>Đăng nhập | Quản lý điểm Đại học Sư phạm Kỹ thuật Vĩnh Long</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="icon" type="image/png" href="images/img-01.png"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>
				<form class="login100-form validate-form" method="post">
					<span class="login100-form-title">
						ĐĂNG NHẬP HỆ THỐNG
					</span>
					<div class="wrap-input100">
						<input class="input100" type="text" name="tendangnhap" placeholder="Tên đăng nhập hoặc Mail">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100">
						<input class="input100" type="password" name="matkhau" placeholder="Mật khẩu">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							ĐĂNG NHẬP
						</button>
					</div>

					<div class="text-center p-t-12">
						<a class="txt2" href="#">
							Quên tài khoản?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
</body>
</html>