
<?php
	include('../users/timeout.php');
	include('../users/connection.php');
	if($_SESSION['login_user']!="CMRentadmin"){
		echo "<script type='text/javascript'>  window.location='../users/login.php'; </script>"; 
	}
?>


<?php

	$messages = "SELECT * FROM adminuzenet";
	$getMessages = mysqli_query($conn, $messages);

	if (mysqli_num_rows($getMessages) > 0){
		while($row = mysqli_fetch_assoc($getMessages)){
			if(isset($_POST[$row["id"]])){
			$delete_comment = "DELETE FROM adminuzenet WHERE id = '".$row["id"]."'";
			mysqli_query($conn, $delete_comment);
		
			// echo $deletesql;
			
			header("location: adminmessages.php");
			}
		}
	}
	header("location: adminmessages.php");
	
?>