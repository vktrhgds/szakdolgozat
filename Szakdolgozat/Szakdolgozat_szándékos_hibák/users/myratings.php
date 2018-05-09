<?php
	
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
		<div id="bgStyle" ></div>
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
			
			</br></br></br></br>
			
			<div class="tab" style = "background: rgb(210,210,210); margin-left: 10%; width: 80%;">
			  <button class="tablinks" style = "width: 50%;" onclick="openTabs(event, 'Autosertekelesek')" id="defaultOpen">Értékelések <i class="fa fa-car" aria-hidden="true"></i></button>
			  <button class="tablinks" style = "width: 50%;" onclick="openTabs(event, 'Motorosertekelesek')">Értékelések <i class="fa fa-motorcycle" aria-hidden="true"></i></button>
			</div>
			
			
			<!-- AUTÓS ÉRTÉKELÉSEK -->
			
			
			<?php 
					$personalCarRatings = "SELECT * FROM auto, autosertekelesek, felhasznalo WHERE felhasznalo.felhasznalo_nev
					= '".$login_session."' AND autosertekelesek.auto_id = auto.id AND felhasznalo.felhasznalo_nev
					= autosertekelesek.felhasznalo_nev ORDER BY datum DESC;";
					$personalCarRatingsQuery = mysqli_query($conn, $personalCarRatings);
					$countPersonalCarRatings = mysqli_num_rows($personalCarRatingsQuery);
					
					if($countPersonalCarRatings > 0){
					?>

					<div id="Autosertekelesek" class="tabcontent">
						<div align = "center" width = "76.5%" style = "z-index: -1;" >
							<table cellspacing = "0" cellpadding = "0" id = "admintable" align = "center" width = "81.5%"
									style = "border-radius: 0 0 12px 12px;
									-webkit-border-radius: 0 0 12px 12px;
									-moz-border-radius: 0 0 12px 12px;
									z-index: 0;">
										<tr>
											<td style = "padding-bottom: 35px; padding-left: 10px; font-size: 35px;" >Autós értékeléseim (<?php echo $countPersonalCarRatings; ?>)</td> <!-- ide a darabszám -->
										</tr>
										
										<?php while($rowCR = mysqli_fetch_assoc($personalCarRatingsQuery)){
										?>
										
										<tr>
											<td style = "font-size: 20px; padding: 10px; "><font color = "yellow"><b><?php echo $rowCR['felhasznalo_nev']; ?></b></font>  értékelése:
											<font color = "yellow">
											<?php 
													if($rowCR['ertekeles'] == 1){
														?> <i class="fa fa-star" style = "color: yellow;"></i> <?php
													}
													else if($rowCR['ertekeles'] == 2){
														?> <i class="fa fa-star" style = "color: yellow;"></i> <i class="fa fa-star" style = "color: yellow;"></i> <?php
													}
													else if($rowCR['ertekeles'] == 3){
														?> <i class="fa fa-star" style = "color: yellow;"></i> <i class="fa fa-star" style = "color: yellow;"></i> <i class="fa fa-star" style = "color: yellow;"></i> <?php
													}
													else if($rowCR['ertekeles'] == 4){
														?> <i class="fa fa-star" style = "color: yellow;"></i> <i class="fa fa-star" style = "color: yellow;"></i> <i class="fa fa-star" style = "color: yellow;"> </i> <i class="fa fa-star" style = "color: yellow;"></i> <?php
													}
													else if($rowCR['ertekeles'] == 5){
														?> <i class="fa fa-star" style = "color: yellow;"></i> <i class="fa fa-star" style = "color: yellow;"></i> <i class="fa fa-star" style = "color: yellow;"> </i> <i class="fa fa-star" style = "color: yellow;"></i> <i class="fa fa-star" style = "color: yellow;"></i> <?php
													}
											?>
											</font><font color = "white"><?php echo $rowCR['datum']; ?> dátummal </font> 
											<font color = "yellow">(<?php echo $rowCR['automarka_id']." ".$rowCR['marka_tipus']; ?>)</font>
											</td>
										</tr>
										<tr>
											<td style = "font-size: 15px; padding: 10px;"> <!-- ide a komment maga -->
												<?php echo $rowCR['hozzaszolas']; ?>
											</td>
										</tr>
										<tr>
											<td><div style="text-align: center;height: 1px; background-color: #E6E6E6; width:100%;"></td>
										</tr>
										<?php } ?>
								</table>
							</div>
						</div>
					</div>
				<?php }
				else{
					echo' 
					<div id = "Autosertekelesek" class="tabcontent">
						<table id = "carmotortable" style = "margin-left: 9.5%; border-radius: 0; color: white; display: inline-block; width: 81%; padding: 20px; font-size: 25px; background: #FE2E2E; padding: 0px; padding-left: 15px;">
								<tr>
									<td colpan = "2" style = "font-size: 18px;" width = "100%"background: #56AF3E;><b>Még nincsenek autós értékelési ('.$login_session.')!</b></td>
								</tr>
							</table>
						</div>
					';
				}
			?>
			
			
			<!-- MOTOROS ÉRTÉKELÉSEK -->
			
			
			<?php 
					$personalMotorRatings = "SELECT * FROM motor, motorosertekelesek, felhasznalo WHERE felhasznalo.felhasznalo_nev
					= '".$login_session."' AND motorosertekelesek.motor_id = motor.id AND felhasznalo.felhasznalo_nev
					= motorosertekelesek.felhasznalo_nev ORDER BY datum DESC;";
					$personalMotorRatingsQuery = mysqli_query($conn, $personalMotorRatings);
					$countPersonalMotorRatings = mysqli_num_rows($personalMotorRatingsQuery);
					
					if($countPersonalMotorRatings > 0){
					?>

					<div id="Motorosertekelesek" class="tabcontent">
						<div align = "center" width = "76.5%" style = "z-index: -1;" >
							<table cellspacing = "0" cellpadding = "0" id = "admintable" align = "center" width = "81.5%"
									style = "border-radius: 0 0 12px 12px;
									-webkit-border-radius: 0 0 12px 12px;
									-moz-border-radius: 0 0 12px 12px;
									z-index: 0;">
										<tr>
											<td style = "padding-bottom: 35px; padding-left: 10px; font-size: 35px;" >Motoros értékeléseim (<?php echo $countPersonalMotorRatings; ?>)</td> <!-- ide a darabszám -->
										</tr>
										
										<?php while($rowMR = mysqli_fetch_assoc($personalMotorRatingsQuery)){
										?>
										
										<tr>
											<td style = "font-size: 20px; padding: 10px; "><font color = "yellow"><b><?php echo $rowMR['felhasznalo_nev']; ?></b></font>  értékelése:
											<font color = "yellow">
											<?php 
													if($rowMR['ertekeles'] == 1){
														?> <i class="fa fa-star" style = "color: yellow;"></i> <?php
													}
													else if($rowMR['ertekeles'] == 2){
														?> <i class="fa fa-star" style = "color: yellow;"></i> <i class="fa fa-star" style = "color: yellow;"></i> <?php
													}
													else if($rowMR['ertekeles'] == 3){
														?> <i class="fa fa-star" style = "color: yellow;"></i> <i class="fa fa-star" style = "color: yellow;"></i> <i class="fa fa-star" style = "color: yellow;"></i> <?php
													}
													else if($rowMR['ertekeles'] == 4){
														?> <i class="fa fa-star" style = "color: yellow;"></i> <i class="fa fa-star" style = "color: yellow;"></i> <i class="fa fa-star" style = "color: yellow;"> </i> <i class="fa fa-star" style = "color: yellow;"></i> <?php
													}
													else if($rowMR['ertekeles'] == 5){
														?> <i class="fa fa-star" style = "color: yellow;"></i> <i class="fa fa-star" style = "color: yellow;"></i> <i class="fa fa-star" style = "color: yellow;"> </i> <i class="fa fa-star" style = "color: yellow;"></i> <i class="fa fa-star" style = "color: yellow;"></i> <?php
													}
											?>
											</font><font color = "white"><?php echo $rowMR['datum']; ?> dátummal </font> 
											<font color = "yellow">(<?php echo $rowMR['motormarka_id']." ".$rowMR['marka_tipus']; ?>)</font>
											</td>
										</tr>
										<tr>
											<td style = "font-size: 15px; padding: 10px;"> <!-- ide a komment maga -->
												<?php echo $rowMR['hozzaszolas']; ?>
											</td>
										</tr>
										<tr>
											<td><div style="text-align: center;height: 1px; background-color: #E6E6E6; width:100%;"></td>
										</tr>
										<?php } ?>
								</table>
							</div>
						</div>
					</div>
				<?php }
				else{
					echo' 
					<div id = "Motorosertekelesek" class="tabcontent">
						<table id = "carmotortable" style = "margin-left: 9.5%; border-radius: 0; color: white; display: inline-block; width: 81%; padding: 20px; font-size: 25px; background: #FE2E2E; padding: 0px; padding-left: 15px;">
								<tr>
									<td colpan = "2" style = "font-size: 18px;" width = "100%"background: #56AF3E;><b>Még nincsenek autós értékelései ('.$login_session.')!</b></td>
								</tr>
							</table>
						</div>
					';
				}
			?>
		
		<script>
			function openTabs(evt, cityName) {
				var i, tabcontent, tablinks;
				tabcontent = document.getElementsByClassName("tabcontent");
				for (i = 0; i < tabcontent.length; i++) {
					tabcontent[i].style.display = "none";
				}
				tablinks = document.getElementsByClassName("tablinks");
				for (i = 0; i < tablinks.length; i++) {
					tablinks[i].className = tablinks[i].className.replace(" active", "");
				}
				document.getElementById(cityName).style.display = "block";
				evt.currentTarget.className += " active";
			}

			// Get the element with id="defaultOpen" and click on it
			document.getElementById("defaultOpen").click();
		</script>
</html>