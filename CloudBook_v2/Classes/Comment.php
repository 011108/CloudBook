<?php
require_once 'Config.php';

class Comment extends DB {
  private $Id;
  private $User_Id ;
  private $Book_Code;
  private $Content;
  private $Date;
  
  public function count_review($Code, $type){
    if ($type == 'U') {
        $query = $this->Connect()->prepare ("SELECT * FROM Comment WHERE User_Id = :User_Id");
        $query->execute( array(':User_Id'=> $Code));
        $count=$query->rowCount();
        return  $count;
    }elseif ($type == 'B') {
        $query = $this->Connect()->prepare ("SELECT * FROM Comment WHERE Book_Code = :Book_Code");
        $query->execute( array(':Book_Code' => $Code));
        $count=$query->rowCount();
        return  $count;
    }
  }
  
  //only the conts on book 
  public function display_review($Code){
    $query = $this->Connect()->prepare ("SELECT Comment.*, User.Id as user_id, User.photo, User.Username FROM `Comment` join User on User_Id = User.Id and Book_Code =:code");
    $query->execute( array(':code'=> $Code));
    $result= $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  
  //user comments
  public function display_review_user($User_Id){
    $query = $this->Connect()->prepare ("SELECT Comment.*, Cover, Book.Code, Username, User.Id as user_id, photo FROM Comment join User on User_Id = :User_Id and User_Id = User.Id join Book ON Book.Code=Book_Code");
    $query->execute( array(':User_Id'=>$User_Id));
    $result= $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  
  public function add_comment($UserId, $BookCode, $content ){
    $query = $this->Connect()->prepare ("insert into Comment(User_Id, Book_Code, Content, Comment.Date) VALUES ($UserId, $BookCode, '$content', current_date ) ");
    $query->execute();
  }
  
  public function remove_comment($Id){
    $query = $this->Connect()->prepare (" Delete from Comment WHERE Id = $Id ");
    $query->execute();
  }
}
