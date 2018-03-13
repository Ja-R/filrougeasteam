<?php
session_start();

require 'database.php';

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ajouter une catégorie</title>
  </head>
  <body>
    <?php



// $req = $bdd->prepare('SELECT id_article, titre, catégorie, contenu,
//   DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_art_fr
//    FROM articles
//    WHERE id_article= ?');
//   $req->execute(array($idmodif));
     ?>
<form  action="dashboard.php" method="post">
  <input type="text" name="ajout_cat" placeholder="Ajouter votre catégorie">
  <input type="submit" value="Ajouter">
</form>

  </body>
</html>
