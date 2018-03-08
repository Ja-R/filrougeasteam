<?php
  session_start();
  if (ISSET($_GET['idcat']))
  {
    $id_cat = $_GET['idcat'];
  }
  else
  {
    $id_cat = 1;
  }

  try
  {
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=blogsuperlab;charset=utf8', 'root', 'user', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    //return $bdd;
  }
  catch (Exception $e)
  {
    die('Erreur : ' . $e->getMessage());
  }

  // filtrage des articles par categorie donnee en GET
  $req = $bdd->prepare('SELECT cat.name_categorie,
                        cat.id_categorie,
                        art.id_article,
                        art.auteur,
                        art.titre,
                        art.contenu,
                        art.date_article
                        FROM articles AS art,
                        articles_has_categories AS mid,
                        categories AS cat
                        WHERE mid.id_categorie = cat.id_categorie
                        AND art.id_article = mid.id_article
                        AND cat.id_categorie = '.$id_cat.'');

   $req->execute();
   // affichage
   while ($art_tries = $req->fetch())
   {
   ?>
<h1>articles tries par categorie</h1><br>
<article>
   <ul class="categorie-list">
       <li class="categorie"> catégorie:
         <?= $art_tries['name_categorie']; ?>
       </li>
   </ul>

   <h2>
     <?= $art_tries['titre']; ?>
   </h2>
   <h3>
     <?= $art_tries['auteur']; ?> identifiant <?= $art_tries['id_article']; ?>
   </h3>
   <time>
     <?= $art_tries['date_article']; ?>
   </time>
   <p>
     <?= $art_tries['contenu']; ?>
   </p>

   <a href="delete.php?identifiant=<?php echo $art_tries['id_article'];?>">supprimer</a>
   <br>
   <a href="modification.php?identifiant=<?php echo $art_tries['id_article'];?>">modifier</a>

</article>

<hr>

<?php
}
$req->closeCursor(); // Termine le traitement de la requête

?>
