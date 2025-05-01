<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Configurações do servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'mail.recicle.org.br'; // Servidor SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'smtp@recicle.org.br'; // E-mail autenticado
    $mail->Password = 'recicleadmin'; // Senha SMTP
    $mail->SMTPSecure = 'ssl'; // Usando criptografia SSL
    $mail->Port = 465; // Porta para SSL
	

	$mail->CharSet = 'UTF-8';


    // Definir remetente e destinatário
    $mail->setFrom('smtp@recicle.org.br', 'MENSAGEM RECIC.LE'); // E-mail autenticado
    $mail->addAddress('reciclecg@gmail.com'); // Destinatário

    // Dados do formulário
    $nome = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $telefone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $assunto = isset($_POST['subject']) ? $_POST['subject'] : '';
    $mensagem = isset($_POST['message']) ? $_POST['message'] : '';

    // Montando o corpo da mensagem
    $mail->isHTML(false); // Enviar como texto puro
    $mail->Subject = 'Nova mensagem de contato: ' . $assunto;
    $mail->Body = "
        Nome: $nome\n
        E-mail: $email\n
        Telefone: $telefone\n
        Assunto: $assunto\n
        Mensagem: $mensagem\n
    ";

    // Enviar o e-mail
    $mail->send();
    echo 'Mensagem enviada com sucesso!';
} catch (Exception $e) {
    echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
}
?>
