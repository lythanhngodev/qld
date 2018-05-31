<?php require_once "check_login.php"; ?>
<?php require_once "_l_function.php";?>
<?php 
    $idgv = 0;
    $idlop = 0;
    $idgv = $_SESSION['_idgv'];
    $idlop = $_GET['id'];
 ?>
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
                <h6 style="color:red;">DANH SÁCH SINH VIÊN LỚP <?php echo lay_ma_lop($idlop) ?></h6>
                <hr>
            </div>  
        </div>
        <table id="bangsv" class="table table-hover table-bordered" style="width: 100%;">
            <thead>
                <tr style="text-align: center;">
                    <th>STT</th>
                    <th>MSSV</th>
                    <th>Họ&amp;Tên</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Email</th>
                    <th>Khóa học</th>
                    <th>Xem điểm chi tiết</th>
                </tr>
            </thead>
            <tbody>
                <?php $cv = lay_sv_cua_lop_gv($idgv, $idlop);$stt=1;
                while ($row = oci_fetch_assoc($cv)) {?>
                <tr>
                    <td style="text-align: center;"><?php echo $stt; ?></td>
                    <td style="text-align: center;"><?php echo $row['MASV'] ?></td>
                    <td><?php echo $row['HOTENSV'] ?></td>
                    <td style="text-align: center;"><?php if($row['GIOITINHSV']!='null') echo $row['GIOITINHSV']; else echo "-"; ?></td>
                    <td style="text-align: center;"><?php if(empty($row['NGAYSINHSV'])) echo date('d/m/Y',strtotime($row['NGAYSINHSV'])); else echo "-"; ?></td>
                    <td><?php if($row['EMAILSV']!='null') echo $row['EMAILSV']; else echo "-"; ?></td>
                    <td style="text-align: center;"><?php echo $row['KHOAHOC']; ?></td>
                    <td style="text-align: center;"><a href="xembangdiem.php?id=<?php echo $row['IDSV'] ?>" class="btn btn-primary btn-sm">Xem bảng điểm >></a></td>
                </tr>
                 <?php $stt++; } ?>
            </tbody>
        </table>
    </div>

<link rel="stylesheet" type="text/css" href="../css/datatables.min.css">
<script src="../js/datatables.min.js" type="text/javascript"></script>
<script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('body .dropdown-toggle').dropdown();
            $('#covanhoctap').addClass('active');
            $('#bangsv').DataTable({
                "scrollY":        "350px",
                "scrollCollapse": true,
                "paging":         false
            });
        } );
    </script>
    <script src="../js/bootstrap-notify.min.js"></script>
</body>
</html>