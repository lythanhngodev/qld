<?php
	session_start();
	require_once "../_l_config.php";
    $ketnoi = new _l_clsKetnoi();
    $idgv="";
    $hotengv="";
    $magv="";
    $mailgv="";
    $sodienthoaigv="";
    $covan = 0;
    if (isset($_SESSION['us']) && isset($_SESSION['pa']) && !empty($_SESSION['us']) && !empty($_SESSION['pa'])) {
    	if($ketnoi->checklogin($_SESSION['us'], $_SESSION['pa'])!="giaovien")
    		header("Location: ".$qld['HOST']."Login");
        else{
            $conn = $ketnoi->ketnoi();
            $sql = "SELECT * FROM GV WHERE (MAGV = :qtMa OR EMAILGV = :qtMail) AND MATKHAU = :qtMk";
            $p_sql = oci_parse($conn,$sql);
            $pa =  md5($_SESSION['pa']);
            oci_bind_by_name($p_sql, ":qtMa", $_SESSION['us']);
            oci_bind_by_name($p_sql, ":qtMail", $_SESSION['us']);
            oci_bind_by_name($p_sql, ":qtMk",$pa);
            oci_execute($p_sql);
            $row = oci_fetch_assoc($p_sql);
            $idgv = $row['IDGV'];
            $hotengv = $row['HOTENGV'];
            $magv = $row['MAGV'];
            $mailgv = $row['EMAILGV'];
            $sodienthoaigv = $row['SDTGV'];
            oci_free_statement($p_sql);

            $ck = "SELECT gv.IDGV FROM GV gv, LOP l WHERE l.IDGV = gv.IDGV AND gv.IDGV=$idgv";
            $p_ck = oci_parse($conn,$ck);
            oci_execute($p_ck);
            $r_ck = oci_fetch_assoc($p_ck);
            $dem_ck = $r_ck['IDGV'];
            if ($dem_ck > 0) {
                $covan = 1;
            }
            oci_free_statement($p_ck);
            oci_close($conn);
        }
    }
    else{
    	header("Location: ".$qld['HOST']."Login");
    }
?>