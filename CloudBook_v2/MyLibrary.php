<?php
require_once 'header.php';

// this for this page ##############################
$resultSaved = $saved->display_saved_books($user_id);
$countSaved = sizeof($resultSaved);

$favresult = $fav->display_Favorites($user_id);
$countFav = sizeof($favresult);
?>

<div class="father">
    <!--start read later-->
    <div class="read_later">
        <div class="container">
            <center><h2> Playlists </h2></center>

            <div class="list-group ">
                <button class="btn btn-primary btn-lg dropdown-toggle  list-group-item d-flex justify-content-between align-items-center"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false"><span
                            class="badge bg-primary rounded-pill"><?php echo $countSaved ?></span> Saved Books
                </button>
                <ul class="container dropdown-menu w-100 ">
                    <?php
                    for ($ii = 0; $ii < $countSaved; $ii++) {
                        $author_name = $authores->Book_Author($resultSaved[$ii]['Code']);
                        echo "<a class='w-100  dropdown-item list-group-item ' href='Book_Review.php?Code=" . $resultSaved[$ii]['Code'] . "'>";
                        echo "<div position-relative class=' boxx'>";
                        echo "<img src='imgs/" . $resultSaved[$ii]['Cover'] . "'>";
                        echo "<div class='content'>";
                        echo "<h6 class='' >" . $resultSaved[$ii]['Title'] . "</h6>";
                        echo "<div>" . "Author : " . $author_name . "</div>";
                        echo "<span>" . $resultSaved[$ii]['Pages'] . "Page" . "</span>";
                        echo "<span> | " . $resultSaved[$ii]['Publish-dat'] . "</span>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='position-absolute bottom-0 start-0 mb-3 ms-4'>" . $resultSaved[$ii]['date'] . "</div>";
                        echo "</a>";
                    }
                    ?>
                </ul>
            </div>
            <br>

            <div class="list-group btn-group">
                <button class="btn btn-primary btn-lg dropdown-toggle  list-group-item d-flex justify-content-between align-items-center"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false"><span
                            class="badge bg-primary rounded-pill"><?php echo $countFav ?></span> Favorites Books
                </button>
                <ul class="dropdown-menu w-100 ">
                    <?php
                    for ($i = 0; $i < $countFav; $i++) {
                        $author_name = $authores->Book_Author($favresult[$i]['Code']);
                        echo "<a class='w-100  dropdown-item list-group-item ' href='Book_Review.php?Code=" . $favresult[$i]['Code'] . "'>";
                        echo "<div class=' position-relative boxx'>";
                        echo "<img src='imgs/" . $favresult[$i]['Cover'] . "'>";
                        echo "<div class='content'>";
                        echo "<h6>" . $favresult[$i]['Title'] . "</h6>";
                        echo "<div>" . "Author : " . $author_name . "</div>";
                        echo "<span>" . $favresult[$i]['Pages'] . "Page" . "</span>";
                        echo "<span> | " . $favresult[$i]['Publish-dat'] . "</span>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='position-absolute bottom-0 start-0 mb-3 ms-4'>" . $favresult[$i]['date'] . "</div>";
                        echo "</a>";
                    }
                    ?>
                </ul>
            </div>
            <br>
        </div>
    </div>
</div>
<!-- Start Footer -->
<?php require_once 'footer.php'?>
