<?php require_once "check_login.php"; ?>
<?php
$kq = array(
    'trangthai' => 0,
    'thongbao' => "Mã lớp không được trùng"
);
	$conn = $ketnoi->ketnoi();
	$ml = $_POST['ml'];
	$tl = $_POST['tl'];
    $dtl = $_POST['dtl'];
    $kl = $_POST['kl'];
    $cvhtl = $_POST['cvhtl'];
    $ntsl = $_POST['ntsl'];
    $khl = $_POST['khl'];
    $sqlk = "SELECT * FROM LOP WHERE (MALOP = :ml)";
    $p_sqlk = oci_parse($conn, $sqlk);
    oci_bind_by_name($p_sqlk, ":ml", $ml);
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

	$sql = "INSERT INTO LOP (IDKHOA, IDCTDT, IDGV, MALOP, TENLOP, NAMTS, KHOAHOC) VALUES (:kl, :dtl, :cvhtl, :ml, :tl ,:ntsl, :khl)";
	$p_sql = oci_parse($conn, $sql);
	oci_bind_by_name($p_sql, ":kl", $kl);
    oci_bind_by_name($p_sql, ":dtl",$dtl);
    oci_bind_by_name($p_sql, ":cvhtl",$cvhtl);
    oci_bind_by_name($p_sql, ":ml",$ml);
    oci_bind_by_name($p_sql, ":tl",$tl);
    oci_bind_by_name($p_sql, ":ntsl",$ntsl);
    oci_bind_by_name($p_sql, ":khl",$khl);
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