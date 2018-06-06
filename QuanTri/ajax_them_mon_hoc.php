<?php require_once "check_login.php"; ?>
<?php
$kq = array(
    'trangthai' => 0,
    'thongbao' => 'Mã môn học, hoặc tên môn học bị trùng'
);
	$conn = $ketnoi->ketnoi();
	$tmh = $_POST['tmh'];
	$mmh = $_POST['mmh'];
    $stclt = $_POST['stclt'];
    $stcth = $_POST['stcth'];
    $kmh = $_POST['kmh'];
    $stclt = intval($stclt);
    $stcth = intval($stcth);
    $stc = $stclt + $stcth;
    $sqlk = "SELECT * FROM MONHOC WHERE (MAMH = :mmh OR TENMH=:tmh)";
    $p_sqlk = oci_parse($conn, $sqlk);
    oci_bind_by_name($p_sqlk, ":mmh", $mmh);
    oci_bind_by_name($p_sqlk, ":tmh", $tmh);
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
	$sql = "INSERT INTO MONHOC (MAMH, TENMH, SOTINCHI, SOTCLT, SOTCTH, IDKHOA) VALUES (:mmh, :tmh, :stc, :stclt, :stcth, :kmh)";
	$p_sql = oci_parse($conn, $sql);
	oci_bind_by_name($p_sql, ":mmh", $mmh);
    oci_bind_by_name($p_sql, ":tmh",$tmh);
    oci_bind_by_name($p_sql, ":stc",$stc);
    oci_bind_by_name($p_sql, ":stclt",$stclt);
    oci_bind_by_name($p_sql, ":stcth",$stcth);
    oci_bind_by_name($p_sql, ":kmh",$kmh);
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