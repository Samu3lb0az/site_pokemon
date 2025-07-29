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
      <img src="imagens/logo.png" alt="Logo Pokémon" class="logo">
      <h1>Caçapava Pokémons</h1>
    </div>
  </header>

  <div class="main-content container">
    <nav class="actions">
      <div class="nav-item">
        <a href="screens/add_pokemon.php" class="btn btn-primary">Cadastrar</a>
        <p class="description">Aqui você pode cadastrar um Pokémon encontrado.</p>
      </div>
      <div class="nav-item">
        <a href="screens/list_pokemons.php" class="btn">Listar</a>
        <p class="description">Veja todos os Pokémons já registrados.</p>
      </div>
      <div class="nav-item">
        <a href="screens/search_pokemon.php" class="btn">Pesquisar</a>
        <p class="description">Busque Pokémons por parte do nome.</p>
      </div>
      <div class="nav-item">
        <a href="screens/report.php" class="btn">Relatório</a>
        <p class="description">Confira estatísticas de Pokémons por tipo.</p>
      </div>
    </nav>
  </div>

  <footer>
    <div class="container">
      <p>Sistema de Registro de Pokémons Perdidos &copy; <?= date('Y') ?></p>
    </div>
  </footer>
</body>
</html>
