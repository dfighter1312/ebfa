<?php 
    require_once './functions/database_functions.php';
    require './template/header_admin.php';
?>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Best seller author of a day</h1>
    </div>

    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
        <form method="post" action="opt_author.php">
            <input class="mb-4" type="date" name="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : "" ?>">
            <input type="submit" class="btn btn-primary" name="get" value="Get Author">
        </form>
<?php 
    if(isset($_POST['date'])){
        $row = getMostBoughtAuthor($_POST['date']); ?>
        <table class="table">
                                <tr>
                                    <th>Author Name</th>
                                    <th>Book Purchased</th>
                                </tr>
                                <?php
                                    foreach($row as $au){
                                ?>
                                <tr>
                                    <td><?php echo $au['fname'], " ", $au['lname']; ?></td>
                                    <td><?php echo $au['SUM(quantity)']; ?></td>
                                </tr>
                                <?php } ?>
        </table>
        </div>
    </div>
<?php    }
?>