<?php
	include('../users/timeout.php');
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
			  <a align = "right" title = "Automatikus kijelentkezés <?php echo $timeleft; ?> mp múlva."
			  href= "" style = "padding: 0;margin-top: 1.2%; margin-left: 41%;font-size: 22px; text-align: right;"><?php echo $timeleft; ?> mp</a>
			  <form method = "POST" action = "../users/logout.php" enctype = "multipart/form-data" name = "logout">
				<input type = "submit" class = "input" name = "logout" value = "Kijelentkezés" style = "align: right;"/> <!--<i class="fas fa-sign-out-alt"></i> -->
			  </form>
			  
			  
			</div>
			
			
			</br></br></br></br>
			
			
			<?php 
				$AllCarRatings = "SELECT * FROM auto, autosertekelesek, felhasznalo WHERE 
				autosertekelesek.auto_id = auto.id AND felhasznalo.felhasznalo_nev
				= autosertekelesek.felhasznalo_nev ORDER BY ertekeles DESC;";
				$AllCarRatingsQuery = mysqli_query($conn, $AllCarRatings);
				$countAllCarRatings = mysqli_num_rows($AllCarRatingsQuery);
				
				if($countAllCarRatings > 0){
				?>

				
					<div align = "center" width = "76.5%" style = "z-index: -1;" >
						<table cellspacing = "0" cellpadding = "0" id = "admintable" align = "center" width = "81.5%"
								style = "border-radius: 0 0 12px 12px;
								-webkit-border-radius: 0 0 12px 12px;
								-moz-border-radius: 0 0 12px 12px;
								z-index: 0;">
									<tr>
										<td colspan = "2" style = "padding-bottom: 35px; padding-left: 10px; font-size: 35px;" >Autós értékelések (<?php echo $countAllCarRatings; ?>)</td> <!-- ide a darabszám -->
									</tr>
									
									<?php while($rowCR = mysqli_fetch_assoc($AllCarRatingsQuery)){
									?>
									
									<tr>
										<td style = "font-size: 20px; padding: 10px; width: 90%;"><font color = "yellow"><b><?php echo htmlspecialchars($rowCR['felhasznalo_nev']); ?></b></font>  értékelése:
										<font color = "yellow">
										<?php 
												if(htmlspecialchars($rowCR['ertekeles']) == 1){
													?> <i class="fa fa-star" style = "color: #FF0000;"></i> <?php
												}
												else if(htmlspecialchars($rowCR['ertekeles']) == 2){
													?> <i class="fa fa-star" style = "color: #FF4000;"></i> <i class="fa fa-star" style = "color: #FF4000;"></i> <?php
												}
												else if(htmlspecialchars($rowCR['ertekeles']) == 3){
													?> <i class="fa fa-star" style = "color: #FF8000;"></i> <i class="fa fa-star" style = "color: #FF8000;"></i> <i class="fa fa-star" style = "color: #FF8000;"></i> <?php
												}
												else if(htmlspecialchars($rowCR['ertekeles']) == 4){
													?> <i class="fa fa-star" style = "color: #FFBF00;"></i> <i class="fa fa-star" style = "color: #FFBF00;"></i> <i class="fa fa-star" style = "color: #FFBF00;"> </i> <i class="fa fa-star" style = "color: #FFBF00;"></i> <?php
												}
												else if(htmlspecialchars($rowCR['ertekeles']) == 5){
													?> <i class="fa fa-star" style = "color: yellow;"></i> <i class="fa fa-star" style = "color: yellow;"></i> <i class="fa fa-star" style = "color: yellow;"> </i> <i class="fa fa-star" style = "color: yellow;"></i> <i class="fa fa-star" style = "color: yellow;"></i> <?php
												}
										?>
										</font><font color = "white"><?php echo htmlspecialchars($rowCR['datum']); ?> dátummal </font> 
										<font color = "yellow">(<?php echo htmlspecialchars($rowCR['automarka_id'])." ".htmlspecialchars($rowCR['marka_tipus']); ?>)</font>
										</td>
										<td style = "width: 10%;">
											<form method = "post" action = "carratings_delete">
												<?php echo "<input type = 'submit' class = 'delete_edit2' style = 'width: 100%; ' value = 'Törlés' name = ".$rowCR['id'].">"?>
											</form>
										</td>
										</tr>
									<tr>
										<td  style = "font-size: 15px; padding: 10px;"> <!-- ide a komment maga -->
											<?php echo htmlspecialchars($rowCR['hozzaszolas']); ?>
										</td>
									</tr>
									<tr>
										<td colspan = "2" ><div style="text-align: center;height: 1px; background-color: #E6E6E6; width:100%;"></div></td>
									</tr>
									<?php } ?>
							</table>
					</div>
					<?php }
					else{
						echo' 
						<div align = "center">
							<table id = "carmotortable" style = "margin-left: 0%; border-radius: 0; color: white; display: inline-block; width: 81%; padding: 20px; font-size: 25px; background: #FE2E2E; padding: 0px; padding-left: 15px;">
									<tr>
										<td colpan = "2" style = "font-size: 18px;" width = "100%"background: #56AF3E;><b>Nincsenek még autós értékelések</b></td>
									</tr>
								</table>
							</div>
						';
					}
				?>
				
				</br></br>
			
	</body>
</html>