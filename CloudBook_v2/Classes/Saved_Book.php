<?php
require_once 'Config.php';

class Saved_Book extends DB {
  protected $User_Id;
  protected $Book_Code;
  protected $date;
  
  public function count_saved($User_Id){
      $query = $this->Connect()->prepare ("SELECT * FROM Saved_Books WHERE User_Id = :User_Id");
      $query->execute( array(':User_Id'=> $User_Id));
      $count=$query->rowCount();
      print $count;
  }
  
  public function display_saved_books($User_Id){
    $query = $this->Connect()->prepare ("SELECT Book.*, date FROM Book join Saved_Books on Book_Code = Book.Code and User_Id = :User_Id ORDER BY `date` DESC");
    $query->execute(array(':User_Id'=> $User_Id));
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function add_saved_book($User_Id, $Book_Code ){
    $query = $this->Connect()->prepare ("insert into Saved_Books(User_Id, Book_Code, date) VALUES ($User_Id, $Book_Code, :date )");
    $query->execute(array(':date'=> date("y-m-d")));
  }
  
  public function remove_saved_book($User_Id, $Book_Code){
    $query = $this->Connect()->prepare (" Delete from Saved_Books WHERE Book_Code = $Book_Code and User_Id = $User_Id ");
    $query->execute();
  }
  
  public function check_saved($User_Id, $Book_Code){
    $query = $this->Connect()->prepare ("SELECT Book_Code FROM Saved_Books where  User_Id = :User_Id");
    $query->execute(array(':User_Id'=> $User_Id));
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    for($i=0; $i<sizeof($result); $i++){
      if ($result[$i]['Book_Code'] == $Book_Code) {
        return true;
      }
    }
  }
  
}
