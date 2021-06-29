
<?php
const MAX = 10;

function buildArticleView($currentPage,$articles,$categories,$totalPages,$totalCart)
{
    $renduHtml = "";
    // On recupere les filtres choisis par l'utilisateur, pour les reafficher 
    $currentSearch = isset($_GET['search']) && $_GET['search'] != "" ? $_GET['search'] : "";
    $currentCategorie = isset($_GET['categorie']) ?  $_GET['categorie'] : "Toutes"; // Le filtre categorie
    $currentTriValue = isset($_GET['tri']) ?  $_GET['tri'] : "Aucun";  // Le filtre du currentTri choisi 
    /* le champ a afficher depend de la value reçue dans le GET*/
    $possibleTri = array(
      'priceUp' => 'Prix croissant',
      'priceDown' => 'Prix décroissant',
      'nameUp' => 'Nom croissant',
      'nameDown' => 'Nom décroisasnt',
      'Aucun' => 'Aucun'
    );
    $currentTri = $possibleTri[$currentTriValue];
    $renduHtml = $renduHtml. <<<HTML
    <div class="container-fluid">
    <div class="row">
          <div class="col-12">
              <div id="cart" class="float-right">
                        <a class="btn btn-outline-light" href="/projetWeb/src/cart"><i class="bi bi-cart-fill"></i></a>
                      <p id="cartNum">$totalCart </p>
                  </div>
            </div>
    HTML;
    $renduHtml = $renduHtml. <<<HTML
      <div class="col-12">
        <div class="row">
        <div class="col-3">    
          <div>
            <form method="GET" action="../article/">
              <!-- la barre de recherche-->
              <div class="form-group">
                <label for="Recherche">Recherche</label>
                <input type="text" class="form-control" name="search"  placeholder="Que recherchez-vous ..." value="$currentSearch">
                <button id="plus" type="button" class="btn btn-success my-3">Plus de filtres</button>
              </div>

          <!-- Div contenant les options de filtre supplémentaires  -->
          <div id="moreFilter">
              <label for="categorie">Catégorie</label>

              <!-- CATEGORIE -->
              <select class="custom-select custom-select-lg mb-3" name="categorie">
    HTML;
    if($currentCategorie == "Toutes"){
      $renduHtml = $renduHtml. "<option value=\"Toutes\" selected>Toutes</option>";
    }else{
      $renduHtml = $renduHtml. "<option value=\"Toutes\" >Toutes</option>";
    }
    foreach($categories as $categorie){
      
      if ($categorie->name === $currentCategorie){
        $renduHtml = $renduHtml . "<option value=\"$categorie->name\" selected>$categorie->name</option> ";
      }else{
        $renduHtml = $renduHtml . "<option value=\"$categorie->name\" >$categorie->name</option> ";
      }
    }
              
    
    $renduHtml = $renduHtml. <<<HTML
              </select>

              <label for="currentTri">Trier par </label>

              <!-- TRI -->
              <select class="custom-select custom-select-lg mb-3" name="tri">
              <option selected value ="$currentTriValue">$currentTri</option>

    HTML;
    foreach ($possibleTri as $key => $value){
      if ($key != $currentTriValue){
        $renduHtml = $renduHtml. "<option value=\"$key\">$value</option> ";
      }
    }
    $renduHtml = $renduHtml . <<<HTML
              </select>

              <label for="limite">Limitez le prix</label>

              <!-- LIMITE DE PRIX-->
              <div id="priceLimit">
                <input class="form-control my-2" type="number" name="min" step="10" value="0">
                <input class="form-control" type="number" name="max" step="10" value="1000">
              </div>

          </div>

          <button type="submit" class="btn btn-primary my-3">Rechercher!</button>
        </form>
      </div>
      <!--col-3-->
     </div>
    HTML;

  $previousPage = $currentPage -1;
  $nextPage = $currentPage +1;
  $count = 0;
 $renduHtml = $renduHtml.<<<HTML
      <div class="col-9">
        <div class="row">
HTML;

  foreach($articles as $article){
      $renduHtml = $renduHtml.<<<HTML
        <div class="col-3">
        <div class="card border-light" >
            <h5 class="card-title text-center">$article->title</h5>
            <img class="card-img-top" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/t-shirt.png" alt="" />
            <div id="info">
              <div class="card-body">
                  <p class="card-text">Prix : $article->price €</p>
              </div>
            <div class = "btnAdd">
            <button class="btn-add" onClick="addCart($article->id,'$article->title',$article->price)" >+</button>
            </div>
            </div>
        </div>
        </div>

      HTML;
      $count = $count +1; 
  }
  $renduHtml = $renduHtml."  </div></div>";

  $renduHtml = $renduHtml.<<<HTML
                <div class="col-12  my-3">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item"><a class="page-link" href="?page=$previousPage"><i class="bi bi-arrow-left"></i></a></li>
                            <li class="page-item"><a class="page-link" href=".">$currentPage</a></li>
                            <li class="page-item"><a class="page-link" href="?page=$nextPage"><i class="bi bi-arrow-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
                </div>
            <!--row-->  
         </div>
      <!--container-->
     </div>
  HTML;
  return $renduHtml;
}