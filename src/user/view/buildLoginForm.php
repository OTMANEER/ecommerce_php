<?php

function buildLoginForm(string $error): string
{
  $errorAlert = '';
  if ($error !== '') {
    $errorAlert = "<div class=\"alert alert-danger mb-3\">$error</div>";
  }
  return <<<HTML
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6 col-8 mx-auto my-5">
        <div class="card">
          <div class="card-body">
            $errorAlert
              
              <h2 class="text-center mb-5">Connexion</h2>
              
              <form action="" method="post">
                <div class="form-group">
                  <label for="username">mail:</label>
                  <input type="email" name="username" id="username" class="form-control" placeholder="Entrez votre nom d'utilisateur" required>
                </div>
                <div class="form-group">
                  <label for="password">Mot de passe:</label>
                  <input type="password" name="password" class="form-control" placeholder="Entrez votre mot de passe" id="password" required>
                </div>
                
                <button type="submit" class="btn btn-dark">Se connecter</button>
              </form>
          </div>
        </div>
        <hr>
        Vous n'avez pas encore de compte? <a href="/projetWeb/src/user/signin.php">inscrivez-vous</a>
      </div>
    </div>
</div>
    
HTML;
}
