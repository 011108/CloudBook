<?php 
session_start();
 $user_name = $_SESSION['user_name'];
 //"Mohammed_jabrallah090" ;
 require 'Config.php';

    $search = $_POST['search'];
    $query= $db->prepare("SELECT Title, Author.Name, Pages, `Publish-dat`, Cover, Book.Code AS 'Book_Code', Category.Code, Category_id FROM Book, Category, Author WHERE Author.Id= Book.Author_Id AND Book.Category_id = Category.Code AND Title LIKE '%$search%'"); 
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $count = $query->rowCount();
 /* echo '<pre>';
    print_r($result);
  echo'</pre>';*/
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Search Result</title>
    <link rel="stylesheet" href="normalize.css" />
   <link rel="stylesheet" href="Searching_style.css?v=<?php echo time(); ?> " /> 
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
         <?php
             if ($count) {
               for($i =0 ; $i < $count ; $i+=1){
                echo "<div class='Main_Book' >";
                echo "<img src='imgs/".$result[$i]['Cover']."' width= '120px' max-width= '189px''>";
                echo "<div class='content' >";
                  echo "<h2>".$result[$i]['Title']."</h2>";
                  echo "<div class='Author'>"."Author : " . $result[$i]['Name']."</div>";
                  echo "<span>".$result[$i]['Pages']."</span> pages "." |  ";
                  echo "<span>".$result[$i]['Publish-dat']."</span>";
                  echo "<div class='ReadBott'  >\n";
                    echo "<a href='Book_Review.php?Code=".$result[$i]['Book_Code']."' style=' background-color: #2196f3; color: white; padding: 5px; margin-right: 10px; ' > Open </a>";
                  echo "</div>";
                echo "</div>";
              echo "</div>";
             }
               echo "<center>"."<h3 class='title'>"."Similar Books"."</h3>"."</center>";
                // query for similar books
                    $query2= $db->prepare("SELECT Title, Author.Name, Pages, `Publish-dat`, Cover, Category_id, Book.Code AS 'Book_Code' FROM Book, Category, Author WHERE Author.Id= Book.Author_Id AND Book.Category_id = Category.Code AND Category_id =". $result[0]['Code']); 
                    $query2->execute();
                    $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                    $countsimilar = $query2->rowCount();
             }else {
               echo "<center>"."<h3 class='error'>"."Not Found"."</h3>"."</center>";
               echo "<hr>";
               echo "<center>"."<h3 class='title'>"."Other Books"."</h3>"."</center>";
               //query for other books 
               $query3 = $db->prepare("SELECT Title, Name, Pages, `Publish-dat`, Book.Code AS 'Book_Code', Cover FROM Book, Author WHERE Author.Id= Book.Author_Id ORDER BY RAND() LIMIT 8"); 
               $query3->execute();
               $result3 = $query3->fetchAll(PDO::FETCH_ASSOC);
             
               
             }
          ?>
	    </div>
     <!--End Main Boxe-->
     <!--Strt Similar-->
     <div class="Similar">
       <div class="container">
        <?php
        if ($count) {
           for($ii = 0; $ii < $countsimilar; $ii++){
             echo "<a href='Book_Review.php?Code=".$result2[$ii]['Book_Code']."'><div class='similar_book'>";
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
        }else {
           for($iii = 0; $iii < 8; $iii++){
            echo "<a href='Book_Review.php?Code=".$result3[$iii]['Book_Code']."'><div class='similar_book'>";
                echo "<img src='imgs/".$result3[$iii]['Cover']."' height : '97px' '>";
                echo "<div class='content' >";
                  echo "<h4 style=' color: black; '>".$result3[$iii]['Title']."</h4>";
                  echo "<div style=' color: black;' class='Author'>"."Author : " ."<span style=' color: #2196f3; '>". $result3[$iii]['Name']."</span>"."</div>";
                  echo "<span style=' color: #2196f3; ' >".$result3[$iii]['Pages']."</span><span style=' color: black; '> pages </span> "." |  ";
                  echo "<span style=' color: #2196f3; ' >".$result3[$iii]['Publish-dat']."</span>";
                echo "</div>";
              echo "</div>";
            echo "</a>"; 
             
           }
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