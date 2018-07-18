<?php
sleep(2);
require_once "check_login.php";
require_once "_l_function.php";
include_once "../excel/PHPExcel.php";
$file = $_FILES['file']['tmp_name'];
$objReader = PHPExcel_IOFactory::createReaderForFile($file);
$listWorkSheets = $objReader->listWorksheetNames($file);
$danhsachlhp = null;
$dslhp = null;
for($i=0;$i<count($listWorkSheets);$i++){
    $objReader->setLoadSheetsOnly($listWorkSheets[$i]);
    $objExcel = $objReader->load($file);
    $sheetData = $objExcel->getActiveSheet()->toArray('null',true,true,true);
    $hightsRow = $objExcel->setActiveSheetIndex()->getHighestRow();
    for ($j=3; $j <=$hightsRow; $j++) { 
        $mlhp = $sheetData[$j]['A'];
    	$mssv = $sheetData[$j]['B'];
        $gc = $sheetData[$j]['C'];
        if ($mlhp!='' && $mssv!='') {
            $t_ds = [$mlhp,$mssv,$gc];
            $danhsachlhp[] = $t_ds;   
        }
    }
}
$lophocphan = lay_lop_hoc_phan();
while ($row = oci_fetch_assoc($lophocphan)) { 
    $dslhp[] = [$row['IDLHP'],$row['MALHP']];
} 
$demthanhcong = 0;
foreach ($danhsachlhp as $sv) {
    foreach ($dslhp as $l) {
        if ($sv[0]==$l[1]) {
            $conn = $ketnoi->ketnoi();
            $q_u = "SELECT * FROM DSLHP WHERE IDLHP=:idlhp AND IDSV IN (SELECT IDSV FROM SV WHERE MASV = :masv)";
            $p_u = oci_parse($conn, $q_u);
            oci_bind_by_name($p_u, ":idlhp", $l[0]);
            oci_bind_by_name($p_u, ":masv", $sv[1]);
            oci_execute($p_u);
            $kt = 0;
            while ($row = oci_fetch_row($p_u)) {
                $kt++;
            }
            oci_free_statement($p_u);
            if ($kt == 0) {
                $q_ut = "SELECT IDSV FROM SV WHERE MASV=:masv";
                $p_ut = oci_parse($conn, $q_ut);
                oci_bind_by_name($p_ut, ":masv", $sv[1]);
                oci_execute($p_ut);
                $idsv = 0;
                while ($row = oci_fetch_row($p_ut)) {
                    $idsv = $row[0];
                }
                if ($idsv>0) {
                    $sql = "INSERT INTO DSLHP(IDLHP, IDSV, GHICHU) VALUES (:idlhp, :idsv, :gc)";
                    $p_sql = oci_parse($conn, $sql);
                    oci_bind_by_name($p_sql, ":idlhp", $l[0]);
                    oci_bind_by_name($p_sql, ":idsv", $idsv);
                    oci_bind_by_name($p_sql, ":gc", $sv[2]);
                    oci_execute($p_sql);
                    $r_sql = oci_num_rows($p_sql);
                    oci_free_statement($p_sql);
                    oci_close($conn);
                    if ($r_sql > 0){ $demthanhcong++; } 
                }
            }
        }
    }
}

if ($demthanhcong > 0) { ?>
    <script type="text/javascript">
        $(document).ready(function(){
            thanhcong('Đã nhập thành công');
            setTimeout(function () {
                window.location.reload(true);
            }, 1500);
        });
    </script>
<?php
}else{ ?>
    <script type="text/javascript">
        $(document).ready(function(){
            thanhcong('Nhập không thành công');
            setTimeout(function () {
                window.location.reload(true);
            }, 1500);
        });
    </script>
<?php }
exit();
?>