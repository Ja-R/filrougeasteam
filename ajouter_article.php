<?php
session_start();

?>
<h2>ajouter un article</h2>

<form action="ajouter_article.php" method="post">
    <input type="text" name="titre" placeholder="Votre titre">
    <!-- <input type="text" name="categorie" placeholder="Choissiez une categorie"> -->
    <br> <textarea name="contenu" style="width:450px; height:200px" placeholder="Votre texte"></textarea>
    <br>
    <input type="checkbox" name="cat[]">
    <label>Catégorie 1</label>
    <input type="checkbox" name="cat[]">
    <label>Catégorie 2</label>
    <input type="checkbox" name="cat[]">
    <label>Catégorie 3</label>
    <a href="#">Ajoutez votre catégorie</a>
    <br>
    <button type="submit">Validez</button>
</form>



<!-- <?php
$cookietitle = $_POST['titre'];
$cookiecontenu = $_POST['contenu'];
setcookie("cookietitre", $cookietitle, time() -3600);
setcookie("cookiecontenu", $cookiecontenu, time() -3600);
?> -->
