<?php
require_once __DIR__ . '/CartRepository.php';
require_once __DIR__ . '/../../common/DatabaseClient.php';



class DatabaseCartRepository implements CartRepository
{
  private $database;
  public function __construct()
  {
    $this->database = DatabaseClient::getDatabase();
  }

  public function updateArticles($articles){
      foreach ($articles as $article){
        print_r ($article);
        $res = $this->database->prepare("UPDATE article SET quantity = quantity - ? WHERE id = ? ");
        $res->execute([$article['quantity'],$article['id']]);
      }
  }

 public function addCommand($articles,$userId,$totalPrice){
   
    $this->database->query("start transaction");
    $this->database->query("INSERT INTO commande(uid,total) values($userId,$totalPrice)");
    $lastID = $this->database->lastInsertId();
   foreach($articles as $article){
      $articleId = $article['id'];
      $articleQuantity = $article['quantity'];
      $this->database->query("INSERT INTO lnk_commande_article values($lastID,$articleId,$articleQuantity)");
   }
    $this->database->query("commit");
 }


}