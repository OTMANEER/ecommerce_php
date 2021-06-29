
<?php

function buildAdminCategoryView(){

    $renduHTML = <<<HTML
        <nav class="nav nav-pills" id="nav">
            <a class="nav-link " href="/projetWeb/src/admin/">Ajouter un article</a>
            <a class="nav-link active" href="/projetWeb/src/admin/category.php">Ajouter une catégorie</a>
        </nav>
        <div id="container">
        <form method="POST" action="category.php">
            <div class="form-group" id="categorieID">
                <label for="category">Nom de la catégorie</label>
                <input type="text" class="form-control" name="category" placeholder="chaussettes par exemple...">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
        </div>
        HTML;

    return $renduHTML;

}
