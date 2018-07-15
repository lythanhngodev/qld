<?php require_once "check_login.php";
require_once "_l_function.php";
?>
<?php
if(!isset($_POST['trinhdo']) || !isset($_POST['hocky']) || empty($_POST['trinhdo']) || empty($_POST['hocky'])){
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
$sql_lop = "SELECT DISTINCT l.IDLOP, l.MALOP, l.TENLOP,l.KHOAHOC, hk.TENHK, hk.NAMHOC, ndt.TENNDT FROM HOCKY hk, LOPHOCPHAN lhp, DSLHP ds, SV sv, LOP l, CTDAOTAO ct, NGANHDT ndt WHERE lhp.IDHK = hk.IDHK AND lhp.IDLHP = ds.IDLHP AND ds.IDSV = sv.IDSV AND sv.IDLOP = l.IDLOP AND hk.IDHK = :hocky AND l.IDCTDT=ct.IDCTDT AND ct.IDNDT=ndt.IDNDT AND ndt.TRINHDODT = :trinhdo";
$p_sql_lop = oci_parse($conn, $sql_lop);
oci_bind_by_name($p_sql_lop, ":trinhdo", $_POST['trinhdo']);
oci_bind_by_name($p_sql_lop, ":hocky", $_POST['hocky']);
oci_execute($p_sql_lop);
$tontai_lop = 0;
while ($row_lop = oci_fetch_assoc($p_sql_lop)) {
    $tontai_lop++;
    // Biến lớp học phần
    $lophocphan = null;
    $sinhvien = null;
    $objPHPExcel->createSheet();
    $objPHPExcel->setActiveSheetIndex($numberSheet);
    $sheet = $objPHPExcel->getActiveSheet()->setTitle($row_lop['MALOP']);
    $objPHPExcel->getActiveSheet()->getStyle('A1:CA200')->getFill()->applyFromArray(array(
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
    // định dạng header
    $numrow = 6;
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A2:E2'); // tên trường
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A3:E3'); // phòng đào tạo
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A4:D4'); // học kỳ
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('E4:H4'); // năm học
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('F2:W2'); // tiêu đề chính
    $sheet->setCellValue("A2","TRƯỜNG ĐHSP KỸ THUẬT VĨNH LONG");
    $sheet->getStyle('A2:E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A2:E2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $sheet->setCellValue("F2","BẢNG TỔNG HỢP KẾT QUẢ HỌC TẬP");
    $objPHPExcel->getActiveSheet()->getStyle("F2")->getFont()->setSize(16);
    $objPHPExcel->getActiveSheet()->getStyle("F2")->getFont()->setBold(true);
    $sheet->setCellValue("A3","PHÒNG ĐÀO TẠO");
    $sheet->getStyle('A3:E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A3:E3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle("A3:F3")->getFont()->setBold(true);

    $sheet->setCellValue("A4",$row_lop['TENHK']);
    $sheet->setCellValue("E4",$row_lop['NAMHOC']);
    $sheet->setCellValue("J4","Lớp: ".$row_lop['TENLOP']);
    $sheet->setCellValue("S4","Khóa: ".$row_lop['KHOAHOC']);
    $sheet->setCellValue("A5","Ngành: ".$row_lop['TENNDT']);
    $sheet->setCellValue("J5","Mã lớp: ".$row_lop['MALOP']);
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A6:A9'); // TT
    $sheet->setCellValue("A6","TT");
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('B6:B9'); // mã sv
    $sheet->setCellValue("B6","MÃ SV");
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('C6:C9'); // học và tên
    $sheet->setCellValue("C6","HỌ VÀ TÊN");
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);

    $sheet->getStyle('A6:C9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A6:C9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle("A6:C9")->getFont()->setBold(true);
    $sheet->getStyle('A6:C9')
        ->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        ));
    // xử lý phần học phần
    $sql_lop_hp = "SELECT DISTINCT lhp.IDLHP, lhp.MALHP, mh.SOTINCHI, mh.MAMH FROM LOPHOCPHAN lhp, DSLHP ds, SV sv, LOP l, MONHOC mh WHERE lhp.IDHK = :hocky AND lhp.IDLHP = ds.IDLHP AND ds.IDSV = sv.IDSV AND sv.IDLOP = l.IDLOP AND l.IDLOP=:lophoc AND lhp.IDMH = mh.IDMH";
    $p_sql_lop_hp = oci_parse($conn, $sql_lop_hp);
    oci_bind_by_name($p_sql_lop_hp, ":hocky", $_POST['hocky']);
    oci_bind_by_name($p_sql_lop_hp, ":lophoc", $row_lop['IDLOP']);
    oci_execute($p_sql_lop_hp);
    while ($row_lop_hp = oci_fetch_assoc($p_sql_lop_hp)){
        $lophocphan[] = $row_lop_hp;
    }
    // ghi thông tin lớp học phần
    $cot_lhp = 4;
    for ($i=0;$i<count($lophocphan);$i++){
        $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells(getNameFromNumber($cot_lhp)."6:".getNameFromNumber($cot_lhp+1)."6"); // cột mã lớp học phần
        $sheet->setCellValue(getNameFromNumber($cot_lhp)."6",$lophocphan[$i]['MAMH']);
        $sheet->setCellValue(getNameFromNumber($cot_lhp)."7","Số TC");
        $sheet->setCellValue(getNameFromNumber($cot_lhp+1)."7",$lophocphan[$i]['SOTINCHI']);
        $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells(getNameFromNumber($cot_lhp)."8:".getNameFromNumber($cot_lhp+1)."8");
        $sheet->setCellValue(getNameFromNumber($cot_lhp)."8","Điểm");
        $sheet->setCellValue(getNameFromNumber($cot_lhp)."9","Chữ");
        $sheet->setCellValue(getNameFromNumber($cot_lhp+1)."9","Số");
        $sheet->getStyle(getNameFromNumber($cot_lhp)."6:".getNameFromNumber($cot_lhp+1)."9")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle(getNameFromNumber($cot_lhp)."6:".getNameFromNumber($cot_lhp+1)."9")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($cot_lhp)."6:".getNameFromNumber($cot_lhp+1)."9")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension(getNameFromNumber($cot_lhp))->setWidth(6);
        $objPHPExcel->getActiveSheet()->getColumnDimension(getNameFromNumber($cot_lhp+1))->setWidth(6);
        $sheet->getStyle(getNameFromNumber($cot_lhp)."6:".getNameFromNumber($cot_lhp+1)."9")
            ->applyFromArray(array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            ));
        $cot_lhp+=2;
    }
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells(getNameFromNumber($cot_lhp)."6:".getNameFromNumber($cot_lhp)."9");
    $sheet->setCellValue(getNameFromNumber($cot_lhp)."6","Điểm TB chung HK");
    $objPHPExcel->getActiveSheet()->getColumnDimension(getNameFromNumber($cot_lhp))->setWidth(7);
    $cot_lhp++;
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells(getNameFromNumber($cot_lhp)."6:".getNameFromNumber($cot_lhp)."9");
    $sheet->setCellValue(getNameFromNumber($cot_lhp)."6","Kết quả");
    $objPHPExcel->getActiveSheet()->getColumnDimension(getNameFromNumber($cot_lhp))->setWidth(14);
    $objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($cot_lhp-1)."6:".getNameFromNumber($cot_lhp)."9")->getFont()->setBold(true);
    $sheet->getStyle(getNameFromNumber($cot_lhp-1)."6:".getNameFromNumber($cot_lhp)."9")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle(getNameFromNumber($cot_lhp-1)."6:".getNameFromNumber($cot_lhp)."9")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($cot_lhp-1)."6:".getNameFromNumber($cot_lhp)."9")->getAlignment()->setWrapText(true);
    $sheet->getStyle(getNameFromNumber($cot_lhp-1)."6:".getNameFromNumber($cot_lhp)."9")
        ->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        ));

    // xử lý sinh viên
    $sql_lop_sv = "SELECT DISTINCT sv.IDSV, sv.HOTENSV, sv.MASV FROM LOPHOCPHAN lhp, DSLHP ds, SV sv, LOP l WHERE lhp.IDHK =:hocky AND lhp.IDLHP = ds.IDLHP AND ds.IDSV = sv.IDSV AND sv.IDLOP = l.IDLOP AND l.IDLOP=:lop order by sv.MASV ASC";
    $p_sql_lop_sv = oci_parse($conn, $sql_lop_sv);
    oci_bind_by_name($p_sql_lop_sv, ":hocky", $_POST['hocky']);
    oci_bind_by_name($p_sql_lop_sv, ":lop", $row_lop['IDLOP']);
    oci_execute($p_sql_lop_sv);
    while ($row_lop_sv = oci_fetch_assoc($p_sql_lop_sv)){
        $sinhvien[] = $row_lop_sv;
    }
    //////////////////////////
    $bangdiem = null;
    // nạp sinh viên và điểm sinh viên
    $numrowsv = 10;
    for ($j=0;$j<count($sinhvien);$j++){
        $sheet->setCellValue("A$numrowsv",$j+1);
        $sheet->setCellValue("B$numrowsv",$sinhvien[$j]['MASV']);
        $sheet->setCellValue("C$numrowsv",$sinhvien[$j]['HOTENSV']);
        $cot_diem = 4;
        ///////////////////
        $tongsotinchi = 0;
        $tongdiem = 0;
        for ($k=0;$k<count($lophocphan);$k++){
            $idsv = $sinhvien[$j]['IDSV'];
            $idlhp = $lophocphan[$k]['IDLHP'];
            $sql_diem = "SELECT DIEMCC, DIEMGK, DIEMCK, DIEMTHILAI, CAMTHI FROM PHIEUDIEMHP WHERE IDLHP=:idlhp AND IDSV =:idsv";
            $p_sql_diem = oci_parse($conn, $sql_diem);
            oci_bind_by_name($p_sql_diem, ":idlhp", $idlhp);
            oci_bind_by_name($p_sql_diem, ":idsv", $idsv);
            oci_execute($p_sql_diem);
            $demdiem = 0; $dchu="";$dso="";$camthi = 0;
            while ($row_diem = oci_fetch_assoc($p_sql_diem)){
                $demdiem++;
                $dchu = diem_chu($row_diem['DIEMCC'],$row_diem['DIEMGK'],$row_diem['DIEMCK'],$row_diem['DIEMTHILAI']);
                $dso = diem_he_4($row_diem['DIEMCC'],$row_diem['DIEMGK'],$row_diem['DIEMCK'], $row_diem['DIEMTHILAI']);
                $camthi = $row_diem['CAMTHI'];
            }
            oci_free_statement($p_sql_diem);
            if ($demdiem==0){
                $sheet->setCellValue(getNameFromNumber($cot_diem).$numrowsv,"");
                $sheet->setCellValue(getNameFromNumber($cot_diem+1).$numrowsv,"");
            }else if ($demdiem>0){
                if ($camthi==1){
                    $sheet->setCellValue(getNameFromNumber($cot_diem).$numrowsv,"F");
                    $sheet->setCellValue(getNameFromNumber($cot_diem+1).$numrowsv,"0.0");
                }else{
                    $sheet->setCellValue(getNameFromNumber($cot_diem).$numrowsv,$dchu);
                    $sheet->setCellValue(getNameFromNumber($cot_diem+1).$numrowsv,$dso);
                    $tongdiem+=floatval($dso)*$lophocphan[$k]['SOTINCHI'];
                    $tongsotinchi=$tongsotinchi+floatval($lophocphan[$k]['SOTINCHI']);
                }
            }
            $cot_diem+=2;
        }
        if($tongsotinchi==0) $tongsotinchi=1;
        $sheet->setCellValue(getNameFromNumber($cot_diem).$numrowsv,round($tongdiem/$tongsotinchi,1));
        $sheet->setCellValue(getNameFromNumber($cot_diem+1).$numrowsv,xep_loai(round($tongdiem/$tongsotinchi,1)));
        $bangdiem[] = round($tongdiem/$tongsotinchi,1);
        $numrowsv++;
    }
    $sheet->getStyle("A10:"."B".($numrowsv-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("A10:"."B".($numrowsv-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $sheet->getStyle("D10:".getNameFromNumber($cot_lhp).($numrowsv-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("D10:".getNameFromNumber($cot_lhp).($numrowsv-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($cot_lhp-1)."9:".getNameFromNumber($cot_lhp).($numrowsv-1))->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($cot_lhp-1)."9:".getNameFromNumber($cot_lhp).($numrowsv-1))->getFont()->getColor()->setRGB('dc3545');
    $sheet->getStyle("A10:".getNameFromNumber($cot_lhp).($numrowsv-1))
        ->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        ));
    //////////////////////
    $xuatsac=0;
    $gioi=0;
    $kha=0;
    $trungbinh=0;
    $yeu=0;
    for ($o=0; $o < count($bangdiem); $o++) {
        if($bangdiem[$o]>3.6){$xuatsac++;continue;}
        if($bangdiem[$o]>=3.2){$gioi++;continue;}
        if ($bangdiem[$o]>=2.5){$kha++;continue;}
        if($bangdiem[$o]>=2.0){$trungbinh++;continue;}
        if($bangdiem[$o]<2.0){$yeu++;continue;}
    }
    $numrowsv++;
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("D$numrowsv:E$numrowsv");
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("D".($numrowsv+1).":E".($numrowsv+1));
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("D".($numrowsv+2).":E".($numrowsv+2));
    $sheet->setCellValue("D$numrowsv", "Xuất sắc");
    $sheet->setCellValue("D".($numrowsv+1), $xuatsac);
    $sheet->setCellValue("D".($numrowsv+2), round(($xuatsac/count($sinhvien))*100,2)."%");
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("F$numrowsv:G$numrowsv");
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("F".($numrowsv+1).":G".($numrowsv+1));
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("F".($numrowsv+2).":G".($numrowsv+2));
    $sheet->setCellValue("F$numrowsv", "Giỏi");
    $sheet->setCellValue("F".($numrowsv+1), $gioi);
    $sheet->setCellValue("F".($numrowsv+2), round(($gioi/count($sinhvien))*100,2)."%");
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("H$numrowsv:I$numrowsv");
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("H".($numrowsv+1).":I".($numrowsv+1));
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("H".($numrowsv+2).":I".($numrowsv+2));
    $sheet->setCellValue("H$numrowsv", "Khá");
    $sheet->setCellValue("H".($numrowsv+1), $kha);
    $sheet->setCellValue("H".($numrowsv+2), round(($kha/count($sinhvien))*100,2)."%");
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("J$numrowsv:K$numrowsv");
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("J".($numrowsv+1).":K".($numrowsv+1));
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("J".($numrowsv+2).":K".($numrowsv+2));
    $sheet->setCellValue("J$numrowsv", "Trung bình");
    $sheet->setCellValue("J".($numrowsv+1), $trungbinh);
    $sheet->setCellValue("J".($numrowsv+2), round(($trungbinh/count($sinhvien))*100,2)."%");
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("L$numrowsv:M$numrowsv");
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("L".($numrowsv+1).":M".($numrowsv+1));
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("L".($numrowsv+2).":M".($numrowsv+2));
    $sheet->setCellValue("L$numrowsv", "Yếu");
    $sheet->setCellValue("L".($numrowsv+1), $yeu);
    $sheet->setCellValue("L".($numrowsv+2), round(($yeu/count($sinhvien))*100,2)."%");
    $sheet->getStyle("C".$numrowsv.":M".($numrowsv+2))
        ->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        ));
    $objPHPExcel->getActiveSheet()->getStyle("C".$numrowsv.":M".$numrowsv)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle("C".$numrowsv.":C".($numrowsv+2))->getFont()->setBold(true);
    $sheet->getStyle("C".$numrowsv.":M".($numrowsv+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("C".$numrowsv.":M".($numrowsv+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $numrowsv++;
    $sheet->setCellValue("C$numrowsv", "Số sinh viên");
    $numrowsv++;
    $sheet->setCellValue("C$numrowsv", "Tỷ lệ %");
    $numrowsv+=2;
    // Footer
    // Phòng đào tạo
    $sheet->setCellValue("C$numrowsv", "Phòng Đào tạo");
    $objPHPExcel->getActiveSheet()->getStyle("C".$numrowsv)->getFont()->setBold(true);
    // Khoa chuyên môn
    $sheet->setCellValue("F$numrowsv", "Khoa chuyên môn");
    $objPHPExcel->getActiveSheet()->getStyle("F".$numrowsv)->getFont()->setBold(true);
    // Cố vấn học tập
    $sheet->setCellValue("L$numrowsv", "Cố vấn học tập");
    $objPHPExcel->getActiveSheet()->getStyle("L".$numrowsv)->getFont()->setBold(true);
    // Người lập bảng
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("P".$numrowsv.":S".$numrowsv);
    $sheet->setCellValue("P$numrowsv", "Vĩnh Long, ngày ".date('d')." tháng ".date('m')." năm ".date('Y'));
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("P".($numrowsv+1).":S".($numrowsv+1));
    $sheet->getStyle("P".$numrowsv.":S".($numrowsv+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("P".$numrowsv.":S".($numrowsv+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $sheet->setCellValue("P".($numrowsv+1), "Lập bảng");
    $objPHPExcel->getActiveSheet()->getStyle("P".($numrowsv+1))->getFont()->setBold(true);

    $objPHPExcel->getActiveSheet()->getStyle('A6:'.getNameFromNumber($cot_lhp)."9")->getFill()->applyFromArray(array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
            'rgb' => 'ffc107'
        )
    ));

    $numberSheet++;
}
if ($tontai_lop==0) {echo "Không có dữ liệu";die();}
else{
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header("Content-Disposition: attachment; filename= Bang diem tong hop.xlsx");
    header("Cache-Control: max-age=0");
    $objWriter->save("php://output"); //Lưu về máy tính*/
    die();
}
die();
?>