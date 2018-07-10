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
                <h5>Sinh viên - Lớp học phần</h5>
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
                <div class="col-md-4">
                    <label>Nhập danh sách sinh viên</label>
                    <br>
                    <button class="btn btn-primary btn-sm" id="nhapfile">Nhập file Excel</button><br><br>
                    <input type="file" hidden="hidden" id="taptin" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                </div>
            <div class="col-md-12">
                <hr>
                <div id="than">
                </div>
            </div>
        </div>
    </div>
    <?php include_once "footer.php"; ?>
<!-- Xóa -->
<div class="modal fade" id="xoasinhvienlophocphan" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Xóa sinh viên khỏi lớp học phần</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    <strong>Bạn có chắc xóa sinh viên này ra khỏi lớp học phần?</strong><hr>
                    <b>Mã lớp học phần:</b> <span id="malop"></span><br>
                    <b>Mã sinh viên:</b> <span id="masv"></span><br>
                    <b>Tên sinh viên:</b> <span id="tensv"></span>
                    <input type="text" hidden="hidden" id="idsv">
                    <input type="text" hidden="hidden" id="idlhp">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-danger" id="btxoasvlhp">Xóa</button>
            </div>
        </div>
    </div>
</div>
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
            $('#sinhvienlophocphan').addClass('active');
            $('#chonlophp').on('change',function(){
                $('#than').empty();
                if(!$(this).val()) return;
                $.ajax({
                    url: 'ajax_xu_ly_sinh_vien_lop_hoc_phan.php',
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
            $(document).on('click','#nhapfile', function(){
                $('#taptin').click();
            });
            $(document).on('change','#taptin', function(){
                var file_data = $('#taptin').prop('files')[0];
                var form_data = new FormData();
                form_data.append('file', file_data);
                $('#than').empty();
                $.ajax({
                    url: 'ajax_import_file_sinh_vien_lop_hoc_phan.php',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'post',
                    data: form_data,
                    beforeSend: function () {
                        $('#than').html('<div class="loader"></div>');
                    },
                    success: function(data){
                        $.notifyClose();
                        $('body').append(data);
                    },
                    error: function () {
                        $.notifyClose();
                        khongthanhcong('Không thể tải file');
                    }
                });
            });
            $(document).on('click','.xoa',function(){
                $('#idlhp').val($(this).attr('lylhp'));
                $('#idsv').val($(this).attr('lydata'));
                $('#masv').text($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
                $('#tensv').text($(this).parent('td').parent('tr').find('td:nth-child(3)').text().trim());
                $('#malop').text($(this).parent('td').parent('tr').find('td:nth-child(4)').text().trim());
                $('#xoasinhvienlophocphan').modal('show');
            });
            $(document).on('click','#btxoasvlhp',function(){
                $.ajax({
                    url: 'ajax_xoa_sinh_vien_lop_hoc_phan.php',
                    type: 'POST',
                    data: {
                        lhp: $('#idlhp').val().trim(),
                        sv: $('#idsv').val().trim()
                    },
                    success: function (data) {
                        var mang = jQuery.parseJSON(data);
                        if (mang.trangthai==1) {
                            thanhcong('Đã xóa sinh khỏi lớp học phần');
                            $.ajax({
                                url: 'ajax_xu_ly_sinh_vien_lop_hoc_phan.php',
                                type: 'POST',
                                data: {
                                    id: $('#chonlophp').val().trim()
                                },
                                success: function (data) {
                                    thanhcong('Tải dữ liệu hoàn tất');
                                    $('#than').html(data);
                                },
                                error: function () {
                                    khongthanhcong('Xảy ra lỗi! Vui lòng thử lại');
                                }
                            });
                            $('#xoasinhvienlophocphan').modal('hide');
                        }
                        else
                            khongthanhcong('Xảy ra lỗi! Vui lòng thử lại');
                    },
                    error: function () {
                        khongthanhcong('Xảy ra lỗi! Vui lòng thử lại');
                    }
                }); 
            });
        });
    </script>
    <script src="../js/bootstrap-notify.min.js"></script>
</body>
</html>