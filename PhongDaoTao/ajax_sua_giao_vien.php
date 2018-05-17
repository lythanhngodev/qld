<?php require_once "check_login.php"; ?>
<?php
$kq = array(
    'trangthai' => 0,
    'thongbao' => "Mã hoặc Mail giáo viên không được trùng"
);
	$conn = $ketnoi->ketnoi();
	$mgv = $_POST['mgv'];
	$tgv = $_POST['tgv'];
    $sdtgv = $_POST['sdtgv'];
    $mailgv = $_POST['mailgv'];
    $kgv = $_POST['kgv'];
    $id = $_POST['id'];
    $sqlk = "SELECT * FROM GV WHERE (MAGV = :mgv OR EMAILGV=:mailgv) AND IDGV NOT IN (SELECT IDGV FROM GV WHERE IDGV=:id)";
    $p_sqlk = oci_parse($conn, $sqlk);
    oci_bind_by_name($p_sqlk, ":mgv", $mgv);
    oci_bind_by_name($p_sqlk, ":mailgv", $mailgv);
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

	$sql = "UPDATE GV SET MAGV=:mgv, HOTENGV=:tgv, SDTGV=:sdtgv, EMAILGV=:mailgv, IDKHOA=:kgv WHERE IDGV=:id";
	$p_sql = oci_parse($conn, $sql);
	oci_bind_by_name($p_sql, ":mgv", $mgv);
    oci_bind_by_name($p_sql, ":tgv",$tgv);
    oci_bind_by_name($p_sql, ":sdtgv",$sdtgv);
    oci_bind_by_name($p_sql, ":mailgv",$mailgv);
    oci_bind_by_name($p_sql, ":kgv",$kgv);
    oci_bind_by_name($p_sql, ":id", $id);
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