<?php
require_once '../common/CommonComponents.php';
require_once '../common/AuthenticationService.php';
require_once './controller/UserLoginController.php';
require_once './model/DatabaseUserRepository.php';

/* On ajoute les fichiers css/js correspondant aux articles  */

$head = <<<HTML
      <link rel="stylesheet" type="text/css" href="../public/css/login.css">
HTML;



$userController = new UserLoginController(new AuthenticationService(), new DatabaseUserRepository());
CommonComponents::render($userController->loginAction(), false,$head);

