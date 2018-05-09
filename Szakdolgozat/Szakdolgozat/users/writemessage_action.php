
<?php
	ob_start();
	include('timeout.php');
	include('functions.php');
	include('connection.php');
	if($login_session == "CMRentadmin"){
		echo "<script type='text/javascript'>  window.location='../users/login.php'; </script>"; 
	}
		
?>


<!DOCTYPE html>
<html>
	<!--<meta http-equiv="refresh" content="10;url=logout.php" />-->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta HTTP-EQUIV="Content-Language" Content="hu">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../res/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel = "stylesheet" href = "../css/stylepage1.css"/>
	<link rel = "stylesheet" href = "../css/modal.css"/>
	<link rel = "stylesheet" href = "../css/user.css"/>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway:300" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
	rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	
	<head>
		<title>CMRent</title>
		<link type="text/css" rel="stylesheet" href="../css/style1.css"/>
		<script type="text/javascript" src="../javascript/jquery.js"></script>
		<script type="text/javascript" src="../javascript/passwordStrengthMeter.js"></script>
		<script type="text/javascript" src="../javascript/adminpage.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
							
	
	<script>
		function goBack() {
			window.history.back();
		}
	</script>
	
	<!-- body -->
	
	<body>
		<div id="bgStyle" style = "background: #EAE9E9;"></div>
		</br></br>
			
			<?php
				if(isset($_POST["writecomment"])){
					
					//felhnév: $login_session
					$targy =  trim($_POST['targy'], '\n\t');
					$targy =  mysqli_real_escape_string($conn, $_POST['targy']);
					$targy =  htmlspecialchars($targy);
					
					$szoveg =  trim($_POST['szoveg'], '\n\t');
					$szoveg =  mysqli_real_escape_string($conn, $_POST['szoveg']);
					$szoveg =  htmlspecialchars($szoveg);
				
					$currentDateTime = date('Y-m-d H:i:s');
					
					$sendMailToAdmin = "INSERT INTO adminuzenet (felhasznalo_nev, targy, uzenet, uzenetdatum)
								VALUES('".$login_session."', '".$targy."', '".$szoveg."', '".$currentDateTime."')";
					mysqli_query($conn, $sendMailToAdmin);
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				}
			?>
	</body>
</html>