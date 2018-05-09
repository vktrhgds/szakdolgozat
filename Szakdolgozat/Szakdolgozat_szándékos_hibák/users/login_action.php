
		
<?php

	session_start();
	$error = '';
	
	if(isset($_POST['login'])){
		
		$conn = mysqli_connect("localhost", "root", "");
		$db = mysqli_select_db($conn, "jarmuadatbazis_hibas");
		mysqli_set_charset($conn,"utf8");
		
		
		$login_felh_nev = $_POST['username'];
		$login_jelszo = $_POST['password']; 
		
		$adminf = "CMRentadmin";
		$adminj = "CMRentadmin1";
		
		$login_sql = "SELECT Felhasznalo.felhasznalo_nev, Felhasznalo.jelszo FROM Felhasznalo
		WHERE Felhasznalo.felhasznalo_nev = '".$login_felh_nev."' 
		AND Felhasznalo.jelszo = '".$login_jelszo."' LIMIT 1";
		
		$login_user = mysqli_query($conn, $login_sql);

		//echo $login_sql;
		$count_loggedinuser = mysqli_num_rows($login_user);
		$login_date = time(); 
		
		if($count_loggedinuser == 1){
			
			$sql = "INSERT INTO belepes
			(felhasznalo_nev, jelszo, bejelentkezes_datum) 
			VALUES('".$login_felh_nev."','".$login_jelszo."', '".$login_date."');";
			mysqli_query($conn, $sql);
			echo "</br>";
			echo $sql;
			
			
			//ha a jelszó illetve a felhasználónév is "admin"
			
			
			if($login_felh_nev == $adminf && $login_jelszo == $adminj){
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
										Az Ön által megadott felhasználónév: '.$login_felh_nev.'</br>
										Az Ön által megadott jelszó: '.$login_jelszo.'</br>
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