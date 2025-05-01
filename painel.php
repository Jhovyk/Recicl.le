<?php
session_start();
require 'db_connect.php'; // Conecta ao banco de dados

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    $imagePath = '';

    // Verifica se uma imagem foi enviada
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['imagem']['tmp_name'];
        $imageName = $_FILES['imagem']['name'];
        $imageSize = $_FILES['imagem']['size'];
        $imageType = $_FILES['imagem']['type'];
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);

        // Define o diretório de upload
        $uploadDir = 'uploads/';
        // Gera um nome único para a imagem
        $newImageName = md5(time() . $imageName) . '.' . $imageExtension;

        // Move a imagem para o diretório de upload
        if (move_uploaded_file($imageTmpPath, $uploadDir . $newImageName)) {
            $imagePath = $uploadDir . $newImageName;
        }
    }

    // Insere a postagem no banco de dados, incluindo o caminho da imagem
    $stmt = $pdo->prepare("INSERT INTO postagens (titulo, conteudo, imagem) VALUES (:titulo, :conteudo, :imagem)");
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':conteudo', $conteudo);
    $stmt->bindParam(':imagem', $imagePath);
    $stmt->execute();

    echo "<p>Postagem adicionada com sucesso!</p>";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Painel Admin | Recic.le</title>

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos do site -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Responsivo -->
    <link href="assets/css/responsive.css" rel="stylesheet">
</head>
<body>
    <!-- Painel Admin -->
    <div class="container py-5">
        <h2 class="text-center mb-5">Painel de Administração</h2>

        <!-- Botão de Logoff -->
        <div class="text-end mb-3">
            <a href="logout.php" class="btn btn-danger">Logoff</a>
        </div>

        <!-- Formulário para adicionar postagens -->
        <div class="admin-box p-4" style="max-width: 800px; margin: 0 auto; background-color: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
            <h3>Adicionar nova postagem</h3>
            <form action="painel.php" method="post" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <label for="titulo">Título:</label>
                    <input type="text" class="form-control" name="titulo" required>
                </div>
                <div class="form-group mb-3">
                    <label for="conteudo">Conteúdo:</label>
                    <textarea name="conteudo" class="form-control" rows="5" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="imagem">Imagem:</label>
                    <input type="file" class="form-control" name="imagem">
                </div>
                <button type="submit" class="btn btn-success w-100">Adicionar Postagem</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
