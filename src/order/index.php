
<?php
require_once '../common/CommonComponents.php';
require_once '../common/AuthenticationService.php';
require_once './controller/OrderController.php';
require_once './model/DatabaseOrderRepository.php';


/* On ajoute les fichiers css/js correspondant aux articles  */

$head = <<<HTML
      <link rel="stylesheet" type="text/css" href="../public/css/order.css">
HTML;

$script = <<<HTML
    <script src ="../public/js/order.js"></script>
HTML;


$orderController= new OrderController(new AuthenticationService(), new DatabaseOrderRepository());
CommonComponents::render($orderController->viewAction(),true,$head,$script);