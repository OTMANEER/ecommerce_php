<?php
require_once __DIR__ . '/ArticleRepository.php';
require_once __DIR__ . '/../../common/DatabaseClient.php';


class DatabaseArticleRepository implements ArticleRepository
{
  private $database;
  private $max = 10;
  private $maxPrice = 1000;
  public function __construct()
  {
    $this->database = DatabaseClient::getDatabase();
  }

  public function getArticles($begin,$filter=null) 
  {
    $sqlQuery = "WHERE 1=1";
    
    if (!empty($filter)){
      if (isset($filter['search'])){
        $search = $filter['search'];
        $sqlQuery = $sqlQuery . " AND title like '". $search ."%' ";
      }
      if (isset($filter['categorie'])){
        $categorie = $filter['categorie'];
        $sqlQuery = $sqlQuery . " AND article.cid = (select id FROM categorie WHERE name= '" .$categorie. "')" ;
      }
      
    
      if ($filter['min'] >= 0 && $filter['max']>= 0){
        $min = $filter['min'];
        $max = $filter['max'];
      }else{
        $min = 0;
        $max = $maxPrice;
      }
      $sqlQuery = $sqlQuery. " AND price BETWEEN $min AND $max ";

      if (isset($filter['tri'])){
        switch($filter['tri']){
          case 'nameUp':
            $sqlQuery = $sqlQuery . " ORDER BY title ASC";
            break;
          case 'nameDown':
            $sqlQuery = $sqlQuery . " ORDER BY title DESC";
            break;
          case 'priceUp':
            $sqlQuery = $sqlQuery . " ORDER BY price ASC";
            break;
          case 'priceDown':
            $sqlQuery = $sqlQuery . " ORDER BY price DESC";
            break;
        } 
      }
    }

    $finalSqlQuery = "SELECT * FROM article ".$sqlQuery." LIMIT $begin,$this->max ";
    
    $reponse = $this->database->query($finalSqlQuery);
    $res = $reponse->fetchAll(PDO::FETCH_OBJ);
    return $res;
  }
  
  public function getCategories(){
    $reponse = $this->database->query("SELECT name FROM categorie");
    return $reponse->fetchAll(PDO::FETCH_OBJ);
  }

  public function getTotalPages()
  {
    $reponse = $this->database->query("SELECT count(*) FROM article ");
    return $reponse->fetch();
  }
}
