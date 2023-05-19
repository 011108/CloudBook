<?php
require_once 'header.php';

// this for this page ##############################
if (isset($_GET['visitor_id'])) {
    //visitor
    $vesitorUser = $_GET['visitor_id'];
    $result = $user->display_user($vesitorUser);
    $result3 = $comment->display_review_user($vesitorUser);
    $favresult = $favorite->display_Favorites($vesitorUser);
} elseif (isset($user_id)) {
    //original User
    $result = $user->display_user($user_id);
    $result3 = $comment->display_review_user($user_id);
    $favresult = $favorite->display_Favorites($user_id);
}
$counReview = sizeof($result3);


?>

<!--Start body-->
<div class="body">
    <div class="container">
        <div class="parent">
            <center>
                <?php
                if (empty($result['photo'])) {
                    echo "<img style='width: 239px;height: 239px; margin-bottom: 10px; border-radius: 50%;' class='user_img' src='imgs/USER_IMGS/AltUser.png' Alt='user' class='user' >";
                } else {
                    echo "<img style='width: 239px;height: 239px; margin-bottom: 10px; border-radius: 50%;' class='user_img' src='imgs/USER_IMGS/" . $result['photo'] . "' alt='user' class='user'><br>";
                }
                ?>
                <h5><?php echo $result['Username'] ?></h5>
            </center>
            <!--Favorites Books -->
            <center class="shadow-sm p-2 mb-3 bg-body-tertiary rounded"> Favorites</center>
            <center>
                <?php
                $i = 0;
                foreach ($favresult as $arr) {
                    if ($i < 6) {
                        ?>
                        <a href='Book_Review.php?Code=<?php echo $arr['Code'] ?>'><img class=" col mb-2"
                                                                                       src='Imgs/<?php echo $arr['Cover'] ?>'/></a>
                        <?php
                    } else {
                        break;
                    }
                    $i++;
                }
                ?>
            </center>
            <div class="reviews">
                <center><h3 class="title"> <?php if (isset($counReview)) {
                            echo $counReview . " ";
                        } else echo 0 ?> Reviews</h3></center>
                <br>
                <div class="comments">
                    <?php
                    for ($c = 0; $c < $counReview; $c++) {
                        echo "<div class=' position-relative'>";
                        if (empty($result['photo'])) {
                            echo "<img style='width: 31px; height: 31px; margin-bottom: 24px; border-radius: 50%;' class='user' src='imgs/USER_IMGS/AltUser.png' '>";
                        } else {
                            echo "<img style='width: 31px; height: 31px; margin-bottom: 24px; border-radius: 50%;' class='user'  src='imgs/USER_IMGS/" . $result['photo'] . "'>";
                        }
                        echo "<a class='username' style=' position: relative; bottom: 12px; left: 4px; '>" . $result['Username'] . "</a><br>";
                        echo "<span style=' position: relative; left: 36px;font-size: 11px; bottom: 33px;'>" . $result3[$c]['date'] . "</span>";
                        echo "<p style='margin: 0px 10px 0px 10px;'>" . $result3[$c]['Content'] . "</p>";
                        echo "<a href='Book_Review.php?Code=" . $result3[$c]['Code'] . "' class='reff position-absolute bottom-0 start-0 mb-3 ms-4'><img class='reff  ' src='Imgs/" . $result3[$c]['Cover'] . "'/></a>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Start body-->
<!-- Start Footer -->
<?php require_once 'footer.php';?>
<!-- End Footer -->
</body>
</html>