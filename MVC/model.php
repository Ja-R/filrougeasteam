<?php

//connection base de donnees
function dbConnect()
{
  try
  {
    $db = new PDO('mysql:host=127.0.0.1;dbname=test;charset=utf8', 'root', 'user', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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

  $req = $db->prepare('SELECT id, login, password,
  FROM utilisateur');
  $req->execute(array());
  $post= $req->fetch();

return $post;
}
