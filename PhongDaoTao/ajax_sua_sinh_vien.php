<?php require_once "check_login.php"; ?>
<?php
$kq = array(
    'trangthai' => 0,
    'thongbao' => "Mã hoặc Mail giáo viên không được trùng"
);
	$conn = $ketnoi->ketnoi();
	$msv = $_POST['msv'];
	$tsv = $_POST['tsv'];
    $gtsv = $_POST['gtsv'];
    $nssv = $_POST['nssv'];
    $mailsv = $_POST['mailsv'];
    $qqsv = $_POST['qqsv'];
    $id = $_POST['id'];
    $sqlk = "SELECT * FROM SV WHERE (MASV = :msv OR EMAILSV=:mailsv) AND IDSV NOT IN (SELECT IDSV FROM SV WHERE IDSV=:id)";
    $p_sqlk = oci_parse($conn, $sqlk);
    oci_bind_by_name($p_sqlk, ":msv", $msv);
    oci_bind_by_name($p_sqlk, ":mailsv", $mailsv);
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
    if(empty($nssv)){
        $sql = "UPDATE SV SET MASV=:msv, HOTENSV=:tsv, EMAILSV=:mailsv,NGAYSINHSV=NULL, GIOITINHSV=:gtsv, QUEQUANSV=:qqsv WHERE IDSV=:id";
        $p_sql = oci_parse($conn, $sql);
        oci_bind_by_name($p_sql, ":msv", $msv);
        oci_bind_by_name($p_sql, ":tsv",$tsv);
        oci_bind_by_name($p_sql, ":mailsv",$mailsv);
        oci_bind_by_name($p_sql, ":gtsv",$gtsv);
        oci_bind_by_name($p_sql, ":qqsv",$qqsv);
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
    }else{
        $sql = "UPDATE SV SET MASV=:msv, HOTENSV=:tsv, NGAYSINHSV=:nssv, EMAILSV=:mailsv, GIOITINHSV=:gtsv, QUEQUANSV=:qqsv WHERE IDSV=:id";
        $p_sql = oci_parse($conn, $sql);
        $ns = date('d-M-Y',strtotime($nssv));
        oci_bind_by_name($p_sql, ":msv", $msv);
        oci_bind_by_name($p_sql, ":tsv",$tsv);
        oci_bind_by_name($p_sql, ":nssv",$ns);
        oci_bind_by_name($p_sql, ":mailsv",$mailsv);
        oci_bind_by_name($p_sql, ":gtsv",$gtsv);
        oci_bind_by_name($p_sql, ":qqsv",$qqsv);
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
    }
 ?>