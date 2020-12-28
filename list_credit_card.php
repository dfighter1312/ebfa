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
    $row = getListCard($_SESSION['customerId']);
?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><a href="index.php">EBFA Bookstore</a> > Credit Card</h1>
                    </div>
                    
                    <div class="card mb-4 py-3 border-left-primary">
                        <div class="card-body">
                        <?php if ($_SESSION['customerId'] == -1){ ?>
                            <p class="text-danger">You need to <a href="login.php" class="text-decoration-none">log in</a> or <a href="register.php" class="text-decoration-none">sign up</a> to check your personal information</p>
                        <?php 
                        }
                        else {
                        ?>
                        <p>YOUR CREDIT CARD LIST</p>
                        <table class="table">
                            <tr>
                                <th>Card Number</th>
                                <th>Expired Date</th>
                                <th>Bank Name</th>
                                <th>Bank Branch</th>
                            </tr>
                                <?php
                                    foreach($row as $card){
                                ?>
                            <tr>
                            <tr>
                                <td> <?php echo $card['card_id']; ?> </td>
                                <td> <?php echo $card['exp_date']; ?> </td>
                                <td> <?php echo $card['bank_name']; ?> </td>
                                <td> <?php echo $card['bank_branch']; ?> </td>
                            </tr>
                                <?php } ?>
                        </table>
                        <a href="credit_card.php" class="btn btn-primary">Add More Credit Card</a> 

    <?php
                        }
    if(isset($conn)){ mysqli_close($conn); }
    ?>
                        </div>
                    </div>
<?php
    require './template/footer.php';
?>