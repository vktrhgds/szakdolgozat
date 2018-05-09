

<html>
	<head>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
		rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	  <link rel = "stylesheet" href = "../css/stylepage1.css"/>
	</head>
	</body>
	<div id="bgStyle"></div>

		<?php 

			/* registration_connection file hasznalata */
			include('registration_connection.php');
			include('functions.php');
		?>

		<?php
			
			if(isset($_POST['forgotpassword'])){
								
				// felhasználó adatai 
				$currentUsername =  $_POST['username'];
				$currentQ =  $_POST['biztonsagikerdesek'];
				$currentA =  $_POST['valasz'];
				$ujjelszo1 =  $_POST['ujjelszo1'];
				$ujjelszo2 =  $_POST['ujjelszo2'];
				
				$newpass_sql = "SELECT * FROM Felhasznalo
				WHERE Felhasznalo.felhasznalo_nev = '".$currentUsername."' 
				AND Felhasznalo.biztonsagikerdes_id = '".$currentQ."' 
				AND Felhasznalo.biztonsagivalasz = '".$currentA."' LIMIT 1";
				
				$newpass_query = mysqli_query($conn, $newpass_sql);
			
				
				
				$count_user = mysqli_num_rows($newpass_query);
				
				if($count_user == 1 && $ujjelszo1 == $ujjelszo2){
	
					$pass_updated = "UPDATE Felhasznalo SET Felhasznalo.jelszo='".$ujjelszo1."' 
					WHERE Felhasznalo.felhasznalo_nev = '".$currentUsername."'
					AND Felhasznalo.biztonsagikerdes_id = '".$currentQ."' 
					AND Felhasznalo.biztonsagivalasz = '".$currentA."';";
					
					mysqli_query($conn, $pass_updated);
					
					echo '
					</br></br></br>
								<div class="container" style>
									<div class="alert alert-success">
										<strong>Sikeresen megváltoztatta a jelszavát, '.$currentUsername.'! <i class="fa fa-smile-o" aria-hidden="true"></strong></i></br>
										Az új jelszava a következő: <b>'.$ujjelszo1.'</b>
										
									</div>
									 <div class="alert alert-info">
										<a href="login.php">Vissza a belépő felülethez</a></p>
									</div>
							</div>';
					}
				}
				
				
				if($count_user != 1){
					
					die('</br></br></br>
						<div class="container">
								<div class="alert alert-danger">
									<strong>Az új jelszó megadása sikertelen! </strong><i class="fa fa-frown-o" aria-hidden="true"></i></br>
										Ellenőrizze, hogy helyesen adta -e meg felhasználónevét, biztonsági kérdését, illetve válaszát.
										</div>
										
								<div class="alert alert-info">
									<a href="login.php">Vissza a belépő felülethez</a></p>
								</div>
							</div>');
				}
				
				
				if($ujjelszo1 != $ujjelszo2){
					die('</br></br></br>
						<div class="container">
								<div class="alert alert-danger">
									<strong>Az új jelszó megadása sikertelen! </strong><i class="fa fa-frown-o" aria-hidden="true"></i></br>
										A megadott jelszavak nem egyeznek meg.</br>
										A megadott jelszavak a következők: </br>
										1, <b>'.$ujjelszo1.'</b></br>
										2, <b>'.$ujjelszo2.'</b></br>
										</div>
										
								<div class="alert alert-info">
									<a href="login.php">Vissza a belépő felülethez</a></p>
								</div>
							</div>');
				}
					
				mysqli_close($conn); // Closing Connection

		?>
	</body>
</html>
