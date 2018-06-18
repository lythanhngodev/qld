<img src="../images/header.png" style="width: 100%">
<!-- MENU -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item" id="trangchu">
                <a class="nav-link" href="#">Trang chủ</a>
            </li>
            <li class="nav-item" id="bangdiem">
                <a class="nav-link" href="xembangdiem.php">Bảng điểm cá nhân</a>
            </li>
            <li class="nav-item active" style="float: right;position:  absolute;right: 0;">
                <a class="nav-link" href="thongtintaikhoan.php">Xin chào: <?php echo $hotensv; ?></a>
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
        </ul>
    </div>
</nav>