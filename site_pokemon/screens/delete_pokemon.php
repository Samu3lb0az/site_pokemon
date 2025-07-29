<?php
require_once '../db_connect.php';
$id = intval($_GET['id'] ?? 0);
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM pokemons WHERE id = :id");
    $stmt->execute([':id'=>$id]);
}
header('Location: list_pokemons.php');
exit;
