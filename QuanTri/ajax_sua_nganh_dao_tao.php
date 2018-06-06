<?php require_once "check_login.php"; ?>
<?php
$kq = array(
    'trangthai' => 0,
    'thongbao' => 'Mã môn học, hoặc tên môn học bị trùng'
);
	$conn = $ketnoi->ketnoi();
	$mn = $_POST['mn'];
	$tn = $_POST['tn'];
    $hdtn = $_POST['hdtn'];
    $tgdtn = $_POST['tgdtn'];
    $tddtn = $_POST['tddtn'];
    $id = $_POST['id'];
    $sqlk = "SELECT * FROM NGANHDT WHERE (MANDT = :mn) AND IDNDT!=:id";
    $p_sqlk = oci_parse($conn, $sqlk);
    oci_bind_by_name($p_sqlk, ":mn", $mn);
    oci_bind_by_name($p_sqlk, ":id",$id);
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
	$sql = "UPDATE NGANHDT SET MANDT=:mn, TENNDT=:tn, HEDT=:hdtn, THOIGIANDT=:tgdtn, TRINHDODT=:tddtn WHERE IDNDT=:id";
	$p_sql = oci_parse($conn, $sql);
	oci_bind_by_name($p_sql, ":mn", $mn);
    oci_bind_by_name($p_sql, ":tn",$tn);
    oci_bind_by_name($p_sql, ":hdtn",$hdtn);
    oci_bind_by_name($p_sql, ":tgdtn",$tgdtn);
    oci_bind_by_name($p_sql, ":tddtn",$tddtn);
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