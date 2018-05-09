
<?php
	
	$conn = mysqli_connect("localhost", "root", "") or die("Failed to connect");
	mysqli_set_charset($conn,"utf8");
	
	if ( false == mysqli_select_db($conn, "jarmuadatbazis" )  ) {
		return null;
	}
	
	else{
		//echo "Successfully connected";
		mysqli_query($conn, 'SET NAMES UTF-8');
		mysqli_query($conn, 'SET character_set_results=utf8');
		mysqli_set_charset($conn, 'utf8');
	
		return $conn;
	}	
?>