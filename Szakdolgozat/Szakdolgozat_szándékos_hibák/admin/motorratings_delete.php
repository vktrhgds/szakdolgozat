
<?php
	
	include('../users/connection.php');
	if($_SESSION['login_user']!="CMRentadmin"){
		echo "<script type='text/javascript'>  window.location='../users/login.php'; </script>"; 
	}
?>


<?php

	$motorrates = "SELECT * FROM motorosertekelesek";
	$getMotorrates = mysqli_query($conn, $motorrates);

	if (mysqli_num_rows($getMotorrates) > 0){
		while($row = mysqli_fetch_assoc($getMotorrates)){
			if(isset($_POST[$row["id"]])){
			$deletemotor_comment = "DELETE FROM motorosertekelesek WHERE id = '".$row["id"]."'";
			mysqli_query($conn, $deletemotor_comment);
		
			// echo $deletesql;
			
			header("location: motorratings.php");
			}
		}
	}
	header("location: motorratings.php");
	
?>