<?php require_once "check_login.php"; ?>
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
    	// định dạng header
        $numrow = 6;
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:E2'); // tên trường
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:E3'); // phòng đào tạo
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A4:D4'); // học kỳ
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E4:H4'); // năm học
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('F2:W2'); // tiêu đề chính
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
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A6:A9'); // TT
        $sheet->setCellValue("A6","TT");
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B6:B9'); // mã sv
        $sheet->setCellValue("B6","MÃ SV");
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(8);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C6:C9'); // học và tên
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
        $sql_lop_hp = "SELECT DISTINCT lhp.IDLHP, lhp.MALHP, mh.SOTINCHI FROM LOPHOCPHAN lhp, DSLHP ds, SV sv, LOP l, MONHOC mh WHERE lhp.IDHK = :hocky AND lhp.IDLHP = ds.IDLHP AND ds.IDSV = sv.IDSV AND sv.IDLOP = l.IDLOP AND l.IDLOP=:lophoc AND lhp.IDMH = mh.IDMH";
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
            $objPHPExcel->setActiveSheetIndex()->mergeCells(getNameFromNumber($cot_lhp)."6:".getNameFromNumber($cot_lhp+1)."6"); // cột mã lớp học phần
            $sheet->setCellValue(getNameFromNumber($cot_lhp)."6",$lophocphan[$i]['MALHP']);
            $sheet->setCellValue(getNameFromNumber($cot_lhp)."7","Số TC");
            $sheet->setCellValue(getNameFromNumber($cot_lhp+1)."7",$lophocphan[$i]['SOTINCHI']);
            $objPHPExcel->setActiveSheetIndex()->mergeCells(getNameFromNumber($cot_lhp)."8:".getNameFromNumber($cot_lhp+1)."8");
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
        $objPHPExcel->setActiveSheetIndex()->mergeCells(getNameFromNumber($cot_lhp)."6:".getNameFromNumber($cot_lhp)."9");
        $sheet->setCellValue(getNameFromNumber($cot_lhp)."6","Điểm TB chung HK");
        $objPHPExcel->getActiveSheet()->getColumnDimension(getNameFromNumber($cot_lhp))->setWidth(7);
        $cot_lhp++;
        $objPHPExcel->setActiveSheetIndex()->mergeCells(getNameFromNumber($cot_lhp)."6:".getNameFromNumber($cot_lhp)."9");
        $sheet->setCellValue(getNameFromNumber($cot_lhp)."6","Kết quả");
        $objPHPExcel->getActiveSheet()->getColumnDimension(getNameFromNumber($cot_lhp))->setWidth(7);
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
        $numrowsv = 10;
        // xử lý sinh viên
        $sql_lop_sv = "SELECT DISTINCT sv.IDSV, sv.HOTENSV FROM LOPHOCPHAN lhp, DSLHP ds, SV sv, LOP l WHERE lhp.IDHK =:hocky AND lhp.IDLHP = ds.IDLHP AND ds.IDSV = sv.IDSV AND sv.IDLOP = l.IDLOP AND l.IDLOP=:lop order by sv.IDSV";
        $p_sql_lop_sv = oci_parse($conn, $sql_lop_sv);
        oci_bind_by_name($p_sql_lop_sv, ":hocky", $_POST['hocky']);
        oci_bind_by_name($p_sql_lop_sv, ":lop", $row_lop['IDLOP']);
        oci_execute($p_sql_lop_sv);
        while ($row_lop_sv = oci_fetch_assoc($p_sql_lop_sv)){
            $sinhvien[] = $row_lop_sv;
        }
        // nạp sinh viên và didemr sinh viên

    }
    if ($tontai_lop==0) {echo "Không có dữ liệu";die();}
    else{
        /*$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename= Bang diem tong hop.xlsx");
        header("Cache-Control: max-age=0");
        $objWriter->save("php://output"); //Lưu về máy tính*/
        die();
    }
    die();
 ?>