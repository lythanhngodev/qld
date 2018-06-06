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
				<h5>Lớp chuyên ngành</h5>
				<hr>
			</div>	
		</div>
		<div class="row">
			<div class="col-12">
				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#themlop">Thêm lớp</button>
				<br><br>
                <table id="banglhp" class="table table-bordered table-hover table-striped">
                    <thead>
                    	<tr style="text-align: center;">
                            <th>STT</th>
                            <th>Mã lớp</th>
                            <th>Tên lớp</th>
                            <th>Chương trình đào tạo</th>
                            <th>Đơn vị quản lý</th>
                            <th>Cố vấn học tập</th>
                            <th>Năm tuyển sinh</th>
                            <th>Khóa học</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php $lop = lay_lop(); $stt = 1;
                    	while ($row = oci_fetch_assoc($lop)){ ?>
                            <tr style="text-align: center;">
                                <th><?php echo $stt; ?></th>
                                <td><?php echo $row['MALOP'] ?></td>
                                <td><?php echo $row['TENLOP'] ?></td>
                                <td lydata="<?php echo $row['IDCTDT']; ?>"><?php echo $row['TENCTDT'] ?></td>
                                <td lydata="<?php echo $row['IDKHOA']; ?>"><?php echo $row['TENKHOA'] ?></td>
                                <td lydata="<?php echo $row['IDGV']; ?>"><?php echo $row['HOTENGV'] ?></td>
                                <td><?php echo $row['NAMTS'] ?></td>
                                <td><?php echo $row['KHOAHOC'] ?></td>
                                <td><button class="btn btn-primary btn-sm sua" lydata="<?php echo $row['IDLOP'] ?>">Sửa</button>&ensp;<button class="btn btn-danger btn-sm xoa" lydata="<?php echo $row['IDLOP'] ?>">Xóa</button></td>
                            </tr>
                        <?php $stt++; } ?>
                    </tbody>
                    </table>
			</div>
		</div>
	</div>
<?php include_once "footer.php"; ?>
<!-- Thêm -->
<div class="modal fade" id="themlop" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Thêm lớp</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Mã lớp</label>
                        <input type="text" class="form-control" id="ml">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tên lớp</label>
                        <input type="text" class="form-control" id="tl">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Chương trình đào tạo</label>
                <select class="form-control" id="dtl">
                    <option value="">--- Chọn chương trình đào tạo ---</option>
                <?php $nganh = lay_chi_tiet_dao_tao();
                while ($row = oci_fetch_assoc($nganh)) {
                     echo "<option value='".$row['IDCTDT']."'>".$row['MACTDT']," - ".$row['TENCTDT']."</option>";
                 } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Đơn vị quản lý</label>
                <select class="form-control chonkhoa" id="kl">
                    <option value="">--- Chọn khoa ---</option>
                <?php $khoa = lay_khoa_chuyen_mon();
                while ($row = oci_fetch_assoc($khoa)) {
                     echo "<option value='".$row['IDKHOA']."'>".$row['MAKHOA']." - ".$row['TENKHOA']."</option>";
                 } ?>
                </select>
            </div> 
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Cố vấn học tập</label>
                <select class="form-control choncovan" id="cvhtl">
                    <option value="">--- Chọn giáo viên cố vấn ---</option>
                <?php $gv = lay_giao_vien();
                while ($row = oci_fetch_assoc($gv)) {
                     echo "<option value='".$row['IDGV']."'>".$row['MAGV']." - ".$row['HOTENGV']."</option>";
                 } ?>
                </select>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Năm tuyển sinh</label>
                        <input type="number" min="0" class="form-control" id="ntsl">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Khóa học</label>
                        <input type="number" min="0" class="form-control" id="khl">
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="btthemlop">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Sửa -->
<div class="modal fade" id="sualop" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Sửa lớp</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Mã lớp</label>
                        <input type="text" class="form-control" id="sml">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tên lớp</label>
                        <input type="text" class="form-control" id="stl">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Chương trình đào tạo</label>
                <select class="form-control" id="sdtl">
                    <option value="">--- Chọn chương trình đào tạo ---</option>
                <?php $nganh = lay_chi_tiet_dao_tao();
                while ($row = oci_fetch_assoc($nganh)) {
                     echo "<option value='".$row['IDCTDT']."'>".$row['MACTDT']," - ".$row['TENCTDT']."</option>";
                 } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Đơn vị quản lý</label>
                <select class="form-control chonkhoa" id="skl">
                    <option value="">--- Chọn khoa ---</option>
                <?php $khoa = lay_khoa_chuyen_mon();
                while ($row = oci_fetch_assoc($khoa)) {
                     echo "<option value='".$row['IDKHOA']."'>".$row['MAKHOA']." - ".$row['TENKHOA']."</option>";
                 } ?>
                </select>
            </div> 
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Cố vấn học tập</label>
                <select class="form-control choncovan" id="scvhtl">
                    <option value="">--- Chọn giáo viên cố vấn ---</option>
                <?php $gv = lay_giao_vien();
                while ($row = oci_fetch_assoc($gv)) {
                     echo "<option value='".$row['IDGV']."'>".$row['MAGV']." - ".$row['HOTENGV']."</option>";
                 } ?>
                </select>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Năm tuyển sinh</label>
                        <input type="number" min="0" class="form-control" id="sntsl">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Khóa học</label>
                        <input type="number" min="0" class="form-control" id="skhl">
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="btsualop">Lưu</button>
      </div>
    </div>
  </div>
