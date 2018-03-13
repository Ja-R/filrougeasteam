<?php $title = 'Blog superLab'; ?>

<?php ob_start(); ?>

<!-- affichage des articles -->
<?php
while ($donnees = $req->fetch())
{
?>

    <article class="article">
        <h2 class="article-title">
          <?= $donnees['titre']; ?>
        </h2>

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

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
