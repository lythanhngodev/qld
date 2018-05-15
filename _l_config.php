<?php
/**
 * Created by PhpStorm.
 * User: linhn
 * Date: 4/21/2018
 * Time: 3:07 PM
 */
?>
<?php
$qld = array(
    'HOST' => 'http://localhost/qld/'
);
class _l_clsKetnoi{
    private $user='sa';
    private $pass='system';
    // Create connection to Oracle
    function ketnoi(){
        $conn = @oci_connect($this->user, $this->pass, '//127.0.0.1/orcl:qlkqht');
        return $conn;
    }
    function checklogin($us, $pa){
    	$pa = md5($pa);
    	$conn = $this->ketnoi();
    	$sql = "
    	SELECT sv.MASV, 'sinhvien' as LOAI FROM SV sv where (sv.MASV = :svMa OR sv.EMAILSV = :svMail) and sv.MATKHAU = :svMk
    	UNION
    	SELECT gv.MAGV, 'giaovien' as LOAI FROM GV gv WHERE (gv.MAGV = :gvMa OR gv.EMAILGV = :gvMail) and gv.MATKHAU = :gvMk
    	UNION
    	SELECT pdt.MACBPDT, 'phongdaotao' AS LOAI FROM CBPDT pdt WHERE (pdt.MACBPDT = :pdtMa OR pdt.EMAILCBPDT = :pdtMail) and pdt.MATKHAU = :pdtMk
    	UNION
    	SELECT qt.MANQT, 'quantri' AS LOAI FROM NQT qt WHERE (qt.MANQT = :qtMa OR qt.EMAILNQT = :qtMail) AND qt.MATKHAU = :qtMk";
    	$p_sql = oci_parse($conn,$sql);
		oci_bind_by_name($p_sql, ":svMa", $us);
		oci_bind_by_name($p_sql, ":svMail", $us);
		oci_bind_by_name($p_sql, ":svMk", $pa);

		oci_bind_by_name($p_sql, ":gvMa", $us);
		oci_bind_by_name($p_sql, ":gvMail", $us);
		oci_bind_by_name($p_sql, ":gvMk", $pa);

		oci_bind_by_name($p_sql, ":pdtMa", $us);
		oci_bind_by_name($p_sql, ":pdtMail", $us);
		oci_bind_by_name($p_sql, ":pdtMk", $pa);

		oci_bind_by_name($p_sql, ":qtMa", $us);
		oci_bind_by_name($p_sql, ":qtMail", $us);
		oci_bind_by_name($p_sql, ":qtMk", $pa);

		oci_execute($p_sql);
		$dem = 0;
		$loai = "khong";
		while ($row = oci_fetch_array($p_sql)) {
			$dem++;
			$loai = $row[1];
		}
		oci_free_statement($p_sql);
		oci_close($conn);
		return $loai;
    }
}
?>
