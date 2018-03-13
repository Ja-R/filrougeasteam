<?php
session_start();

$idcat = $_GET['idcat'];

require 'database.php';

$supprimecat = $bdd -> prepare('DELETE FROM categories WHERE id_categorie=?');
$supprimecat -> execute(array($idcat));

$supprimecat->closeCursor();

// echo 'categorie supprime' . $idcat;
header('Location: addcat.php');
