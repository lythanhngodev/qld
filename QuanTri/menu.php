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
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Quản lý người dùng
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="quanly.php"></a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Phân quyền</a>
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
                <a class="nav-link" href="thongtintaikhoan.php">Xin chào: <?php echo $hoten; ?></a>
            </li>
        </ul>
    </div>
</nav>