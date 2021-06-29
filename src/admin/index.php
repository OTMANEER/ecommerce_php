<?php
require_once '../common/CommonComponents.php';
require_once '../common/AuthenticationService.php';
require_once './controller/AdminArticleController.php';
require_once './model/DatabaseAdminRepository.php';


/* On ajoute les fichiers css/js correspondant aux articles  */

$head = <<<HTML
      <link rel="stylesheet" type="text/css" href="../public/css/admin.css">
HTML;

$script = <<<HTML
    <script src ="../public/js/admin.js"></script>
HTML;


$adminArticleController= new AdminArticleController(new AuthenticationService(), new DatabaseAdminRepository());
CommonComponents::render($adminArticleController->viewAction(),true,$head,$script);