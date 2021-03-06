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
		<div id="bgStyle"></div>
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
			
			<!-- Keresés táblázat-->
			</br></br>
			
			<?php
				$getCategs = "SELECT * FROM auto GROUP BY kategoria;";
				$getPrices = "SELECT * FROM auto GROUP BY ar_1;";
				$getCars = "SELECT * FROM auto GROUP BY automarka_id;";
				//$getCarTypes = "SELECT * FROM auto GROUP BY marka_tipus;";
				$getFuels = "SELECT * FROM auto GROUP BY uzemanyag;";
				$getEngineCapacity = "SELECT * FROM auto GROUP BY hengerurtartalom;";
				$getColor = "SELECT * FROM auto GROUP BY autoszin;";
				
				$getResultof_categs = mysqli_query($conn, $getCategs);
				$getResultof_prices = mysqli_query($conn, $getPrices);
				$getResultof_cars = mysqli_query($conn, $getCars);
				//$getResultof_cartypes = mysqli_query($conn, $getCarTypes);
				$getResultof_fuels = mysqli_query($conn, $getFuels);
				$getResultof_enginecap = mysqli_query($conn, $getEngineCapacity);
				$getResultof_color = mysqli_query($conn, $getColor);	
			?>
			
			<form method = "get" action = "usercarsearch.php" enctype = "multipart/form-data" name = "search_simple">
				<table id = "carmotortable" style="height: 100%; position: fixed;display: inline-block; width: 20%; margin-left: 5%; border-right: 1px solid #6E6E6E; background: #EAE9E9; color: black;" align = "center" cellspacing = "0" cellpadding = "0">
					<tr>
						<td colspan = "2"></br></td>
					</tr>
					<tr>
						<td colspan = "2" style = "text-align: left;padding-bottom: 10px;" width = "15%"><b>Egyszerű keresés</b></td>
					</tr>
						<td colspan = "2"style = "text-align: left;" width = "15%">
							<input type = "text" name = "search_simple" value = "Mercedes" style = "width: 95%;" placeholder = "Márka, üzemanyag, hengerűrtartalom..."/>
						</td>
					</tr>
					</tr>
						<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
							Pontos egyezés <input type="checkbox" name="test_car" value="value1">
						</td>
					</tr>
					</tr>
						<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
							<input type = "submit" class = "delete_edit" name = "search_simple_button" value = "Keresés" style = "width: 95%;" />
						</td>
					</tr>
				</form>
				<form method = "get" action = "usercarsearch.php" enctype = "multipart/form-data" name = "search_extended">
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
							<input type = "number" name = "minprice" value = "0" style = "width: 90%;" placeholder = "Minimum ár (Ft)"/> -
						</td>
						<td style = "text-align: left; padding-top: 0px;" width = "15%">
							<input type = "number" name = "maxprice" value = "1000000" style = "width: 90%;" placeholder = "Maximum ár (Ft)" />
						</td>
					</tr>
					</tr>
						<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
							Kategória
						</td>
					</tr>
						<td colspan = "2" style = "text-align: left; padding-top: 0px;" width = "15%">
							<select style = "width: 95%;" name = "select_categ">
								<option value = ""></option>
								<?php while($rows = mysqli_fetch_array($getResultof_categs)){ ?>
								<option>
									<?php echo htmlspecialchars($rows["kategoria"]); } ?>
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
							<select style = "width: 95%;" name = "select_cartype">
								<option value = ""></option>
								<?php while($rows = mysqli_fetch_array($getResultof_cars)){ ?>
								<option>
									<?php echo htmlspecialchars($rows["automarka_id"]); } ?>
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
							<select style = "width: 95%;" name = "select_fuel">
								<option value = ""></option>
								<?php while($rows = mysqli_fetch_array($getResultof_fuels)){ ?>
								<option>
									<?php echo htmlspecialchars($rows["uzemanyag"]); } ?>
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
							<select style = "width: 95%;" name = "select_enginecap">
								<option value = ""></option>
								<?php while($rows = mysqli_fetch_array($getResultof_enginecap)){ ?>
								<option>
									<?php echo htmlspecialchars($rows["hengerurtartalom"]); } ?>
								</option>
							</select>
						</td>
					</tr>
					</tr>
						<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
							Autó színe
						</td>
					</tr>
						<td colspan = "2" style = "text-align: left; padding-top: 0px;" width = "15%">
							<select style = "width: 95%;" name = "select_carcolor">
								<option value = ""></option>
								<?php while($rows = mysqli_fetch_array($getResultof_color)){ ?>
								<option>
									<?php echo htmlspecialchars($rows["autoszin"]); } ?>
								</option>
							</select>
						</td>
					</tr>
					</tr>
						<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
							<input type = "submit" class = "delete_edit" name = "search_extended_button" value = "Részletes keresés" style = "width: 95%;" />
						</td>
					</tr>
				</table>
				</form>
				
				
				<!-- keresés (php) -->
				
				</br>
				
				<?php
					if(isset($_GET['search_extended_button'])){
						
						$minprice = trim($_GET['minprice'], '\n\t');
						$minprice = mysqli_real_escape_string($conn, $_GET['minprice']);
						$minprice = addslashes(strip_tags($minprice));
						
						$maxprice = trim($_GET['maxprice'], '\n\t');
						$maxprice = mysqli_real_escape_string($conn, $_GET['maxprice']);
						$maxprice = addslashes(strip_tags($maxprice));
						
						$category = trim($_GET['select_categ'], '\n\t');
						$category = mysqli_real_escape_string($conn, $_GET['select_categ']);
						$category = addslashes(strip_tags($category));
						
						$cartype = trim($_GET['select_cartype'], '\n\t');
						$cartype = mysqli_real_escape_string($conn, $_GET['select_cartype']);
						$cartype = addslashes(strip_tags($cartype));
						
						$fuel = trim($_GET['select_fuel'], '\n\t');
						$fuel = mysqli_real_escape_string($conn, $_GET['select_fuel']);
						$fuel = addslashes(strip_tags($fuel));
						
						$enginecap = trim($_GET['select_enginecap'], '\n\t');
						$enginecap = mysqli_real_escape_string($conn, $_GET['select_enginecap']);
						$enginecap = addslashes(strip_tags($enginecap));
						
						$carcolor = trim($_GET['select_carcolor'], '\n\t');
						$carcolor = mysqli_real_escape_string($conn, $_GET['select_carcolor']);
						$carcolor = addslashes(strip_tags($carcolor));
						
						$List_cars_sql = "SELECT * FROM auto WHERE kategoria LIKE '%".$category."%' AND (ar_1 BETWEEN '".$minprice."' AND '".$maxprice."')
						AND automarka_id LIKE '%".$cartype."%' AND uzemanyag LIKE '%".$fuel."%' AND hengerurtartalom LIKE '%".$enginecap."%' 
						AND autoszin LIKE '%".$carcolor."%';";
						
						$list_cars_query = mysqli_query($conn, $List_cars_sql);
						$count_car_results = mysqli_num_rows($list_cars_query);
						
						//Ha nullánál több találat van...
						if(mysqli_num_rows($list_cars_query)>0){
							
							echo ' 
								<div align = "center">
									<table id = "carmotortable" style = "border-radius: 0; color: white; display: inline-block; width: 69.5%; margin-left: 20%; font-size: 25px; background: #56af3e; padding: 0px; padding-left: 15px;">
										<tr>
											<td  width = "100%"background: #56AF3E;><b><i class="fa fa-search "></i> Találatok száma: '.$count_car_results.' db</b></td>
										</tr>
									</table>
								</div>
								';
							?>
							<div style = "float:left; margin-left: 25%;">
							<?php
							
							while($row = mysqli_fetch_assoc($list_cars_query)){ 
							
							$carAverageSql = "SELECT AVG(ertekeles) as atlagertekeles FROM auto, 
							autosertekelesek WHERE auto.id = autosertekelesek.auto_id AND auto.id = '".$row['id']."';";
							$carAvgQuery = mysqli_query($conn, $carAverageSql);
							$rowAvg = mysqli_fetch_assoc($carAvgQuery); 
							$avg = $rowAvg['atlagertekeles'];

							?>
							
							<form method = "get" action = "viewcar.php" enctype = "multipart/form-data" name = "search_simple">
							<table class = "table" id = "carmotortable" style="float: left;display: inline-block; border:1px solid gray;
							width: 46%; padding: 1%; margin-bottom: 0.5%; margin-left: 0.5%; border-bottom: 1px solid #6E6E6E; background: #EAE9E9; color: black;" align = "center" cellspacing = "0" cellpadding = "0">
								<tr>
									<td colspan = "2"style = "text-align: left;" width = "15%">
										<a target = "_blank" href = "<?php echo $row["fenykep"]; ?>" title = "A következő megjelenítése új lapon: <?php echo htmlspecialchars($row["automarka_id"])." ".htmlspecialchars($row["marka_tipus"]); ?>">
											<img src = "<?php echo $row["fenykep"]; ?>" style = "width:100%; height: 260px; border-radius: 10px; " />
										</a>
									</td>
								</tr>
								</tr>
									<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
										<b><?php echo htmlspecialchars($row['automarka_id'])." ".htmlspecialchars($row['marka_tipus'])."</b>, ".htmlspecialchars($row['kategoria']); ?>
									</td>
								</tr>
								</tr>
									<td colspan = "2"style = "text-align: left; padding-top: 0px;" width = "15%">
										<?php echo htmlspecialchars($row['km_ora_allasa']);?> km | <?php echo htmlspecialchars($row['allapot']); ?> | <?php echo htmlspecialchars($row['autoszin']); ?>
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
										<input type = "submit" class = "delete_edit2" name = "<?php echo $row['auto_id2']; ?>" value = "Autó adatlapja" style = "width: 95%;" />
									</td>
								</tr>
								<tr>
									<td style = "border-top: 1px solid black;"></br></td>
								</tr>
								</table>
							</form>
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
											<td colspan = "2" width = "100%"background: #56AF3E;><b><i class="fa fa-search "></i> Találatok száma: '.$count_car_results.' db</b></td>
										</tr>
										<tr>
											<td colpan = "2" style = "font-size: 18px;" width = "100%"background: #56AF3E;><b>Nem szerepel ilyen autó az adatbázisban!</b></td>
										</tr>
										<tr>
											<td style = "font-size: 15px;"  background: #56AF3E;>Megadott ár: <b>'.$minprice.' Ft és '.$maxprice.' Ft között</b></td>
										</tr>
										<tr>
											<td style = "font-size: 15px;"  background: #56AF3E;>Márka: <b>'.$cartype.'</b></td>
										</tr>
										<tr>
											<td style = "font-size: 15px;"  background: #56AF3E;>Kategória: <b>'.$category.'</b></td>
										</tr>
										<tr>
											<td style = "font-size: 15px;"  background: #56AF3E;>Üzemanyag: <b>'.$fuel.'</b></td>
										</tr>
										<tr>
											<td style = "font-size: 15px;"  background: #56AF3E;>Hengerűrtartalom (cm<sup>3</sup>): <b>'.$enginecap.'</b> </td>
										</tr>
										<tr>
											<td style = "font-size: 15px;"  background: #56AF3E;>Autó színe: <b>'.$carcolor.'</b></td>
										</tr>
									</table>
								</div>
								';
						}
					}
					
					if(isset($_GET['search_simple_button'])){
						
						$search_simple = trim($_GET['search_simple'], '\n\t');
						$search_simple = mysqli_real_escape_string($conn, $_GET['search_simple']);
						$search_simple = htmlspecialchars($search_simple, ENT_QUOTES);
						
						//$search_simple = $_GET['search_simple'];
						
						//Ha pontos egyezés ki van jelölve
						if(isset($_GET['test_car'])){
							$car_search_sql_simple = "SELECT * FROM auto WHERE automarka_id = '".$search_simple."'
							OR uzemanyag = '".$search_simple."' OR marka_tipus = '".$search_simple."' OR hengerurtartalom = '".$search_simple."'";
						}
						
						//Ha nincs kijelölve
						else{
							$car_search_sql_simple = "SELECT * FROM auto WHERE automarka_id LIKE '%".$search_simple."%'
							OR uzemanyag LIKE '%".$search_simple."%' OR marka_tipus LIKE '%".$search_simple."%' OR hengerurtartalom LIKE '%".$search_simple."%'";
						}
						
						//echo $car_search_sql_simple;
						
						$list_cars_query_simple = mysqli_query($conn, $car_search_sql_simple);
						$count_car_results_simple = mysqli_num_rows($list_cars_query_simple);
						
						//Ha nullánál több találat van...
						if(mysqli_num_rows($list_cars_query_simple)>0){
							
							echo ' 
								<div align = "center">
									<table id = "carmotortable" style = "border-radius: 0; color: white; display: inline-block; width: 69.5%; margin-left: 20%; font-size: 25px; background: #56af3e; padding: 0px; padding-left: 15px;">
										<tr>
											<td  width = "100%"background: #56AF3E;><b><i class="fa fa-search "></i> Találatok száma: '.$count_car_results_simple.' db</b></td>
										</tr>
									</table>
								</div>
								';
							?>
							<div style = "float:left; margin-left: 25%;">
							<?php
							
							while($row = mysqli_fetch_assoc($list_cars_query_simple)){
							
							$carAverageSql = "SELECT AVG(ertekeles) as atlagertekeles FROM auto, 
							autosertekelesek WHERE auto.id = autosertekelesek.auto_id AND auto.id = '".$row['id']."';";
							$carAvgQuery = mysqli_query($conn, $carAverageSql);
							$rowAvg = mysqli_fetch_assoc($carAvgQuery); 
							$avg = $rowAvg['atlagertekeles'];

							?>
							
						 
							<table class = "table" id = "carmotortable" style="float: left;display: inline-block; border:1px solid gray;
							width: 46%; padding: 1%; margin-bottom: 0.5%; margin-left: 0.5%; border-bottom: 1px solid #6E6E6E; background: #EAE9E9; color: black;" align = "center" cellspacing = "0" cellpadding = "0">
							<form method = "get" action = "viewcar.php" enctype = "multipart/form-data" name = "search_simple">
								<tr>
									<td colspan = "2"style = "text-align: left;" width = "15%">
										<a target = "_blank" href = "<?php echo htmlspecialchars($row["fenykep"]); ?>" title = "A következő megjelenítése új lapon: <?php echo htmlspecialchars($row["automarka_id"])." ".htmlspecialchars($row["marka_tipus"]); ?>">
											<img src = "<?php echo $row["fenykep"]; ?>" style = "width:100%; height: 260px; border-radius: 10px; " />
										</a>
									</td>
								</tr>
								</tr>
									<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
										<b><?php echo htmlspecialchars($row['automarka_id'])." ".htmlspecialchars($row['marka_tipus'])."</b>, ".htmlspecialchars($row['kategoria']); ?>
									</td>
								</tr>
								</tr>
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
								</tr>
									<td colspan = "2"style = "text-align: left; padding-top: 0px;" width = "15%">
										<?php echo htmlspecialchars($row['uzemanyag'])." | ".htmlspecialchars($row['hengerurtartalom'])." cm<sup>3</sup> | ".htmlspecialchars($row['teljesitmeny'])." LE | ".htmlspecialchars($row['vegsebesseg'])." km/h";?>
									</td>
								</tr>
								</tr>
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
							echo '</div>';
						}
						
						//Ha nincs találat...
						else{
							echo ' 
								<div align = "center">
									<table id = "carmotortable" style = "border-radius: 0; color: white; display: inline-block; width: 69.5%; margin-left: 20%; font-size: 25px; background: #FE2E2E; padding: 0px; padding-left: 15px;">
										<tr>
											<td colspan = "2" width = "100%"background: #56AF3E;><b><i class="fa fa-search "></i> Találatok száma: '.$count_car_results_simple.' db</b></td>
										</tr>
										<tr>
											<td colpan = "2" style = "font-size: 18px;" width = "100%"background: #56AF3E;><b>Nem szerepel ilyen autó az adatbázisban!</b></td>
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