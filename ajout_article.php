<?php
session_start();

// if(empty($_POST['cat'])){
//   echo "cat vide";
//   }
//   else{
//     echo "<pre>";
//     var_dump($_POST['cat']);
//   }

if (empty($_POST['titre']) && empty($_POST['categorie']) && empty($_POST['contenu']) && empty($_POST['cat']))
{
  echo "Veuillez remplir tous les champs s'il vous plait";
}else{
  try
  {
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=blogsuperlab;charset=utf8', 'root', 'user', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    //return $bdd;
  }
  catch (Exception $e)
  {
    die('Erreur : ' . $e->getMessage());
  }
  $auteur= $_SESSION['pseudo'];
  $titre = htmlspecialchars($_POST['titre']);
  $categories = $_POST['cat'];
  $contenu = htmlspecialchars($_POST['contenu']);

  var_dump($auteur);

  // echo "<pre>";
  // var_dump($_POST['cat']);


  $req = $bdd->prepare('INSERT INTO articles(auteur, titre, contenu, date_article)
  VALUES(:auteur, :titre, :contenu, NOW())');
  $req->execute(array(
    'auteur' => $auteur,
    'titre' => $titre,
    'contenu' => $contenu
  ));

  $last_id = $bdd->lastInsertId();
  var_dump($last_id);

foreach ($categories as $key => $value) {
  $req = $bdd->prepare('INSERT INTO articles_has_categories(id_article, id_categorie) VALUES(:art, :cat)');
  $req->execute(array(
      ':art' => $last_id,
      ':cat' => $value
    ));
};

  header('Location: blogadmin.php');


}
 ?>
