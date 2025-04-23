<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];

    $sql = "INSERT INTO contatos (nome, telefone, email) VALUES (:nome, :telefone, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':telefone' => $telefone,
        ':email' => $email
    ]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Adicionar Contato</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2>Adicionar Contato</h2>

    <form method="POST">
      <div class="mb-3">
        <label>Nome:</label>
        <input type="text" class="form-control" name="nome" required>
      </div>
      <div class="mb-3">
        <label>Telefone:</label>
        <input type="text" class="form-control" name="telefone" required>
      </div>
      <div class="mb-3">
        <label>Email:</label>
        <input type="email" class="form-control" name="email" required>
      </div>
      <button type="submit" class="btn btn-success">Salvar</button>
      <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
  </div>
</body>
</html>