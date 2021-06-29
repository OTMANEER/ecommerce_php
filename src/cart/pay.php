<?php
require_once '../common/AuthenticationService.php';
require_once './model/DatabaseCartRepository.php';

$database = new DatabaseCartRepository();
$authenticationService = new AuthenticationService();
if ($authenticationService->isUserConnected()){
    /* On doit mettre à jour la bdd */
    
    $cart = $authenticationService->get("cart");
    $userId = $authenticationService->get("userID"); 

    $totalPrice = getTotalPrice($cart);


    $database->addCommand($cart,$userId,$totalPrice);
    $database->updateArticles($cart);


    /*A la fin on vide le panier */
    $authenticationService->emptyCart();

}else{

    header('Location: /projetWeb/src/user/index.php');
}


function getTotalPrice($carts){
    $price = 0;
    foreach($carts as $cart){
        $price = $price + $cart['quantity']*$cart['price'];
    }
    echo " price : $price";
    return $price;
}