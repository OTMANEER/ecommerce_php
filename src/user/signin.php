<?php
require_once '../common/CommonComponents.php';
require_once '../common/AuthenticationService.php';
require_once './controller/UserSigninController.php';
require_once './model/DatabaseUserRepository.php';


$head = <<<HTML
      <link rel="stylesheet" type="text/css" href="../public/css/login.css">
HTML;

$userController = new UserSigninController(new AuthenticationService(), new DatabaseUserRepository());
CommonComponents::render($userController->signinAction(), false,$head);

