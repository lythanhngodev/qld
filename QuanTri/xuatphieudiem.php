<?php require_once "check_login.php";
require_once "_l_function.php";
?>
<?php
if(!isset($_POST['lophocphan']) || empty($_POST['lophocphan'])){
    echo "Không có dữ liệu";
    exit();
}
function getNameFromNumber($num) {
    $numeric = ($num - 1) % 26;
    $letter = chr(65 + $numeric);
    $num2 = intval(($num - 1) / 26);
    if ($num2 > 0) {
        return getNameFromNumber($num2) . $letter;
    } else {
        return $letter;
    }
}
include_once "../excel/PHPExcel.php";
$objPHPExcel = new PHPExcel;
$numberSheet = 0;
$ketnoi = new _l_clsKetnoi();
$conn = $ketnoi->ketnoi();

$sql_lop = "SELECT lhp.MALHP, gv.HOTENGV, mh.TENMH, hk.TENHK, hk.NAMHOC, mh.SOTINCHI, mh.MAMH FROM LOPHOCPHAN lhp, GV gv, MONHOC mh, HOCKY hk WHERE lhp.IDGV = gv.IDGV AND lhp.IDMH = mh.IDMH AND lhp.IDHK = hk.IDHK AND lhp.IDLHP = :id";
$p_sql_lop = oci_parse($conn, $sql_lop);
oci_bind_by_name($p_sql_lop, ":id", $_POST['lophocphan']);
oci_execute($p_sql_lop);
$row_lop = oci_fetch_assoc($p_sql_lop);
$objPHPExcel->createSheet();
////Chọn trang cần ghi (là số từ 0->n)
$objPHPExcel->setActiveSheetIndex(0);
// //Tạo tiêu đề cho trang
$sheet = $objPHPExcel->getActiveSheet()->setTitle($row_lop['MALHP']);
$objPHPExcel->getActiveSheet()->getStyle('A1:Z200')->getFill()->applyFromArray(array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => 'FFFFFF'
    )
));
$styleArray_de = array(
    'font'  => array(
        'name'  => 'Times New Roman'
    ));
$objPHPExcel->getActiveSheet()->getDefaultStyle()
->applyFromArray($styleArray_de);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A1:B1');
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../images/logo.jpg');
// muốn chèn ảnh vào vị trí cố định A1
$objDrawing->setCoordinates('A1');
// chèn ảnh và tạo lk giữa ảnh và excel
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

$styleArray = array(
    'font'  => array(
        'name'  => 'Times New Roman'
    ));
$objPHPExcel->getActiveSheet()
    ->getStyle( $objPHPExcel->getActiveSheet()->calculateWorksheetDimension() )
    ->applyFromArray($styleArray);  

$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(70);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('C1:H1');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('I1:K1');
$sheet->setCellValue("C1","PHIẾU ĐIỂM\nHỌC PHẦN LÝ THUYẾT");
$objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->setWrapText(true);
$sheet->setCellValue("I1","Mã số: BM-ĐT-26-00\nNgày hiệu lực: 04/09/2015");
$objPHPExcel->getActiveSheet()->getStyle('I1')->getAlignment()->setWrapText(true);
$sheet->getStyle('A1:C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1:C1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->getStyle('I1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("C1")->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle("C1:I1")->getFont()->setBold(true);
$sheet->getStyle('A1:K1')
    ->applyFromArray(array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    ));

$sheet->setCellValue("A2",$row_lop['TENHK']);
$sheet->setCellValue("C2",$row_lop['NAMHOC']);
$sheet->setCellValue("G2","Mã lớp học phần: ".$row_lop['MALHP']);
$sheet->setCellValue("A3","Tên học phần: ".$row_lop['TENMH']);
$sheet->setCellValue("G3","Mã học phần: ".$row_lop['MAMH']);
$sheet->setCellValue("K3","Số TC: ".$row_lop['SOTINCHI']);

$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A4:A5');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('B4:B5');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('C4:C5');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('D4:D5');

$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('H4:H5');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('I4:I5');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('J4:J5');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('K4:K5');

$sheet->setCellValue("A4","TT");
$sheet->setCellValue("B4","MÃ SV");
$sheet->setCellValue("C4","HỌ VÀ TÊN");
$sheet->setCellValue("D4","Mã lớp");

$objPHPExcel->getActiveSheet()->getStyle('E4:G4')->getAlignment()->setWrapText(true);
$sheet->setCellValue("E4","Điểm quá trình");
$sheet->setCellValue("F4","Điểm giữa kỳ");
$sheet->setCellValue("G4","Điểm cuối kỳ");

$sheet->setCellValue("H4","Điểm HP");
$objPHPExcel->getActiveSheet()->getStyle('H4')->getAlignment()->setWrapText(true);
$sheet->setCellValue("I4","Thang điểm chữ");
$objPHPExcel->getActiveSheet()->getStyle('I4')->getAlignment()->setWrapText(true);

$sheet->setCellValue("J4","Ký tên");
$sheet->setCellValue("K4","Ghi chú");
$objPHPExcel->getActiveSheet()->getStyle('E4')->getAlignment()->setWrapText(true);
$sheet->setCellValue("E5","10%");
$objPHPExcel->getActiveSheet()->getStyle('F4')->getAlignment()->setWrapText(true);
$sheet->setCellValue("F5","40%");
$objPHPExcel->getActiveSheet()->getStyle('G4')->getAlignment()->setWrapText(true);
$sheet->setCellValue("G5","50%");

