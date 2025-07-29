<?php
require_once '../db_connect.php';
$stmt = $pdo->query("SELECT * FROM pokemons ORDER BY data_registro DESC");
$all = $stmt->fetchAll();
$sucesso = isset($_GET['sucesso']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Listar Pokémons</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <header>
    <div class="container">
      <img src="../imagens/logo.png" alt="Logo Pokémon" class="logo">
      <h1>Lista de Pokémons</h1>
    </div>
  </header>

  <div class="container">
    <a href="../index.php" class="back"><span class="arrow">&larr;</span>Voltar</a>

    <?php if ($sucesso): ?>
      <div class="sucesso">Pokémon cadastrado com sucesso!</div>
    <?php endif ?>

    <table>
      <thead>
        <tr>
          <th>ID</th><th>Nome</th><th>Tipo</th><th>Local</th><th>Data</th><th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($all as $p): ?>
        <tr>
          <td><?= $p['id'] ?></td>
          <td><?= htmlspecialchars($p['nome']) ?></td>
          <td><?= htmlspecialchars($p['tipo']) ?></td>
          <td><?= htmlspecialchars($p['localizacao']) ?></td>
          <td><?= $p['data_registro'] ?></td>
          <td class="actions">
            <a href="edit_pokemon.php?id=<?= $p['id'] ?>" class="btn btn-sm">Editar</a>
            <a href="delete_pokemon.php?id=<?= $p['id'] ?>" class="btn btn-danger btn-sm"
               onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
          </td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>

  <footer>
    <div class="container">
      <p>&copy; <?= date('Y') ?> Sistema de Registro de Pokémons Perdidos</p>
    </div>
  </footer>
</body>
</html>
