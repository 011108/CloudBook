<?php
require_once 'Config.php';

class Category extends DB {
  private $Code = 0;
  private $Name = NULL;

  public function set($code, $name){
    $this->Code  = $code;
    $this->Name = $name;
  }
  
  public function Display_Ctg_Books($category_code){
      $query = $this->connect()->prepare(" select Book.* from Book join Category on Book.Category_id = Category.Code and Category.Code = :Category_Code ");
      $query->execute(array(':Category_Code' =>$category_code));
      $result = $query->fetchall(PDO::FETCH_ASSOC);
      return ($result);
  }
  
  public function count_category(){
    $query = $this->Connect()->prepare ("SELECT * FROM Category");
    $query->execute();
    $count=$query->rowCount();
    print $count;
  }
  
}
