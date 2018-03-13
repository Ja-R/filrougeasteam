<?php

//hachage du mdp
// $pwd_hash = password_hash('pwdadmin', PASSWORD_DEFAULT);
// echo "hashhhhh" .$pwd_hash;

//verification des identifiants
if (!isset($_POST['user']) AND !isset($_POST['pwd'])){
  echo "D-JAMAR";
}else
{
  $login =  htmlspecialchars($_POST['user']);
  $pwd = htmlspecialchars($_POST['pwd']);
  $pwdhash = password_hash($pwd, PASSWORD_DEFAULT);
  //echo "login hash: " . $pwdhash;
}

require 'database.php';

//  Récupération de l'utilisateur et de son pass hashé
$req = $bdd->prepare('SELECT id_user, login, password FROM utilisateurs WHERE login = :pseudo');
$req->execute(array(
    'pseudo' => $login));
$resultat = $req->fetch();
// echo "<br> resultat <pre> ";
// var_dump($resultat);
// Comparaison du pass envoyé via le formulaire avec la base
$isPasswordCorrect = password_verify($pwd, $resultat['password']);
// echo "<br> verify <pre> ";
// var_dump($isPasswordCorrect);
if (!$resultat)
{
    echo 'Mauvais identifiant !';
}
else
{
    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['id'] = $resultat['id_user'];
        $_SESSION['pseudo'] = $login;
        echo 'Vous êtes connecté ' . $login . ' !';
        //echo 'Vous êtes connecté!' . $login . '<br> session id: ' . $_SESSION['id'] . '<br> pseudo' .$_SESSION['pseudo'] ;
        header('Location: blogadmin.php');
    }
    else {
        echo 'Mauvais mot de passe !';
    }
}
