<?php sleep(1) ?>
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
function diem($idlhp, $idsv){
    $ketnoi = new _l_clsKetnoi();
    $conn = $ketnoi->ketnoi();
    $sql = "SELECT DIEMCC, DIEMGK, DIEMCK, DIEMTHILAI, CAMTHI FROM PHIEUDIEMHP WHERE IDLHP=:idlhp AND IDSV=:idsv";
    $p_sql = oci_parse($conn, $sql);
    oci_bind_by_name($p_sql, ":idlhp", $idlhp);
    oci_bind_by_name($p_sql, ":idsv", $idsv);
    oci_execute($p_sql);
    oci_close($conn);
    return $p_sql;
}
 ?>
<form action="xuatphieudiem.php" method="POST" target="_blank">
    <input type="text" name="lophocphan" hidden="hidden" value="<?php echo $id; ?>">
    <input type="submit" name="" value="Xuất phiếu điểm" class="btn btn-warning" style="float: right;margin-bottom: 1rem;" >
</form>
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
        <td><?php echo $thongtin['TENHK']." - ".$thongtin['NAMHOC'] ?></td>
    </tr>
</table>
<table id="bangsv" class="table table-bordered table-hover table-striped" style="width: 100%;">
    <thead>
        <tr style="text-align: center;">
            <th>STT</th>
            <th>Mã SV</th>
            <th>Họ tên</th>
            <th>Mã lớp</th>
            <th style="width: 80px;">Điểm CC (10.0%)</th>
            <th style="width: 80px;">Điểm GK (40.0%)</th>
            <th style="width: 80px;">Điểm CK (50.0%)</th>
            <th style="width: 80px;">Điểm thi lại</th>
            <th style="width: 80px;">Tổng điểm</th>
            <th style="width: 80px;">Cấm thi</th>
        </tr>
    </thead>
    <tbody>
        <?php $sv = lay_sinh_vien_lop_hoc_phan($id); $stt = 1;
        while ($row = oci_fetch_assoc($sv)){ ?>
            <tr style="text-align: center;" idlhp="<?php echo $id; ?>" id="<?php echo $row['IDSV'] ?>">
                <th><?php echo $stt; ?></th>
                <td><?php echo $row['MASV'] ?></td>
                <td style="text-align: left;"><?php echo $row['HOTENSV'] ?></td>
                <td><?php echo $row['MALOP'] ?></td>
                <?php $diemhp = diem($id, $row['IDSV']);$ktd=0;
                while ($d = oci_fetch_assoc($diemhp)) {?>
                    <td><input type="number" min="0" max="10" onmouseout="tinhdiemcc(this)" class="form-control" style="text-align: center;" value="<?php if($d['DIEMCC']!=0)echo $d['DIEMCC']; ?>"></td>
                    <td><input type="number" min="0" max="10" onmouseout="tinhdiemgk(this)" class="form-control" style="text-align: center;" value="<?php if($d['DIEMGK']!=0)echo $d['DIEMGK']; ?>"></td>
                    <td><input type="number" min="0" max="10" onmouseout="tinhdiemck(this)" class="form-control" style="text-align: center;" value="<?php if($d['DIEMCK']!=0)echo $d['DIEMCK']; ?>"></td>
                    <td><input type="number" min="0" max="10" onmouseout="tinhdiemtl(this)" class="form-control" style="text-align: center;" value="<?php if($d['DIEMCK']!=0)echo $d['DIEMTHILAI']; ?>"></td>
                    <td><input type="number" min="0" max="10" readonly class="form-control" style="text-align: center;"></td>
                    <td style="text-align: center;"><input type="checkbox" onclick="camthi(this)" <?php if($d['CAMTHI']==1) echo "checked"; ?>></td>
                <?php $ktd++;} 
                if ($ktd==0) {?>
                    <td><input type="number" min="0" max="10" onmouseout="tinhdiemcc(this)" class="form-control" style="text-align: center;"></td>
                    <td><input type="number" min="0" max="10" onmouseout="tinhdiemgk(this)" class="form-control" style="text-align: center;"></td>
                    <td><input type="number" min="0" max="10" onmouseout="tinhdiemck(this)" class="form-control" style="text-align: center;"></td>
                    <td><input type="number" min="0" max="10" onmouseout="tinhdiemtl(this)" class="form-control" style="text-align: center;"></td>
                    <td><input type="number" min="0" max="10" readonly class="form-control" style="text-align: center;"></td>
                    <td style="text-align: center;"><input type="checkbox" onclick="camthi(this)"></td>
                <?php } ?>
            </tr>
        <?php $stt++; } ?>
    </tbody>
</table>
<script type="text/javascript">
    $('#bangsv').DataTable({
        "scrollX": true,
        'iDisplayLength': 100
    });
</script>