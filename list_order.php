<!DOCTYPE html>
<html lang="en">

<?php
	// the shopping order needs sessions, to start one
	/*
		Array of session(
			order => array (
				book_isbn (get from $_POST['book_isbn']) => number of books
			),
			items => 0,
			total_price => '0.00'
		)
	*/
	session_start();
	require_once "./functions/database_functions.php";
    require_once "./functions/cart_functions.php";
    $conn = db_connect();
    require './template/header.php';
    $row = getListOrder($_SESSION['customerId']);
?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><a href="index.php">EBFA Bookstore</a> > Order Log</h1>
                    </div>
                    
                    <div class="card mb-4 py-3 border-left-primary">
                        <div class="card-body">
                        <?php if ($_SESSION['customerId'] == -1){ ?>
                                <p class="text-danger">You need to <a href="login.php" class="text-decoration-none">log in</a> or <a href="register.php" class="text-decoration-none">sign up</a> to check your personal information</p>
                            <?php 
                            }
                            else {
                            ?>
                        <p>YOUR ORDER LIST</p>
                        <table class="table">
                            <tr>
                                <th>Order Number</th>
                                <th>Payment Method</th>
                                <th>Issue Date</th>
                                <th>Status</th>
                                <th>Total Cost</th>
                            </tr>
                                <?php
                                    foreach($row as $ord){
                                ?>
                            <tr>
                            <tr>
                                <td><a href="order_detail.php?order_id=<?php echo $ord['order_id']; ?>" class="text-decoration-none"> <?php echo $ord['order_id']; ?> </a> </td>
                                <td> <?php echo $ord['pmethod']; ?> </td>
                                <td> <?php echo $ord['issue_date']; ?> </td>
                                <td> <?php echo $ord['status']; ?> </td>
                                <td> <?php echo $ord['total_cost']; ?> </td>
                            </tr>
                                <?php } ?>
                        </table>

    <?php } ?>
                        </div>
                    </div>
<?php
    require './template/footer.php';
?>