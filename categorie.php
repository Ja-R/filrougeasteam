<?php

try
{
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=blogsuperlab;charset=utf8', 'root', 'user', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  //return $bdd;
}
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}

if(!isset($_POST['ajout_cat'])) {
  echo "Veuillez selectionner une catégorie s'il vous plait";
} else {
    $ajout_cat = $_POST['ajout_cat'];
    // echo " cate ajouter " . $ajout_cat;
}

$req = $bdd->prepare('INSERT INTO categories(name_categorie) VALUES (:catSub)');
$req->execute(array(
  'catSub' => $ajout_cat
));

header('location: addcat.php');
