<?php
require_once '../db_connect.php';
$q = trim($_GET['q'] ?? '');
$results = [];
if ($q !== '') {
    $stmt = $pdo->prepare("SELECT * FROM pokemons WHERE nome LIKE :q");
    $stmt->execute([':q'=>"%{$q}%"]);
    $results = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Pesquisar Pokémon</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <header>
    <div class="container">
      <img src="../imagens/logo.png" alt="Logo Pokémon" class="logo">
      <h1>Pesquisar Pokémon</h1>
    </div>
  </header>

  <div class="container">
    <a href="../index.php" class="back"><span class="arrow">&larr;</span>Voltar</a>

    <form class="search-form">
      <div class="form-group">
        <label for="q">Nome</label>
        <input type="text" id="q" name="q" placeholder="Digite parte do nome" value="<?= htmlspecialchars($q) ?>">
        <button type="submit" class="btn">Buscar</button>
      </div>
    </form>

    <?php if ($q !== ''): ?>
      <?php if ($results): ?>
        <table>
          <thead><tr><th>ID</th><th>Nome</th><th>Tipo</th><th>Ações</th></tr></thead>
          <tbody>
            <?php foreach ($results as $r): ?>
            <tr>
              <td><?= $r['id'] ?></td>
              <td><?= htmlspecialchars($r['nome']) ?></td>
              <td><?= htmlspecialchars($r['tipo']) ?></td>
              <td class="actions">
                <a href="edit_pokemon.php?id=<?= $r['id'] ?>" class="btn btn-sm">Editar</a>
                <a href="delete_pokemon.php?id=<?= $r['id'] ?>" class="btn btn-danger btn-sm"
                   onclick="return confirm('Excluir?')">Excluir</a>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      <?php else: ?>
        <div class="erro">Nenhum resultado para “<?= htmlspecialchars($q) ?>”.</div>
      <?php endif ?>
    <?php endif ?>
  </div>

  <footer>
    <div class="container">
      <p>&copy; <?= date('Y') ?> Sistema de Registro de Pokémons Perdidos</p>
    </div>
  </footer>
</body>
</html>
