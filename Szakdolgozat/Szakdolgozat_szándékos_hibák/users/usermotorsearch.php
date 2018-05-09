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
			
			<!-- Keresés táblázat-->
			</br></br>
			
			<?php
				$getCategs = "SELECT * FROM motor GROUP BY kategoria;";
				$getPrices = "SELECT * FROM motor GROUP BY ar_1;";
				$getMotors = "SELECT * FROM motor GROUP BY motormarka_id;";
				$getMotorTypes = "SELECT * FROM motor GROUP BY marka_tipus;";
				$getFuels = "SELECT * FROM motor GROUP BY uzemanyag;";
				$getEngineCapacity = "SELECT * FROM motor GROUP BY hengerurtartalom;";
				$getColor = "SELECT * FROM motor GROUP BY motorszin;";
				
				$getResultof_categs = mysqli_query($conn, $getCategs);
				$getResultof_prices = mysqli_query($conn, $getPrices);
				$getResultof_motors = mysqli_query($conn, $getMotors);
				$getResultof_motortypes = mysqli_query($conn, $getMotorTypes);
				$getResultof_fuels = mysqli_query($conn, $getFuels);
				$getResultof_enginecap = mysqli_query($conn, $getEngineCapacity);
				$getResultof_color = mysqli_query($conn, $getColor);	
			?>
			
			
			<table id = "carmotortable" style="height: 100%; position: fixed;display: inline-block; width: 20%; margin-left: 5%; border-right: 1px solid #6E6E6E; background: #EAE9E9; color: black;" align = "center" cellspacing = "0" cellpadding = "0">
				<form method = "get" action = "usermotorsearch.php" enctype = "multipart/form-data" name = "search_simple">
					<tr>
						<td colspan = "2"></br></td>
					</tr>
					<tr>
						<td colspan = "2" style = "text-align: left;" width = "15%"><b>Egyszerű keresés</b></td>
					</tr>
						<td colspan = "2"style = "text-align: left;" width = "15%">
							<input type = "text" name = "search_simple_motor" value = "Aprilia" style = "width: 95%;" />
						</td>
					</tr>
					</tr>
						<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
							Pontos egyezés <input type="checkbox" name="test_motor" value="value1">
						</td>
					</tr>
					</tr>
						<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
							<input type = "submit" class = "delete_edit" name = "search_simple_button_motor" value = "Keresés" style = "width: 95%;" />
						</td>
					</tr>
				</form>
				<form method = "get" action = "usermotorsearch.php" enctype = "multipart/form-data" name = "search_extended">
					<tr>
						<td colspan = "2"></br></td>
					</tr>
					<tr>
						<td colspan = "2" style = "text-align: left;" width = "15%"><b>Részletes keresés</b></br></td>
					</tr>
					</tr>
						<td style = "text-align: left; padding-top: 10px;" width = "15%">
							Minimum ár (Ft)
						</td>
						<td style = "text-align: left; padding-top: 10px;" width = "15%">
							Maximum ár (Ft)
						</td>
					</tr>
					</tr>
						<td style = "text-align: left; padding-top: 0px;" width = "15%">
							<input type = "number" name = "minprice_motor" value = "0" style = "width: 90%;" placeholder = "Minimum ár (Ft)"/> -
						</td>
						<td style = "text-align: left; padding-top: 0px;" width = "15%">
							<input type = "number" name = "maxprice_motor" value = "100000" style = "width: 90%;" placeholder = "Maximum ár (Ft)" />
						</td>
					</tr>
					</tr>
						<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
							Kategória
						</td>
					</tr>
						<td colspan = "2" style = "text-align: left; padding-top: 0px;" width = "15%">
							<select style = "width: 95%;" name = "select_categ_motor">
								<option value = ""></option>
								<?php while($rows = mysqli_fetch_array($getResultof_categs)){ ?>
								<option>
									<?php echo $rows["kategoria"]; } ?>
								</option>
							</select>
						</td>
					</tr>
					</tr>
						<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
							Márka
						</td>
					</tr>
						<td colspan = "2" style = "text-align: left; padding-top: 0px;" width = "15%">
							<select style = "width: 95%;" name = "select_motortype">
								<option value = ""></option>
								<?php while($rows = mysqli_fetch_array($getResultof_motortypes)){ ?>
								<option>
									<?php echo $rows["motormarka_id"]; } ?>
								</option>
							</select>
						</td>
					</tr>
					</tr>
						<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
							Üzemanyag
						</td>
					</tr>
						<td colspan = "2" style = "text-align: left; padding-top: 0px;" width = "15%">
							<select style = "width: 95%;" name = "select_fuel_motor">
								<option value = ""></option>
								<?php while($rows = mysqli_fetch_array($getResultof_fuels)){ ?>
								<option>
									<?php echo $rows["uzemanyag"]; } ?>
								</option>
							</select>
						</td>
					</tr>
					</tr>
						<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
							Hengerűrtartalom (cm<sup>3</sup>)
						</td>
					</tr>
						<td colspan = "2" style = "text-align: left; padding-top: 0px;" width = "15%">
							<select style = "width: 95%;" name = "select_enginecap_motor">
								<option value = ""></option>
								<?php while($rows = mysqli_fetch_array($getResultof_enginecap)){ ?>
								<option>
									<?php echo $rows["hengerurtartalom"]; } ?>
								</option>
							</select>
						</td>
					</tr>
					</tr>
						<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
							Motor színe
						</td>
					</tr>
						<td colspan = "2" style = "text-align: left; padding-top: 0px;" width = "15%">
							<select style = "width: 95%;" name = "select_motorcolor">
								<option value = ""></option>
								<?php while($rows = mysqli_fetch_array($getResultof_color)){ ?>
								<option>
									<?php echo $rows["motorszin"]; } ?>
								</option>
							</select>
						</td>
					</tr>
					</tr>
						<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
							<input type = "submit" class = "delete_edit" name = "search_extended_button_motor" value = "Részletes keresés" style = "width: 95%;" />
						</td>
					</tr>
				</form>
				</table>
				
				
				<!-- keresés (php) -->
				
				</br>
				
				<?php 
					if(isset($_GET['search_extended_button_motor'])){
						
						$minprice_motor = $_GET['minprice_motor'];
						$maxprice_motor = $_GET['maxprice_motor'];
						$category_motor = $_GET['select_categ_motor'];
						$motortype = $_GET['select_motortype'];
						$fuel_motor = $_GET['select_fuel_motor'];
						$enginecap_motor = $_GET['select_enginecap_motor'];
						$motorcolor = $_GET['select_motorcolor'];
						
						$List_motors_sql = "SELECT * FROM motor WHERE kategoria LIKE '%".$category_motor."%' AND (ar_1 BETWEEN '".$minprice_motor."' AND '".$maxprice_motor."')
						AND motormarka_id LIKE '%".$motortype."%' AND uzemanyag LIKE '%".$fuel_motor."%' AND hengerurtartalom LIKE '%".$enginecap_motor."%' 
						AND motorszin LIKE '%".$motorcolor."%';";
						
						$list_motors_query = mysqli_query($conn, $List_motors_sql);
						$count_motor_results = mysqli_num_rows($list_motors_query);
						
						//Ha nullánál több találat van...
						if(mysqli_num_rows($list_motors_query)>0){
							
							echo ' 
								<div align = "center">
									<table id = "carmotortable" style = "border-radius: 0; color: white; display: inline-block; width: 69.5%; margin-left: 20%; font-size: 25px; background: #56af3e; padding: 0px; padding-left: 15px;">
										<tr>
											<td  width = "100%"background: #56AF3E;><b><i class="fa fa-search "></i> Találatok száma: '.$count_motor_results.' db</b></td>
										</tr>
									</table>
								</div>
								';
							?>
							<div style = "float:left; margin-left: 25%;">
							<?php

							
							while($row = mysqli_fetch_assoc($list_motors_query)){ 
							
							$motorAverageSql = "SELECT AVG(ertekeles) as atlagertekeles FROM motor, 
							motorosertekelesek WHERE motor.id = motorosertekelesek.motor_id AND motor.id = '".$row['id']."';";
							$motorAvgQuery = mysqli_query($conn, $motorAverageSql);
							$rowAvg = mysqli_fetch_assoc($motorAvgQuery); 
							$avg = $rowAvg['atlagertekeles'];
							
							?>
						 
							<table class = "table" id = "carmotortable" style="float: left;display: inline-block; border:1px solid gray;
							width: 46%; padding: 1%; margin-bottom: 0.5%; margin-left: 0.5%; border-bottom: 1px solid #6E6E6E; background: #EAE9E9; color: black;" align = "center" cellspacing = "0" cellpadding = "0">
							<form method = "get" action = "viewmotor" enctype = "multipart/form-data" name = "search_simple">
								<tr>
									<td colspan = "2"style = "text-align: left;" width = "15%">
										<a target = "_blank" href = "<?php echo $row["fenykep"]; ?>" title = "A következő megjelenítése új lapon: <?php echo $row["motormarka_id"]." ".$row["marka_tipus"]; ?>">
											<img src = "<?php echo $row["fenykep"]; ?>" style = "width:100%; height: 260px; border-radius: 10px; " />
										</a>
									</td>
								</tr>
								</tr>
									<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
										<b><?php echo $row['motormarka_id']." ".$row['marka_tipus']."</b>, ".$row['kategoria']; ?>
									</td>
								</tr>
								</tr>
									<td colspan = "2"style = "text-align: left; padding-top: 0px;" width = "15%">
										<?php echo $row['km_ora_allasa'];?> km | <?php echo $row['allapot']; ?> | <?php echo $row['motorszin']; ?>
										<?php
											if($avg < 1.0){
												?> | <font color = "#2e9afe"> Nincs értékelés</font><?php
											}
											else if($avg >= 1.0 & $avg < 1.5){
												?> | <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
											else if($avg >= 1.5 & $avg < 2.5){
												?> | <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
											else if($avg >= 2.5 & $avg < 3.5){
												?> | <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
											else if($avg >= 3.5 & $avg < 4.5){
												?> | <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"> </i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
											else if($avg >= 4.5 & $avg <= 5.0){
												?> | <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"> </i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
										?>
									</td>
								</tr>
								</tr>
									<td colspan = "2"style = "text-align: left; padding-top: 0px;" width = "15%">
										<?php echo $row['uzemanyag']." | ".$row['hengerurtartalom']." cm<sup>3</sup> | ".$row['teljesitmeny']." LE | ".$row['vegsebesseg']." km/h";?>
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
							echo '</div>';
						}
						
						//Ha nincs találat...
						else{
							echo ' 
								<div align = "center">
									<table id = "carmotortable" style = "border-radius: 0; color: white; display: inline-block; width: 69.5%; margin-left: 20%; font-size: 25px; background: #FE2E2E; padding: 0px; padding-left: 15px;">
										<tr>
											<td colspan = "2" width = "100%"background: #56AF3E;><b><i class="fa fa-search "></i> Találatok száma: '.$count_motor_results.' db</b></td>
										</tr>
										<tr>
											<td colpan = "2" style = "font-size: 18px;" width = "100%"background: #56AF3E;><b>Nem szerepel ilyen motor az adatbázisban!</b></td>
										</tr>
										<tr>
											<td style = "font-size: 15px;"  background: #56AF3E;>Megadott ár: <b>'.$minprice_motor.' Ft és '.$maxprice_motor.' Ft között</b></td>
										</tr>
										<tr>
											<td style = "font-size: 15px;"  background: #56AF3E;>Márka: <b>'.$motortype.'</b></td>
										</tr>
										<tr>
											<td style = "font-size: 15px;"  background: #56AF3E;>Kategória: <b>'.$category_motor.'</b></td>
										</tr>
										<tr>
											<td style = "font-size: 15px;"  background: #56AF3E;>Üzemanyag: <b>'.$fuel_motor.'</b></td>
										</tr>
										<tr>
											<td style = "font-size: 15px;"  background: #56AF3E;>Hengerűrtartalom (cm<sup>3</sup>): <b>'.$enginecap_motor.'</b> </td>
										</tr>
										<tr>
											<td style = "font-size: 15px;"  background: #56AF3E;>Motor színe: <b>'.$motorcolor.'</b></td>
										</tr>
									</table>
								</div>
								';
						}
					}
					
					if(isset($_GET['search_simple_button_motor'])){
						
						$search_simple = $_GET['search_simple_motor'];
						
						//Ha pontos egyezés ki van jelölve
						if(isset($_GET['test_motor'])){
							$motor_search_sql_simple = "SELECT * FROM motor WHERE motormarka_id = '".$search_simple."'
							OR uzemanyag = '".$search_simple."' OR marka_tipus = '".$search_simple."' OR hengerurtartalom = '".$search_simple."'";
						}
						
						//Ha nincs kijelölve
						else{
							$motor_search_sql_simple = "SELECT * FROM motor WHERE motormarka_id LIKE '%".$search_simple."%'
							OR uzemanyag LIKE '%".$search_simple."%' OR marka_tipus LIKE '%".$search_simple."%' OR hengerurtartalom LIKE '%".$search_simple."%'";
						}
						
						//echo $car_search_sql_simple;
						
						$list_motors_query_simple = mysqli_query($conn, $motor_search_sql_simple);
						$count_motor_results_simple = mysqli_num_rows($list_motors_query_simple);
						
						//Ha nullánál több találat van...
						if(mysqli_num_rows($list_motors_query_simple)>0){
							
							echo ' 
								<div align = "center">
									<table id = "carmotortable" style = "border-radius: 0; color: white; display: inline-block; width: 69.5%; margin-left: 20%; font-size: 25px; background: #56af3e; padding: 0px; padding-left: 15px;">
										<tr>
											<td  width = "100%"background: #56AF3E;><b><i class="fa fa-search "></i> Találatok száma: '.$count_motor_results_simple.' db</b></td>
										</tr>
									</table>
								</div>
								';
								
							?>
							<div style = "float:left; margin-left: 25%;">
							<?php

							
							while($row = mysqli_fetch_assoc($list_motors_query_simple)){

							$motorAverageSql = "SELECT AVG(ertekeles) as atlagertekeles FROM motor, 
							motorosertekelesek WHERE motor.id = motorosertekelesek.motor_id AND motor.id = '".$row['id']."';";
							$motorAvgQuery = mysqli_query($conn, $motorAverageSql);
							$rowAvg = mysqli_fetch_assoc($motorAvgQuery); 
							$avg = $rowAvg['atlagertekeles'];

							?>
						 
							<table class = "table" id = "carmotortable" style="float: left;display: inline-block; border:1px solid gray;
							width: 46%; padding: 1%; margin-bottom: 0.5%; margin-left: 0.5%; border-bottom: 1px solid #6E6E6E; background: #EAE9E9; color: black;" align = "center" cellspacing = "0" cellpadding = "0">
							<form method = "get" action = "viewmotor" enctype = "multipart/form-data" name = "search_simple">
								<tr>
									<td colspan = "2"style = "text-align: left;" width = "15%">
										<a target = "_blank" href = "<?php echo $row["fenykep"]; ?>" title = "A következő megjelenítése új lapon: <?php echo $row["motormarka_id"]." ".$row["marka_tipus"]; ?>">
											<img src = "<?php echo $row["fenykep"]; ?>" style = "width:100%; height: 260px; border-radius: 10px; " />
										</a>
									</td>
								</tr>
								</tr>
									<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
										<b><?php echo $row['motormarka_id']." ".$row['marka_tipus']."</b>, ".$row['kategoria']; ?>
									</td>
								</tr>
								</tr>
									<td colspan = "2"style = "text-align: left; padding-top: 0px;" width = "15%">
										<?php echo $row['km_ora_allasa'];?> km | <?php echo $row['allapot']; ?> | <?php echo $row['motorszin']; ?>
										<?php
											if($avg < 1.0){
												?> | <font color = "#2e9afe"> Nincs értékelés</font><?php
											}
											else if($avg >= 1.0 & $avg < 1.5){
												?> | <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
											else if($avg >= 1.5 & $avg < 2.5){
												?> | <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
											else if($avg >= 2.5 & $avg < 3.5){
												?> | <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
											else if($avg >= 3.5 & $avg < 4.5){
												?> | <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"> </i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
											else if($avg >= 4.5 & $avg <= 5.0){
												?> | <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"> </i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <i class="fa fa-star" style = "color: #2E9AFE;"></i> <?php
											}
										?>
									</td>
								</tr>
								</tr>
									<td colspan = "2"style = "text-align: left; padding-top: 0px;" width = "15%">
										<?php echo $row['uzemanyag']." | ".$row['hengerurtartalom']." cm<sup>3</sup> | ".$row['teljesitmeny']." LE | ".$row['vegsebesseg']." km/h";?>
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
							echo '</div>';
						}
						
						//Ha nincs találat...
						else{
							echo ' 
								<div align = "center">
									<table id = "carmotortable" style = "border-radius: 0; color: white; display: inline-block; width: 69.5%; margin-left: 20%; font-size: 25px; background: #FE2E2E; padding: 0px; padding-left: 15px;">
										<tr>
											<td colspan = "2" width = "100%"background: #56AF3E;><b><i class="fa fa-search "></i> Találatok száma: '.$count_motor_results_simple.' db</b></td>
										</tr>
										<tr>
											<td colpan = "2" style = "font-size: 18px;" width = "100%"background: #56AF3E;><b>Nem szerepel ilyen motor az adatbázisban!</b></td>
										</tr>
										<tr>
											<td style = "font-size: 15px;"  background: #56AF3E;>A keresett kifejezés: <b>"'.$search_simple.'" </b></td>
										</tr>
									</table>
								</div>
								';
						}
					}	
				?>
	</body>
</html>