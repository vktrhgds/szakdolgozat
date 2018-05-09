
<?php
	include('../users/timeout.php');
	include('../users/connection.php');
	if($_SESSION['login_user']!="CMRentadmin"){
		echo "<script type='text/javascript'>  window.location='../users/login.php'; </script>"; 
	}
?>


<?php

	$cars = "SELECT * FROM auto";
	$getCars = mysqli_query($conn, $cars);

	if (mysqli_num_rows($getCars) > 0){
		while($row = mysqli_fetch_assoc($getCars)){
			if(isset($_GET[$row["id"]])){
				
			$deletesql = "DELETE FROM auto WHERE id = '".$row["id"]."'";
			$deletecar_rent = "DELETE FROM autokolcsonzes WHERE auto_id = '".$row["id"]."'";
			$deletecar_comment = "DELETE FROM autosertekelesek WHERE auto_id = '".$row["id"]."'";
			
			mysqli_query($conn, $deletecar_comment);
			mysqli_query($conn, $deletecar_rent);
			mysqli_query($conn, $deletesql);
		
			// echo $deletesql;
			
			header("location: cardelete.php");
			}
		}
	}
	header("location: cardelete.php");
	
?>