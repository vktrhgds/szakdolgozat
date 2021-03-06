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
			<div class="navbar" style = "background: rgb(50,50,50);" >
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
			  <a align = "right" title = "Automatikus kijelentkezés <?php echo $timeleft; ?> mp múlva."
			  href= "" style = "padding: 0;margin-top: 1.2%; margin-left: 41%;font-size: 22px; text-align: right;"><?php echo $timeleft; ?> mp</a>
			  <form method = "POST" action = "logout.php" enctype = "multipart/form-data" name = "logout">
				<input type = "submit" class = "input" name = "logout" value = "Kijelentkezés" style = "align: right; z-index:1;"/> <!--<i class="fas fa-sign-out-alt"></i> -->
			  </form>
			</div>
			
			<!-- random motorok -->
			</br></br></br>
			
			<?php 
				$random_motor_sql = "SELECT * FROM motor ORDER BY RAND() LIMIT 10;";
				$random_motor_sql_query = mysqli_query($conn, $random_motor_sql);
				$count_random_motors = mysqli_num_rows($random_motor_sql_query);
				
				if($count_random_motors > 0){
					?>
					
					
					<div style = "position: absolute;display: inline-block;">
					<table id = "carmotortable" style=" max-height: 1000px; overflow-y: scroll;position: fixed;display: inline-block;
					width: 20%; margin-left: 5%; border-bottom: 1px solid #6E6E6E; background: #EAE9E9; color: black;" align = "center" cellspacing = "0" cellpadding = "0">
					<form method = "get" action = "viewmotor.php" enctype = "multipart/form-data" name = "search_simple">
						<tr>
							<td colspan = "2" style = "text-align: left;padding-bottom: 10px;" width = "15%"><b>Mást választana?</b></td>
						</tr>
						<?php while($row = mysqli_fetch_assoc($random_motor_sql_query)){ ?>
						<tr>
							<td colspan = "2"style = "text-align: left;" width = "15%">
								<a target = "_blank" href = "<?php echo htmlspecialchars($row["fenykep"]); ?>" title = "A következő megjelenítése új lapon: <?php echo htmlspecialchars($row["motormarka_id"])." ".htmlspecialchars($row["marka_tipus"]); ?>">
									<img src = "<?php echo $row["fenykep"]; ?>" style = "width:100%; height: 150px; border-radius: 10px;" />
								</a>
							</td>
						</tr>
						</tr>
							<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
								<?php echo htmlspecialchars($row['motormarka_id'])." ".htmlspecialchars($row['marka_tipus']).", ".htmlspecialchars($row['kategoria']); ?>
							</td>
						</tr>
						</tr>
							<td colspan = "2"style = "text-align: left; padding-top: 10px; padding-bottom: 10px;" width = "15%">
								<input type = "submit" class = "delete_edit" name = "<?php echo $row['motor_id2']; ?>" value = "Motor adatlapja" style = "width: 95%;" />
							</td>
						</tr>
						<tr>
							<td style = "border-top: 1px solid black;"></br></td>
						</tr>
						<?php
						}
					}
				?>
					</form>
					</table>
					</div>
			
			
			
			
			<?php
				if(isset($_GET['u_motorChosen'])){
					
					if ( array_key_exists( "u_motorChosen", $_GET ) && !is_null ($_GET['u_motorChosen']) ) { 

						# White list the allowable languages 
						switch ($_GET['u_motorChosen']) { 
							case "Audi": 
							case "Aprilia": 
							case "Gilera": 
							case "BMW":
							case "Keeway": 
							case "Yamaha":  							
								# ok 
								break; 
							default: 
								header ("location: ../users/index.php"); 
								exit; 
								ob_end_flush();
						} 
					}
					
					$getMotorByName = $_GET['u_motorChosen'];
					$getmotor_sql = "SELECT * FROM motor WHERE motormarka_id = '".$getMotorByName."'";
					$getmotor_query = mysqli_query($conn, $getmotor_sql);
							
					$rowindex = 1;
					if (mysqli_num_rows($getmotor_query) > 0){
						
						echo ' 
								<div align = "center">
									<table id = "carmotortable" style = "border-radius: 0; color: white; display: inline-block; width: 69.5%; margin-left: 20%; font-size: 25px; background: #56af3e; padding: 0px; padding-left: 15px;">
										<tr>
											<td  width = "100%"background: #56AF3E;><b><i class="fa fa-search "></i> Találatok száma a(z) "'.$_GET['u_motorChosen'].'" kategóriában: '.mysqli_num_rows($getmotor_query).' db</b></td>
										</tr>
									</table>
								</div>
								';
						
						
						while($row = mysqli_fetch_assoc($getmotor_query)){
							
						$motorAverageSql = "SELECT AVG(ertekeles) as atlagertekeles FROM motor, 
						motorosertekelesek WHERE motor.id = motorosertekelesek.motor_id AND motor.id = '".$row['id']."';";
						$motorAvgQuery = mysqli_query($conn, $motorAverageSql);
						$rowAvg = mysqli_fetch_assoc($motorAvgQuery); 
						$avg = $rowAvg['atlagertekeles'];	
						
						?>
						 
						 
						<div align = "center">
								<table cellspacing = "0" cellpadding = "0" id = "carmotortable" align = "center" 
								style = " border-radius: 0;z-index: 0; display: inline-block; width: 69.5%; margin-left: 20%; border-bottom: 2px solid gray; background: #E6E6E6; color: black;"
									<tr>
										<td style = "text-align: right; padding-right:12px;" width = "25%">Motormárka</td>
										<td style = "text-align: left; padding: right: 10px;" width = "15%"><b><?php echo htmlspecialchars($row['motormarka_id']); ?></b></td>
										<td rowspan = "16" width = "60%">
										<a target = "_blank" href = "<?php echo htmlspecialchars($row["fenykep"]); ?>" title = "A következő megjelenítése új lapon: <?php echo htmlspecialchars($row["motormarka_id"])." ".htmlspecialchars($row["marka_tipus"]); ?>">
											<img src = "<?php echo htmlspecialchars($row["fenykep"]); ?>" style = "width:100%; height: 400px; border-radius: 10px;" />
										</a>
										</td>
										<td width = "0" rowspan = "18"></td>
									</tr>
									<tr>
										<td style = "text-align: right; padding-right:12px;"width = "25%">Márka típusa</td>
										<td style = "text-align: left; padding-right: 10px;"><b><?php echo htmlspecialchars($row['marka_tipus']); ?></b></td>
									</tr>
									
									<tr>
										<td style = "text-align: right; padding-right:12px;"width = "25%">Kategória</td>
										<td style = "text-align: left; padding-right: 10px;"><b><?php echo htmlspecialchars($row['kategoria']); ?></b></td>
									</tr>
									<tr>
										<td style = "text-align: right; padding-right:12px;"width = "25%">Ár (1-6 napig)</td>
										<td style = "text-align: left; padding-right: 10px;"><b style = "color: green;"><?php echo htmlspecialchars($row['ar_1']); ?> HUF</b></td>
									</tr>
									<tr>
										<td style = "text-align: right; padding-right:12px;"width = "25%">Ár (7-30 napig)</td>
										<td style = "text-align: left; padding-right: 10px;"><b style = "color: green;"><?php echo htmlspecialchars($row['ar_2']); ?> HUF</b></td>
									</tr>
									<tr>
										<td style = "text-align: right; padding-right:12px;">Ár (31-365 napig)</td>
										<td style = "text-align: left; padding-right: 10px;"><b style = "color: green;"><?php echo htmlspecialchars($row['ar_3']); ?> HUF</b></td>
									</tr>
									<tr>
										<td style = "text-align: right; padding-right:12px;">Évjárat</td>
										<td style = "text-align: left; padding-right: 10px;"><b><?php echo htmlspecialchars($row['evjarat']); ?></b></td>
									</tr>
									<tr>
										<td style = "text-align: right; padding-right:12px;">Állapot</td>
										<td style = "text-align: left; padding-right: 10px;"><b><?php echo htmlspecialchars($row['allapot']); ?></b></td>
									</tr>
									<tr>
										<td style = "text-align: right; padding-right:12px;">Futott táv</td>
										<td style = "text-align: left; padding-right: 10px;"><b><?php echo htmlspecialchars($row['km_ora_allasa']); ?> km</b></td>
									</tr>
									<tr>
										<td style = "text-align: right; padding-right:12px;">Üzemanyag</td>
										<td style = "text-align: left; padding-right: 10px;"><b><?php echo htmlspecialchars($row['uzemanyag']); ?></b></td>
									</tr>
									<tr>
										<td style = "text-align: right; padding-right:12px;">Hengerűrtartalom</td>
										<td style = "text-align: left; padding-right: 10px;"><b><?php echo htmlspecialchars($row['hengerurtartalom']); ?> cm<sup>3</sup></b></td>
									</tr>
									<tr>
										<td style = "text-align: right; padding-right:12px;">Teljesítmény</td>
										<td style = "text-align: left; padding-right: 10px;"><b><?php echo htmlspecialchars($row['teljesitmeny']); ?> LE</b></td>
									</tr>
									<tr>
										<td style = "text-align: right; padding-right:12px;">Szín</td>
										<td style = "text-align: left; padding-right: 10px;"><b><?php echo htmlspecialchars($row['motorszin']); ?> </b></td>
									</tr>
									<tr>
										<td style = "text-align: right; padding-right:12px;">Saját tömeg</td>
										<td style = "text-align: left; padding-right: 10px;"><b><?php echo htmlspecialchars($row['sajat_tomeg']); ?> kg</b></td>
									</tr>
									<tr>
										<td style = "text-align: right; padding-right:12px;">Max. tömeg</td>
										<td style = "text-align: left; padding-right: 10px;"><b><?php echo htmlspecialchars($row['maximalis_tomeg']); ?> kg</b></td>
									</tr>
									<tr>
										<td style = "text-align: right; padding-right:12px;">Tankméret</td>
										<td style = "text-align: left; padding-right: 10px;"><b><?php echo htmlspecialchars($row['tank_meret']); ?> l</b></td>
									</tr>
									<tr>
										<td style = "text-align: right; padding-right:12px;">Átlagfogyasztás</td>
										<td style = "text-align: left; padding-right: 10px;"><b><?php echo htmlspecialchars($row['atlagfogyasztas']); ?> l/100 km</b></td>
										<td rowspan = "5">
										<form method = "get" action = "motor_kolcsonzes" enctype = "multipart/form-data" name = "viewmotor">
											<?php echo '<input type = "submit"  class = "viewvehicle" value = "Kölcsönzés" style = "height: 32px;width: 50%; padding: 0; "name = "'.$row["motor_id2"].'" >
										</form>'?>
										</td>
									</tr>
									<tr>
										<td style = "text-align: right; padding-right:12px;">Végsebesség</td>
										<td style = "text-align: left; padding-right: 10px;"><b><?php echo htmlspecialchars($row['vegsebesseg']); ?> km/h</b></td>
									</tr>
									<tr>
										<td style = "text-align: right; padding-right:12px;">Munkaütem</td>
										<td style = "text-align: left; padding-right: 10px;"><b><?php echo htmlspecialchars($row['munkautem']); ?> </b></td>
									</tr>
									<tr>
										<td style = "text-align: right; padding-right: 12px;" >Átlagértékelés</td>
										<td style = "text-align: left; padding-right: 10px;">
										<?php
											if(htmlspecialchars($avg) < 1.0){
												?> <font color = "#2e9afe"> Nincs értékelés</font><?php
											}
											else if(htmlspecialchars($avg) >= 1.0 & htmlspecialchars($avg) < 1.5){
												?> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
											else if(htmlspecialchars($avg) >= 1.5 & htmlspecialchars($avg) < 2.5){
												?> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
											else if(htmlspecialchars($avg) >= 2.5 & htmlspecialchars($avg) < 3.5){
												?> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
											else if(htmlspecialchars($avg) >= 3.5 & htmlspecialchars($avg) < 4.5){
												?> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"> </i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
											else if(htmlspecialchars($avg) >= 4.5 & htmlspecialchars($avg) <= 5.0){
												?> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"> </i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
										?>
										</td>
									</tr>
									<tr>
										<td colspan = "2" style = "text-align: right; padding-right:12px; padding-top: 20px;">
											<form method = "get" action = "viewmotor" enctype = "multipart/form-data" name = "viewmotor">
												<?php echo '<input type = "submit"  class = "delete_edit2" value = "Tovább az adatlapra" style = "height: 25px;width: 70%; padding: 0; "name = "'.$row["motor_id2"].'" >
											</form>'?>
										</td>
									</tr>
								</table>
							</div>
						<?php 
						}
					}
					else{
					echo ' 
						<div align = "center">
							<table id = "carmotortable" style = "border-radius: 0; color: white; display: inline-block; width: 69.5%; margin-left: 20%; font-size: 25px; background: #FE2E2E; padding: 0px; padding-left: 15px;">
								<tr>
									<td colspan = "2" width = "100%"background: #56AF3E;><b><i class="fa fa-search "></i> Találatok száma: '.mysqli_num_rows($getmotor_query).' db</b></td>
								</tr>
								<tr>
									<td colpan = "2" style = "font-size: 18px;" width = "100%"background: #56AF3E;><b>Nem szerepel ilyen motor az adatbázisban!</b></td>
								</tr>
							</table>
						</div>
						';
					}
				}
			?>
			
			</br></br>
			
		</br></br>
	</body>
</html>



<!--


