<?php 
    require_once './functions/database_functions.php';
    require './template/header_admin.php';
?>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Total number of books purchased in a day</h1>
    </div>

    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
        <form method="post" action="opt_all_book_day.php">
            <input class="mb-4" type="date" name="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : "" ?>">
            <input type="submit" class="btn btn-primary" name="get" value="Get Book">
        </form>
<?php 
    if(isset($_POST['date'])){
        $row = getTotalBookInDay($_POST['date']); 
        $r2 = getTotalEBookInDay($_POST['date']);
        $r3 = getTotalPrintedBookInDay($_POST['date']);
        $r2 = $r2 == "" ? 0 : $r2;
        $r3 = $r3 == "" ? 0 : $r3;
        $r1 = $r2 + $r3;
        $row2 = getTotalBookLentDay($_POST['date']);
        $r4 = getTotalEBookLentDay($_POST['date']);
        $r4 = $r4 == "" ? 0 : $r4;
        ?>
        <p class="h3 mb-4 text-gray-800">Date Summary</p>
        <p class="text-gray-800">Total Book Purchased: <i class="font-weight-bold"><?php echo $r1 ?></i></p>
        <p class="text-gray-800">Printed Book Purchased: <i class="font-weight-bold"><?php echo $r2  ?></i></p>
        <p class="text-gray-800">E Book Purchased: <i class="font-weight-bold"><?php echo $r3 ?></i></p>
        <table class="table">
                                <tr>
                                    <th>ISBN</th>
                                    <th>Title</th>
                                    <th>Year</th>
                                    <th>Price</th>
                                    <th>Publisher</th>
                                    <th>Number Purchased</th>
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
                                    <td><?php echo $isbn['SUM(quantity)']; ?></td>
                                </tr>
                                <?php } ?>
        </table>
        <p class="text-gray-800">E-Book Lent: <i class="font-weight-bold"><?php echo $r4 ?></i></p>
        <table class="table">
                                <tr>
                                    <th>ISBN</th>
                                    <th>Title</th>
                                    <th>Year</th>
                                    <th>Price</th>
                                    <th>Publisher</th>
                                    <th>Number Lent</th>
                                </tr>
                                <?php
                                    foreach($row2 as $isbn){
                                        $conn = db_connect();
                                        $book = getBook($conn, $isbn['ISBN']);
                                ?>
                                <tr>
                                    <td><?php echo $book['ISBN']; ?></a></td>
                                    <td><?php echo $book['Title']; ?></td>
                                    <td><?php echo $book['Year']; ?></td>
                                    <td><?php echo $book['Price']; ?></td>
                                    <td><?php echo $book['Publisher']; ?></td>
                                    <td><?php echo $isbn['COUNT(*)']; ?></td>
                                </tr>
                                <?php } ?>
        </table>

<?php    }
?>