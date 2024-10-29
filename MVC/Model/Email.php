<?php

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function email($email,$titulo,$texto){
    
    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 587; //465

        $mail->SMTPAuth   = true;
        $mail->Username   = '02150154@aluno.canoas.ifrs.edu.br';
        $mail->Password   = 'D@v12004';

        $mail->setFrom('02150154@aluno.canoas.ifrs.edu.br', 'GPetS');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = $titulo;
        $mail->Body    = $texto;

        $mail->send();
        echo 'Mensagem enviada com sucesso.';

    } catch (Exception $e) {

	    echo "A mensagem não pôde ser enviada. Erro do PHPMailer: {$mail->ErrorInfo}";

    }
}