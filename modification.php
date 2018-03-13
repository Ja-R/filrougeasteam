<?php
session_start();

$idmodif = $_GET['identifiant'];

require 'database.php';

$req = $bdd->prepare('SELECT id_article, titre, catégorie, contenu,
  DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_art_fr
   FROM articles
   WHERE id_article= ?');
  $req->execute(array($idmodif));

   while ($donnees = $req->fetch())
   {
     $updatetitre = $donnees['titre'];
     $updatecategorie = $donnees['catégorie'];
     $updatecontenu = $donnees['contenu'];
     $idmodifie = $donnees['id_article'];
   }
   $req->closeCursor();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>modif</title>
  </head>
  <body>

    <h2>Modifier un article</h2>

    <form action="modifie.php?id=<?php echo $idmodifie;?>" method="post">
      <input type="text" name="modificationtitre" value="<?= $updatetitre; ?>">
      <input type="text" name="modificationcategorie" value="<?= $updatecategorie; ?>">
      <!-- <input type="text" name="contenu" placeholder="Votre texte"> -->
      <br>
      <textarea name="modificationcontenu" style="width:450px; height:200px"><?= $updatecontenu; ?>

      </textarea>
      <!-- <br> <?= $idmodifie;?> -->
      <button type="submit">Validez</button>
    </form>



  </body>
</html>
