<?php
session_start();

$idcat = $_GET['idcat'];

try
{
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=blogsuperlab;charset=utf8', 'root', 'user', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  //return $bdd;
}
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}

$supprimecat = $bdd -> prepare('DELETE FROM categories WHERE id_categorie=?');
$supprimecat -> execute(array($idcat));

$supprimecat->closeCursor();

echo 'categorie supprime' . $idcat;
// header('Location: addcat.php');
