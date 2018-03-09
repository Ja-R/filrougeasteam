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

$req = $bdd->prepare('SELECT id_article, titre, catégorie, contenu,
  DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_art_fr
   FROM articles
   WHERE id_article= ?');
  $req->execute(array($idmodif));


if (!$_POST['cat']) {
  echo "Veuillez selectionner une catégorie s'il vous plait";
} else {
foreach ($_POST['cat'] as $value) {

}
}
 ?>
