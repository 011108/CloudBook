<?php
require_once 'header.php';

// this for this page ##############################
//user recite
if (isset($userId)) {
    $userrecit = $Recites->user_recite($userId);

}
//display the book
$targetBook = $_GET['Code'];
$result = $book->display_book($targetBook);
$author_name = $authores->Book_Author($targetBook);

//save the book
if (isset($_GET['save']) && isset($_GET['Code'])) {
    $savedbook = $_GET['Code'];
    if ($_GET['save'] == 1) {
        $saved->add_saved_book($userId, $savedbook);
        header('location: Book_Review.php?Code=' . $targetBook);

    } elseif ($_GET['save'] == 0) {
        $saved->remove_saved_book($userId, $savedbook);
        header('location: Book_Review.php?Code=' . $targetBook);
    }
}

//favorite books
if (isset($_GET['fav']) && isset($_GET['Code'])) {
    $favbook = $_GET['Code'];

    if ($_GET['fav'] == 1) {
        $favorite->add_fav($userId, $favbook);
        header('location: Book_Review.php?Code=' . $targetBook);

    } elseif ($_GET['fav'] == 0) {
        $favorite->remove_fav($userId, $favbook);
        header('location: Book_Review.php?Code=' . $targetBook);

    }
}

//query for comment
$Comment_result = $comments->display_review($targetBook);
//add comment
$do = isset($_GET['do']) ? $_GET['do'] : 'default';
if ($do == 'add') {
    $content_comment = $_POST['comment'];
    $comments->add_comment($userId, $targetBook, $content_comment);
    header('location: Book_Review.php?Code=' . $targetBook);
}

//deleate comment
$do = isset($_GET['do']) ? $_GET['do'] : 'default';
if ($do == 'delete') {
    if (isset($_GET['comment_id'])) {
        $comments->remove_comment($_GET['comment_id']);
    }
    header('location: Book_Review.php?Code=' . $targetBook);
}
?>

<!--Start Main Boxe-->
<div class="container">
    <div class="Main_Book position-relative">
        <?php if (is_array($result)) echo "<img src='imgs/" . $result['Cover'] . "'width: '120px' height:'189' '/>" ?>
        <div class=" content">
            <h2><?php if (is_array($result)) echo $result['Title'] ?></h2>
            <div class="Author">Author :<span>  <?php echo $author_name ?> </span></div>
            <span>  <?php if (is_array($result)) echo $result['Pages'] ?> </span> pages
            <span> | <?php if (is_array($result)) echo $result['Publish-dat'] ?>  </span>
            <?php
            if (isset($userId)) {
                if ($favorite->check_fav_book($userId, $targetBook)) {
                    ?>
                    <a href='?fav=0&&Code=<?php echo $targetBook ?>'>
                        <svg class=" position-absolute top-0 start-0 ms-3 mt-3 love  bi bi-heart-fill"
                             xmlns="http://www.w3.org/2000/svg" width="30" height="35" fill="red" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                        </svg>
                    </a>
                    <?php
                } else {
                    ?>
                    <a href='?fav=1&&Code=<?php echo $targetBook ?>'>
                        <svg class=" position-absolute top-0 start-0 ms-3 mt-3 love  bi bi-heart-fill"
                             xmlns="http://www.w3.org/2000/svg" width="30" height="35" fill="gray" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                        </svg>
                    </a>
                    <?php
                }
            }
            ?>

            <form method="POST" class="ReadBott">
                <?php
                if (isset($userId)) {

                    if ($userrecit[0]['Amount'] == 0) {
                        ?>
                        <a style='background-color: #2196f3; color: white; padding: 3px 8px ; margin-right: 10px; '
                           href="<?php echo $result['Link']; ?>">Read</a>
                        <?php
                    } else {
                        $VisitaErr = "You have to pay the bill !";
                    }
                    if ($saved->check_saved($userId, $targetBook)) {
                        echo "<a style='background-color: #2196f3; color: white; padding: 3px 8px ; margin-right: 10px; '  href='?save=0&&Code=$targetBook'>Saved &#10004;</a><br>";
                    } else {
                        echo "<a style='background-color: #2196f3; color: white; padding: 3px 8px ; margin-right: 10px; '  href='?save=1&&Code=$targetBook'>Save</a><br>";
                    }
                }
                ?>
            </form>
            <br>
        </div>
    </div>
    <center><a href="payment.php"
               style=" color: black; background-color: #ff00005c;"><?php if (isset($VisitaErr)) echo $VisitaErr ?></a>
    </center>
