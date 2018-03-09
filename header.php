<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog superLab</title>
    <link rel="stylesheet" type="text/css" href="assets/css/blog.css">
</head>

<body>
    <header>
        <nav>
            <form action = "login.php" class="header__form" method="post">
                <label for = "username">
                    <input type = "text" name="user" required class = "header__input__username">
                </label>
                <label for = "password">
                    <input type = "password" name="pwd" required class = "header__input__password">
                </label>
                <button type = submit>ok</button>

            </form>
        </nav>
        <h1 class = "header__title">BLOG</h1>
    </header>
<main>

  <!-- DASHBOARD -->

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

      $req = $bdd->query('SELECT auteur, titre, catégorie, contenu,
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
          <li class="categorie">
            <?= $donnees['catégorie']; ?>
          </li>
      </ul>

      <h2>
        <?= $donnees['titre']; ?>
      </h2>
      <h3>
        <?= $donnees['auteur']; ?>
      </h3>
      <time>
        <?= $donnees['date_art_fr']; ?>
      </time>
      <p>
        <?= $donnees['contenu']; ?>
      </p>
  </article>

  <hr>

  <?php
  }
  $req->closeCursor(); // Termine le traitement de la requête

  ?>

pour modiffff

$modification = $bdd->prepare('UPDATE articles SET titre = :titre, catégorie = :categorie, contenu = :contenu, date_article = NOW()
  WHERE id = :identif');

// ajouter input pour les modifs
$modification->execute(array(
  'titre' => $titre,
  'categorie' => $categorie,
  'contenu' => $contenu,
  'identif' => $idmodif
));

  <?php header('Location: dashboard.php'); ?>
