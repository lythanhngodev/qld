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
				<h5>Chi tiết đào tạo</h5>
				<hr>
			</div>	
		</div>
		<div class="row">
			<div class="col-12">
				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#themchitietdaotao">Thêm chi tiết đào tạo</button>
				<br><br>
                <table id="banglhp" class="table table-bordered table-hover table-striped">
                    <thead>
                    	<tr style="text-align: center;">
                            <th>STT</th>
                            <th>Mã CTDT</th>
                            <th>Tên CTDT</th>
                            <th>Chuyên ngành</th>
                            <th>Thuộc khoa</th>
                            <th>Số học phần</th>
                            <th>Số tín chỉ</th>
                            <th>Ghi chú</th>
                            <th>Thao tác</th>
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

<!-- Thêm -->
<div class="modal fade" id="themchitietdaotao" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Thêm chi tiết đào tạo</h5>
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
                <label for="recipient-name" class="col-form-label">Thuộc khoa</label>
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
        <button type="button" class="btn btn-primary" id="btthemlophocphan">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Sửa -->
<div class="modal fade" id="sualophocphan" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Sửa lớp học phần</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Mã lớp học phần</label>
                <input type="text" class="form-control" id="smlhp">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Môn học</label>
                <select class="form-control" id="smhlhp">
                    <option value="">--- Chọn lớp học phần ---</option>
                <?php $mh = lay_mon_hoc();
                while ($row = oci_fetch_assoc($mh)) {
                     echo "<option value='".$row['IDMH']."'>".$row['MAMH']." - ".$row['TENMH']."</option>";
                 } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Học kỳ - Năm học</label>
                <select class="form-control" id="shklhp">
                    <option value="">--- Chọn học kỳ năm học ---</option>
                <?php $hk = lay_hoc_ky();
                while ($row = oci_fetch_assoc($hk)) {
                     echo "<option value='".$row['IDHK']."'>".$row['TENHK']," - ".$row['NAMHOC']."</option>";
                 } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Giáo viên giảng dạy</label>
                <select class="form-control" id="sgvlhp">
                    <option value="">--- Chọn giáo viên giảng dạy ---</option>
                <?php $gv = lay_giao_vien();
                while ($row = oci_fetch_assoc($gv)) {
                     echo "<option value='".$row['IDGV']."'>".$row['MAGV']." - ".$row['HOTENGV']."</option>";
                 } ?>
                </select>
            </div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="btsualophocphan">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Xóa -->
<div class="modal fade" id="xoalophocphan" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Xóa lớp học phần</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    <strong>Bạn có chắc xóa lớp học phần này?</strong><hr>
                    <b>Mã lớp học phần:</b> <span id="xmlhp"></span><br>
                    <b>Tên môn học:</b> <span id="xmhlhp"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-danger" id="btxoakhoa">Xóa</button>
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
            $('#lophocphan').addClass('active');
            var id=0;
            $('#banglhp').DataTable();
            $('#btthemlophocphan').on('click',function(){
            	if(!$('#mlhp').val().trim()){
            		alert('Nhập mã lớp học phần');return;
            	}
            	if(!$('#hklhp').val().trim()){
            		alert('Chọn học kỳ năm học');return;
            	}
                if(!$('#gvlhp').val().trim()){
                    alert('Chọn giáo viên giảng dạy');return;
                }
                if(!$('#mhlhp').val().trim()){
                    alert('Chọn môn học');return;
                }
	            $.ajax({
	                url: 'ajax_them_lop_hoc_phan.php',
	                type: 'POST',
	                data: {
	                    mlhp: $('#mlhp').val().trim(),
	                    hklhp: $('#hklhp').val().trim(),
                        gvlhp: $('#gvlhp').val().trim(),
                        mhlhp: $('#mhlhp').val().trim()
                    },
	                success: function (data) {
	                    var mang = $.parseJSON(data);
	                    if(mang.trangthai==1){
	                        thanhcong('Đã lưu lớp học phần');
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
                $('#smlhp').val($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
                $('#smhlhp').val($(this).parent('td').parent('tr').find('td:nth-child(3)').attr('lydata'));
                $('#shklhp').val($(this).parent('td').parent('tr').find('td:nth-child(4)').attr('lydata'));
                $('#sgvlhp').val($(this).parent('td').parent('tr').find('td:nth-child(5)').attr('lydata'));
                id = $(this).attr('lydata');
                $('#sualophocphan').modal('show');
            });
            $('#btsualophocphan').on('click',function(){
                if(!$('#smlhp').val().trim()){
                    alert('Nhập mã lớp học phần');return;
                }
                if(!$('#shklhp').val().trim()){
                    alert('Chọn học kỳ năm học');return;
                }
                if(!$('#sgvlhp').val().trim()){
                    alert('Chọn giáo viên giảng dạy');return;
                }
                if(!$('#smhlhp').val().trim()){
                    alert('Chọn môn học');return;
                }
                $.ajax({
                    url: 'ajax_sua_lop_hoc_phan.php',
                    type: 'POST',
                    data: {
                        mlhp: $('#smlhp').val().trim(),
                        hklhp: $('#shklhp').val().trim(),
                        gvlhp: $('#sgvlhp').val().trim(),
                        mhlhp: $('#smhlhp').val().trim(),
                        id: id
                    },
                    success: function (data) {
                        var mang = $.parseJSON(data);
                        if(mang.trangthai==1){
                            thanhcong('Đã sửa lớp học phần');
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
                $('#xmlhp').text($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
                $('#xmhlhp').text($(this).parent('td').parent('tr').find('td:nth-child(3)').text().trim());
                id = $(this).attr('lydata');
                $('#xoalophocphan').modal('show');
            });
            $('#btxoakhoa').on('click',function(){
                $.ajax({
                    url: 'ajax_xoa_lop_hoc_phan.php',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        var mang = $.parseJSON(data);
                        if(mang.trangthai==1){
                            thanhcong('Đã xóa lớp học phần');
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