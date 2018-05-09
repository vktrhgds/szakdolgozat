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
				if(isset($_POST["updatepassword"])){
					
				$newpass =  $_POST['newpass'];
				$newpassagain =  $_POST['newpassagain'];
				
				$checkUser = "SELECT * FROM felhasznalo WHERE felhasznalo_nev = '".$login_session."'";
				$checkUserQuery = mysqli_query($conn, $checkUser);
				$countRows = mysqli_num_rows($checkUserQuery);
					
				if($countRows == 1){
					
					if($newpass == $newpassagain){
							
						$updatePasswordSql = "UPDATE felhasznalo
						SET jelszo = '".$newpass."' WHERE felhasznalo_nev = '".$login_session."';";
						mysqli_query($conn, $updatePasswordSql);
						header('Location: logout');
						
					}
					else{
						die('</br></br></br>
						<div class="container">
							<div class="alert alert-danger">
								<strong>Sikertelen jelszómódosítás! </strong><i class="fa fa-frown-o" aria-hidden="true"></i></br>
								A megadott új jelszavak nem egyeznek meg!</br>
								Az által megadott jelszavak:
								1, <b> '.$newpass.'</b></br>
								2, <b> '.$newpassagain.'</b></br>
							</div>
							<div class="alert alert-info">
								<a href="myprofile.php">Vissza a profilomhoz</a></p>
							</div>
					</div>');
					}	
				}
				else{
					die('</br></br></br>
						<div class="container">
							<div class="alert alert-danger">
								<strong>Sikertelen jelszómódosítás! </strong><i class="fa fa-frown-o" aria-hidden="true"></i></br>
							</div>
							<div class="alert alert-info">
								<a href="myprofile.php">Vissza a profilomhoz</a></p>
							</div>
					</div>');
				}	
			}
			?>
	</body>
</html>