

<?php
	
	include('../users/connection.php');
	if($login_session!="CMRentadmin"){
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
			
			
			</br></br></br>
			
			<div align = "center" style = "margin-left: 5.05%; margin-right: 5%; margin-bottom: 6px;">
			<table  width = "100%" style = "background:#EAE9E9; margin-left: -5px;  font-family: 'Raleway', serif; text-align: left;
				font-size: 15px; color: #fff; padding-left: 10px; padding-top: 5px; padding-bottom: 5px;" align = "center" cellpadding = "0" cellspacing = "0" >
				<tr>
					<td align = "left" style = "padding: 5px; color: black; font-size: 41px;
					text-shadow: 1px 1px 2px black, 0 0 25px white, 0 0 5px white;">Legújabb autók az adatbázisban</td>
				</tr>
			</table>
			</div>
			
			
			<div style = "float:left; margin-left: 4.2%;">
			
			
			<?php
			
				$cars = "SELECT * FROM auto ORDER BY evjarat LIMIT 12;";
				$getCars = mysqli_query($conn, $cars);
				
				if(mysqli_num_rows($getCars)>0){
					while($row = mysqli_fetch_assoc($getCars)){ 
					
					?>
		
							<table class = "table" id = "carmotortable" style="float: left;display: inline-block; border:1px solid gray;
							width: 31%; padding: 1%; margin-bottom: 0.5%; margin-left: 0.5%; background: #EAE9E9; color: black;" align = "center" cellspacing = "0" cellpadding = "0">
							<form method = "get" action = "carmodifyChosen.php" enctype = "multipart/form-data" >
								<tr>
									<td colspan = "2"style = "text-align: left;" width = "15%">
										<a target = "_blank" href = "<?php echo $row["fenykep"]; ?>" title = "A következő megjelenítése új lapon: <?php echo $row["automarka_id"]." ".$row["marka_tipus"]; ?>">
											<img src = "<?php echo $row["fenykep"]; ?>" style = "width:100%; height: 220px; border-radius: 10px; border: 1px solid #1C1C1C; margin-top: -0px" />
										</a>
									</td>
								</tr>
								<tr>
									<td colspan = "2"style = "text-align: left; padding-top: 10px;" width = "15%">
										<b><?php echo $row['automarka_id']." ".$row['marka_tipus']."</b>, ".$row['kategoria']; ?>
									</td>
								</tr>
								<tr>
									<td colspan = "2"style = "text-align: left; padding-top: 0px;" width = "15%">
										<?php echo $row['km_ora_allasa'];?> km | <?php echo $row['allapot']; ?> | <?php echo $row['autoszin']; ?>  
									</td>
								</tr>
								<tr>
									<td colspan = "2"style = "text-align: left; padding-top: 0px;" width = "15%">
										<?php echo $row['uzemanyag']." | ".$row['hengerurtartalom']." cm<sup>3</sup> | ".$row['teljesitmeny']." LE | ".$row['vegsebesseg']." km/h";?>
									</td>
								</tr>
								<tr>
									<td colspan = "2"style = "text-align: left; padding-top: 10px; padding-bottom: 10px;" width = "15%">
										<input type = "submit" class = "delete_edit2" name = "<?php echo $row['id']; ?>" value = "Autó adatlapja" style = "width: 95%;" />
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
					text-shadow: 1px 1px 2px black, 0 0 25px white, 0 0 5px white;">Legújabb motorok az adatbázisban</td>
				</tr>
			</table>
			</div>
			
			
			
			<div style = "float:left; margin-left: 4.2%;">
			
			
			<?php

				$motors = "SELECT * FROM motor ORDER BY evjarat LIMIT 3;";
				$getMotors = mysqli_query($conn, $motors);
					 
				if(mysqli_num_rows($getMotors)>0){
					 while($row = mysqli_fetch_assoc($getMotors)){

					 ?>
		
							<table id = "carmotortable" style="float: left;display: inline-block; border:1px solid gray;
							width: 31%; padding: 1%; margin-bottom: 35px; margin-left: 0.5%; border-bottom: 1px solid #6E6E6E; background: #EAE9E9; color: black;" align = "center" cellspacing = "0" cellpadding = "0">
							<form method = "get" action = "motormodifyChosen.php" enctype = "multipart/form-data" name = "search_simple">
								<tr>
									<td colspan = "2"style = "text-align: left;" width = "15%">
										<a target = "_blank" href = "<?php echo $row["fenykep"]; ?>" title = "A következő megjelenítése új lapon: <?php echo $row["motormarka_id"]." ".$row["marka_tipus"]; ?>">
											<img src = "<?php echo $row["fenykep"]; ?>" style = "width:100%; height: 220px; border-radius: 10px; margin-top: 0px; border:1px solid #1C1C1C;" />
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
									</td>
								</tr>
								</tr>
									<td colspan = "2"style = "text-align: left; padding-top: 0px;" width = "15%">
										<?php echo $row['uzemanyag']." | ".$row['hengerurtartalom']." cm<sup>3</sup> | ".$row['teljesitmeny']." LE | ".$row['vegsebesseg']." km/h";?>
									</td>
								</tr>
								</tr>
									<td colspan = "2"style = "text-align: left; padding-top: 10px; padding-bottom: 10px;" width = "15%">
										<input type = "submit" class = "delete_edit2" name = "<?php echo $row['id']; ?>" value = "Motor adatlapja" style = "width: 95%;" />
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