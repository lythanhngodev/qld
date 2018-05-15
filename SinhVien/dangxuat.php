<?php 
	require_once "../_l_config.php";
	session_start();
	session_destroy();
	header("Location: ".$qld['HOST']);
 ?>