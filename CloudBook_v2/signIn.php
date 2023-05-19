<?php
require_once 'header.php';

// this for this page ##############################
 if(isset($_GET['logout']) && $_GET['logout'] == 1){
   $user->logout();
 }
 
 if($_SERVER["REQUEST_METHOD"]== "POST" ){
      $username = test_input($_POST['username']);
      $password = $_POST['pass'] ;
      
  		if ($user->login($username, $password)) {
  		  $userid = $user->display_user_id($username);
  		  $_SESSION['user_id'] = $userid['Id'];
  		  header('location: index.php');
  		}else {
  		  $passErr = "Wrong Username or Passward!";
  	  }
 }
 
 function test_input ($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  
?>

  <div class="container" >
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ;?>" method="post">
	  <h2>Sign In</h2>
	  <hr>
	  <input required type="phone" placeholder="User Name" name="username"><br>
	  <input required type="passward" placeholder="Passward" name="pass"> <br>
	  <center><span><?php if(isset($passErr)) echo $passErr; ?></span><br></center>
	 <center> <input type="submit" value="Supmit" name="submitbtm"  ></center>
	 <hr><center> Or Make a New Account ? <a href="signUp.php">  Sign Up</a>  </center><br>
	</form>
  </div>
  <!-- Start Footer -->
 <?php require_once 'footer.php'?>