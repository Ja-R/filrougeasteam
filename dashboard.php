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

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>dashboard</title>
  </head>
  <body>


options: <a href="ajouter_article.php">ajouter une article</a>
<hr>

<p>Choix des catégories:</p><br>

<?php
  $req_cat = $bdd->query('SELECT id_categorie, name_categorie
     FROM categories');

     while ($all_categories = $req_cat->fetch())
     {
     ?>
     <a href="tri_categorie.php?idcat=<?= $all_categories['id_categorie'];?>"> <?= $all_categories['name_categorie']; ?> </a> <br>

     <?php
     }
     $req_cat->closeCursor(); // Termine le traitement de la requête

     ?>

<hr>
    <?php

        $req = $bdd->query('SELECT id_article, auteur, titre, catégorie, contenu,
          DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_art_fr
           FROM articles
           ORDER BY date_article DESC
          --  LIMIT 0, 2
           ');

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
