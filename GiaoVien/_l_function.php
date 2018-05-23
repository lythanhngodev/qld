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
	function lay_lop_hoc_phan_gv($idgv){
	    $ketnoi = new _l_clsKetnoi();
	    $conn = $ketnoi->ketnoi();
		$sql = "SELECT lhp.IDLHP, hk.IDHK, hk.TENHK, hk.NAMHOC, lhp.IDGV, gv.HOTENGV, mh.IDMH, mh.TENMH, lhp.MALHP, lhp.SISO FROM HOCKY hk, LOPHOCPHAN lhp, GV gv, MONHOC mh WHERE lhp.IDHK = hk.IDHK AND lhp.IDGV = gv.IDGV AND lhp.IDMH = mh.IDMH AND gv.IDGV='$idgv'";
		$p_sql = oci_parse($conn, $sql);
		oci_execute($p_sql);
		return $p_sql;
	}
	function lay_lop_gv($idgv){
	    $ketnoi = new _l_clsKetnoi();
	    $conn = $ketnoi->ketnoi();
		$sql = "SELECT gv.IDGV,l.IDLOP,l.MALOP, l.TENLOP FROM GV gv, LOP l WHERE l.IDGV = gv.IDGV AND gv.IDGV=$idgv";
		$p_sql = oci_parse($conn, $sql);
		oci_execute($p_sql);
		return $p_sql;
	}
	function lay_si_so_lop($idlop){
	    $ketnoi = new _l_clsKetnoi();
	    $conn = $ketnoi->ketnoi();
		$sql = "SELECT COUNT(*) FROM SV WHERE IDLOP=$idlop";
		$p_sql = oci_parse($conn, $sql);
		oci_execute($p_sql);
		$so = oci_fetch_row($p_sql);
		return $so[0];
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