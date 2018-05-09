<?php
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
			  <a align = "right" title = "Automatikus kijelentkezés <?php echo $timeleft; ?> mp múlva."
			  href= "" style = "padding: 0;margin-top: 1.2%; margin-left: 41%;font-size: 22px; text-align: right;"><?php echo $timeleft; ?> mp</a>
			  <form method = "POST" action = "logout.php" enctype = "multipart/form-data" name = "logout">
				<input type = "submit" class = "input" name = "logout" value = "Kijelentkezés" style = "align: right; z-index:1;"/> <!--<i class="fas fa-sign-out-alt"></i> -->
			  </form>
			</div>
			
			<!-- legújabb autók -->
			</br></br></br>
			
		
			<div align = "center" style = "margin-left: 5.05%; margin-right: 5%; margin-bottom: 6px;">
			<table  width = "100%" style = "background:#EAE9E9; margin-left: -5px;  font-family: 'Raleway', serif; text-align: left;
				font-size: 15px; color: #fff; padding-left: 10px; padding-top: 5px; padding-bottom: 5px;" align = "center" cellpadding = "0" cellspacing = "0" >
				<tr>
					<td align = "left" style = "padding: 5px; color: black; font-size: 41px;
					text-shadow: 1px 1px 2px black, 0 0 25px white, 0 0 5px white;">Válasszon legújabb autóink közül!</td>
				</tr>
			</table>
			</div>
			
			
			<div style = "float:left; margin-left: 4.2%;">
			
			
			<?php
			
				$cars = "SELECT * FROM auto ORDER BY RAND() LIMIT 12;";
				$getCars = mysqli_query($conn, $cars);
				
				if(mysqli_num_rows($getCars)>0){
					while($row = mysqli_fetch_assoc($getCars)){ 
					
					$carAverageSql = "SELECT AVG(ertekeles) as atlagertekeles FROM auto, 
					autosertekelesek WHERE auto.id = autosertekelesek.auto_id AND auto.id = '".$row['id']."';";
					$carAvgQuery = mysqli_query($conn, $carAverageSql);
					$rowAvg = mysqli_fetch_assoc($carAvgQuery); 
					$avg = $rowAvg['atlagertekeles'];
					
					?>
		
							<table class = "table" id = "carmotortable" style="float: left;display: inline-block; border:1px solid gray;
							width: 31%; padding: 1%; margin-bottom: 0.5%; margin-left: 0.5%; background: #EAE9E9; color: black;" align = "center" cellspacing = "0" cellpadding = "0">
							<form method = "get" action = "viewcar.php" enctype = "multipart/form-data" name = "search_simple">
								<tr>
									<td colspan = "2"style = "text-align: left;" width = "15%">
										<a target = "_blank" href = "<?php echo htmlspecialchars($row["fenykep"]); ?>" title = "A következő megjelenítése új lapon: <?php echo htmlspecialchars($row["automarka_id"])." ".htmlspecialchars($row["marka_tipus"]); ?>">
											<img src = "<?php echo htmlspecialchars($row["fenykep"]); ?>" style = "width:100%; height: 220px; border-radius: 10px; border: 1px solid #1C1C1C; margin-top: -0px" />
										</a>
									</td>
								</tr>
								<tr>
									<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
										<b><?php echo htmlspecialchars($row['automarka_id'])." ".htmlspecialchars($row['marka_tipus'])."</b>, ".htmlspecialchars($row['kategoria']); ?>
									</td>
								</tr>
								<tr>
									<td colspan = "2"style = "text-align: left; padding-top: 0px;" width = "15%">
										<?php echo htmlspecialchars($row['km_ora_allasa']);?> km | <?php echo htmlspecialchars($row['allapot']); ?> | <?php echo htmlspecialchars($row['autoszin']); ?>  
										<?php
											if(htmlspecialchars($avg) < 1.0){
												?> | <font color = "#2e9afe"> Nincs értékelés</font> <?php
											}
											else if(htmlspecialchars($avg) >= 1.0 & htmlspecialchars($avg) < 1.5){
												?> | <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
											else if(htmlspecialchars($avg) >= 1.5 & htmlspecialchars($avg) < 2.5){
												?> | <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
											else if(htmlspecialchars($avg) >= 2.5 & htmlspecialchars($avg) < 3.5){
												?> | <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
											else if(htmlspecialchars($avg) >= 3.5 & htmlspecialchars($avg) < 4.5){
												?> | <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"> </i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
											else if(htmlspecialchars($avg) >= 4.5 & htmlspecialchars($avg) <= 5.0){
												?> | <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"> </i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
										?>
									</td>
								</tr>
								<tr>
									<td colspan = "2"style = "text-align: left; padding-top: 0px;" width = "15%">
										<?php echo htmlspecialchars($row['uzemanyag'])." | ".htmlspecialchars($row['hengerurtartalom'])." cm<sup>3</sup> | ".htmlspecialchars($row['teljesitmeny'])." LE | ".htmlspecialchars($row['vegsebesseg'])." km/h";?>
									</td>
								</tr>
								<tr>
									<td colspan = "2"style = "text-align: left; padding-top: 10px; padding-bottom: 10px;" width = "15%">
										<input type = "submit" class = "delete_edit2" name = "<?php echo $row['auto_id2']; ?>" value = "Autó adatlapja" style = "width: 95%;" />
									</td>
								</tr>
								<tr>
									<td style = "border-top: 1px solid black;"></br></td>
								</tr>
								
							</form>
							</table>
							
						
					<?php
					}		
				}
			?>
			</div>
			
			<div align = "center" style = "margin-left: 5.05%; margin-right: 5%; ">
			<table  width = "100%" style = "margin-top: -10px; background:#EAE9E9; margin-left: -5px; margin-bottom: 0.5%; font-family: 'Raleway', serif; text-align: left;
				font-size: 15px; color: #fff; padding-left: 10px; padding-top: 5px; padding-bottom: 35px;" align = "center" cellpadding = "0" cellspacing = "0" >
				<tr>
					<td align = "left" style = "padding: 5px; color: black; font-size: 41px;
					text-shadow: 1px 1px 2px black, 0 0 25px white, 0 0 5px white;">Esetleg motorra van szüksége?</td>
				</tr>
			</table>
			</div>
			
			
			
			<div style = "float:left; margin-left: 4.2%;">
			
			
			<?php

				$motors = "SELECT * FROM motor ORDER BY RAND() LIMIT 3;";
				$getMotors = mysqli_query($conn, $motors);
					 
				if(mysqli_num_rows($getMotors)>0){
					 while($row = mysqli_fetch_assoc($getMotors)){
						 
						$motorAverageSql = "SELECT AVG(ertekeles) as atlagertekeles FROM motor, 
						motorosertekelesek WHERE motor.id = motorosertekelesek.motor_id AND motor.id = '".$row['id']."';";
						$motorAvgQuery = mysqli_query($conn, $motorAverageSql);
						$rowAvg = mysqli_fetch_assoc($motorAvgQuery); 
						$avg = $rowAvg['atlagertekeles'];

					 ?>
		
							<table id = "carmotortable" style="float: left;display: inline-block; border:1px solid gray;
							width: 31%; padding: 1%; margin-bottom: 35px; margin-left: 0.5%; border-bottom: 1px solid #6E6E6E; background: #EAE9E9; color: black;" align = "center" cellspacing = "0" cellpadding = "0">
							<form method = "get" action = "viewmotor.php" enctype = "multipart/form-data" name = "search_simple">
								<tr>
									<td colspan = "2"style = "text-align: left;" width = "15%">
										<a target = "_blank" href = "<?php echo $row["fenykep"]; ?>" title = "A következő megjelenítése új lapon: <?php echo htmlspecialchars($row["motormarka_id"])." ".htmlspecialchars($row["marka_tipus"]); ?>">
											<img src = "<?php echo htmlspecialchars($row["fenykep"]); ?>" style = "width:100%; height: 220px; border-radius: 10px; margin-top: 0px; border:1px solid #1C1C1C;" />
										</a>
									</td>
								</tr>
								</tr>
									<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
										<b><?php echo htmlspecialchars($row['motormarka_id'])." ".htmlspecialchars($row['marka_tipus'])."</b>, ".htmlspecialchars($row['kategoria']); ?>
									</td>
								</tr>
								</tr>
									<td colspan = "2"style = "text-align: left; padding-top: 0px;" width = "15%">
										<?php echo htmlspecialchars($row['km_ora_allasa']);?> km | <?php echo htmlspecialchars($row['allapot']); ?> | <?php echo htmlspecialchars($row['motorszin']); ?>
										<?php
											if(htmlspecialchars($avg) < 1.0){
												?> | <font color = "#2e9afe"> Nincs értékelés</font><?php
											}
											else if(htmlspecialchars($avg) >= 1.0 & htmlspecialchars($avg) < 1.5){
												?> | <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
											else if(htmlspecialchars($avg) >= 1.5 & htmlspecialchars($avg) < 2.5){
												?> | <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
											else if(htmlspecialchars($avg) >= 2.5 & htmlspecialchars($avg) < 3.5){
												?> | <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
											else if(htmlspecialchars($avg) >= 3.5 & htmlspecialchars($avg) < 4.5){
												?> | <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"> </i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
											else if(htmlspecialchars($avg) >= 4.5 & htmlspecialchars($avg) <= 5.0){
												?> | <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"> </i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
										?>
									</td>
								</tr>
								</tr>
									<td colspan = "2"style = "text-align: left; padding-top: 0px;" width = "15%">
										<?php echo htmlspecialchars($row['uzemanyag'])." | ".htmlspecialchars($row['hengerurtartalom'])." cm<sup>3</sup> | ".htmlspecialchars($row['teljesitmeny'])." LE | ".htmlspecialchars($row['vegsebesseg'])." km/h";?>
									</td>
								</tr>
								</tr>
									<td colspan = "2"style = "text-align: left; padding-top: 10px; padding-bottom: 10px;" width = "15%">
										<input type = "submit" class = "delete_edit2" name = "<?php echo $row['motor_id2']; ?>" value = "Motor adatlapja" style = "width: 95%;" />
									</td>
								</tr>
								<tr>
									<td style = "border-top: 1px solid black;"></br></td>
								</tr>
								
							</form>
							</table>
							
						
					<?php
					}		
				}
			?>
			</div>
		</br></br>
	</body>
</html>
