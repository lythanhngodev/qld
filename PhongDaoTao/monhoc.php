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
				<h5>Môn học</h5>
				<hr>
			</div>	
		</div>
		<div class="row">
			<div class="col-12">
				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#themmonhoc">Thêm môn học</button>
				<br><br>
                <table id="banghocky" class="table table-bordered table-hover table-striped">
                    <thead>
                    	<tr style="text-align: center;">
                            <th>STT</th>
                            <th>Mã môn học</th>
                            <th>Tên môn học</th>
                            <th>Thuộc khoa</th>
                            <th>Số TCLT</th>
                            <th>Số TCTH</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php $monhoc = lay_mon_hoc(); $stt = 1;
                    	while ($row = oci_fetch_assoc($monhoc)){ ?>
                            <tr style="text-align: center;">
                                <th><?php echo $stt; ?></th>
                                <td><?php echo $row['MAMH'] ?></td>
                                <td><?php echo $row['TENMH'] ?></td>
                                <td lydata="<?php echo $row['IDKHOA'] ?>"><?php echo $row['TENKHOA'] ?></td>
                                <td><?php echo $row['SOTCLT']; ?></td>
                                <td><?php echo $row['SOTCTH']; ?></td>
                                <td><button class="btn btn-primary btn-sm sua" lydata="<?php echo $row['IDMH'] ?>">Sửa</button>&ensp;<button class="btn btn-danger btn-sm xoa" lydata="<?php echo $row['IDMH'] ?>">Xóa</button></td>
                            </tr>
                        <?php $stt++; } ?>
                    </tbody>
                    </table>
			</div>
		</div>
	</div>

<!-- Thêm -->
<div class="modal fade" id="themmonhoc" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Thêm môn học</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Mã môn học</label>
                <input type="text" class="form-control" id="mmh">
              </div>  
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Tên môn học</label>
                <input type="text" class="form-control" id="tmh">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Môn học thuộc khoa</label>
                <select class="form-control" id="kmh">
                    <?php $k = lay_khoa_chuyen_mon();
                    while ($khoa = oci_fetch_assoc($k)) {
                         echo "<option value='".$khoa['IDKHOA']."'>".$khoa['TENKHOA']."</option>";
                     } ?>
                </select>
              </div>  
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Số tín chỉ lý thuyết</label>
                <input type="number" min="0" class="form-control" id="stclt">
              </div>
            </div>  
            <div class="col-md-6">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Số tín chỉ thực hành</label>
                <input type="number" min="0" class="form-control" id="stcth">
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="btthemmonhoc">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Sửa -->
<div class="modal fade" id="suamonhoc" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Sửa môn học</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Mã môn học</label>
                <input type="text" class="form-control" id="smmh">
              </div>  
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Tên môn học</label>
                <input type="text" class="form-control" id="stmh">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Môn học thuộc khoa</label>
                <select class="form-control" id="skmh">
                    <?php $k = lay_khoa_chuyen_mon();
                    while ($khoa = oci_fetch_assoc($k)) {
                         echo "<option value='".$khoa['IDKHOA']."'>".$khoa['TENKHOA']."</option>";
                     } ?>
                </select>
              </div>  
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Số tín chỉ lý thuyết</label>
                <input type="number" min="0" class="form-control" id="sstclt">
              </div>
            </div>  
            <div class="col-md-6">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Số tín chỉ thực hành</label>
                <input type="number" min="0" class="form-control" id="sstcth">
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="btsuamonhoc">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Xóa -->
<div class="modal fade" id="xoamonhoc" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Xóa môn học</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    <strong>Bạn có chắc xóa môn học này?</strong><hr>
                    <b>Tên môn học:</b> <span id="xtmh"></span><br>
                    <b>Mã môn học:</b> <span id="xmmh"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-danger" id="btxoamonhoc">Xóa</button>
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
            $('#monhoc').addClass('active');
            var id=0;
            $('#banghocky').DataTable();
            $('#btthemmonhoc').on('click',function(){
                if(!$('#mmh').val().trim()){
                    alert('Nhập mã môn học');return;
                }
            	if(!$('#tmh').val().trim()){
            		alert('Nhập tên môn học');return;
            	}
            	if(!$('#kmh').val().trim()){
            		alert('Chọn khoa của môn học');return;
            	}
                if(!$('#stclt').val().trim() || !$.isNumeric($('#stclt').val().trim())){
                    alert('Nhập số tín chỉ lý thuyết');return;
                }
                if(!$('#stcth').val().trim() || !$.isNumeric($('#stcth').val().trim())){
                    alert('Nhập số tín chỉ thực hành');return;
                }
	            $.ajax({
	                url: 'ajax_them_mon_hoc.php',
	                type: 'POST',
	                data: {
	                    mmh: $('#mmh').val().trim(),
	                    tmh: $('#tmh').val().trim(),
                        kmh: $('#kmh').val().trim(),
                        stclt: $('#stclt').val().trim(),
                        stcth: $('#stcth').val().trim()
	                },
	                success: function (data) {
	                    var mang = $.parseJSON(data);
	                    if(mang.trangthai==1){
	                        thanhcong('Đã lưu môn học');
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
                $('#smmh').val($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
                $('#stmh').val($(this).parent('td').parent('tr').find('td:nth-child(3)').text().trim());
                $('#skmh').val($(this).parent('td').parent('tr').find('td:nth-child(4)').attr('lydata'));
                $('#sstclt').val($(this).parent('td').parent('tr').find('td:nth-child(5)').text().trim());
                $('#sstcth').val($(this).parent('td').parent('tr').find('td:nth-child(6)').text().trim());
                id = $(this).attr('lydata');
                $('#suamonhoc').modal('show');
            });
            $('#btsuamonhoc').on('click',function(){
                if(!$('#smmh').val().trim()){
                    alert('Nhập mã môn học');return;
                }
                if(!$('#stmh').val().trim()){
                    alert('Nhập tên môn học');return;
                }
                if(!$('#skmh').val().trim()){
                    alert('Chọn khoa của môn học');return;
                }
                if(!$('#sstclt').val().trim() || !$.isNumeric($('#sstclt').val().trim())){
                    alert('Nhập số tín chỉ lý thuyết');return;
                }
                if(!$('#sstcth').val().trim() || !$.isNumeric($('#sstcth').val().trim())){
                    alert('Nhập số tín chỉ thực hành');return;
                }
                $.ajax({
                    url: 'ajax_sua_mon_hoc.php',
                    type: 'POST',
                    data: {
                        mmh: $('#smmh').val().trim(),
                        tmh: $('#stmh').val().trim(),
                        kmh: $('#skmh').val().trim(),
                        stclt: $('#sstclt').val().trim(),
                        stcth: $('#sstcth').val().trim(),
                        id: id
                    },
                    success: function (data) {
                        var mang = $.parseJSON(data);
                        if(mang.trangthai==1){
                            thanhcong('Đã sửa môn học');
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
                $('#xtmh').text($(this).parent('td').parent('tr').find('td:nth-child(3)').text().trim());
                $('#xmmh').text($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
                id = $(this).attr('lydata');
                $('#xoamonhoc').modal('show');
            });
            $('#btxoamonhoc').on('click',function(){
                $.ajax({
                    url: 'ajax_xoa_mon_hoc.php',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        var mang = $.parseJSON(data);
                        if(mang.trangthai==1){
                            thanhcong('Đã xóa môn học');
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