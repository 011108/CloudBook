<?php 
 session_start();
 require 'Config.php';
  
 $user_name = $_SESSION['user_name'];
 //"Mohammed_jabrallah090" ;
 //echo $_SESSION['user_name'];
 
  //ACTIV USER 
 if ($user_name) { 
   $activUser= $db->prepare("SELECT Id FROM User WHERE Username = '$user_name'");
   $activUser->execute();
   $ActivuserData = $activUser->fetchAll(PDO::FETCH_ASSOC);
   $userId = $ActivuserData[0]['Id'];
 }
 
 $targetBook = $_GET['Code'];
 $query = $db->prepare(" SELECT Title, Author.Name, Book.Code, Pages, `Publish-dat`, Cover, Category_id, Category.Code FROM Book, Author, Category WHERE Author.Id= Book.Author_Id AND Category_id = Category.Code AND Book.Code = $targetBook"); 
 $query->execute();
 $result = $query->fetchAll(PDO::FETCH_ASSOC);

/* echo '<pre>';
    print_r($result);
  echo'</pre>';
  */
 if ($_SERVER['REQUEST_METHOD']=="GET") {
   if(isset($_GET['submit'])){
     if(!empty($user_name)){
       $content_comment = $_GET['comment'];
       $save_comment = $db->prepare("INSERT INTO Comment (USER_ID, Book_Code, Content) VALUES ( $userId, $targetBook, '$content_comment' )");
       $save_comment->execute();
     }
   }
 }
