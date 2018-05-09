

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
		?>

		<?php

			if(isset($_POST['signup'])){
				
				// felhasználói adatok
				$felhasznalo =  $_POST['username'];
				$jelszo1 =  $_POST['password'];
				$jelszo2 =  $_POST['jelszo_ujra'];
				$email =  $_POST['email'];
				
				//személyes adatok
				$v_nev =  $_POST['vezeteknev'];
				$k_nev =  $_POST['keresztnev'];
				$szig  =  $_POST['szigszam'];
				$anyja_v  =  $_POST['anyja_vezeteknev'];
				$anyja_k  =  $_POST['anyja_keresztnev'];
				$telszam  =  $_POST['tel'];
				
				//lakcím adatok
				$ir  =  $_POST['irszam'];
				$varos  =  $_POST['varos'];
				$utca  =  $_POST['utca'];
				$hazszam  =  $_POST['hazszam'];
			
				//születési adatok
				$szulhely  =  $_POST['szul_hely'];
				$szulido  =  $_POST['szul_ido'];
			
				// biztonság
				$biztonsagikerdes  =  $_POST['biztonsagikerdesek'];
				$biztonsagivalasz  =  $_POST['valasz'];
				$email_ures = "";	
				// létezik-e a megadott felhasználónév
				$query_user = mysqli_query($conn, "SELECT felhasznalo_nev FROM Felhasznalo WHERE felhasznalo_nev = '".$felhasznalo."'");
				$count_user = mysqli_num_rows($query_user);
				
				// Felhasználónév ellenőrzése
				if((!$count_user > 0)){
				//helyes regisztrációhoz szükséges adatok ellenőrzése
					if($jelszo1 == $jelszo2 && (!$email == $email_ures)){			
						
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
						$mail->Subject = "Sikeres regisztráció - CMRent";
						$mail->Body = "Kedves ".$felhasznalo."!
Köszönjük, hogy regisztrált a rendszerünkbe. Ez egy automatikusan generált üzenet, kérjük, ne válaszoljon rá.
A regisztráció során megadott adatok a következők voltak:
Felhasználói adatok:
	Felhasználónév: ".$felhasznalo."
	E-mail cím: ".$email."
	Jelszó: ".$jelszo1."
		
Személyes adatok:
	Név: ".$v_nev." ".$k_nev."
	Anyja neve: ".$anyja_v." ".$anyja_k."
	Személyi igazolványszáma: ".$szig."
	Telefonszám: ".$telszam." 
		
Lakcím adatok:
	".$ir." ".$varos.", ".$utca." ".$hazszam.". 
		
Születési adatok:
	Születési hely: ".$szulhely." 
	Születési idő: ".$szulido." 
	
Üdvözlettel, CMRent	";
												
						$mail->AddAddress("$email");

						if(!$mail->Send()) {
							echo '</br></br></br>
										<div class="container" >
											<div class="alert alert-danger">
												<strong>Sikertelen regisztráció!</strong>! <i class="fa fa-frown" aria-hidden="true"></i></br>
												A megadott email-címre (<b>'.$email.'</b>) nem tudtuk elküldeni az adatait.</br>
												Adjon meg valódi e-mail címet!
											</div>
											<div class="alert alert-info">
												<a href="sign_up.php">Vissza a regisztrációhoz.</a></p>
											</div>
										</div>';
							exit();
						 } else {
							 
							//$jelszo_hashed = hash('sha512', $jelszo1);
						
							$sql = "INSERT INTO felhasznalo
									(felhasznalo_nev, jelszo, vezetek_nev, kereszt_nev,
									szemelyig_szam, anyja_vnev, anyja_knev, email, telszam, ir_szam,
									varos, utca, hazszam, szuletesi_hely, szuletesi_ido, biztonsagikerdes_id, biztonsagivalasz) 
									VALUES('".$felhasznalo."','".$jelszo1."','".$v_nev."'
									,'".$k_nev."','".$szig."','".$anyja_v."','".$anyja_k."','".$email."','".$telszam."','".$ir."',
									'".$varos."','".$utca."','".$hazszam."','".$szulhely."','".$szulido."','".$biztonsagikerdes."', '".$biztonsagivalasz."');";
						
							mysqli_query($conn, $sql);
				 
							echo '
							</br></br></br>
										<div class="container" >
											<div class="alert alert-success">
												<strong>Sikeres regisztráció!</strong> Üdvözöljük, '.$felhasznalo.'! <i class="fa fa-smile-o" aria-hidden="true"></i></br>
												A megadott email-címre (<b>'.$email.'</b>) elküldtük a regisztráció során megadott adatait.
											</div>
											<div class="alert alert-info">
												<strong>Felhasználói adatok</strong></br>
												Felhasználónév: '.$felhasznalo.'</br>
												E-mail cím: '.$email.'</br>
												Jelszó: '.$jelszo1.'</br>
												</br>
												<strong>Személyes adatok</strong></br>
												Név: '.$v_nev.' '.$k_nev.' </br>
												Anyja neve: '.$anyja_v.' '.$anyja_k.' </br>
												Személyi igazolványszáma: '.$szig.' </br>
												Telefonszám: '.$telszam.' </br>
												</br>
												<strong>Lakcím adatok</strong></br>
												'.$ir.' '.$varos.', '.$utca.' '.$hazszam.'. </br>
												</br>
												<strong>Születési adatok</strong></br>
												Születési hely: '.$szulhely.' </br>
												Születési idő: '.$szulido.' </br>
												</br>
											 </div>
											 <div class="alert alert-info">
												<a href="login.php">Tovább a belépésre</a></p>
										</div>
								</div>';
						 }
					}
				}
				
				
				//felhasználónév ellenőrzése
				if($count_user > 0){
					die('</br></br></br>
							<div class="container">
									<div class="alert alert-danger">
										<strong>Sikertelen regisztráció! </strong><i class="fa fa-frown-o" aria-hidden="true"></i></br>
											Ez a felhasználónév már szerepel az adatbázisunkban, válasszon másikat!</br>
											</div>
											<div class="alert alert-info">
												<strong>Javaslatok</strong></br></br>
												'.$felhasznalo.'_1_2 </br>
												'.$felhasznalo.'_1_5 </br>
												'.$felhasznalo.'_1_a </br>
												'.$felhasznalo.'_999_2 </br>
												</br>
											</div>
										<div class="alert alert-info">
											<a href="sign_up.php">Vissza a regisztrációhoz</a></p>
										</div>
									</div>');
				}
				
				//jelszavak ellenőrzése
				
				if($jelszo1 != $jelszo2){
					
					die('</br></br></br>
						<div class="container">
								<div class="alert alert-danger">
									<strong>Sikertelen regisztráció! </strong><i class="fa fa-frown-o" aria-hidden="true"></i></br>
										A megadott jelszavak nem egyeznek!</br>
										
								</div>
								<div class="alert alert-info">
									<a href="sign_up.php">Vissza a regisztrációhoz</a></p>
								</div>
						</div>');
				}
				
			}
			mysqli_close($conn); 
		?>
	</body>
</html>