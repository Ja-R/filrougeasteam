<?php
session_start();

$idmodif = $_GET['id'];

try
{
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=blogsuperlab;charset=utf8', 'root', 'user', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  //return $bdd;
}
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}


// if (empty($_POST['modificationtitre']) && empty($_POST['modificationcategorie']) && empty($_POST['modificationcontenu'])) {
// echo "Veuillez remplir les champs s'il vous plait";
// }else{


  $titremodif = htmlspecialchars($_POST['modificationtitre']);
  $categoriemodif = htmlspecialchars($_POST['modificationcategorie']);
  $contenumodif = htmlspecialchars($_POST['modificationcontenu']);

  $modifications = $bdd->prepare('UPDATE articles SET titre = :titre, catégorie = :categorie, contenu = :contenu, date_article = NOW()
    WHERE id_article = :identif');

  // ajouter input pour les modifs
  $modifications->execute(array(
    'titre' => $titremodif,
    'categorie' => $categoriemodif,
    'contenu' => $contenumodif,
    'identif' => $idmodif
  ));
  // echo "modif" . $titremodif . $categoriemodif . $contenumodif .$idmodif ;
// }

$modifications->closeCursor();

header('Location: blogadmin.php');
