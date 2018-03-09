<?php
session_start();

$iddelete = $_GET['identifiant'];

try
{
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=blogsuperlab;charset=utf8', 'root', 'user', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  //return $bdd;
}
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}

$supprimeligne = $bdd -> prepare("DELETE FROM articles WHERE id_article=?");
$supprimeligne -> execute(array($iddelete));

$supprimeligne->closeCursor();

header('Location: blogadmin.php');
