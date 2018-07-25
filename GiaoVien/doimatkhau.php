<?php require_once "check_login.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once "head.php"; ?>
</head>
<body>
	<?php require_once "menu.php"; ?>
	<div class="container">
		<br>
		<div class="row">
			<div class="col-12">
				<div id="thongbao">
				</div>	
			</div>
			<div class="col-md-12">
				<h5>Đổi mật khẩu</h5>
				<hr>
			</div>	
		</div>
		<div class="row">
			<div class="col-md-8">
			  <div class="form-group">
			    <label for="tags">Mật khẩu hiện tại</label>
			    <input type="password" class="form-control" id="mkht">
                  <small id="loimkht" class="form-text text-danger"></small>
			  </div>
			</div>
			<div class="col-md-8">
			  <div class="form-group">
			    <label for="tags">Mật khẩu mới</label>
			    <input type="password" class="form-control" id="mk1">
                  <small id="loimk1" class="form-text text-danger"></small>
			  </div>
			</div>
			<div class="col-md-8">
			  <div class="form-group">
			    <label for="tags">Nhập lại mật khẩu mới</label>
			    <input type="password" class="form-control" id="mk2">
                  <small id="loimk2" class="form-text text-danger"></small>
			  </div>
			</div>
			<div class="col-md-12">
				<hr>
				<center>
					<button class="btn btn-primary" id="luu">Lưu thông tin</button>
				</center>
			</div>
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#taikhoan').addClass('active');
		$('#luu').on('click', function(){
			var mkht = $('#mkht').val().trim();
		    var mk1 = $('#mk1').val().trim();
		    var mk2 = $('#mk2').val().trim();
		    if(!mkht){
		    	$('#loimkht').html('Không được bỏ trống');
		    	return;
		    } 
		    if(!mk1){
		    	$('#loimk1').html('Không được bỏ trống');
		    	return;
		    } 
		    else{
		    	$('#loimk1').html('');
		    }
            if(!mk2){
            	$('#loimk2').html('Không được bỏ trống');
            	return;
            } 
            else{
            	$('#loimk2').html('');
            }
            if(mk1!=mk2) {
            	$('#loimk2').html('Mật khẩu xác nhận không trùng khớp');
            	return;
            } 
            else {
            	$('#loimk2').html('');
            }
            $.ajax({
                url: 'ajax_doi_mat_khau.php',
                type: 'POST',
                data: {
                	mkht : mkht,
                    mk: mk1
                },
                success: function (data) {
                    var mang = $.parseJSON(data);
                    if(mang.trangthai==1){
                        $('#thongbao').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Đã lưu!</strong> Đã lưu thông tin<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    }
                    else{
                        $('#thongbao').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Không lưu!</strong> Kiểm tra lại thông tin<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    }
                },
                error: function () {
                    khongthanhcong('Xảy ra lỗi! Vui lòng thử lại');
                }
            });
		});
	});
</script>
</body>
</html>