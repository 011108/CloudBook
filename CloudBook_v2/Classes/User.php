<?php
require_once 'Config.php';

class User extends DB {
  private $Id;
  private $Username;
  private $Photo;
  private $Age;
  private $Password;
  private $Last_Apdate;

  public function set($Id, $Username, $Photo, $Age, $Password, $Last_Apdate){
     $this->Id = $Id;
     $this->Username = $Username;
     $this->Photo = $Photo;
     $this->Age = $Age;
     $this->Password = $Password;
     $this->Last_Apdate = $Last_Apdate;
  }
  
  public function display_user_id($Username){
    $query = $this->Connect()->prepare ("SELECT * FROM User WHERE Username = :user");
    $query->execute([':user'=>$Username]);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
  public function display_user_with_name($Username){
    $query = $this->Connect()->prepare ("SELECT * FROM User WHERE Username = :user");
    $query->execute([':user'=>$Username]);
    $result = $query->fetchall(PDO::FETCH_ASSOC);
    return $result;
  }
  
  public function display_user($Id){
    $query = $this->Connect()->prepare ("SELECT * FROM User WHERE Id = :id");
    $query->execute([':id'=>$Id]);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
  
  public function count_user(){
    $query = $this->Connect()->prepare ("SELECT Id FROM User");
    $query->execute();
    $count=$query->rowCount();
    return $count;
  }
  
  public function chang_username($Id, $Username){
    $query = $this->Connect()->prepare (" UPDATE User SET Username = :name where Id = :id");
    $query->execute([':name'=>$Username, ':id'=>$Id]);
  }
  public function chang_age($Id,  $Age){
    $query = $this->Connect()->prepare (" UPDATE User SET Age = :age where Id = :id");
    $query->execute([':age'=>$Age, ':id'=>$Id]);
  }
  
  public function chang_password($Id, $Password){
    $query = $this->Connect()->prepare (" UPDATE User SET Password =SHA1(:password) where Id = :id");
    $query->execute([':password'=>$Password, ':id'=>$Id]);
  }
  
  public function chang_photo($Id, $Photo){
    $statement = $this->Connect()->prepare("UPDATE User SET photo = :photo WHERE Id = :id "); 
    $statement->execute([':photo'=>$Photo, ':id'=>$Id]);
  }
  
  public function delete_account($Id){
    $query = $this->Connect()->prepare ("Delete from User where Id = :id");
    $query->execute([':id'=>$Id]);
  }
  
  public function logout(){
    //session_start();
    setcookie(session_name(), '', 100); 
    session_unset(); session_destroy();
    $_SESSION = array();
  }
  
  public function login($Username, $Password){
      $query =$this->Connect()->prepare("SELECT Username, Password  from User WHERE Username = :username ");
      $query->execute(array(':username' => $Username));
      $result = $query->fetchAll(PDO::FETCH_ASSOC);
  		$count= $query->rowCount();
  		if ($count > 0 && $result[0]['Password'] == sha1($Password)) {
  		  return true ;
  		}else {
  		  return false ;
  		}
  }
  
  public function signup($Username,  $Password){
    $query =$this->Connect()->prepare("SELECT Username from User WHERE Username = :username ");
    $query->execute(array(':username' => $Username));
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
		$count= $query->rowCount();
  	if ($count > 0 ) {
  	  return false;
  	}else {
  	  $query =$this->Connect()->prepare("INSERT INTO User (Username, Password, Last_Update) values (:username, SHA1(:password), :lastDate)");
      $query->execute(array(':username' => $Username, ':password'=>$Password, ':lastDate'=>date("y-m-d")));
      
      $query3=$this->Connect()->prepare("SELECT Id FROM User WHERE Username = :user");
      $query3->execute(array(':user'=>$Username));
      $result = $query3->fetch(PDO::FETCH_ASSOC);
      
      $query3=$this->Connect()->prepare("insert into Recite (Amount, User_Id, ReciteDate, PayDate) values(0, :id, 0000-00-00, :date)");
      $query3->execute(array(':id'=>$result['Id'], ':date'=>date("y-m-d")));
      return true;
  	}
  } 
}
