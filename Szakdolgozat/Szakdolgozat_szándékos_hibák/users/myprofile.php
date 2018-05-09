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
			  <button class="tablinks" style = "width: 25%;" onclick="openTabs(event, 'Felhasznaloi_adatok')" id="defaultOpen">Profilom <i class="fa fa-user" aria-hidden="true"></i></button>
			    <button class="tablinks" style = "width: 25%;" onclick="openTabs(event, 'Jelszocsere')">Új jelszó <i class="fa fa-key" aria-hidden="true"></i></button>
			  <button class="tablinks" style = "width: 25%;" onclick="openTabs(event, 'Kolcsonzesekauto')">Autós kölcsönzések <i class="fa fa-car" aria-hidden="true"></i></button>
			  <button class="tablinks" style = "width: 25%;" onclick="openTabs(event, 'Kolcsonzesekmotor')">Motoros kölcsönzések <i class="fa fa-motor" aria-hidden="true"></i></button>
			</div>
			
			
			<!-- FELHASZNÁLÓI ADATOK -->
			
			
			
			<?php 
			$profilesql = "SELECT * FROM felhasznalo WHERE felhasznalo_nev = '".$login_session."'";
			$profilequery = mysqli_query($conn, $profilesql);
			$countProfile = mysqli_num_rows($profilequery);
			
			if($countProfile > 0){
				while($row = mysqli_fetch_assoc($profilequery)){
				?>
			
			
				<div id="Felhasznaloi_adatok" class="tabcontent">
					<div align = "center" style = "margin-bottom: -10px; z-index: 1;"id = "icons" >
						<img id = "icons"id="logo" src="../res/user.png" alt="logo" style = "width: 110px; height: 110px;" />
					</div>
					<div align = "center" width = "35%">
					<form method = "POST" action = "profile_update.php"> 
						<table cellspacing = "0" cellpadding = "0" id = "usertable" style = "border-radius: 0;" align = "center" width = "70%"
						style = "border-radius: 12;
						-webkit-border-radius: 12;
						-moz-border-radius: 12;">
							<tr>
								<td height = "40px" align = "center" colspan = "2">Profilom </font>
								</td>
							</tr>
							<tr>
								<td style = "padding: 5px;" colspan = "2">
									<div style="text-align: center; height: 1px; background-color: #E6E6E6; width:100%;"></div>
								</td>
							</tr>
							<tr>
								<td height = "40px" align = "left" style =" padding: 20px 0px 20px 30px;"><b><font size = "6">Személyes adatok
								<i class="fa fa-user"></i> 
								</td>
							</tr>
							<tr>
								<td height = "25px" colspan = "2" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Vezetéknév</br>
								<input type = "text" class = "input" name = "vnev"  value = "<?php echo $row["vezetek_nev"]; ?>" required></td> <!-- value-ba a belépett felhasználó lakcíme kerüljön -->
							</tr>
							<tr>
								<td height = "25px" colspan = "2" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Keresztnév</br>
								<input type = "text" class = "input" name = "knev"  value = "<?php echo $row["kereszt_nev"]; ?>" required></td> <!-- value-ba a belépett felhasználó lakcíme kerüljön -->
							</tr>
							<tr>
								<td height = "25px" colspan = "2" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Telefonszám</br>
								<input type = "text" class = "input" name = "telszam"  value = "<?php echo $row["telszam"]; ?>" required></td> <!-- value-ba a belépett felhasználó lakcíme kerüljön -->
							</tr>
							<tr>
								<td height = "25px" colspan = "2" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Irányítószám</br>
								<input type = "number" class = "input" name = "irszam"  value = "<?php echo $row["ir_szam"]; ?>" required></td> <!-- value-ba a belépett felhasználó lakcíme kerüljön -->
							</tr>
							<tr>
								<td height = "25px" colspan = "2" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Város</br>
								<input type = "text" class = "input" name = "varos"  value = "<?php echo $row["varos"]; ?>" required></td> <!-- value-ba a belépett felhasználó lakcíme kerüljön -->
							</tr>
							<tr>
								<td height = "25px" colspan = "2" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Utca</br>
								<input type = "text" class = "input" name = "utca"  value = "<?php echo $row["utca"]; ?>" required></td> <!-- value-ba a belépett felhasználó lakcíme kerüljön -->
							</tr>
							<tr>
								<td height = "25px" colspan = "2" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Házszám</br>
								<input type = "number" class = "input" name = "hazszam"  value = "<?php echo $row["hazszam"]; ?>" required></td> <!-- value-ba a belépett felhasználó lakcíme kerüljön -->
							</tr>
							<tr>
								<td height = "25px" colspan = "2" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Születési hely</br>
								<input type = "text" class = "input" name = "szulhely"  value = "<?php echo $row["szuletesi_hely"]; ?>" required></td> <!-- value-ba a belépett felhasználó lakcíme kerüljön -->
							</tr>
							<tr>
								<td height = "25px" colspan = "2" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Születési idő</br>
								<input type = "date" class = "input" name = "szulido"  value = "<?php echo $row["szuletesi_ido"]; ?>" required></td> <!-- value-ba a belépett felhasználó lakcíme kerüljön -->
							</tr>
							<tr>
								<td height = "25px" colspan = "2" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Anyja vezetékneve</br>
								<input type = "text" class = "input" name = "anyjavnev"  value = "<?php echo $row["anyja_vnev"]; ?>" required></td> <!-- value-ba a belépett felhasználó lakcíme kerüljön -->
							</tr>
							<tr>
								<td height = "25px" colspan = "2" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Anyja keresztneve</br>
								<input type = "text" class = "input" name = "anyjaknev"  value = "<?php echo $row["anyja_knev"]; ?>" required></td> <!-- value-ba a belépett felhasználó lakcíme kerüljön -->
							</tr>
							<tr><td colspan = "2" height = "10px"></td></tr>
							<tr>
								<td style="padding: 0px 38px 0px 30px;" colspan = "2">
									<input type = "submit" class = "delete_edit" style = "font-size: 20px;padding: 3px; width: 30%" name = "updateprofile" value = "Módosítás" />
								</td>
							</tr>
						</table>
						</form>
					</div>	
				</div>
				<?php
				}
			}
			?>

			
			<!-- ÚJ JELSZÓ -->

			
			<div id="Jelszocsere" class="tabcontent">
			<div align = "center" style = "margin-bottom: -10px; z-index: 1;"id = "icons" >
					<img id = "icons"id="logo" src="../res/user.png" alt="logo" style = "width: 110px; height: 110px;" />
				</div>
				<div align = "center" width = "35%">
				<form method = "POST" action = "password_update.php"> <!--  action-t át kell írni! -->
					<table cellspacing = "0" cellpadding = "0" id = "usertable" style = "border-radius: 0;" align = "center" width = "70%"
					style = "border-radius: 12;
					-webkit-border-radius: 12;
					-moz-border-radius: 12;">
						<tr>
							<td height = "40px" align = "center" colspan = "2">Profilom </font>
							</td>
						</tr>
						<tr>
							<td style = "padding: 5px;" colspan = "2">
								<div style="text-align: center; height: 1px; background-color: #E6E6E6; width:100%;"></div>
							</td>
						</tr>
						<tr>
							<td height = "40px" align = "left" style =" padding: 20px 0px 20px 30px;"><b><font size = "6">Jelszó módosítása
							<i class="fa fa-key"></i> 
							</td>
						</tr>
						<tr>
							<td height = "25px" colspan = "2" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Új jelszó</br>
							<input type = "password" class = "input" name = "newpass" required></td> 
						</tr>
						<tr>
							<td height = "25px" colspan = "2" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Új jelszó megerősítése</br>
							<input type = "password" class = "input" name = "newpassagain" required></td> 
						</tr>
						<tr><td colspan = "2" height = "10px"></td></tr>
						<tr>
							<td style="padding: 0px 38px 0px 30px;" colspan = "2">
								<input type = "submit" class = "delete_edit" style = "font-size: 20px; padding: 3px; width: 30%" name = "updatepassword" value = "Módosítás" />
							</td>
						</tr>
					</table>
					</form>
				</div>
			</div>
			
			
			<!-- AUTÓS KÖLCSÖNZÉSEK -->
			
			
			<?php 
			$personalCarRentSql = "SELECT * FROM auto, autokolcsonzes, felhasznalo WHERE 
			felhasznalo.felhasznalo_nev = '".$login_session."' AND auto.id = autokolcsonzes.auto_id AND 
			autokolcsonzes.felhasznalo_nev = felhasznalo.felhasznalo_nev ORDER BY mettol DESC;";
			$personalCarRentSqlQuery = mysqli_query($conn, $personalCarRentSql);
			$countPersonalCarRents = mysqli_num_rows($personalCarRentSqlQuery);
			$counter = 1;
			
			if($countPersonalCarRents > 0){
				
				$sumPrice= "SELECT sum(ar_osszesen) AS osszesar FROM autokolcsonzes, felhasznalo WHERE 
				autokolcsonzes.felhasznalo_nev = felhasznalo.felhasznalo_nev AND felhasznalo.felhasznalo_nev = '".$login_session."'";
				$sumPriceQuery = mysqli_query($conn, $sumPrice);
				$rowSum = mysqli_fetch_assoc($sumPriceQuery); 
				$sum = $rowSum['osszesar'];
				//echo $sumPrice;
		
				?>
			
			
			<div id="Kolcsonzesekauto" class="tabcontent">
				<div align = "center" width = "70%" style = "z-index:1;">
					<table cellspacing = "0" cellpadding = "0" id = "logintable" align = "center" width = "81.5%"
						style = "border-radius: -20px;
						-webkit-border-radius: -20px;
						-moz-border-radius: -20px;
						background: #D8D8D8;
						padding-top: 40px; padding-left: 20px; padding-bottom: 30px;">
						<tr>
							<td colspan = "3" style = "margin-top: -20px;">
								<font style = "font-size: 23px; color: #424242;">Ár összesen: <font color = "green"><?php echo $sum; ?> Ft</font></font>
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
								<img src = "<?php echo $rows["fenykep"]; ?>" width = "250px" height = "180px">
							</td>
							<td width = "40%"></br></td>
							<td width = "40%"></br></td>
						</tr>
						<tr>
							<td>
								Autó márkája: <b> <?php echo $rows['automarka_id']." ".$rows["marka_tipus"]; ?></b>
							</td>
							<td>
								<font style = "color: green; font-size: 19px;" ><i>Kölcsönzés: <b><?php echo $counter++; ?></b></i></font>
							</td>
						</tr>
						<tr>
							<td>
								Kategória:  <b><?php echo $rows['kategoria']; ?> </b>
							</td>
							<td>
								Kezdeti dátum:  <b><?php echo $rows['mettol']; ?> </b>
							</td>
						</tr>
						<tr>
							<td>
								Állapot:  <b><?php echo $rows['allapot']; ?> </b>
							</td>
							<td>
								Végső dátum:  <b><?php echo $rows['meddig']; ?> </b>
							</td>
						</tr>
						<tr>
							<td>
								Évjárat:  <b><?php echo $rows['evjarat']; ?> </b>
							</td>
							<td>
								Kölcsönző fél:  <b><?php echo $rows['vezetek_nev']." ".$rows["kereszt_nev"]; ?> </b>
							</td>
						</tr>
						<tr>
							<td>
								Futott táv:  <b><?php echo $rows['km_ora_allasa']; ?> km</b>
							</td>
							<td>
								Ár naponta  <b><?php echo $rows['ar_naponta']; ?> Ft </b>
							</td>
						</tr>
						<tr>
							<td>
								Száll. szem.:  <b><?php echo $rows['szallithato_szemelyek']; ?> fő</b>
							</td>
							<td>
								Ár összesen:  <b><?php echo $rows['ar_osszesen']; ?> Ft</b>
							</td>
						</tr>
					</table>
					<?php }
				}
				else{
					echo' 
					<div 
						<div id="Kolcsonzesekauto" class="tabcontent">
							<table id = "carmotortable" style = "margin-left: 10%; border-radius: 0; color: white; display: inline-block; width: 80%; padding: 20px; font-size: 25px; background: #FE2E2E; padding: 0px; padding-left: 15px;">
								<tr>
									<td colpan = "2" style = "font-size: 18px;" width = "100%"background: #56AF3E;><b>Önnek még nincsenek autós kölcsönzései!</b></td>
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
			felhasznalo.felhasznalo_nev = '".$login_session."' AND motor.id = motorkolcsonzes.motor_id AND 
			motorkolcsonzes.felhasznalo_nev = felhasznalo.felhasznalo_nev ORDER BY mettol DESC";
			$personalMotorRentSqlQuery = mysqli_query($conn, $personalMotorRentSql);
			$countPersonalMotorRents = mysqli_num_rows($personalMotorRentSqlQuery);
			$counterM = 1;
			
			if($countPersonalMotorRents > 0){
				
				$sumPriceM = "SELECT sum(ar_osszesen) AS osszesar FROM motorkolcsonzes, felhasznalo WHERE 
				motorkolcsonzes.felhasznalo_nev = felhasznalo.felhasznalo_nev AND felhasznalo.felhasznalo_nev = '".$login_session."'";
				$sumPriceQueryM = mysqli_query($conn, $sumPriceM );
				$rowSumM = mysqli_fetch_assoc($sumPriceQueryM); 
				$sumM = $rowSumM['osszesar'];
				
		
				?>
			
			
			<div id="Kolcsonzesekmotor" class="tabcontent">
				<div align = "center" width = "70%" style = "z-index:1;">
					<table cellspacing = "0" cellpadding = "0" id = "logintable" align = "center" width = "81.5%"
						style = "border-radius: -20px;
						-webkit-border-radius: -20px;
						-moz-border-radius: -20px;
						background: #D8D8D8;
						padding-top: 40px; padding-left: 20px; padding-bottom: 30px;">
						<tr>
							<td colspan = "3" style = "margin-top: -20px;">
								<font style = "font-size: 23px; color: #424242;">Ár összesen: <font color = "green"><?php echo $sumM; ?> Ft</font></font>
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
								<img src = "<?php echo $rowsM["fenykep"]; ?>" width = "250px" height = "180px">
							</td>
							<td width = "40%"></br></td>
							<td width = "40%"></br></td>
						</tr>
						<tr>
							<td>
								Autó márkája: <b> <?php echo $rowsM['motormarka_id']." ".$rowsM["marka_tipus"]; ?></b>
							</td>
							<td>
								<font style = "color: green; font-size: 19px;" ><i>Kölcsönzés: <b><?php echo $counterM++; ?></b></i></font>
							</td>
						</tr>
						<tr>
							<td>
								Kategória:  <b><?php echo $rowsM['kategoria']; ?> </b>
							</td>
							<td>
								Kezdeti dátum:  <b><?php echo $rowsM['mettol']; ?> </b>
							</td>
						</tr>
						<tr>
							<td>
								Állapot:  <b><?php echo $rowsM['allapot']; ?> </b>
							</td>
							<td>
								Végső dátum:  <b><?php echo $rowsM['meddig']; ?> </b>
							</td>
						</tr>
						<tr>
							<td>
								Évjárat:  <b><?php echo $rowsM['evjarat']; ?> </b>
							</td>
							<td>
								Kölcsönző fél:  <b><?php echo $rowsM['vezetek_nev']." ".$rowsM["kereszt_nev"]; ?> </b>
							</td>
						</tr>
						<tr>
							<td>
								Futott táv:  <b><?php echo $rowsM['km_ora_allasa']; ?> km</b>
							</td>
							<td>
								Ár naponta  <b><?php echo $rowsM['ar_naponta']; ?> Ft </b>
							</td>
						</tr>
						<tr>
							<td>
								Üzemanyag.:  <b><?php echo $rowsM['uzemanyag']; ?> </b>
							</td>
							<td>
								Ár összesen:  <b><?php echo $rowsM['ar_osszesen']; ?> Ft</b>
							</td>
						</tr>
					</table>
					<?php }
				}
				else{
					echo' 
						<div id="Kolcsonzesekmotor" class="tabcontent">
							<table id = "carmotortable" style = "margin-left: 10%; border-radius: 0; color: white; display: inline-block; width: 80%; font-size: 25px; background: #FE2E2E; padding: 0px; padding-left: 15px;">
								<tr>
									<td colpan = "2" style = "font-size: 18px;" width = "100%"background: #56AF3E;><b>Önnek még nincsenek motoros kölcsönzései!</b></td>
								</tr>
							</table>
						</div>
					';
				}
					
			?>
				</div>		
			</div>
		</br>
			
		</body>
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