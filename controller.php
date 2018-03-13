<?php

require('model.php');

function listeArticlesBlog(){
  $req = getPosts();
  // $req_cat = getCategoriesByPost($id_art);

  require('viewBlog.php');
}
