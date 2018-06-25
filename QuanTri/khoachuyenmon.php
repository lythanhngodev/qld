<?php require_once "check_login.php"; ?>
<?php require_once "_l_function.php";?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once "head.php"; ?>
    <script src="../ckeditor/ckeditor.js"></script>
    <script src="../ckfinder/ckfinder.js"></script> 
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
                            <td hidden="hidden"></td>
                            <td hidden="hidden"></td>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php $khoa = lay_khoa_chuyen_mon(); $stt = 1;
                    	while ($row = oci_fetch_assoc($khoa)){ ?>
                            <tr>
                                <th><?php echo $stt; ?></th>
                                <td><?php echo $row['MAKHOA'] ?></td>
                                <td><?php echo $row['TENKHOA'] ?></td>
                                <td><?php echo $row['SDTKHOA'] ?></td>
                                <td hidden="hidden"><textarea><?php echo $row['CHUCNANG'] ?></textarea></td>
                                <td hidden="hidden"><textarea><?php echo $row['NHIEMVU'] ?></textarea></td>
                                <td><button class="btn btn-success btn-sm xemchitiet">Thông tin</button>&ensp;<button class="btn btn-primary btn-sm sua" lydata="<?php echo $row['IDKHOA'] ?>">Sửa</button>&ensp;<button class="btn btn-danger btn-sm xoa" lydata="<?php echo $row['IDKHOA'] ?>">Xóa</button></td>
                            </tr>
                        <?php $stt++; } ?>
                    </tbody>
                    </table>
			</div>
		</div>
	</div>
<?php include_once "footer.php"; ?>
<!-- Thêm -->
<div class="modal fade" id="themkhoa" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
          <div class="form-group">
              <label for="recipient-name" class="col-form-label">Chức năng</label>
              <textarea class="form-control" id="cn" rows="3"></textarea>
          </div>
          <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nhiệm vụ</label>
              <textarea class="form-control" id="nv" rows="3"></textarea>
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
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
          <div class="form-group">
              <label for="recipient-name" class="col-form-label">Chức năng</label>
              <textarea class="form-control" id="scn" rows="3"></textarea>
          </div>
          <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nhiệm vụ</label>
              <textarea class="form-control" id="snv" rows="3"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="btsuakhoa">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- xem chi tiet -->
<div class="modal fade" id="xemchitiet" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Thông tin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <h6>Mã khoa</h6>
                    <hr>
                    <p id="ct-makhoa"></p>
                    <h6>Tên khoa</h6>
                    <hr>
                    <p id="ct-tenkhoa"></p>
                    <h6>Số điệm thoại</h6>
                    <hr>
                    <p id="ct-sdtkhoa"></p>
                    <h6>Chức năng</h6>
                    <hr>
                    <p id="ct-chucnang"></p>
                    <h6>Nhiệm vụ</h6>
                    <hr>
                    <p id="ct-nhiemvu"></p>
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


<script type="text/javascript">
    CKEDITOR.replace( 'cn', {
      filebrowserBrowseUrl : '../ckfinder/ckfinder.html',
      filebrowserImageBrowseUrl : '../ckfinder/ckfinder.html?type=Images',
      filebrowserFlashBrowseUrl : '../ckfinder/ckfinder.html?type=Flash',
      filebrowserImageUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
      filebrowserFlashUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
    CKEDITOR.replace( 'nv', {
      filebrowserBrowseUrl : '../ckfinder/ckfinder.html',
      filebrowserImageBrowseUrl : '../ckfinder/ckfinder.html?type=Images',
      filebrowserFlashBrowseUrl : '../ckfinder/ckfinder.html?type=Flash',
      filebrowserImageUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
      filebrowserFlashUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
</script>
<link rel="stylesheet" type="text/css" href="../css/datatables.min.css">
<script src="../js/datatables.min.js" type="text/javascript"></script>
<script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        function lamrong(){
    if (typeof CKEDITOR != 'undefined') {
        $('form').on('reset', function(e) {
            if ($(CKEDITOR.instances).length) {
                for (var key in CKEDITOR.instances) {
                    var instance = CKEDITOR.instances[key];
                    if ($(instance.element.$).closest('form').attr('name') == $(e.target).attr('name')) {
                        instance.setData(instance.element.$.defaultValue);
                    }
                }
            }
        });
    }
        }
        $(document).ready(function() {
            $('body .dropdown-toggle').dropdown();
            $('#daotao').addClass('active');
            $('#khoa').addClass('active');
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
                        sdtk: $('#sdtk').val().trim(),
                        cn: CKEDITOR.instances['cn'].getData(),
                        nv: CKEDITOR.instances['nv'].getData()
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
                $('#scn').html('');
                $('#snv').html('');
                $('#smk').val($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
                $('#stk').val($(this).parent('td').parent('tr').find('td:nth-child(3)').text().trim());
                $('#ssdtk').val($(this).parent('td').parent('tr').find('td:nth-child(4)').text().trim());
                id = $(this).attr('lydata');
                $('#suakhoa').modal('show');
                $('#scn').html($(this).parent('td').parent('tr').find('td:nth-child(5) textarea').html());
                $('#snv').html($(this).parent('td').parent('tr').find('td:nth-child(6) textarea').html());
                CKEDITOR.replace( 'scn', {
                  filebrowserBrowseUrl : '../ckfinder/ckfinder.html',
                  filebrowserImageBrowseUrl : '../ckfinder/ckfinder.html?type=Images',
                  filebrowserFlashBrowseUrl : '../ckfinder/ckfinder.html?type=Flash',
                  filebrowserImageUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                  filebrowserFlashUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                });
                CKEDITOR.replace( 'snv', {
                  filebrowserBrowseUrl : '../ckfinder/ckfinder.html',
                  filebrowserImageBrowseUrl : '../ckfinder/ckfinder.html?type=Images',
                  filebrowserFlashBrowseUrl : '../ckfinder/ckfinder.html?type=Flash',
                  filebrowserImageUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                  filebrowserFlashUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                });
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
                        cn: CKEDITOR.instances['scn'].getData(),
                        nv: CKEDITOR.instances['snv'].getData(),
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
            $('.xemchitiet').on('click',function () {
                $('#ct-makhoa').html($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
                $('#ct-tenkhoa').html($(this).parent('td').parent('tr').find('td:nth-child(3)').text().trim());
                $('#ct-sdtkhoa').html($(this).parent('td').parent('tr').find('td:nth-child(4)').text().trim());
                $('#ct-chucnang').html($(this).parent('td').parent('tr').find('td:nth-child(5)').text().trim());
                $('#ct-nhiemvu').html($(this).parent('td').parent('tr').find('td:nth-child(6)').text().trim());
                $('#xemchitiet').modal('show');
            });
        } );

    </script>
    <script type="text/javascript">
        $('#suakhoa').on('hidden.bs.modal', function () {
            for(name in CKEDITOR.instances)
            {
                if (name != 'cn' && name != 'nv') {
                    CKEDITOR.instances[name].destroy(true);
                }
            }
        });
    </script>
    <script src="../js/bootstrap-notify.min.js"></script>
</body>
</html>