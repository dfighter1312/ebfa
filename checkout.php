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

	if(isset($_SESSION['order']) && (array_count_values($_SESSION['order']))){
        require './template/header.php';
?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><a href="index.php">EBFA Bookstore</a> > Purchase</h1>
                    </div>
                    
                    <div class="card mb-4 py-3 border-left-primary">
                        <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Item</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                                <?php
                                    foreach($_SESSION['order'] as $isbn => $qty){
                                        $conn = db_connect();
                                        $book = ($isbn < 0) ? getBook($conn, -$isbn) : getBook($conn, $isbn);
                                ?>
                            <tr>
                            <tr>
                                <td>
                                    <a href="book.php?ISBN=<?php echo $book['ISBN']; ?>" > 
                                        <?php echo $book['Title'] . " by " . $book['Publisher']; ?>
                                    </a>
                                </td>
                                <td><?php echo ($isbn < 0) ? "Rent" : "Buy" ?></td>
                                <td><?php echo "$" . $book['Price'] * (($isbn < 0) ? 0.1 : 1); ?></td>
                                <td><?php echo $qty, " ", ($isbn < 0) ? "week(s)" : "book(s)" ?></td>
                                <td><?php echo "$" . $qty * $book['Price'] * (($isbn < 0) ? 0.1 : 1); ?></td>
                            </tr>
                                <?php } ?>
                            <tr>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th><?php echo $_SESSION['total_items']; ?></th>
                                <th><?php echo "$" . $_SESSION['total_price']; ?></th>
                            </tr>
                        </table>
                    </div>
                    </div>
                    <div class="card mb-4 py-3 border-left-primary">
                        <div class="card-body">
                        <form method="post" action="purchase.php" class="form-horizontal">
                            <?php if(isset($_SESSION['err']) && $_SESSION['err'] == 1){ ?>
                                <p class="text-danger">All fields have to be filled</p>
                            <?php } 
                            if ($_SESSION['customerId'] == -1){ ?>
                                <p class="text-danger">You need to <a href="login.php" class="text-decoration-none">log in</a> or <a href="register.php" class="text-decoration-none">sign up</a> to continue your purchase</p>
                            <?php }
                            else {
                            ?>
                            <p> Check your personal information below. If anything is not true, click <a href="profile.php" class="text-decoration-none">here</a> to edit. </p>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <p class="m0">Name</p>
                                    <p class="ml-4 font-weight-bold"><?php echo $_SESSION['first_name'], " ", $_SESSION['last_name']; ?></p>
                                    <p class="m0">Phone number</p>
                                    <p class="ml-4 font-weight-bold"><?php echo $_SESSION['phone_no']; ?></p>
                                    <p class="m0">Address</p>
                                    <p class="ml-4 font-weight-bold"><?php echo $_SESSION['address']; ?></p>
                                </div>
                                <div class="col-lg-6">
                                    <p class="m0">City</p>
                                    <p class="ml-4 font-weight-bold"><?php echo $_SESSION['city']; ?></p>
                                    <p class="m0">State/Country</p>
                                    <p class="ml-4 font-weight-bold"><?php echo $_SESSION['state']; ?></p>
                                    <p class="m0">Payment Method</p>
                                    <div class="col-6 mb-4">
                                        <select name="inputState" class="form-control sm-3">
                                            <option selected>Bank Transfer</option>
                                            <option>Credit Card 1: VISA ACB</option>
                                            <option>Credit Card 2: VISA PPL</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <a href="process.php" class="btn btn-primary mb-4">Confirm Purchase</a>
                        <p>Please press Purchase to confirm your information, or <a href="index.php" class="text-decoration-none">Continue Shopping</a> to add or remove items.</p>

                    <?php
                        }    
    } else {
        echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
    }
    if(isset($conn)){ mysqli_close($conn); }
        require_once "./template/footer.php";
    ?>
                        </div>
                    </div>
<?php
    require './template/footer.php';
?>