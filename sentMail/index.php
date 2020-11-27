<?php
require("PHPMailer/class.phpmailer.php");

enviarCorreo("gerardo@canseko.com");

function enviarCorreo($email){
    $mail = new PHPMailer();
    // $mail->IsSMTP();
    $mail->IsHTML();
    $mail->CharSet = "UTF-8";
    $mail->Host = "tequilajarana.tld";
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->Username = 'apikey';
    $mail->Password = "ony3S00%";
    $mail->AddAddress($email);
    $mail->From = "contacto@tequilajarana.com";
    $mail->FromName = "Tequila Jarana";
    $mail->Subject = "Nuevo Usuario";
    $mail->Body = '
    test';
    if(!$mail->send()){
        echo $mail->ErrorInfo;
    }
}