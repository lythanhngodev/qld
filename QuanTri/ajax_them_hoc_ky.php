<?php require_once "check_login.php"; ?>
<?php
$kq = array(
    'trangthai' => 0,
    'thongbao' => 'Mã học kỳ hoặc Tên học kỳ không được trùng'
);
	$conn = $ketnoi->ketnoi();
    $mhk = $_POST['mhk'];
	$thk = $_POST['thk'];
	$nh = $_POST['nh'];
    $sqlk = "SELECT * FROM HOCKY WHERE MAHK = :mhk";
    $p_sqlk = oci_parse($conn, $sqlk);
    oci_bind_by_name($p_sqlk, ":mhk", $mhk);
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


	$sql = "INSERT INTO HOCKY (MAHK, TENHK, NAMHOC) VALUES (:mhk, :thk, :nh)";
	$p_sql = oci_parse($conn, $sql);
    oci_bind_by_name($p_sql, ":mhk", $mhk);
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