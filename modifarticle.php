<?php
session_start();

$idmodif = $_GET['identifiant'];

try
{
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=blogsuperlab;charset=utf8', 'root', 'user', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  //return $bdd;
}
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}

$req = $bdd->prepare('SELECT id_article, titre, contenu,
  DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_art_fr
   FROM articles
   WHERE id_article= ?');
  $req->execute(array($idmodif));

   while ($donnees = $req->fetch())
   {
     $updatetitre = $donnees['titre'];
    //  $updatecategorie = $donnees['catégorie'];
     $updatecontenu = $donnees['contenu'];
     $idmodifie = $donnees['id_article'];
   }
   $req->closeCursor();

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
    <title>Modifier article</title>
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

      <article class="modif-article">
          <form action="modifie.php?id=<?php echo $idmodifie;?>" method="post" class="modif-article-form">
              <div class="article-title-wrapper">
                  <h2>Modifiez votre titre</h2>
                  <label class="modif-title">
                      <input type="text" id="title" name="modificationtitre" value="<?= $updatetitre; ?>" class="modif-input">
                  </label>
              </div>
              <div class="checkbox-wrap">
                  <h2>Modifiez vos catégories</h2>
                  <div class="control-group">

                    <?php
                      $req_cat = $bdd->query('SELECT id_categorie, name_categorie
                         FROM categories');

                      while ($all_categories = $req_cat->fetch())
                      {
                    ?>

                        <label class="control control--checkbox"><?= $all_categories['name_categorie']; ?>
                            <input name="cat[]" type="checkbox"/>
                            <div class="control__indicator"></div>
                        </label>

                    <?php
                    }
                    $req_cat->closeCursor();
                    ?>

                  </div>
                  <div class="textarea-wrapper">
                      <h2>Modifiez votre contenu</h2>
                      <textarea type="text" class="article-textarea" name="modificationcontenu">
                        <?= $updatecontenu; ?>
                      </textarea>
                  </div>
              </div>
              <input type="submit" name="" class="submit-add-article">
          </form>

      </article>

    </main>
</body>

</html>
