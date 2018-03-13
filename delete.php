<?php
session_start();

$iddelete = $_GET['identifiant'];

require 'database.php';

$supprimeligne = $bdd -> prepare("DELETE FROM articles WHERE id_article=?");
$supprimeligne -> execute(array($iddelete));

$supprimeligne->closeCursor();

header('Location: blogadmin.php');
