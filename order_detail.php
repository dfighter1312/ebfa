<!DOCTYPE html>
<html lang="en">

<?php
	require_once "./functions/database_functions.php";
    require_once "./functions/cart_functions.php";
    $conn = db_connect();
    require './template/header.php';
	// print out header here
    $title = "Your shopping order";
    $row = getOrder($_GET['order_id']);
    $row_buy = getItemFromBuyOrder($_GET['order_id']);
    $row_rent = getItemFromRentOrder($_GET['order_id']);
?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><a href="index.php">EBFA Bookstore</a> > Order</h1>
                    </div>
                    
                    <div class="card mb-4 py-3 border-left-primary">
                        <div class="card-body">
                            <p class="text-gray-800">Order Number</p>
                            <p class="ml-4 font-weight-bold"><?php echo $row['order_id']; ?></p>
                            <p class="text-gray-800">Payment Method</p>
                            <p class="ml-4 font-weight-bold"><?php echo $row['pmethod']; ?></p>
                            <p class="text-gray-800">Issue Date</p>
                            <p class="ml-4 font-weight-bold"><?php echo $row['issue_date']; ?></p>
                            <p class="text-gray-800">Status</p>
                            <p class="ml-4 font-weight-bold"><?php echo $row['status']; ?></p>
                            <p class="text-gray-800">Buy Item</p>
                            <table class="table">
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                                <?php
                                    foreach($row_buy as $buy){
                                        $conn = db_connect();
                                        $book = getBook($conn, $buy['buyid']);
                                ?>
                                <tr>
                                    <td>
                                        <a href="book.php?ISBN=<?php echo $book['ISBN']; ?>" > 
                                            <?php echo $book['Title'] . " by " . $book['Publisher']; ?>
                                        </a>
                                    </td>
                                    <td><?php echo "$" . $book['Price'] ?></td>
                                    <td><?php echo $buy['quantity'] ?></td>
                                    <td><?php echo "$" . $buy['quantity'] * $book['Price'] ?></td>
                                </tr>
                                <?php } ?>
                                <!-- <tr>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th><?php echo $_SESSION['total_items']; ?></th>
                                    <th><?php echo "$" . $_SESSION['total_price']; ?></th>
                                </tr> -->
                            </table>
                            <p class="text-gray-800">Rent Item</p>
                            <table class="table">
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Return Date</th>
                                    <th>Total</th>
                                </tr>
                                <?php
                                    foreach($row_rent as $rent){
                                        $conn = db_connect();
                                        $book = getBook($conn, $rent['rentid']);
                                ?>
                                <tr>
                                    <?php 
                                        $interval = date_diff(date_create($rent['return_date']), date_create($row['issue_date']));
                                        $interval = ceil(intval($interval->format('%a')) / 7); 
                                    ?>
                                    <td>
                                        <a href="book.php?ISBN=<?php echo $book['ISBN']; ?>" > 
                                            <?php echo $book['Title'] . " by " . $book['Publisher']; ?>
                                        </a>
                                    </td>
                                    <td><?php echo "$" . $book['Price'] * 0.1 ?></td>
                                    <td><?php echo $rent['return_date'] ?></td>
                                    <td><?php echo "$" . $interval * $book['Price'] * 0.1 ?></td>
                                    
                                </tr>
                                <?php } ?>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th><?php echo "$" . $row['total_cost']; ?></th>
                                </tr>
                            </table>
                        <br/><br/>
                        <a href="list_order.php" class="btn btn-primary">Return</a> 
                        </div>
                    </div>
<?php
    require './template/footer.php';
?>
