<!DOCTYPE html>
<html lang="vi">
<head>
	<title>Quên mật khẩu | Quản lý điểm Đại học Sư phạm Kỹ thuật Vĩnh Long</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="icon" type="image/png" href="images/img-01.png"/>
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
		}
		.form{
		    position: absolute;
		    width: 300px;
		    margin: 0 auto;
		    margin-top: 10rem;
		    padding: 10px;
		    border: 1px solid #a9a9a9;
		    border-radius: 8px;
		    top: 0;
		    left: 0;
		    right: 0;
		    box-shadow: 0px 0px 6px 0px #b2d8ff;
		    background: #eef7ff;
		}
		.nhap{width:  200px;float:  left;margin-top: 0.5rem;padding: 4px;border-radius:  4px;border: 1px solid #2f71b7;}
		.form-title{
			float: left;
			font-size:  19px;
			font-family:  sans-serif;
			font-weight:  500;
		}
	</style>
</head>
<body>
    <header style="width: 100%; float: left;top:0;">
        <img src="images/header.png" style="width: 100%;box-shadow: 0px 0px 4px 1px #676767;">
    </header>
    <div class="form" method="post">
        <div style="background-image: url('images/pass.png');width: 80px;height: 80px;float: left;background-size: cover;background-position: center;margin-right: 10px;margin-top: 10px;"></div>
        <span class="form-title">
                QUÊN MẬT KHẨU
            </span>
            <p style="float:  left;width: 210px;color: #f00;">Nhập địa chỉ mail của bạn, chúng tôi sẽ gửi mật khẩu mới cho bạn</p>
        <input class="nhap" id="dcmail" type="text" placeholder="Nhập mail">
        <button id="gui" style="float: right;width: 60px;padding: 2px 0px;margin-top: 10px;font-size: 12px;">
            Gửi
        </button>
    </div>
<div style="position: fixed;margin-bottom: 0;left: 0;right:0;bottom: 0;height: 20px;width: 100%;background: #232323;color: #adadad;line-height:  20px;font-size: 85%;padding-left: 1rem;font-family:  monospace;">© Copyright of Nguyễn Ngọc Yến Linh (Faculty of Information Technology 2014)</div>
</body>
<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#gui').click(function(){
			if(!$('#dcmail').val().trim()){
				alert('Vui lòng nhập địa chỉ mail');
				return;
			}
            $.ajax({
                url: '_doimatkhau.php',
                type: 'POST',
                data: {
                    dcmail: $('#dcmail').val().trim()
                },
                success: function (data) {
                    $('body').append(data);
                },
                error: function () {
                    alert('Xảy ra lỗi, vui lòng thử lại sau');
                }
            });
		});
	});
</script>
</html>