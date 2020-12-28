<?php 
    require_once './functions/database_functions.php';
    if($_GET['oid']){
        $a = setTrans($_GET['oid'],'Failed');
    }
    $conn = db_connect();
    $row = getAllOrder($conn);
    require './template/header_admin.php';
?>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Choose an order to set fail transaction</h1>
    </div>
                    
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
        <table class="table">
                                <tr>
                                    <th>Order Number</th>
                                    <th>Customer ID</th>
                                    <th>Payment Method</th>
                                    <th>Issue Date</th>
                                    <th>Status</th>
                                    <th>Total Cost</th>
                                </tr>
                                <?php
                                    foreach($row as $ord){
                                ?>
                                <tr>
                                    <td><a href="opt_fail_trans.php?oid=<?php echo $ord['order_id']; ?>" class="text-decoration-none"><?php echo $ord['order_id']; ?></a></td>
                                    <td><?php echo $ord['customer_id']; ?></td>
                                    <td><?php echo $ord['pmethod']; ?></td>
                                    <td><?php echo $ord['issue_date']; ?></td>
                                    <td><?php echo $ord['status']; ?></td>
                                    <td><?php echo $ord['total_cost']; ?></td>
                                </tr>
                                <?php } ?>
        </table>
        </div>
    </div>