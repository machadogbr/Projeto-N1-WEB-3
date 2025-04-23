<?php
$host = 'localhost';
$porta = '5432';
$bdnome = 'agenda';
$user = 'postgres';
$senha = 'postgres';

try {
    $pdo = new PDO("pgsql:host=$host;port=$porta;dbname=$bdnome", $user, $senha, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
