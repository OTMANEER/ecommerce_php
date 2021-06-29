<?php

class CommonComponents
{
  public static function render(string $component, $withNavbar = true,$moreHead="",$moreScripts="") {
    $head = self::htmlHeadComponent();
    $navbar = $withNavbar ? self::navbar() : '';
    $scripts = self::scripts();

    echo <<<HTML
      <!doctype html>
      <html lang="fr">
      <head>
        $head
        $moreHead
      </head>
      
      <body>
      
      $navbar
      
      <main role="main">
        $component
      </main>
      
      $scripts
      $moreScripts
      </body>
      </html>
HTML;
  }

  private static function htmlHeadComponent(): string
  {
    return <<<HTML
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      
      <title>Adidas</title>
      
      <link rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
HTML;
HTML;
  }

  private static function navbar(): string
  {
    return <<<HTML
      <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand mr-auto" href="/projetWeb/src/article/index.php">Accueil</a>
              <a class=" btn-special"> 15% <strong>OFF</strong> All Orders And Free Shipping</a>


  <a class="btn btn-outline-light" href="/projetWeb/src/order" id="cmdBtn">Mes commandes</a>
        <a class="btn btn-outline-light" href="/projetWeb/src/user/logout.php">se déconnecter</a>
      </nav>
HTML;
  }


  private static function scripts(): string
  {
    return <<<HTML
      <script
			  src="https://code.jquery.com/jquery-3.5.1.min.js"
			  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
			  crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
              integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
              integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
HTML;
  }
}
