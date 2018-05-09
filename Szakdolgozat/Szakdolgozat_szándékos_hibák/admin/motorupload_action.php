
<?php 
	include('../users/connection.php');
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
				
				$kategoria = $_POST['kategoria'];
				$motormarka_id = $_POST['motormarka_id'];
				$marka_tipus = $_POST['marka_tipus'];
				$ar1 = $_POST['ar_1'];
				$ar2 = $_POST['ar_2'];
				$ar3 = $_POST['ar_3'];
				$evjarat = $_POST['evjarat'];
				$allapot = $_POST['allapot'];
				$km_ora_allasa = $_POST['km_ora_allasa'];
				$uzemanyag = $_POST['uzemanyag'];
				$hengerurtartalom = $_POST['hengerurtartalom'];
				$teljesitmeny = $_POST['teljesitmeny'];
				$motorszin = $_POST['motorszin'];
				$sajattomeg = $_POST['sajattomeg'];
				$maxtomeg = $_POST['maxtomeg'];
				$tankmeret = $_POST['tankmeret'];
				$atlagfogyasztas = $_POST['atlagfogyasztas'];
				$vegsebesseg = $_POST['vegsebesseg'];
				$gyorsulas = $_POST['gyorsulas'];		
				$munkautem = $_POST['munkautem'];
						
				$fenykep = file_get_contents($_FILES['fenykep']['tmp_name']);
				$fenykep_nev = $_FILES['fenykep']['name'];
				
				$upload_sql = "INSERT INTO motor
				(fenykep, kategoria, motormarka_id, ar_1, ar_2, ar_3, marka_tipus,
				evjarat, allapot, km_ora_allasa, uzemanyag, hengerurtartalom, 
				teljesitmeny, motorszin, sajat_tomeg, maximalis_tomeg,
				tank_meret, atlagfogyasztas, vegsebesseg, gyorsulas, munkautem) 
				VALUES('../pictures/jarmuadatbazis_kepek/".$fenykep_nev."','".$kategoria."','".$motormarka_id."','".$ar1."','".$ar2."',
				'".$ar3."','".$marka_tipus."','".$evjarat."','".$allapot."','".$km_ora_allasa."', '".$uzemanyag."',
				'".$hengerurtartalom."', '".$teljesitmeny."', '".$motorszin."', '".$sajattomeg."','".$maxtomeg."','".$tankmeret."',
				'".$atlagfogyasztas."','".$vegsebesseg."','".$gyorsulas."','".$munkautem."');";
				
							
							
					//echo $upload_sql;
					
					mysqli_query($conn, $upload_sql);
					$last_id = mysqli_insert_id($conn);
					
					echo '
					</br></br></br>
								<div class="container" style>
									<div class="alert alert-success">
										<strong>Sikeres művelet <i class="fa fa-smile-o" aria-hidden="true"> </strong></i></br>
										A motort hozzáadtuk az adatbázishoz.
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
										<a href="motorupload.php">Vissza</a></p>
									<?php
									echo'
							</div>
					</div>';
			}
			mysqli_close($conn);
		?>
	</body>
</html>	
				
				
				