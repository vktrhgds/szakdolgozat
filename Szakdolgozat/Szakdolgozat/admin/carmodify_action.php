
<?php
	include('../users/timeout.php');
	include('../users/connection.php');
	include('../users/timeout.php');
	if($_SESSION['login_user']!="CMRentadmin"){
		echo "<script type='text/javascript'>  window.location='../users/login.php'; </script>"; 
	}
?>


<html>
	<head>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  <link rel = "stylesheet" href = "../css/stylepage1.css"/> 
	  <link rel = "stylesheet" href = "../css/modal.css"/>
	  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
		rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	  <link rel = "stylesheet" href = "css/stylepage1.css"/>
	</head>
	<body>
	<div id="bgStyle" style = "background:url('../css/batman_joker.jpg') no-repeat center center fixed; 
	-webkit-background-size: cover;
	-moz-background-size: cover;
	background-size: cover;"></div>

		<?php

			$car_sql = "SELECT * FROM `auto` ORDER BY evjarat DESC";
			$cars = mysqli_query($conn, $car_sql);
					
			$rowindex = 1;
			if (mysqli_num_rows($cars) > 0){
				while($row = mysqli_fetch_assoc($cars)){
					if(isset($_POST[htmlspecialchars($row["id"])])){
				
						$kategoria = mysqli_real_escape_string($conn, $_POST['kategoria']);
						$automarka_id = mysqli_real_escape_string($conn, $_POST['automarka_id']);
						$marka_tipus = mysqli_real_escape_string($conn, $_POST['marka_tipus']);
						$ar1 = mysqli_real_escape_string($conn, $_POST['ar_1']);
						$ar2 = mysqli_real_escape_string($conn, $_POST['ar_2']);
						$ar3 = mysqli_real_escape_string($conn, $_POST['ar_3']);
						$evjarat = mysqli_real_escape_string($conn, $_POST['evjarat']);
						$allapot = mysqli_real_escape_string($conn, $_POST['allapot']);
						$km_ora_allasa = mysqli_real_escape_string($conn, $_POST['km_ora_allasa']);
						$szallithato_szemelyek = mysqli_real_escape_string($conn, $_POST['szallithato_szemelyek']);
						$uzemanyag = mysqli_real_escape_string($conn, $_POST['uzemanyag']);
						$hengerurtartalom = mysqli_real_escape_string($conn, $_POST['hengerurtartalom']);
						$teljesitmeny = mysqli_real_escape_string($conn, $_POST['teljesitmeny']);
						$autoszin = mysqli_real_escape_string($conn, $_POST['autoszin']);
						$sajattomeg = mysqli_real_escape_string($conn, $_POST['sajattomeg']);
						$maxtomeg = mysqli_real_escape_string($conn, $_POST['maxtomeg']);
						$tankmeret = mysqli_real_escape_string($conn, $_POST['tankmeret']);
						$atlagfogyasztas = mysqli_real_escape_string($conn, $_POST['atlagfogyasztas']);
						$vegsebesseg = mysqli_real_escape_string($conn, $_POST['vegsebesseg']);
						$gyorsulas = mysqli_real_escape_string($conn, $_POST['gyorsulas']);		
						$oktanszam = mysqli_real_escape_string($conn, $_POST['oktanszam']);
						
						/*
						$fenykep = addslashes(file_get_contents($_FILES['fenykep']['tmp_name']));
						$fenykep_nev = addslashes($_FILES['fenykep']['name']);
						*/

						$update_sql = "UPDATE auto SET kategoria = '".$kategoria."', automarka_id ='".$automarka_id."', marka_tipus ='".$marka_tipus."', ar_1 ='".$ar1."',
					   ar_2 ='".$ar2."', ar_3 ='".$ar3."',  evjarat ='".$evjarat."', allapot ='".$allapot."', km_ora_allasa ='".$km_ora_allasa."',
					   szallithato_szemelyek ='".$szallithato_szemelyek."', uzemanyag ='".$uzemanyag."', hengerurtartalom ='".$hengerurtartalom."',
					   teljesitmeny ='".$teljesitmeny."', autoszin = '".$autoszin."', sajat_tomeg ='".$sajattomeg."', 
					   maximalis_tomeg ='".$maxtomeg."', tank_meret ='".$tankmeret."', atlagfogyasztas ='".$atlagfogyasztas."', 
					   vegsebesseg ='".$vegsebesseg."', gyorsulas ='".$gyorsulas."', oktanszam ='".$oktanszam."' WHERE id = '".$row["id"]."'";
									//echo $upload_sql;
						
					
						mysqli_query($conn, $update_sql);
						$last_id = mysqli_insert_id($conn);
						
						//echo $update_sql;
							
							echo '
							</br></br></br>
										<div class="container" style>
											<div class="alert alert-success">
												<strong>Sikeres művelet <i class="fa fa-smile-o" aria-hidden="true"> </strong></i></br>
												A személygépjármű adatait sikeresen módosította.
											</div>
											<div class="alert alert-info">
												<strong>A személygépjármű adatai</strong></br>
												Márka: '.htmlspecialchars($automarka_id).'</br>
												Márka típusa: '.htmlspecialchars($marka_tipus).'</br>
												Kategória: '.htmlspecialchars($kategoria).'</br>
												Évjárat: '.htmlspecialchars($evjarat).'</br>
												Ár (1-6 napig): '.htmlspecialchars($ar1).'</br>
												Ár (7-30 napig): '.htmlspecialchars($ar2).'</br>
												Ár (31-365 napig): '.htmlspecialchars($ar3).'</br>
												Állapot: '.htmlspecialchars($allapot).'</br>
												Km/h állás: '.htmlspecialchars($km_ora_allasa).' km</br>
												Szállítható személyek száma: '.htmlspecialchars($szallithato_szemelyek).'</br>
												Üzemanyag: '.htmlspecialchars($uzemanyag).'</br>
												Hengerűrtartalom: '.htmlspecialchars($hengerurtartalom).' cm<sup>3</sup></br>
												Teljesítmény: '.htmlspecialchars($teljesitmeny).' LE</br>
												Szín: '.htmlspecialchars($autoszin).' </br>
												Saját tömeg: '.htmlspecialchars($sajattomeg).' kg</br>
												Maximális tömeg: '.htmlspecialchars($maxtomeg).' kg</br>
												Üzemanyagtank mérete: '.htmlspecialchars($tankmeret).' l</br>
												Áltagfogyasztás: '.htmlspecialchars($atlagfogyasztas).' l/100 km</br>
												Végsebesség: '.htmlspecialchars($vegsebesseg).' km/h</br>
												Gyorsulás (0-100):  '.htmlspecialchars($gyorsulas).' mp</br>
												Oktánszám: '.htmlspecialchars($oktanszam).'</br>
												</br>
											 </div>
											 <div class="alert alert-info">';
											 ?>
												<a href="carmodify.php">Vissza</a></p>
											<?php
											echo'
									</div>
							</div>';
						}
					}
				}
			?>
	</body>
</html>	

				
				
				






 

				
				
				