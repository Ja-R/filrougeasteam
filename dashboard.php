<?php
  session_start();

  // if (isset($_SESSION['id']) && isset($_SESSION['pseudo'])) {
	// echo 'Votre login est '.$_SESSION['id'].' et votre mot de passe est '.$_SESSION['pseudo'].'.';
	// echo '<br />';
  // }
  // else
  // {
  // 	echo 'Les variables ne sont pas déclarées.';
  // }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>dashboard</title>
  </head>
  <body>


    <h2>ajouter un article</h2>

<form action="ajout.php?" method="post">
  <input type="text" name="titre" placeholder="Votre titre">
  <!-- <input type="text" name="categorie" placeholder="Choissiez une categorie"> -->
  <!-- <input type="text" name="contenu" placeholder="Votre texte"> -->
  <br> <textarea name="contenu" style="width:450px; height:200px" placeholder="Votre texte"></textarea>
  <button type="submit">Validez</button>
</form>

<form  action="categorie.php" method="post">
  <input type="checkbox" name="cat[]" value="cat1">
  <label>cat1</label>
  <input type="checkbox" name="cat[]" value="cat2">
  <label>cat2</label>
  <input type="checkbox" name="cat[]" value="cat3">
  <label>cat3</label>
  <input type="text" name="ajout_cat" placeholder="Ajoutez votre catégorie">
  <input type="submit">
</form>
<hr>
    <?php
        //connection base de donnees
        try
        {
          $bdd = new PDO('mysql:host=127.0.0.1;dbname=blogsuperlab;charset=utf8', 'root', 'user', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
          //return $bdd;
        }
        catch (Exception $e)
        {
          die('Erreur : ' . $e->getMessage());
        }

        $req = $bdd->query('SELECT id_article, auteur, titre, catégorie, contenu,
          DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_art_fr
           FROM articles
           ORDER BY date_article DESC
           LIMIT 0, 2');

        // affichage
        while ($donnees = $req->fetch())
        {
        ?>

    <article>
        <ul class="categorie-list">
            <li class="categorie"> catégorie:
              <?= $donnees['catégorie']; ?>
            </li>
        </ul>

        <h2>
          <?= $donnees['titre']; ?>
        </h2>
        <h3>
          <?= $donnees['auteur']; ?> identifiant <?= $donnees['id_article']; ?>
        </h3>
        <time>
          <?= $donnees['date_art_fr']; ?>
        </time>
        <p>
          <?= $donnees['contenu']; ?>
        </p>

        <a href="delete.php?identifiant=<?php echo $donnees['id_article'];?>">supprimer</a>
        <br>
        <a href="modification.php?identifiant=<?php echo $donnees['id_article'];?>">modifier</a>

    </article>

    <hr>

    <?php
    }
    $req->closeCursor(); // Termine le traitement de la requête

    ?>

  </body>
</html>
