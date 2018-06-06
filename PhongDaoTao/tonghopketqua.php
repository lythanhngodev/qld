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
    .footer {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 65px;
        line-height: 30px;
        background-color: #f5f5f5;
        right: 0;
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
                <h5>Tổng hợp kết quả học tập</h5>
                <hr>
            </div>  
        </div>
        <div class="row">
            <form action="tonghopkqht.php" method="POST" id="frTonghopkqht" target="_blank" >
                <div class="col-md-6" style="float: left;margin: 0;">
                    <label>Chọn trình độ đào tạo</label>
                    <select class="form-control" id="trinhdo" name="trinhdo">
                        <option value="">---- Chọn trình độ đào tạo ---</option>
                    <?php $ndt = lay_trinh_do();
                    while ($row = oci_fetch_assoc($ndt)) {
                         echo "<option value='".$row['TRINHDODT']."'>".$row['TRINHDODT']."</option>";
                     } ?>
                    </select>
                </div>
                <div class="col-md-6" style="float: left;margin: 0;">
                    <label>Chọn học kỳ - năm học</label>
                    <select class="form-control" id="hockyq" name="hocky">
                        <option value="">---- Chọn học kỳ - năm học ---</option>
                    <?php $hk = lay_hoc_ky();
                    while ($row = oci_fetch_assoc($hk)) {
                         echo "<option value='".$row['IDHK']."'>".$row['TENHK']." - ".$row['NAMHOC']."</option>";
                     } ?>
                    </select>
                </div>
            </form>
            <div class="col-md-4">
                <label>.</label>
                <br>
                <button class="btn btn-primary" id="xuatfile">Xuất file Excel</button>
            </div>
        </div>
    </div>
    <?php include_once "footer.php"; ?>
<link rel="stylesheet" type="text/css" href="../css/datatables.min.css">
<script src="../js/datatables.min.js" type="text/javascript"></script>
<script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('body .dropdown-toggle').dropdown();
            $('#diem').addClass('active');
            $('#tonghopketqua').addClass('active');
            $('#xuatfile').click(function(){
                if(!$('#trinhdo').val() || !$('#hockyq').val()){
                    khongthanhcong('Chưa chọn trình độ hoặc học kỳ');
                    return;
                };
                $('#frTonghopkqht').submit();
            });
        } );
    </script>
    <script src="../js/bootstrap-notify.min.js"></script>
</body>
</html>