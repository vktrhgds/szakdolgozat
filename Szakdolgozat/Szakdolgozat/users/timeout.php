

<?php
	include('connection.php');
	//on pageload
	$get_date = "SELECT * FROM belepes WHERE felhasznalo_nev = '".$_SESSION['login_user']."'"; 
	$get_date_query = mysqli_query($conn, $get_date);
	$row = mysqli_fetch_assoc($get_date_query);
	$login_time = $row['bejelentkezes_datum'];
	//echo $login_session;
	
	/*
	echo $login_time;
	echo'</br>';
	echo time();
	echo'</br>';
	echo $_SERVER['REQUEST_URI'];
	*/

	$idletime = 3600;
	$timeleft = $idletime - (time()-$login_time);
	if($timeleft < 0){
		$timeleft = 0;
	}
	
	$timeleft = gmdate("H:i:s", $timeleft);
	
	/*
	echo $timeleft;
	*/
	
	//after 60 seconds the user gets logged out
	if (time()-$login_time>$idletime){
		
		$logout_sql = "DELETE FROM belepes WHERE belepes.felhasznalo_nev = '".$login_session."'";
		$logout_query = mysqli_query($conn, $logout_sql);
		echo '<script>alert("Automatikus kijelentkezés. Lejárt az időkeret (60 perc).")</script>';
		session_destroy();
		session_unset();
		header("Refresh: 3, url = login.php");
		
	}else{
		$login_time=time();
	}
	//on session creation
	$login_time=time();
?>