if ($user_name){ 
 $querytosavebook = $db->prepare("INSERT INTO Saved_Books ( User_Id, Book_Code) values ($userId, $targetBook)"); 
 $querytosavebook->execute();
}
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Reviews </title>
    <link rel="stylesheet" href="normalize.css" />
   <link rel="stylesheet" href="Book_Review_Style.css?v=<?php echo time(); ?> " /> 
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/all.min.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&display=swap" rel="stylesheet" />
  </head>
  <body>
     <!-- Start Header -->
     <div class="header" id="header">
	   <div class="container">
         <a href="main.php" class="logo">Cloud Book</a>
           <ul class="main-nav">
             <?php 
               if (empty($user_name)) {
                  echo "<li><a href='Sign/signIn.php' class='aboutus' color='white' > Sign In </a></li>";
               }else {
                $sql = $db->prepare("SELECT Photo FROM User WHERE Username ='$user_name'");
                $sql->execute();
                $user_result = $sql->fetchAll(PDO::FETCH_ASSOC);
                 echo "<li>";
                 if (empty($user_result[0]['Photo'])) {
                   echo "<a href='#'><img src='imgs/USER_IMGS/AltUser.png' style=' width : 40px; border-radius: 50%; '></a>";
                 }else {
                 echo "<a href='#'><img src='imgs/USER_IMGS/".$user_result[0]['Photo']."' style=' width : 40px; border-radius: 50%; '></a>";
                 }
                   echo "<div class='mega-menu'>";
                     echo "<ul class='links'>";
                       echo "<li><a href='main.php'  class='activ' >Home</a></li>";
                       echo "<li><a href='myAcount.php' >My Account</a></li>";
                       echo "<li><a href='MyLibrary.php'   >Liberary</a></li>";
                       echo "<li><a href='user_setting.php'  >Settings</a></li>";
                       echo "<li><a href='Sign/signIn.php' >Log out</a></li>";
                     echo "<ul class='links'>";
                   echo "</div>";
                 echo "</li>";
               }
             ?>
        </ul>
     </div>
   </div>
     <!-- End Header -->
     <!--Start Main Boxe-->
      <div class="container">
        <div class="Main_Book">
	        <?php echo "<img src='imgs/".$result[0]['Cover']. "'width: '120px' height:'189' '/>"  ?>
	         <div class="content">
	           <h2><?php echo $result[0]['Title']?></h2>
	           <div class="Author">Author :<span>  <?php echo $result[0]['Name']  ?> </span></div>
	           <span>  <?php echo $result[0]['Pages']  ?> </span> pages
	           <span> | <?php echo $result[0]['Publish-dat']  ?>  </span>
	           <div class="ReadBott">
	               <input type="button" value="Read" >
	               <a style=' background-color: #2196f3; color: white; padding: 1px; margin-right: 10px; '  href="Book_Review.php?Code=<?php echo $targetBook?>">Save </a>
	           </div>
	       </div>
	     </div>
	   </div>
     <!--End Main Boxe-->
     <!-- Start Reviews -->
            
             <?php 
             //query for comment 
             $Comment_query = $db->prepare("SELECT Content, date, COUNT(Comment.Id),  Username, Photo FROM Comment, User WHERE User_Id = User.Id AND Book_Code= $targetBook");
             $Comment_query->execute();
             $Comment_result = $Comment_query->fetchAll(PDO::FETCH_ASSOC);
             /*echo '<pre>';
              print_r($Comment_result);
            echo'</pre>';*/
             ?>
             <div class="reviews">
                 <center><h3 class="title">Reviews ( <?php echo $Comment_result[0]['COUNT(Comment.Id)']?> )</h3></center>
                 <div class="container">
                 <?php 
                   
                 ?>
                 <form action="Book_Review.php" method="GET" >
                   <center>
                     <textarea required name="comment"  placeholder="what is your opinion on this book in 500 character"></textarea><br>
                     <input type="submit" name="submit" value="ADD" style="padding-left: 10px; padding-right: 10px; color: white; background-color: #2196f3;  border: 1px solid white; border-radius: 5px;">
                    <!-- <a style=" padding-left: 10px; padding-right: 10px; color: white; background-color: #2196f3;  border: 1px solid white; border-radius: 5px;" href="Book_Review.php?Code&user=<?php //echo $userId?>">ADD</a>-->
                   </center> 
                 </form>
                 
                 <div class="comments">
                   <?php
                     for($c = 0; $c < $Comment_result[0]['COUNT(Comment.Id)']; $c++){
                       echo "<div>";
                         echo "<img src='imgs/USER_IMGS/".$Comment_result[$c]['Photo']."' ' width: '30px''>";
                         echo "<a href='myAcount.php?Username=".$Comment_result[$c]['Username']."'>".$Comment_result[$c]['Username']."</a><br>";
                         echo "<span >".$Comment_result[$c]['date']."</span>";
                         echo "<p>".$Comment_result[$c]['Content']."</p>";
                       echo "</div>";
                     }
                   ?>
                 </div>
                 </div>
               </div>
     <!-- End Reviews -->
     <!--Strt Similar-->
     <div class="Similar">
       <center><h3 class="title">Similar Books</h3></center>
       <div class="container">
         
         <!--query2 for similar -->
         <?php
              $query2= $db->prepare("SELECT Title, Author.Name, Pages, `Publish-dat`, Cover, Book.Code, Category_id FROM Book, Category, Author WHERE Author.Id= Book.Author_Id AND Book.Category_id = Category.Code AND Category_id =". $result[0]['Code']); 
             $query2->execute();
             $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);
             $countsimilar = $query2->rowCount();
         //loop for similars
         for($ii = 0; $ii < $countsimilar; $ii++){
             echo "<a href='Book_Review.php?Code=".$result2[$ii]['Code']."'><div class='similar_book'>";
                echo "<img src='imgs/".$result2[$ii]['Cover']."' height : '97px' '>";
                echo "<div class='content' >";
                  echo "<h4 style=' color: black; '>".$result2[$ii]['Title']."</h4>";
                  echo "<div style=' color: black;' class='Author'>"."Author : " ."<span style=' color: #2196f3; '>". $result2[$ii]['Name']."</span>"."</div>";
                  echo "<span style=' color: #2196f3; ' >".$result2[$ii]['Pages']."</span><span style=' color: black; '> pages </span> "." |  ";
                  echo "<span style=' color: #2196f3; ' >".$result2[$ii]['Publish-dat']."</span>";
                echo "</div>";
              echo "</div>";
            echo "</a>";
              
           }
         ?>
       </div>
     </div>
     <!--End Similar-->
     <!-- Start Footer -->
     <div class="footer" id="footer" >
      <div class="container">
        <div class="box">
          <h3>Cloud Book</h3>
          <ul class="social">
            <li>
              <a href="#" class="facebook">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li>
              <a href="#" class="twitter">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li>
              <a href="#" class="youtube">
                <i class="fab fa-youtube"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="box">
          <ul class="links">
            <li><a href="#">Property rights</a></li>
            <li><a href="#">About the library</a></li>
            <li><a href="#">Donate to the library</a></li>
          </ul>
        </div>
        <div class="paragraph">
         <p style="color: #b9b9b9;">
             Intellectual property is reserved for the authors mentioned on the books and the library is not responsible for the authors' ideas Old and forgotten books that have become in the past are published to preserve the Arab and Islamic heritage
         </p>
        </div>
      </div>
       <p class="copyright">Made With ♡ By <span> Jabrallah </span> &copy; <?php echo " 20".date(  "y" )?></p>
     </div>
     <!-- End Footer -->
  </body>
</html>