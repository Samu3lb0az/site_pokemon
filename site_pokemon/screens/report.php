<?php
require_once '../db_connect.php';
$stmt = $pdo->query("SELECT tipo, COUNT(*) AS total FROM pokemons GROUP BY tipo");
$data = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Relatório</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <header>
    <div class="container">
      <img src="../imagens/logo.png" alt="Logo Pokémon" class="logo">
      <h1>Relatório por Tipo</h1>
    </div>
  </header>

  <div class="container">
    <a href="../index.php" class="back"><span class="arrow">&larr;</span>Voltar</a>

    <table>
      <thead><tr><th>Tipo</th><th>Quantidade</th></tr></thead>
      <tbody>
        <?php foreach ($data as $d): ?>
        <tr>
          <td><?= htmlspecialchars($d['tipo']) ?></td>
          <td><?= $d['total'] ?></td>
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
