
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
				if(isset($_POST["updatepassword"])){

					$oldpass =  trim($_POST['oldpass'], '\n\t');
					$oldpass =  mysqli_real_escape_string($conn, $_POST['oldpass']);
					$oldpass =  htmlspecialchars($oldpass);
					
					$oldpass_hashed = hash('sha512', $oldpass);
					
					$newpass =  trim($_POST['newpass'], '\n\t');
					$newpass =  mysqli_real_escape_string($conn, $_POST['newpass']);
					$newpass =  htmlspecialchars($newpass);
					$newpassagain =  trim($_POST['newpassagain'], '\n\t');
					$newpassagain =  mysqli_real_escape_string($conn, $_POST['newpassagain']);
					$newpassagain =  htmlspecialchars($newpassagain);
					
					$checkOldPass = "SELECT * FROM felhasznalo WHERE felhasznalo_nev = '".$login_session."' AND jelszo = '".$oldpass_hashed."';";
					$checkOldPassQuery = mysqli_query($conn, $checkOldPass);
					$countRows = mysqli_num_rows($checkOldPassQuery);
					
					if($countRows == 1){
						
						if($newpass == $newpassagain && strlen($newpass) >= 8 && 32 >= strlen($newpass)){
							
							$newpass_hashed = hash('sha512', $newpass);
							$updatePasswordSql = "UPDATE felhasznalo
							SET jelszo = '".$newpass_hashed."' WHERE felhasznalo_nev = '".$login_session."';";
							mysqli_query($conn, $updatePasswordSql);
							header('Location: logout');
							
						}
						else{
							die('</br></br></br>
							<div class="container">
								<div class="alert alert-danger">
									<strong>Sikertelen jelszómódosítás! </strong><i class="fa fa-frown-o" aria-hidden="true"></i></br>
									A megadott új jelszavak nem egyeznek meg, vagy túl rövidek!</br>
									Ügyeljen a kis- és nagybetűkre, illetve ellenőrizze, hogy új jelszava legalább 8, de legfeljebb 32 karakterből áll!
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
									Helytelenül adta meg régi jelszavát!</br>
									Ügyeljen a kis- és nagybetűkre, illetve ellenőrizze, hogy régi jelszava legalább 8, de legfeljebb 32 karakterből áll!
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