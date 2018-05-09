
<?php
	include('../users/timeout.php');
	include('../users/connection.php');
	if($_SESSION['login_user']!="CMRentadmin"){
		echo "<script type='text/javascript'>  window.location='../users/login.php'; </script>"; 
	}
?>


<!DOCTYPE html>
<html>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta HTTP-EQUIV="Content-Language" Content="hu">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../res/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel = "stylesheet" href = "../css/stylepage1.css"/>  
	<link rel = "stylesheet" href = "../css/modal.css"/>
	<link rel = "stylesheet" href = "../css/admin.css"/>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway:300" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
	rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	
	<head>
		<title>Admin kezdőlap</title>
		<link type="text/css" rel="stylesheet" href="../css/style1.css"/>
		<script type="text/javascript" src="../javascript/jquery.js"></script>
		<script type="text/javascript" src="../javascript/passwordStrengthMeter.js"></script>
		<script type="text/javascript" src="../javascript/adminpage.js"></script>
	</head>
	
	<!-- body -->
	
	<body>	
	
	
	<?php
		
		include('../users/registration_connection.php');
		
		$user_sql = "SELECT * FROM felhasznalo";
		$users = mysqli_query($conn, $user_sql);
				
		$rowindex = 1;
		if (mysqli_num_rows($users) > 0){
			while($row = mysqli_fetch_assoc($users)){
				if(isset($_GET[$row["felhasznalo_nev"]])){
					
		
				?>
	
	
				<div id="bgStyle"></div>
					<div class="navbar">
					  <a href="adminindex.php"><i class="fa fa-home fa-2x"></i></a>
					  <a href="adminmessages.php"><i class="fa fa-envelope fa-2x"></i></a>
					  
					  <div class="dropdown">
						<button class="dropbtn" onclick="myFunction()"><i class="fa fa-car fa-2x"></i>
						  <i class="fa fa-caret-down"></i>
						</button>
						<div class="dropdown-content" id="myDropdown">
						  <a href="carupload.php">Személygépkocsi felvétele</a>
						  <a href="carmodify.php">Személygépkocsi módosítása</a>
						  <a href="cardelete.php">Személygépkocsi törlése</a>
						</div>
					  </div>
					  
					   <div class="dropdown">
						<button class="dropbtn" onclick="myFunction1()"><i class="fa fa-motorcycle fa-2x"></i>
						  <i class="fa fa-caret-down"></i>
						</button>
						<div class="dropdown-content" id="myDropdown1">
						  <a href="motorupload.php">Motor felvétele</a>
						  <a href="motormodify.php">Motor módosítása</a>
						  <a href="motordelete.php">Motor törlése</a>
						</div>
					  </div> 
					  
					  <div class="dropdown">
						<button class="dropbtn" onclick="myFunction2()" ><i class="fa fa-user fa-2x"></i>
						  <i class="fa fa-caret-down"></i>
						</button>
						<div class="dropdown-content" id="myDropdown2">
						  <a href="allusers.php">Összes felhasználó</a>
						  <a href="onlineusers.php">Online felhasználók</a>
						  <a href="carrents.php">Autós kölcsönzések</a>
						  <a href="motorrents.php">Motoros kölcsönzések</a>
						</div>
					  </div>
					  
					  <div class="dropdown">
						<button class="dropbtn" onclick="myFunction3()" ><i class="fa fa-star fa-2x"></i>
						  <i class="fa fa-caret-down"></i>
						</button>
						<div class="dropdown-content" id="myDropdown3">
						  <a href="carratings.php">Autós értékelések</a>
						  <a href="motorratings.php">Motoros értékelések</a>
						</div>
					  </div>
					  <a align = "right" title = "Automatikus kijelentkezés <?php echo $timeleft; ?> mp múlva."
						href= "" style = "padding: 0;margin-top: 1.2%; margin-left: 41%;font-size: 22px; text-align: right;"><?php echo $timeleft; ?> mp</a>
					  <form method = "POST" action = "../users/logout.php" enctype = "multipart/form-data" name = "logout">
						<input type = "submit" class = "input" name = "logout" value = "Kijelentkezés" style = "align: right;"/> <!--<i class="fas fa-sign-out-alt"></i> -->
					  </form>
					  
					 
					</div>
					</div>
					
					</br></br></br>
						
					<table cellspacing = "0" cellpadding = "0"  align = "center" width = "80%" > 
						<tr>
							<td>
							<div class="tab" id = "admintable" style = "border-radius: 0; -webkit-border-radius: 0;-moz-border-radius: 0; margin-bottom: -6px;">
								<button class="tablinks" style = "width: 20%; border-radius: 100;" onclick="openTabs(event, 'adatok1')" id="defaultOpen"><font size = "4">Felhasználói adatok <i class="fa fa-user" aria-hidden="true"></i></font></button>
								<button class="tablinks" style = "width: 17%; border-radius: 100;" onclick="openTabs(event, 'adatok2')"><font size = "4">Értékelések <i class="fa fa-car" hidden="true"></i></font></button>
								<button class="tablinks" style = "width: 17%; border-radius: 100;" onclick="openTabs(event, 'adatok3')"><font size = "4">Értékelések <i class="fa fa-motorcycle" hidden="true"></i></font></button>
								<button class="tablinks" style = "width: 22%; border-radius: 100;" onclick="openTabs(event, 'autoskolcsonzesek')"><font size = "4">Autós kölcsönzések <i class="fa fa-car" aria-hidden="true"></i></font></button>
								<button class="tablinks" style = "width: 24%; border-radius: 100;" onclick="openTabs(event, 'motoroskolcsonzesek')"><font size = "4">Motoros kölcsönzések <i class="fa fa-motorcycle" aria-hidden="true"></i></font></button>
							</div>
							</td>
						</tr>
					</table>
					
						
					<div id="adatok1" class="tabcontent">
						<div align = "center" width = "81%">
						<!--<form method = "GET" action = "motormodify_action.php" enctype = "multipart/form-data" name = "car_upload">-->
							<table cellspacing = "0" cellpadding = "0" id = "admintable" align = "center" width = "81.5%"
							style = "border-radius: 0 0 12 12;
							-webkit-border-radius: 0 0 12 12;
							-moz-border-radius: 0 0 12 12;">
								<tr>
									<td colspan = "2" height = "40px" align = "left" bgcolor = "#56AF3E" style = "padding-left: 35px; font-size: 25px;"><b>Felhasználó adatai <i class="fa fa-user "></i></font>
									</td>
								</tr>
								<tr>
									<td style = "padding: 5px;" colspan = "2">
										<div style="text-align: center; height: 1px; background-color: #E6E6E6; width:100%;"></div>
									</td>
								</tr>
								
								<!-- adatok megadása (1) -->
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 10px; font-size: 22px; color: #222222"><b>Felhasználói adatok</b></td>
									<td rowspan = "16" height = "25px" align = "left" style =" padding: 5px 0px 0px 10px; font-size: 22px; color: #222222">
										<img src="../pictures/jarmuadatbazis_kepek/profile.jpg" style = "border-radius: 10px;"alt="Rent a car" height="430" width="585">
									</td>
								</tr>
								<tr>
									<td width = "100%" height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Felhasználónév: <?php echo "<b>".htmlspecialchars($row['felhasznalo_nev'])."</b>"; ?></td>
								</tr>
								<tr>
									<td width = "100%" height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px; ">E-mail: <?php echo htmlspecialchars($row['email']); ?></td>
								</tr>
								<tr>
									<td width = "100%" height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Telefonszám: <?php echo htmlspecialchars($row['telszam']); ?></td>
								</tr>
								<tr >
									<td width = "100%" height = "25px" align = "left" style =" padding: 5px 0px 0px 10px; font-size: 22px;color: #222222"><b>Személyes adatok</b></td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Teljes név: <?php echo htmlspecialchars($row['vezetek_nev']). " " .htmlspecialchars($row['kereszt_nev']); ?></td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Anyja neve: <?php echo htmlspecialchars($row['anyja_vnev']). " " .htmlspecialchars($row['anyja_knev']); ?></td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Személyi igazolványszám: <?php echo htmlspecialchars($row['szemelyig_szam']); ?></td>
								</tr>
								<tr>
									<td width = "100%" height = "25px" align = "left" style =" padding: 5px 0px 0px 10px; font-size: 22px;color: #222222"><b>Lakcím adatok</b></td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Lakcím: <?php echo htmlspecialchars($row['ir_szam'])." ".htmlspecialchars($row['varos']).", ". htmlspecialchars($row['utca'])." ".htmlspecialchars($row['hazszam'])."."; ?></td>
								</tr>
								<tr >
									<td width = "100%" height = "25px" align = "left" style =" padding: 5px 0px 0px 10px; font-size: 22px;color: #222222"><b>Születési adatok</b></td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Születési hely: <?php echo htmlspecialchars($row['szuletesi_hely']); ?></td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Születési idő: <?php echo htmlspecialchars($row['szuletesi_ido']); ?></td>
								</tr>
							</table>
						</div>
					</div>



					<!-- Autós értékelés -->
					
					
				<?php 
					$personalCarRatings = "SELECT * FROM auto, autosertekelesek, felhasznalo WHERE felhasznalo.felhasznalo_nev
					= '".$row['felhasznalo_nev']."' AND autosertekelesek.auto_id = auto.id AND felhasznalo.felhasznalo_nev
					= autosertekelesek.felhasznalo_nev ORDER BY datum DESC;";
					$personalCarRatingsQuery = mysqli_query($conn, $personalCarRatings);
					$countPersonalCarRatings = mysqli_num_rows($personalCarRatingsQuery);
					
					if($countPersonalCarRatings > 0){
					?>

					<div id="adatok2" class="tabcontent">
						<div align = "center" width = "76.5%" style = "z-index: -1;" >
							<table cellspacing = "0" cellpadding = "0" id = "admintable" align = "center" width = "81.5%"
									style = "border-radius: 0 0 12px 12px;
									-webkit-border-radius: 0 0 12px 12px;
									-moz-border-radius: 0 0 12px 12px;
									z-index: 0;">
										<tr>
											<td style = "padding-bottom: 35px; padding-left: 10px; font-size: 35px;" ><?php echo htmlspecialchars($row['felhasznalo_nev']); ?> értékelései <b>(<?php echo $countPersonalCarRatings; ?>)</b></td> <!-- ide a darabszám -->
										</tr>
										
										<?php while($rowCR = mysqli_fetch_assoc($personalCarRatingsQuery)){
											?>
										
										<tr>
											<td style = "font-size: 20px; padding: 10px; "><font color = "yellow"><b><?php echo htmlspecialchars($row['felhasznalo_nev']); ?></b></font>  értékelése:
											<font color = "yellow"><?php echo htmlspecialchars($rowCR['ertekeles']); ?>/5 </font><font color = "white"><?php echo htmlspecialchars($rowCR['datum']); ?> dátummal </font> 
											<font color = "yellow">(<?php echo $rowCR['automarka_id']." ".$rowCR['marka_tipus']; ?>)</font>
											</td>
										</tr>
										<tr>
											<td style = "font-size: 15px; padding: 10px;"> <!-- ide a komment maga -->
												<?php echo htmlspecialchars($rowCR['hozzaszolas']); ?>
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
					<div id = "adatok2" class="tabcontent">
						<table id = "carmotortable" style = "margin-left: 9.5%; border-radius: 0; color: white; display: inline-block; width: 81%; padding: 20px; font-size: 25px; background: #FE2E2E; padding: 0px; padding-left: 15px;">
								<tr>
									<td colpan = "2" style = "font-size: 18px;" width = "100%"background: #56AF3E;><b>Még nincsenek autós értékelései ('.$row['felhasznalo_nev'].')!</b></td>
								</tr>
							</table>
						</div>
					';
				}
				?>
				
				
				<!-- MOTOROS ÉRTÉKÉLÉSEK -->
				
				
				
				<?php 
					$personalMotorRatings = "SELECT * FROM motor, motorosertekelesek, felhasznalo WHERE felhasznalo.felhasznalo_nev
					= '".$row['felhasznalo_nev']."' AND motorosertekelesek.motor_id = motor.id AND felhasznalo.felhasznalo_nev
					= motorosertekelesek.felhasznalo_nev ORDER BY datum DESC;";
					$personalMotorRatingsQuery = mysqli_query($conn, $personalMotorRatings);
					$countPersonalMotorRatings = mysqli_num_rows($personalMotorRatingsQuery);
					
					if($countPersonalMotorRatings > 0){
					?>

					<div id="adatok3" class="tabcontent">
						<div align = "center" width = "76.5%" style = "z-index: -1;" >
							<table cellspacing = "0" cellpadding = "0" id = "admintable" align = "center" width = "81.5%"
									style = "border-radius: 0 0 12px 12px;
									-webkit-border-radius: 0 0 12px 12px;
									-moz-border-radius: 0 0 12px 12px;
									z-index: 0;">
										<tr>
											<td style = "padding-bottom: 35px; padding-left: 10px; font-size: 35px;" ><?php echo htmlspecialchars($row['felhasznalo_nev']); ?> értékelései <b>(<?php echo $countPersonalMotorRatings; ?>)</b></td> <!-- ide a darabszám -->
										</tr>
										
										<?php while($rowMR = mysqli_fetch_assoc($personalMotorRatingsQuery)){
											?>
										
										<tr>
											<td style = "font-size: 20px; padding: 10px; "><font color = "yellow"><b><?php echo htmlspecialchars($row['felhasznalo_nev']); ?></b></font>  értékelése:
											<font color = "yellow"><?php echo htmlspecialchars($rowMR['ertekeles']); ?>/5 </font><font color = "white"><?php echo htmlspecialchars($rowMR['datum']); ?> dátummal </font> 
											<font color = "yellow">(<?php echo $rowMR['motormarka_id']." ".$rowMR['marka_tipus']; ?>)</font>
											</td>
										</tr>
										<tr>
											<td style = "font-size: 15px; padding: 10px;"> <!-- ide a komment maga -->
												<?php echo htmlspecialchars($rowMR['hozzaszolas']); ?>
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
					<div id = "adatok3" class="tabcontent">
						<table id = "carmotortable" style = "margin-left: 9.5%; border-radius: 0; color: white; display: inline-block; width: 81%; padding: 20px; font-size: 25px; background: #FE2E2E; padding: 0px; padding-left: 15px;">
								<tr>
									<td colpan = "2" style = "font-size: 18px;" width = "100%"background: #56AF3E;><b>Még nincsenek motoros értékelései ('.$row['felhasznalo_nev'].')!</b></td>
								</tr>
							</table>
						</div>
					';
				}
				?>
				
					
					
				<!-- AUTÓS KÖLCSÖNZÉSEK -->	
					

						
				<?php 
				$personalCarRentSql = "SELECT * FROM auto, autokolcsonzes, felhasznalo WHERE 
				felhasznalo.felhasznalo_nev = '".$row['felhasznalo_nev']."' AND auto.id = autokolcsonzes.auto_id AND 
				autokolcsonzes.felhasznalo_nev = felhasznalo.felhasznalo_nev ORDER BY mettol DESC;";
				$personalCarRentSqlQuery = mysqli_query($conn, $personalCarRentSql);
				$countPersonalCarRents = mysqli_num_rows($personalCarRentSqlQuery);
				$counter = 1;
				
				if($countPersonalCarRents > 0){
				
				$sumPrice= "SELECT sum(ar_osszesen) AS osszesar FROM autokolcsonzes, felhasznalo WHERE 
				autokolcsonzes.felhasznalo_nev = felhasznalo.felhasznalo_nev AND felhasznalo.felhasznalo_nev = '".$row['felhasznalo_nev']."'";
				$sumPriceQuery = mysqli_query($conn, $sumPrice);
				$rowSum = mysqli_fetch_assoc($sumPriceQuery); 
				$sum = $rowSum['osszesar'];
		
				?>		
						
				<div id="autoskolcsonzesek" class="tabcontent">
				
					<div align = "center" width = "70%" style = "z-index:1;">
						<table cellspacing = "0" cellpadding = "0" id = "logintable" align = "center" width = "81.5%"
							style = "border-radius: -20px;
							-webkit-border-radius: -20px;
							-moz-border-radius: -20px;
							background: #D8D8D8;
							padding-top: 40px; padding-left: 20px; padding-bottom: 30px;">
							<tr>
								<td colspan = "3" style = "margin-top: -20px;">
									<font style = "font-size: 23px; color: #424242;">Ár összesen: <font color = "green"><?php echo htmlspecialchars($sum); ?> Ft</font></font>
								</td>
							</tr>
							<tr>
								<td colspan = "3">
									<font style = "font-size: 23px; color: #424242;">Kölcsönzések (<?php echo $countPersonalCarRents; ?>)</font> <!-- zárjójelben a rekordok száma -->
								</td>
							</tr>
						</table>
					</div>
				<div align = "center" width = "70%" style = "z-index:1;">
				
				
				<!--  INNENTŐL ISMÉTLŐDIK -->
				<?php while($rows = mysqli_fetch_assoc($personalCarRentSqlQuery)){
					?>
				
				
					<table cellspacing = "0" cellpadding = "0" align = "center" width = "81.5%"
						style = "border-radius: -20px;
						-webkit-border-radius: -20px;
						-moz-border-radius: -20px;
						background: #D8D8D8;
						padding-top: 10px; padding-left: 20px; padding-bottom: 30px;">
						<tr> 
							<td rowspan = "8" width = "30%"  style = "padding-top: 10px; z-index: 1; padding-left: 5%;">
								<img src = "<?php echo htmlspecialchars($rows["fenykep"]); ?>" width = "250px" height = "180px">
							</td>
							<td width = "40%"></br></td>
							<td width = "40%"></br></td>
						</tr>
						<tr>
							<td>
								Autó márkája: <b> <?php echo htmlspecialchars($rows['automarka_id'])." ".htmlspecialchars($rows["marka_tipus"]); ?></b>
							</td>
							<td>
								<font style = "color: green; font-size: 19px;" ><i>Kölcsönzés: <b><?php echo $counter++; ?></b></i></font>
							</td>
						</tr>
						<tr>
							<td>
								Kategória:  <b><?php echo htmlspecialchars($rows['kategoria']); ?> </b>
							</td>
							<td>
								Kezdeti dátum:  <b><?php echo htmlspecialchars($rows['mettol']); ?> </b>
							</td>
						</tr>
						<tr>
							<td>
								Állapot:  <b><?php echo htmlspecialchars($rows['allapot']); ?> </b>
							</td>
							<td>
								Végső dátum:  <b><?php echo htmlspecialchars($rows['meddig']); ?> </b>
							</td>
						</tr>
						<tr>
							<td>
								Évjárat:  <b><?php echo htmlspecialchars($rows['evjarat']); ?> </b>
							</td>
							<td>
								Kölcsönző fél:  <b><?php echo htmlspecialchars($rows['vezetek_nev'])." ".htmlspecialchars($rows["kereszt_nev"]); ?> </b>
							</td>
						</tr>
						<tr>
							<td>
								Futott táv:  <b><?php echo htmlspecialchars($rows['km_ora_allasa']); ?> km</b>
							</td>
							<td>
								Ár naponta  <b><?php echo htmlspecialchars($rows['ar_naponta']); ?> Ft </b>
							</td>
						</tr>
						<tr>
							<td>
								Száll. szem.:  <b><?php echo htmlspecialchars($rows['szallithato_szemelyek']); ?> fő</b>
							</td>
							<td>
								Ár összesen:  <b><?php echo htmlspecialchars($rows['ar_osszesen']); ?> Ft</b>
							</td>
						</tr>
					</table>
					<?php }
				}
				else{
					echo' 
					<div id = "autoskolcsonzesek" class="tabcontent">
						<table id = "carmotortable" style = "margin-left: 9.5%; border-radius: 0; color: white; display: inline-block; width: 81%; padding: 20px; font-size: 25px; background: #FE2E2E; padding: 0px; padding-left: 15px;">
								<tr>
									<td colpan = "2" style = "font-size: 18px;" width = "100%"background: #56AF3E;><b>Még nincsenek autós kölcsönzései ('.$row['felhasznalo_nev'].')!</b></td>
								</tr>
							</table>
						</div>
					';
				}
					
			?>
				</div>		
			</div>
			
			
			
			<!-- MOTOROS KÖLCSÖNZÉSEK -->
			
			
			
			<?php 
			$personalMotorRentSql = "SELECT * FROM motor, motorkolcsonzes, felhasznalo WHERE 
			felhasznalo.felhasznalo_nev = '".$row['felhasznalo_nev']."' AND motor.id = motorkolcsonzes.motor_id AND 
			motorkolcsonzes.felhasznalo_nev = felhasznalo.felhasznalo_nev ORDER BY mettol DESC";
			$personalMotorRentSqlQuery = mysqli_query($conn, $personalMotorRentSql);
			$countPersonalMotorRents = mysqli_num_rows($personalMotorRentSqlQuery);
			$counterM = 1;
			
			if($countPersonalMotorRents > 0){
				
				$sumPriceM = "SELECT sum(ar_osszesen) AS osszesar FROM motorkolcsonzes, felhasznalo WHERE 
				motorkolcsonzes.felhasznalo_nev = felhasznalo.felhasznalo_nev AND felhasznalo.felhasznalo_nev = '".$row['felhasznalo_nev']."'";
				$sumPriceQueryM = mysqli_query($conn, $sumPriceM);
				$rowSumM = mysqli_fetch_assoc($sumPriceQueryM); 
				$sumM = $rowSumM['osszesar'];
				//echo $sumPriceM;
		
				?>
			
			
			<div id="motoroskolcsonzesek" class="tabcontent">
				<div align = "center" width = "70%" style = "z-index:1;">
					<table cellspacing = "0" cellpadding = "0" id = "logintable" align = "center" width = "81.5%"
						style = "border-radius: -20px;
						-webkit-border-radius: -20px;
						-moz-border-radius: -20px;
						background: #D8D8D8;
						padding-top: 40px; padding-left: 20px; padding-bottom: 30px;">
						<tr>
							<td colspan = "3" style = "margin-top: -20px;">
								<font style = "font-size: 23px; color: #424242;">Ár összesen: <font color = "green"><?php echo htmlspecialchars($sumM); ?> Ft</font></font>
							</td>
						</tr>
						<tr>
							<td colspan = "3">
								<font style = "font-size: 23px; color: #424242;">Kölcsönzések (<?php echo $countPersonalMotorRents; ?>)</font> <!-- zárjójelben a rekordok száma -->
							</td>
						</tr>
					</table>
				</div>
				<div align = "center" width = "70%" style = "z-index:1;">
				
				
				<!--  INNENTŐL ISMÉTLŐDIK -->
				<?php while($rowsM = mysqli_fetch_assoc($personalMotorRentSqlQuery)){
					?>
				
				
					<table cellspacing = "0" cellpadding = "0" align = "center" width = "81.5%"
						style = "border-radius: -20px;
						-webkit-border-radius: -20px;
						-moz-border-radius: -20px;
						background: #D8D8D8;
						padding-top: 10px; padding-left: 20px; padding-bottom: 30px;">
						<tr> 
							<td rowspan = "8" width = "30%"  style = "padding-top: 10px; z-index: 1; padding-left: 5%;">
								<img src = "<?php echo htmlspecialchars($rowsM["fenykep"]); ?>" width = "250px" height = "180px">
							</td>
							<td width = "40%"></br></td>
							<td width = "40%"></br></td>
						</tr>
						<tr>
							<td>
								Autó márkája: <b> <?php echo htmlspecialchars($rowsM['motormarka_id'])." ".htmlspecialchars($rowsM["marka_tipus"]); ?></b>
							</td>
							<td>
								<font style = "color: green; font-size: 19px;" ><i>Kölcsönzés: <b><?php echo $counterM++; ?></b></i></font>
							</td>
						</tr>
						<tr>
							<td>
								Kategória:  <b><?php echo htmlspecialchars($rowsM['kategoria']); ?> </b>
							</td>
							<td>
								Kezdeti dátum:  <b><?php echo htmlspecialchars($rowsM['mettol']); ?> </b>
							</td>
						</tr>
						<tr>
							<td>
								Állapot:  <b><?php echo htmlspecialchars($rowsM['allapot']); ?> </b>
							</td>
							<td>
								Végső dátum:  <b><?php echo htmlspecialchars($rowsM['meddig']); ?> </b>
							</td>
						</tr>
						<tr>
							<td>
								Évjárat:  <b><?php echo htmlspecialchars($rowsM['evjarat']); ?> </b>
							</td>
							<td>
								Kölcsönző fél:  <b><?php echo htmlspecialchars($rowsM['vezetek_nev'])." ".htmlspecialchars($rowsM["kereszt_nev"]); ?> </b>
							</td>
						</tr>
						<tr>
							<td>
								Futott táv:  <b><?php echo htmlspecialchars($rowsM['km_ora_allasa']); ?> km</b>
							</td>
							<td>
								Ár naponta  <b><?php echo htmlspecialchars($rowsM['ar_naponta']); ?> Ft </b>
							</td>
						</tr>
						<tr>
							<td>
								Üzemanyag.:  <b><?php echo htmlspecialchars($rowsM['uzemanyag']); ?> </b>
							</td>
							<td>
								Ár összesen:  <b><?php echo htmlspecialchars($rowsM['ar_osszesen']); ?> Ft</b>
							</td>
						</tr>
					</table>
					<?php }
				}
				else{
					echo' 
						<div id="motoroskolcsonzesek" class="tabcontent">
							<table id = "carmotortable" style = "margin-left: 9.5%; border-radius: 0; color: white; display: inline-block; width: 81%; font-size: 25px; background: #FE2E2E; padding: 0px; padding-left: 15px;">
								<tr>
									<td colpan = "2" style = "font-size: 18px;" width = "100%"background: #56AF3E;><b>Még nincsenek motoros kölcsönzései! ('.$row['felhasznalo_nev'].')</b></td>
								</tr>
							</table>
						</div>
					';
				}
					
			?>
				</div>		
			</div>
				<?php
				}
			}
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
		
		
		
	</body>
</html>