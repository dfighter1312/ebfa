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
		return $row['book_price'];
	}
	function getMostPurchasedBook($date){
		$conn = db_connect();
		$query = "CALL id_purchased(date)";
		$result = mysqli_qury($conn, $quer);
		if(!resutl){
			echo "get most purchased book failed!". mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['total sale'];
	}
	
?>