<img src="../images/header.png" style="width: 100%">
<!-- MENU -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#"><img src="../images/logo.png" width="40"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item" id="trangchu">
                <a class="nav-link" href="#">Trang chủ</a>
            </li>
            <li class="nav-item dropdown" id="taikhoan">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Điểm
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a id="nhapdiemlophocphan" class="dropdown-item" href="nhapdiemlophocphan.php">Nhập điểm lớp học phần</a>
                    <a class="dropdown-item" href="#">Phếu điểm học phần</a>
                    <a class="dropdown-item" href="#">Kết quả</a>
                </div>
            </li>
            <li id="giaovien" class="nav-item">
                <a class="nav-link" href="giaovien.php">Giáo viên</a>
            </li>
            <li id="sinhvien" class="nav-item">
                <a class="nav-link" href="sinhvien.php">Sinh viên</a>
            </li>
            <li id="sinhvienlophocphan" class="nav-item">
                <a class="nav-link" href="sinhvienlophocphan.php">Sinh viên - Lớp học phần</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Môn học</a>
            </li>
            <li class="nav-item dropdown" id="daotao">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Đào tạo
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a id="chitietdaotao" class="dropdown-item" href="chitietdaotao.php">Chi tiết đào tạo</a>
                    <a id="nganhdaotao" class="dropdown-item" href="nganhdaotao.php">Ngành đào tạo</a>
                    <a id="khoa" class="dropdown-item" href="khoachuyenmon.php">Khoa</a>
                    <a id="lop" class="dropdown-item" href="lop.php">Lớp</a>
                    <a id="lophocphan" class="dropdown-item" href="lophocphan.php">Lớp học phần</a>
                    <a id="hocky" class="dropdown-item" href="hocky.php">Học kỳ</a>
                    <a id="monhoc" class="dropdown-item" href="monhoc.php">Môn học</a>
                </div>
            </li>
            <li class="nav-item dropdown" id="taikhoan">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tài khoản
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="thongtintaikhoan.php">Thông tin tài khoản</a>
                    <a class="dropdown-item" href="doimatkhau.php">Đổi mật khẩu</a>
                    <a class="dropdown-item" href="dangxuat.php">Đăng xuất</a>
                </div>
            </li>
            <li class="nav-item active" style="float: right;position:  absolute;right: 0;">
                <a class="nav-link" href="thongtintaikhoan.php">Xin chào: <?php echo $hotencb; ?></a>
            </li>
        </ul>
    </div>
</nav>