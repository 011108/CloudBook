<?php
require_once 'Config.php';

class Recite extends DB {
  private $Code;
  private $Amount;
  private $Rdate;
  private $User_Id;

  public function user_recite($User_Id){
    $query = $this->Connect()->prepare (" SELECT Recite.* FROM Recite join User on User.Id = Recite.User_Id and User.Id = :user");
    $query->execute (['user' => $User_Id]);
    $result = $query->fetchAll(PDO::FETCH_ASSOC );
    return $result;
  }
  
  public function payed_user($User_Id){
    $query = $this->Connect()->prepare ("UPDATE Recite SET Amount = 0, PayDate = :date where User_Id = :id ");
    $query->execute ([':date' => date("y-m-d"), ':id' => $User_Id ]);
  }
  
}
