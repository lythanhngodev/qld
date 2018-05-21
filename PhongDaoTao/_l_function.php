<?php require_once "check_login.php"; ?>
<?php 
	function lay_chi_tiet_dao_tao(){
	    $ketnoi = new _l_clsKetnoi();
	    $conn = $ketnoi->ketnoi();
		$sql = "SELECT ct.IDCTDT,ct.IDNDT, n.TENNDT, ct.IDKHOA, k.TENKHOA, ct.MACTDT, TENCTDT, SOHOCPHAN, SOTINCHI, GHICHU FROM CTDAOTAO ct, NGANHDT n, KHOACM k WHERE ct.IDNDT = n.IDNDT AND ct.IDKHOA = k.IDKHOA";
		$p_sql = oci_parse($conn, $sql);
		oci_execute($p_sql);
		return $p_sql;
	}
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
	function lay_giao_vien(){
	    $ketnoi = new _l_clsKetnoi();
	    $conn = $ketnoi->ketnoi();
		$sql = "SELECT g.IDGV, g.IDKHOA, g.HOTENGV, g.SDTGV, g.EMAILGV, g.MAGV, k.TENKHOA FROM KHOACM k, GV g WHERE g.IDKHOA = k.IDKHOA";
		$p_sql = oci_parse($conn, $sql);
		oci_execute($p_sql);
		return $p_sql;
	}
	function lay_mon_hoc(){
	    $ketnoi = new _l_clsKetnoi();
	    $conn = $ketnoi->ketnoi();
		$sql = "SELECT mh.IDMH, mh.IDKHOA, k.TENKHOA, mh.MAMH, mh.TENMH, SOTINCHI, SOTCLT, SOTCTH FROM MONHOC mh, KHOACM k WHERE mh.IDKHOA = k.IDKHOA";
		$p_sql = oci_parse($conn, $sql);
		oci_execute($p_sql);
		return $p_sql;
	}
	function lay_nganh_dao_tao(){
	    $ketnoi = new _l_clsKetnoi();
	    $conn = $ketnoi->ketnoi();
		$sql = "SELECT * FROM NGANHDT";
		$p_sql = oci_parse($conn, $sql);
		oci_execute($p_sql);
		return $p_sql;
	}
	function lay_lop_hoc_phan(){
	    $ketnoi = new _l_clsKetnoi();
	    $conn = $ketnoi->ketnoi();
		$sql = "SELECT lhp.IDLHP, hk.IDHK, hk.TENHK, hk.NAMHOC, lhp.IDGV, gv.HOTENGV, mh.IDMH, mh.TENMH, lhp.MALHP, lhp.SISO FROM HOCKY hk, LOPHOCPHAN lhp, GV gv, MONHOC mh WHERE lhp.IDHK = hk.IDHK AND lhp.IDGV = gv.IDGV AND lhp.IDMH = mh.IDMH";
		$p_sql = oci_parse($conn, $sql);
		oci_execute($p_sql);
		return $p_sql;
	}
 ?>