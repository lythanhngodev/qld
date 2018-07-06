<?php require_once "check_login.php"; ?>
<?php require_once "_l_function.php";?>
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
    </style>
</head>
<body>
    <?php require_once "menu.php"; ?>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="thongbao">
                </div>  
            </div>
            <div class="col-md-12">
                <h5>Nhập điểm lớp học phần</h5>
                <hr>
            </div>  
        </div>
        <div class="row">
                <div class="col-md-4">
                    <label>Chọn học kỳ - năm học</label>
                    <select class="form-control" id="chonhknh">
                        <option value="">---- Chọn học kỳ - năm học ---</option>
                    <?php $hk = lay_hoc_ky();
                    while ($row = oci_fetch_assoc($hk)) {
                         echo "<option value='".$row['IDHK']."'>".$row['TENHK']." - ".$row['NAMHOC']."</option>";
                     } ?>
                    </select>            
                </div>
                <div class="col-md-4">
                    <label>Chọn lớp học phần</label>
                    <select class="form-control" id="chonlophp">
                        <option value="">---- Chọn lớp học phần ---</option>
                    <?php $l = lay_lop_hoc_phan();
                    while ($row = oci_fetch_assoc($l)) {
                         echo "<option value='".$row['IDLHP']."'>".$row['MALHP']." - ".$row['TENMH']."</option>";
                     } ?>
                    </select>            
                </div>
            <div class="col-md-12">
                <hr>
                <div id="than">
                </div>
            </div>
        </div>
    </div>
    <?php include_once "footer.php"; ?>
