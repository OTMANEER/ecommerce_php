<?php
require_once __DIR__ . '/../view/buildOrderView.php';

class OrderController
{
  private $authenticationService;
  private $orderRepository;

  public function __construct(AuthenticationService $authenticationService, OrderRepository $orderRepository)
  {
    $this->authenticationService = $authenticationService;
    $this->orderRepository = $orderRepository;
  }

  public function viewAction(): string {
    if ($this->authenticationService->isUserConnected()){
      return buildOrderView($this->orderRepository->getOrders($this->authenticationService->get('userID')));
    }else{
      $this->redirectToLogin();
    }
  }
  public function getAuthenticationService(){
    return $this->authenticationService;
  }
  
  private function redirectToLogin(): void {
    header('Location: /projetWeb/src/user/index.php');
  }

}
