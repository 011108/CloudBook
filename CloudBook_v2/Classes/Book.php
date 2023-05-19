<?php
require_once 'Config.php';

class Book extends DB {
  private $Code;
  private $Title;
  private $Pages;
  private $Publish_dat;
  private $Category_id;
  private $Author_Id;
  private $Cover;
  private $Link;

  
  public function set($code, $title, $page, $publish, $Category, $author, $cover, $link ){
    $this->Code  = $code;
    $this->Title = $title;
    $this->Pages = $page;
    $this->Publish_dat = $publish;
    $this->Category_id = $category;
    $this->Author_Id = $author;
    $this->Author_Id = $author;
    $this->Cover = $cover;
    $this->Link = $link;
  }
  
  public function count_books(){
    $query = $this->Connect()->prepare ("SELECT * FROM Book");
    $query->execute();
    $count=$query->rowCount();
    return $count;
  }
  
  public function category_of_book($book){
    $query = $this->Connect()->prepare (" SELECT Category.* FROM Category join Book ON Book.Category_id = Category.Code AND Book.Code = :Book_Code");
    $query->execute( array(':Book_Code' => $book));
    $result = $query->fetchAll (PDO::FETCH_ASSOC );
    return $result;
  }
  
  public function search_book($book_title){
    #do not enter space between % and % 
     $query = $this->Connect()->prepare (" SELECT Book.* FROM Book WHERE Book.Title LIKE '%$book_title%' ");
     $query->execute();
     $result = $query->fetchAll(PDO::FETCH_ASSOC );
     return $result;
  }
  
  public function display_random_books($num){
    $query = $this->Connect()->prepare(" SELECT Book.* FROM Book ORDER BY RAND() LIMIT $num"); 
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  public function display_book($code){
    $query = $this->Connect()->prepare(" SELECT * FROM Book WHERE Code = :code"); 
    $query->execute([':code'=>$code]);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
  public function upload($pass){
    $query = $this->Connect()->prepare("INSERT INTO `Book` (`Title`, `Pages`, `Publish-dat`, `Code`, `Category_id`, `Author_Id`, `Cover`, `Link`, `Pass`) VALUES ('Test ', '900', '2015', NULL, '2', '17', '', '', :pass)");
    $query->execute([':pass'=>$pass ]);
    
  }
  
}
