CREATE DATABASE IF NOT EXISTS cacapava_pokemons
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE cacapava_pokemons;

CREATE TABLE IF NOT EXISTS pokemons (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  tipo VARCHAR(50) NOT NULL,
  localizacao VARCHAR(100) NOT NULL,
  data_registro DATE NOT NULL,
  hp INT NOT NULL,
  ataque INT NOT NULL,
  defesa INT NOT NULL,
  observacoes TEXT,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
