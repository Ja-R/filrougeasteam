<?php

//connection base de donnees
function dbConnect()
{
  try
  {
    $db = new PDO('mysql:host=127.0.0.1;dbname=blogsuperlab;charset=utf8', 'root', 'user', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $db;
  }
  catch (Exception $e)
  {
          die('Erreur : ' . $e->getMessage());
  }

}

//
function login()
{

  $db = dbConnect();
  if (!isset($_POST['user']) && (!isset($_POST['pwd']))) {

  }
  $req = $db->prepare('SELECT login, pass FROM utilisateurs WHERE login = :pseudo, pass = :pass');
  $req->execute(array(
      'login' => $login));
  $resultat = $req->fetch();
}
