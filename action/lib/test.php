<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(FALSE);
	$mail->CharSet = "UTF-8";
	$mail->IsSMTP(); // 使用SMTP方式发送  
	$mail->SMTPAuth = true; // 启用SMTP验证功能  
	$mail->SMTPSecure = "ssl"; 
	$mail->Port=465;
	$mail->Host = "smtp.qq.com"; // 您的企业邮局域名  
	$mail->Username = "2251513837@qq.com"; // SMTP服务器用户名和密码 
	$mail->Password = "nbfwjsmatmqhebgf"; // SMTP服务器用户名和密码   
	$mail->SetFrom("2251513837@qq.com", "张同阳"); // 设置发件人地址和名称，名称可有可无  
	$mail->FromName = "GT.girl";
	$address = "yang2210670@163.com";//收件地址
	$mail->AddAddress($address);
	$mail->Subject = "测试消息通知"; // 设置邮件主题 
	$mail->Body = "您好！系统中有条信息未审核。"; //邮件内容  
	$result = $mail->send();