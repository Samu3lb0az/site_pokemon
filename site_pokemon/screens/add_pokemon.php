<?php
require_once '../db_connect.php';

$nome = $tipo = $localizacao = $data_registro = '';
$hp = $ataque = $defesa = 0;
$observacoes = '';
$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome         = trim($_POST['nome']);
    $tipo         = $_POST['tipo'];
    $localizacao  = trim($_POST['localizacao']);
    $data_registro= $_POST['data_registro'];
    $hp           = intval($_POST['hp']);
    $ataque       = intval($_POST['ataque']);
    $defesa       = intval($_POST['defesa']);
    $observacoes  = trim($_POST['observacoes']);

    if ($nome === '')         $erros[] = 'Nome é obrigatório.';
    if ($tipo === '')         $erros[] = 'Tipo é obrigatório.';
    if ($localizacao === '')  $erros[] = 'Localização é obrigatória.';
    if (!$data_registro)      $erros[] = 'Data é obrigatória.';
    if ($hp < 1)              $erros[] = 'HP deve ser ≥ 1.';
    if ($ataque < 0)          $erros[] = 'Ataque ≥ 0.';
    if ($defesa < 0)          $erros[] = 'Defesa ≥ 0.';

    if (empty($erros)) {
        $sql = "INSERT INTO pokemons 
          (nome,tipo,localizacao,data_registro,hp,ataque,defesa,observacoes)
         VALUES 
          (:nome,:tipo,:local,:data,:hp,:atk,:def,:obs)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome'  => $nome,
            ':tipo'  => $tipo,
            ':local' => $localizacao,
            ':data'  => $data_registro,
            ':hp'    => $hp,
            ':atk'   => $ataque,
            ':def'   => $defesa,
            ':obs'   => $observacoes
        ]);
        header('Location: list_pokemons.php?sucesso=1');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastrar Pokémon</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <header>
    <div class="container">
      <img src="../imagens/logo.png" alt="Logo Pokémon" class="logo">
      <h1>Cadastrar Pokémon Perdido</h1>
    </div>
  </header>

  <div class="container">
    <a href="../index.php" class="back"><span class="arrow">&larr;</span>Voltar</a>

    <?php if ($erros): ?>
      <div class="erro">
        <ul>
          <?php foreach ($erros as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
          <?php endforeach ?>
        </ul>
      </div>
    <?php endif ?>

    <form method="post" class="pokemon-form">
      <div class="form-group">
        <label for="nome">Nome*</label>
        <input type="text" id="nome" name="nome" required value="<?= htmlspecialchars($nome) ?>">
      </div>
      <div class="form-group">
        <label for="tipo">Tipo*</label>
        <select id="tipo" name="tipo" required>
          <option value="">Selecione</option>
          <?php 
            $tipos = ['Normal','Fogo','Água','Planta','Elétrico','Gelo','Lutador','Venenoso','Terra','Voador','Psíquico','Inseto','Pedra','Fantasma','Dragão','Sombrio','Aço','Fada'];
            foreach ($tipos as $t): ?>
            <option value="<?= $t ?>" <?= $tipo === $t ? 'selected' : '' ?>>
              <?= $t ?>
            </option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <label for="localizacao">Localização*</label>
        <input type="text" id="localizacao" name="localizacao" required value="<?= htmlspecialchars($localizacao) ?>">
      </div>
      <div class="form-group">
        <label for="data_registro">Data*</label>
        <input type="date" id="data_registro" name="data_registro" required value="<?= $data_registro ?>">
      </div>
      <div class="stats-group">
        <div class="form-group">
          <label for="hp">HP*</label>
          <input type="number" id="hp" name="hp" min="1" required value="<?= $hp ?: 10 ?>">
        </div>
        <div class="form-group">
          <label for="ataque">Ataque*</label>
          <input type="number" id="ataque" name="ataque" min="0" required value="<?= $ataque ?: 10 ?>">
        </div>
        <div class="form-group">
          <label for="defesa">Defesa*</label>
          <input type="number" id="defesa" name="defesa" min="0" required value="<?= $defesa ?: 10 ?>">
        </div>
      </div>
      <div class="form-group">
        <label for="observacoes">Observações</label>
        <textarea id="observacoes" name="observacoes" rows="4"><?= htmlspecialchars($observacoes) ?></textarea>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </div>
    </form>
  </div>

  <footer>
    <div class="container">
      <p>&copy; <?= date('Y') ?> Sistema de Registro de Pokémons Perdidos</p>
    </div>
  </footer>
</body>
</html>
