<?php
	session_start();
	require_once "../_l_config.php";
    $ketnoi = new _l_clsKetnoi();
    $idsv="";
    $hotensv="";
    $masv="";
    $mailsv="";
    if (isset($_SESSION['us']) && isset($_SESSION['pa']) && !empty($_SESSION['us']) && !empty($_SESSION['pa'])) {
    	if($ketnoi->checklogin($_SESSION['us'], $_SESSION['pa'])!="sinhvien")
    		header("Location: ".$qld['HOST']."Login");
        else{
            $conn = $ketnoi->ketnoi();
            $sql = "SELECT * FROM SV sv WHERE (sv.MASV = :svMa OR sv.EMAILSV = :svMail) AND sv.MATKHAU = :svMk";
            $p_sql = oci_parse($conn,$sql);
            $pa =  md5($_SESSION['pa']);
            oci_bind_by_name($p_sql, ":svMa", $_SESSION['us']);
            oci_bind_by_name($p_sql, ":svMail", $_SESSION['us']);
            oci_bind_by_name($p_sql, ":svMk",$pa);
            oci_execute($p_sql);
            $row = oci_fetch_assoc($p_sql);
            $idsv = $row['IDSV'];
            $_SESSION['_idsv'] = $idsv;
            $hotensv = $row['HOTENSV'];
            $masv = $row['MASV'];
            $mailsv = $row['EMAILSV'];
        }
    }
    else{
    	header("Location: ".$qld['HOST']."Login");
    }
?>