</div>

<!-- Xóa -->
<div class="modal fade" id="xoalop" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Xóa lớp</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    <strong>Bạn có chắc xóa lớp này?</strong><hr>
                    <b>Mã lớp:</b> <span id="xml"></span><br>
                    <b>Tên lớp:</b> <span id="xtl"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-danger" id="btxoalop">Xóa</button>
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
            $('#lop').addClass('active');
            var id=0;
            $('#banglhp').DataTable({
                "scrollX": true
            });
            $('#btthemlop').on('click',function(){
            	if(!$('#ml').val().trim()){
            		alert('Nhập mã lớp');return;
            	}
            	if(!$('#tl').val().trim()){
            		alert('Nhập tên lớp');return;
            	}
                if(!$('#dtl').val().trim()){
                    alert('Chọn chương trình đào tạo');return;
                }
                if(!$('#kl').val().trim()){
                    alert('Chọn khoa');return;
                }
                if(!$('#cvhtl').val().trim()){
                    alert('Chọn cố vấn học tập');return;
                }
                if(!$('#ntsl').val().trim()){
                    alert('Nhập năm tuyển sinh');return;
                }
                if(!$('#khl').val().trim()){
                    alert('Nhập khóa học');return;
                }
	            $.ajax({
	                url: 'ajax_them_lop.php',
	                type: 'POST',
	                data: {
	                    ml: $('#ml').val().trim(),
	                    tl: $('#tl').val().trim(),
                        dtl: $('#dtl').val().trim(),
                        kl: $('#kl').val().trim(),
                        cvhtl: $('#cvhtl').val().trim(),
                        ntsl: ($.isNumeric($('#ntsl').val().trim()))?$('#ntsl').val().trim():0,
                        khl: ($.isNumeric($('#khl').val().trim()))?$('#khl').val().trim():0
                    },
	                success: function (data) {
	                    var mang = $.parseJSON(data);
	                    if(mang.trangthai==1){
	                        thanhcong('Đã lưu lớp');
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
                $('#sml').val($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
                $('#stl').val($(this).parent('td').parent('tr').find('td:nth-child(3)').text().trim());
                $('#sdtl').val($(this).parent('td').parent('tr').find('td:nth-child(4)').attr('lydata'));
                $('#skl').val($(this).parent('td').parent('tr').find('td:nth-child(5)').attr('lydata'));
                $('#scvhtl').val($(this).parent('td').parent('tr').find('td:nth-child(6)').attr('lydata'));
                $('#sntsl').val($(this).parent('td').parent('tr').find('td:nth-child(7)').text().trim());
                $('#skhl').val($(this).parent('td').parent('tr').find('td:nth-child(8)').text().trim());
                id = $(this).attr('lydata');
                $('#sualop').modal('show');
            });
            $('#btsualop').on('click',function(){
                if(!$('#sml').val().trim()){
                    alert('Nhập mã lớp');return;
                }
                if(!$('#stl').val().trim()){
                    alert('Nhập tên lớp');return;
                }
                if(!$('#sdtl').val().trim()){
                    alert('Chọn chương trình đào tạo');return;
                }
                if(!$('#skl').val().trim()){
                    alert('Chọn khoa');return;
                }
                if(!$('#scvhtl').val().trim()){
                    alert('Chọn cố vấn học tập');return;
                }
                if(!$('#sntsl').val().trim()){
                    alert('Nhập năm tuyển sinh');return;
                }
                if(!$('#skhl').val().trim()){
                    alert('Nhập khóa học');return;
                }
                $.ajax({
                    url: 'ajax_sua_lop.php',
                    type: 'POST',
                    data: {
                        ml: $('#sml').val().trim(),
                        tl: $('#stl').val().trim(),
                        dtl: $('#sdtl').val().trim(),
                        kl: $('#skl').val().trim(),
                        cvhtl: $('#scvhtl').val().trim(),
                        ntsl: ($.isNumeric($('#sntsl').val().trim()))?$('#sntsl').val().trim():0,
                        khl: ($.isNumeric($('#skhl').val().trim()))?$('#skhl').val().trim():0,
                        id: id
                    },
                    success: function (data) {
                        var mang = $.parseJSON(data);
                        if(mang.trangthai==1){
                            thanhcong('Đã sửa lớp');
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
                $('#xml').text($(this).parent('td').parent('tr').find('td:nth-child(2)').text().trim());
                $('#xtl').text($(this).parent('td').parent('tr').find('td:nth-child(3)').text().trim());
                id = $(this).attr('lydata');
                $('#xoalop').modal('show');
            });
            $('#btxoalop').on('click',function(){
                $.ajax({
                    url: 'ajax_xoa_lop.php',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        var mang = $.parseJSON(data);
                        if(mang.trangthai==1){
                            thanhcong('Đã xóa lớp');
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