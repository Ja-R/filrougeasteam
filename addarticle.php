<?php
session_start();
$auteur= $_SESSION['pseudo'];

require 'database.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href="assets/css/blog.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/modif.css">
    <title>Ajout d'article</title>
</head>

<body>
    <nav>
        <a href='blogadmin.php' class="backSuperlab connected">
            <i class="fas fa-arrow-left"></i>
            superDashboard.be
        </a>
        <h1 class="titrenav">Ajoutez un article</h1>
        <div class="header__btn-login">
            <i class="far fa-lg fa-user-circle"></i>
            <p class="login-name">
              <?= $auteur;?>
            </p>
        </div>
    </nav>
    <main>

        <article class="modif-article">
            <form action="ajout_article.php" method="post" class="modif-article-form">
                <div class="article-title-wrapper">
                    <h2>Choisissez votre titre</h2>
                    <label class="modif-title">
                        <input type="text" id="title" name="titre"  placeholder="Mon titre" class="modif-input">
                    </label>
                </div>
                <div class="checkbox-wrap">
                    <h2>Choisissez vos catégories</h2>
                    <div class="control-group">

                      <?php
                        $req_cat = $bdd->query('SELECT id_categorie, name_categorie
                           FROM categories');

                        while ($all_categories = $req_cat->fetch())
                        {
                      ?>

                          <label class="control control--checkbox"><?= $all_categories['name_categorie']; ?>
                              <input name="cat[]" type="checkbox" value="<?= $all_categories['id_categorie']; ?>"/>
                              <div class="control__indicator"></div>
                          </label>

                      <?php
                      }
                      $req_cat->closeCursor();
                      ?>

                    </div>
                    <div class="textarea-wrapper">
                        <h2>Votre contenu</h2>
                        <textarea type="text" class="article-textarea" name="contenu"> </textarea>
                    </div>
                </div>
                <input type="submit" value="Ajoutez" name="" class="submit-add-article">
            </form>

        </article>

    </main>
</body>

</html>
