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
    <title>superBlog - Dashboard</title>
</head>

<body>
    <nav>
        <a href='blogvisiteur.php' class="backSuperlab connected">
            <i class="fas fa-arrow-left"></i>
            superBlog.be
        </a>
        <h1 class="titrenav">Dashboard</h1>
        <div class="header__btn-login">
            <i class="far fa-lg fa-user-circle"></i>
            <p class="login-name">
              <?= $auteur;?>
            </p>
        </div>
    </nav>
    <main>

        <div class="nav-dash">
            <a href="addcat.php" class="add-cat">
                Ajouter catégorie
            </a>
            <a href="addarticle.php" class="add-article">
                Ajouter article
            </a>
        </div>
        <div class="dashboard-wrapper-cat">
            <h3>Trier par catégories</h3>

                <ul class="list-cat">

                  <?php
                    $req_cat = $bdd->query('SELECT id_categorie, name_categorie
                       FROM categories');

                    while ($all_categories = $req_cat->fetch())
                    {
                  ?>

                    <li class="category">
                      <a href="filtre.php?idcat=<?= $all_categories['id_categorie'];?> &amp; cat=<?= $all_categories['name_categorie']; ?>"> <?= $all_categories['name_categorie']; ?> </a>
                    </li>

                  <?php
                  }
                  $req_cat->closeCursor();
                  ?>

                </ul>

        </div>

        <?php
            $req1 = $bdd->query('SELECT id_article, id_categorie
               FROM articles_has_categories');


            $req = $bdd->query('SELECT id_article, auteur, titre, contenu,
              DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_art_fr
               FROM articles
               ORDER BY date_article DESC');

            // affichage
            while ($donnees = $req->fetch())
            {
        ?>

          <article class="dashboard-article">
              <div class="dash-edit-del">
                  <div class="dashboard-article-edit">
                      <a href="modifarticle.php?identifiant=<?php echo $donnees['id_article'];?>">
                          <i class="fas fa-edit "></i>
                      </a>

                  </div>
                  <div class="delete-article">
                    <a href="delete.php?identifiant=<?php echo $donnees['id_article'];?>">
                      <i class="fas fa-times "></i>
                    </a>
                  </div>

              </div>
              <div class="dashboard-article-content">
                  <h1>
                    <?= $donnees['titre']; ?>
                  </h1>
                  <div class="article-infos">
                      <p class="article-author">Posté le
                          <time>
                            <?= $donnees['date_art_fr']; ?>
                          </time>  par
                          <span class="author-name">
                            <?= $donnees['auteur']; ?>
                          </span>
                      </p>
                  </div>
                  <p>
                    <?= $donnees['contenu']; ?>
                  </p>
              </div>
              <div class="category-list-wrap">
                <ul class="category-list">
                <?php
                    $id_art = $donnees['id_article'];

                    $getcat = $bdd->query('SELECT name_categorie
                      FROM articles, articles_has_categories, categories
                      WHERE articles_has_categories.id_article = articles.id_article
                      AND articles_has_categories.id_categorie = categories.id_categorie
                      AND articles.id_article = '.$id_art.'');

                    while($datacat = $getcat->fetch())
                    {
                    ?>
                        <li class="category "> <?= $datacat['name_categorie']; ?> </li>
                        <!-- <li class="category ">News</li> -->

                    <?php
                        }
                        $getcat->closeCursor();
                    ?>
                </ul>
              </div>
          </article>

        <?php
        }
        $req->closeCursor();
        ?>

    </main>
    <script src="assets/js/dashboard.js"></script>
</body>

</html>
