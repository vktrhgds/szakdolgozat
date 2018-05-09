<?php
	
	include('../users/connection.php');
	if($_SESSION['login_user']!="CMRentadmin"){
		echo "<script type='text/javascript'>  window.location='../users/login.php'; </script>"; 
	}
?>

<?php
	
	$motors = "SELECT * FROM motorkolcsonzes";
	$getMotors = mysqli_query($conn, $motors);

	if (mysqli_num_rows($getMotors) > 0){
		while($row = mysqli_fetch_assoc($getMotors)){
			if(isset($_POST[$row["id"]])){
			$deletesql = "DELETE FROM motorkolcsonzes WHERE id = '".$row["id"]."'";
			mysqli_query($conn, $deletesql);
		
			//echo $deletesql;
			
			header("location: motorrents.php");
			}
		}
	}
	header("location: motorrents.php");
	
?>