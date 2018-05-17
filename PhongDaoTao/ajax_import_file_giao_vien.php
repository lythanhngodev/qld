<?php
require_once "check_login.php";
require_once "_l_function.php";
include_once "../excel/PHPExcel.php";
$file = $_FILES['file']['tmp_name'];
$objReader = PHPExcel_IOFactory::createReaderForFile($file);
$listWorkSheets = $objReader->listWorksheetNames($file);
$danhsachgv = null;
$dskhoa = null;
for($i=0;$i<count($listWorkSheets);$i++){
    $objReader->setLoadSheetsOnly($listWorkSheets[$i]);
    $objExcel = $objReader->load($file);
    $sheetData = $objExcel->getActiveSheet()->toArray('null',true,true,true);
    $hightsRow = $objExcel->setActiveSheetIndex()->getHighestRow();
    for ($j=3; $j <=$hightsRow; $j++) { 
        $mgv = $sheetData[$j]['A'];
    	$tgv = $sheetData[$j]['B'];
        $sdtgv = $sheetData[$j]['C'];
        $mailgv = $sheetData[$j]['D'];
        if ($mgv=='' || $tgv=='' || $mailgv=='') {
            continue;
        }
        $t_ds = [$listWorkSheets[$i],$mgv,$tgv,$sdtgv,$mailgv];
        $danhsachgv[] = $t_ds;
    }
}
$khoa = lay_khoa_chuyen_mon();
while ($row = oci_fetch_assoc($khoa)) { 
    $dskhoa[] = [$row['IDKHOA'],$row['MAKHOA']];
} 
$demthanhcong = 0;
foreach ($danhsachgv as $gv) {
    foreach ($dskhoa as $k) {
        if ($gv[0]==$k[1]) {
            $idkhoa = $k[0];
            if ($gv[1]!='null' && $gv[2]!='null' && $gv[4]!='null') {
                $conn = $ketnoi->ketnoi();
                $mgv = $gv[1];
                $tgv = $gv[2];
                $sdtgv = $gv[3];
                if ($sdtgv=='null') {
                    $sdtgv = "";
                }
                $mailgv = $gv[4];
                $kgv = $idkhoa;
                $sqlk = "SELECT * FROM GV WHERE (MAGV = :mgv OR EMAILGV=:mailgv)";
                $p_sqlk = oci_parse($conn, $sqlk);
                oci_bind_by_name($p_sqlk, ":mgv", $mgv);
                oci_bind_by_name($p_sqlk, ":mailgv", $mailgv);
                oci_execute($p_sqlk);
                $kt=0;
                while ($row = oci_fetch_row($p_sqlk)) {
                    $kt++;
                }
                oci_free_statement($p_sqlk);
                if ($kt==0) {
                    $sql = "INSERT INTO GV (MAGV, HOTENGV, SDTGV, EMAILGV, IDKHOA, MATKHAU) VALUES (:mgv, :tgv, :sdtgv, :mailgv, :kgv, :mk)";
                    $p_sql = oci_parse($conn, $sql);
                    $mk = md5($mgv);
                    oci_bind_by_name($p_sql, ":mgv", $mgv);
                    oci_bind_by_name($p_sql, ":tgv",$tgv);
                    oci_bind_by_name($p_sql, ":sdtgv",$sdtgv);
                    oci_bind_by_name($p_sql, ":mailgv",$mailgv);
                    oci_bind_by_name($p_sql, ":kgv",$kgv);
                    oci_bind_by_name($p_sql, ":mk",$mk);
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
            thanhcong('Đã thêm giáo viên');
            setTimeout(function () {
                window.location.reload(true);
            }, 1500);
        });
    </script>
<?php
}else{ ?>
    <script type="text/javascript">
        $(document).ready(function(){
            thanhcong('Đã thêm giáo viên');
            setTimeout(function () {
                window.location.reload(true);
            }, 1500);
        });
    </script>
<?php }
exit();
?>