

<?php 
	
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
		
		$car_sql = "SELECT * FROM `auto` ORDER BY evjarat DESC";
		$cars = mysqli_query($conn, $car_sql);
				
		$rowindex = 1;
		if (mysqli_num_rows($cars) > 0){
			while($row = mysqli_fetch_assoc($cars)){
				if(isset($_GET[$row["id"]])){
					
		
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
						  
						  <form method = "POST" action = "../users/logout.php" enctype = "multipart/form-data" name = "logout">
							<input type = "submit" class = "input" name = "logout" value = "Kijelentkezés" style = "align: right;"/> <!--<i class="fas fa-sign-out-alt"></i> -->
						  </form>
						  
						 
						</div>
						</div>
						
						</br></br></br>
						
						<table cellspacing = "0" cellpadding = "0"  align = "center" width = "64%" > 
							<tr>
								<td>
								<div class="tab" id = "admintable" style = "border-radius: 0; -webkit-border-radius: 0;-moz-border-radius: 0; margin-bottom: -6px;">
									<button class="tablinks" style = "width: 33%; border-radius: 100;" onclick="openTabs(event, 'adatok1')" id="defaultOpen"><font size = "4">Autó adatai (1) <i class="fa fa-car" aria-hidden="true"></i></font></button>
									<button class="tablinks" style = "width: 33%; border-radius: 100;" onclick="openTabs(event, 'adatok2')"><font size = "4">Autó adatai (2) <i class="fa fa-car" aria-hidden="true"></i></font></button>
									<button class="tablinks" style = "width: 33%; border-radius: 100;" onclick="openTabs(event, 'auto_hozzadasa')"><font size = "4">Véglegesítés <i class="fa fa-edit" aria-hidden="true"></i></font></button>
								</div>
								</td>
							</tr>
						</table>
						
						
						<div id="adatok1" class="tabcontent">
						<div align = "center" width = "55%">
						<form method = "GET" action = "carmodify_action.php" enctype = "multipart/form-data" name = "car_upload">
							<table cellspacing = "0" cellpadding = "0" id = "admintable" align = "center" width = "65%"
							style = "border-radius: 0 0 12 12;
							-webkit-border-radius: 0 0 12 12;
							-moz-border-radius: 0 0 12 12;">
								<tr>
									<td colspan = "2"height = "40px" align = "left" bgcolor = "#56AF3E" style = "padding-left: 35px; font-size: 25px;"><b>Személygépkocsi módosítása az adatbázisban <i class="fa fa-edit "></i></font>
									</td>
								</tr>
								<tr>
									<td style = "padding: 5px;" colspan = "2">
										<div style="text-align: center; height: 1px; background-color: #E6E6E6; width:100%;"></div>
									</td>
								</tr>
								
								<!-- adatok megadása (1) -->
								
								<tr>
									<td width = "50%"height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Kategória</br>
									<input type = "text" name = "kategoria" id = "input" placeholder = "pl.: SUV" value = "<?php echo htmlspecialchars($row['kategoria']); ?>" required></td>
									<td rowspan = "6" style = "padding-left: 0px;">
										<img src = "<?php echo $row['fenykep']; ?>" style = "width:100%; height: 300px; border-radius: 10px;" />
									</td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Személygépkocsi márkája</br>
									<select class = "select" style = "background: rgb(96,96,96); width: 70%;" name = "automarka_id" >
										<option><?php echo $row["automarka_id"]; ?></option>
									  <?php
										 
										  $select_carbrand = "SELECT * FROM automarka;";
										  $select_carbrand_query = mysqli_query($conn, $select_carbrand);
										 
										  if(mysqli_num_rows($select_carbrand_query)){
											  while($carid = mysqli_fetch_array($select_carbrand_query)){ 
											  ?>
											  
											  <option value = "<?php echo $carid["id"]; ?>">
												<?php 
													echo $carid["id"]; }}
												?>
										  </option>
									  </select>
									</td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Márka típusa</br>
									<input type = "text" name = "marka_tipus" id = "input" placeholder = "pl.: CLA 220" value = "<?php echo htmlspecialchars($row['marka_tipus']); ?>" required></td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Ár (1-6 napig)</br>
									<input type = "number" name = "ar_1" id = "input" value = "<?php echo htmlspecialchars($row['ar_1']); ?>" required></td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Ár (7-30 napig)</br>
									<input type = "number" name = "ar_2" id = "input" value = "<?php echo htmlspecialchars($row['ar_2']); ?>"required></td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Ár (31-365 napig)</br>
									<input type = "number" name = "ar_3" id = "input" value = "<?php echo htmlspecialchars($row['ar_3']); ?>" required>
									</td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Évjárat</br>
									<input type = "number" name = "evjarat" id = "input" value = "<?php echo htmlspecialchars($row['evjarat']); ?>" required></td>
								</tr>
							</table>
							</div>
						</div>
						
						
						<div id="adatok2" class="tabcontent">
						<div align = "center" width = "55%">
							<table cellspacing = "0" cellpadding = "0" id = "admintable" align = "center" width = "65%"
							style = "border-radius: 0 0 12 12;
							-webkit-border-radius: 0 0 12 12;
							-moz-border-radius: 0 0 12 12;">
						
								
								<!-- adatok megadása (2) -->
									
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Személygépkocsi állapota</br>
									<input type = "text" name = "allapot" id = "input" value = "<?php echo htmlspecialchars($row['allapot']); ?>" required></td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Km/h állása</br>
									<input type = "number" name = "km_ora_allasa" id = "input" value = "<?php echo htmlspecialchars($row['km_ora_allasa']); ?>" required></td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Szállítható személyek száma</br>
									<input type = "number" name = "szallithato_szemelyek" id = "input" value = "<?php echo htmlspecialchars($row['szallithato_szemelyek']); ?>" required></td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Üzemanyag fajtája</br>
									<input type = "text" name = "uzemanyag" id = "input" value = "<?php echo htmlspecialchars($row['uzemanyag']); ?>" required></td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Hengerűrtartalom</br>
									<input type = "number" name = "hengerurtartalom" id = "input" value = "<?php echo htmlspecialchars($row['hengerurtartalom']); ?>" required></td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Teljesítmény</br>
									<input type = "number" name = "teljesitmeny" id = "input" value = "<?php echo htmlspecialchars($row['teljesitmeny']); ?>" required></td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Személygépkocsi színe</br>
									<input type = "text" name = "autoszin" id = "input" value = "<?php echo htmlspecialchars($row['autoszin']); ?>" required></td>
								</tr>
							</table>
						</div>
						</div>
						
						
						
						
						<div id="auto_hozzadasa" class="tabcontent">
						<div align = "center" width = "55%">
							<table cellspacing = "0" cellpadding = "0" id = "admintable" align = "center" width = "65%"
							style = "border-radius: 0 0 12 12;
							-webkit-border-radius: 0 0 12 12;
							-moz-border-radius: 0 0 12 12;">
								
								
								<!-- módosítás -->
								
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Saját tömeg</br>
									<input type = "number" name = "sajattomeg" id = "input" value = "<?php echo htmlspecialchars($row['sajat_tomeg']); ?>" required></td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Maximális tömeg</br>
									<input type = "number" name = "maxtomeg" id = "input" value = "<?php echo htmlspecialchars($row['maximalis_tomeg']); ?>" required></td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Üzemanyagtank mérete</br>
									<input type = "number" name = "tankmeret" id = "input" value = "<?php echo htmlspecialchars($row['tank_meret']); ?>" required></td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Átlagfogyasztás</br>
									<input type = "number" name = "atlagfogyasztas" step="0.01" id = "input" value = "<?php echo htmlspecialchars($row['atlagfogyasztas']); ?>" required></td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Végsebesség</br>
									<input type = "number" name = "vegsebesseg" id = "input" value = "<?php echo htmlspecialchars($row['vegsebesseg']); ?>" required></td>
								</tr>
								<tr>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Gyorsulás</br>
									<input type = "number" name = "gyorsulas" step="0.01" id = "input" value = "<?php echo htmlspecialchars($row['gyorsulas']); ?>" required></td>
								</tr>
								<tr>
									<td height = "25px"  align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px; ">Oktánszám</br>
									<input type = "number" name = "oktanszam" id = "input" value = "<?php echo htmlspecialchars($row['oktanszam']); ?>" required></td>
								</tr>
								<tr>
									<td style="padding: 0px 38px 0px 30px;" colspan = "2">
									<?php
										echo '
										<input type = "submit" class = "input" name = "'.$row["id"].'" style = "width: 40%;" value = "Módosítás véglegesítése" />
										';
									?>
									</td>
								</tr>
								</div>
							</table>
						</form>
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