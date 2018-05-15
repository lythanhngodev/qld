<?php
	session_start();
	require_once "../_l_config.php";
    $ketnoi = new _l_clsKetnoi();
    $idnqt="";
    $hoten="";
    $ma="";
    $mail="";
    $sodienthoai="";
    if (isset($_SESSION['us']) && isset($_SESSION['pa']) && !empty($_SESSION['us']) && !empty($_SESSION['pa'])) {
    	if($ketnoi->checklogin($_SESSION['us'], $_SESSION['pa'])!="quantri")
    		header("Location: ".$qld['HOST']."Login");
        else{
            $conn = $ketnoi->ketnoi();
            $sql = "SELECT IDNQT,HOTENNQT, MANQT, EMAILNQT, SDTNQT FROM NQT qt WHERE (qt.MANQT = :qtMa OR qt.EMAILNQT = :qtMail) AND qt.MATKHAU = :qtMk";
            $p_sql = oci_parse($conn,$sql);
            $pa =  md5($_SESSION['pa']);
            oci_bind_by_name($p_sql, ":qtMa", $_SESSION['us']);
            oci_bind_by_name($p_sql, ":qtMail", $_SESSION['us']);
            oci_bind_by_name($p_sql, ":qtMk",$pa);
            oci_execute($p_sql);
            $row = oci_fetch_assoc($p_sql);
            $idnqt = $row['IDNQT'];
            $hoten = $row['HOTENNQT'];
            $ma = $row['MANQT'];
            $mail = $row['EMAILNQT'];
            $sodienthoai = $row['SDTNQT'];
        }
    }
    else{
    	header("Location: ".$qld['HOST']."Login");
    }
?>