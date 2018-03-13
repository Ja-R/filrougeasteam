<?php

require('model.php');

function listeArticlesBlog(){
  $req = getPosts();
  // $categoriesArt = getCategoriesByPost($id_art);

  require('viewBlog.php');
}
