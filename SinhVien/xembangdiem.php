<?php require_once "check_login.php"; ?>
<?php require_once "_l_function.php";?>
<?php 
    $idsv = 0;
    $idsv = $_SESSION['_idsv'];
 ?>
<!DOCTYPE html>
<html>
<head>
    <?php require_once "head.php"; ?>
    <style>
    .loader {
      margin: 0 auto;
      border: 8px solid #f3f3f3;
      border-radius: 50%;
      border-top: 8px solid #3498db;
      width: 60px;
      height: 60px;
      -webkit-animation: spin 1s linear infinite; /* Safari */
      animation: spin 1s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    .header_item_list{
        border-top: 0 !important;
    }
    .langgach{
        border-bottom: 2px solid #ffbf00;color: #d92e28;
    }
    </style>
</head>
<body>
    <?php require_once "menu.php"; ?>
    <br>
    <div class="col-md-12">
        <button class="btn btn-primary" onclick="printData();">Xem bảng in</button>
    </div>   
    <div class="container-fluid" id="noidungin">
        <style type="text/css">
            th{
                text-align: left;
            }
        </style>
        <div class="row">
            <div class="col-12">
                <div id="thongbao">
                </div>  
            </div>
            <div class="col-md-12">
                <h5 style="text-align: center;" class="text-success">BẢNG KẾT QUẢ HỌC TẬP</h5>
                <br>
            </div>  
            <?php $tt=lay_thong_tin_cua_sv($idsv); ?>
            <div class="col-md-12">
                <table class="table" style="width: 100%">
                    <tr>
                        <td>Họ và Tên</td>
                        <th><?php echo $tt['HOTENSV'] ?></th>
                        <td>Ngành</td>
                        <th><?php echo $tt['TENNDT'] ?></th>
                    </tr>
                    <tr>
                        <td>Mã số sinh viên</td>
                        <th><?php echo $tt['MASV'] ?></th>
                        <td>Trình độ đào tạo</td>
                        <th><?php echo $tt['TRINHDODT'] ?></th>
                    </tr>
                    <tr>
                        <td>Ngày sinh</td>
                        <th><?php if(empty($tt['NGAYSINHSV']) || $tt['NGAYSINHSV'] == 'null') echo ""; else echo date('d/m/Y', strtotime($tt['NGAYSINHSV'])); ?></th>
                        <td>Lớp</td>
                        <th><?php echo $tt['MALOP'] ?></th>
                    </tr>
                    <tr>
                        <td>Quê quán</td>
                        <th><?php echo $tt['QUEQUANSV'] ?></th>
                        <td>Khóa học</td>
                        <th><?php echo $tt['KHOAHOC'] ?></th>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <table id="bangsv" class="table table-hover" style="width: 100%;">
            <thead>
                <tr>
                    <th class="header_item_list" width="10px" rowspan="2">STT</th>
                    <th colspan="1" class="header_item_list " rowspan="2">Mã môn học</th>
                    <th colspan="4" class="header_item_list " rowspan="2">Tên môn học</th>
                    <th class="header_item_list" rowspan="2">Số TC</th>
                    <th class="header_item_list" rowspan="2">Điểm CC</th>
                    <th class="header_item_list" rowspan="2">Điểm GK</th>
                    <th class="header_item_list" rowspan="2">Điểm CK</th>
                    <th class="header_item_list" style="text-align:center;" colspan="3">
                        Điểm
                    </th>
                </tr>
                <tr style="text-align:center;">
                    <th class="header_item_list">Hệ 10</th>
                    <th class="header_item_list">Chữ</th>
                    <th class="header_item_list">Hệ 4</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $tongtc=0;
                $tongdiem=0;
                $hocky = lay_toan_bo_hoc_ky_cua_sv($idsv);
                while ($hk = oci_fetch_assoc($hocky)) { ?>
                <tr>
                    <th class="langgach" style="text-align: left;" colspan="13"><?php echo $hk['TENHK'].", ".$hk['NAMHOC'] ?></th>
                </tr>
                <?php
                $stt_mh = 1;
                $idhk = $hk['IDHK'];
                $tongtchk=0;
                $tongdiemhk=0;
                $monhoc = lay_sinh_vien_mon_hoc_trong_hoc_ky($idhk, $idsv);
                while ($mh = oci_fetch_assoc($monhoc)) {
                    $tongtchk+=$mh['SOTINCHI'];
                 ?>
                    <tr style="border-bottom: 1px solid #dee2e6;">
                        <td style="text-align:center; "><?php echo $stt_mh; ?></td>
                        <td style="text-align:center; " colspan="1"><?php echo $mh['MAMH']; ?></td>
                        <td colspan="4"><?php echo $mh['TENMH'] ?></td>
                        <td style="text-align:center; "><?php echo $mh['SOTINCHI'] ?></td>
                        <?php 
                            $idlhp = $mh['IDLHP'];
                            $diem = lay_sinh_vien_phieu_diem_lop_hoc_phan($idlhp, $idsv);
                            $d = oci_fetch_assoc($diem);
                            $tongdiemhk+=diem_he_10($d['DIEMCC'],$d['DIEMGK'],$d['DIEMCK'],$d['DIEMTHILAI'])*$mh['SOTINCHI'];
                         ?>
                        <td style="text-align:center; "><?php if(empty($d['DIEMCC']) || $d['DIEMCC']=='null') echo ""; else echo $d['DIEMCC'] ?></td>
                        <td style="text-align:center; "><?php if(empty($d['DIEMGK']) || $d['DIEMGK']=='null') echo ""; else echo $d['DIEMGK'] ?></td>
                        <td style="text-align:center; "><?php if(empty($d['DIEMCK']) || $d['DIEMCK']=='null' || empty($d['DIEMTHILAI']) || $d['DIEMTHILAI']=='null') echo ""; if($d['DIEMCK']>=$d['DIEMTHILAI']) echo $d['DIEMCK']; else echo $d['DIEMTHILAI'] ?></td>
                        <td style="text-align:center; "><?php echo diem_he_10($d['DIEMCC'],$d['DIEMGK'],$d['DIEMCK'],$d['DIEMTHILAI']); ?></td>
                        <td style="text-align:center; "><?php echo diem_chu($d['DIEMCC'],$d['DIEMGK'],$d['DIEMCK'],$d['DIEMTHILAI']); ?></td>
                        <td style="text-align:center; "><?php echo diem_he_4($d['DIEMCC'],$d['DIEMGK'],$d['DIEMCK'],$d['DIEMTHILAI']); ?></td>
                    </tr>
                <?php $stt_mh++; } ?>
                    <tr>
                        <th colspan="13">Điểm trung bình học kỳ: <?php echo round($tongdiemhk/$tongtchk,2); ?></th>
                    </tr>
                    <?php 
                    $tongtc+=$tongtchk;
                    $tongdiem+=$tongdiemhk;
                     ?>
                <?php } ?>
                    <tr>
                        <th colspan="13">
                            <br>
                            <br>
                            Số tín chỉ tích lũy: <?php echo $tongtc; ?>
                            <br>
                            Điểm trung bình tích lũy: <?php echo round($tongdiem/$tongtc,2); ?></th>
                    </tr>
            </tbody>
        </table>
    </div>
    <?php include_once "footer.php"; ?>
<link rel="stylesheet" type="text/css" href="../css/datatables.min.css">
<script src="../js/datatables.min.js" type="text/javascript"></script>
<script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('body .dropdown-toggle').dropdown();
            $('#bangdiem').addClass('active');
        } );
    </script>
    <script src="../js/bootstrap-notify.min.js"></script>
<script type="text/javascript">
    function printData()
    {
       var divToPrint=document.getElementById("noidungin");
       newWin= window.open("");
       newWin.document.write(divToPrint.outerHTML);
       newWin.print();
       newWin.close();
    }
</script>
</body>
</html>