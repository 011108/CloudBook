<?php
require_once 'header.php';

// this for this page ##############################
//display activ user data
if ($userId) {
    $ActivuserData = $user->display_user($userId);
}

#validate the data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//password change msg
if (isset($_GET['pass'])) {
    if ($_GET['pass']) {
        $passSucsses = "password changed ";
    }
}

$do = isset($_GET['do']) ? $_GET['do'] : 'default';
if ($do == "img") {
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $file_name = $file['name'];
        $file_type = $file ['type'];
        $file_size = $file ['size'];
        $file_path = $file ['tmp_name'];
    }
    if (isset($file_name)) {
        if ($file_name != "" && ($file_type = "image/jpeg" || $file_type = "image/png") && $file_size <= 614400) {
            if (move_uploaded_file($file_path, 'Imgs/USER_IMGS/' . $file_name)) {
                $user->chang_photo($userId, $file_name);
            }
        }
    }
    header("location: user_setting.php");

} elseif ($do == "data") {
    //change user name
    if (!empty($_POST['username'])) {
        if ($ActivuserData['Username'] != $_POST['username']) {
            // echo " not same value";
            $result = $user->display_user_with_name($_POST['username']);
            $count = sizeof($result);
            if ($count > 0) {
                $error_one = "username already exists!";
            } elseif (strlen($_POST['username']) > 200) {
                $longUserNameErr = "that's too long ";
            } else {
                $RedyUserne = test_input($_POST['username']);
                $user->chang_username($userId, $RedyUserne);
            }
        }
    } else {
        $emptyerr = " this field should not be empty";
    }

    //change age
    if (strlen($_POST['Age']) > 4) {
        $AgeErorr = "wrong Age!";
    } else {
        $RedyAge = test_input($_POST['Age']);
        $user->chang_age($userId, $RedyAge);
    }
    header("location: user_setting.php");

} elseif ($do == "securdata") {
    #change password
    if (!empty($_POST['newpassword'])) {
        $user->chang_password($userId, $_POST['newpassword']);
        header("location: user_setting.php?pass=1");
    } else {
        $passErr = " passward can't be empty";
    }

} elseif ($do == "delete") {
    if (isset($_POST['yesD'])) {
        $user->delete_account($userId);
        session_destroy();
        header("location:signIn.php");
    }
}

?>

<!-- start form  -->
<center>
    <?php
    if (empty($ActivuserData['photo'])) {
        echo "<img style='width: 239px;height: 239px; margin-bottom: 10px; border-radius: 50%;' class='user_img' src='imgs/USER_IMGS/AltUser.png' >";
    } else {
        echo "<img style='width: 239px;height: 239px; margin-bottom: 10px; border-radius: 50%;' class='user_img' src='imgs/USER_IMGS/" . $ActivuserData['photo'] . "' >";
    }
    ?>
    <form action="?do=img" method="post" enctype="multipart/form-data">
        <input class="w-50 form-control form-control-lg primary" id="formFileLg" type="file" name="file">
        <button type="submit" class="btn btn-primary mb-3">Update image</button>
    </form>
</center>

<form class="forme" action="?do=data" method="post" enctype="multipart/form-data">
    <div class="container">
        <!--usernam error-->
        <center>
            <span><?php if (isset($error_one)) {
                    echo $error_one;
                } ?></span><br>
            <span><?php if (isset($longUserNameErr)) {
                    echo $longUserNameErr;
                } ?></span><br>
            <span><?php if (isset($emptyerr)) {
                    echo $emptyerr;
                } ?></span><br>
        </center>

        <label>Username</label><br>
        <input value="<?php if (isset($ActivuserData['Username'])) echo $ActivuserData['Username'] ?>" type="text"
               name="username"><br>

        <!--age error-->
        <center><span><?php if (isset($AgeErorr)) {
                    echo $AgeErorr;
                }; ?></span><br></center>

        <label>Age</label>
        <input value="<?php echo $ActivuserData['Age'] ?>" type="number" name="Age"><br>

        <center><input type="submit" value="update "></center>
    </div>
</form>
<br>
<!-- End form -->
<!-- start account settings-->
<div class="container">
    <form action="" method="post">
        <div class="account-set">
            <input type="submit" value="Delete Account " name="submit1">
            <input type="submit" value=" Change Password" name="submit2">
        </div>
        <br>
        <?php if (isset($passSucsses)) echo '<div style="background-color: #85de9b; width: 100%; text-align: center;">' . $passSucsses . '</div>'; ?>
        <center><span style="color: red;"><?php if (isset($passErr)) {
                    echo $passErr;
                } ?></span></center>
        <br>
    </form>
</div>
<br><br>
<!-- end account settings-->
<!--start result of settings-->
<?php
if (isset($_POST['submit2'])) {
    ?>
    <form class="forme" action="?do=securdata" method="post">
        <div class="container">
            <input class="pass" placeholder="Password" type="password" name="newpassword"><br>
            <center><input type="submit" value="update " name="updatPass"></center>
            <br><br>
        </div>
    </form>
    <?php
}
if (isset($_POST['submit1'])) {
    ?>
    <div class="popup">
        <p> Confirm Delete the account? </p>
        <form class="btms" action="?do=delete" method="post">
            <input type="submit" value="Yes" name="yesD">
            <input type="submit" value="No" name="noD">
        </form>
    </div>
    <?php
}
?>
<!--end result of settings-->
<?php require_once 'footer.php'?>