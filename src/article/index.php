
<?php
require_once '../common/CommonComponents.php';
require_once '../common/AuthenticationService.php';
require_once './controller/ArticleController.php';
require_once './model/DatabaseArticleRepository.php';


/* On recupere la page demandée et à partir de celle ci on peut savoir quels articles afficher*/
if (isset($_GET['page']) && $_GET['page']!= 1 && $_GET['page']!= ''){
    $begin = ($_GET['page']-1)*10;
    $currentPage = $_GET['page'];

}else{
    $begin = 0;
    $currentPage = 1;
}

/* On ajoute les fichiers css/js correspondant aux articles  */

$head = <<<HTML
      <link rel="stylesheet" type="text/css" href="../public/css/article.css">
HTML;

$script = <<<HTML
    <script src ="../public/js/article.js"></script>
HTML;


/* On recupère les filtres */
$filter = array();
if (isset($_GET['search']) && $_GET['search']!=""){
    $filter['search'] = $_GET['search'];
}
if (isset($_GET['categorie'])  && $_GET['categorie'] != "Toutes"){
    $filter['categorie'] = $_GET['categorie'];
}
if (isset($_GET['tri']) && $_GET['tri'] != "Aucun"){
    $filter['tri'] = $_GET['tri'];
}
if (isset($_GET['min'])  ){
    $filter['min'] = $_GET['min'];
}
if (isset($_GET['max'])){
    $filter['max'] = $_GET['max'];
}


$articleController= new ArticleController(new AuthenticationService(), new DatabaseArticleRepository());
if ($articleController->getAuthenticationService()->isUserConnected()){

    CommonComponents::render($articleController->viewAction($begin,$filter,$currentPage),true,$head,$script);
}else{

    CommonComponents::render($articleController->viewAction($begin,$filter,$currentPage),false,$head,$script);
}