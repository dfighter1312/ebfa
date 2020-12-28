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
        $a = updateCustomer($_SESSION['customerId'], $_POST['first_name'], $_POST['last_name'], $_POST['phone_no'], $_POST['address'], $_POST['city'], $_POST['state']);
        if(!$a){
            $_SESSION['c'] = 1;
        }
        else {
            $_SESSION['c'] = 0;
            $_SESSION['first_name'] = $_POST['first_name'];
            $_SESSION['last_name'] = $_POST['last_name'];
            $_SESSION['phone_no'] = $_POST['phone_no'];
            $_SESSION['address'] = $_POST['address'];
            $_SESSION['city'] = $_POST['city'];
            $_SESSION['state'] = $_POST['state'];
        }
    }
    require './template/header.php';
?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><a href="index.php">EBFA Bookstore</a> > Profile</h1>
                    </div>
                    
                    <div class="card mb-4 py-3 border-left-primary">
                        <div class="card-body">
                        <form method="post" action="profile.php" class="form-horizontal">
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
                                <p class="m0">First Name</p>
                                <input class="mb-4" type="text" name="first_name" value="<?php echo $_SESSION['first_name']?>">
                                <p class="m0">Last Name</p>
                                <input class="mb-4" type="text" name="last_name" value="<?php echo $_SESSION['last_name']?>" maxlength="10">
                                <p class="m0">Phone number</p>
                                <input type="text" name="phone_no" value="<?php echo $_SESSION['phone_no']; ?>">
                                <p class="text-gray-600 small mb-4">Your telephone number must have 10 digits.</p>
                                <p class="m0">Address</p>
                                <input class="mb-4" type="text" name="address" value="<?php echo $_SESSION['address']; ?>">
                                <p class="m0">City</p>
                                <input class="mb-4" type="text" name="city" value="<?php echo $_SESSION['city']; ?>">
                                <p class="m0">State/Country</p>
                                <input type="text" name="state" value="<?php echo $_SESSION['state']; ?>" maxlength="2">
                                <p class="text-gray-600 small mb-4">The 2 capital letters represent your state/country.</p>
                                <div></div>
                                <input type="submit" class="btn btn-primary" name="save_change" value="Save Changes">
                            </div>
                        </form>
                        </div>
                    </div>
                            <?php } ?>

<?php
    require './template/footer.php';
?>