<link rel="stylesheet" type="text/css" href="../css/datatables.min.css">
<script src="../js/datatables.min.js" type="text/javascript"></script>
<script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        <?php $lop = null;
        $_lop = lay_lop_hoc_phan();
        while ($row = oci_fetch_row($_lop)) {
           $lop[] = $row;
        }
        ?>
        var _lop_ = <?php echo json_encode($lop); ?>;
        $(document).ready(function() {
            $('body .dropdown-toggle').dropdown();
            $('#diem').addClass('active');
            $('#nhapdiemlophocphan').addClass('active');
            $('#chonlophp').on('change',function(){
                $('#than').empty();
                if(!$(this).val()) return;
                $.ajax({
                    url: 'ajax_xu_ly_sinh_vien_nhap_diem.php',
                    type: 'POST',
                    beforeSend: function(){
                        $('#than').html('<div class="loader"></div>');
                    },
                    data: {
                        id: $(this).val()
                    },
                    success: function (data) {
                        thanhcong('Tải dữ liệu hoàn tất');
                        $('#than').html(data);
                    },
                    error: function () {
                        khongthanhcong('Xảy ra lỗi! Vui lòng thử lại');
                    }
                });
            });
            $('#chonhknh').on('change',function(){
                var th = $(this).val();
                $('#chonlophp option:not(:first)').remove();
                _lop_.forEach(function (l) {
                    if (th == l[1])
                        $('#chonlophp').append('<option value="'+l[0]+'">'+l[8]+' - '+l[7]+'</option>'); 
                });
            });
        } );
        function tinhdiemcc(t){
            var tr = $(t).parent('td').parent('tr');
            var idsv = tr.attr('id');
            var idlhp = tr.attr('idlhp');
            var cc = (!tr.find('td:nth-child(5) input').val().trim() || !$.isNumeric(tr.find('td:nth-child(5) input').val().trim()) || parseFloat(tr.find('td:nth-child(5) input').val().trim()) < 0 || parseFloat(tr.find('td:nth-child(5) input').val().trim()) > 10 || ((parseFloat(tr.find('td:nth-child(5) input').val().trim()))*10%10!=5 && (parseFloat(tr.find('td:nth-child(5) input').val().trim()))*10%10!=0)) ? 0 :parseFloat(tr.find('td:nth-child(5) input').val().trim());
            if(cc<=0){
                $(t).val('');
                tinhdiem('cc',idsv,idlhp, 0);
            }else{
                tinhdiem('cc',idsv,idlhp, cc);
            }
        }
        function tinhdiemgk(t){
            var tr = $(t).parent('td').parent('tr');
            var idsv = tr.attr('id');
            var idlhp = tr.attr('idlhp');
            var gk = (!tr.find('td:nth-child(6) input').val().trim() || !$.isNumeric(tr.find('td:nth-child(6) input').val().trim()) || parseFloat(tr.find('td:nth-child(6) input').val().trim()) < 0 || parseFloat(tr.find('td:nth-child(6) input').val().trim()) > 10 || ((parseFloat(tr.find('td:nth-child(6) input').val().trim()))*10%10!=5 && (parseFloat(tr.find('td:nth-child(6) input').val().trim()))*10%10!=0)) ? 0 :parseFloat(tr.find('td:nth-child(6) input').val().trim());
            if(gk<=0){
                $(t).val('');
                tinhdiem('gk',idsv,idlhp, 0);
            }else{
                tinhdiem('gk',idsv,idlhp, gk);
            }
        }
        function tinhdiemck(t){
            var tr = $(t).parent('td').parent('tr');
            var idsv = tr.attr('id');
            var idlhp = tr.attr('idlhp');
            var ck = (!tr.find('td:nth-child(7) input').val().trim() || !$.isNumeric(tr.find('td:nth-child(7) input').val().trim()) || parseFloat(tr.find('td:nth-child(7) input').val().trim()) < 0 || parseFloat(tr.find('td:nth-child(7) input').val().trim()) > 10 || ((parseFloat(tr.find('td:nth-child(7) input').val().trim()))*10%10!=5 && (parseFloat(tr.find('td:nth-child(7) input').val().trim()))*10%10!=0)) ? 0 :parseFloat(tr.find('td:nth-child(7) input').val().trim());
            if(ck<=0){
                $(t).val('');
                tinhdiem('ck',idsv,idlhp, 0);
            }else{
                tinhdiem('ck',idsv,idlhp, ck);
            }
        }
        function tinhdiemtl(t){
            var tr = $(t).parent('td').parent('tr');
            var idsv = tr.attr('id');
            var idlhp = tr.attr('idlhp');
            var tl = (!tr.find('td:nth-child(8) input').val().trim() || !$.isNumeric(tr.find('td:nth-child(8) input').val().trim()) || parseFloat(tr.find('td:nth-child(8) input').val().trim()) < 0 || parseFloat(tr.find('td:nth-child(8) input').val().trim()) > 10 || ((parseFloat(tr.find('td:nth-child(8) input').val().trim()))*10%10!=5 && (parseFloat(tr.find('td:nth-child(8) input').val().trim()))*10%10!=0)) ? 0 :parseFloat(tr.find('td:nth-child(8) input').val().trim());
            if(tl<=0){
                $(t).val('');
                tinhdiem('tl',idsv,idlhp, 0);
            }else{
                tinhdiem('tl',idsv,idlhp, tl);
            }
        }
        function camthi(t){
            var tr = $(t).parent('td').parent('tr');
            var ck = ($(t).is(':checked')) ? 1 : 0;
            var idsv = tr.attr('id');
            var idlhp = tr.attr('idlhp');
            tinhdiem('ct', idsv, idlhp, ck);
        }
        function tinhdiem(loai, idsv, idlhp, diem){
            $.ajax({
                url: 'ajax_nhap_diem.php',
                type: 'POST',
                data: {
                    loai: loai,
                    idsv: idsv,
                    idlhp: idlhp,
                    diem: diem
                },
                success: function (data) {
                    return;
                },
                error: function () {
                    khongthanhcong('Không có mạng internet');
                }
            });
        }
    </script>
    <script src="../js/bootstrap-notify.min.js"></script>
</body>
</html>