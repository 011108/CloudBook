<?php
require_once 'header.php';

// this for this page ##############################
//get the result of search
$search = $book->search_book($_REQUEST['search']);
$count = count($search);


?>

<!--Start Main Boxe-->
<div class="container">
    <?php

    if (sizeof($search)) {
        echo "<center>" . "<h3 class='title' style=' color:#1f9304; '>" . $count . "  " . 'Results' . "</h3>" . "</center>";
        for ($i = 0; $i < sizeof($search); $i += 1) {
            $author_name = $authores->Book_Author($search[$i]['Code']);
            echo "<div class='Main_Book' >";
            echo "<img src='imgs/" . $search[$i]['Cover'] . "' width= '120px' max-width= '189px''>";
            echo "<div class='content' >";
            echo "<h2>" . $search[$i]['Title'] . "</h2>";
            echo "<div class='Author'>" . "Author : " . $author_name . "</div>";
            echo "<span>" . $search[$i]['Pages'] . "</span> pages " . " |  ";
            echo "<span>" . $search[$i]['Publish-dat'] . "</span>";
            echo "<div class='ReadBott'  >\n";
            echo "<a href='Book_Review.php?Code=" . $search[$i]['Code'] . "' style=' background-color: #2196f3; color: white; padding: 5px; margin-right: 10px; ' > Open </a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        echo "<center>" . "<h3 class='title'>" . "Similar Books" . "</h3>" . "</center>";
        // query for similar books
        $result2 = $categories->Display_Ctg_Books($search[0]['Category_id']);
        $countsimilar = sizeof($result2);
    } else {
        echo "<center>" . "<h3 class='error'>" . "Not Found" . "</h3>" . "</center>";
        echo "<hr>";
        echo "<center>" . "<h3 class='title'>" . "Other Books" . "</h3>" . "</center>";
        //query for other books
        $result3 = $book->display_random_books(8);
    }
    ?>
</div>
<!--End Main Boxe-->
<!--Strt Similar-->
<div class="Similar">
    <div class="container">
        <?php
        if (sizeof($search)) {
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
        } else {
            for ($iii = 0; $iii < 8; $iii++) {
                $author_name = $authores->Book_Author($result3[$iii]['Code']);
                echo "<a href='Book_Review.php?Code=" . $result3[$iii]['Code'] . "'><div class='similar_book'>";
                echo "<img src='imgs/" . $result3[$iii]['Cover'] . "' height : '97px' '>";
                echo "<div class='content' >";
                echo "<h4 style=' color: black; '>" . $result3[$iii]['Title'] . "</h4>";
                echo "<div style=' color: black;' class='Author'>" . "Author : " . "<span style=' color: #2196f3; '>" . $author_name . "</span>" . "</div>";
                echo "<span style=' color: #2196f3; ' >" . $result3[$iii]['Pages'] . "</span><span style=' color: black; '> pages </span> " . " |  ";
                echo "<span style=' color: #2196f3; ' >" . $result3[$iii]['Publish-dat'] . "</span>";
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
<?php require_once 'footer.php'?>