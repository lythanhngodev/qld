<?php
	session_start();
	require_once "_l_config.php";
    $ketnoi = new _l_clsKetnoi();
    if (isset($_SESSION['us']) && isset($_SESSION['pa']) && !empty($_SESSION['us']) && !empty($_SESSION['pa'])) {
        echo $ketnoi->checklogin($_SESSION['us'], $_SESSION['pa']);
    	switch ($ketnoi->checklogin($_SESSION['us'], $_SESSION['pa'])) {
            case 'quantri':
                header("Location: ".$qld['HOST']."QuanTri");
                break;
            case 'phongdaotao':
                session_start();
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
    else{
    	header("Location: ".$qld['HOST']."Login");
    }
?>