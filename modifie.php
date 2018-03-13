<?php
session_start();

$idmodif = $_GET['id'];

require 'database.php';


// if (empty($_POST['modificationtitre']) && empty($_POST['modificationcategorie']) && empty($_POST['modificationcontenu'])) {
// echo "Veuillez remplir les champs s'il vous plait";
// }else{


  $titremodif = htmlspecialchars($_POST['modificationtitre']);
  // $categoriemodif = htmlspecialchars($_POST['modificationcategorie']);
  $contenumodif = htmlspecialchars($_POST['modificationcontenu']);

  $modifications = $bdd->prepare('UPDATE articles SET titre = :titre, contenu = :contenu, date_article = NOW()
    WHERE id_article = :identif');

  // ajouter input pour les modifs
  $modifications->execute(array(
    'titre' => $titremodif,
    'contenu' => $contenumodif,
    'identif' => $idmodif
  ));
  // echo "modif" . $titremodif . $categoriemodif . $contenumodif .$idmodif ;
// }

$modifications->closeCursor();

header('Location: blogadmin.php');
