<?php

function buildSigninForm($values, string $error): string
{
  $errorAlert = '';
  if ($error !== '') {
    $errorAlert = "<div class=\"alert alert-danger mb-3\">$error</div>";
  }
  $firstName = $values['firstName'];
  $lastName = $values['lastName'];
  $username = $values['username'];
  return <<<HTML
   <div class="container">
    <div class="row justify-content-center" >
      <div class="col-lg-4 col-md-6 col-8 mx-auto my-5">
        <div class="card">
          <div class="card-body">
            $errorAlert
              
              <h2 class="text-center mb-5">Inscription</h2>
              
              <form action="" method="post">
                <div class="form-group">
                  <label for="firstName">prénom:</label>
                  <input type="text" name="firstName" id="firstName" value="$firstName" class="form-control" placeholder="Entrez votre prénom" required>
                </div>
                <div class="form-group">
                  <label for="lastName">nom:</label>
                  <input type="text" name="lastName" id="lastName" value="$lastName" class="form-control" placeholder="Entrez votre nom" required>
                </div>
                <div class="form-group">
                  <label for="username">mail :</label>
                  <input type="email" name="username" id="username" value="$username" class="form-control" placeholder="Entrez votre nom d'utilisateur" required>
                </div>
                <div class="form-group">
                  <label for="password">Mot de passe:</label>
                  <input type="password" name="password" class="form-control" placeholder="Entrez votre mot de passe" id="password" required>
                </div>
                
                <button type="submit" class="btn btn-dark">S'inscrire</button>
              </form>
          </div>
        </div>
        <hr>
        Vous avez déjà un compte? <a href="/projetWeb/src/user/index.php">connectez-vous</a>
      </div>
    </div>
</div>
    
HTML;
}
