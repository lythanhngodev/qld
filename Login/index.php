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
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
		}
		form{
		    position: absolute;
		    width: 300px;
		    margin: 0 auto;
		    margin-top: 10rem;
		    padding: 10px;
		    border: 1px solid #a9a9a9;
		    border-radius: 8px;
		    top: 0;
		    left: 0;
		    right: 0;
		    box-shadow: 0px 0px 6px 0px #b2d8ff;
		    background: #eef7ff;
		}
		.nhap{width:  200px;float:  left;margin-top: 0.5rem;padding: 4px;border-radius:  4px;border: 1px solid #2f71b7;}
		.form-title{
			float: left;
			font-size:  19px;
			font-family:  sans-serif;
			font-weight:  500;
		}
	</style>
</head>
<body>
    <header style="width: 100%; float: left;top:0;">
        <img src="images/header.png" style="width: 100%;box-shadow: 0px 0px 4px 1px #676767;">
    </header>
    <form class="" method="post">
        <div style="background-image: url('images/img-01.png');width: 80px;height: 80px;float: left;background-size: cover;background-position: center;margin-right: 10px;margin-top: 10px;"></div>
        <span class="form-title">
                ĐĂNG NHẬP
            </span>
        <input class="nhap" type="text" name="tendangnhap" placeholder="Tên đăng nhập hoặc Mail" required="required">
        <input class="nhap" type="password" name="matkhau" placeholder="Mật khẩu" required="required">
        <button type="submit" style="float: right;width: 96px;padding: 2px 0px;margin-top: 10px;font-size: 12px;">
            ĐĂNG NHẬP
        </button>
        <div style="float: right;margin-right: 7px;margin-top: 13px;font-family:  sans-serif;font-size: 13px;"><a class="txt2" href="quenmatkhau.php">
                Quên mật khẩu?
            </a></div>
    </form>
<div style="position: fixed;margin-bottom: 0;left: 0;right:0;bottom: 0;height: 20px;width: 100%;background: #232323;color: #adadad;line-height:  20px;font-size: 85%;padding-left: 1rem;font-family:  monospace;">© Copyright of Nguyễn Ngọc Yến Linh (Faculty of Information Technology 2014)</div>
</body>
</html>