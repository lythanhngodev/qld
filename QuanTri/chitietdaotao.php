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
				<h5>Chương trình đào tạo</h5>
				<hr>
			</div>	
		</div>
		<div class="row">
			<div class="col-12">
				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#themchitietdaotao">Thêm chương trình đào tạo</button>
				<br><br>
                <table id="banglhp" class="table table-bordered table-hover table-striped" style="width: 100%;">
                    <thead>
                    	<tr style="text-align: center;">
                            <th>STT</th>
                            <th>Mã CTDT</th>
                            <th>Tên CTDT</th>
                            <th>Ngành đào tạo</th>
                            <th>Đơn vị quản lý</th>
                            <th>Số học phần</th>
                            <th>Số tín chỉ</th>
                            <th>Ghi chú</th>
                            <th style="width: 100px;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php $ctdt = lay_chi_tiet_dao_tao(); $stt = 1;
                    	while ($row = oci_fetch_assoc($ctdt)){ ?>
                            <tr style="text-align: center;">
                                <th><?php echo $stt; ?></th>
                                <td><?php echo $row['MACTDT'] ?></td>
                                <td><?php echo $row['TENCTDT'] ?></td>
                                <td lydata="<?php echo $row['IDNDT']; ?>"><?php echo $row['TENNDT'] ?></td>
                                <td lydata="<?php echo $row['IDKHOA']; ?>"><?php echo $row['TENKHOA'] ?></td>
                                <td><?php echo $row['SOHOCPHAN'] ?></td>
                                <td><?php echo $row['SOTINCHI'] ?></td>
                                <td><?php echo $row['GHICHU'] ?></td>
                                <td><button class="btn btn-primary btn-sm sua" lydata="<?php echo $row['IDCTDT'] ?>">Sửa</button>&ensp;<button class="btn btn-danger btn-sm xoa" lydata="<?php echo $row['IDCTDT'] ?>">Xóa</button></td>
                            </tr>
                        <?php $stt++; } ?>
                    </tbody>
                    </table>
			</div>
		</div>
	</div>
<?php include_once "footer.php"; ?>
<!-- Thêm -->
<div class="modal fade" id="themchitietdaotao" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Thêm chương trình đào tạo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Mã CTDT</label>
                        <input type="text" class="form-control" id="mct">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tên CTDT</label>
                        <input type="text" class="form-control" id="tct">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Ngành đào tạo</label>
                <select class="form-control" id="ndtct">
                    <option value="">--- Chọn ngành đào tạo ---</option>
                <?php $nganh = lay_nganh_dao_tao();
                while ($row = oci_fetch_assoc($nganh)) {
                     echo "<option value='".$row['IDNDT']."'>".$row['MANDT']," - ".$row['TENNDT']."</option>";
                 } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Đơn vị quản lý</label>
                <select class="form-control" id="kct">
                    <option value="">--- Chọn khoa ---</option>
                <?php $khoa = lay_khoa_chuyen_mon();
                while ($row = oci_fetch_assoc($khoa)) {
                     echo "<option value='".$row['IDKHOA']."'>".$row['MAKHOA']." - ".$row['TENKHOA']."</option>";
                 } ?>
                </select>
            </div> 
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Số học phần</label>
                        <input type="number" min="0" class="form-control" id="shpct">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Số tín chỉ</label>
                        <input type="number" min="0" class="form-control" id="stcct">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Ghi chú</label>
                <input type="text" class="form-control" id="gcct">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="btthemchitietdaotao">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Sửa -->
<div class="modal fade" id="suachitietdaotao" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Sửa chương trình đào tạo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Mã CTDT</label>
                        <input type="text" class="form-control" id="smct">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tên CTDT</label>
                        <input type="text" class="form-control" id="stct">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Ngành đào tạo</label>
                <select class="form-control" id="sndtct">
                    <option value="">--- Chọn ngành đào tạo ---</option>
                <?php $nganh = lay_nganh_dao_tao();
                while ($row = oci_fetch_assoc($nganh)) {
                     echo "<option value='".$row['IDNDT']."'>".$row['MANDT']," - ".$row['TENNDT']."</option>";
                 } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Đơn vị quản lý</label>
                <select class="form-control" id="skct">
                    <option value="">--- Chọn khoa ---</option>
                <?php $khoa = lay_khoa_chuyen_mon();
                while ($row = oci_fetch_assoc($khoa)) {
                     echo "<option value='".$row['IDKHOA']."'>".$row['MAKHOA']." - ".$row['TENKHOA']."</option>";
                 } ?>
                </select>
            </div> 
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Số học phần</label>
                        <input type="number" min="0" class="form-control" id="sshpct">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Số tín chỉ</label>
                        <input type="number" min="0" class="form-control" id="sstcct">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Ghi chú</label>
                <input type="text" class="form-control" id="sgcct">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="btsuachitietdaotao">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Xóa -->
