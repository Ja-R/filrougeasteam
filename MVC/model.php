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

// htmlspecialchars($comment['author']);


  $db = dbConnect();

  if (!isset($_GET['user']) && (!isset($_GET['pwd']))) {
    echo "D-JAMAR";
  }
  else
  {
     $login = $_GET['user'];
     $pwd = htmlspecialchars($_GET['pwd']);
  }

  $req = $db->prepare('SELECT login, password
    FROM utilisateurs
    WHERE login = :login, password = :password');
  $req->execute(array(
      'login' => $login,
      'password' => $pwd));
  $resultat = $req->fetch();

  // Comparaison du pass envoyé via le formulaire avec la base
  $isPasswordCorrect = password_verify($pwd, $resultat['password']);

  if (!$resultat)
  {
      echo 'Mauvais identifiant ou mot de passe !';
  }
  else
  {
      if ($isPasswordCorrect) {
          // session_start();
          // $_SESSION['id'] = $resultat['id'];
          // $_SESSION['log'] = $login;
          echo 'Vous êtes connecté !';
      }
      else {
          echo 'Mauvais identifiant ou mot de passe !';
      }
  }

//header('Location: header.php);
