<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Caçapava Pokémons</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <div class="container">
      <img src="./imagens/logo.png" alt="Logo Pokémon" class="logo">
      <h1>Caçapava Pokémons</h1>
    </div>
  </header>

  <div class="main-content container">
    <nav class="actions">
      <a href="screens/add_pokemon.php" class="btn btn-primary">Cadastrar</a>
      <a href="screens/list_pokemons.php" class="btn">Listar</a>
      <a href="screens/search_pokemon.php" class="btn">Pesquisar</a>
      <a href="screens/report.php" class="btn">Relatório</a>
    </nav>
  </div>

  <footer>
    <div class="container">
      <p>Sistema de Registro de Pokémons Perdidos &copy; <?= date('Y') ?></p>
    </div>
  </footer>
</body>
</html>
