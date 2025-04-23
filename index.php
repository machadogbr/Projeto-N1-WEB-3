<?php
include 'conexao.php';

$sql = "SELECT * FROM contatos ORDER BY nome";
$contatos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Lista de Contatos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2 class="mb-4">Lista de Contatos</h2>

    <?php
if (empty($contatos)) {
    echo "<div class='alert alert-info'>Nenhum contato cadastrado.</div>";
} else {
    echo "<ul class='list-group mb-4'>";
    foreach ($contatos as $contato) {
        echo "<li class='list-group-item'>{$contato['nome']} | {$contato['telefone']} | {$contato['email']}</li>";
    }
    echo "</ul>";
}
?>


    <div class="d-flex gap-2">
      <a href="adicionar.php" class="btn btn-success">Adicionar Contato</a>
      <a href="editar.php" class="btn btn-primary">Editar Contato</a>
    </div>
  </div>

</body>
</html>