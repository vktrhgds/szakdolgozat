

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

				$currentUsername =  trim($_POST['username'], '\n\t');
				$currentUsername =  mysqli_real_escape_string($conn, $_POST['username']);
				$currentUsername =  addslashes(strip_tags($currentUsername));
				$currentQ =  trim($_POST['biztonsagikerdesek'], '\n\t');
				$currentQ =  mysqli_real_escape_string($conn, $_POST['biztonsagikerdesek']);
				$currentQ =  addslashes(strip_tags($currentQ));
				$currentA =  trim($_POST['valasz'], '\n\t');
				$currentA =  mysqli_real_escape_string($conn, $_POST['valasz']);
				$currentA =  addslashes(strip_tags($currentA));
				
				$ujjelszo = generateRandomPassword();
				$ujjelszo_hashed = hash('sha512', $ujjelszo);
				
				$newpass_sql = "SELECT Felhasznalo.email, Felhasznalo.felhasznalo_nev, Felhasznalo.biztonsagikerdes_id, Felhasznalo.biztonsagivalasz FROM Felhasznalo
				WHERE Felhasznalo.felhasznalo_nev = '".$currentUsername."' AND Felhasznalo.biztonsagikerdes_id = '".$currentQ."' AND Felhasznalo.biztonsagivalasz = '".$currentA."' LIMIT 1";
				$newpass_query = mysqli_query($conn, $newpass_sql);
				
				//echo $newpass_sql;
				$count_user = mysqli_num_rows($newpass_query);
				
				
				//email - cím
				$userInfo = mysqli_fetch_assoc($newpass_query);
				$email = $userInfo["email"];
				
				//echo $newpass_sql;
				
				//ha helyesek az adatok
				
				if($count_user == 1){
					
					
					/* email küldése */
						
						require '../PHPMailer/src/Exception.php';
						require '../PHPMailer/src/PHPMailer.php';
						require '../PHPMailer/src/SMTP.php';
						
						$mail = new PHPMailer\PHPMailer\PHPMailer(true); // create a new object
						
						$mail->SMTPOptions = array(
							'ssl' => array(
								'verify_peer' => false,
								'verify_peer_name' => false,
								'allow_self_signed' => true
							)
						);
						
						$mail->IsSMTP(); // enable SMTP
						$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
						$mail->Debugoutput = 'html';
						$mail->Host = "smtp.gmail.com";
						$mail->Port = 587; // or 587
						$mail->CharSet = 'UTF-8';
						$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
						$mail->SMTPAuth = true; // authentication enabled
						
						$mail->Username = "szakdogacmrent@gmail.com";
						$mail->Password = "szakdogacmrent1";
						$mail->SetFrom("szakdogacmrent@gmail.com", "CMRentadmin");
						$mail->Subject = "Új jelszó - CMRent";
						$mail->Body = "Kedves ".$currentUsername."!
						
Sikeresen megváltoztatta a jelszavát!
Az új jelszava a következő: ".$ujjelszo."
Belépés után meg tudja változtatni a generált jelszót.
	
Üdvözlettel, CMRent	";
												
						$mail->AddAddress("$email");

						 if(!$mail->Send()) {
							echo "Mailer Error: " . $mail->ErrorInfo;
						 } else {

							$pass_updated = "UPDATE Felhasznalo SET Felhasznalo.jelszo='".$ujjelszo_hashed."' WHERE Felhasznalo.felhasznalo_nev = '".$currentUsername."'
							AND Felhasznalo.biztonsagikerdes_id = '".$currentQ."' AND Felhasznalo.biztonsagivalasz = '".$currentA."';";
							
							mysqli_query($conn, $pass_updated);
							
							echo '
							</br></br></br>
										<div class="container" style>
											<div class="alert alert-success">
												<strong>Sikeresen megváltoztatta a jelszavát, '.$currentUsername.'! <i class="fa fa-smile-o" aria-hidden="true"></strong></i></br>
												Az új jelszót elküldtük az alábbi e-mail címre: <b>'.$email.'</b> 
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
									<strong>A jelszó igénylése sikertelen! </strong><i class="fa fa-frown-o" aria-hidden="true"></i></br>
										Ellenőrizze, hogy helyesen adta -e meg felhasználónevét, biztonsági kérdését, illetve válaszát.
										</div>
										
								<div class="alert alert-info">
									<a href="login.php">Vissza a belépő felülethez</a></p>
								</div>
							</div>');
				}
					
				mysqli_close($conn); // Closing Connection
			}

		?>
	</body>
</html>
