
		
		<?php

			session_start();
			$error = '';
			
			if(isset($_POST['login'])){
				
				$conn = mysqli_connect("localhost", "root", "");
				$db = mysqli_select_db($conn, "jarmuadatbazis");
				mysqli_set_charset($conn,"utf8");
				
				$login_felh_nev = trim($_POST['username'], '\n\t');
				$login_felh_nev = mysqli_real_escape_string($conn, $_POST['username']);
				$login_felh_nev = addslashes(strip_tags($login_felh_nev));
				
				$login_jelszo = trim($_POST['password'], '\n\t'); 
				$login_jelszo = mysqli_real_escape_string($conn, $_POST['password']);
				$login_jelszo = addslashes(strip_tags($login_jelszo));
				//$login_jelszo = preg_replace($pattern,"",$login_jelszo);
				/*$login_felh_nev = $_POST['username'];
				$login_jelszo = $_POST['password'];*/
				
				// sha kódolás
				$login_jelszo_hashed = hash('sha512', $login_jelszo);
				$login_felhnev_hashed = hash('sha512', $login_felh_nev);
				$adminf = "CMRentadmin";
				$adminj = "CMRentadmin1";
				$adminj_hashed = hash('sha512', $login_jelszo);
				
				$login_sql = "SELECT Felhasznalo.felhasznalo_nev, Felhasznalo.jelszo
				FROM Felhasznalo WHERE Felhasznalo.felhasznalo_nev = '".$login_felh_nev."'
				AND Felhasznalo.jelszo = '".$login_jelszo_hashed."' LIMIT 1";
				
				$checkUserName = "SELECT * FROM Felhasznalo WHERE felhasznalo_nev = '".$login_felh_nev."';";
				
				$login_user = mysqli_query($conn, $login_sql);
				$checkUserNameQuery = mysqli_query($conn, $checkUserName);
				
				// Kis- és nagybetűk ellenőrzése a felhasználónévnél
				$usernameCorrect = mysqli_fetch_assoc($checkUserNameQuery); 
				$usernameCorrectData = $usernameCorrect['felhasznalo_nev'];
				$usernameCorrectData_hashed = hash('sha512', $usernameCorrectData);
				
				//echo $login_sql;
				$count_loggedinuser = mysqli_num_rows($login_user);
				$login_date = time(); 
				
				if($count_loggedinuser == 1 && $usernameCorrectData_hashed == $login_felhnev_hashed){
					
					/*
					$data = $db->prepare( 'INSERT INTO belepes ( felhasznalo_nev, jelszo ) VALUES ( :login_felh_nev, :login_jelszo_hashed );' ); 
					$data->bindParam( ':login_felh_nev', $login_felh_nev, PDO::PARAM_STR ); 
					$data->bindParam( ':jelszo', $login_jelszo_hashed, PDO::PARAM_STR ); 
					$data->execute();
					*/
					
					$sql = "INSERT INTO belepes
					(felhasznalo_nev, jelszo, bejelentkezes_datum) 
					VALUES('".$login_felh_nev."','".$login_jelszo_hashed."', '".$login_date."');";
					mysqli_query($conn, $sql);
					
					
					//ha a jelszó illetve a felhasználónév is "admin"
					
					
					if($login_felh_nev == $adminf && $login_jelszo_hashed == $adminj_hashed){
						$_SESSION['login_user']= $login_felh_nev;
						header("location: ../admin/adminindex.php");
					}
					
					
					//ha nem, akkor továbbítson a rendszer a kezdőoldalra
					else{
						$_SESSION['login_user']= $login_felh_nev;
						header("location: ../users/index.php");
					}
					
				}		
				else{
					die('<html>
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

							</br></br></br>
								<div class="container">
									<div class="alert alert-danger">
										<strong>Sikertelen bejelentkezés! </strong><i class="fa fa-frown-o" aria-hidden="true"></i></br>
											Ellenőrizze, hogy helyesen adta -e meg felhasználónevét illetve a jelszavát!
											</div>
											<div class="alert alert-warning">
												Ügyeljen a kis -és nagybetűkre!
											</div>
											<div class="alert alert-info">
												
												Ha elfelejtette a jelszavát, akkor a belépő felületen található "<b>Kattintson ide</b>" gomb használata után megváltoztathatja.
												Ezt akkor tudja megtenni, ha az oldalra történt regisztráció során megadott biztonsági kérdését helyesen megválaszolja.
											</div>
									<div class="alert alert-info">
										<a href="login.php">Vissza a belépő felülethez</a></p>
									</div>
								</div>
							</body>
						</html>');
				}
				mysqli_close($conn); // Kapcsolat bezárása
			}

		?>