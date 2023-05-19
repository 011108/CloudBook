<?php
require_once 'Config.php';

class Author extends DB {
  private $Id;
  private $Name;
  
  public function __set($id, $name){
    $this->Id   = $id;
    $this->Name = $name;
  }
  
  public function Book_Author($book){
      $query = $this->connect()->prepare(" SELECT Name FROM Author JOIN Book ON Book.Author_Id = Id AND Book.Code = :Book_Code");
      $query->execute(array(':Book_Code' =>$book));
      $result = $query->fetchColumn();
      return $result;
  }
}
