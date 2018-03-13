<?php

require 'database.php';

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
