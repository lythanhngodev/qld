<?php require_once "check_login.php"; ?>
<?php 
	$loai = $_POST['loai'];
	$idsv = $_POST['idsv'];
	$idlhp = $_POST['idlhp'];
	$diem = $_POST['diem'];
	switch ($loai) {
		case 'cc':
			$conn = $ketnoi->ketnoi();
            $sqlk = "SELECT * FROM PHIEUDIEMHP WHERE IDLHP=:idlhp AND IDSV=:idsv";
            $p_sqlk = oci_parse($conn, $sqlk);
            oci_bind_by_name($p_sqlk, ":idlhp", $idlhp);
            oci_bind_by_name($p_sqlk, ":idsv", $idsv);
            oci_execute($p_sqlk);
            $kt=0;
            while ($row = oci_fetch_row($p_sqlk)) {
                $kt++;
            }
            oci_free_statement($p_sqlk);
            if ($kt == 0) {
            	$sql = "INSERT INTO PHIEUDIEMHP(IDLHP, IDSV, DIEMCC) VALUES (:idlhp, :idsv, :diem)";
	            $p_sql = oci_parse($conn, $sql);
	            oci_bind_by_name($p_sql, ":idlhp", $idlhp);
	            oci_bind_by_name($p_sql, ":idsv", $idsv);
	            oci_bind_by_name($p_sql, ":diem", $diem);
	            oci_execute($p_sql);
	            oci_free_statement($p_sql);
	            oci_close($conn);
            }
            else{
            	$sql = "UPDATE PHIEUDIEMHP SET DIEMCC=:diem WHERE IDLHP=:idlhp AND IDSV=:idsv";
	            $p_sql = oci_parse($conn, $sql);
	            oci_bind_by_name($p_sql, ":idlhp", $idlhp);
	            oci_bind_by_name($p_sql, ":idsv", $idsv);
	            oci_bind_by_name($p_sql, ":diem", $diem);
	            oci_execute($p_sql);
	            oci_free_statement($p_sql);
	            oci_close($conn);
            }
			break;
		case 'gk':
			$conn = $ketnoi->ketnoi();
            $sqlk = "SELECT * FROM PHIEUDIEMHP WHERE IDLHP=:idlhp AND IDSV=:idsv";
            $p_sqlk = oci_parse($conn, $sqlk);
            oci_bind_by_name($p_sqlk, ":idlhp", $idlhp);
            oci_bind_by_name($p_sqlk, ":idsv", $idsv);
            oci_execute($p_sqlk);
            $kt=0;
            while ($row = oci_fetch_row($p_sqlk)) {
                $kt++;
            }
            oci_free_statement($p_sqlk);
            if ($kt == 0) {
            	$sql = "INSERT INTO PHIEUDIEMHP(IDLHP, IDSV, DIEMGK) VALUES (:idlhp, :idsv, :diem)";
	            $p_sql = oci_parse($conn, $sql);
	            oci_bind_by_name($p_sql, ":idlhp", $idlhp);
	            oci_bind_by_name($p_sql, ":idsv", $idsv);
	            oci_bind_by_name($p_sql, ":diem", $diem);
	            oci_execute($p_sql);
	            oci_free_statement($p_sql);
	            oci_close($conn);
            }
            else{
            	$sql = "UPDATE PHIEUDIEMHP SET DIEMGK=:diem WHERE IDLHP=:idlhp AND IDSV=:idsv";
	            $p_sql = oci_parse($conn, $sql);
	            oci_bind_by_name($p_sql, ":idlhp", $idlhp);
	            oci_bind_by_name($p_sql, ":idsv", $idsv);
	            oci_bind_by_name($p_sql, ":diem", $diem);
	            oci_execute($p_sql);
	            oci_free_statement($p_sql);
	            oci_close($conn);
            }
			break;
		case 'ck':
			$conn = $ketnoi->ketnoi();
            $sqlk = "SELECT * FROM PHIEUDIEMHP WHERE IDLHP=:idlhp AND IDSV=:idsv";
            $p_sqlk = oci_parse($conn, $sqlk);
            oci_bind_by_name($p_sqlk, ":idlhp", $idlhp);
            oci_bind_by_name($p_sqlk, ":idsv", $idsv);
            oci_execute($p_sqlk);
            $kt=0;
            while ($row = oci_fetch_row($p_sqlk)) {
                $kt++;
            }
            oci_free_statement($p_sqlk);
            if ($kt == 0) {
            	$sql = "INSERT INTO PHIEUDIEMHP(IDLHP, IDSV, DIEMCK) VALUES (:idlhp, :idsv, :diem)";
	            $p_sql = oci_parse($conn, $sql);
	            oci_bind_by_name($p_sql, ":idlhp", $idlhp);
	            oci_bind_by_name($p_sql, ":idsv", $idsv);
	            oci_bind_by_name($p_sql, ":diem", $diem);
	            oci_execute($p_sql);
	            oci_free_statement($p_sql);
	            oci_close($conn);
            }
            else{
            	$sql = "UPDATE PHIEUDIEMHP SET DIEMCK=:diem WHERE IDLHP=:idlhp AND IDSV=:idsv";
	            $p_sql = oci_parse($conn, $sql);
	            oci_bind_by_name($p_sql, ":idlhp", $idlhp);
	            oci_bind_by_name($p_sql, ":idsv", $idsv);
	            oci_bind_by_name($p_sql, ":diem", $diem);
	            oci_execute($p_sql);
	            oci_free_statement($p_sql);
	            oci_close($conn);
            }
			break;
		case 'tl':
			$conn = $ketnoi->ketnoi();
            $sqlk = "SELECT * FROM PHIEUDIEMHP WHERE IDLHP=:idlhp AND IDSV=:idsv";
            $p_sqlk = oci_parse($conn, $sqlk);
            oci_bind_by_name($p_sqlk, ":idlhp", $idlhp);
            oci_bind_by_name($p_sqlk, ":idsv", $idsv);
            oci_execute($p_sqlk);
            $kt=0;
            while ($row = oci_fetch_row($p_sqlk)) {
                $kt++;
            }
            oci_free_statement($p_sqlk);
            if ($kt == 0) {
            	$sql = "INSERT INTO PHIEUDIEMHP(IDLHP, IDSV, DIEMTHILAI) VALUES (:idlhp, :idsv, :diem)";
	            $p_sql = oci_parse($conn, $sql);
	            oci_bind_by_name($p_sql, ":idlhp", $idlhp);
	            oci_bind_by_name($p_sql, ":idsv", $idsv);
	            oci_bind_by_name($p_sql, ":diem", $diem);
	            oci_execute($p_sql);
	            oci_free_statement($p_sql);
	            oci_close($conn);
            }
            else{
            	$sql = "UPDATE PHIEUDIEMHP SET DIEMTHILAI=:diem WHERE IDLHP=:idlhp AND IDSV=:idsv";
	            $p_sql = oci_parse($conn, $sql);
	            oci_bind_by_name($p_sql, ":idlhp", $idlhp);
	            oci_bind_by_name($p_sql, ":idsv", $idsv);
	            oci_bind_by_name($p_sql, ":diem", $diem);
	            oci_execute($p_sql);
	            oci_free_statement($p_sql);
	            oci_close($conn);
            }
			break;
		case 'ct':
			$conn = $ketnoi->ketnoi();
            $sqlk = "SELECT * FROM PHIEUDIEMHP WHERE IDLHP=:idlhp AND IDSV=:idsv";
            $p_sqlk = oci_parse($conn, $sqlk);
            oci_bind_by_name($p_sqlk, ":idlhp", $idlhp);
            oci_bind_by_name($p_sqlk, ":idsv", $idsv);
            oci_execute($p_sqlk);
            $kt=0;
            while ($row = oci_fetch_row($p_sqlk)) {
                $kt++;
            }
            oci_free_statement($p_sqlk);
            if ($kt == 0) {
            	$sql = "INSERT INTO PHIEUDIEMHP(IDLHP, IDSV, CAMTHI) VALUES (:idlhp, :idsv, :diem)";
	            $p_sql = oci_parse($conn, $sql);
	            oci_bind_by_name($p_sql, ":idlhp", $idlhp);
	            oci_bind_by_name($p_sql, ":idsv", $idsv);
	            oci_bind_by_name($p_sql, ":diem", $diem);
	            oci_execute($p_sql);
	            oci_free_statement($p_sql);
	            oci_close($conn);
            }
            else{
            	$sql = "UPDATE PHIEUDIEMHP SET CAMTHI=:diem WHERE IDLHP=:idlhp AND IDSV=:idsv";
	            $p_sql = oci_parse($conn, $sql);
	            oci_bind_by_name($p_sql, ":idlhp", $idlhp);
	            oci_bind_by_name($p_sql, ":idsv", $idsv);
	            oci_bind_by_name($p_sql, ":diem", $diem);
	            oci_execute($p_sql);
	            oci_free_statement($p_sql);
	            oci_close($conn);
            }
			break;
		default:
			# code...
			break;
	}
 ?>