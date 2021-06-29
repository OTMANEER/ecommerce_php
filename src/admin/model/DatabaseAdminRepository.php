<?php
require_once __DIR__ . '/AdminRepository.php';
require_once __DIR__ . '/../../common/DatabaseClient.php';


class DatabaseAdminRepository implements AdminRepository{
    private $database;

    public function __construct(){
        $this->database = DatabaseClient::getDatabase();
    }

    public function addArticle($article){
        $categorie = $article['category'];
        $response = $this->database->query("SELECT id FROM categorie WHERE name=\"$categorie\"");
        $articleId = $response->fetch(PDO::FETCH_OBJ);
        $articleId = $articleId->id;
        $response = $this->database->prepare("INSERT INTO article(title,description,price,quantity,cid) values(?,?,?,?,?)");
      //  print_r($article);
        $response->execute([$article['name'],"balbla",$article['price'],$article['quantity'],$articleId]);
       // echo "done";
    }

    public function addCategory($cartegory){
        $request = $this->database->prepare("INSERT INTO categorie(name) values(?)");
        $request->execute([$cartegory]);
    } 

  public function getCategories(){
    $reponse = $this->database->query("SELECT name FROM categorie");
    return $reponse->fetchAll(PDO::FETCH_OBJ);
  }
}