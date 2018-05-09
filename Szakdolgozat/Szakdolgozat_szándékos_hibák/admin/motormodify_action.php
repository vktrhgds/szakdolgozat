
<?php
	include('../users/connection.php');
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

			$motor_sql = "SELECT * FROM `motor` ORDER BY evjarat DESC";
			$motors = mysqli_query($conn, $motor_sql);
					
			$rowindex = 1;
			if (mysqli_num_rows($motors) > 0){
				while($row = mysqli_fetch_assoc($motors)){
					if(isset($_GET[$row["id"]])){
				
						$kategoria = $_GET['kategoria'];
						$motormarka_id = $_GET['motormarka_id'];
						$marka_tipus = $_GET['marka_tipus'];
						$ar1 = $_GET['ar_1'];
						$ar2 = $_GET['ar_2'];
						$ar3 = $_GET['ar_3'];
						$evjarat = $_GET['evjarat'];
						$allapot = $_GET['allapot'];
						$km_ora_allasa = $_GET['km_ora_allasa'];
						$uzemanyag = $_GET['uzemanyag'];
						$hengerurtartalom = $_GET['hengerurtartalom'];
						$teljesitmeny = $_GET['teljesitmeny'];
						$motorszin = $_GET['motorszin'];
						$sajattomeg = $_GET['sajattomeg'];
						$maxtomeg = $_GET['maxtomeg'];
						$tankmeret = $_GET['tankmeret'];
						$atlagfogyasztas = $_GET['atlagfogyasztas'];
						$vegsebesseg = $_GET['vegsebesseg'];
						$gyorsulas = $_GET['gyorsulas'];		
						$munkautem = $_GET['munkautem'];
						
						/*
						$fenykep = addslashes(file_get_contents($_FILES['fenykep']['tmp_name']));
						$fenykep_nev = addslashes($_FILES['fenykep']['name']);
						*/

						$update_sql = "UPDATE motor SET kategoria = '".$kategoria."', motormarka_id ='".$motormarka_id."', marka_tipus ='".$marka_tipus."', ar_1 ='".$ar1."',
					   ar_2 ='".$ar2."', ar_3 ='".$ar3."',  evjarat ='".$evjarat."', allapot ='".$allapot."', km_ora_allasa ='".$km_ora_allasa."',
					   uzemanyag ='".$uzemanyag."', hengerurtartalom ='".$hengerurtartalom."',
					   teljesitmeny ='".$teljesitmeny."', motorszin = '".$motorszin."', sajat_tomeg ='".$sajattomeg."', 
					   maximalis_tomeg ='".$maxtomeg."', tank_meret ='".$tankmeret."', atlagfogyasztas ='".$atlagfogyasztas."', 
					   vegsebesseg ='".$vegsebesseg."', gyorsulas ='".$gyorsulas."', munkautem ='".$munkautem."' WHERE id = '".$row["id"]."'";
									//echo $upload_sql;
						
					
						mysqli_query($conn, $update_sql);
						$last_id = mysqli_insert_id($conn);
						
						//echo $update_sql;
							
							echo '
							</br></br></br>
										<div class="container" style>
											<div class="alert alert-success">
												<strong>Sikeres művelet <i class="fa fa-smile-o" aria-hidden="true"> </strong></i></br>
												A motor adatait sikeresen módosította.
											</div>
											<div class="alert alert-info">
												<strong>A motor adatai</strong></br>
												Márka: '.$motormarka_id.'</br>
												Márka típusa: '.$marka_tipus.'</br>
												Kategória: '.$kategoria.'</br>
												Évjárat: '.$evjarat.'</br>
												Ár (1-6 napig): '.$ar1.'</br>
												Ár (7-30 napig): '.$ar2.'</br>
												Ár (31-365 napig): '.$ar3.'</br>
												Állapot: '.$allapot.'</br>
												Km/h állás: '.$km_ora_allasa.' km</br>
												
												Üzemanyag: '.$uzemanyag.'</br>
												Hengerűrtartalom: '.$hengerurtartalom.' cm<sup>3</sup></br>
												Teljesítmény: '.$teljesitmeny.' LE</br>
												Szín: '.$motorszin.' </br>
												Saját tömeg: '.$sajattomeg.' kg</br>
												Maximális tömeg: '.$maxtomeg.' kg</br>
												Üzemanyagtank mérete: '.$tankmeret.' l</br>
												Áltagfogyasztás: '.$atlagfogyasztas.' l/100 km</br>
												Végsebesség: '.$vegsebesseg.' km/h</br>
												Gyorsulás (0-100):  '.$gyorsulas.' mp</br>
												Munkaütem: '.$munkautem.'</br>
												</br>
											 </div>
											 <div class="alert alert-info">';
											 ?>
												<a href="motormodify.php">Vissza</a></p>
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

				
				
				






 

				
				
				