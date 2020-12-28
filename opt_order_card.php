<?php 
    require_once './functions/database_functions.php';
    require './template/header_admin.php';
?>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List purchased by credit card</h1>
    </div>

    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
        <form method="post" action="opt_order_card.php">
            <input class="mb-4" type="date" name="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : "" ?>">
            <input class="mb-4" type="checkbox" name="failed"> 
            <label> Failed Purchases </label>
            <input type="submit" class="btn btn-primary" name="get" value="Get Order">
        </form>
<?php 
    if(isset($_POST['date'])){
        if(!isset($_POST['failed'])){
            $row = getOrderByCard($_POST['date']);
        }
        else
        {
            $row = getFailedOrderByCard($_POST['date']);
        } ?>
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
                                <td> <?php echo $ord['order_id']; ?> </a> </td>
                                <td> <?php echo $ord['pmethod']; ?> </td>
                                <td> <?php echo $ord['issue_date']; ?> </td>
                                <td> <?php echo $ord['status']; ?> </td>
                                <td> <?php echo $ord['total_cost']; ?> </td>
                            </tr>
                                <?php } ?>
        </table>
        </div>
    </div>
<?php    }
?>