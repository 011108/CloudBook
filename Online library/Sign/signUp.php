<?php
session_start();
 require '../Config.php';

   function test_input ($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  
  if ($_SERVER['REQUEST_METHOD']=="POST") {
    $username =test_input($_POST['username']);
    $phone =test_input($_POST['phon']);
    $password =sha1($_POST['pass']);
    $Cpassword =sha1($_POST['Cpass']);
    $query =$db->prepare("SELECT * from User WHERE Username = '$username' ");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
		$count= $query->rowCount();
		if($count > 0){
		  $error_one = "username already exists!";
		}elseif (strlen($_POST['username']) >200) {
		  $longUserNameErr="that's too long ";
		} elseif(strlen($phone)>11) {
        $longPhonErr="that's too long ";
		}elseif($password == $Cpassword) {
		    $query2 =$db->prepare("insert into User (Username, Phone, Password) values ('$username', '$phone', '$password')");
        $query2->execute();
        $successMsg = "Successful Registration Please Go to Sign in ";
        $_SESSION['user_name'] = $username;
		  } else {
		    $error_two = "passward not identical";
		  }
		}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Sign Up </title>
    <link rel="stylesheet" href="../normalize.css" />
    <link rel="stylesheet" href="font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="signup.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../css/all.min.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&display=swap" rel="stylesheet" />
    <style>
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
    	}
    	@media (max-width: 767px) {
    	  .header .main-nav > li > a {
    	    padding: 10px;
    	    font-size: 14px;
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
    	/* End Header */
      form span{
        color: red;
        font-size: 12px;
      }
      form a{
        color: #1787e0;
        font-weight: bold;
      }
      
 form input[type="text"] , input[type="passward"], input[type="number"]{
  border: 1px solid var(--main-color);
  padding:  20px;
  caret-color: white;
  width: 100% ;
  border-radius: 30px ;
  margin:10px;
  }
    </style>
  </head>
  <body>
  <!-- Start Header -->
    <div class="header" id="header">
  	   <div class="container">
         <a href="main.php" class="logo">Cloud Book</a>
         <ul class="main-nav">
          <li><a href="signIn.php">Sign In</a></li>
         </ul>
     </div>
    </div>
    <!-- End Header -->
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ;?>" method="post">
	 <div class="container" >
	  <h2>Sign Up</h2>
	  <hr><center>
	   <center><span><?php echo $error_one; ?></span><br></center>
	   <center><span><?php echo $successMsg; ?></span><br></center>
	  <input required type="text" name="username" placeholder="User Name" value=""><br><br>
	   <center><span><?php echo $longUserNameErr; ?></span><br></center>
	  <input required type="number" name="phon" placeholder="Phone" value=""><br><br>
	   <center><span><?php echo $longPhonErr; ?></span><br></center>
	  <input required type="passward" name="pass" placeholder="Passward" > <br><br>
	  <input required type="passward" name="Cpass" placeholder="Confirm Passward"  > <br><br>
	   <center><span><?php echo $error_two; ?></span><br></center>
	  </center>
	 <center> <input type="submit" value="Submit" name="Submit"></center>
	 <hr><center> Already have one ? <a href="signIn.php">  Sign In</a>  </center><br>
	 </div>
	</form>	<!-- Start Footer -->
  <!-- start  footer -->
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