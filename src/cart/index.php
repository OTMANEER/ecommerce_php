<?php
require_once '../common/CommonComponents.php';
require_once '../common/AuthenticationService.php';
require_once './controller/CartController.php';
require_once './model/DatabaseCartRepository.php';


/* On ajoute les fichiers css/js correspondant aux articles  */

$head = <<<HTML
      <link rel="stylesheet" type="text/css" href="../public/css/cart.css">
HTML;

$script = <<<HTML
    <script src ="../public/js/cart.js"></script>
HTML;


$cartController= new CartController(new AuthenticationService(), new DatabaseCartRepository());

if ($cartController->getAuthenticationService()->isUserConnected()){
    CommonComponents::render($cartController->viewAction(),true,$head,$script);
}else{
    CommonComponents::render($cartController->viewAction(),false,$head,$script);
}