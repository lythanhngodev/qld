<?php require_once "check_login.php"; ?>
<?php 
	function lay_hoc_ky(){
	    $ketnoi = new _l_clsKetnoi();
	    $conn = $ketnoi->ketnoi();
		$sql = "SELECT IDHK, NAMHOC, TENHK FROM HOCKY";
		$p_sql = oci_parse($conn, $sql);
		oci_execute($p_sql);
		return $p_sql;
	}
	function lay_khoa_chuyen_mon(){
	    $ketnoi = new _l_clsKetnoi();
	    $conn = $ketnoi->ketnoi();
		$sql = "SELECT IDKHOA, MAKHOA, TENKHOA, SDTKHOA FROM KHOACM";
		$p_sql = oci_parse($conn, $sql);
		oci_execute($p_sql);
		return $p_sql;
	}
 ?>