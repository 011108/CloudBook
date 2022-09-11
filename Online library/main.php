<?php
 session_start();
 require 'Config.php';
 $user_name = $_SESSION['user_name'] ;
 //"Mohammed_jabrallah090" ;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Cloud Book </title>
    <link rel="stylesheet" href="normalize.css" />
   <link rel="stylesheet" href="main.css?v=<?php echo time(); ?>" />
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
                  echo "<li><a href='Sign/signIn.php' class='aboutus'> Sign In </a></li>";
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
    <!-- Start Landing -->
    <div class="landing">
      <div class="container">
	    <h1>Cloud Book</h1>
	    <p>
	      Here you can found any book you need about any topic , art and historic ,etc .
	    </p>
        <form action="Searching.php" method="POST">
          <input type="search" placeholder="Search in Cloud Book " name="search" required/>
          <input type="submit" value="Search"  />
        </form>
      </div>
    </div>
    <!-- End Landing -->
    <!-- Start Articles -->
    <div class="recommended" id="recommended">
      <h2 class="main-title">Recommended</h2>
      <div class="container">
        
         <div class="box">
           <?php 
              $query = $db->prepare(" SELECT Title, Name, Code, Pages, `Publish-dat`, Cover, Category_id FROM Book, Author WHERE Author.Id= Book.Author_Id ORDER BY RAND() LIMIT 1"); 
              $query->execute();
              $result = $query->fetchAll(PDO::FETCH_ASSOC);
           
           ?>
           <?php echo "<img src='imgs/".$result[0]['Cover']."' width= '100' max-width= '100''>";?>
           <div class="content">
             <h4><?php echo $result[0]['Title'] ?></h4>
	           <div>Author : <?php echo $result[0]['Name']  ?></div>
	           <span> <?php echo $result[0]['Pages']  ?>  pages </span>|
	           <span> <?php echo $result[0]['Publish-dat']  ?> </span>|
	           <span>9801 Reading</span>
	         </div>
          <div class="info">
            <a href="Book_Review.php?Code=<?php echo $result[0]['Code'];?>">Open</a>
          </div>
      </div> 
      
      
         <div class="box">
           <?php 
              $query = $db->prepare(" SELECT Title, Name, Code, Pages, `Publish-dat`, Cover FROM Book, Author WHERE Author.Id= Book.Author_Id ORDER BY RAND() LIMIT 1"); 
              $query->execute();
              $result = $query->fetchAll(PDO::FETCH_ASSOC);
           ?>
           <?php echo "<img src='imgs/".$result[0]['Cover']."' width= '100' max-width= '100''>";?>
           <div class="content">
             <h4><?php echo $result[0]['Title'] ?></h4>
	           <div>Author : <?php echo $result[0]['Name']  ?></div>
	           <span> <?php echo $result[0]['Pages']  ?>  pages </span>|
	           <span> <?php echo $result[0]['Publish-dat']  ?> </span>|
	           <span>9801 Reading</span>
	         </div>
          <div class="info">
            <a href="Book_Review.php?Code=<?php echo $result[0]['Code'];?>">Open</a>
          </div>
      </div> 
         <div class="box">
           <?php 
              $query = $db->prepare(" SELECT Title, Name, Code, Pages, `Publish-dat`, Cover FROM Book, Author WHERE Author.Id= Book.Author_Id ORDER BY RAND() LIMIT 1"); 
              $query->execute();
              $result = $query->fetchAll(PDO::FETCH_ASSOC);
           ?>
           <?php echo "<img src='imgs/".$result[0]['Cover']."' width= '100' max-width= '100''>";?>
           <div class="content">
             <h4><?php echo $result[0]['Title'] ?></h4>
	           <div>Author : <?php echo $result[0]['Name']  ?></div>
	           <span> <?php echo $result[0]['Pages']  ?>  pages </span>|
	           <span> <?php echo $result[0]['Publish-dat']  ?> </span>|
	           <span>9801 Reading</span>
	         </div>
          <div class="info">
            <a href="Book_Review.php?Code=<?php echo $result[0]['Code'];?>">Open</a>
          </div>
      </div> 
         <div class="box">
           <?php 
              $query = $db->prepare(" SELECT Title, Name, Code, Pages, `Publish-dat`, Cover FROM Book, Author WHERE Author.Id= Book.Author_Id ORDER BY RAND() LIMIT 1"); 
              $query->execute();
              $result = $query->fetchAll(PDO::FETCH_ASSOC);
           ?>
           <?php echo "<img src='imgs/".$result[0]['Cover']."' width= '100' max-width= '100''>";?>
           <div class="content">
             <h4><?php echo $result[0]['Title'] ?></h4>
	           <div>Author : <?php echo $result[0]['Name']  ?></div>
	           <span> <?php echo $result[0]['Pages']  ?>  pages </span>|
	           <span> <?php echo $result[0]['Publish-dat']  ?> </span>|
	           <span>9801 Reading</span>
	         </div>
          <div class="info">
            <a href="Book_Review.php?Code=<?php echo $result[0]['Code'];?>">Open</a>
          </div>
      </div> 
         <div class="box">
           <?php 
              $query = $db->prepare(" SELECT Title, Name, Code, Pages, `Publish-dat`, Cover FROM Book, Author WHERE Author.Id= Book.Author_Id ORDER BY RAND() LIMIT 1"); 
              $query->execute();
              $result = $query->fetchAll(PDO::FETCH_ASSOC);
           ?>
           <?php echo "<img src='imgs/".$result[0]['Cover']."' width= '100' max-width= '100''>";?>
           <div class="content">
             <h4><?php echo $result[0]['Title'] ?></h4>
	           <div>Author : <?php echo $result[0]['Name']  ?></div>
	           <span> <?php echo $result[0]['Pages']  ?>  pages </span>|
	           <span> <?php echo $result[0]['Publish-dat']  ?> </span>|
	           <span>9801 Reading</span>
	         </div>
          <div class="info">
            <a href="Book_Review.php?Code=<?php echo $result[0]['Code'];?>">Open</a>
          </div>
      </div> 
         <div class="box">
           <?php 
              $query = $db->prepare(" SELECT Title, Name, Code, Pages, `Publish-dat`, Cover FROM Book, Author WHERE Author.Id= Book.Author_Id ORDER BY RAND() LIMIT 1"); 
              $query->execute();
              $result = $query->fetchAll(PDO::FETCH_ASSOC);
           ?>
           <?php echo "<img src='imgs/".$result[0]['Cover']."' width= '100' max-width= '100''>";?>
           <div class="content">
             <h4><?php echo $result[0]['Title'] ?></h4>
	           <div>Author : <?php echo $result[0]['Name']  ?></div>
	           <span> <?php echo $result[0]['Pages']  ?>  pages </span>|
	           <span> <?php echo $result[0]['Publish-dat']  ?> </span>|
	           <span>9801 Reading</span>
	         </div>
          <div class="info">
            <a href="Book_Review.php?Code=<?php echo $result[0]['Code'];?>">Open</a>
          </div>
      </div> 
         <div class="box">
           <?php 
              $query = $db->prepare(" SELECT Title, Name, Code, Pages, `Publish-dat`, Cover FROM Book, Author WHERE Author.Id= Book.Author_Id ORDER BY RAND() LIMIT 1"); 
              $query->execute();
              $result = $query->fetchAll(PDO::FETCH_ASSOC);
           ?>
           <?php echo "<img src='imgs/".$result[0]['Cover']."' width= '100' max-width= '100''>";?>
           <div class="content">
             <h4><?php echo $result[0]['Title'] ?></h4>
	           <div>Author : <?php echo $result[0]['Name']  ?></div>
	           <span> <?php echo $result[0]['Pages']  ?>  pages </span>|
	           <span> <?php echo $result[0]['Publish-dat']  ?> </span>|
	           <span>9801 Reading</span>
	         </div>
          <div class="info">
            <a href="Book_Review.php?Code=<?php echo $result[0]['Code'];?>">Open</a>
          </div>
      </div> 
         <div class="box">
           <?php 
              $query = $db->prepare(" SELECT Title, Name, Code, Pages, `Publish-dat`, Cover FROM Book, Author WHERE Author.Id= Book.Author_Id ORDER BY RAND() LIMIT 1"); 
              $query->execute();
              $result = $query->fetchAll(PDO::FETCH_ASSOC);
           ?>
           <?php echo "<img src='imgs/".$result[0]['Cover']."' width= '100' max-width= '100''>";?>
           <div class="content">
             <h4><?php echo $result[0]['Title'] ?></h4>
	           <div>Author : <?php echo $result[0]['Name']  ?></div>
	           <span> <?php echo $result[0]['Pages']  ?>  pages </span>|
	           <span> <?php echo $result[0]['Publish-dat']  ?> </span>|
	           <span>9801 Reading</span>
	         </div>
          <div class="info">
            <a href="Book_Review.php?Code=<?php echo $result[0]['Code'];?>">Open</a>
          </div>
      </div> 
         <div class="box">
           <?php 
              $query = $db->prepare(" SELECT Title, Name, Code, Pages, `Publish-dat`, Cover FROM Book, Author WHERE Author.Id= Book.Author_Id ORDER BY RAND() LIMIT 1"); 
              $query->execute();
              $result = $query->fetchAll(PDO::FETCH_ASSOC);
           ?>
           <?php echo "<img src='imgs/".$result[0]['Cover']."' width= '100' max-width= '100''>";?>
           <div class="content">
             <h4><?php echo $result[0]['Title'] ?></h4>
	           <div>Author : <?php echo $result[0]['Name']  ?></div>
	           <span> <?php echo $result[0]['Pages']  ?>  pages </span>|
	           <span> <?php echo $result[0]['Publish-dat']  ?> </span>|
	           <span>9801 Reading</span>
	         </div>
          <div class="info">
            <a href="Book_Review.php?Code=<?php echo $result[0]['Code'];?>">Open</a>
          </div>
      </div> 
      
      </div>
    </div>
    <div class="spikes"></div>
    <!-- End Articles -->
    <!-- start Articles two-->
    <div class="recommended" id="sicology">
      <h2 class="main-title">Programming</h2>
            <?php 
               $query = $db->prepare("SELECT Title, Author.Name, Pages, Book.Code, `Publish-dat`, Cover FROM Book, Category, Author WHERE Author.Id= Book.Author_Id AND Book.Category_id = Category.Code AND Category.Name= \"programming\" "); 
               $query->execute();
               $result = $query->fetchAll(PDO::FETCH_ASSOC);
               $countprograming = $query->rowCount();
           ?>
      <div class="container">
         <?php
          for($ii = 0; $ii < $countprograming; $ii++){
             echo "<div class='box' >";
                echo "<img src='imgs/".$result[$ii]['Cover']."' height : '97px' '>";
                echo "<div class='content' >";
                  echo "<h4>".$result[$ii]['Title']."</h4>";
                  echo "<div class='Author'>"."Author : " . $result[$ii]['Name']."</div>";
                  echo "<span>".$result[$ii]['Pages']."</span> pages "." |  ";
                  echo "<span>".$result[$ii]['Publish-dat']."</span>";
                echo "</div>";
                echo "<div class='info' >";
                 echo "<a  href='Book_Review.php?Code=".$result[$ii]['Code']."' > Open </a>";
              echo "</div>";
             echo "</div>";
           }
         ?>
      </div>
    </div>
    <!-- End Articles two -->
    <!-- Start Stats -->
    <div class="stats" id="stats">
    <h2>Stats</h2>

      <div class="container">

        <div class="box">
          <?php 
              $query = $db->prepare("select count(Code) from Book"); 
              $query->execute();
              $result = $query->fetchAll(PDO::FETCH_ASSOC);
           ?>
           <i class="fas fa-book fa-2x "></i>
           <span class="number" data-goal="150"><?php echo $result[0]['count(Code)'];?></span>
           <span class="text">Books</span>
        </div>

        <div class="box">
          <?php 
              $query = $db->prepare("select count(Id) from User"); 
              $query->execute();
              $result = $query->fetchAll(PDO::FETCH_ASSOC);
           ?>
          <i class="far fa-user fa-2x fa-fw"></i>
          <span class="number" data-goal="135"><?php echo $result[0]['count(Id)'];?></span>
          <span class="text">Users</span>
        </div>
        
        <div class="box">
          <?php 
              $query = $db->prepare("select count(Code) from Category"); 
              $query->execute();
              $result = $query->fetchAll(PDO::FETCH_ASSOC);
            
           ?>
          <i class="fas fa-list fa-2x fa-fw"></i>
          <span class="number" data-goal="135"><?php echo $result[0]['count(Code)'];?></span>
          <span class="text">Categories</span>
        </div>

      </div>

    </div>

    <!-- End Stats -->
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
         ?>
      </div>
       <p class="copyright">Made With ♡ By <span> Jabrallah </span> &copy; <?php echo " 20".date(  "y" )?></p>
     </div>
    <!-- End Footer -->
    <script >
    </script>
  </body>
  </html>