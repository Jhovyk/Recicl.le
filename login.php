<?php
session_start();
require 'db_connect.php'; // Conecta ao banco de dados

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: painel.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifica se o usuário existe no banco de dados
    $stmt = $pdo->prepare("SELECT id, username, password FROM usuarios WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && md5($password) === $user['password']) {
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $user['id'];
        header("Location: painel.php");
        exit;
    } else {
        $error = "Usuário ou senha incorretos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Login | Recic.le</title>

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos do site -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Responsivo -->
    <link href="assets/css/responsive.css" rel="stylesheet">
</head>
<body>
    <!-- Área de Login -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="login-box p-5" style="max-width: 500px; background-color: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
            <h2 class="text-center mb-4">Login</h2>
            <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <form action="login.php" method="post">
                <div class="form-group mb-3">
                    <label for="username">Usuário:</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Senha:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
