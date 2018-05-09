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
	</head>
	
	<!-- body -->
	
	<body>
	
	<style>
	#table:hover{
		border-bottom: 1px solid black;
		border-left: 1px solid black;
		border-top: 1px solid black;
		transition: 0ms;
	}
	</style>
		<div id="bgStyle" style = "background: #EAE9E9;"></div>
			<div class="navbar" style = "background: rgb(50,50,50);">
			  <a href="index.php"><i class="fa fa-home fa-2x"></i></a>
			  <a href="writemessage.php"><i class="fa fa-envelope fa-2x"></i></a>
			  <div class="dropdown">
				<button class="dropbtn" onclick="myFunction4()"><i class="fa fa-search fa-2x"></i>
				  <i class="fa fa-caret-down"></i>
				</button>
				<div class="dropdown-content" id="myDropdown4">
				  <a href="usercarsearch.php">Autó keresése</a>
				  <a href="usermotorsearch.php">Motor keresése</a>
				</div>
			  </div>
			  <div class="dropdown">
				<button class="dropbtn" onclick="myFunction()"><i class="fa fa-car fa-2x"></i>
				  <i class="fa fa-caret-down"></i>
				</button>
				<div class="dropdown-content" id="myDropdown">
				  <?php
					 $cars = "SELECT automarka.id FROM automarka;";
					 $getCars = mysqli_query($conn, $cars);
					 
					 if(mysqli_num_rows($getCars)>0){
						 while($row = mysqli_fetch_assoc($getCars)){
							 
							 $numberofcars = "SELECT * FROM `auto` WHERE automarka_id = '".$row['id']."'";
							 $numberofcars_query = mysqli_query($conn, $numberofcars);
							 echo '
							 
							 <form action="getcar.php" method="GET">
								<a href="javascript:;" onclick="parentNode.submit();">'.$row['id'].' ('.mysqli_num_rows($numberofcars_query).')</a>
								<input type="hidden" name="u_carChosen" value="'.$row['id'].'"/>
							</form>';
						 }
					 }
					?>
				</div>
			  </div>
			  
			   <div class="dropdown">
				<button class="dropbtn" onclick="myFunction1()"><i class="fa fa-motorcycle fa-2x"></i>
				  <i class="fa fa-caret-down"></i>
				</button>
				<div class="dropdown-content" id="myDropdown1">
				  <?php
					 $motors = "SELECT motormarka.id FROM motormarka;";
					 $getMotors = mysqli_query($conn, $motors);
			
					 if(mysqli_num_rows($getMotors)>0){
						 while($row = mysqli_fetch_assoc($getMotors)){
							 
							$numberofmotors = "SELECT * FROM `motor` WHERE motormarka_id = '".$row['id']."'";
							$numberofmotors_query = mysqli_query($conn, $numberofmotors);
							echo '
							 <form action="getmotor.php" method="GET">
								<a href="javascript:;" onclick="parentNode.submit();">'.$row['id'].' ('.mysqli_num_rows($numberofmotors_query).')</a>
								<input type="hidden" name="u_motorChosen" value="'.$row['id'].'"/>
							</form>';
						 }
					 }
					?>
				</div>
			  </div> 
		
			  <a href="myprofile.php"><i class="fa fa-user fa-2x"></i></a>
			  <a href="myratings.php"><i class="fa fa-star fa-2x"></i></a>
			 
			  <form method = "POST" action = "logout.php" enctype = "multipart/form-data" name = "logout">
				<input type = "submit" class = "input" name = "logout" value = "Kijelentkezés" style = "align: right; z-index:1;"/> <!--<i class="fas fa-sign-out-alt"></i> -->
			  </form>
			</div>
			
			</br></br>
			
			<!-- kölcsönzés-> dátum kiválasztása -->
			</br></br>
			
			<?php
				
				$checkUser = "Select * from felhasznalo WHERE felhasznalo_nev = '".$login_session."'";
				$checkUser_query = mysqli_query($conn, $checkUser);
				$user = mysqli_fetch_assoc($checkUser_query);
				
				$car_sql = "SELECT * FROM `auto` ORDER BY evjarat DESC";
				$cars = mysqli_query($conn, $car_sql);
							
				$rowindex = 1;
				if (mysqli_num_rows($cars) > 0){
					while($row = mysqli_fetch_assoc($cars)){
						if(isset($_GET[$row['auto_id2']])){
						
						
						?>
						
						<table id = "carmotortable" style="border:0px solid white; 
							width: 80%; padding: 0%; margin-bottom: 0.5%; margin-left: 10%; margin-right: 10%; border-bottom: 1px solid #6E6E6E; background: #EAE9E9; color: white;" align = "center" cellspacing = "0" cellpadding = "0">
							<form method = "GET" action = "auto_kolcsonzes_check_data" enctype = "multipart/form-data" >
							<tr>
								<td width = "33.3%" bgcolor = "#46a32d" style = "font-size: 25px; padding: 5px; border-right: 1px solid white; text-align: center"> <i class="fa fa-calendar"></i> Dátum választás</td>
								<td width = "33.3%" bgcolor = "gray" style = "font-size: 25px; padding-left: 10px; padding-right: 10px; border-right: 1px solid white; text-align: center"> <i class="fa fa-user"></i> Adatok ellenőrzése</td>
								<td width = "33.3%" bgcolor = "gray" style = "font-size: 25px; padding-left: 10px; padding-right: 10px; text-align: center"> <i class="fa fa-shopping-cart"></i> Kölcsönzés</td>
							</tr>
							<tr>
							</tr>
								<td colspan = "3" style = "color: black; font-size: 22px; padding: 30px; padding-left: 120px;font-family: Arial, Helvetica, sans-serif;" >Kérjük, ellenőrizze az adatokat, majd válassza ki a kölcsönzés dátumát!</td>
							<tr>
								<td colspan = "3" style = "color: black; font-size: 22px; padding-bottom: 20px; padding-left: 120px;font-family: Arial, Helvetica, sans-serif;" >Személygépjármű adatai:</td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Autó márkája:</td>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo $row['automarka_id']." ".$row['marka_tipus']; ?></td>
								<td rowspan = "5" width = "60%" style = "padding-right: 40px;">
								<a target = "_blank" href = "<?php echo $row["fenykep"]; ?>" title = "A következő megjelenítése új lapon: <?php echo $row["automarka_id"]." ".$row["marka_tipus"]; ?>">
									<img src = "<?php echo $row["fenykep"]; ?>" style = "width:100%; height: 200px; border-radius: 10px;" />
								</a>
								</td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Ár (1-6 napig):</td>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo $row['ar_1']; ?> HUF</td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Ár (7-30 napig):</td>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo $row['ar_2']; ?> HUF</td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Ár (31-365 napig):</td>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo $row['ar_3']; ?> HUF</td>
							</tr>
							<tr>
								<td colspan = "2" style = "color: black; font-size: 22px; padding-bottom: 20px; padding-top: 40px;padding-left: 120px;font-family: Arial, Helvetica, sans-serif;" >Személyes adatok:</td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Név:</td>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo $user['vezetek_nev']." ".$user['kereszt_nev']; ?></td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >E-mail:</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo $user['email']; ?></td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Telefonszám</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo $user['telszam']; ?> </td>
							</tr>
							<tr>
								<td colspan = "3" style = "color: black; font-size: 22px; padding-bottom: 20px; padding-top: 40px;padding-left: 120px;font-family: Arial, Helvetica, sans-serif;" >Kölcsönzés dátuma:</td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Kölcsönzés kezdete:</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" >
									<input type = "date" name = "kolcsonzes_kezdet_auto" style = "width: 50%; bgcolor: gray;" required />
								</td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Kölcsönzése vége:</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" >
									<input type = "date" name = "kolcsonzes_vege_auto" style = "width: 50%; height: 30px;" required />
								</td>
							</tr>
							<tr>
								<td colspan = "3" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-top: 20px;padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >
									<input type = "checkbox" name = "check_user" style = " width: 30px; height: 20px;" required /><font color ="green"> Megerősítem, hogy a személyes adataim helyesek.</font>
								</td>
							</tr>
							<tr>
								<td colspan = "2" style = "padding-left: 220px; padding-bottom: 30px; padding-top: 30px;">
									<input type = "submit"  class = "viewvehicle" value = "Tovább" style = "height: 32px;width: 100%; padding: 0;" name = "<?php echo $row["auto_id2"]; ?>" >
								</td>
								<td style = "padding-left: 120px;">
									<a href = "index" style = "padding: 3px; padding-left: 5px; padding-right: 5px;border: 2px solid rgb(63, 125, 188); text-decoration: none; color: rgb(63, 125, 188); font-size: 20px; width: 70%; height: 33px;" title = "Vissza a főoldalra" >Mégsem</a>
								</td>
							</tr>
							</form>
						</table>
						<?php
						}
					}
				}
			?>
			
			
	</body>
</html>