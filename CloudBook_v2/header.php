<?php
session_start();

require_once 'Config.php';

if (isset($_GET['lang'])) {
    if ($_GET['lang'] == 'Arabic') {
        $_SESSION['lang'] = 'arab';
    } elseif ($_GET['lang'] == 'English') {
        $_SESSION['lang'] = 'eng';
    }
}


if (isset($_SESSION['lang'])) {
    if ($_SESSION['lang'] == 'arab') {
        include('Language/Arabic.php');
    } elseif ($_SESSION['lang'] == 'eng') {
        include('Language/English.php');
    }
} else {
    include('Language/English.php');
}

spl_autoload_register(function ($class) {
    require_once "Classes/" . $class . ".php";
});

//objects of classes
$authores = new Author();
$book = new Book();
$books = new Book(); //in some pages it names like this
$categories = new Category();
$comments = new Comment();
$comment = new Comment(); //in myAcount page it names like this
$favorite = new Favorite();
$fav = new Favorite();    //in MyLiberary page it names like this
$Recites = new Recite();
$recites = new Recite();//in payment page it names like this
$saved = new Saved_Book();
$user = new User();


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $userId = $_SESSION['user_id']; //in Book_Review & User_sitting  page it names like this
    $activ_user = $user->display_user($user_id);
    $ActivuserData = $user->display_user($userId); //in Book_Review & MyLiberary page it names like this
}
// becous of i cant pass variable of $title & $style with $_SESSION becous i need to chang the values every click
$url = parse_url($_SERVER['REQUEST_URI']);
$path = $url['path'];
$components = explode('/', trim($path, '/')) ;

if(isset($components[3])){
    switch($components[3]){
        case 'index.php':
            $title = 'Home';
            $style = 'main.css';
            break;
        case 'Book_Review.php':
            $title = 'Book Review';
            $style = 'Book_Review_Style.css';
            break;
        case 'myAcount.php':
            $title = 'My Account';
            $style = 'myAcount.css';
            break;
        case 'MyLibrary.php':
            $title = 'My Library';
            $style = 'Liberary.css';
            break;
        case 'payment.php':
            $title = 'Puy The Bill';
            $style = 'Payment.css';
            break;
        case 'Searching.php':
            $title = 'Search Result';
            $style = 'Searching_style.css';
            break;
        case 'signIn.php':
            $title = 'Sign In';
            $style = 'signin.css';
            $sign = true;
            break;
        case 'signUp.php':
            $title = 'Sign Up';
            $style = 'signup.css';
            $sign = true;
            break;
        case 'user_setting.php':
            $title = 'Settings';
            $style = 'Setting.css';
            break;
    }
}
//echo $title . "     " . $style;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title> <?php echo $title ?> </title>
    <link rel="stylesheet" href="css/normalize.css"/>
    <link rel="stylesheet" href="css/<?php echo $style ?>"/>
    <link rel="stylesheet" href="css/all.min.css"/>
    <link rel="stylesheet" href="css/bootstrap.rtl.min.css"/>
    <!--google fonts-->
    <!--bootstrap-->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!--bootstrap-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,500;1,400&display=swap"
          rel="stylesheet">
    <style>
        a {
            text-decoration: none;
        }

        .lang {
            background-color: transparent;
            border: 1px solid;
        }

        a {
            text-decoration: none;
        }

        .col {
            width: 100px;
        }

        .reff {
            width: 50px;
        }


    </style>

</head>
<body>
<!-- Start Header -->
<div class="header" id="header" style="margin-top:0;">
    <div class="container">
        <a href="index.php" class="logo">Cloud Book</a>

        <div class="dropdown">
            <button class=" lang btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">Dropdown button
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="?lang=Arabic">Arabic</a></li>
                <li><a class="dropdown-item" href="?lang=English">English</a></li>
            </ul>
        </div>
<!--        this for if i in the sign IN or UP i don't need the dropdown menu -->
        <?php if(isset($sign)){?>
            <ul class="main-nav">
                <a style="color: white;" href="signIn.php"><?php echo lang('Sign In'); ?></a>
            </ul>

        <?php }else{?>
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    <?php if (empty($user_id)||empty($userId)) {
                        echo "Sign In";
                    } else {
                        echo "<img src='imgs/USER_IMGS/" . $activ_user['photo'] . "' class='rounded-circle' style='width:40px; height:40px;' >";
                    } ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php if (empty($user_id)) { ?>
                        <a class="dropdown-item" href="signIn.php"><?php echo lang('Sign In'); ?></a>
                    <?php } else { ?>
                        <a class="dropdown-item" href="index.php"><?php echo lang('Home'); ?></a>
                        <a class="dropdown-item" href="myAcount.php"><?php echo lang('My Account'); ?></a>
                        <a class="dropdown-item" href="MyLibrary.php"><?php echo lang('Liberary'); ?></a>
                        <a class="dropdown-item" href="user_setting.php"><?php echo lang('Settings'); ?></a>
                        <a class="dropdown-item" href="signIn.php?logout=1"><?php echo lang('Log out'); ?></a>
                    <?php } ?>
                </div>
            </div>
        <?php }?>
    </div>
</div>
<!-- End Header -->
