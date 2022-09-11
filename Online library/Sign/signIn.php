<?php
 session_start();

 require '../Config.php';
 if($_SERVER["REQUEST_METHOD"]== "POST" ){
      $username = test_input($_POST['username']);
      $password = $_POST['pass'] ;
      $query =$db->prepare("SELECT Username, Password  from User WHERE Username = '$username' ");
      $query->execute();
      $result = $query->fetchAll(PDO::FETCH_ASSOC);
  		$count= $query->rowCount();
  		if ($count > 0) {
  		  if ($result[0]['Password'] == sha1($password)) {
  		    $_SESSION['user_name'] = $username;
  		    header('location: ../main.php');
  		  }else {
  		     $passErr = "Wrong Passward!";
  		  }
        }else {
  		    $userErr = "Username Not Valid ";
  	  	}
 }
 function test_input ($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Sign In </title>
    <link rel="stylesheet" href="../normalize.css" />
    <link rel="stylesheet" href="font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="signin.css?v=<?php echo time(); ?> " />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../css/all.min.css" />
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
          <li><a href="signUp.php">Sign Up</a></li>
         </ul>
     </div>
    </div>
    <!-- End Header -->
  <div class="container" >
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ;?>" method="post">
	  <h2>Sign In</h2>
	  <hr>
	  <input required type="phone" placeholder="User Name" name="username"><br>
	  <center><span><?php echo $userErr; ?></span><br></center>
	  <input required type="passward" placeholder="Passward" name="pass"> <br>
	  <center><span><?php echo $passErr; ?></span><br></center>
	 <center> <input type="submit" value="Supmit"  ></center>
	 <hr><center> Or Make a New Account ? <a href="signUp.php">  Sign Up</a>  </center><br>
	</form>
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