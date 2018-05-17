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
				<h5>Khoa</h5>
				<hr>
			</div>	
		</div>
		<div class="row">
			<div class="col-12">
				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#themkhoa">Thêm khoa</button>
				<br><br>
                <table id="bangkhoa" class="table table-bordered table-hover table-striped">
                    <thead>
                    	<tr style="text-align: center;">
                            <th>STT</th>
                            <th>Mã khoa</th>
                            <th>Tên khoa</th>
                            <th>SĐT khoa</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php $khoa = lay_khoa_chuyen_mon(); $stt = 1;
                    	while ($row = oci_fetch_assoc($khoa)){ ?>
                            <tr style="text-align: center;">
                                <th><?php echo $stt; ?></th>
                                <td><?php echo $row['MAKHOA'] ?></td>
                                <td><?php echo $row['TENKHOA'] ?></td>
                                <td><?php echo $row['SDTKHOA'] ?></td>
                                <td><button class="btn btn-primary btn-sm sua" lydata="<?php echo $row['IDKHOA'] ?>">Sửa</button>&ensp;<button class="btn btn-danger btn-sm xoa" lydata="<?php echo $row['IDKHOA'] ?>">Xóa</button></td>
                            </tr>
                        <?php $stt++; } ?>
                    </tbody>
                    </table>
			</div>
		</div>
	</div>

<!-- Thêm -->
<div class="modal fade" id="themkhoa" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Thêm khoa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Mã khoa</label>
            <input type="text" class="form-control" id="mk">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tên khoa</label>
            <input type="text" class="form-control" id="tk">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Số điện thoại khoa</label>
            <input type="text" class="form-control" id="sdtk">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="btthemkhoa">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Sửa -->
<div class="modal fade" id="suakhoa" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Sửa khoa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Mã khoa</label>
            <input type="text" class="form-control" id="smk">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tên khoa</label>
            <input type="text" class="form-control" id="stk">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Số điện thoại khoa</label>
            <input type="text" class="form-control" id="ssdtk">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="btsuakhoa">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Xóa -->
<div class="modal fade" id="xoakhoa" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Xóa khoa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    <strong>Bạn có chắc xóa khoa này?</strong><hr>
                    <b>Mã khoa:</b> <span id="xmk"></span><br>
                    <b>Tên khoa:</b> <span id="xtk"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-danger" id="btxoakhoa">Xóa</button>
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
            var id=0;
            $('#bangkhoa').DataTable();
            $('#btthemkhoa').on('click',function(){
            	if(!$('#tk').val().trim()){
            		alert('Nhập tên khoa');return;
            	}
            	if(!$('#mk').val().trim()){
            		alert('Nhập mã khoa');return;
            	}
	            $.ajax({
	                url: 'ajax_them_khoa.php',
	                type: 'POST',
	                data: {
	                    mk: $('#mk').val().trim(),
	                    tk: $('#tk').val().trim(),
                        sdtk: $('#sdtk').val().trim()
                    },
	                success: function (data) {
	                    var mang = $.parseJSON(data);
	                    if(mang.trangthai==1){
	                        thanhcong('Đã lưu khoa');
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
                $('#smk').val($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
                $('#stk').val($(this).parent('td').parent('tr').find('td:nth-child(3)').text().trim());
                $('#ssdtk').val($(this).parent('td').parent('tr').find('td:nth-child(4)').text().trim());
                id = $(this).attr('lydata');
                $('#suakhoa').modal('show');
            });
            $('#btsuakhoa').on('click',function(){
                if(!$('#stk').val().trim()){
                    alert('Nhập tên khoa');return;
                }
                if(!$('#smk').val().trim()){
                    alert('Nhập mã khoa');return;
                }
                $.ajax({
                    url: 'ajax_sua_khoa.php',
                    type: 'POST',
                    data: {
                        mk: $('#smk').val().trim(),
                        tk: $('#stk').val().trim(),
                        sdtk: $('#ssdtk').val().trim(),
                        id: id
                    },
                    success: function (data) {
                        var mang = $.parseJSON(data);
                        if(mang.trangthai==1){
                            thanhcong('Đã sửa khoa');
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
            $('.xoa').on('click',function(){
                $('#xmk').text($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
                $('#xtk').text($(this).parent('td').parent('tr').find('td:nth-child(3)').text().trim());
                id = $(this).attr('lydata');
                $('#xoakhoa').modal('show');
            });
            $('#btxoakhoa').on('click',function(){
                $.ajax({
                    url: 'ajax_xoa_khoa.php',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        var mang = $.parseJSON(data);
                        if(mang.trangthai==1){
                            thanhcong('Đã xóa khoa');
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
        } );

    </script>
    <script src="../js/bootstrap-notify.min.js"></script>
</body>
</html>