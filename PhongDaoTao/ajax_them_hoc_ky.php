<?php require_once "check_login.php"; ?>
<?php
$kq = array(
    'trangthai' => 0
);
	$conn = $ketnoi->ketnoi();
	$thk = $_POST['thk'];
	$nh = $_POST['nh'];
	$sql = "INSERT INTO HOCKY (TENHK, NAMHOC) VALUES (:thk, :nh)";
	$p_sql = oci_parse($conn, $sql);
	oci_bind_by_name($p_sql, ":thk", $thk);
    oci_bind_by_name($p_sql, ":nh",$nh);
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