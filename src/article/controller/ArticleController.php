
<?php
require_once __DIR__ . '/../view/buildArticleView.php';

class ArticleController
{
  private $authenticationService;
  private $articleRepository;

  public function __construct(AuthenticationService $authenticationService, ArticleRepository $articleRepository)
  {
    $this->authenticationService = $authenticationService;
    $this->articleRepository = $articleRepository;
  }

  public function viewAction($begin,$filter,$currentPage): string {

    
    if (isset($_POST['articleID'],$_POST['articleTitle'],$_POST['articlePrice'])){
      $this->authenticationService->addToCart($_POST['articleID'],$_POST['articleTitle'],$_POST['articlePrice']);
    }
    if ($this->authenticationService->isAdmin()){
      $this->redirectToAdminpage(); 
    }else{
      return buildArticleView($currentPage,$this->articleRepository->getArticles($begin,$filter),$this->articleRepository->getCategories(),$this->articleRepository->getTotalPages(),$this->authenticationService->cartSize());
    }
  }

  public function getAuthenticationService(){
    return $this->authenticationService;
  }

  private function redirectToAdminpage(): void {
      header('Location: /projetWeb/src/admin/');
  }

}
