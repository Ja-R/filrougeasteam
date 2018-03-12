<?php
  session_start();

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
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href="assets/css/blog.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/modif.css">
    <title>catégories</title>
</head>

<body>
    <nav>
        <a href='blogadmin.php' class="backSuperlab connected">
            <i class="fas fa-arrow-left"></i>
            superDashboard.be
        </a>
        <div class="header__btn-login">
            <i class="far fa-lg fa-user-circle"></i>
            <p class="login-name">Admin</p>
        </div>
    </nav>
    <main>
        <div>
            <h2 class="title-categorie">Catégories</h2>
            <ul class="list-categorie">

              <?php
                $req_cat = $bdd->query('SELECT id_categorie, name_categorie
                   FROM categories');

                while ($all_categories = $req_cat->fetch())
                {
              ?>

                <li class="categorie">
                    <?= $all_categories['name_categorie']; ?>
                    <a href="supprimer_cat.php?idcat=<?= $all_categories['id_categorie'];?>">
                      <i class="far fa-trash-alt"></i>
                    </a>
                </li>
                <?php
                }
                $req_cat->closeCursor();
                ?>

            </ul>

            <div class="add-cat">
                <form action="categorie.php" method="POST" class="add-cat-form">
                    <label class="inputcat">
                        <input type="text" name="ajout_cat" class="input-add-cat" placeholder="Ajoutez une catégorie">
                    </label>
                    <label class="submitcat">
                        <input type="submit" class="submit-cat-input" value="Ajouter">
                        <i class="fas fa-plus"></i>
                    </label>
                </form>
            </div>
        </div>


    </main>
</body>

</html>
