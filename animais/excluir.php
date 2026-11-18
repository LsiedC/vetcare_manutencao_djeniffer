<?php
require_once __DIR__.'/../config/database.php';require_once __DIR__.'/../config/auth.php';exigirLogin();
$id=(int)($_GET['id']??0);
try{
// Chamado 05 - Exclusao errada
// $s=$pdo->prepare("DELETE FROM animais");
$s=$pdo->prepare("DELETE FROM animais WHERE id=?");
$s->execute([$id]);
}catch(PDOException $e){}

header('Location: index.php');exit;
