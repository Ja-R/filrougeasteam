<?php
require('controller.php');

if (isset($_GET['action'])) {

  $action = $_GET['action'];

}else{
  echo "pas d'action ici !";
}


switch ($action)
{
    case 'getBlogVisiteur':
        listeArticlesBlog();

      break;
    case 'getCategories':
      getAllCategories();
      break;
    // case getArticles:
    //     getPosts();
    //   break;
    // case getArticles:
    //     getPosts();
    //   break;
    // case getArticles:
    //     getPosts();
    //   break;
    default:
      echo "action par defaut";
};
