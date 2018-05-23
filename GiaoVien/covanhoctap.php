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
                <h5>Cố vấn học tập</h5>
                <hr>
            </div>  
        </div>
        <table class="table table-hover table-bordered" style="width: 100%;">
            <thead>
                <tr style="text-align: center;">
                    <th>STT</th>
                    <th>Mã lớp</th>
                    <th>Tên lớp</th>
                    <th>Sỉ số</th>
                    <th>Xem chi tiết lớp</th>
                </tr>
            </thead>
            <tbody>
                <?php $cv = lay_lop_gv($idgv);$stt=1;
                while ($row = oci_fetch_assoc($cv)) {?>
                <tr>
                    <td style="text-align: center;"><?php echo $stt; ?></td>
                    <td style="text-align: center;"><?php echo $row['MALOP'] ?></td>
                    <td><?php echo $row['TENLOP'] ?></td>
                    <td style="text-align: center;"><?php echo lay_si_so_lop($row['IDLOP']); ?></td>
                    <td style="text-align: center;"><a href="chitietlop.php" class="btn btn-primary">Xem chi tiết lớp >></a></td>
                </tr>
                 <?php $stt++; } ?>
            </tbody>
        </table>
    </div>

<link rel="stylesheet" type="text/css" href="../css/datatables.min.css">
<script src="../js/datatables.min.js" type="text/javascript"></script>
<script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        <?php $lop = null;
        $_lop = lay_lop_hoc_phan_gv($idgv);
        while ($row = oci_fetch_row($_lop)) {
           $lop[] = $row;
        }
        ?>
        var _lop_ = <?php echo json_encode($lop); ?>;
        $(document).ready(function() {
            $('body .dropdown-toggle').dropdown();
            $('#covanhoctap').addClass('active');
            $('#chonlophp').on('change',function(){
                $('#than').empty();
                if(!$(this).val()) return;
                $.ajax({
                    url: 'ajax_xu_ly_sinh_vien_nhap_diem.php',
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