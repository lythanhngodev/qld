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
	function lay_sv_cua_lop_gv($idgv, $idlop){
	    $ketnoi = new _l_clsKetnoi();
	    $conn = $ketnoi->ketnoi();
		$sql = "SELECT IDSV, MASV, HOTENSV, GIOITINHSV, NGAYSINHSV, EMAILSV, l.MALOP, KHOAHOC FROM SV sv, LOP l, GV gv
WHERE l.IDLOP = sv.IDLOP AND l.IDLOP = $idlop AND gv.IDGV = $idgv AND l.IDGV = gv.IDGV ORDER BY MASV";
		$p_sql = oci_parse($conn, $sql);
		oci_execute($p_sql);
		return $p_sql;
	}
	function lay_ma_lop($idlop){
	    $ketnoi = new _l_clsKetnoi();
	    $conn = $ketnoi->ketnoi();
		$sql = "SELECT l.MALOP FROM LOP l WHERE l.IDLOP = $idlop";
		$p_sql = oci_parse($conn, $sql);
		oci_execute($p_sql);
		$so = oci_fetch_row($p_sql);
		return $so[0];
	}
	function lay_thong_tin_cua_sv($idsv){
	    $ketnoi = new _l_clsKetnoi();
	    $conn = $ketnoi->ketnoi();
		$sql = "SELECT HOTENSV, MASV, HOTENSV, NGAYSINHSV, QUEQUANSV, ndt.TENNDT, ndt.TRINHDODT, l.MALOP, l.KHOAHOC FROM SV sv, LOP l, NGANHDT ndt, CTDAOTAO cd WHERE sv.IDLOP = l.IDLOP AND l.IDCTDT = cd.IDCTDT AND cd.IDNDT = ndt.IDNDT AND sv.IDSV = $idsv";
		$p_sql = oci_parse($conn, $sql);
		oci_execute($p_sql);
		$so = oci_fetch_assoc($p_sql);
		return $so;
	}
	function lay_toan_bo_hoc_ky_cua_sv($idsv){
	    $ketnoi = new _l_clsKetnoi();
	    $conn = $ketnoi->ketnoi();
		$sql = "SELECT hk.TENHK, hk.NAMHOC, hk.IDHK FROM LOPHOCPHAN lhp, HOCKY hk, DSLHP dl WHERE dl.IDSV = $idsv AND dl.IDLHP = lhp.IDLHP AND lhp.IDHK = hk.IDHK ORDER BY hk.IDHK DESC";
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