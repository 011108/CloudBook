<?php 
 session_start();
 require 'Config.php';
  
 $user_name = $_SESSION['user_name'];
 //"Mohammed_jabrallah090" ;
 $vesitorUser = $_GET['Username'];
 
 //Activ user 
   $activUser= $db->prepare("SELECT Id, Photo FROM User WHERE Username = '$user_name'");
   $activUser->execute();
   $ActivuserData = $activUser->fetchAll(PDO::FETCH_ASSOC);
   $userId = $ActivuserData[0]['Id'];
 
 if ($vesitorUser && $user_name) {
   //Visitors 
   $sql = $db->prepare("SELECT Username, Photo FROM User WHERE Username = '$vesitorUser'");
   $sql->execute();
   $result = $sql->fetchAll(PDO::FETCH_ASSOC);
  
   $sql2 = $db->prepare("select Cover, Username from Book, User, Reded_Books where Id = User_Id AND Code = Book_Code And Username = '$vesitorUser'");
   $sql2->execute();
   $result2 = $sql2->fetchAll(PDO::FETCH_ASSOC);
   $numOfBooks = $sql2->rowCount();
   
   $sql3 = $db->prepare("SELECT Content, date, COUNT(Comment.Id),  Username, Photo FROM Comment, User WHERE User_Id = User.Id AND Username='$vesitorUser'");
   $sql3->execute();
   $result3 = $sql3->fetchAll(PDO::FETCH_ASSOC);

 }elseif(empty($vesitorUser)){
   //original User
   $sql = $db->prepare("SELECT Username, Photo FROM User WHERE Username = '$user_name'");
   $sql->execute();
   $result = $sql->fetchAll(PDO::FETCH_ASSOC);
  
   $sql2 = $db->prepare("select Code, Cover, Username from Book, User, Reded_Books where Id = User_Id AND Code = Book_Code And Username = '$user_name'");
   $sql2->execute();
   $result2 = $sql2->fetchAll(PDO::FETCH_ASSOC);
   $numOfBooks = $sql2->rowCount();

   $sql3 = $db->prepare("SELECT Content, date, COUNT(Comment.Id),  Username, Photo FROM Comment, User WHERE User_Id = User.Id AND Username='$user_name'");
   $sql3->execute();
   $result3 = $sql3->fetchAll(PDO::FETCH_ASSOC);
   
    
 }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> My Account </title>
    <link rel="stylesheet" href="normalize.css" />
    <link rel="stylesheet" href="myAcount.css" >
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
             <li>
               <?php 
                 if (empty($ActivuserData[0]['Photo'])) {
                   echo "<a href='#'><img src='imgs/USER_IMGS/AltUser.png' style=' width : 40px; border-radius: 50%; '></a>";
                 }else {
                 echo "<a href='#'><img src='imgs/USER_IMGS/".$ActivuserData[0]['Photo']."' style=' width : 40px; border-radius: 50%; '></a>";
                 }
               ?>
		            <div class="mega-menu">
		        	   <ul class="links">
	  	            <li>
                   <a href="main.php">Home</a>
		            </li>
	          	    <li>
	     	          <a href="myAcount.php"  class="activ" >My Account</a>
                </li>
	       	        <li>
		      <a href="MyLibrary.php" >My Liberary</a>
			  </li>
         	        <li>
		      <a href="user_setting.php"> Settings </a>
		      </li>
    	    	      <li>
		      <a href="Sign/signIn.php"> Log Out </a>
		      </li>
			          </ul>
	          </div>
	          </li>
           </ul>
         </div>
       </div>
       <!-- End Header -->
       
       <!--Start body-->
       <div class="body" >
         <div class="container" >
           <div class="parent" >
             <center>
               <?php 
                 if (empty($ActivuserData[0]['Photo'])) {
                   echo "<img src='imgs/USER_IMGS/AltUser.png' Alt='user' class='user' >";
                 }else {
                   echo "<img src='imgs/USER_IMGS/".$ActivuserData[0]['Photo']."' alt='user' class='user'><br>";
                 }
               ?>
               <h5><?php echo $result[0]['Username']?></h5>
             </center>
             <div class="intersting" >
               <div class="f1" >
                 <center>Interesting</center>
               </div>
               <div class="f2" >
                 History 
               </div>
               <div class="f3" >
                 geographic
               </div>
               <div class="f4" >
                 Programming 
               </div>
               <div class="f5" >
                 mathematics
               </div>
             </div>
               <div class="books">
                 <center><h3 class="title">Books he finished ( <?php echo $numOfBooks?> )</h3></center>
                 <div class="pictures">
                   <?php
                     for($i = 0; $i < $numOfBooks; $i++){
                       echo "<a  href='Book_Review.php?Code=".$result2[$i]['Code']."'><img src='imgs/".$result2[$i]['Cover']."'/></a>";
                     }
                   ?>
                  </div>
               </div>
               <div class="reviews">
                 <center><h3 class="title">Reviews ( <?php echo $result3[0]['COUNT(Comment.Id)']?> )</h3></center>
                 <div class="comments">
                   <?php
                     for($c = 0; $c < $result3[0]['COUNT(Comment.Id)']; $c++){
                       echo "<div>";
                         echo "<img style='width: 30px; border-radius: 50%; ' ' src='imgs/USER_IMGS/".$result[$c]['Photo']."'>";
                         echo "<a style=' position: relative; bottom: 12px; left: 4px; '>".$result3[$c]['Username']."</a><br>";
                         echo "<span style='font-size: 12px; position: relative; left: 35px; bottom: 10px;'>".$result3[$c]['date']."</span>";
                         echo "<p style='margin: 0px 10px 0px 10px;'>".$result3[$c]['Content']."</p>";
                       echo "</div>";
                     }
                   ?>
                 </div>
               </div>
               <div class="edit">
                 <center>
                   <a href="user_setting.php">Edit Account</a>
                 </center>
               </div>
           </div>
         </div>
       </div>
       <!--Start body-->
       
       <!-- Start Footer -->
       <div class="footer">
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
       <div class="paragraph" style="color: #b9b9b9;" >
       Intellectual property is reserved for the authors mentioned on the books and the library is not responsible for the authors' ideas Old and forgotten books that have become in the past are published to preserve the Arab and Islamic heritage
       </div>
       
       </div>
       <p class="copyright">Made With ♡ By <span> Jabrallah </span> &copy; <?php echo " 20".date(  "y" )?></p>
       </div>
       <!-- End Footer -->
    </body>
    </html>