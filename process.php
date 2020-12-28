<?php
	session_start();

	$_SESSION['err'] = 1;
	foreach($_POST as $key => $value){
		if(trim($value) == ''){
			$_SESSION['err'] = 0;
		}
		break;
	}

	if($_SESSION['err'] == 0){
		header("Location:purchase.php");
	} else {
		unset($_SESSION['err']);
	}

	require_once "./functions/database_functions.php";
	// connect database
	$conn = db_connect();
	// print out header here
	$title = "Purchase Process";
	require "./template/header.php";
	// extract($_SESSION['ship']);

	// validate post section
	$card_id = $_POST['card_id'];
	$pmethod = $card_id == -1 ? 'Bank Deposit' : 'Credit Card';
	$status = 'Purchasing';
	$customer_id = $_SESSION['customerId'];
	$date = date("Y-m-d");
	$total_price = $_SESSION['total_price'];
	$order_id = insertIntoOrder($customer_id, $pmethod, $date, $status, $total_price);

	foreach($_SESSION['order'] as $isbn => $qty){
		if ($isbn < 0){
			//insert into rent order
			$interval = ' + ' . strval($qty) . ' days';
			$return_date = date('Y-m-d', strtotime($date. $interval));
			$a = insertIntoRentOrder($order_id, -$isbn, $return_date);
		}
		else {
			//insert into buy order
			$a = insertIntoBuyOrder($order_id, $isbn, $qty);
		}
	}

	unset($_SESSION['order']);
?>
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><a href="index.php">EBFA Bookstore</a> > Order</h1>
					</div>
					<div class="card mb-4 py-3 border-left-primary">
						<div class="card-body">
							<p class="lead text-success">Your order has been processed sucessfully. </p>
							<p class="lead text-success">Please check your email to get your order confirmation and shipping detail!. </p>
							<p class="lead text-success">Your cart has been empty.</p>
						</div>
					</div>

<?php
	if(isset($conn)){
		mysqli_close($conn);
	}
	require_once "./template/footer.php";
?>