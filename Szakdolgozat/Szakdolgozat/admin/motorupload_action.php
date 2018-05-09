<?php 
	include('../users/timeout.php');
	include('../users/connection.php');
	include('../users/functions.php');
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

			if(isset($_POST['motor_upload'])){
				
				$kategoria = mysqli_real_escape_string($conn, $_POST['kategoria']);
				$motormarka_id = mysqli_real_escape_string($conn, $_POST['motormarka_id']);
				$marka_tipus = mysqli_real_escape_string($conn, $_POST['marka_tipus']);
				$ar1 = mysqli_real_escape_string($conn, $_POST['ar_1']);
				$ar2 = mysqli_real_escape_string($conn, $_POST['ar_2']);
				$ar3 = mysqli_real_escape_string($conn, $_POST['ar_3']);
				$evjarat = mysqli_real_escape_string($conn, $_POST['evjarat']);
				$allapot = mysqli_real_escape_string($conn, $_POST['allapot']);
				$km_ora_allasa = mysqli_real_escape_string($conn, $_POST['km_ora_allasa']);
				$uzemanyag = mysqli_real_escape_string($conn, $_POST['uzemanyag']);
				$hengerurtartalom = mysqli_real_escape_string($conn, $_POST['hengerurtartalom']);
				$teljesitmeny = mysqli_real_escape_string($conn, $_POST['teljesitmeny']);
				$motorszin = mysqli_real_escape_string($conn, $_POST['motorszin']);
				$sajattomeg = mysqli_real_escape_string($conn, $_POST['sajattomeg']);
				$maxtomeg = mysqli_real_escape_string($conn, $_POST['maxtomeg']);
				$tankmeret = mysqli_real_escape_string($conn, $_POST['tankmeret']);
				$atlagfogyasztas = mysqli_real_escape_string($conn, $_POST['atlagfogyasztas']);
				$vegsebesseg = mysqli_real_escape_string($conn, $_POST['vegsebesseg']);
				$gyorsulas = mysqli_real_escape_string($conn, $_POST['gyorsulas']);		
				$munkautem = mysqli_real_escape_string($conn, $_POST['munkautem']);
				
				$motor_id2 = generateRandomString();
				$motor_id2 = mysqli_real_escape_string($conn, $motor_id2);
		
				$target_dir = "../pictures/jarmuadatbazis_kepek/";
				$target_file = $target_dir . basename($_FILES["fenykep"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			
				
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
						echo '
								</br></br></br>
									<div class="container">
										<div class="alert alert-danger">
											<strong>Sikertelen művelet <i class="fa fa-frown" aria-hidden="true"> </strong></i></br>
											A feltöltött fájl csak jpg, png vagy jpeg formátumú lehet.
										</div>
									<div class="alert alert-info">
									<strong><a href="motorupload.php">Vissza a motor hozzáadásához</a></p>
								
								</div>
								
							</div>';
							exit();
					$uploadOk = 0;
				}
				
				// Check file size
				if ($_FILES["fenykep"]["size"] > 5000000) {
						echo '
								</br></br></br>
									<div class="container">
										<div class="alert alert-danger">
											<strong>Sikertelen művelet <i class="fa fa-frown" aria-hidden="true"> </strong></i></br>
											A feltöltött fájl mérete túl nagy.
										</div>
									<div class="alert alert-info">
									<strong><a href="motorupload.php">Vissza a motor hozzáadásához</a></p>
								
								</div>
								
							</div>';
							exit();
					$uploadOk = 0;
				}
				
				// Allow certain file formats
				
				else {
					if (move_uploaded_file($_FILES["fenykep"]["tmp_name"], $target_file)) {
				
					$upload_sql = "INSERT INTO motor
								(fenykep, kategoria, motormarka_id, ar_1, ar_2, ar_3, marka_tipus,
								evjarat, allapot, km_ora_allasa, uzemanyag, hengerurtartalom, 
								teljesitmeny, motorszin, sajat_tomeg, maximalis_tomeg,
								tank_meret, atlagfogyasztas, vegsebesseg, gyorsulas, munkautem, motor_id2) 
								VALUES('".$target_file."','".$kategoria."','".$motormarka_id."','".$ar1."','".$ar2."',
								'".$ar3."','".$marka_tipus."','".$evjarat."','".$allapot."','".$km_ora_allasa."', '".$uzemanyag."',
								'".$hengerurtartalom."', '".$teljesitmeny."', '".$motorszin."', '".$sajattomeg."','".$maxtomeg."','".$tankmeret."',
								'".$atlagfogyasztas."','".$vegsebesseg."','".$gyorsulas."','".$munkautem."', '".$motor_id2."');";
								
								//echo $upload_sql;
								
								mysqli_query($conn, $upload_sql);
								$last_id = mysqli_insert_id($conn);
								
								echo '
								</br></br></br>
											<div class="container">
												<div class="alert alert-success">
													<strong>Sikeres művelet <i class="fa fa-smile-o" aria-hidden="true"> </strong></i></br>
													A motort hozzáadtuk az adatbázishoz.
												</div>
												<div class="alert alert-info">
													<strong>A motor adatai</strong></br>
													Márka: '.htmlspecialchars($motormarka_id).'</br>
													Márka típusa: '.htmlspecialchars($marka_tipus).'</br>
													Kategória: '.htmlspecialchars($kategoria).'</br>
													Évjárat: '.htmlspecialchars($evjarat).'</br>
													Ár (1-6 napig): '.htmlspecialchars($ar1).'</br>
													Ár (7-30 napig): '.htmlspecialchars($ar2).'</br>
													Ár (31-365 napig): '.htmlspecialchars($ar3).'</br>
													Állapot: '.htmlspecialchars($allapot).'</br>
													Km/h állás: '.htmlspecialchars($km_ora_allasa).' km</br>
													Üzemanyag: '.htmlspecialchars($uzemanyag).'</br>
													Hengerűrtartalom: '.htmlspecialchars($hengerurtartalom).' cm<sup>3</sup></br>
													Teljesítmény: '.htmlspecialchars($teljesitmeny).' LE</br>
													Szín: '.htmlspecialchars($motorszin).' </br>
													Saját tömeg: '.htmlspecialchars($sajattomeg).' kg</br>
													Maximális tömeg: '.htmlspecialchars($maxtomeg).' kg</br>
													Üzemanyagtank mérete: '.htmlspecialchars($tankmeret).' l</br>
													Áltagfogyasztás: '.htmlspecialchars($atlagfogyasztas).' l/100 km</br>
													Végsebesség: '.htmlspecialchars($vegsebesseg).' km/h</br>
													Gyorsulás (0-100):  '.htmlspecialchars($gyorsulas).' mp</br>
													Munkaütem: '.htmlspecialchars($munkautem).'</br>
													</br>
												 </div>
												 <div class="alert alert-info">';
												 ?>
													<a href="motorupload.php">Vissza</a></p>
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
				
				
				