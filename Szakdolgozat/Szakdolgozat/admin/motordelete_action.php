<?php

	
	include('../users/connection.php');
	include('../users/timeout.php');
	if($_SESSION['login_user']!="CMRentadmin"){
		echo "<script type='text/javascript'>  window.location='../users/login.php'; </script>"; 
	}
	
	$motors = "SELECT * FROM motor";
	$getMotors = mysqli_query($conn, $motors);

	if (mysqli_num_rows($getMotors) > 0){
		while($row = mysqli_fetch_assoc($getMotors)){
			if(isset($_GET[$row["id"]])){
			$deletesql = "DELETE FROM motor WHERE id = '".$row["id"]."'";
			$deletemotor_rent = "DELETE FROM motorkolcsonzes WHERE motor_id = '".$row["id"]."'";
			$deletemotor_comment = "DELETE FROM motorosertekelesek WHERE motor_id = '".$row["id"]."'";
			mysqli_query($conn, $deletemotor_comment);
			mysqli_query($conn, $deletemotor_rent);
			mysqli_query($conn, $deletesql);
		
			// echo $deletesql;
			
			header("location: motordelete.php");
			}
		}
	}
	header("location: motordelete.php");
	
?>