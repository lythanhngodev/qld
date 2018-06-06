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
		$sql = "SELECT hk.TENHK, hk.NAMHOC, hk.IDHK FROM LOPHOCPHAN lhp, HOCKY hk, DSLHP dl WHERE dl.IDSV = $idsv AND dl.IDLHP = lhp.IDLHP AND lhp.IDHK = hk.IDHK ORDER BY hk.IDHK ASC";
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
	function lay_sinh_vien_mon_hoc_trong_hoc_ky($idhk, $idsv){
	    $ketnoi = new _l_clsKetnoi();
	    $conn = $ketnoi->ketnoi();
		$sql = "SELECT DISTINCT mh.MAMH, mh.TENMH,mh.SOTINCHI, lhp.IDLHP FROM HOCKY hk, LOPHOCPHAN lhp, MONHOC mh, DSLHP dl WHERE hk.IDHK = lhp.IDHK AND lhp.IDMH=mh.IDMH AND lhp.IDLHP = dl.IDLHP AND dl.IDSV = $idsv AND hk.IDHK = $idhk";
		$p_sql = oci_parse($conn, $sql);
		oci_execute($p_sql);
		return $p_sql;
	}
	function lay_sinh_vien_phieu_diem_lop_hoc_phan($idlhp, $idsv){
	    $ketnoi = new _l_clsKetnoi();
	    $conn = $ketnoi->ketnoi();
		$sql = "SELECT DISTINCT DIEMCC, DIEMGK, DIEMCK, DIEMTHILAI FROM DSLHP dl, PHIEUDIEMHP ph WHERE dl.IDLHP = ph.IDLHP AND dl.IDSV = ph.IDSV AND ph.IDSV = $idsv AND dl.IDLHP = $idlhp";
		$p_sql = oci_parse($conn, $sql);
		oci_execute($p_sql);
		return $p_sql;
	}
	function diem_he_10($cc, $gk, $ck, $tl){
		$cc = floatval($cc);
		$gk = floatval($gk);
		$ck = floatval($ck);
		$tl = floatval($tl);
		if ($tl > $ck) {
			$ck = $tl;
		}
		return round($cc*0.1+$gk*0.4+$ck*0.5,1);
	}
	function diem_chu($cc, $gk, $ck, $tl){
		$diem = diem_he_10($cc, $gk, $ck,$tl);
		if($diem>=8.5) return "A";
		if($diem>=7.8) return "B+";
		if ($diem>=7.0) return "B";
		if($diem>=6.3) return "C+";
		if($diem>=5.5) return "C";
		if($diem>=4.8) return "D+";
		if($diem>=4.0) return "D";
		if($diem<4.0) return "F";
	}
	function diem_he_4($cc, $gk, $ck, $tl){
		$diem = diem_he_10($cc, $gk, $ck, $tl);
		if($diem>=8.5) return "4.0";
		if($diem>=7.8) return "3.5";
		if ($diem>=7.0) return "3.0";
		if($diem>=6.3) return "2.5";
		if($diem>=5.5) return "2";
		if($diem>=4.8) return "1.5";
		if($diem>=4.0) return "1";
		if($diem<4.0) return "0";
	}
    function xep_loai($diem){
        if($diem>3.6) return "Xuất sắc";
        if($diem>=3.2) return "Giỏi";
        if ($diem>=2.5) return "Khá";
        if($diem>=2.0) return "Trung bình";
        if($diem<2.0) return "Yếu";
    }
 ?>