<?php
require_once __DIR__ . '/../view/buildAdminCategoryView.php';

class AdminCategoryController
{
  private $authenticationService;
  private $adminRepository;

  public function __construct(AuthenticationService $authenticationService, AdminRepository $adminRepository)
  {
    $this->authenticationService = $authenticationService;
    $this->adminRepository = $adminRepository;
  }

  public function viewAction(): string {
    if ($this->authenticationService->isUserConnected() && $this->authenticationService->isAdmin()){
      if (isset($_POST['category']) && $_POST['category']!= " "){
        $this->adminRepository->addCategory($_POST['category']);
      }
      return buildAdminCategoryView();
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
