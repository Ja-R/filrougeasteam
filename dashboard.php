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
  <input type="text" name="titre">
  <input type="text" name="categorie">
  <input type="text" name="contenu">
  <button type="submit">OK</button>
</form>

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

        $req = $bdd->query('SELECT id, auteur, titre, catégorie, contenu,
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
          <?= $donnees['auteur']; ?> identifiant <?= $donnees['id']; ?>
        </h3>
        <time>
          <?= $donnees['date_art_fr']; ?>
        </time>
        <p>
          <?= $donnees['contenu']; ?>
        </p>

        <a href="delete.php?identifiant=<?php echo $donnees['id'];?>">supprimer</a>
        <br>
        <a href="modification.php?identifiant=<?php echo $donnees['id'];?>">modifier</a>

    </article>

    <hr>

    <?php
    }
    $req->closeCursor(); // Termine le traitement de la requête

    ?>

  </body>
</html>
