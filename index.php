<!DOCTYPE html>
<html lang="en">

<?php 
    session_start();
    require_once './functions/database_functions.php';
    //customerId = -1 if guest. Otherwise take the customerId from the database.
    if(!isset($_SESSION['customerId'])){
        $_SESSION['customerId'] = -1;
        $_SESSION['first_name'] = 'Guest';
        $_SESSION['last_name'] = '';
    }
    elseif (isset($_POST['username']) && isset($_POST['password'])) {
        $cus = getCustomer($_POST['username'], $_POST['password']);
        if($cus){
            $_SESSION['customerId'] = $cus['customer_id'];
            $_SESSION['first_name'] = $cus['first_name'];
            $_SESSION['last_name'] = $cus['last_name'];
            $_SESSION['phone_no'] = $cus['phoneno'];
            $_SESSION['address'] = $cus['address'];
            $_SESSION['city'] = $cus['city'];
            $_SESSION['state'] = $cus['state'];
            unset($_POST);
        }
        else {
            header("Location:login.php?wronginfo=1");
        }
    }
    $count = 0;
    require_once "./functions/database_functions.php";
    $conn = db_connect();
    $row = getAllBooks($conn);
    require './template/header.php';
?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">EBFA Bookstore</h1>
                    </div>
                    
                    <div class="row">
                        <?php foreach($row as $book) { ?>
                        <div class="col-xl-3 col-md-6 mb-4" type="button">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <a href="book.php?ISBN=<?php echo $book['ISBN']; ?>" class="text-decoration-none">                                        
                                        <h6 class="m-0 font-weight-bold text-primary"><?php echo $book['Title']; ?></h6>
                                    </a>
                                    <p class="m-0 font-weight-bold"> $ <?php echo $book['Price']; ?> </p>
                                    <p class="m-0 small text-gray-500"> <?php echo $book['Publisher']; ?> </p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

<?php
    require './template/footer.php';
?>