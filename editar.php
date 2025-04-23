<?php
include 'conexao.php';

$contato = null;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['salvar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    $sql = "UPDATE contatos SET nome = :nome, telefone = :telefone, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':telefone' => $telefone,
        ':email' => $email,
        ':id' => $id
    ]);

    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['excluir'])) {
    $id = $_POST['id'];

    $stmt = $pdo->prepare("DELETE FROM contatos WHERE id = :id");
    $stmt->execute([':id' => $id]);

    header("Location: index.php");
    exit;
}

$sql = "SELECT * FROM contatos ORDER BY nome";
$contatos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['selecionado'])) {
    $id = $_POST['selecionado'];

    $stmt = $pdo->prepare("SELECT * FROM contatos WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $contato = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Contato</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2>Editar/Excluir Contato</h2>

  <?php if (!$contato): ?>
    <form method="POST" class="mb-4">
      <select name="selecionado" class="form-select mb-3" required>
        <option selected disabled>Selecione um contato</option>
        <?php foreach ($contatos as $c): ?>
          <option value="<?= $c['id'] ?>"><?= $c['nome'] ?> - <?= $c['telefone'] ?></option>
        <?php endforeach; ?>
      </select>
      <button type="submit" class="btn btn-primary">Editar</button>
      <a href="index.php" class="btn btn-secondary">Voltar</a>
    </form>
  <?php else: ?>
    <form method="POST">
      <input type="hidden" name="id" value="<?= $contato['id'] ?>">
      <div class="mb-3">
        <label>Nome:</label>
        <input type="text" class="form-control" name="nome" value="<?= $contato['nome'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Telefone:</label>
        <input type="text" class="form-control" name="telefone" value="<?= $contato['telefone'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Email:</label>
        <input type="email" class="form-control" name="email" value="<?= $contato['email'] ?>" required>
      </div>
      <button type="submit" name="salvar" class="btn btn-primary">Salvar Alterações</button>
      <button type="submit" name="excluir" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
      <a href="editar.php" class="btn btn-secondary">Voltar</a>
    </form>
  <?php endif; ?>
</div>
</body>
</html>
