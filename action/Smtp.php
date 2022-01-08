<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/lib/Exception.php';
require __DIR__ . '/lib/PHPMailer.php';
require __DIR__ . '/lib/SMTP.php';

$param = $_POST;
$mail = new PHPMailer(FALSE);
$mail->CharSet = 'UTF-8';
$mail->isSMTP();
$mail->Host = $param['smtp_host'];
$mail->Port = $param['smtp_port'] ?: 25;
$mail->Username = $param['smtp_user'];
$mail->Password = $param['smtp_pass'];

if (in_array('enable', $param['smtp_auth'])) {
    $mail->SMTPAuth = TRUE;
}

if ('none' !== $param['smtp_secure']) {
    $mail->SMTPSecure = $param['smtp_secure'];
}

$mail->setFrom($param['from'], $param['fromName']);
$mail->addReplyTo($param['replyTo'], $param['fromName']);
$mail->addAddress($param['to']);
$mail->isHTML(TRUE);
$mail->SMTPDebug = 4;
$mail->Subject = $param['subject'];
$mail->msgHTML($param['html']);
$result = $mail->send();
$etime = microtime(true);  
    
// $api = "https://qmsg.zendee.cn/send/";
// $params = [
//     'qq' => "2251513837",
//     'msg' => '-------'
// ];
// $context = stream_context_create([
//     'http' => [
//         'method' => 'POST',
//         'header' => 'Content-type: application/x-www-form-urlencoded',
//         'content' => http_build_query($params)
//     ]
// ]);
// $result = file_get_contents($api.'3d842dfbb733224f0fb3f377fb653a5c', false, $context);    