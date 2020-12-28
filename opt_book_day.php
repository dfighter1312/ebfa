<?php 
    require_once './functions/database_functions.php';
    require './template/header_admin.php';
?>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List of books purchased in a day</h1>
    </div>

    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
        <form method="post" action="opt_book_day.php">
            <input class="mb-4" type="date" name="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : "" ?>">
            <input type="submit" class="btn btn-primary" name="get" value="Get Book">
        </form>
<?php 
    if(isset($_POST['date'])){
        $row = getBookInDay($_POST['date']); ?>
        <table class="table">
                                <tr>
                                    <th>ISBN</th>
                                    <th>Title</th>
                                    <th>Year</th>
                                    <th>Price</th>
                                    <th>Publisher</th>
                                    <th>From Order</th>
                                </tr>
                                <?php
                                    foreach($row as $isbn){
                                        $conn = db_connect();
                                        $book = getBook($conn, $isbn['ISBN']);
                                ?>
                                <tr>
                                    <td><?php echo $book['ISBN']; ?></a></td>
                                    <td><?php echo $book['Title']; ?></td>
                                    <td><?php echo $book['Year']; ?></td>
                                    <td><?php echo $book['Price']; ?></td>
                                    <td><?php echo $book['Publisher']; ?></td>
                                    <td><?php echo $isbn['oid']; ?></td>
                                </tr>
                                <?php } ?>
        </table>
        </div>
    </div>
<?php    }
?>