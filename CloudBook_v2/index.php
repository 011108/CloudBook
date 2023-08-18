<?php
$_SESSION['title'] = 'Cloud Book';
$_SESSION['style'] = 'css/main.css';
require_once 'header.php';
?>
    <!-- Start Landing -->
    <div class="landing">
      <div class="container">
	    <h1 style="color:#2196f3;"  >Cloud Book</h1>
	    <p>
	      Here you can found any book you need about any topic , art and historic ,etc .
	    </p>
        <form action="Searching.php" method="get">
          <input onkeyup="showResult(this.value)" type="search" placeholder=" Title of The Book " name="search" required/>
          
          <input type="submit" value="Search"  />
        </form>
      </div>
    </div>
    <!-- End Landing -->
    <!-- Start Articles -->
    <div class="recommended" id="recommended">
      <h2 class="main-title">Recommended</h2>
      <div class="container">
         <?php 
           $recommend = $books->display_random_books(9);
           for($i=0; $i<9; $i++){
           $author_name = $authores->Book_Author($recommend[$i]['Code']);
           $_SESSION['TargetCode'] = $recommend[$i]['Code'];
         ?>
          <div class="box" >
           <?php echo "<img src='imgs/".$recommend[$i]['Cover']."' width= '100' max-width= '100' height='64%' '>";?>
           <div class="content">
             <h4><?php echo $recommend[$i]['Title'] ?></h4>
	           <div>Author : <?php echo $author_name ?></div>
	           <span> <?php echo $recommend[$i]['Pages']  ?>  pages </span>|
	           <span> <?php echo $recommend[$i]['Publish-dat']  ?> </span>|
	           <span>9801 Reading</span>
	         </div>
          <a class="info"  href="Book_Review.php?Code=<?php echo $recommend[$i]['Code'];?>">
            <p>Open</p>
          </a>
      </div> 
         <?php
           } //end of loop 
         ?>
      </div>

    </div>
    <div class="position-relative">
     <nav class="position-absolute top-50 start-50 translate-middle  " aria-label="Page navigation example">
      <ul class="pagination">
          <li class="page-item">
              <a class="page-link" href="#" aria-label="Previous"> <span aria-hidden="true">&laquo;</span> </a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
              <a class="page-link" href="#" aria-label="Next"> <span aria-hidden="true">&raquo;</span> </a>
          </li>
      </ul>
  </nav>
    </div><br>
    <!-- End Articles -->
    
    <!-- 
      start Categories book
      لما نتعلم الاجاكس هنعمل اوتو لوود للكاتيجوريز الموجودة في اكتر من صفحه 
    -->

    <!-- Start Stats -->
    <div class="stats" id="stats">
    <h2 class="main-title">States</h2>
      <center><div class="container">
        <div class="box">
           <i class="fas fa-book fa-2x "></i>
           <span class="number" data-goal="150"><?php echo $books->count_books();?></span>
           <span class="text">Books</span>
        </div>
        <div class="box">
          <i class="fas fa-list fa-2x fa-fw"></i>
          <span class="number" data-goal="135"><?php echo $categories->count_category();?></span>
          <span class="text">Categories</span>
        </div>
      </div></center>
    </div>
    <!-- End Stats -->
<!-- Start Footer -->
<?php require_once 'footer.php'?>
