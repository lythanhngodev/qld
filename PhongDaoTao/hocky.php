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
				<h5>Học kỳ</h5>
				<hr>
			</div>	
		</div>
		<div class="row">
			<div class="col-12">
				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#themhocky">Thêm học kỳ</button>
				<br><br>
                <table id="banghocky" class="table table-bordered table-hover table-striped">
                    <thead>
                    	<tr style="text-align: center;">
                            <th>STT</th>
                            <th>Mã học kỳ</th>
                            <th>Tên học kỳ</th>
                            <th>Năm học</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php $hocky = lay_hoc_ky(); $stt = 1;
                    	while ($row = oci_fetch_assoc($hocky)){ ?>
                            <tr style="text-align: center;">
                                <th><?php echo $stt; ?></th>
                                <td><?php echo $row['MAHK'] ?></td>
                                <td><?php echo $row['TENHK'] ?></td>
                                <td><?php echo $row['NAMHOC'] ?></td>
                                <td><button class="btn btn-primary btn-sm sua" lydata="<?php echo $row['IDHK'] ?>">Sửa</button>&ensp;<button class="btn btn-danger btn-sm xoa" lydata="<?php echo $row['IDHK'] ?>">Xóa</button></td>
                            </tr>
                        <?php $stt++; } ?>
                    </tbody>
                    </table>
			</div>
		</div>
	</div>
    <?php include_once "footer.php"; ?>
<!-- Thêm -->
<div class="modal fade" id="themhocky" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Thêm học kỳ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Mã học kỳ</label>
            <input type="text" class="form-control" id="mhk">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tên học kỳ</label>
            <input type="text" class="form-control" id="thk">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Năm học</label>
            <input type="text" class="form-control" id="nh">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="btthemhocky">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Sửa -->
<div class="modal fade" id="suahocky" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Sửa học kỳ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Mã học kỳ</label>
            <input type="text" class="form-control" id="smhk">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tên học kỳ</label>
            <input type="text" class="form-control" id="sthk">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Năm học</label>
            <input type="text" class="form-control" id="snh">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="btsuahocky">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Xóa -->
<div class="modal fade" id="xoahocky" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Xóa học kỳ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    <strong>Bạn có chắc xóa học kỳ này?</strong><hr>
                    <b>Tên học kỳ:</b> <span id="xthk"></span><br>
                    <b>Năm học:</b> <span id="xnh"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-danger" id="btxoahocky">Xóa</button>
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
            $('#daotao').addClass('active');
            $('#hocky').addClass('active');
            var id=0;
            $('#banghocky').DataTable();
            $('#btthemhocky').on('click',function(){
                if(!$('#mhk').val().trim()){
                    alert('Nhập mã học kỳ');return;
                }
            	if(!$('#thk').val().trim()){
            		alert('Nhập tên học kỳ');return;
            	}
            	if(!$('#nh').val().trim()){
            		alert('Nhập năm học');return;
            	}
	            $.ajax({
	                url: 'ajax_them_hoc_ky.php',
	                type: 'POST',
	                data: {
                        mhk: $('#mhk').val().trim(),
	                    thk: $('#thk').val().trim(),
	                    nh: $('#nh').val().trim()
	                },
	                success: function (data) {
	                    var mang = $.parseJSON(data);
	                    if(mang.trangthai==1){
	                        thanhcong('Đã lưu học kỳ');
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
                $('#smhk').val($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
                $('#sthk').val($(this).parent('td').parent('tr').find('td:nth-child(3)').text().trim());
                $('#snh').val($(this).parent('td').parent('tr').find('td:nth-child(4)').text().trim());
                id = $(this).attr('lydata');
                $('#suahocky').modal('show');
            });
            $('#btsuahocky').on('click',function(){
                if(!$('#smhk').val().trim()){
                    alert('Nhập mã học kỳ');return;
                }
                if(!$('#sthk').val().trim()){
                    alert('Nhập tên học kỳ');return;
                }
                if(!$('#snh').val().trim()){
                    alert('Nhập năm học');return;
                }
                $.ajax({
                    url: 'ajax_sua_hoc_ky.php',
                    type: 'POST',
                    data: {
                        mhk: $('#smhk').val().trim(),
                        thk: $('#sthk').val().trim(),
                        nh: $('#snh').val().trim(),
                        id: id
                    },
                    success: function (data) {
                        var mang = $.parseJSON(data);
                        if(mang.trangthai==1){
                            thanhcong('Đã sửa học kỳ');
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
                $('#xthk').text($(this).parent('td').parent('tr').find('td:nth-child(3)').text().trim());
                $('#xnh').text($(this).parent('td').parent('tr').find('td:nth-child(4)').text().trim());
                id = $(this).attr('lydata');
                $('#xoahocky').modal('show');
            });
            $('#btxoahocky').on('click',function(){
                $.ajax({
                    url: 'ajax_xoa_hoc_ky.php',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        var mang = $.parseJSON(data);
                        if(mang.trangthai==1){
                            thanhcong('Đã xóa học kỳ');
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