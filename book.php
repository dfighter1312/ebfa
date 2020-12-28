<?php
    session_start();
    $book_isbn = $_GET['ISBN'];
    // connecto database
    require_once "./functions/database_functions.php";
    $conn = db_connect();
    $row = getBook($conn, $book_isbn);
    $st = True;
    require "./template/header.php";
?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><a href="index.php">EBFA Bookstore</a> > <?php echo $row['Title'] ?></h1>
                    </div>
                    
                    <div class="card mb-4 py-3 border-left-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <p>  </p>
                                </div>
                                <div class="col-lg-6">
                                    <h6 class="h4 m-0 font-weight-bold text-primary mb-2"><?php echo $row['Title']; ?></h6>
                                    <p class="h1 m-0 font-weight-bold text-danger mb-4"> $ <?php echo $row['Price']; ?> </p>
                                    <table class="table">
          	                        <?php foreach($row as $key => $value){
                                    if($key == "ISBN" || $key == "Publisher" || $key == "Year" || $key == "stock_status"){
                                        if($key == "stock_status"){
                                            $key = "Status";
                                            if($value == "out of stock"){
                                                $st = False;
                                            }
                                            else {
                                                $st = True;
                                            }
                                        }
                                    }
                                    else continue;
                                    ?>
                                    <tr>
                                    <td><?php echo $key; ?></td>
                                    <td><?php echo $value; ?></td>
                                    </tr>
                                    <?php 
                                    } 
                                    if(isset($conn)) {
                                        mysqli_close($conn); 
                                    }
                                    ?>
                                    <td> Author </td>
                                    <td><?php echo getAuthorWriteBooks($book_isbn) ?></td>
                                    </tr>
                                    </table>
                                    
                                    <form method="post" action="cart.php">
                                        <!-- <div class="col-lg-2 mb-2"> -->
                                            <!-- <div class="row"> -->
                                                <?php if($st){ ?>
                                                <div class="form-group">
                                                    <label for="number" class="form-text">Quantity</label>
                                                    <input type="hidden" name="bookisbn" value="<?php echo $book_isbn;?>">
                                                    <input type="number" name="qty" id="number" value="1" class="mb-2 w-25">
                                                    <?php if(isEBook($book_isbn)){ ?>
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input" id="rent" name="rent">
                                                            <label class="form-check-label" for="exampleCheck1">For Rent</label>
                                                    </div>
                                                    <?php } ?>
                                                    <input type="submit" value="Purchase / Add to cart" name="order" class="btn btn-primary">
                                                </div>
                                                <?php } ?>
                                            <!-- </div> -->
                                        <!-- </div> -->
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

<?php
    require "./template/footer.php";
?>

