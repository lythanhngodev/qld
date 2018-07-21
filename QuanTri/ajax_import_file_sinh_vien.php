<?php
sleep(2);
require_once "check_login.php";
require_once "_l_function.php";
include_once "../excel/PHPExcel.php";
$file = $_FILES['file']['tmp_name'];
$objReader = PHPExcel_IOFactory::createReaderForFile($file);
$listWorkSheets = $objReader->listWorksheetNames($file);
$danhsachsv = null;
$dslop = null;
for($i=0;$i<count($listWorkSheets);$i++){
    $malop = $listWorkSheets[$i];
    $objReader->setLoadSheetsOnly($listWorkSheets[$i]);
    $objExcel = $objReader->load($file);
    $sheetData = $objExcel->getActiveSheet()->toArray('null',true,true,true);
    $hightsRow = $objExcel->setActiveSheetIndex()->getHighestRow();
    for ($j=3; $j <=$hightsRow; $j++) { 
        $msv = $sheetData[$j]['A'];
    	$tsv = $sheetData[$j]['B'];
        $nssv = $sheetData[$j]['C'];
        if ($nssv!='null') {
            $nssv = date("d-M-Y", strtotime($nssv));
        }
        $gtsv = $sheetData[$j]['D'];
        $emailsv = $sheetData[$j]['E'];
        $qqsv = $sheetData[$j]['F'];
        if ($msv!='' && $tsv!='') {
            $t_ds = [$malop,$msv,$tsv,$nssv,$gtsv, $emailsv, $qqsv];
            $danhsachsv[] = $t_ds;   
        }
    }
}
$khoa = lay_lop();
while ($row = oci_fetch_assoc($khoa)) { 
    $dslop[] = [$row['IDLOP'],$row['MALOP']];
} 
$demthanhcong = 0;
foreach ($danhsachsv as $sv) {
    foreach ($dslop as $l) {
        if ($sv[0]==$l[1]) {
            $conn = $ketnoi->ketnoi();
            $sqlk = "SELECT * FROM SV WHERE (MASV = :masv)";
            $p_sqlk = oci_parse($conn, $sqlk);
            oci_bind_by_name($p_sqlk, ":masv", $sv[1]);
            oci_execute($p_sqlk);
            $kt=0;
            while ($row = oci_fetch_row($p_sqlk)) {
                $kt++;
            }
            oci_free_statement($p_sqlk);
            if ($kt==0) {
                $sqlm = "SELECT IDLOP FROM LOP WHERE (MALOP = :malop) ";
                $p_sqlm = oci_parse($conn, $sqlm);
                oci_bind_by_name($p_sqlm, ":malop", $l[1]);
                oci_execute($p_sqlm);
                $km=0;
                $idlop = "";
                while ($row = oci_fetch_row($p_sqlm)) {
                    $idlop = $row[0];
                    $km++;
                }
                oci_free_statement($p_sqlm);
                if ($km > 0) {
                    // Chưa có sinh viên
                    if($sv[3]=='null'){
                        $sql = "INSERT INTO SV(IDLOP, MASV, HOTENSV, NGAYSINHSV, GIOITINHSV, EMAILSV, QUEQUANSV, MATKHAU) VALUES (:idlop, :masv, :hotensv, null,:gioitinhsv,:emailsv,:quequansv,:matkhausv)";
                        $p_sql = oci_parse($conn, $sql);
                        $matkhausv = md5($sv[1]);
                        //[$malop,$msv,$tsv,$nssv,$gtsv, $emailsv, $qqsv];
                        oci_bind_by_name($p_sql, ":idlop", $idlop);
                        oci_bind_by_name($p_sql, ":masv", $sv[1]);
                        oci_bind_by_name($p_sql, ":hotensv", $sv[2]);
                        oci_bind_by_name($p_sql, ":gioitinhsv", $sv[4]);
                        oci_bind_by_name($p_sql, ":emailsv", $sv[5]);
                        oci_bind_by_name($p_sql, ":quequansv", $sv[6]);
                        oci_bind_by_name($p_sql, ":matkhausv", $matkhausv);
                        oci_execute($p_sql);
                        $r_sql = oci_num_rows($p_sql);
                        oci_free_statement($p_sql);
                        oci_close($conn);
                        if ($r_sql > 0){ $demthanhcong++; }
                    }
                    else{
                        $sql = "INSERT INTO SV(IDLOP, MASV, HOTENSV, NGAYSINHSV, GIOITINHSV, EMAILSV, QUEQUANSV, MATKHAU) VALUES (:idlop, :masv, :hotensv, :ngaysinhsv,:gioitinhsv,:emailsv,:quequansv,:matkhausv)";
                        $p_sql = oci_parse($conn, $sql);
                        $matkhausv = md5($sv[1]);
                        //[$malop,$msv,$tsv,$nssv,$gtsv, $emailsv, $qqsv];
                        oci_bind_by_name($p_sql, ":idlop", $idlop);
                        oci_bind_by_name($p_sql, ":masv", $sv[1]);
                        oci_bind_by_name($p_sql, ":hotensv", $sv[2]);
                        oci_bind_by_name($p_sql, ":ngaysinhsv", $sv[3]);
                        oci_bind_by_name($p_sql, ":gioitinhsv", $sv[4]);
                        oci_bind_by_name($p_sql, ":emailsv", $sv[5]);
                        oci_bind_by_name($p_sql, ":quequansv", $sv[6]);
                        oci_bind_by_name($p_sql, ":matkhausv", $matkhausv);
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
            thanhcong('Đã nhập không thành công');
            setTimeout(function () {
                window.location.reload(true);
            }, 1500);
        });
    </script>
<?php }
exit();
?>