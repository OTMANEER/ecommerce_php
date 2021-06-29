<?php
include 'SessionClient.php';

class AuthenticationService
{
  private $sessionClient;
  private $IS_CONNECTED_KEY = 'isConnected';
  private $IS_ADMIN_KEY = "isAdmin";
  private $CART_KEY = "cart";
  private $USER_ID = "userID";

  public function __construct()
  {
    $this->sessionClient = SessionClient::getInstance();
  }

  public function isUserConnected(): bool
  {
    return $this->sessionClient->exists($this->IS_CONNECTED_KEY) && $this->sessionClient->get($this->IS_CONNECTED_KEY);
  }

  public function addToCart($newCartId,$newCartTitle,$newCartPrice){
    $done = false;
    $currentCart = !empty($this->sessionClient->get($this->CART_KEY)) ? $this->sessionClient->get($this->CART_KEY) : array();

    foreach ($currentCart as $key=>$cart){
      if ($cart['id'] === strval($newCartId)){
        $currentCart[$key]['quantity'] =strval(intval($currentCart[$key]['quantity']) + 1);
        $done = true;
        break;
      }
    }
    if (!$done){
      $currentCart[]  = array(
        'id' => $newCartId,
        'title' => $newCartTitle,
        'quantity' => '1',
        'price' => $newCartPrice
      );
    }
    $this->sessionClient->set($this->CART_KEY,$currentCart);
  }
  
  public function cartSize(){
    $size = 0;
    $carts = !empty($this->get($this->CART_KEY)) ? $this->get($this->CART_KEY) : array();
    foreach($carts as $cart){
      $size = $size + intval($cart['quantity']);
    }

    return $size;
  }

  public function emptyCart(){
    $this->sessionClient->set($this->CART_KEY,array());
  }
  

  public function get($key){
    if ($this->sessionClient->exists($key))
      return $this->sessionClient->get($key);
    else
      return array();
  }


  public function isAdmin():bool
  {
    return $this->sessionClient->exists($this->IS_ADMIN_KEY) && $this->sessionClient->get($this->IS_ADMIN_KEY);
  }

  public function connectUser($idUser): void
  {
    $this->sessionClient->set($this->IS_CONNECTED_KEY, true);
    $this->sessionClient->set($this->USER_ID,$idUser);
  }

  public function setAdmin(): void
  {
    $this->sessionClient->set($this->IS_ADMIN_KEY, true);
  }

  public function logoutUser(): void
  {
    $this->sessionClient->delete($this->IS_CONNECTED_KEY);
    $this->sessionClient->stop();
  }
}
