<?php
require_once __DIR__ . '/../view/buildSigninForm.php';

class UserSigninController
{
  private $authenticationService;
  private $userRepository;

  public function __construct(AuthenticationService $authenticationService, UserRepository $userRepository)
  {
    $this->authenticationService = $authenticationService;
    $this->userRepository = $userRepository;
  }

  public function signinAction(): string {
    $error = '';
    $values = [
      'firstName' => '',
      'lastName' => '',
      'username' => ''
    ];

    if ($this->authenticationService->isUserConnected()) {
      $this->redirectToHomepage();
    }
    if ($this->isSigninFormFilledAndValid()) {
      $firstName = htmlspecialchars($_POST['firstName']);
      $lastName = htmlspecialchars($_POST['lastName']);
      $username = htmlspecialchars($_POST['username']);
      $password = htmlspecialchars($_POST['password']);
      if (is_null($this->userRepository->getUserByUsername($username))) {
        $password_crypted  = password_hash($password, PASSWORD_BCRYPT);
        $this->userRepository->createUser($firstName, $lastName, $username, $password_crypted);
        $this->authenticationService->connectUser($this->userRepository->getUserId($username));
        $this->redirectToHomepage();
      } else {
        $values['firstName'] = $firstName;
        $values['lastName'] = $lastName;
        $values['username'] = $username;
        $error = 'Ce nom d\'utilisateur est déjà utilisé';
      }
    } elseif ($this->isOneOfTheFieldsMissing()) {
      $values['firstName'] = htmlspecialchars($_POST['firstName']);
      $values['lastName'] = htmlspecialchars($_POST['lastName']);
      $values['username'] = htmlspecialchars($_POST['username']);
      $error = 'Veuillez remplir tous les champs';
    }

    return buildSigninForm($values, $error);
  }

  private function isSigninFormFilledAndValid(): bool
  {
    return isset($_POST['firstName'], $_POST['lastName'], $_POST['username'], $_POST['password'])
      && $_POST['firstName'] !== ''
      && $_POST['lastName'] !== ''
      && $_POST['username'] !== ''
      && $_POST['password'] !== '';
  }

  private function isOneOfTheFieldsMissing(): bool
  {
    return (isset($_POST['firstName']) && $_POST['firstName'] === '')
      || (isset($_POST['lastName']) && $_POST['lastName'] === '')
      || (isset($_POST['username']) && $_POST['username'] === '')
      || (isset($_POST['password']) && $_POST['password'] === '');
  }

  private function redirectToHomepage(): void {
    header('Location: /projetWeb/src/user/');
  }
}
