<?php

function buildCartView($carts): string
{
    $totalPrice = 0;
    $renduHtml = "";
   if (!empty($carts)){ 
        $renduHtml = $renduHtml. <<<HTML
            <div id="paySuccess" class="d-none">
                <h3> Votre commande a été passée, aurevoir merci!</h3>
                <a class="btn btn-success" href="/projetWeb/src/article/">Continuez vos achats ?</a>
            </div>
            <div id="globalContainer">
            <h3 class="text-center">Voici votre panier</h3>
            <div id="articlesContainer">
            <table>
                <tr>
                    <td>Produit</td>
                    <td>Quantité</td>
                </tr>
        HTML;
            foreach($carts as $key => $cart){
                $totalPrice = $totalPrice + $cart['price']*$cart['quantity'];
                $id = $cart['id'];
                $title = $cart['title'];
                $quantity = $cart['quantity'];
                $renduHtml = $renduHtml. <<<HTML
                    <tr class="article">
                        <td> $title </td> 
                        <td>$quantity <a class="btn btn-danger mybutton" href="/projetWeb/src/cart/delete.php?key=$key"><i class="bi bi-trash-fill"></i></a></td>
                    </tr>
                HTML;
            }
        $renduHtml = $renduHtml.<<<HTML
            
                <tr>
                    <td> montant total en Euro : </td>
                    <td> $totalPrice </td>
                </tr>
            </table>
            <a class="btn btn-dark" id="payBtn">Passer au paiement</a>
            </div>
            <div id="payDiv" class="d-none form-group">
                <input type="text" class="form-control" name="numCB" placeholder="Entrez le numéro de votre carte bancaire...">
                <button  class="btn btn-dark" id="btnPay" >Acheter!</button>
            </div>
            </div>
        HTML;
   }else{
       $renduHtml = <<<HTML
        <h3 class="text-center">Votre panier est vide !</h3>
       HTML;
   }
  return $renduHtml;
}
