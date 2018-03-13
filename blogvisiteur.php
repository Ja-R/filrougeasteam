<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog superLab</title>
    <link rel="stylesheet" type="text/css" href="assets/css/blog.css">
    <link rel="stylesheet" href="assets/css/css/fontawesome-all.css">

</head>

<body>
    <nav>
        <a href='index.html' class="backSuperlab">
            <i class="fas fa-arrow-left"></i>
            superLab.be
        </a>
        <!-- <h1>Bienvenue visiteur</h1> -->
        <div class="header-nav-dash">
            <a href="blogadmin.php" class="dashboard-btn">Dashboard</a>
            <div class="header__btn-login">

                <i class="far fa-lg fa-user-circle"></i>
            </div>
        </div>
    </nav>
    <header>
        <h1 class="header__title">superBlog</h1>
    </header>
    <main>

      <?php
          require 'database.php';

          $req = $bdd->query('SELECT id_article, auteur, titre, contenu,
            DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_art_fr
             FROM articles
             ORDER BY date_article DESC
             LIMIT 0, 5');

          // affichage
          while ($donnees = $req->fetch())
          {
          ?>

              <article class="article">
                  <h2 class="article-title">
                    <?= $donnees['titre']; ?>
                  </h2>

                  <div class="article-infos">
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
                          <?php
                              }
                              $getcat->closeCursor();
                          ?>
                      </ul>


                  </div>
                  <div class="">
                    <p class="article-p">
                      <?= $donnees['contenu']; ?>
                    </p>

                    <p class="article-author">Posté le
                        <time>
                          <?= $donnees['date_art_fr']; ?>
                        </time> par
                        <span class="author-name">
                          <?= $donnees['auteur']; ?>
                        </span>
                    </p>

                  </div>


              </article>

        <?php
        }
        $req->closeCursor();

        ?>

        <!-- MODAL TO LOG -->
        <div class="modal">
            <div class="modal-content">
                <div class="modal-upper">
                    <div class="close-button">
                        <i class="fas fa-times "></i>
                    </div>
                    <div class="modal-upper__icon">
                        <i class="far fa-2x fa-lg fa-user-circle"></i>
                    </div>
                </div>

                <form  action="login.php" method="post" class="header__form ">
                    <label for="username">
                        <i class="fas fa-user"></i>
                        <input type="text" name="user" placeholder=" Compte" class="header__input__username">
                    </label>

                    <label for="password">
                        <i class="fas fa-key"></i>
                        <input type="password" name="pwd" placeholder=" Mot de passe" class="header__input__password">
                    </label>

                    <button type="submit">
                        connection
                        <i class="fas fa-unlock-alt"></i>
                    </button>
                </form>

            </div>
        </div>
    </main>
    <footer>
        <p>now get the fuck out of here.</p>
    </footer>

    <script src="assets/js/blog.js"></script>
</body>

</html>
