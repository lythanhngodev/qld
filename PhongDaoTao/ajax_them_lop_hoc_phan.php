<?php require_once "check_login.php"; ?>
<?php
$kq = array(
    'trangthai' => 0,
    'thongbao' => "Mã học phần không được trùng"
);
	$conn = $ketnoi->ketnoi();
	$mlhp = $_POST['mlhp'];
	$hklhp = $_POST['hklhp'];
    $gvlhp = $_POST['gvlhp'];
    $mhlhp = $_POST['mhlhp'];
    $sqlk = "SELECT * FROM LOPHOCPHAN WHERE MALHP = :mlhp";
    $p_sqlk = oci_parse($conn, $sqlk);
    oci_bind_by_name($p_sqlk, ":mlhp", $mlhp);
    oci_execute($p_sqlk);
    $kt=0;
    while ($row = oci_fetch_row($p_sqlk)) {
        $kt++;
    }
    if ($kt>0) {
        echo json_encode($kq);
        exit();
    }
    oci_free_statement($p_sqlk);

	$sql = "INSERT INTO LOPHOCPHAN (IDHK, IDGV, IDMH, MALHP) VALUES (:hklhp, :gvlhp, :mhlhp, :mlhp)";
	$p_sql = oci_parse($conn, $sql);
	oci_bind_by_name($p_sql, ":hklhp", $hklhp);
    oci_bind_by_name($p_sql, ":gvlhp",$gvlhp);
    oci_bind_by_name($p_sql, ":mhlhp",$mhlhp);
    oci_bind_by_name($p_sql, ":mlhp",$mlhp);
    oci_execute($p_sql);
    $r_sql = oci_num_rows($p_sql);
    oci_free_statement($p_sql);
    oci_close($conn);
    if ($r_sql > 0){
        $kq['trangthai'] = 1;
    }
    echo json_encode($kq);
    exit();
 ?>