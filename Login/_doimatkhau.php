<?php 
	include_once "../_l_config.php";
	include_once ("mail/guimail.php");
 ?>

<?php 
	function rand_string($length) {
		$str='';
	    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$size = strlen( $chars );
		for( $i = 0; $i < $length; $i++ ) {
			$str.= $chars[ rand( 0, $size - 1 ) ];
		 }
		return $str;
	}
	$ketnoi = new _l_clsKetnoi();
	$conn  = $ketnoi->ketnoi();
    $kq = $ketnoi->checkmail($_POST['dcmail']);
    switch ($kq) {
    	case 'khong':
    		echo "<script type='text/javascript'>alert('Mail không tồn tại');</script>";
    		break;
    	case 'sinhvien':
    		// gửi mail quên mật khẩu cho sinh viên
    		$matkhau = rand_string(8);
    		if ($ketnoi->capnhatmatkhau($_POST['dcmail'], $kq ,md5($matkhau))) {
    			if(guimail('Quên mật khẩu',"Mật khẩu mới của bạn: $matkhau", $_POST['dcmail'])){
                    echo " <script type='text/javascript'>alert('Mail đã được gửi');</script>";
                }
    		}
    		break;
    	case 'giaovien':
    		// gửi mail quên mật khẩu cho sinh viên
    		$matkhau = rand_string(8);
    		if ($ketnoi->capnhatmatkhau($_POST['dcmail'], $kq ,md5($matkhau))) {
    			if(guimail('Quên mật khẩu',"Mật khẩu mới của bạn: $matkhau", $_POST['dcmail'])){
                    echo " <script type='text/javascript'>alert('Mail đã được gửi');</script>";
                }
    		}
    		break;
    	case 'phongdaotao':
    		// gửi mail quên mật khẩu cho sinh viên
    		$matkhau = rand_string(8);
    		if ($ketnoi->capnhatmatkhau($_POST['dcmail'], $kq ,md5($matkhau))) {
    			if(guimail('Quên mật khẩu',"Mật khẩu mới của bạn: $matkhau", $_POST['dcmail'])){
                    echo " <script type='text/javascript'>alert('Mail đã được gửi');</script>";
                }
    		}
    		break;
    	case 'quantri':
    		// gửi mail quên mật khẩu cho sinh viên
    		$matkhau = rand_string(8);
    		if ($ketnoi->capnhatmatkhau($_POST['dcmail'], $kq ,md5($matkhau))) {
    			if(guimail('Quên mật khẩu',"Mật khẩu mới của bạn: $matkhau", $_POST['dcmail'])){
                    echo " <script type='text/javascript'>alert('Mail đã được gửi');</script>";
                }
    		}
    		break;
    }
    oci_close($conn);
    exit();
 ?>