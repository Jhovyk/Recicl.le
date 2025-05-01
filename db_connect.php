<?php
$host = 'sql201.infinityfree.com'; // Host do seu banco de dados MySQL
$dbname = 'if0_37480423_ecoflix'; // Nome do banco de dados
$username = 'if0_37480423'; // Nome de usuário MySQL correto
$password = '92519966aA'; // Senha do banco de dados MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>
