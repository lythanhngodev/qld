<?php require_once "check_login.php"; ?>
<?php
$kq = array(
    'trangthai' => 0,
    'thongbao' => "Mã khoa, Tên khoa không được trùng"
);
	$conn = $ketnoi->ketnoi();
	$mk = $_POST['mk'];
	$tk = $_POST['tk'];
    $sdtk = $_POST['sdtk'];

    $sqlk = "SELECT * FROM KHOACM WHERE (MAKHOA = :mk OR TENKHOA=:tk)";
    $p_sqlk = oci_parse($conn, $sqlk);
    oci_bind_by_name($p_sqlk, ":mk", $mk);
    oci_bind_by_name($p_sqlk, ":tk", $tk);
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

	$sql = "INSERT INTO KHOACM (MAKHOA, TENKHOA, SDTKHOA) VALUES (:mk, :tk, :sdtk)";
	$p_sql = oci_parse($conn, $sql);
	oci_bind_by_name($p_sql, ":mk", $mk);
    oci_bind_by_name($p_sql, ":tk",$tk);
    oci_bind_by_name($p_sql, ":sdtk",$sdtk);
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