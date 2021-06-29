<?php
require_once __DIR__ . '/../view/buildCartView.php';

class CartController
{
  private $authenticationService;
  private $cartRepository;

  public function __construct(AuthenticationService $authenticationService, CartRepository $cartRepository)
  {
    $this->authenticationService = $authenticationService;
    $this->cartRepository = $cartRepository;
  }

  public function viewAction(): string {
    return buildCartView($this->authenticationService->get('cart'));
  }
  public function getAuthenticationService(){
    return $this->authenticationService;
  }

}
