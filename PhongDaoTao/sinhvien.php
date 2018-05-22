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
			<div class="col-12">
				<div class="col-md-4">
                    <label>Chọn lớp</label>
                    <select class="form-control" id="chonlop">
                        <option value="">---- Chọn lớp ---</option>
                    <?php $l = lay_lop();
                    while ($row = oci_fetch_assoc($l)) {
                         echo "<option value='".$row['IDLOP']."'>".$row['TENLOP']."</option>";
                     } ?>
                    </select>            
                </div>
                <hr>
                <div id="than">

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
            $('#sinhvien').addClass('active');
            $('#chonlop').on('change',function(){
                $('#than').html('');
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
        } );
    </script>
    <script src="../js/bootstrap-notify.min.js"></script>
</body>
</html>