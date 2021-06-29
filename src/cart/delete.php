<?php

require_once '../common/AuthenticationService.php';
require_once '../common/SessionClient.php';



if(isset($_GET['key'])){
    $session = SessionClient::getInstance();
    $currentCart = $session->get('cart');
    $currentCart[$_GET['key']]['quantity'] = $currentCart[$_GET['key']]['quantity'] - 1;
    if($currentCart[$_GET['key']]['quantity'] == 0){
        unset($currentCart[$_GET['key']]);
    }
    $session->set('cart',$currentCart);
    redirect();
    
}



function redirect(){
    header('Location: /projetWeb/src/cart/');
}