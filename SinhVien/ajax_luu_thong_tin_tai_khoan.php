<?php require_once "check_login.php"; ?>
<?php
$kq = array(
    'trangthai' => 0
);
	$conn = $ketnoi->ketnoi();
	$quaquan = $_POST['quequan'];
	$ngaysinh = $_POST['ngaysinh'];
	$mail = $_POST['mail'];
	$id = $_POST['id'];
	$sql = "UPDATE SV SET QUEQUANSV=:quaquan, EMAILSV=:mail WHERE IDSV = :id";
	$p_sql = oci_parse($conn, $sql);
	oci_bind_by_name($p_sql, ":quaquan", $quaquan);
    //oci_bind_by_name($p_sql, ":ngaysinh", $ngaysinh);
    oci_bind_by_name($p_sql, ":mail",$mail);
    oci_bind_by_name($p_sql, ":id",$id);
    oci_execute($p_sql);
    $r_sql = oci_num_rows($p_sql);
    if ($r_sql > 0){
        $kq['trangthai'] = 1;
    }
    echo json_encode($kq);
    exit();
 ?>