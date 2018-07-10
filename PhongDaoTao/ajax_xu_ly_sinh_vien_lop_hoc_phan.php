<?php require_once "check_login.php"; ?>
<?php require_once "_l_function.php"; ?>
<?php if (!isset($_POST['id']) || empty($_POST['id']) || intval($_POST['id']) == 0) {
    echo "Không có dữ liệu";
}
$conn = $ketnoi->ketnoi();
$id = $_POST['id'];
$id = intval($id);
$sql = "SELECT lhp.MALHP, gv.HOTENGV, mh.TENMH, hk.TENHK, hk.NAMHOC FROM LOPHOCPHAN lhp, GV gv, MONHOC mh, HOCKY hk WHERE lhp.IDGV = gv.IDGV AND lhp.IDMH = mh.IDMH AND lhp.IDHK = hk.IDHK AND lhp.IDLHP =:id";
$p_sqlk = oci_parse($conn, $sql);
oci_bind_by_name($p_sqlk, ":id", $id);
oci_execute($p_sqlk);
$thongtin = oci_fetch_assoc($p_sqlk);
oci_free_statement($p_sqlk);
 ?>
<table class="table">
    <tr>
        <th>Mã lớp học phần:</th>
        <td><?php echo $thongtin['MALHP'] ?></td>
        <th>Môn học:</th>
        <td><?php echo $thongtin['TENMH'] ?></td>
    </tr>
    <tr>
        <th>Giáo viên giảng dạy:</th>
        <td><?php echo $thongtin['HOTENGV'] ?></td>
        <th>Học kỳ:</th>
        <td><?php echo $thongtin['TENHK']." , ".$thongtin['NAMHOC'] ?></td>
    </tr>
</table>
<table id="bangsv" class="table table-bordered table-hover table-striped" style="width: 100%;">
    <thead>
        <tr style="text-align: center;">
            <th>STT</th>
            <th>Mã SV</th>
            <th>Họ tên</th>
            <th>Mã lớp</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php $sv = lay_sinh_vien_lop_hoc_phan($id); $stt = 1;
        while ($row = oci_fetch_assoc($sv)){ ?>
            <tr style="text-align: center;">
                <th><?php echo $stt; ?></th>
                <td><?php echo $row['MASV'] ?></td>
                <td style="text-align: left;"><?php echo $row['HOTENSV'] ?></td>
                <td><?php echo $row['MALOP'] ?></td>
                <td><button class="btn btn-danger btn-sm xoa" lylhp="<?php echo $id ?>" lydata="<?php echo $row['IDSV'] ?>">Xóa</button></td>
            </tr>
        <?php $stt++; } ?>
    </tbody>
</table>

<script type="text/javascript">
    $('#bangsv').DataTable({
        "scrollX": true
    });
</script>