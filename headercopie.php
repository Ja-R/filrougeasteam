<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog superLab</title>
    <link rel="stylesheet" type="text/css" href="assets/css/blog.css">
    <link rel="stylesheet" href="assets/css/css/fontasesome.css">
    <link rel="stylesheet" href="assets/css/css/fontawesome-all.css">


</head>

<body>
    <header>
        <nav>
            <div class="header__btn-login">
                <i class="far fa-lg fa-user-circle"></i>
            </div>
        </nav>
        <h1 class="header__title">BLOG</h1>
    </header>
    <main>
        <div class="modal show-modal">
            <div class="modal-content">
                <div class="modal-upper">
                    <div class="close-button">
                        <i class="fas fa-times "></i>
                    </div>
                    <div class="modal-upper__icon">
                        <i class="far fa-2x fa-lg fa-user-circle"></i>
                    </div>

                </div>

                <form action="login.php" method="post" class="header__form " >
                    <label for="username">
                        <i class="fas fa-user"></i>
                        <input type="text" name="user"  placeholder=" Compte" class="header__input__username">
                    </label>

                    <label for="password">
                        <i class="fas fa-key"></i>
                        <input type="password" name="pwd" placeholder=" Mot de passe" class="header__input__password">
                    </label>

                    <button type="submit">OK

                    </button>

                </form>
            </div>
        </div>

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
                      <li class="categorie">
                        Newssss
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

              </article> <hr>

              <?php
              }
              $req->closeCursor(); // Termine le traitement de la requête

              ?>


        <!-- A déplacer dans footer.php -->
    </main>
    <script src="assets/js/blog.js"></script>
</body>

</html>
