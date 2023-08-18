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

            <div class="list-group">
                <button class="text-white bg-primary btn btn-lg dropdown-toggle list-group-item d-flex justify-content-between align-items-center"
                        type="button" data-toggle="dropdown" aria-expanded="false">
                    <span class="badge bg-primary rounded-pill"><?php echo $countSaved ?></span> Saved Books
                </button>
                <ul class="container dropdown-menu w-100">
                    <?php
                    for ($ii = 0; $ii < $countSaved; $ii++) {
                        $author_name = $authores->Book_Author($resultSaved[$ii]['Code']);
                        ?>
                        <li>
                            <a class="w-100 dropdown-item list-group-item" href="Book_Review.php?Code=<?php echo $resultSaved[$ii]['Code']; ?>">
                                <div position-relative class="boxx">
                                    <img src="imgs/<?php echo $resultSaved[$ii]['Cover']; ?>">
                                    <div class="content">
                                        <h6 class=""><?php echo $resultSaved[$ii]['Title']; ?></h6>
                                        <div><?php echo "Author: " . $author_name; ?></div>
                                        <span><?php echo $resultSaved[$ii]['Pages'] . " Page"; ?></span>
                                        <span> | <?php echo $resultSaved[$ii]['Publish-dat']; ?></span>
                                    </div>
                                </div>
                                <div class="position-absolute bottom-0 start-0 mb-3 ms-4"><?php echo $resultSaved[$ii]['date']; ?></div>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <br>

            <div class="list-group btn-group">
                <button class="text-white bg-primary btn btn-lg dropdown-toggle list-group-item d-flex justify-content-between align-items-center"
                        type="button" data-toggle="dropdown" aria-expanded="false">
                    <span class="badge bg-primary rounded-pill"><?php echo $countFav ?></span> Favorites Books
                </button>
                <ul class="dropdown-menu w-100">
                    <?php
                    for ($i = 0; $i < $countFav; $i++) {
                        $author_name = $authores->Book_Author($favresult[$i]['Code']);
                        ?>
                        <li>
                            <a class="w-100 dropdown-item list-group-item" href="Book_Review.php?Code=<?php echo $favresult[$i]['Code']; ?>">
                                <div class="position-relative boxx">
                                    <img src="imgs/<?php echo $favresult[$i]['Cover']; ?>">
                                    <div class="content">
                                        <h6><?php echo $favresult[$i]['Title']; ?></h6>
                                        <div><?php echo "Author: " . $author_name; ?></div>
                                        <span><?php echo $favresult[$i]['Pages'] . " Page"; ?></span>
                                        <span> | <?php echo $favresult[$i]['Publish-dat']; ?></span>
                                    </div>
                                </div>
                                <div class="position-absolute bottom-0 start-0 mb-3 ms-4"><?php echo $favresult[$i]['date']; ?></div>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <br>
        </div>
    </div>
</div>
<!-- Start Footer -->
<?php require_once 'footer.php'?>
<!-- End Footer -->