<?php require_once "check_login.php"; ?>
<?php
$kq = array(
    'trangthai' => 0,
    'thongbao' => "Mã chi tiết đào tạo không được trùng"
);
	$conn = $ketnoi->ketnoi();
	$mct = $_POST['mct'];
	$tct = $_POST['tct'];
    $ndtct = $_POST['ndtct'];
    $kct = $_POST['kct'];
    $shpct = $_POST['shpct'];
    $stcct = $_POST['stcct'];
    $gcct = $_POST['gcct'];
    $id = $_POST['id'];
    $sqlk = "SELECT * FROM CTDAOTAO WHERE (MACTDT=:mct) AND IDCTDT!=:id";
    $p_sqlk = oci_parse($conn, $sqlk);
    oci_bind_by_name($p_sqlk, ":mct", $mct);
    oci_bind_by_name($p_sqlk, ":id", $id);
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

	$sql = "UPDATE CTDAOTAO SET IDNDT=:ndtct, IDKHOA=:kct, MACTDT=:mct, TENCTDT=:tct, SOHOCPHAN=:shpct, SOTINCHI=:stcct, GHICHU=:gcct WHERE IDCTDT=:id";
	$p_sql = oci_parse($conn, $sql);
	oci_bind_by_name($p_sql, ":ndtct", $ndtct);
    oci_bind_by_name($p_sql, ":kct",$kct);
    oci_bind_by_name($p_sql, ":mct",$mct);
    oci_bind_by_name($p_sql, ":tct",$tct);
    oci_bind_by_name($p_sql, ":shpct",$shpct);
    oci_bind_by_name($p_sql, ":stcct",$stcct);
    oci_bind_by_name($p_sql, ":gcct",$gcct);
    oci_bind_by_name($p_sql, ":id",$id);
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