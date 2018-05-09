<?php
	ob_start();
	include('functions.php');
	include('connection.php');
	if($login_session == "CMRentadmin"){
		echo "<script type='text/javascript'>  window.location='../users/login.php'; </script>"; 
	}
	if(!isset($login_session)){
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
				if(isset($_POST["updateprofile"])){
					
					$vnev =  $_POST['vnev'];
					$knev =  $_POST['knev'];
					$telszam =  $_POST['telszam'];
					$irszam =  $_POST['irszam'];
					$varos =  $_POST['varos'];
					$utca =  $_POST['utca'];
					$hazszam =  $_POST['hazszam'];
					$szulhely =  $_POST['szulhely'];
					$szulido =  $_POST['szulido'];
					$anyjavnev =  $_POST['anyjavnev'];
					$anyjaknev =  $_POST['anyjaknev'];
					
					$updateUserProfile = "UPDATE felhasznalo
					SET vezetek_nev = '".$vnev."', kereszt_nev = '".$knev."', telszam = '".$telszam."', ir_szam = '".$irszam."', varos = '".$varos."',
					utca = '".$utca."', hazszam = '".$hazszam."', szuletesi_hely = '".$szulhely."', szuletesi_ido = '".$szulido."', 
					anyja_vnev = '".$anyjavnev."', anyja_knev = '".$anyjaknev."' WHERE felhasznalo_nev = '".$login_session."';";
					mysqli_query($conn, $updateUserProfile);
					header('Location: myprofile');
						
				}
			?>
	</body>
</html>