<?php require_once "check_login.php"; ?>
<?php
$kq = array(
    'trangthai' => 0
);
$conn = $ketnoi->ketnoi();
$lhp = $_POST['lhp'];
$sv = $_POST['sv'];
$sql = "DELETE FROM DSLHP WHERE IDLHP = :idlhp AND IDSV = :idsv";
$p_sql = oci_parse($conn, $sql);
oci_bind_by_name($p_sql, ":idlhp",$lhp);
oci_bind_by_name($p_sql, ":idsv",$sv);
oci_execute($p_sql);
$r_sql = oci_num_rows($p_sql);

oci_free_statement($p_sql);

$sql = "DELETE FROM PHIEUDIEMHP WHERE IDLHP = :idlhp AND IDSV = :idsv";
$p_sql = oci_parse($conn, $sql);
oci_bind_by_name($p_sql, ":idlhp",$lhp);
oci_bind_by_name($p_sql, ":idsv",$sv);
oci_execute($p_sql);

oci_free_statement($p_sql);

oci_close($conn);
if ($r_sql > 0){
    $kq['trangthai'] = 1;
}
echo json_encode($kq);
exit();
?>