
<?php
require_once __DIR__ . '/../view/buildAdminArticleView.php';

class AdminArticleController
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
      /*On verifie qu'il a bien rentré les données demandées */
    if (isset($_POST['name'],$_POST['quantity'],$_POST['category'],$_POST['price']) && $_POST['name']!="" && $_POST['quantity']!= "" && $_POST['category']!="" && $_POST['price']!="" ){
      $article = array(
        "name" => $_POST['name'],
        "quantity" => $_POST['quantity'],
        "price" => $_POST['price'],
        "category" => $_POST['category']
      );
      $this->adminRepository->addArticle($article);
    }
      return buildAdminArticleView($this->adminRepository->getCategories());
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
