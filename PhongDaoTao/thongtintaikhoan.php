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
				<h5>Thông tin tài khoản</h5>
				<hr>
			</div>	
		</div>
		<div class="row">
			<div class="col-md-6">
			  <div class="form-group">
			    <label for="tags">Mã người quản trị</label>
			    <input type="text" class="form-control" id="ma" placeholder="VD: NQT001" value="<?php echo $macb; ?>">
                  <small id="loima" class="form-text text-danger"></small>
			  </div>
			</div>
			<div class="col-md-6">
			  <div class="form-group">
			    <label for="tags">Họ và Tên</label>
			    <input type="text" class="form-control" id="hoten" placeholder="VD: Nguyễn Văn An" value="<?php echo $hotencb ?>">
                  <small id="loihoten" class="form-text text-danger"></small>
			  </div>
			</div>
			<div class="col-md-6">
			  <div class="form-group">
			    <label for="tags">Số điện thoại</label>
			    <input type="text" class="form-control" id="sodienthoai" placeholder="VD: 090 xxx xxx" value="<?php echo $sodienthoaicb; ?>">
                  <small id="loisodienthoai" class="form-text text-danger"></small>
			  </div>
			</div>
			<div class="col-md-6">
			  <div class="form-group">
			    <label for="tags">Địa chỉ mail</label>
			    <input type="text" class="form-control" id="mail" placeholder="VD: xyz@gmail.com" value="<?php echo $mailcb ?>">
                  <small id="loimail" class="form-text text-danger"></small>
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
	<?php include_once "footer.php"; ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#taikhoan').addClass('active');
		$('#luu').on('click', function(){
		    var ma = $('#ma').val().trim();
		    var hoten = $('#hoten').val().trim();
		    var sodienthoai = $('#sodienthoai').val().trim();
		    var mail = $('#mail').val().trim();
		    if (!ma) {
		    	$('#loima').html('Không được bỏ trống');return;
		    }else $('#loima').html('');
            if(!hoten){$('#loihoten').html('Không được bỏ trống');return;}
            else $('#loihoten').html('');
            if(!sodienthoai){$('#loisodienthoai').html('Không được bỏ trống');return;}else $('#loisodienthoai').html('');
            if(!mail){$('#loimail').html('Không được bỏ trống');return;} else $('#loimail').html('');
            $.ajax({
                url: 'ajax_luu_thong_tin_tai_khoan.php',
                type: 'POST',
                data: {
                    ma: ma,
                    hoten: hoten,
                    sodienthoai: sodienthoai,
                    mail: mail,
                    id: '<?php echo $idcb; ?>'
                },
                success: function (data) {
                    var mang = $.parseJSON(data);
                    if(mang.trangthai==1){
                        $('#thongbao').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Đã lưu!</strong> Đã lưu thông tin<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    }
                    else{
                        $('#thongbao').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Không lưu!</strong> Kiểm tra lại thông tin<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
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