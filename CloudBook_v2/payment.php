<?php
require_once 'header.php';

// this for this page ##############################
 $userrecit = $recites->user_recite($user_id);
  $activ_user = $user->display_user($user_id);
 if ($_SERVER['REQUEST_METHOD']=="POST") {
    if (isset($_POST['pay'])) {
      $recites->payed_user($user_id);
      header("location: payment.php");
    }
 }
 ?>

	<form  action="payment.php" method="post">
	 <div class="container" >
	  <center>
	    <h2>Cloud Book</h2>
	    <h3>total : <span style="color :#2196f3;"><?php echo $userrecit[0]['Amount'] ?>$</span></h3>
	  </center>
	  <hr>
      <input type="phone" placeholder="Card Number" ><br>
      <input type="password" placeholder="CVV" > <br>
     <center> <input name="pay" type="submit" value="Pay"  ></center>
	 <hr>
	 <h6>Recite Date : <span><?php echo $userrecit[0]['ReciteDate'] ?> </span></h6>
	 </div>
	</form>
	<!-- Start Footer -->
	<?php require_once 'footer.php'?>