</div>
<!--End Main Boxe-->
<!-- Start Reviews -->
<div class="reviews">
    <center><h3 class="title"> <?php echo $comments->count_review($targetBook, "B") ?> Comments</h3></center>
    <div class="container">
        <?php
        if (isset($userId)) {
            ?>
            <form action="?do=add&&Code=<?php echo $targetBook ?>" method="post">
                <center>
                    <textarea required name="comment"
                              placeholder="    what is your opinion on this book in 500 character   "></textarea><br>
                    <input type="submit" name="add" value="ADD"
                           style="padding-left: 10px; padding-right: 10px; color: white; background-color: #2196f3;  border: 1px solid white; border-radius: 5px;">
                </center>
            </form>
            <?php
        }
        ?>

        <div class="comments">
            <?php
            for ($c = 0; $c < $comments->count_review($targetBook, "B"); $c++) {
                echo "<div>";
                if (isset($userId)) {
                    if ($Comment_result[$c]['user_id'] == $userId) {
                        echo "<a class='delete_comment' href='?do=delete&&Code=" . $targetBook . "&&comment_id=" . $Comment_result[$c]['Id'] . " '>❌</a>";
                    }
                }
                if (empty($Comment_result[$c]['photo'])) {
                    echo "<img src='imgs/USER_IMGS/AltUser.png' ' width: '30px' height: '30px' '>";
                } else {
                    echo "<img src='imgs/USER_IMGS/" . $Comment_result[$c]['photo'] . "' ' width: '30px' height: '30px''>";
                }
                echo "<a href='myAcount.php?visitor_id=" . $Comment_result[$c]['user_id'] . "'>" . $Comment_result[$c]['Username'] . "</a><br>";
                echo "<span >" . $Comment_result[$c]['date'] . "</span>";
                echo "<p>" . $Comment_result[$c]['Content'] . "</p>";

                ?>
                <?php
                echo "</div>";
            }
            ?>
        </div>
    </div>
</div>
<!-- End Reviews -->
<!--Strt Similar-->
<div class="Similar">
    <center><h3 class="title">Similar Books</h3></center>
    <div class="container">
        <!--query2 for similar -->
        <?php

        if (is_array($result)) {
            $result2 = $categories->Display_Ctg_Books($result['Category_id']);
            $countsimilar = sizeof($result2);
        }
        //loop for similars
        if (isset($countsimilar)) {
            for ($ii = 0; $ii < $countsimilar; $ii++) {
                $author_name = $authores->Book_Author($result2[$ii]['Code']);
                echo "<a href='Book_Review.php?Code=" . $result2[$ii]['Code'] . "'><div class='similar_book'>";
                echo "<img src='imgs/" . $result2[$ii]['Cover'] . "' height : '97px' '>";
                echo "<div class='content' >";
                echo "<h4 style=' color: black; '>" . $result2[$ii]['Title'] . "</h4>";
                echo "<div style=' color: black;' class='Author'>" . "Author : " . "<span style=' color: #2196f3; '>" . $author_name . "</span>" . "</div>";
                echo "<span style=' color: #2196f3; ' >" . $result2[$ii]['Pages'] . "</span><span style=' color: black; '> pages </span> " . " |  ";
                echo "<span style=' color: #2196f3; ' >" . $result2[$ii]['Publish-dat'] . "</span>";
                echo "</div>";
                echo "</div>";
                echo "</a>";

            }
        }
        ?>
    </div>
</div>
<!--End Similar-->
<!-- Start Footer -->
<?php require_once 'footer.php';?>
<!-- End Footer -->
<script src="Js/all.min.js"></script>
<script>
    function lovit() {
        document.getElementsByClassName('love')[0].style.cssText = 'fill: red;';
    }
</script>
</body>
</html>