<?php
require_once '../db_connect.php';
$id = intval($_GET['id'] ?? 0);
if (!$id) exit('ID inválido.');

$stmt = $pdo->prepare("SELECT * FROM pokemons WHERE id = :id");
$stmt->execute([':id'=>$id]);
$p = $stmt->fetch();
if (!$p) exit('Pokémon não encontrado.');

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

    if ($nome==='')        $erros[]='Nome obrigatório.';
    if ($tipo==='')        $erros[]='Tipo obrigatório.';
    if ($localizacao==='') $erros[]='Local obrigatório.';
    if (!$data_registro)   $erros[]='Data obrigatória.';
    if ($hp<1)             $erros[]='HP ≥ 1.';
    if ($ataque<0)         $erros[]='Atk ≥ 0.';
    if ($defesa<0)         $erros[]='Def ≥ 0.';

    $fotoData = null;
    if (!empty($_FILES['foto']['tmp_name'])) {
        if ($_FILES['foto']['size'] > 2*1024*1024) {
            $erros[] = 'Foto até 2 MB.';
        } else {
            $fotoData = file_get_contents($_FILES['foto']['tmp_name']);
        }
    }

    if (empty($erros)) {
        $sql = "UPDATE pokemons SET
            nome=:nome, tipo=:tipo, localizacao=:local,
            data_registro=:data, hp=:hp, ataque=:atk,
            defesa=:def, observacoes=:obs"
          . ($fotoData!==null ? ", foto=:foto" : "")
          . " WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $params = [
          ':nome'=>$nome,':tipo'=>$tipo,':local'=>$localizacao,
          ':data'=>$data_registro,':hp'=>$hp,':atk'=>$ataque,
          ':def'=>$defesa,':obs'=>$observacoes,':id'=>$id
        ];
        if ($fotoData!==null) $params[':foto']=$fotoData;
        $stmt->execute($params);
        header('Location: list_pokemons.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Pokémon</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <header>
    <div class="container">
      <img src="../imagens/logo.png" alt="Logo Pokémon" class="logo">
      <h1>Editar <?= htmlspecialchars($p['nome']) ?></h1>
    </div>
  </header>

  <div class="container">
    <?php if ($erros): ?>
      <div class="erro">
        <ul>
          <?php foreach ($erros as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
          <?php endforeach ?>
        </ul>
      </div>
    <?php endif ?>

    <form method="post" enctype="multipart/form-data" class="pokemon-form">
      <div class="form-group">
        <label for="nome">Nome*</label>
        <input type="text" id="nome" name="nome" required
               value="<?= htmlspecialchars($_POST['nome'] ?? $p['nome']) ?>">
      </div>
      <div class="form-actions">
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="list_pokemons.php" class="btn">Cancelar</a>
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
