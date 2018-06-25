<?php require_once "check_login.php"; ?>
<?php require_once "_l_function.php";?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once "head.php"; ?>
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
				<h5>Giáo viên</h5>
				<hr>
			</div>	
		</div>
		<div class="row">
			<div class="col-12">
				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#themgiaovien">Thêm giáo viên</button>&ensp;
                <button class="btn btn-primary btn-sm" id="btnhapgiaovien" data-toggle="modal">Nhập file Excel</button>
                <input id="nhapgiaovien" hidden="hidden" type="file" name="" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
				<br><br>
                <div id="bangdanhsach">
                    <table id="banggv" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr style="text-align: center;">
                                <th>STT</th>
                                <th>Mã GV</th>
                                <th>Họ tên GV</th>
                                <th>SĐT GV</th>
                                <th>Mail GV</th>
                                <th>Khoa</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $giaovien = lay_giao_vien(); $stt = 1;
                            while ($row = oci_fetch_assoc($giaovien)){ ?>
                                <tr style="text-align: center;">
                                    <th><?php echo $stt; ?></th>
                                    <td><?php echo $row['MAGV'] ?></td>
                                    <td style="text-align: left;"><?php echo $row['HOTENGV'] ?></td>
                                    <td style="text-align: left;"><?php echo $row['SDTGV'] ?></td>
                                    <td style="text-align: left;"><?php echo $row['EMAILGV'] ?></td>
                                    <td style="text-align: left;" lydata="<?php echo $row['IDKHOA'] ?>">
                                        <?php echo $row['TENKHOA'] ?>
                                    </td>
                                    <td><button class="btn btn-primary btn-sm sua" lydata="<?php echo $row['IDGV'] ?>">Sửa</button>&ensp;<button class="btn btn-danger btn-sm xoa" lydata="<?php echo $row['IDGV'] ?>">Xóa</button></td>
                                </tr>
                            <?php $stt++; } ?>
                        </tbody>
                    </table>
                </div>
			</div>
		</div>
	</div>
    <?php include_once "footer.php"; ?>
<!-- Thêm -->
<div class="modal fade" id="themgiaovien" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Thêm giáo viên</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Mã giáo viên</label>
            <input type="text" class="form-control" id="mgv">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tên giáo viên</label>
            <input type="text" class="form-control" id="tgv">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Số điện thoại giáo viên</label>
            <input type="text" class="form-control" id="sdtgv">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Mail giáo viên</label>
            <input type="text" class="form-control" id="mailgv">
          </div>
          <div class="form-group">
            <label for="tags" class="col-form-label">Công tác tại khoa</label>
            <select class="form-control" id="kgv">
                <?php $khoa = lay_khoa_chuyen_mon();
                while ($row = oci_fetch_assoc($khoa)) { 
                    echo "<option value='".$row['IDKHOA']."'>".$row['TENKHOA']."</option>";
                } ?></select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="btthemgv">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Sửa -->
<div class="modal fade" id="suagiaovien" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Sửa giáo viên</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Mã giáo viên</label>
            <input type="text" class="form-control" id="smgv">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tên giáo viên</label>
            <input type="text" class="form-control" id="stgv">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Số điện thoại giáo viên</label>
            <input type="text" class="form-control" id="ssdtgv">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Mail giáo viên</label>
            <input type="text" class="form-control" id="smailgv">
          </div>
          <div class="form-group">
            <label for="tags" class="col-form-label">Công tác tại khoa</label>
            <select class="form-control" id="skgv">
                <?php $khoa = lay_khoa_chuyen_mon();
                while ($row = oci_fetch_assoc($khoa)) { 
                    echo "<option value='".$row['IDKHOA']."'>".$row['TENKHOA']."</option>";
                } ?></select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="btsuagiaovien">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Xóa -->
<div class="modal fade" id="xoagiaovien" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Xóa giáo viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    <strong>Bạn có chắc xóa giáo viên này?</strong><hr>
                    <b>Mã giáo viên:</b> <span id="xmgv"></span><br>
                    <b>Tên giáo viên:</b> <span id="xtgv"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-danger" id="btxoagv">Xóa</button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="../css/datatables.min.css">
