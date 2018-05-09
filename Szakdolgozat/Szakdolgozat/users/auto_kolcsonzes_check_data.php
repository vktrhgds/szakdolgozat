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
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	
	<script>
		function goBack() {
			window.history.back();
		}
	</script>
	
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
		<div id="bgStyle" style = "background: #EAE9E9;"></div>
			
			
			</br></br>
			
			<!-- kölcsönzés-> adatok ellenőrzése -->
			
			<?php
				
				$checkUser = "Select * from felhasznalo WHERE felhasznalo_nev = '".$login_session."'";
				$checkUser_query = mysqli_query($conn, $checkUser);
				$user = mysqli_fetch_assoc($checkUser_query);
				
				$car_sql = "SELECT * FROM `auto` ORDER BY evjarat DESC";
				$cars = mysqli_query($conn, $car_sql);
							
				$rowindex = 1;
				if (mysqli_num_rows($cars) > 0){
					while($row = mysqli_fetch_assoc($cars)){
						if(isset($_GET[$row['auto_id2']])){
							
						$rent_start = trim($_GET['kolcsonzes_kezdet_auto'], '\n\t');
						$rent_start = mysqli_real_escape_string($conn, $_GET['kolcsonzes_kezdet_auto']);
						$rent_start = addslashes(strip_tags($rent_start));
						$rent_end = trim($_GET['kolcsonzes_vege_auto'], '\n\t');
						$rent_end = mysqli_real_escape_string($conn, $_GET['kolcsonzes_vege_auto']);
						$rent_end = addslashes(strip_tags($rent_end));
						
						/* dátumok */									
						$rent_takeback = date('Y. m. d', strtotime($rent_end .' +1 day'));
						$today = date("Y-m-d");
						
						
						/* dátum objektumok létrehozása, ha helytelen a formátum, akkor hibaüzenet */
						try {
							$date1 = new DateTime($rent_start);
							$date2 = new DateTime($rent_end);
						} catch (Exception $e) {
							
							die('
								<div class="container">
									<div class="alert alert-danger">
										<strong>Hiba!</strong> </br>Érvénytelen a megadott dátum formátuma!</br></br>
										A megadott kezdeti dátum: <b>'.$rent_start.' </b></br>
										A megadott végső dátum: <b>'.$rent_end.'</b> </br>
										A mai dátum: <b>'.$today.' </b></br></br>
										Ügyeljen arra, hogy a kölcsönzés kezdete a mai napnál későbbi időpont legyen, illetve a kölcsönzés végének a dátuma nem lehet
										hamarabb a kölcsönzés kezdeténél.</br>
										Legfeljebb 365 napra kölcsönözheti ki a kiválasztott személygépjárművet vagy motort!</br></br>
										<a style = "cursor: pointer; "onclick = "goBack()">Vissza a kölcsönzéshez</a></br>
									</div>
								</div>
							
							');
						}
						
						/* kölcsönzés kezdete és vége között eltelt napok száma */
						$interval = $date1->diff($date2);
						$interval->d = $interval->d + 1;
						
						/* árak */
						$ar_1 = htmlspecialchars($row['ar_1']);
						$ar_2 = htmlspecialchars($row['ar_2']);
						$ar_3 = htmlspecialchars($row['ar_3']);
						$daily_price = 0;
						$whole_price = 0;
						
						/* Van-e erre az időszakra kölcsönzés */
						$rent_sql = "SELECT * FROM autokolcsonzes WHERE auto_id = '".$row['id']."' AND
									(('".$rent_start."' >= mettol AND '".$rent_start."' <= meddig)
									OR ('".$rent_end."' >= mettol AND '".$rent_end."' <= meddig) OR ('".$rent_start."' <= mettol AND '".$rent_end."' >= meddig))";
						$rented_cars = mysqli_query($conn, $rent_sql);
						$count_rentedcars = mysqli_num_rows($rented_cars);
						
						
						/* ha le van foglalva az adott időpontban, akkor hibaüzenet jelenjen meg */
						if($count_rentedcars > 0){
								
							$allrented_cars = "SELECT * FROM autokolcsonzes WHERE auto_id = '".$row['id']."'";
							$allrented_cars_query = mysqli_query($conn, $allrented_cars);
							echo'
								<div class="container">
									<div class="alert alert-danger">
										<strong>Hiba!</strong> </br>A megadott időpontban nem elérhető a bérelni kívánt személygépjármű!</br></br>
										A megadott kezdeti dátum: <b>'.$rent_start.' </b></br>
										A megadott végső dátum: <b>'.$rent_end.'</b> </br>
										A mai dátum: <b>'.$today.' </b></br></br>
										A megadott időpontokban nem lehet kibérelni a(z) <b>'.$row['automarka_id'].' '.$row['marka_tipus'].'-t</b>: </br>
										';
										while($rows = mysqli_fetch_assoc($allrented_cars_query)){
											echo $rows['mettol'].' - '.$rows['meddig'].'</br>';
										}
										echo'
										</br>
										Kérjük, válasszon másik alkalmat! </br>
										Ügyeljen arra, hogy a kölcsönzés kezdete a mai napnál későbbi időpont legyen, illetve a kölcsönzés végének a dátuma nem lehet
										hamarabb a kölcsönzés kezdeténél.</br>
										Legfeljebb <b>365</b> napra kölcsönözheti ki a kiválasztott személygépjárművet vagy motort!</br></br>
										<a style = "cursor: pointer; "onclick = "goBack()">Vissza a kölcsönzéshez</a></br>
									</div>
								</div>
								
							';
							exit();
						}
						
						
						/* ha helytelenek a megadott dátumok, akkor hibaüzenet */
						if($today > $rent_start || $rent_start > $rent_end || $interval->y >= 1){
							
							die('
								<div class="container">
									<div class="alert alert-danger">
										<strong>Hiba!</strong> </br>Helytelen kölcsönzési dátum.</br></br>
										A megadott kezdeti dátum: <b>'.$rent_start.' </b></br>
										A megadott végső dátum: <b>'.$rent_end.'</b> </br>
										A mai dátum: <b>'.$today.' </b></br></br>
										Ügyeljen arra, hogy a kölcsönzés kezdete a mai napnál későbbi időpont legyen, illetve a kölcsönzés végének a dátuma nem lehet
										hamarabb a kölcsönzés kezdeténél.</br>
										Legfeljebb <b>365</b> napra kölcsönözheti ki a kiválasztott személygépjárművet vagy motort!</br></br>
										<a style = "cursor: pointer; "onclick = "goBack()">Vissza a kölcsönzéshez</a></br>
									</div>
								</div>
							
							');
						}
						
						
						/* 1-6 napig */
						else if($interval->d <= 6 && $interval->d >= 0 && $interval->m == 0 && $interval->y == 0){
							$whole_price = $ar_1 * $interval->d;
							$daily_price = $ar_1;
						}
						
						/* 7-30 napin */
						else if($interval->d > 6 && $interval->d <= 30 && $interval->m == 0 && $interval->y == 0){
							$whole_price = $ar_2 * $interval->d;
							$daily_price = $ar_2;
						}
						
						/* 31-365 napig */
						else if($interval->d == 31 || ($interval->m >= 1 && $interval->m <= 12 && $interval->y < 1)){
							$whole_price = ($ar_3 * $interval->m * 30) + ($ar_3 * $interval->d);
							$daily_price = $ar_3;
						}
						
						/* SESSION variables */
						$_SESSION['rent_start'] = $rent_start;
						$_SESSION['rent_end'] = $rent_end;
						$_SESSION['daily_price'] = $daily_price;
						$_SESSION['whole_price'] = $whole_price;
												
						?>
						
						<table id = "carmotortable" style="border:0px solid white; 
							width: 80%; padding: 0%; margin-bottom: 0.5%; margin-left: 10%; margin-right: 10%; border-bottom: 1px solid #6E6E6E; background: #EAE9E9; color: white;" align = "center" cellspacing = "0" cellpadding = "0">
							<form method = "POST" action = "auto_kolcsonzes_action" enctype = "multipart/form-data" >
							<tr>
								<td width = "33.3%" bgcolor = "gray" style = "font-size: 25px; padding: 5px; border-right: 1px solid white; text-align: center"> <i class="fa fa-calendar"></i> Dátum választás</td>
								<td width = "33.3%" bgcolor = "#46a32d" style = "font-size: 25px; padding-left: 10px; padding-right: 10px; border-right: 1px solid white; text-align: center"> <i class="fa fa-user"></i> Adatok ellenőrzése</td>
								<td width = "33.3%" bgcolor = "gray" style = "font-size: 25px; padding-left: 10px; padding-right: 10px; text-align: center"> <i class="fa fa-shopping-cart"></i> Kölcsönzés</td>
							</tr>
							<tr>
							</tr>
								<td colspan = "3" style = "color: black; font-size: 22px; padding: 30px; padding-left: 120px;font-family: Arial, Helvetica, sans-serif;" >Kérjük, ellenőrizze a kölcsönzés adatait!</td>
							<tr>
								<td colspan = "3" style = "color: black; font-size: 22px; padding-bottom: 20px; padding-left: 120px;font-family: Arial, Helvetica, sans-serif;" >Személygépjármű adatai:</td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Autó márkája:</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($row['automarka_id'])." ".$row['marka_tipus']; ?></td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Ár (1-6 napig):</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($row['ar_1']); ?> HUF</td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Ár (7-30 napig):</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($row['ar_2']); ?> HUF</td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Ár (31-365 napig):</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($row['ar_3']); ?> HUF</td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Teljesítmény:</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($row['teljesitmeny']); ?> LE</td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Hengerűrtartalom:</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($row['hengerurtartalom']); ?> cm<sup>3</sup></td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Autó színe:</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($row['autoszin']); ?> </td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Tank mérete:</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($row['tank_meret']); ?> l</td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Átlagfogyasztás:</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($row['atlagfogyasztas']); ?> l/100 km</td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Üzemanyag:</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($row['uzemanyag']); ?> </td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Oktánszám</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($row['oktanszam']); ?> </td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Száll. személyek:</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($row['szallithato_szemelyek']); ?> személy</td>
							</tr>
							<tr>
								<td colspan = "2" style = "color: black; font-size: 22px; padding-bottom: 20px; padding-top: 40px;padding-left: 120px;font-family: Arial, Helvetica, sans-serif;" >Személyes adatok:</td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Név:</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($user['vezetek_nev'])." ".htmlspecialchars($user['kereszt_nev']); ?></td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >E-mail:</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($user['email']); ?></td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Telefonszám</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($user['telszam']); ?> </td>
							</tr>
							<tr>
								<td colspan = "3" style = "color: black; font-size: 22px; padding-bottom: 20px; padding-top: 40px;padding-left: 120px;font-family: Arial, Helvetica, sans-serif;" >Kölcsönzés dátuma:</td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Kölcsönzés kezdete:</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo $rent_start; ?> </td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Kölcsönzése vége:</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo $rent_end; ?> </td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Időtartam:</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo $interval->y." év, ".$interval->m." hónap, ".$interval->d." nap"; ?> </td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Kölcsönzés lejárata:</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo $rent_takeback; ?> 12.00 </td>
							</tr>
							<tr>
								<td colspan = "3" style = "color: black; font-size: 22px; padding-bottom: 20px; padding-top: 40px;padding-left: 120px;font-family: Arial, Helvetica, sans-serif;" >Kölcsönzés összege:</td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Ár naponta:</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo $daily_price; ?> HUF</td>
							</tr>
							<tr>
								<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Végösszeg:</td>
								<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo $whole_price; ?> HUF</td>
							</tr>
							<tr>
								<td colspan = "3" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-top: 20px;padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >
									<input type = "checkbox" name = "check_user" style = " width: 30px; height: 20px;" required /><font color ="green"> Megerősítem, hogy a kölcsönzésem adatai helyesek.</font>
									<!--<input type = "hidden" name = "userhidden" value = "<?php// echo $login_session; ?>">-->
								</td>
							</tr>
							<tr>
								<td colspan = "2" style = "padding-left: 220px; padding-bottom: 30px; padding-top: 30px;">
									<input type = "submit"  class = "viewvehicle" value = "Kölcsönzés" style = "height: 32px;width: 100%; padding: 0;" name = "<?php echo $row["auto_id2"]; ?>" >
								</td>
								<td style = "padding-left: 120px;">
									<a href = "index" style = "padding: 3px; padding-left: 5px; padding-right: 5px;border: 2px solid rgb(63, 125, 188); text-decoration: none; color: rgb(63, 125, 188); font-size: 20px; width: 70%; height: 33px;" title = "Vissza a főoldalra" >Mégsem</a>
								</td>
							</tr>
							</form>
						</table>
						<?php
						}
					}
				}
			?>
			
			
	</body>
</html>