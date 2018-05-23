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
	function lay_lop(){
	    $ketnoi = new _l_clsKetnoi();
	    $conn = $ketnoi->ketnoi();
		$sql = "SELECT l.IDLOP,l.IDKHOA, k.TENKHOA, dt.IDCTDT,dt.TENCTDT, gv.IDGV, gv.HOTENGV, MALOP, TENLOP, NAMTS, KHOAHOC FROM LOP l, KHOACM k, CTDAOTAO dt, GV gv WHERE l.IDKHOA = k.IDKHOA and l.IDCTDT = dt.IDCTDT AND l.IDGV = gv.IDGV";
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
	function lay_chi_tiet_lop($id){
	    $ketnoi = new _l_clsKetnoi();
	    $conn = $ketnoi->ketnoi();
		$sql = "SELECT * FROM SV WHERE IDLOP=:id";
		$p_sql = oci_parse($conn, $sql);
		oci_bind_by_name($p_sql, ":id", $id);
		oci_execute($p_sql);
		return $p_sql;
	}
	function lay_loai_dao_tao(){
	    $ketnoi = new _l_clsKetnoi();
	    $conn = $ketnoi->ketnoi();
		$sql = "SELECT DISTINCT IDCTDT, TENCTDT, TENNDT, TRINHDODT FROM CTDAOTAO dt, NGANHDT n WHERE dt.IDNDT = n.IDNDT";
		$p_sql = oci_parse($conn, $sql);
		oci_execute($p_sql);
		return $p_sql;
	}
	function lay_sinh_vien_lop_hoc_phan($id){
	    $ketnoi = new _l_clsKetnoi();
	    $conn = $ketnoi->ketnoi();
		$sql = "SELECT DISTINCT ds.IDLHP,sv.IDSV, sv.HOTENSV, sv.MASV, l.MALOP FROM SV sv, LOPHOCPHAN lhp, DSLHP ds, LOP l WHERE lhp.IDLHP = ds.IDLHP AND sv.IDSV = ds.IDSV AND sv.IDLOP=l.IDLOP AND lhp.IDLHP = '$id'";
		$p_sql = oci_parse($conn, $sql);
		oci_execute($p_sql);
		return $p_sql;
	}
 ?>