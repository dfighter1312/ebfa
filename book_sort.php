<?php
    session_start();
    require_once "./functions/database_functions.php";
    //connect to the database
    $conn = db_connect();
    if($_GET['keyword']){
        $keyword = $_GET['keyword'];
        $row = getBookByKeyword($conn, $keyword);
    }
    else if($_GET['category']){
        $category = $_GET['category'];
        $row = getBookByCategory($conn, $category);
    }
    else if($_GET['author']){
        $author = $_GET['author'];
        //$row = getBookByAuthor($conn, $author);
    }
    else if($_GET['publisher']){
        $publisher = $_GET['publisher'];
        //$row = getBookByPublisher($conn, $publisher);
    }
    require "./template/header.php";
?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><a href="index.php">EBFA Bookstore</a> > 
                            <?php if($_GET['keyword'])
                                echo "Keyword > ", $keyword;
                            else if($_GET['category']){
                                echo "Category > ", $category;
                            }
                            else if($_GET['author']){
                                echo "Author > ", $author;
                            }
                            else if($_GET['publisher']){
                                echo "Publisher > ", $publisher;
                            }
                            ?>
                        </h1>
                    </div>
                    
                    <div class="row">
                        <?php foreach($row as $book) { ?>
                        <div class="col-xl-3 col-md-6 mb-4" type="button">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <a href="book.php?ISBN=<?php echo $book['ISBN']; ?>" class="text-decoration-none">                                        
                                        <h6 class="m-0 font-weight-bold text-primary"><?php echo $book['Title']; ?></h6>
                                    </a>
                                    <p class="m-0 font-weight-bold"> $ <?php echo $book['Price']; ?> </p>
                                    <p class="m-0 small text-gray-500"> <?php echo $book['Publisher']; ?> </p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

<?php
    require "./template/footer.php";
?>