<script src="../js/datatables.min.js" type="text/javascript"></script>
<script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('body .dropdown-toggle').dropdown();
            $('#giaovien').addClass('active');
            var id=0;
            $('#banggv').DataTable();
            $('#btthemgv').on('click',function(){
            	if(!$('#tgv').val().trim()){
            		alert('Nhập tên giáo viên');return;
            	}
            	if(!$('#mgv').val().trim()){
            		alert('Nhập mã giáo viên');return;
            	}
                if(!$('#mailgv').val().trim()){
                    alert('Nhập mail giáo viên');return;
                }
                if(!$('#kgv').val().trim()){
                    alert('Chọn khoa cho giáo viên');return;
                }
	            $.ajax({
	                url: 'ajax_them_giao_vien.php',
	                type: 'POST',
	                data: {
	                    mgv: $('#mgv').val().trim(),
	                    tgv: $('#tgv').val().trim(),
                        mailgv:$('#mailgv').val().trim(),
                        sdtgv:$('#sdtgv').val().trim(),
                        kgv: $('#kgv').val().trim()
	                },
	                success: function (data) {
	                    var mang = $.parseJSON(data);
	                    if(mang.trangthai==1){
	                        thanhcong('Đã thêm giáo viên');
                            setTimeout(function () {
                                window.location.reload(true);
                            },800);
	                    }
	                    else{
	                    	khongthanhcong(mang.thongbao);
	                    }
	                },
	                error: function () {
	                    khongthanhcong('Xảy ra lỗi! Vui lòng thử lại');
	                }
	            });
           });
            $('.sua').on('click',function(){
                $('#smgv').val($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
                $('#stgv').val($(this).parent('td').parent('tr').find('td:nth-child(3)').text().trim());
                $('#ssdtgv').val($(this).parent('td').parent('tr').find('td:nth-child(4)').text().trim());
                $('#smailgv').val($(this).parent('td').parent('tr').find('td:nth-child(5)').text().trim());
                $('#skgv').val($(this).parent('td').parent('tr').find('td:nth-child(6)').attr('lydata').trim());
                id = $(this).attr('lydata');
                $('#suagiaovien').modal('show');
            });
            $('#btsuagiaovien').on('click',function(){
                if(!$('#stgv').val().trim()){
                    alert('Nhập tên giáo viên');return;
                }
                if(!$('#smgv').val().trim()){
                    alert('Nhập mã giáo viên');return;
                }
                if(!$('#smailgv').val().trim()){
                    alert('Nhập mail giáo viên');return;
                }
                if(!$('#skgv').val().trim()){
                    alert('Chọn khoa cho giáo viên');return;
                }
                $.ajax({
                    url: 'ajax_sua_giao_vien.php',
                    type: 'POST',
                    data: {
                        mgv: $('#smgv').val().trim(),
                        tgv: $('#stgv').val().trim(),
                        mailgv:$('#smailgv').val().trim(),
                        sdtgv:$('#ssdtgv').val().trim(),
                        kgv: $('#skgv').val().trim(),
                        id: id
                    },
                    success: function (data) {
                        var mang = $.parseJSON(data);
                        if(mang.trangthai==1){
                            thanhcong('Đã sửa giáo viên');
                            setTimeout(function () {
                                window.location.reload(true);
                            },800);
                        }
                        else{
                            khongthanhcong("Lỗi! Kiểm tra lại thông tin");
                        }
                    },
                    error: function () {
                        khongthanhcong('Xảy ra lỗi! Vui lòng thử lại');
                    }
                });
            });
            $('#btnhapgiaovien').on('click',function(){
                $('#nhapgiaovien').click();
            });
            $('.xoa').on('click',function(){
                $('#xmgv').text($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
                $('#xtgv').text($(this).parent('td').parent('tr').find('td:nth-child(3)').text().trim());
                id = $(this).attr('lydata');
                $('#xoagiaovien').modal('show');
            });
            $('#btxoagv').on('click',function(){
                $.ajax({
                    url: 'ajax_xoa_giao_vien.php',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        var mang = $.parseJSON(data);
                        if(mang.trangthai==1){
                            thanhcong('Đã xóa giáo viên');
                            setTimeout(function () {
                                window.location.reload(true);
                            }, 800);
                        }
                        else{
                            khongthanhcong("Lỗi! Kiểm tra lại thông tin");
                        }
                    },
                    error: function () {
                        khongthanhcong('Xảy ra lỗi! Vui lòng thử lại');
                    }
                });
            });
        $('#nhapgiaovien').change(function(){
            var file_data = $('#nhapgiaovien').prop('files')[0];
            var type = file_data.type;
            var match = ["application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"];
            if (type==match[0] || type==match[1]) { 
                var form_data = new FormData();
                //thêm files vào trong form data
                form_data.append('file', file_data);
                $.ajax({
                    url: 'ajax_import_file_giao_vien.php', // gửi đến file upload.php
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'post',
                    data: form_data,
                    success: function(data){
                        thanhcong("Tải dữ liệu hoàn tất");
                        $('#bangdanhsach').html(data);
                    },
                    error: function () {
                        $.notifyClose();
                        khongthanhcong('Không thể tải file');
                    }
                });
            }
            else{
                khongthanhcong('Vui lòng chọn định dạng Excel');
            }
        });
        } );

    </script>
    <script src="../js/bootstrap-notify.min.js"></script>

</body>