<div class="modal fade" id="xoachitietdaotao" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Xóa chương trình đào tạo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    <strong>Bạn có chắc xóa chương trình đào tạo này?</strong><hr>
                    <b>Mã CTDT:</b> <span id="xmct"></span><br>
                    <b>Tên CTDT:</b> <span id="xtct"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-danger" id="btxoachitietdaotao">Xóa</button>
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
            $('#chitietdaotao').addClass('active');
            var id=0;
            $('#banglhp').DataTable({
                "scrollX": true
            });
            $('#btthemchitietdaotao').on('click',function(){
            	if(!$('#mct').val().trim()){
            		alert('Nhập mã chương trình đào tạo');return;
            	}
            	if(!$('#tct').val().trim()){
            		alert('Nhập tên chương trình đào tạo');return;
            	}
                if(!$('#ndtct').val().trim()){
                    alert('Chọn ngành đào tạo');return;
                }
                if(!$('#kct').val().trim()){
                    alert('Chọn đơn vị quản lý');return;
                }
	            $.ajax({
	                url: 'ajax_them_chi_tiet_dao_tao.php',
	                type: 'POST',
	                data: {
	                    mct: $('#mct').val().trim(),
	                    tct: $('#tct').val().trim(),
                        ndtct: $('#ndtct').val().trim(),
                        kct: $('#kct').val().trim(),
                        shpct: ($.isNumeric($('#shpct').val().trim()))?$('#shpct').val().trim():0,
                        stcct: ($.isNumeric($('#stcct').val().trim()))?$('#stcct').val().trim():0,
                        gcct: $('#gcct').val().trim()
                    },
	                success: function (data) {
	                    var mang = $.parseJSON(data);
	                    if(mang.trangthai==1){
	                        thanhcong('Đã lưu chương trình đào tạo');
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
                $('#smct').val($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
                $('#stct').val($(this).parent('td').parent('tr').find('td:nth-child(3)').text().trim());
                $('#sndtct').val($(this).parent('td').parent('tr').find('td:nth-child(4)').attr('lydata'));
                $('#skct').val($(this).parent('td').parent('tr').find('td:nth-child(5)').attr('lydata'));
                $('#sshpct').val($(this).parent('td').parent('tr').find('td:nth-child(6)').text().trim());
                $('#sstcct').val($(this).parent('td').parent('tr').find('td:nth-child(7)').text().trim());
                $('#sgcct').val($(this).parent('td').parent('tr').find('td:nth-child(8)').text().trim());
                id = $(this).attr('lydata');
                $('#suachitietdaotao').modal('show');
            });
            $('#btsuachitietdaotao').on('click',function(){
                if(!$('#smct').val().trim()){
                    alert('Nhập mã chương trình đào tạo');return;
                }
                if(!$('#stct').val().trim()){
                    alert('Nhập tên chương trình đào tạo');return;
                }
                if(!$('#sndtct').val().trim()){
                    alert('Chọn ngành đào tạo');return;
                }
                if(!$('#skct').val().trim()){
                    alert('Chọn đơn vị quản lý');return;
                }
                $.ajax({
                    url: 'ajax_sua_chi_tiet_dao_tao.php',
                    type: 'POST',
                    data: {
                        mct: $('#smct').val().trim(),
                        tct: $('#stct').val().trim(),
                        ndtct: $('#sndtct').val().trim(),
                        kct: $('#skct').val().trim(),
                        shpct: ($.isNumeric($('#sshpct').val().trim()))?$('#sshpct').val().trim():0,
                        stcct: ($.isNumeric($('#sstcct').val().trim()))?$('#sstcct').val().trim():0,
                        gcct: $('#sgcct').val().trim(),
                        id: id
                    },
                    success: function (data) {
                        var mang = $.parseJSON(data);
                        if(mang.trangthai==1){
                            thanhcong('Đã sửa chương trình đào tạo');
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
                $('#xmct').text($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
                $('#xtct').text($(this).parent('td').parent('tr').find('td:nth-child(3)').text().trim());
                id = $(this).attr('lydata');
                $('#xoachitietdaotao').modal('show');
            });
            $('#btxoachitietdaotao').on('click',function(){
                $.ajax({
                    url: 'ajax_xoa_chi_tiet_dao_tao.php',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        var mang = $.parseJSON(data);
                        if(mang.trangthai==1){
                            thanhcong('Đã xóa chương trình đào tạo');
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