<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
        // Verificar se o reCAPTCHA foi preenchido
    if (!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
        die('Erro: reCAPTCHA não preenchido.');
    }

    $recaptcha_secret = '6LfhfeMqAAAAAMf7V-2yBs4L1wbWAChTeO4DHt4V';
    $recaptcha_response = $_POST['g-recaptcha-response'];

    // Verificar a resposta do reCAPTCHA com a API do Google
    $verify_url = 'https://www.google.com/recaptcha/api/siteverify';
    $response = file_get_contents($verify_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $response_keys = json_decode($response, true);

    if (!$response_keys['success']) {
        die('Erro: Falha na validação do reCAPTCHA.');
    }


    // Forçar o uso do diretório temporário padrão
    ini_set('upload_tmp_dir', '/tmp');

    // Configurações do servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'mail.recicle.org.br';
    $mail->SMTPAuth = true;
    $mail->Username = 'smtp@recicle.org.br'; // Substitua pelo e-mail autenticado
    $mail->Password = 'recicleadmin'; // Substitua pela senha correta
    $mail->SMTPSecure = 'ssl'; // Usando criptografia SSL
    $mail->Port = 465; // Porta para SSL

    // Definir formatação UTF-8
    $mail->CharSet = 'UTF-8';

    // Definir remetente e destinatário
    $mail->setFrom('smtp@recicle.org.br', 'Coleta Recic.le'); // Remetente autenticado
    $mail->addAddress('reciclecg@gmail.com'); // Destinatário

    // Dados do formulário (corrigido para capturar corretamente do $_POST)
    $person_type = isset($_POST['person_type']) ? $_POST['person_type'] : 'Não informado';
    $nome_completo = isset($_POST['nome_completo']) ? $_POST['nome_completo'] : 'Não informado';
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : 'Não informado';
    $nome_empresa = isset($_POST['nome_empresa']) ? $_POST['nome_empresa'] : 'Não informado';
    $cnpj = isset($_POST['cnpj']) ? $_POST['cnpj'] : 'Não informado';
    $telefone = isset($_POST['tel']) ? $_POST['tel'] : 'Não informado';
    $email = isset($_POST['email']) ? $_POST['email'] : 'Não informado';
    $cep = isset($_POST['cep']) ? $_POST['cep'] : 'Não informado';
    $rua = isset($_POST['rua']) ? $_POST['rua'] : 'Não informado';
    $numero = isset($_POST['numero']) ? $_POST['numero'] : 'Não informado';
    $bairro = isset($_POST['bairro']) ? $_POST['bairro'] : 'Não informado';
    $cidade = isset($_POST['cidade']) ? $_POST['cidade'] : 'Não informado';
    $estado = isset($_POST['estado']) ? $_POST['estado'] : 'Não informado';

    // Verificar e salvar os arquivos no servidor
    $upload_dir = '/home/recicleorg/public_html/uploads/';
    $image_links = [];


    if (isset($_FILES['material_photos'])) {
        if ($_FILES['material_photos']['error'] == UPLOAD_ERR_OK) {
            $file_name = basename($_FILES['material_photos']['name']);
            $file_path = $upload_dir . $file_name;
            if (move_uploaded_file($_FILES['material_photos']['tmp_name'], $file_path)) {
                $image_links[] = 'https://recicle.org.br/uploads/' . $file_name;
            } else {
                echo "Erro ao salvar as fotos dos materiais no servidor.<br>";
            }
        } else {
            echo "Erro no upload das fotos dos materiais. Erro: " . $_FILES['material_photos']['error'] . "<br>";
        }
    } else {
        echo "Fotos dos materiais não recebidas.<br>";
    }

    // Links das imagens
    $image_links_str = implode('<br>', $image_links);

    // Conteúdo do e-mail
    $mail->isHTML(true); 
    $mail->Subject = 'Solicitação de Coleta - Recic.le';
    $mail->Body = "
        <p>Tipo de Pessoa: $person_type</p>
        <p>Nome Completo: $nome_completo</p>
        <p>CPF: $cpf</p>
        <p>Nome da Empresa: $nome_empresa</p>
        <p>CNPJ: $cnpj</p>
        <p>Telefone: $telefone</p>
        <p>Email: $email</p>
        <p>CEP: $cep</p>
        <p>Rua: $rua, Número: $numero, Bairro: $bairro</p>
        <p>Cidade: $cidade - $estado</p>
        <p>Links dos Arquivos: <br>$image_links_str</p>
    ";

    // Enviar o e-mail
    if ($mail->send()) {
        echo 'Solicitação enviada com sucesso!<br>';
    } else {
        echo "Erro ao enviar e-mail: {$mail->ErrorInfo}<br>";
    }
} catch (Exception $e) {
    echo "Erro ao enviar e-mail: {$mail->ErrorInfo}<br>";
}
?>
