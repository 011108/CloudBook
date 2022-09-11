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
   
   
   $sql2 = $db->prepare("select Code, Pages, `Publish-dat`, Cover, Title, Author.Name, Username from Book, Author, User, Reded_Books where User.Id = User_Id AND Code = Book_Code and Author.Id = Author_Id  and Username = '$user_name'");
   $sql2->execute();
   $result2 = $sql2->fetchAll(PDO::FETCH_ASSOC);
   $countRed = $sql2->rowCount();
  /* echo "<pre>";
     print_r($result2);
   echo "</pre>";*/
   //for saved books 
   $sql3 = $db->prepare("select Code, Pages, `Publish-dat`, Cover, Title, Author.Name, Username from Book, Author, User, Saved_Books where User.Id = User_Id AND Code = Book_Code and Author.Id = Author_Id  and Username = '$user_name'");
   $sql3->execute();
   $result3 = $sql3->fetchAll(PDO::FETCH_ASSOC);
   $countSaved= $sql3->rowCount();
   
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Liberary</title>
    <link rel="stylesheet" href="normalize.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/all.min.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&display=swap" rel="stylesheet" />
    <style>
      /* Start Global Rules */
      * {
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      }
      :root {
      --main-color: #2196f3;
      --main-color-alt: #1787e0;
      --main-transition: 0.3s;
      --main-padding-top: 100px;
      --main-padding-bottom: 100px;
      --section-background: #ececec;
      }
      body {
      font-family: "Cairo", sans-serif;
      }
      a {
        text-decoration: none;
        color: black;
      }
      ul {
      list-style: none;
      margin: 0;
     padding: 0;
     }
      .container {
      padding-left: 15px;
      padding-right: 15px;
      margin-left: auto;
      margin-right: auto;
      }
      
     /* Start Header */
	.header {
	  background-color: var(--main-color);
	  position: relative;
	  -webkit-box-shadow: 0 0 10px #ddd;
	  -moz-box-shadow: 0 0 10px #ddd;
	  box-shadow: 0 0 10px #ddd;
	  margin-bottom: 15px;
	}
	.header .container {
	  display: flex;
	  justify-content: space-between;
	  align-items: center;
	  flex-wrap: wrap;
	  position: relative;
	}
	.header .logo {
	  color: white;
	  font-size: 26px;
	  font-weight: bold;
	  height: 72px;
	  display: flex;
	  justify-content: center;
	  align-items: center;
	}
	@media (max-width: 767px) {
	  .header .logo {
	    font-size: 20px;
	    height: 60px;
	  }
	}
	.header .main-nav >  li:hover .mega-menu{
	  opacity: 1;
	  z-index: 100;
	  top: calc(100% + 1px);
	}
	.header .main-nav > li > a {
	  display: flex;
	  justify-content: center;
	  align-items: center;
	  height: 72px;
	  position: relative;
	  color:white;
	  padding: 0 30px;
	  overflow: hidden;
	  font-size: 35px;
	  transition: var(--main-transition);
	}
	@media (max-width: 767px) {
	  .header .main-nav > li > a {
	    padding: 10px;
	    font-size: 25px;
	    height: 40px;
	  }
	}
	.header .main-nav > li > a::before {
	  content: "";
	  position: absolute;
	  width: 100%;
	  height: 4px;
	  background-color: var(--main-color);
	  top: 0;
	  left: -100%;
	  transition: var(--main-transition);
	}
	.header .main-nav > li > a:hover {
	  color: var(--main-color);
	  background-color: #fafafa;
	}
	.header .main-nav > li > a:hover::before {
	  left: 0;
	}
	.header .mega-menu {
	position: absolute;
	width: 100%;
	left: 0;
	padding: 30px;
	background-color: white;
	border-bottom: 3px solid var(--main-color);
	z-index: -1;
	display: flex;
	gap: 40px;
	top: calc(100% + 50px);
	opacity: 0;
	transition: top var(--main-transition), opacity var(--main-transition);
	}
	@media (max-width: 767px) {
	.header .mega-menu {
	flex-direction: column;
	gap: 0;
	padding: 5px;
	}
	}
	.header .mega-menu .links {
	min-width: 250px;
	flex: 1;
	}
	@media (max-width: 991px) {
	.header .mega-menu .image {
	display: none;
	}
	}
	.header .mega-menu .links li {
	position: relative;
	}
	.header .mega-menu .links li:not(:last-child) {
	border-bottom: 1px solid #e9e6e6;
	}
	//...
	.header .mega-menu .links li::before {
	content: "";
	position: absolute;
	left: 0;
	top: 0;
	width: 0;
	height: 100%;
	background-color: #fafafa;
	z-index: -1;
	transition: var(--main-transition);
	}
	.header .mega-menu .links li:hover::before {
	width: 100%;
	}
	.header .mega-menu .links li a {
	color: var(--main-color);
	padding: 15px;
	display: block;
	font-size: 18px;
	font-weight: bold;
	}
	.header .mega-menu .links li a i {
	margin-right: 10px;
	}
	.header .mega-menu .activ {
	  border-bottom:solid 1px var(--main-color-alt);
	  
	}
	/* End Header */

      .read_later{
        margin-top: 15px;
        background-color: var(--section-background);
      }
     .boxx{
      box-shadow: 0 2px 15px rgb(0 0 0 / 10%);
      border:1px solid var(--section-background);
      background-color: white;
      border-radius: 6px;
      overflow: hidden;
      display: flex;
      margin-top: 10px;
      height: 90px;
      }
      .container h2{
        color: var(--main-color);
        padding: 20px;

      }
      @media (max-width: 767px) {
         .container h2{
          padding: 10px;
          font-size: 18px;
      }
      }
      .boxx img {
      width: 70px;
      margin-right: 20px;
      }
      .boxx span {
        color: var(--main-color);
      }
      .boxx h4, h6{
        font-size: 14px;
        margin-top: 8px;
        margin-bottom: 8px;
      }
      /* Start Footer */
      
      .footer {
      
      background-color: #191919;
      
      padding: 60px 0 0;
      
      margin-top: 20px;
      }
      
      @media (max-width: 767px) {
      
      .footer {
      
      text-align: center;
      
      }
      
      }
      
      .footer .container {
      
      display: grid;
      
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      
      gap: 40px;
      
      }
      
      .footer .box h3 {
      
      color: white;
      
      font-size: 50px;
      
      margin: 0 0 20px;
      
      }
      
      .footer .box .social {
      
      display: flex;
      
      }
      
      @media (max-width: 767px) {
      
      .footer .box .social {
      
      justify-content: center;
      
      }
      
      }
      
      .footer .box .social li {
      
      margin-right: 10px;
      
      }
      
      .footer .box .social li a {
      
      background-color: #313131;
      
      color: #b9b9b9;
      
      display: inline-flex;
      
      justify-content: center;
      
      align-items: center;
      
      width: 50px;
      
      height: 50px;
      
      font-size: 20px;
      
      transition: var(--main-transition);
      
      }
      
      .footer .box .social .facebook:hover {
      
      background-color: #1877f2;
      
      }
      
      .footer .box .social .twitter:hover {
      
      background-color: #1da1f2;
      
      }
      
      .footer .box .social .youtube:hover {
      
      background-color: #ff0000;
      
      }
      
      .footer .box .text {
      
      line-height: 2;
      
      color: #b9b9b9;
      
      }
      
      .footer .box .links li {
      
      padding: 15px 0;
      
      transition: var(--main-transition);
      
      }
      
      .footer .box .links li:not(:last-child) {
      
      border-bottom: 1px solid #444;
      
      }
      
      .footer .box .links li:hover {
      
      padding-left: 10px;
      
      }
      
      .footer .box .links li:hover a {
      
      color: white;
      
      }
      
      .footer .box .links li a {
      
      color: #b9b9b9;
      
      transition: var(--main-transition);
      
      }
      
      .footer .box .links li a::before {
      
      font-family: "Font Awesome 5 Free";
      
      content: "\F101";
      
      font-weight: 900;
      
      margin-right: 10px;
      
      color: var(--main-color);
      
      }
      
      
      
      .footer .footer-gallery img {
      
      width: 78px;
      
      border: 3px solid white;
      
      margin: 2px;
      
      }
      
      .footer .copyright {
      
      padding: 25px 0;
      
      text-align: center;
      
      color: white;
      
      margin: 50px 0 0;
      
      border-top: 1px solid #444;
      
      }
      .copyright .copy { color:white;}
      .footer span {
      color:var(--main-color);
      font-weight:bolder;
      }
      /* End Footer */
    </style>
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
		      <a href="myAcount.php">My Account</a>
              </li>
		      <li>
		      <a href="MyLibrary.php" class="activ" >My Liberary</a>
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
       <div class="readed">
         <div class="container">
          <center><h2>Readed</h2></center>
             <?php 
               for($i=0; $i<$countRed; $i++){
                 echo "<a href='Book_Review.php?Code=".$result2[$i]['Code']."'>";
                    echo "<div class='boxx'>";
                      echo "<img src='imgs/".$result2[$i]['Cover']."'>";
                      echo "<div class='content'>";
                        echo "<h6>".$result2[$i]['Title']."</h6>";
                        echo "<div>"."Author : ".$result2[$i]['Name']."</div>";
                        echo "<span>".$result2[$i]['Pages']."Page"."</span>";
                        echo "<span> | ".$result2[$i]['Publish-dat']."</span>";
                      echo "</div>";
                    echo "</div>";
                 echo "</a>";
               }
             ?>
	       </div>
	     </div>
       <div class="read_later">
        <div class="container">
         <center><h2>Reade Later</h2></center>
         <?php 
               for($ii=0; $ii<$countSaved; $ii++){
                 echo "<a href='Book_Review.php?Code=".$result3[$ii]['Code']."'>";
                    echo "<div class='boxx'>";
                      echo "<img src='imgs/".$result3[$ii]['Cover']."'>";
                      echo "<div class='content'>";
                        echo "<h6>".$result3[$ii]['Title']."</h6>";
                        echo "<div>"."Author : ".$result3[$ii]['Name']."</div>";
                        echo "<span>".$result3[$ii]['Pages']."Page"."</span>";
                        echo "<span> | ".$result3[$ii]['Publish-dat']."</span>";
                      echo "</div>";
                    echo "</div>";
                 echo "</a>";
               }
             ?>
	      </div>
	     </div>
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