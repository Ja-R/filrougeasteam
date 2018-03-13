<?php

//connection base de donnees
function dbConnect(){
  try
  {
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=blogsuperlab;charset=utf8', 'root', 'user', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $bdd;
  }
  catch (Exception $e)
  {
    die('Erreur : ' . $e->getMessage());
  }
}

// les 5 derniers billets (pour page visiteurs et admin/user)
function getPosts(){

  $bdd = dbConnect();

  $req = $bdd->query('SELECT id_article, auteur, titre, contenu,
    DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_art_fr
     FROM articles
     ORDER BY date_article DESC
     LIMIT 0, 5');

  return $req;
}

// recupère la liste des catégories
function getAllCategories(){

  $bdd = dbConnect();

  $req_cat = $bdd->query('SELECT id_categorie, name_categorie
     FROM categories');

  $req_cat->fetch();

  return $req_cat;
}

// recupère la liste des catégories par articles
function getCategoriesByPost($id_art){

  $bdd = dbConnect();

  $getcat = $bdd->query('SELECT name_categorie
    FROM articles, articles_has_categories, categories
    WHERE articles_has_categories.id_article = articles.id_article
    AND articles_has_categories.id_categorie = categories.id_categorie
    AND articles.id_article = '.$id_art.'');
  $getcat->fetch();

  return $getcat;
}
