<?php require_once "check_login.php"; ?>
<?php
function to_slug($str) {
    $str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    $str = str_replace(' ', '', $str);
    return $str;
}
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
if (empty($_FILES['file'])){
    $sql = "UPDATE CTDAOTAO SET IDNDT=:ndtct, IDKHOA=:kct, MACTDT=:mct, TENCTDT=:tct, SOHOCPHAN=:shpct, SOTINCHI=:stcct, GHICHU=:gcct, FILES='' WHERE IDCTDT=:id";
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
}
else{
    $fileName= time()."-".basename($_FILES["file"]["name"]);
    $temp = explode(".", $_FILES["file"]["name"]);
    $fileName = chop(to_slug($fileName),end($temp)).".".end($temp);
    move_uploaded_file($_FILES["file"]['tmp_name'], '../files/'.$fileName);
    $sql = "UPDATE CTDAOTAO SET IDNDT=:ndtct, IDKHOA=:kct, MACTDT=:mct, TENCTDT=:tct, SOHOCPHAN=:shpct, SOTINCHI=:stcct, GHICHU=:gcct, FILES=:files WHERE IDCTDT=:id";
    $p_sql = oci_parse($conn, $sql);
    oci_bind_by_name($p_sql, ":ndtct", $ndtct);
    oci_bind_by_name($p_sql, ":kct",$kct);
    oci_bind_by_name($p_sql, ":mct",$mct);
    oci_bind_by_name($p_sql, ":tct",$tct);
    oci_bind_by_name($p_sql, ":shpct",$shpct);
    oci_bind_by_name($p_sql, ":stcct",$stcct);
    oci_bind_by_name($p_sql, ":gcct",$gcct);
    oci_bind_by_name($p_sql, ":files",$fileName);
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
}

?>