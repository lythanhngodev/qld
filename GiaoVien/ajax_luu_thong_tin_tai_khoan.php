<?php require_once "check_login.php"; ?>
<?php
$kq = array(
    'trangthai' => 0
);
	$conn = $ketnoi->ketnoi();
	$ma = $_POST['ma'];
	$hoten = $_POST['hoten'];
	$sodienthoai = $_POST['sodienthoai'];
	$mail = $_POST['mail'];
	$id = $_POST['id'];
	$sql = "UPDATE GV SET MAGV=:ma, HOTENGV=:hoten, SDTGV=:sdt, EMAILGV=:mail WHERE IDGV = :id";
	$p_sql = oci_parse($conn, $sql);
	oci_bind_by_name($p_sql, ":ma", $ma);
    oci_bind_by_name($p_sql, ":hoten", $hoten);
    oci_bind_by_name($p_sql, ":sdt",$sodienthoai);
    oci_bind_by_name($p_sql, ":mail",$mail);
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