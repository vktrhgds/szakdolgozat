
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
	
		
	
		<style>
			tr:hover {
				background-color: #4A4A4A;
			}
			
		</style>
		
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
			
			<!-- motorok száma -->
			
			<?php
				$motors = "SELECT * FROM motor ORDER BY kategoria DESC";
				$getMotors = mysqli_query($conn, $motors);
				
				$allmotors = "SELECT * FROM motor";
				$motorResult = mysqli_query($conn, $allmotors);
				$count_motor = mysqli_num_rows($motorResult);
			?>
			
			<!-- ############## -->
			
			</br></br></br></br>
			
			<div align = "center" width = "85%">
				<table cellspacing = "0" cellpadding = "0" id = "admintable" align = "center" width = "85%"
				style = "border-radius: 0 0 12 12;
				-webkit-border-radius: 0 0 12 12;
				-moz-border-radius: 0 0 12 12;">
					<tr>
						<td height = "40px" align = "left" bgcolor = "#56AF3E" style = "padding-left: 10px; font-size: 25px; border-radius:10 0 0 10;
						-webkit-border-radius: 10 0 0 10;	-moz-border-radius: 10 0 0 10;" colspan = "10">
						<b>Motor adatainak a módosítása <i class="fa fa-edit "></i></font>
						</td><td bgcolor = "#56AF3E" style = "padding-left: 10px; font-size: 25px; border-radius:0 10 10 0;
						-webkit-border-radius: 0 10 10 0;	-moz-border-radius: 0 10 10 0; border-left: 1px solid white;""><?php echo $count_motor; ?> db</td>
					</tr>
					<tr>
						<td style = "padding: 5px;" colspan = "11">
							<div style="text-align: center; height: 1px; background-color: #E6E6E6; width:100%;"></div>
						</td>
					</tr>
					
					<!--autók kiiratása -->
			
					<?php
						$motors = "SELECT * FROM motor ORDER BY kategoria DESC";
						$getMotors = mysqli_query($conn, $motors);
						
						$allmotors = "SELECT * from auto";
						$motorResult = mysqli_query($conn, $allmotors);
						$count_motor = mysqli_num_rows($motorResult);
						
						/* motorok kiíratása */
						
						if (mysqli_num_rows($getMotors) > 0){
							
							echo '
								<tr bgcolor = "#6E6E6E" >
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 5px; font-size: 19px;"><b>Kategória</b></td>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 5px; font-size: 19px;"><b>Márka</b></td>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 5px; font-size: 19px;"><b>Márka típusa</b></td>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 5px; font-size: 19px;"><b>Évjárat</b></td>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 5px; font-size: 19px;"><b>Állapot</b></td>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 5px; font-size: 19px;"><b>Km/h állása</b></td>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 5px; font-size: 19px;"><b>Munkaütem</b></td>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 5px; font-size: 19px;"><b>Üzemanyag</b></td>
									<td height = "25px" align = "left" style =" padding: 5px 0px 0px 5px; font-size: 19px;"><b>Teljesítmény</b></td>
								</tr>';
							
							while($row = mysqli_fetch_assoc($getMotors)){
								echo '
									<tr height = "30px">
										<td height = "20px" align = "left" style =" padding: 5px 0px 0px 5px; font-size: 15px;">'.$row["kategoria"].'</td>
										<td height = "20px" align = "left" style =" padding: 5px 0px 0px 5px; font-size: 15px;">'.$row["motormarka_id"].'</td>
										<td height = "20px" align = "left" style =" padding: 5px 0px 0px 5px; font-size: 15px;">'.$row["marka_tipus"].'</td>
										<td height = "20px" align = "left" style =" padding: 5px 0px 0px 5px; font-size: 15px;">'.$row["evjarat"].'</td>
										<td height = "20px" align = "left" style =" padding: 5px 0px 0px 5px; font-size: 15px;">'.$row["allapot"].'</td>
										<td height = "20px" align = "left" style =" padding: 5px 0px 0px 5px; font-size: 15px;">'.$row["km_ora_allasa"].' km</td>
										<td height = "20px" align = "left" style =" padding: 5px 0px 0px 5px; font-size: 15px;">'.$row["munkautem"].'</td>
										<td height = "20px" align = "left" style =" padding: 5px 0px 0px 5px; font-size: 15px;">'.$row["uzemanyag"].'</td>
										<td colspan = "2" height = "20px" align = "left" style =" padding: 5px 0px 0px 5px; font-size: 15px;">'.$row["teljesitmeny"].' LE</td>
									';
									?>
									
										<td>
											<form method = "get" action = "motormodifyChosen.php" enctype = "multipart/form-data" name = "editmotor">
												<?php echo '<input type = "submit"  class = "delete_edit" value = "Módosítás" style = "width: 100px; padding: 0; "name = "'.$row["id"].'" >
											</form>
										</td>';?>
											
									<?php
									echo'
									</tr>
								';
							}
						}
						else{
							echo'
							<tr height = "30px" bgcolor = "#FE2E2E" >
								<td colspan = "11" height = "20px" align = "left" style =" padding: 5px 0px 0px 5px; font-size: 22px;">
								<i class="fa fa-times"></i> Nem szerepel motor az adatbázisban!</td>
							</tr>';
						}
					?>
				</table>
			</div>
	</body>
</html>