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
			    <label for="tags">Mã sinh viên</label>
			    <input type="text" class="form-control" placeholder="VD: 140040xx" disabled="disabled" value="<?php echo $masv; ?>">
                  <small id="loima" class="form-text text-danger"></small>
			  </div>
			</div>
			<div class="col-md-6">
			  <div class="form-group">
			    <label for="tags">Họ và Tên</label>
			    <input type="text" class="form-control" id="hoten" disabled="disabled" value="<?php echo $hotensv ?>">
                  <small id="loihoten" class="form-text text-danger"></small>
			  </div>
			</div>
			<div class="col-md-6">
			  <div class="form-group">
			    <label for="tags">Quê quán</label>
			    <input type="text" class="form-control" id="quequan" placeholder="VD: Vĩnh Long" value="<?php echo $quequansv; ?>">
                  <small id="loiquequan" class="form-text text-danger"></small>
			  </div>
			</div>
			<div class="col-md-6">
			  <div class="form-group">
			    <label for="tags">Địa chỉ mail</label>
			    <input type="text" class="form-control" id="mail" placeholder="VD: xyz@gmail.com" value="<?php if(empty($mailsv)||$mailsv=='null') echo "";else echo $mailsv; ?>">
                  <small id="loimail" class="form-text text-danger"></small>
			  </div>
			</div>
			<div class="col-md-6">
			  <div class="form-group">
			    <label for="tags">Ngày sinh</label>
			    <input class="form-control" id="ngaysinh" type="date" value="<?php if(empty($ngaysinhsv)||$ngaysinhsv=='null') echo ""; else echo date('Y-m-d', strtotime($ngaysinhsv)); ?>" disabled="disabled" >
                  <small id="loingaysinh" class="form-text text-danger"></small>
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
		    var quequan = $('#quequan').val().trim();
		    var mail = $('#mail').val().trim();
		    var ngaysinh = $('#ngaysinh').val().trim();
		    if (!quequan) {
		    	$('#loiquequan').html('Không được bỏ trống');return;
		    }else $('#loiquequan').html('');
            if(!mail){$('#loimail').html('Không được bỏ trống');return;}
            else $('#loimail').html('');
            if(!ngaysinh){$('#loingaysinh').html('Không được bỏ trống');return;} else $('#loingaysinh').html('');
            $.ajax({
                url: 'ajax_luu_thong_tin_tai_khoan.php',
                type: 'POST',
                data: {
                    quequan: quequan,
                    mail: mail,
                    ngaysinh: ngaysinh,
                    id: '<?php echo $idsv; ?>'
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