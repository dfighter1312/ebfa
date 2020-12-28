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

	if(isset($_POST['save_change'])){
        $a = insertCreditCard($_POST['card_id'], $_POST['exp_date'], $_POST['bank_name'], $_POST['bank_branch'], $_SESSION['customerId']);
        if(!$a){
            $_SESSION['c'] = 1;
        }
        else {
            $_SESSION['c'] = 0;
        }
    }
    require './template/header.php';
?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><a href="index.php">EBFA Bookstore</a> > <a href="list_credit_card.php">Credit Card</a> > Add Card</h1>
                    </div>
                    
                    <div class="card mb-4 py-3 border-left-primary">
                        <div class="card-body">
                        <form method="post" action="credit_card.php" class="form-horizontal">
                            <?php if(isset($_SESSION['c']) && $_SESSION['c'] == 1){ ?>
                                <p class="text-danger">One of the fields has the wrong format. Check and correct it.</p>
                            <?php 
                                unset($_SESSION['c']);
                            } 
                            else if(isset($_SESSION['c']) && $_SESSION['c'] == 0) { ?>
                                <p class="text-success">Successfully changed your information.</p>
                            <?php 
                                unset($_SESSION['c']);
                            }
                            if ($_SESSION['customerId'] == -1){ ?>
                                <p class="text-danger">You need to <a href="login.php" class="text-decoration-none">log in</a> or <a href="register.php" class="text-decoration-none">sign up</a> to check your personal information</p>
                            <?php 
                            }
                            else {
                            ?>
                            <div class="col mb-4">
                                <p class="m0">Card Number</p>
                                <input class="mb-4" type="number" name="card_id" placeholder="12 digits" maxlength="12">
                                <p class="m0">Expired Date</p>
                                <input class="mb-4" type="date" name="exp_date" value="">
                                <p class="m0">Bank Name</p>
                                <input class="mb-4" type="text" name="bank_name" value="">
                                <p class="m0">Bank Branch</p>
                                <input class="mb-4" type="text" name="bank_branch" value="">
                                <div></div>
                                <input type="submit" class="btn btn-primary" name="save_change" value="Add Card">
                                <a href="list_credit_card.php" class="btn btn-primary">Return</a> 
                            </div>
                        </form>
                        </div>
                    </div>
                            <?php } ?>

<?php
    require './template/footer.php';
?>