$sheet->getStyle('A4:K5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A4:K5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("A4:K5")->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(28);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(7);

$sinhvien = null;

$sql_lop_sv = "SELECT DISTINCT sv.IDSV, sv.HOTENSV, sv.MASV, l.MALOP FROM LOPHOCPHAN lhp, DSLHP ds, SV sv, LOP l WHERE lhp.IDLHP = ds.IDLHP AND ds.IDSV = sv.IDSV AND sv.IDLOP = l.IDLOP AND lhp.IDLHP=:lop order by sv.MASV ASC";
$p_sql_lop_sv = oci_parse($conn, $sql_lop_sv);
oci_bind_by_name($p_sql_lop_sv, ":lop", $_POST['lophocphan']);
oci_execute($p_sql_lop_sv);
while ($row_lop_sv = oci_fetch_assoc($p_sql_lop_sv)){
    $sinhvien[] = $row_lop_sv;
}
$dong = 6;
for ($i=0; $i < count($sinhvien); $i++) { 
    $sheet->setCellValue("A".$dong,$i+1);
    $sheet->setCellValue("B".$dong,$sinhvien[$i]['MASV']);
    $sheet->setCellValue("C".$dong,$sinhvien[$i]['HOTENSV']);
    $sheet->setCellValue("D".$dong,$sinhvien[$i]['MALOP']);

    $idsv = $sinhvien[$i]['IDSV'];
    $idlhp = $_POST['lophocphan'];
    $sql_diem = "SELECT DIEMCC, DIEMGK, DIEMCK, DIEMTHILAI, CAMTHI FROM PHIEUDIEMHP WHERE IDLHP=:idlhp AND IDSV =:idsv";
    $p_sql_diem = oci_parse($conn, $sql_diem);
    oci_bind_by_name($p_sql_diem, ":idlhp", $idlhp);
    oci_bind_by_name($p_sql_diem, ":idsv", $idsv);
    oci_execute($p_sql_diem);
    $demdiem = 0; $dchu="";$dso="";$camthi = 0;$cc=0;$gk=0;$ck=0;$tl=0;
    while ($row_diem = oci_fetch_assoc($p_sql_diem)){
        $demdiem++;
        $cc = $row_diem['DIEMCC'];
        $gk = $row_diem['DIEMGK'];
        $ck = $row_diem['DIEMCK'];
        $tl = $row_diem['DIEMTHILAI'];
        $camthi = $row_diem['CAMTHI'];
    }
    oci_free_statement($p_sql_diem);
    if ($demdiem==0){
        $sheet->setCellValue("E".$dong,"");
        $sheet->setCellValue("F".$dong,"");
        $sheet->setCellValue("G".$dong,"");
        $sheet->setCellValue("H".$dong,"");
        $sheet->setCellValue("I".$dong,"F");
    }else if ($demdiem>0){
        if ($camthi==1){
            $sheet->setCellValue("E".$dong,"0.0");
            $sheet->setCellValue("F".$dong,"0.0");
            $sheet->setCellValue("G".$dong,"0.0");
            $sheet->setCellValue("H".$dong,"0.0");
            $sheet->setCellValue("I".$dong,"F");
        }else{
            $sheet->setCellValue("E".$dong,$cc);
            $sheet->setCellValue("F".$dong,$gk);
            $sheet->setCellValue("G".$dong,$ck);
            $sheet->setCellValue("H".$dong,diem_he_10($cc,$gk,$ck,$tl));
            $sheet->setCellValue("I".$dong,diem_chu($cc,$gk,$ck,$tl));
        }
    }
    $dong++;
}
$sheet->getStyle('A4:K'.($dong-1))
    ->applyFromArray(array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    ));
$objPHPExcel->getActiveSheet()->getStyle('E6:I'.($dong-1))->getNumberFormat() ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$objPHPExcel->getActiveSheet()->getStyle('E6:I'.($dong-1))->getNumberFormat() ->setFormatCode('#,##0.0'); // kết quả dạng 36,774.2
$sheet->getStyle('A6:B'.($dong-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A6:B'.($dong-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$sheet->getStyle('D6:I'.($dong-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('D6:I'.($dong-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('H6:I'.($dong-1))->getFont()->setBold(true);

$sheet->setCellValue("B".($dong+3),"Trưởng khoa");
$sheet->setCellValue("F".($dong+2),"Vĩnh Long, ngày ".date('d')." tháng ".date('m')." năm ".date('Y'));
$sheet->setCellValue("F".($dong+3),"Giáo viên giảng dạy");

$objPHPExcel->getActiveSheet()->getStyle('B'.($dong+3))->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('F'.($dong+3))->getFont()->setBold(true);
$sheet->getStyle('B'.$dong.':K'.($dong+7))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('B'.$dong.':K'.($dong+7))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('F'.($dong+2).':K'.($dong+2));
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('F'.($dong+3).':K'.($dong+3));
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('F'.($dong+7).':K'.($dong+7));

    //Khởi tạo đối tượng PHPExcel_IOFactory để thực hiện ghi file
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header("Content-Disposition: attachment; filename= Phieu diem hoc phan.xlsx");
    header("Cache-Control: max-age=0");
    $objWriter->save("php://output"); //Lưu về máy tính*/
    die();
?>