
<?php
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$conn = mysqli_connect("localhost", "root", "");
		// Selecting Database
		$db = mysqli_select_db($conn,"jarmuadatbazis_hibas");
		
		mysqli_set_charset($conn,"utf8");
		
		if(!isset($_SESSION)) 
		{ 
			session_start(); 
		} 
		mysqli_query($conn, 'SET NAMES UTF-8');
		mysqli_query($conn, 'SET character_set_results=utf8');
		mysqli_set_charset($conn, 'utf8');
		// Storing Session
		$user_check=$_SESSION['login_user'];
		// SQL Query To Fetch Complete Information Of User
		$ses_sql=mysqli_query($conn, "SELECT felhasznalo_nev from BELEPES where felhasznalo_nev='$user_check'");
		$row = mysqli_fetch_assoc($ses_sql);
		$login_session = $row['felhasznalo_nev'];
		
		/*
		if(!isset($login_session)){
			mysqli_close($conn); // Closing Connection
			echo "<script type='text/javascript'>  window.location='../users/login.php'; </script>"; // Redirecting To Home Page
		}
		*/
?>