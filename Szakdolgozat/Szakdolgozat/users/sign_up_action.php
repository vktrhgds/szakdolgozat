

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
				$felhasznalo =  trim($_POST['username'], '\n\t');
				$felhasznalo =  mysqli_real_escape_string($conn, $_POST['username']);
				$felhasznalo =  addslashes(strip_tags($felhasznalo));
				$jelszo1 =  trim($_POST['password'], '\n\t');
				$jelszo1 =  mysqli_real_escape_string($conn, $_POST['password']);
				$jelszo1 =  addslashes(strip_tags($jelszo1));
				$jelszo2 =  trim($_POST['jelszo_ujra'], '\n\t');
				$jelszo2 =  mysqli_real_escape_string($conn, $_POST['jelszo_ujra']);
				$jelszo2 =  addslashes(strip_tags($jelszo2));
				$email =  trim($_POST['email'], '\n\t');
				$email =  mysqli_real_escape_string($conn, $_POST['email']);
				$email =  addslashes(strip_tags($email));
				
				
				//személyes adatok
				$v_nev =  trim($_POST['vezeteknev'], '\n\t');
				$v_nev =  mysqli_real_escape_string($conn, $_POST['vezeteknev']);
				$v_nev =  addslashes(strip_tags($v_nev));
				$k_nev =  trim($_POST['keresztnev'], '\n\t');
				$k_nev =  mysqli_real_escape_string($conn, $_POST['keresztnev']);
				$k_nev =  addslashes(strip_tags($k_nev));
				$szig  =  trim($_POST['szigszam'], '\n\t');
				$szig  =  mysqli_real_escape_string($conn, $_POST['szigszam']);
				$szig  =  addslashes(strip_tags($szig));
				$anyja_v  =  trim($_POST['anyja_vezeteknev'], '\n\t');
				$anyja_v  =  mysqli_real_escape_string($conn, $_POST['anyja_vezeteknev']);
				$anyja_v  =  addslashes(strip_tags($anyja_v));
				$anyja_k  =  trim($_POST['anyja_keresztnev'], '\n\t');
				$anyja_k  =  mysqli_real_escape_string($conn, $_POST['anyja_keresztnev']);
				$anyja_k  =  addslashes(strip_tags($anyja_k));
				$telszam  =  trim($_POST['tel'], '\n\t');
				$telszam  =  mysqli_real_escape_string($conn, $_POST['tel']);
				$telszam  =  addslashes(strip_tags($telszam));
				
				
				//lakcím adatok
				$ir  =  trim($_POST['irszam'], '\n\t');
				$ir  =  mysqli_real_escape_string($conn, $_POST['irszam']);
				$ir  =  addslashes(strip_tags($ir));
				$varos  =  trim($_POST['varos'], '\n\t');
				$varos  =  mysqli_real_escape_string($conn, $_POST['varos']);
				$varos  =  addslashes(strip_tags($varos));
				$utca  =  trim($_POST['utca'], '\n\t');
				$utca  =  mysqli_real_escape_string($conn, $_POST['utca']);
				$utca  =  addslashes(strip_tags($utca));
				$hazszam  =  trim($_POST['hazszam'], '\n\t');
				$hazszam  =  mysqli_real_escape_string($conn, $_POST['hazszam']);
				$hazszam  =  addslashes(strip_tags($hazszam));
				
				
				//születési adatok
				$szulhely  =  trim($_POST['szul_hely'], '\n\t');
				$szulhely  =  mysqli_real_escape_string($conn, $_POST['szul_hely']);
				$szulhely  =  addslashes(strip_tags($szulhely));
				$szulido  =  trim($_POST['szul_ido'], '\n\t');
				$szulido  =  mysqli_real_escape_string($conn, $_POST['szul_ido']);
				$szulido  =  addslashes(strip_tags($szulido));
			
				
				// biztonság
				$biztonsagikerdes  =  trim($_POST['biztonsagikerdesek'], '\n\t');
				$biztonsagikerdes  =  mysqli_real_escape_string($conn, $_POST['biztonsagikerdesek']);
				$biztonsagikerdes  =  addslashes(strip_tags($biztonsagikerdes));
				$biztonsagivalasz  =  trim($_POST['valasz'], '\n\t');
				$biztonsagivalasz  =  mysqli_real_escape_string($conn, $_POST['valasz']);
				$biztonsagivalasz  =  addslashes(strip_tags($biztonsagivalasz));
				
			
				
				$email_ures = "";	
				// létezik-e a megadott felhasználónév
				$query_user = mysqli_query($conn, "SELECT felhasznalo_nev FROM Felhasznalo WHERE felhasznalo_nev = '".$felhasznalo."'");
				$count_user = mysqli_num_rows($query_user);
				
				// létezik-e a megadott személyi igazolványszám
				$query_idnumber = mysqli_query($conn, "SELECT * FROM Felhasznalo WHERE szemelyig_szam = '".$szig."'");
				$count_idnumber = mysqli_num_rows($query_idnumber);
				
				// létezik-e a megadott email cím
				$query_email = mysqli_query($conn, "SELECT * FROM Felhasznalo WHERE email = '".$email."'");
				$count_email = mysqli_num_rows($query_email);
				
				
				//jelszó és felhaszálónév hosszának az ellenőrzése (minimum 8 illetve 6 karakter, illetve a jelszó max 32karakter)
				if(strlen($jelszo1) < 8 || strlen($felhasznalo) < 6 || strlen($jelszo1) > 32 || strlen($felhasznalo) > 32){
					die('</br></br></br>
							<div class="container">
								<div class="alert alert-danger">
									<strong>Sikertelen regisztráció! </strong><i class="fa fa-frown-o" aria-hidden="true"></i></br>
									A megadott felhasználónév vagy jelszó túl rövid!</br>
									A felhasználónév legalább hat, a jelszó legalább nyolc karakterből kell, hogy álljon, illetve mindkettő legfeeljebb 32 karaktert tartalmazhat!
								</div>
								<div class = "alert alert-info">
										Egy erős jelszó létrehozásához használja segítségképpen a regisztrációs felületen található jelszó erősségmerő rendszert!
								</div>
								<div class="alert alert-info">
									<a href="sign_up.php">Vissza a regisztrációhoz</a></p>
								</div>
						</div>');
					}
				
				if($jelszo1 == $felhasznalo){
					die('</br></br></br>
							<div class="container">
								<div class="alert alert-danger">
									<strong>Sikertelen regisztráció! </strong><i class="fa fa-frown-o" aria-hidden="true"></i></br>
									A megadott felhasználónév és jelszó nem lehet azonos!</br>
									A felhasználónév legalább hat, a jelszó legalább nyolc karakterből kell, hogy álljon, illetve mindkettő legfeeljebb 32 karaktert tartalmazhat!
								</div>
								<div class = "alert alert-info">
										Egy erős jelszó létrehozásához használja segítségképpen a regisztrációs felületen található jelszó erősségmerő rendszert!
								</div>
								<div class="alert alert-info">
									<a href="sign_up.php">Vissza a regisztrációhoz</a></p>
								</div>
						</div>');
					}
				
				
			
				// Felhasználónév ellenőrzése
				if((!$count_user > 0)){
				//helyes regisztrációhoz szükséges adatok ellenőrzése
					if($jelszo1 == $jelszo2 && (!$count_email > 0) && (!$count_idnumber > 0) && (!$count_user > 0) && (!$email == $email_ures)){			
						
						// milyen kódolást célszerű használni?
						
						//md5 (hash)-ként (ez egy 32 hosszú karaktersorozat) - napjainkban nem célszerű ezt alkalmazni!
						
						//$jelszo1 = md5($jelszo1);
						//$jelszo1 = crypt($jelszo1);
						//$jelszo1 = sha1($jelszo1);
						//$jelszo1 = hash('sha256' , $jelszo1);
						//$jelszo1 = hash('sha384' , $jelszo1);
						//$jelszo1 = hash('sha512' , $jelszo1);
						//$jelszo1 = hash('tiger192,3', &jelszo1), PHP_EOL;
						//$jelszo1 = old_tiger(&jelszo1), PHP_EOL;
						//$jelszo1 = hash('ripemd160', $jelszo1);
						
						/*
						$password = $_POST['password'];
						$hashed_password = password_hash($password, PASSWORD_DEFAULT);
						var_dump($hashed_password);
						if(password_verify($password, $hashed_password)) {
						   // csinaljon valamit
						} 
						*/
						
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
						$mail->Subject = "Sikeres regisztráció - CMRent";
						$mail->Body = "Kedves ".$felhasznalo."!
Köszönjük, hogy regisztrált a rendszerünkbe. Ez egy automatikusan generált üzenet, kérjük, ne válaszoljon rá!
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
							 
							$jelszo_hashed = hash('sha512', $jelszo1);
						
							$sql = "INSERT INTO felhasznalo
									(felhasznalo_nev, jelszo, vezetek_nev, kereszt_nev,
									szemelyig_szam, anyja_vnev, anyja_knev, email, telszam, ir_szam,
									varos, utca, hazszam, szuletesi_hely, szuletesi_ido, biztonsagikerdes_id, biztonsagivalasz) 
									VALUES('".$felhasznalo."','".$jelszo_hashed."','".$v_nev."'
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
				
				
				//szig.szám ellenőrzése
				
				if($count_idnumber > 0){
					die('</br></br></br>
							<div class="container">
									<div class="alert alert-danger">
										<strong>Sikertelen regisztráció! </strong><i class="fa fa-frown-o" aria-hidden="true"></i></br>
											Ez a személyi igazolványszám már szerepel az adatbázisunkban, válasszon másikat!</br>
									</div>
									<div class="alert alert-info">
											<a href="sign_up.php">Vissza a regisztrációhoz</a></p>
									</div>
								</div>');						
				}
				

				//email ellenőrzése
				
				if($count_email > 0){
					die('</br></br></br>
						<div class="container">
								<div class="alert alert-danger">
									<strong>Sikertelen regisztráció! </strong><i class="fa fa-frown-o" aria-hidden="true"></i></br>
										Ez az e-mail cím már szerepel az adatbázisunkban, válasszon másikat!</br>
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