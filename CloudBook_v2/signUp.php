<?php
require_once 'header.php';

// this for this page ##############################
 function test_input ($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  
  if ($_SERVER['REQUEST_METHOD']=="POST") {
    $username =$_POST['username'];
    $password =$_POST['pass'];
    $Cpassword =$_POST['Cpass'];
    if($password != $Cpassword) {
      $error_two = "passward not identical";
    }elseif($user->signup($username, $password)) {
      $successMsg = "Successful Registration Please Go to Sign in ";
    }else{
      $error_one = "username already exists!";
    }
  }

?>

	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ;?>" method="post">
	 <div class="container" >
	  <h2>Sign Up</h2>
	  <hr><center>
	   <center><span><?php if(isset($error_one)) echo $error_one; ?></span><br></center>
	   <center><span><?php  if(isset($successMsg)) echo $successMsg; ?></span><br></center>
	  <input required maxlength="200" type="text" name="username" placeholder="User Name" value=""><br><br>
	  <input required type="passward" name="pass" placeholder="Passward" > <br><br>
	  <input required type="passward" name="Cpass" placeholder="Confirm Passward"  > <br><br>
	   <center><span><?php  if(isset($error_two)) echo $error_two; ?></span><br></center>
	  </center>
	 <center> <input type="submit" value="Submit" name="Submit"></center>
	 <hr><center> Already have one ? <a href="signIn.php">  Sign In</a>  </center><br>
	 </div>
	</form>	<!-- Start Footer -->
  <?php require_once 'footer.php'?>