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
                <h5>Sinh viên</h5>
                <hr>
            </div>  
        </div>
        <div class="row">
                <div class="col-md-4">
                    <label>Chọn loại đào tạo</label>
                    <select class="form-control" id="chonnganh">
                        <option value="">---- Chọn loại đào tạo ---</option>
                    <?php $ln = lay_loai_dao_tao();
                    while ($row = oci_fetch_assoc($ln)) {
                         echo "<option value='".$row['IDCTDT']."'>".$row['TENCTDT']." - ".$row['TRINHDODT']."</option>";
                     } ?>
                    </select>            
                </div>
                <div class="col-md-4">
                    <label>Chọn lớp</label>
                    <select class="form-control" id="chonlop">
                        <option value="">---- Chọn lớp ---</option>
                    <?php $l = lay_lop();
                    while ($row = oci_fetch_assoc($l)) {
                         echo "<option value='".$row['IDLOP']."'>".$row['MALOP']." - ".$row['TENLOP']."</option>";
                     } ?>
                    </select>            
                </div>
                <div class="col-md-4">
                    <label>Nhập sinh viên</label>
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

<!-- Sửa -->
<div class="modal fade" id="suasinhvien" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Sửa sinh viên</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Mã sinh viên</label>
            <input type="text" class="form-control" id="smsv">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tên sinh viên</label>
            <input type="text" class="form-control" id="stsv">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Ngày sinh sinh viên</label>
            <input type="date" class="form-control" id="snssv">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Giới tính sinh viên</label>
            <select class="form-control" id="sgtsv">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
                <option value="Khác">Khác</option>
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Mail sinh viên</label>
            <input type="text" class="form-control" id="smailsv">
          </div>
          <div class="form-group">
            <label for="tags" class="col-form-label">Quê quán sinh viên</label>
            <input type="text" class="form-control" id="sqqsv">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="btsuasinhvien">Lưu</button>
      </div>
    </div>
  </div>
</div>
<!-- Xóa -->
<div class="modal fade" id="xoasinhvien" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <b>Mã số:</b> <span id="xmasv"></span><br>
                    <b>Họ và Tên sinh:</b> <span id="xtensv"></span>
                    <input type="text" hidden="hidden" id="xidsv">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-danger" id="btxoasv">Xóa</button>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="../css/datatables.min.css">
<script src="../js/datatables.min.js" type="text/javascript"></script>
<script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        <?php $lop = null;
        $_lop = lay_lop();
        while ($row = oci_fetch_row($_lop)) {
           $lop[] = $row;
        }
        ?>
        var _lop_ = <?php echo json_encode($lop); ?>;
        var id=0;
        $(document).ready(function() {
            $('body .dropdown-toggle').dropdown();
            $('#sinhvien').addClass('active');
            $('#chonlop').on('change',function(){
                $('#than').empty();
                if(!$(this).val()) return;
                $.ajax({
                    url: 'ajax_xu_ly_sinh_vien.php',
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
            $('#chonnganh').on('change',function(){
                var th = $(this).val();
                $('#chonlop option:not(:first)').remove();
                _lop_.map(function (l) {
                    if (th == l[3])
                        $('#chonlop').append('<option value="'+l[0]+'">'+l[7]+' - '+l[8]+'</option>'); 
                });
            });
            $(document).on('click','#nhapfile', function(){
                $('#taptin').click();
            });
            $(document).on('change','#taptin', function(){
                var file_data = $('#taptin').prop('files')[0];
                var form_data = new FormData();
                form_data.append('file', file_data);
                console.log(file_data);
                $('#than').empty();
                $.ajax({
                    url: 'ajax_import_file_sinh_vien.php',
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
            $(document).on('click','.sua',function(){
                $('#smsv').val($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
                $('#stsv').val($(this).parent('td').parent('tr').find('td:nth-child(3)').text().trim());
                var da = $(this).parent('td').parent('tr').find('td:nth-child(4)').text().trim();
                var _da;
                if(!jQuery.isEmptyObject(da)){
                    _da=da.split("-");
                    $('#snssv').val(_da[2]+"-"+_da[1]+"-"+_da[0]);
                }
                $('#sgtsv').val($(this).parent('td').parent('tr').find('td:nth-child(5)').text().trim());
                $('#smailsv').val($(this).parent('td').parent('tr').find('td:nth-child(6)').text().trim());
                $('#sqqsv').val($(this).parent('td').parent('tr').find('td:nth-child(7)').text().trim());
                id = $(this).attr('lydata');
                $('#suasinhvien').modal('show');
            });
            $(document).on('click','#btsuasinhvien',function(){
                var masv = $('#smsv').val();
                var tensv = $('#stsv').val();
                var ngaysinhsv = $('#snssv').val();
                var gioitinhsv = $('#sgtsv').val();
                var mailsv = $('#smailsv').val();
                var quequansv = $('#sqqsv').val();
                if(tensv==''){
                    khongthanhcong('Tên sinh viên không bỏ trống');return;
                }
                if(masv==''){
                    khongthanhcong('Mã sinh viên không bỏ trống');return;
                }
                $.ajax({
                    url: 'ajax_sua_sinh_vien.php',
                    type: 'POST',
                    data: {
                        msv: masv,
                        tsv: tensv,
                        nssv: ngaysinhsv,
                        gtsv: gioitinhsv,
                        mailsv: mailsv,
                        qqsv: quequansv,
                        id: id
                    },
                    success: function (data) {
                        var mang = jQuery.parseJSON(data);
                        if (mang.trangthai==1) {
                            $('#suasinhvien').modal('hide');
                            thanhcong('Đã sửa sinh viên');
                            $('#suasinhvien').find('input').val('');
                            $('#suasinhvien').modal('hide');
                            $.ajax({
                                url: 'ajax_xu_ly_sinh_vien.php',
                                type: 'POST',
                                data: {
                                    id: $('#chonlop').val()
                                },
                                success: function (data) {
                                    $('#than').html(data);
                                },
                                error: function () {
                                    khongthanhcong('Xảy ra lỗi! Vui lòng thử lại');
                                }
                            });
                        }
                        else{
                            khongthanhcong('Có lỗi, vui lòng thử lại');
                        }
                    },
                    error: function () {
                        khongthanhcong('Xảy ra lỗi! Vui lòng thử lại');
                    }
                });
            });
            $(document).on('click','.xoa',function(){
                $('#xmasv').text($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
                $('#xtensv').text($(this).parent('td').parent('tr').find('td:nth-child(3)').text().trim());
                $('#xidsv').val($(this).attr('lydata'));
                $('#xoasinhvien').modal('show');
            });
            $(document).on('click','#btxoasv',function(){
                $.ajax({
                    url: 'ajax_xoa_sinh_vien.php',
                    type: 'POST',
                    data: {
                        id: $('#xidsv').val().trim()
                    },
                    success: function (data) {
                        var mang = jQuery.parseJSON(data);
                        if (mang.trangthai==1) {
                            thanhcong('Đã xóa sinh viên');
                            $.ajax({
                                url: 'ajax_xu_ly_sinh_vien.php',
                                type: 'POST',
                                data: {
                                    id: $('#chonlop').val()
                                },
                                success: function (data) {
                                    $('#than').html(data);
                                }
                            });
                        }else{
                            khongthanhcong('Xảy ra lỗi, vui lòng thử lại');
                        }
                    },
                    error: function () {
                        khongthanhcong('Xảy ra lỗi! Vui lòng thử lại');
                    }
                });
            });
        } );
    </script>
    <script src="../js/bootstrap-notify.min.js"></script>
</body>
</html>