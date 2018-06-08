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
				<h5>Ngành đào tạo</h5>
				<hr>
			</div>	
		</div>
		<div class="row">
			<div class="col-12">
				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#themlophocphan">Thêm ngành đào tạo</button>
				<br><br>
                <table id="banglhp" class="table table-bordered table-hover table-striped">
                    <thead>
                    	<tr style="text-align: center;">
                            <th>STT</th>
                            <th>Mã ngành</th>
                            <th>Tên ngành</th>
                            <th>Hình thức đào tạo</th>
                            <th>Thời gian đào tạo</th>
                            <th>Trình độ đào tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php $nganh = lay_nganh_dao_tao(); $stt = 1;
                    	while ($row = oci_fetch_assoc($nganh)){ ?>
                            <tr>
                                <th><?php echo $stt; ?></th>
                                <td><?php echo $row['MANDT'] ?></td>
                                <td><?php echo $row['TENNDT'] ?></td>
                                <td><?php echo $row['HEDT'] ?></td>
                                <td><?php echo $row['THOIGIANDT'] ?></td>
                                <td><?php echo $row['TRINHDODT']; ?></td>
                                <td><button class="btn btn-primary btn-sm sua" lydata="<?php echo $row['IDNDT'] ?>">Sửa</button>&ensp;<button class="btn btn-danger btn-sm xoa" lydata="<?php echo $row['IDNDT'] ?>">Xóa</button></td>
                            </tr>
                        <?php $stt++; } ?>
                    </tbody>
                    </table>
			</div>
		</div>
	</div>
<?php include_once "footer.php"; ?>
<!-- Thêm -->
<div class="modal fade" id="themlophocphan" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Thêm ngành đào tạo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Mã ngành</label>
            <input type="text" class="form-control" id="mn">
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tên ngành</label>
            <input type="text" class="form-control" id="tn">
        </div> 
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Hình thức đào tạo</label>
            <select class="form-control" id="hdtn">
                <option value="">--- Chọn hệ đào tạo ---</option>
                <option value="Chính quy">Chính quy</option>
                <option value="Vừa học vừa làm">Vừa học vừa làm</option>
            </select>
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Thời gian đào tạo</label>
            <input type="text" class="form-control" id="tgdtn">
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Trình độ đào tạo</label>
            <select class="form-control" id="tddtn">
                <option value="">--- Chọn trình độ đào tạo ---</option>
                <option value="Trung cấp nghề">Trung cấp nghề</option>
                <option value="Cao đẳng">Cao đẳng</option>
                <option value="Đại học">Đại học</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="btthemnganhdaotao">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Sửa -->
<div class="modal fade" id="sualophocphan" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Sửa ngành đào tạo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Mã ngành</label>
            <input type="text" class="form-control" id="smn">
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tên ngành</label>
            <input type="text" class="form-control" id="stn">
        </div> 
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Hình thức đào tạo</label>
            <select class="form-control" id="shdtn">
                <option value="">--- Chọn hệ đào tạo ---</option>
                <option value="Chính quy">Chính quy</option>
                <option value="Vừa học vừa làm">Vừa học vừa làm</option>
            </select>
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Thời gian đào tạo</label>
            <input type="text" class="form-control" id="stgdtn">
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Trình độ đào tạo</label>
            <select class="form-control" id="stddtn">
                <option value="">--- Chọn trình độ đào tạo ---</option>
                <option value="Trung cấp nghề">Trung cấp nghề</option>
                <option value="Cao đẳng">Cao đẳng</option>
                <option value="Đại học">Đại học</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="btsuanhanhdaotao">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Xóa -->
<div class="modal fade" id="xoanganhdaotao" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Xóa ngành</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    <strong>Bạn có chắc xóa ngành này?</strong><hr>
                    <b>Mã ngành:</b> <span id="xmn"></span><br>
                    <b>Tên ngành:</b> <span id="xtn"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-danger" id="btxoanganhdaotao">Xóa</button>
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
            $('#nganhdaotao').addClass('active');
            var id=0;
            $('#banglhp').DataTable();
            $('#btthemnganhdaotao').on('click',function(){
            	if(!$('#mn').val().trim()){
            		alert('Nhập mã ngành');return;
            	}
            	if(!$('#tn').val().trim()){
            		alert('Nhập tên ngành');return;
            	}
                if(!$('#hdtn').val().trim()){
                    alert('Chọn hình thức đào tạo');return;
                }
                if(!$('#tgdtn').val().trim()){
                    alert('Nhập thời gian đào tạo');return;
                }
                if(!$('#tddtn').val().trim()){
                    alert('Chọn trình độ đào tạo');return;
                }
	            $.ajax({
	                url: 'ajax_them_nganh_dao_tao.php',
	                type: 'POST',
	                data: {
	                    mn: $('#mn').val().trim(),
	                    tn: $('#tn').val().trim(),
                        hdtn: $('#hdtn').val().trim(),
                        tgdtn: $('#tgdtn').val().trim(),
                        tddtn: $('#tddtn').val().trim()
                    },
	                success: function (data) {
	                    var mang = $.parseJSON(data);
	                    if(mang.trangthai==1){
	                        thanhcong('Đã lưu ngành đào tạo');
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
                $('#smn').val($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
                $('#stn').val($(this).parent('td').parent('tr').find('td:nth-child(3)').text().trim());
                $('#shdtn').val($(this).parent('td').parent('tr').find('td:nth-child(4)').text().trim());
                $('#stgdtn').val($(this).parent('td').parent('tr').find('td:nth-child(5)').text().trim());
                $('#stddtn').val($(this).parent('td').parent('tr').find('td:nth-child(6)').text().trim());
                id = $(this).attr('lydata');
                $('#sualophocphan').modal('show');
            });
            $('#btsuanhanhdaotao').on('click',function(){
                if(!$('#smn').val().trim()){
                    alert('Nhập mã ngành');return;
                }
                if(!$('#stn').val().trim()){
                    alert('Nhập tên ngành');return;
                }
                if(!$('#shdtn').val().trim()){
                    alert('Chọn hình thức đào tạo');return;
                }
                if(!$('#stgdtn').val().trim()){
                    alert('Nhập thời gian đào tạo');return;
                }
                if(!$('#stddtn').val().trim()){
                    alert('Chọn trình độ đào tạo');return;
                }
                $.ajax({
                    url: 'ajax_sua_nganh_dao_tao.php',
                    type: 'POST',
                    data: {
                        mn: $('#smn').val().trim(),
                        tn: $('#stn').val().trim(),
                        hdtn: $('#shdtn').val().trim(),
                        tgdtn: $('#stgdtn').val().trim(),
                        tddtn: $('#stddtn').val().trim(),
                        id: id
                    },
                    success: function (data) {
                        var mang = $.parseJSON(data);
                        if(mang.trangthai==1){
                            thanhcong('Đã sửa ngành đào tạo');
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
                $('#xmn').text($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
                $('#xtn').text($(this).parent('td').parent('tr').find('td:nth-child(3)').text().trim());
                id = $(this).attr('lydata');
                $('#xoanganhdaotao').modal('show');
            });
            $('#btxoanganhdaotao').on('click',function(){
                $.ajax({
                    url: 'ajax_xoa_nganh_dao_tao.php',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        var mang = $.parseJSON(data);
                        if(mang.trangthai==1){
                            thanhcong('Đã xóa ngành đào tạo');
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