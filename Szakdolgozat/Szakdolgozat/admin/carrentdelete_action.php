
<?php
	include('../users/timeout.php');
	include('../users/connection.php');
	if($_SESSION['login_user']!="CMRentadmin"){
		echo "<script type='text/javascript'>  window.location='../users/login.php'; </script>"; 
	}
?>



<?php


	
	$cars = "SELECT * FROM autokolcsonzes";
	$getCars = mysqli_query($conn, $cars);
	

	if (mysqli_num_rows($getCars) > 0){
		while($row = mysqli_fetch_assoc($getCars)){
			if(isset($_POST[$row["id"]])){
			$deletesql = "DELETE FROM autokolcsonzes WHERE id = '".$row["id"]."'";
			mysqli_query($conn, $deletesql);
		
			//echo $deletesql;
			
			header("location: carrents.php");
			}
		}
	}
	header("location: carrents.php");
	
?>