<?php
require_once 'Config.php';

class Favorite extends DB {
  protected $userId;
  protected $bookCode;
  protected $date;

  public function count_fav($userId){
      $query = $this->Connect()->prepare ("SELECT bookCode FROM Favorites WHERE userId = :userId");
      $query->execute( array(':userId'=> $userId));
      $count=$query->rowCount();
      print $count;
  }

  public function display_Favorites($userId){
    $query = $this->Connect()->prepare ("SELECT Book.*, date FROM Book join Favorites on bookCode = Book.Code and userId = :userId ORDER BY `date` DESC");
    $query->execute(array(':userId'=> $userId));
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function add_fav($userId, $bookCode ){
    $query = $this->Connect()->prepare ("insert into Favorites(userId, bookCode, date) VALUES ($userId, $bookCode, :date)");
    $query->execute([':date' => date("y-m-d")]);
  }
  
  public function remove_fav($userId, $bookCode){
    $query = $this->Connect()->prepare (" Delete from Favorites WHERE bookCode = $bookCode and userId = $userId");
    $query->execute();
  }
  
  public function check_fav_book($userId, $bookCode){
    $query = $this->Connect()->prepare ("SELECT bookCode FROM Favorites where  userId = :userId");
    $query->execute(array(':userId'=> $userId));
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    for($i=0; $i<sizeof($result); $i++){
      if ($result[$i]['bookCode'] == $bookCode) {
        return true;
      }
    }
  }
}
