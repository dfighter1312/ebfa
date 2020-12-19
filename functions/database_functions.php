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
?>