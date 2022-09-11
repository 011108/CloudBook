<?php 
  session_start();
  require 'Config.php';
  $user_name = $_SESSION['user_name'];
  
  //Activ user 
   $activUser= $db->prepare("SELECT Id, Photo FROM User WHERE Username = '$user_name'");
   $activUser->execute();
   $ActivuserData = $activUser->fetchAll(PDO::FETCH_ASSOC);
   $userId = $ActivuserData[0]['Id'];
  
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (strlen($_POST['phone']) >11) {
      $phoneErorr = "maximum litters 11";
    }else{
      $phone = test_input($_POST['phone']);
    }
    
    if (strlen($_POST['Age']) >4) {
      $AgeErorr = "wrong Age!";
    }else{
      $Age = test_input($_POST['Age']);
    }
    
    
  $file = $_FILES['file'];
  $file_name = $file['name'];
  $file_type = $file ['type'];
  $file_size = $file ['size'];
  $file_path = $file ['tmp_name'];
  
  $filSiz = getimagesize($file['name']);
    
 echo "<pre>";
  print_r($filSiz);
 echo "</pre>";
 }
   function test_input ($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  
  if ($file_name != "" && ($file_type = "image/jpeg" || $file_type = "image/png") && $file_size <= 614400){
   
   if (move_uploaded_file ($file_path, 'Imgs/USER_IMGS/'.$file_name)){
    $query = "UPDATE User SET photo = '$file_name' WHERE Username ='$user_name'";
    $statement = $db->prepare($query); 
    $statement->execute();
    }
  }
  
 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> User Info </title>
    <link rel="stylesheet" href="normalize.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/all.min.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
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
      html {
      scroll-behavior: smooth;
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
      margin: auto;
      }
      .main-title {
      margin: 0 auto 20px;
      border-bottom:none;
      border-radius:30px;
      padding: 10px 20px;
      font-size: 20px;
      z-index: 1;
      display: flex;
      box-shadow: 0 2px 15px rgb(0 0 0 / 10%);
      }
      @media (min-width: 767px) {
      .main-title {
        width:100%;
        max-width:  calc(100% - 250px);
      }
      }
      /* End  Global Rules */
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
.header .main-nav > li:hover .mega-menu {
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
  font-size: 18px;
  transition: var(--main-transition);
  font-size: 35px;
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
/* End Header */

      .file {
        display: block;
        position: relative;
        width: 23%;
        bottom: 15px;
        }
      
      .main-title i{
        margin-right: 10px;
        margin-top: 25px;
      }
     .container img{
       width: 40%;
       margin-bottom: 10px;
       border-radius: 50%;
     }
     
      .forme {
      margin: auto;
      display: flex;
      flex-wrap: wrap;
      padding: 10px;
      justify-content: center;
      border-radius: 30px;
      width:100%;
      max-width:  calc(100% - 250px);
      border-top:none;
      box-shadow: 0 2px 15px rgb(0 0 0 / 10%);
      }
      @media (max-width: 767px) {
      .forme {
      max-width:  500px;
      }
      }
      .forme span{
        color: #3f3636;
        font-size: 12px;
        background-color: #fa8080;

      }
      
      
      .forme input[type="text"] , input[type="number"]{
      border: 1px solid var(--main-color);
      padding:  20px;
      caret-color: white;
      width: 100% ;
      border-radius: 30px ;
      margin:10px;
      }
      @media (max-width: 767px) {
      .forme input[type="text"] {
      width: 100% ;
      }
      }
      .forme input[type="submit"] {
      height:50px;
      width:130px;
      background-color: var(--main-color);
      color: white;
      border: 1px solid white;
      text-transform: uppercase;
      border-radius:30px ;
      }
      
     
      /* Start Footer */
      
      .footer {
      
      background-color: #191919;
      
      padding: 70px 0 0;
      width: 100%;
      
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
      .footer span .foo{
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
                   echo "<a href='#'><img src='imgs/USER_IMGS/AltUser.png' style=' width : 40px; border-radius: 50%; margin-bottom: 0px;'></a>";
                 }else {
                 echo "<a href='#'><img src='imgs/USER_IMGS/".$ActivuserData[0]['Photo']."' style=' width : 40px; border-radius: 50%;  margin-bottom: 0px; '></a>";
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
		      <a href="MyLibrary.php">My Liberary</a>
			  </li>
		      <li>
		      <a href="user_setting.php"  class="activ" > Settings </a>
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
	  <form class="forme" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data"  >
     <div class="container">
      <center><h2 id="info">Personal Info</h2></center><br>
      
      <center>
        <?php 
             if (empty($ActivuserData[0]['Photo'])) {
               echo "<img src='imgs/USER_IMGS/AltUser.png' width= '40%' margin-bottom= '10px' border-radius= '50%'>";
             }else {
             echo "<img src='imgs/USER_IMGS/".$ActivuserData[0]['Photo']."'  width= '40%' margin-bottom= '10px' border-radius= '50%'>";
             }
           ?>	    
	      <input type="file" name="file" class="file">
	    </center>
      <label>Phone</label>
      <span><?php echo $phoneErorr ; ?></span><br>
      <input value="<?php echo $phone?>"  type="number" name="phone" ><br>
      
      <label>Age</label>
      <span><?php  echo $AgeErorr; ?></span><br>
      <input value="<?php echo $Age?>"  type="number" name="Age" ><br>
      
      
      <center><input type="submit" value="update "></center>
     
     </div>
   </form><br>
   <a href="#" ><div class="main-title">
        <i class="fa-solid fa-trash-can"></i>
        <h5>Delete Account</h5>
	    </div></a>
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
	<p class="copyright">Made With ♡ By abrallah &copy; <?php echo " 20".date(  "y" )?></p>
	</div>
	<!-- End Footer -->
	</html>
	