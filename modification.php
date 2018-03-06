<?php
session_start();

$idmodif = $_GET['identifiant'];

$titre = "nouveau titre";
$categorie = "nouvelle categorie";
$contenu = "nouveau blablabla";

try
{
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=blogsuperlab;charset=utf8', 'root', 'user', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  //return $bdd;
}
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}

$req = $bdd->prepare('UPDATE articles SET titre = :titre, catégorie = :categorie, contenu = :contenu, date_article = NOW()
  WHERE id = :identif');

// ajouter input pour les modifs
$req->execute(array(
  'titre' => $titre,
  'categorie' => $categorie,
  'contenu' => $contenu,
  'identif' => $idmodif
));

header('Location: dashboard.php');
