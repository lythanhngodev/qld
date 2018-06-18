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
    function checkmail($us){
    	$conn = $this->ketnoi();
    	$sql = "
    	SELECT 'sinhvien' as LOAI FROM SV sv where (sv.EMAILSV = :svMail)
    	UNION
    	SELECT 'giaovien' as LOAI FROM GV gv WHERE (gv.EMAILGV = :gvMail)
    	UNION
    	SELECT 'phongdaotao' AS LOAI FROM CBPDT pdt WHERE (pdt.EMAILCBPDT = :pdtMail)
    	UNION
    	SELECT 'quantri' AS LOAI FROM NQT qt WHERE (qt.EMAILNQT = :qtMail)";
    	$p_sql = oci_parse($conn,$sql);
		oci_bind_by_name($p_sql, ":svMail", $us);

		oci_bind_by_name($p_sql, ":gvMail", $us);

		oci_bind_by_name($p_sql, ":pdtMail", $us);

		oci_bind_by_name($p_sql, ":qtMail", $us);

		oci_execute($p_sql);
		$dem = 0;
		$loai = "khong";
		while ($row = oci_fetch_array($p_sql)) {
			$dem++;
			$loai = $row[0];
		}
		oci_free_statement($p_sql);
		oci_close($conn);
		return $loai;
    }
    function capnhatmatkhau($dcmail, $loai, $matkhau){
    switch ($loai) {
    	case 'sinhvien':
    		// gửi mail quên mật khẩu cho sinh viên
            $conn = $this->ketnoi();
    		$sql = "UPDATE SV SET MATKHAU=:mk WHERE EMAILSV=:mail";
            $p_sql = oci_parse($conn, $sql);
            oci_bind_by_name($p_sql, ":mk",$matkhau);
            oci_bind_by_name($p_sql, ":mail",$dcmail);
            oci_execute($p_sql);
            $r_sql = oci_num_rows($p_sql);
            if ($r_sql > 0)
                return true;
            return false;
    		break;
    	case 'giaovien':
    		// gửi mail quên mật khẩu cho giáo viên
            $conn = $this->ketnoi();
            $sql = "UPDATE GV SET MATKHAU=:mk WHERE EMAILGV=:mail";
            $p_sql = oci_parse($conn, $sql);
            oci_bind_by_name($p_sql, ":mk",$matkhau);
            oci_bind_by_name($p_sql, ":mail",$dcmail);
            oci_execute($p_sql);
            $r_sql = oci_num_rows($p_sql);
            if ($r_sql > 0)
                return true;
            return false;
    		break;
    	case 'phongdaotao':
    		// gửi mail quên mật khẩu cho PDT
            $conn = $this->ketnoi();
            $sql = "UPDATE CBPDT SET MATKHAU=:mk WHERE EMAILCBPDT=:mail";
            $p_sql = oci_parse($conn, $sql);
            oci_bind_by_name($p_sql, ":mk",$matkhau);
            oci_bind_by_name($p_sql, ":mail",$dcmail);
            oci_execute($p_sql);
            $r_sql = oci_num_rows($p_sql);
            if ($r_sql > 0)
                return true;
            return false;
    		break;
    	case 'quantri':
    		// gửi mail quên mật khẩu cho NQT
            $conn = $this->ketnoi();
            $sql = "UPDATE  NQT SET MATKHAU=:mk WHERE EMAILNQT=:mail";
            $p_sql = oci_parse($conn, $sql);
            oci_bind_by_name($p_sql, ":mk",$matkhau);
            oci_bind_by_name($p_sql, ":mail",$dcmail);
            oci_execute($p_sql);
            $r_sql = oci_num_rows($p_sql);
            if ($r_sql > 0)
                return true;
            return false;
    		break;
    }
    }
}
?>
