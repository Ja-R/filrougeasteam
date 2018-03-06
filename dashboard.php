<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>dashboard</title>
  </head>
  <body>

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

  </body>
</html>
