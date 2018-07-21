<?php
include('class.smtp.php');
include "class.phpmailer.php"; 
function guimail($tieude,$than,$dc){
    $mail = new PHPMailer();
    $mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) );
    $mail->CharSet = "UTF-8";
    $mail->isSMTP();                         // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';          // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                  // Enable SMTP authentication
    $mail->Username = 'vlutelibktv@gmail.com';                 // SMTP username
    $mail->Password = 'vlutelibktv@2017';                 // SMTP password
    $mail->SMTPSecure = 'tls';               // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                       // TCP port to connect to
    $mail->setFrom('vlutelibktv@gmail.com', 'Phần mềm QUẢN LÝ KẾT QUẢ HỌC TẬP TRƯỜNG ĐHSPKTVL');
    $mail->addAddress($dc);     // Add a recipient
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $tieude;
    $mail->Body    = $than;
    $mail->AltBody = 'Thư điện tử Gmail';
    if(!$mail->Send())
        return false;
    else
        return true;
}