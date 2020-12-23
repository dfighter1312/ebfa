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

	// book_isbn got from form post method, change this place later.
	if(isset($_POST['bookisbn'])){
        if(!isset($_POST['rent'])){
            $book_isbn = $_POST['bookisbn'];
        }
        else{
            $book_isbn = -$_POST['bookisbn'];
        }
    }

	if(isset($book_isbn)){
		// new iem selected
		if(!isset($_SESSION['order'])){
			// $_SESSION['order'] is associative array that bookisbn => qty
			$_SESSION['order'] = array();
			$_SESSION['total_items'] = 0;
			$_SESSION['total_price'] = '0.00';
		}
        if(isset($_POST['qty'])){

		if(!isset($_SESSION['order'][$book_isbn])){
			$_SESSION['order'][$book_isbn] = $_POST['qty'];
        } 
        elseif(isset($_POST['order'])){
			$_SESSION['order'][$book_isbn] += $_POST['qty'];
			unset($_POST);
        }
        }
    }  

	// if save change button is clicked , change the qty of each bookisbn
	if(isset($_POST['save_change'])){
		foreach($_SESSION['order'] as $isbn =>$qty){
			if($_POST[$isbn] == '0'){
				unset($_SESSION['order']["$isbn"]);
			} else {
				$_SESSION['order']["$isbn"] = $_POST["$isbn"];
			}
		}
	}

	// print out header here
	$title = "Your shopping order";

	if(isset($_SESSION['order']) && (array_count_values($_SESSION['order']))){
		$_SESSION['total_price'] = total_price($_SESSION['order']);
        $_SESSION['total_items'] = total_items($_SESSION['order']);
?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><a href="index.php">EBFA Bookstore</a> > Order</h1>
                    </div>
                    
                    <div class="card mb-4 py-3 border-left-primary">
                        <div class="card-body">
                        <form action="cart.php" method="post">
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
                                        // $book = mysqli_fetch_assoc(getBook($conn, $isbn));
                                        $book = ($isbn < 0) ? getBook($conn, -$isbn) : getBook($conn, $isbn);
                                ?>
                                <tr>
                                    <td>
                                        <a href="book.php?ISBN=<?php echo $book['ISBN']; ?>" > 
                                            <?php echo $book['Title'] . " by " . $book['Publisher']; ?>
                                        </a>
                                    </td>
                                    <td><?php echo ($isbn < 0) ? "Rent" : "Buy" ?></td>
                                    <td><?php echo "$" . $book['Price'] * (($isbn < 0) ? 0.1 : 1); ?></td>
                                    <td><input type="text" value="<?php echo $qty; ?>" size="2" name="<?php echo $isbn; ?>"><?php echo ($isbn < 0) ? " week(s)" : " book(s)" ?></td>
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
                            <input type="submit" class="btn btn-primary" name="save_change" value="Save Changes">
                        </form>
                        <br/><br/>
                        <a href="checkout.php" class="btn btn-primary">Go To Checkout</a> 
                        <a href="index.php" class="btn btn-primary">Continue Shopping</a>
    <?php
    } else {
        echo "<p class=\"text-warning\">Your order is empty! Please make sure you add some books in it!</p>";
    }
    if(isset($conn)){ mysqli_close($conn); }
    ?>
                        </div>
                    </div>
<?php
    require './template/footer.php';
?>
