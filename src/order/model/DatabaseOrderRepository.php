<?php
require_once __DIR__ . '/OrderRepository.php';
require_once __DIR__ . '/../../common/DatabaseClient.php';


class DatabaseOrderRepository implements OrderRepository{
    private $database;

    public function __construct(){
        $this->database = DatabaseClient::getDatabase();
    }

  public function getOrders($userId){
    $reponse = $this->database->prepare("SELECT id,date,total FROM commande where uid = ?");
    return $reponse->fetchAll(PDO::FETCH_OBJ);
  }
  
  public function getOrderInfo($orderId){
    $reponse = $this->database->query("SELECT a.title,a.price,c.quantity FROM lnk_commande_article c INNER JOIN article a ON c.aid=a.id  where c.cid = $orderId");
    return $reponse->fetchAll(PDO::FETCH_OBJ);
  }
}