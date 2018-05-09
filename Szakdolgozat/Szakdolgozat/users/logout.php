

<!-- kijelentkezés az oldalról -->

<?php
	include("connection.php");
	$logout_sql = "DELETE FROM belepes WHERE belepes.felhasznalo_nev = '".$login_session."'";
	$logout_query = mysqli_query($conn, $logout_sql);
	
	session_start();
	
	if(session_destroy()){
		header("Location: login.php");
	}

?>