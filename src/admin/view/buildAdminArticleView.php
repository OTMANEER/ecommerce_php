<?php

function buildAdminArticleView($categories){
    $renduHtml = <<<HTML
        <nav class="nav nav-pills" id="nav">
            <a class="nav-link active" href="/projetWeb/src/admin/">Ajouter un article</a>
            <a class="nav-link" href="/projetWeb/src/admin/category.php">Ajouter une catégorie</a>
        </nav>
        <div id="container">
        <form method = "POST" action=".">
            <div class="form-group">
                <label for="Nom">Nom</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <label for="Quantite">Quantité</label>
                <input type="number" class="form-control" name="quantity">
            </div>
            <div class="form-group">
                <label for="Price">Prix</label>
                <input type="number" class="form-control" name="price">
            </div>
            <div class="form-group">
                <label for="Categorie">Catégorie</label>
            <!-- CATEGORIE -->
            <select class="custom-select custom-select-lg mb-3" name="category">
    HTML;
    foreach($categories as $categorie){
        $renduHtml = $renduHtml . "<option value=\"$categorie->name\" >$categorie->name</option> ";
    }
              
   
    $renduHtml = $renduHtml. <<<HTML
            </select>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
        </div> <!-- On ferme le div container-->
    HTML;


    return $renduHtml;

}
