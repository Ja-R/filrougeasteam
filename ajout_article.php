<?php
session_start();

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
  $categorie = htmlspecialchars($_POST['categorie']);
  $contenu = htmlspecialchars($_POST['contenu']);

  $req = $bdd->prepare('INSERT INTO articles(auteur, titre, catégorie, contenu, date_article)
  VALUES(:auteur, :titre, :categorie, :contenu, NOW())');
  $req->execute(array(
    'auteur' => $auteur,
    'titre' => $titre,
    'categorie' => $categorie,
    'contenu' => $contenu
  ));

  header('Location: blogadmin.php');
}
 ?>
