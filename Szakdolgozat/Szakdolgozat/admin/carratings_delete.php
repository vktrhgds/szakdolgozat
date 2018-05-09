
<?php
	include('../users/timeout.php');
	include('../users/connection.php');
	if($_SESSION['login_user']!="CMRentadmin"){
		echo "<script type='text/javascript'>  window.location='../users/login.php'; </script>"; 
	}
?>


<?php

	$carrates = "SELECT * FROM autosertekelesek";
	$getCarrates = mysqli_query($conn, $carrates);

	if (mysqli_num_rows($getCarrates) > 0){
		while($row = mysqli_fetch_assoc($getCarrates)){
			if(isset($_POST[$row["id"]])){
			$deletecar_comment = "DELETE FROM autosertekelesek WHERE id = '".$row["id"]."'";
			mysqli_query($conn, $deletecar_comment);
		
			// echo $deletesql;
			
			header("location: carratings.php");
			}
		}
	}
	header("location: carratings.php");
	
?>