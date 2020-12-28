<?php
    require './template/header_admin.php';
?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Staff Control</h1>
        <p class="mb-0">Choose an method</h1>
    </div>
                    
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            <a href="opt_in_stock.php" class="font-weight-bold">Update information about books when they are in stock</a>
        </div>
    </div>

    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            <a href="opt_out_stock.php" class="font-weight-bold">Update information about books when they are out of stock</a>
        </div>
    </div>

    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            <a href="opt_fail_trans.php" class="font-weight-bold">Update transaction information when there are problems with online transactions</a>
        </div>
    </div>

    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            <a href="opt_book_day.php" class="font-weight-bold">See all books by ISBN purchased in a day</a>
        </div>
    </div>

    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            <a href="opt_all_book_day.php" class="font-weight-bold">See the statistic in a day</a>
        </div>
    </div>

    <!-- <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            <a href="opt_day_printed_book.php" class="font-weight-bold">See the total number of printed books purchased in a day</a>
        </div>
    </div>

    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            <a href="opt_day_e_book.php" class="font-weight-bold">See the total number of e-books purchased in a day</a>
        </div>
    </div> -->

    <!-- <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            <a href="#" class="font-weight-bold">See the total number of e-books lent in a day</a>
        </div>
    </div> -->

    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            <a href="opt_author.php" class="font-weight-bold">See the authors list with the most purchased books per day</a>
        </div>
    </div>

    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            <a href="opt_book_month.php" class="font-weight-bold">See the list of most bought in a month</a>
        </div>
    </div>

    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            <a href="opt_order_card.php" class="font-weight-bold">View a list of purchases paid by card for one day</a>
        </div>
    </div>

    <!-- <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            <a href="#" class="font-weight-bold">View a list of purchases paid with a card with trouble for one day</a>
        </div>
    </div> -->

    <!-- <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            <a href="#" class="font-weight-bold">See a list of warehouses with books per ISBN having less than 10 books per day</a>
        </div>
    </div>

    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            <a href="#" class="font-weight-bold">See the total number of books per ISBN per warehouse for a month</a>
        </div>
    </div> -->

    <!-- <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            <a href="#" class="font-weight-bold">View a list of the best-seller in a month</a>
        </div>
    </div> -->