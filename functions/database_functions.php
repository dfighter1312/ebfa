<?php
	function db_connect(){
		$conn = mysqli_connect("localhost", "root", "Hoangdung1312", "ebook_store");
		if(!$conn){
			echo "Can't connect to the database" . mysqli_connect_error($conn);
			exit;
		}
		return $conn;
	}

	function getAllBooks($conn){
		$query = "SELECT * FROM books ORDER BY ISBN DESC";
		$result = mysqli_query($conn, $query);
		if(!$result){
		    echo "Can't retrieve data " . mysqli_error($conn);
		    exit;
		}
		return $result;
	}

	function getAllOrder($conn){
		$query = "SELECT * FROM orders ORDER BY order_id DESC";
		$result = mysqli_query($conn, $query);
		if(!$result){
		    echo "Can't retrieve data " . mysqli_error($conn);
		    exit;
		}
		return $result;
	}

	function getBook($conn, $book_isbn){
		$query = "SELECT * FROM books WHERE ISBN = '$book_isbn'";
  		$result = mysqli_query($conn, $query);
  		if(!$result){
    		echo "Can't retrieve data " . mysqli_error($conn);
    		exit;
  		}
  		$row = mysqli_fetch_assoc($result);
  		if(!$row){
    		echo "Empty book";
    	exit;
  		}
		return $row;  
	}

	function getBookPrice($isbn){
		$conn = db_connect();
		$query = "SELECT Price FROM books WHERE ISBN = '$isbn'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "get book price failed! " . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['Price'];
	}

	function getKeyword($conn){
		// $conn = db_connect();
		$query = "SELECT keywords FROM keyword GROUP BY keywords ORDER BY keywords;";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "No keyword" . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getCategory($conn){
		// $conn = db_connect();
		$query = "SELECT category_name FROM category GROUP BY category_name ORDER BY category_name;";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "No category" . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getPublisher($conn){
		$query = "SELECT Publisher from books ORDER BY Publisher";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "No publisher" . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getAuthor($conn){
		// $conn = db_connect();
		$query = "SELECT author_id, fname, lname FROM authors ORDER BY fname;";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "No author" . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function isEBook($isbn){
		$conn = db_connect();
		$query = "SELECT eISBN FROM ebook WHERE eISBN = '$isbn';";
		$result = mysqli_query($conn, $query);
		$result = mysqli_fetch_assoc($result);
		return $result;
	}

	function getBookByKeyword($conn, $keyword){
		$query = "SELECT * FROM books, keyword WHERE keywords = '$keyword' AND ISBN = keybookid;";
		$result = mysqli_query($conn, $query);
		if(!$result){
		    echo "Can't retrieve data " . mysqli_error($conn);
		    exit;
		}
		return $result;
	}

	function getBookByCategory($conn, $category){
		$query = "SELECT * FROM books, category WHERE category_name = '$category' AND ISBN = catebookid;";
		$result = mysqli_query($conn, $query);
		if(!$result){
		    echo "Can't retrieve data " . mysqli_error($conn);
		    exit;
		}
		return $result;
	}

	function getMostPurchasedBook($date){
		$conn = db_connect();
		$query = "CALL id_purchased('$date')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "get most purchased book failed!". mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['total sale'];
	}

	function getCustomer($username, $password){
		$conn = db_connect();
		$query = "SELECT * FROM customer WHERE username = '$username' AND password = '$password';";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		return $row;
	}

	function updateCustomer($id, $fn, $ln, $phone, $addr, $city, $st){
		$conn = db_connect();
		$query = "SELECT customer_update($id, '$fn', '$ln', '$phone', '$addr', '$city', '$st');";
		$a = mysqli_query($conn, $query);
		return $a;
	}

	function insertCreditCard($cardId, $expdate, $bankname, $bankbranch, $owner){
		$conn = db_connect();
		$query = "INSERT INTO credit_card (card_id, exp_date, bank_name, bank_branch, owner_id) VALUES ('$cardId', '$expdate', '$bankname', '$bankbranch', '$owner');";
		$a = mysqli_query($conn, $query);
		return $a;
	}

	function getListCard($ownerId){
		$conn = db_connect();
		$query = "SELECT * FROM credit_card WHERE owner_id = '$ownerId';";
		$result = mysqli_query($conn, $query);
		return $result;
	}

	function getListOrder($cusId){
		$conn = db_connect();
		$query = "SELECT * FROM orders WHERE customer_id = $cusId;";
		$result = mysqli_query($conn, $query);
		return $result;
	}

	function getOrder($orderId){
		$conn = db_connect();
		$query = "SELECT * FROM orders WHERE order_id = $orderId;";
		$result = mysqli_fetch_assoc(mysqli_query($conn, $query));
		return $result;
	}

	function getBookByAuthor($conn, $authorId){
		$query = "SELECT * FROM books, written WHERE wauthorid=$authorId AND wbookid=ISBN;";
		$result = mysqli_query($conn, $query);
		return $result;
	}

	function getAuthorName($conn, $authorId){
		$query = "SELECT fname, lname FROM authors WHERE author_id = $authorId;";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		return $row;
	}

	function getBookByPublisher($conn, $publisher){
		$query = "SELECT * FROM books WHERE Publisher = '$publisher';";
		$result = mysqli_query($conn, $query);
		return $result;
	}

	function insertIntoOrder($cusId, $pmethod, $date, $status, $cost){
		$conn = db_connect();
		$query = "INSERT INTO orders (customer_id, pmethod, issue_date, status, total_cost) VALUES ($cusId, '$pmethod', '$date', '$status', $cost);";
		$query2 = "SELECT LAST_INSERT_ID();";
		$a = mysqli_query($conn, $query);
		$a = mysqli_fetch_row(mysqli_query($conn, $query2));
		return $a[0];
	}

	function insertIntoRentOrder($orderid, $bookid, $date){
		$conn = db_connect();
		$query = "INSERT INTO rent_order (roid, rentid, return_date) VALUES ($orderid, $bookid, '$date');";
		$a = mysqli_query($conn, $query);
		return $a;
	}

	function insertIntoBuyOrder($orderid, $bookid, $quantity){
		$conn = db_connect();
		$query = "INSERT INTO buy_order (oid, buyid, quantity) VALUES ($orderid, $bookid, $quantity);";
		$a = mysqli_query($conn, $query);
		return $a;
	}

	function getItemFromRentOrder($orderid){
		$conn = db_connect();
		$query = "SELECT * FROM rent_order WHERE roid = $orderid;";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "No buy item". mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getItemFromBuyOrder($orderid){
		$conn = db_connect();
		$query = "SELECT * FROM buy_order WHERE oid = $orderid;";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "No rent item". mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function setStock($isbn, $status){
		$conn = db_connect();
		$query = "SELECT book_stock_update($isbn, '$status');";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Failed". mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function setTrans($oid, $status){
		$conn = db_connect();
		$query = "SELECT order_status_update($oid, '$status');";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Failed". mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getBookInDay($date){
		$conn = db_connect();
		$query = "CALL id_purchased('$date');";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Failed". mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getTotalBookInDay($date){
		$conn = db_connect();
		$query = "CALL total_id_purchased('$date');";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Failed". mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getTotalBookLentDay($date){
		$conn = db_connect();
		$query = "CALL total_id_rented('$date');";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Failed". mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getTotalPrintedBookInDay($date){
		$conn = db_connect();
		$query = "CALL printed_book_purchased('$date');";
		$result = mysqli_fetch_assoc(mysqli_query($conn, $query));
		if(!$result){
			echo "Failed". mysqli_error($conn);
			exit;
		}
		return $result['SUM(quantity)'];
	}

	function getTotalEBookInDay($date){
		$conn = db_connect();
		$query = "CALL ebook_purchased('$date');";
		$result = mysqli_fetch_assoc(mysqli_query($conn, $query));
		if(!$result){
			echo "Failed". mysqli_error($conn);
			exit;
		}
		return $result['SUM(quantity)'];
	}

	function getTotalEBookLentDay($date){
		$conn = db_connect();
		$query = "CALL ebook_rented('$date');";
		$result = mysqli_fetch_assoc(mysqli_query($conn, $query));
		if(!$result){
			echo "Failed". mysqli_error($conn);
			exit;
		}
		return $result['COUNT(*)'];
	}

	function getMostBoughtAuthor($date){
		$conn = db_connect();
		$query = "CALL authors_most_purchased('$date');";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Failed". mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getBookInMonth($date){
		$conn = db_connect();
		$date = date_create($date);
		$m = intval(date_format($date,"n"));
		$y = intval(date_format($date,"Y"));
		$query = "CALL most_bought_month($m, $y);";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Failed". mysqli_error($conn);
			exit;
		}
		echo "Finished";
		return $result;
	}

	function getOrderByCard($date){
		$conn = db_connect();
		$query = "CALL purchased_by_cards('$date');";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Failed". mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getFailedOrderByCard($date){
		$conn = db_connect();
		$query = "CALL purchased_by_cards_troubled('$date');";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Failed". mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getAuthorWriteBooks($isbn){
		$conn = db_connect();
		$query = "SELECT fname, lname FROM authors, written WHERE written.wbookid = $isbn AND written.wauthorid = authors.author_id;";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Failed". mysqli_error($conn);
			exit;
		}
		$list = "";
		foreach($result as $author){
			$list .= $author['fname'] . " " . $author['lname'] . "<br>";
		}
		return $list;
	}
?>