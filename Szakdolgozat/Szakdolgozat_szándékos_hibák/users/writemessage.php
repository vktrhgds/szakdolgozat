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
		<link type="text/css" rel="stylesheet" href="../css/star_rating.css"/>
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
			
			</br></br></br></br></br>
			
			
			<form method = "POST" action = "writemessage_action.php">
			<div style = "margin-left: 10%; margin-right: 10%;" align = "center">
			<table cellspacing = "0" cellpadding = "0" id = "admintable" align = "center" width = "100%"
				style = "border-radius: 0px;
				-webkit-border-radius: 0px;
				-moz-border-radius: 0px;
				z-index: 0;
				background: rgb(220,220,220);
				border-top: 1px solid #BDBDBD;
				border-left: 1px solid #BDBDBD;
				border-right: 1px solid #BDBDBD;">
					<tr>
						<td style = "padding-bottom: 0; margin-bottom: 0;">
						<font style = "font-size: 20px; color: black; font-family: Arial, Helvetica, sans-serif;">
						Személyes üzenet küldése az oldal üzemeltetőjének</font>
						</td>
					</tr>
					<tr>
						<td style = "padding-top: 0;  font-family: Arial;">
							<input type = "text" name = "targy" style = "border: 1px solid #bdbdbd; font-size: 15px; width: 25%; padding: 5px;
							border-radius: 3px; padding-left: 10px;" placeholder = "Üzenet tárgya" required
							pattern=".{1,32}" title="Minimum 1, maximum 32 karakter lehet a tárgy.">
						</td>
					</tr>
					<tr>
						<td colspan = "2">
							<textarea rows = "4" name = "szoveg" style = "border: 1px solid #bdbdbd; width: 100%; padding: 10px; font-size: 17px; color: black; font-family: Arial;"
							placeholder = "Írjon, ha valamely kölcsönzés foglalását szeretné törölni, vagy valamely komment eltávolítását kéri, illetve bármely egyéb témában is írhat!" required
							maxlength="1500"></textarea>
						</td>
					</tr>
					<tr>
						<td style = "padding-top: 10px;" colspan = "2">
							<input type = "submit" class= "delete_edit3" name = "writecomment" style = "width: 20%; height: 30px; font-size: 20px;font-family: 'Raleway', serif;"
							value = "Küldés"/>
						</td>
					</tr>
					<tr>
						<td></td>
					</tr>
			</table>
		</div>
		</form>
			
		<?php 
		$printMessages = "SELECT * FROM adminuzenet WHERE felhasznalo_nev = '".$login_session."'";
		$printMessagesQuery = mysqli_query($conn, $printMessages);
		$countMessages = mysqli_num_rows($printMessagesQuery);
		
		if($countMessages > 0){
			?>
			<div align = "center" style = "margin-left: 10%; margin-right: 10%;">
				<table cellspacing = "0" cellpadding = "0" id = "ratetable" align = "center" width = "100%"
						style = "border-radius: 0 0 12px 12px;
						-webkit-border-radius: 0 0 12px 12px;
						-moz-border-radius: 0 0 12px 12px;
						z-index: 0;
						background: rgb(220,220,220);
						border-bottom: 1px solid #BDBDBD;
						border-left: 1px solid #BDBDBD;
						border-right: 1px solid #BDBDBD;">
						<tr>
							<td style = "padding-bottom: 30px; padding-left: 10px; font-size: 20px; color: black" >Eddigi üzeneteim (<?php echo $countMessages; ?>)<b></b></td> 
						</tr>
						<?php
						while($rowMS = mysqli_fetch_assoc($printMessagesQuery)){
						?>
						<tr>
							<td style = "font-size: 13px; padding: 10px; color: black; font-family: Arial;">
							Tárgy: <b><?php echo $rowMS['targy']; ?> </b> |
							Dátum: <b><?php echo $rowMS['uzenetdatum']; ?></b>
							</td>
						</tr>
						<tr>
							<td style = "font-size: 15px; padding: 10px; color: black; font-family: Arial"> 
								<?php echo $rowMS['uzenet']; ?>
							</td>
						</tr>
						<tr>
							<td>
								<div align = "center" style = "width: 80%; height: 1px; color: white"></div> 
							</td>
						</tr>
						<?php } ?>
				</table>
			</div>
		<?php
		}
		else{
			?>
			<div style = "margin-left:10%; margin-right: 10%;">
				<table cellspacing = "0" cellpadding = "0" id = "admintable" align = "center" width = "100%"
					style = "border-radius: 0 0 12px 12px;
					-webkit-border-radius: 0 0 12px 12px;
					-moz-border-radius: 0 0 12px 12px;
					z-index: 0;
					background: rgb(220,220,220);
					border-bottom: 1px solid #BDBDBD;
					border-left: 1px solid #BDBDBD;
					border-right: 1px solid #BDBDBD;">
					<tr>
						<td style = "padding-bottom: 0px; padding-left: 10px; font-size: 20px; color: black" >Nincs még elküldött üzenet<b></b></td> 
					</tr>
				</table>
			</div>
			<?php
		}
		?>
		
		</br>
	</body>
</html>