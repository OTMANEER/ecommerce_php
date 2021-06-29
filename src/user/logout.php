<?php
require_once '../common/AuthenticationService.php';

$authenticationService = new AuthenticationService();
$authenticationService->logoutUser();
header('Location: /projetWeb/src/user/index.php');
