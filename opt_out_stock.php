<?php 
    require_once './functions/database_functions.php';
    if($_GET['isbn']){
        $a = setStock($_GET['isbn'],'out of stock');
    }
    $conn = db_connect();
    $row = getAllBooks($conn);
    require './template/header_admin.php';
?>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Choose a book to set in stock</h1>
    </div>
                    
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
        <table class="table">
                                <tr>
                                    <th>ISBN</th>
                                    <th>Title</th>
                                    <th>Year</th>
                                    <th>Price</th>
                                    <th>Publisher</th>
                                    <th>Status</th>
                                </tr>
                                <?php
                                    foreach($row as $book){
                                ?>
                                <tr>
                                    <td><a href="opt_out_stock.php?isbn=<?php echo $book['ISBN']; ?>" class="text-decoration-none"><?php echo $book['ISBN']; ?></a></td>
                                    <td><?php echo $book['Title']; ?></td>
                                    <td><?php echo $book['Year']; ?></td>
                                    <td><?php echo $book['Price']; ?></td>
                                    <td><?php echo $book['Publisher']; ?></td>
                                    <td><?php echo $book['stock_status']; ?></td>
                                </tr>
                                <?php } ?>
        </table>
        </div>
    </div>