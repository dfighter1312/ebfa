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
			echo "No category" . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getAuthor($conn){
		// $conn = db_connect();
		$query = "SELECT author_id, fname, lname FROM authors ORDER BY fname;";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "No category" . mysqli_error($conn);
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
		echo $id;
		$query = "CALL customer_update('$id', '$fn', '$ln', '$phone', '$addr', '$city', '$st');";
		$a = mysqli_query($conn, $query);
		var_dump($a);
	}
?>