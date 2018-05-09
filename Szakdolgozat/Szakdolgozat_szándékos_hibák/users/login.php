

<?php
	include('login_action.php');
	
	/*
	if(isset($login_session) && $login_session != "CMRentadmin" ){
		header("location: ../users/index.php");
	}
	
	else if(isset($login_session) && $login_session == "CMRentadmin" ){
		header("location: ../admin/adminindex.php");
	}
	*/
	
?>

<!DOCTYPE html>
<html>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta HTTP-EQUIV="Content-Language" Content="hu">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../res/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel = "stylesheet" href = "../css/stylepage1.css"/>
	<link rel = "stylesheet" href = "../css/modal.css"/>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway:300" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
	rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	
	<head>
		<title>Bejelentkezés</title>
		<link type="text/css" rel="stylesheet" href="../css/style1.css"/>
		<script type="text/javascript" src="../javascript/jquery.js"></script>
		<script type="text/javascript" src="../javascript/passwordStrengthMeter.js"></script>
	</head>
	
	
	<!-- body -->
	
	<body>	
	<div id="bgStyle" style = "background:url('../css/batman_joker.jpg') no-repeat center center fixed; 
	-webkit-background-size: cover;
	-moz-background-size: cover;
	background-size: cover;"></div>
		
		</br></br>
		<div align = "center" style = "margin-bottom: -20px; z-index: 1;"id = "icons" >
			<img id = "icons"id="logo" src="../res/login.png" alt="logo" style = "width: 110px; height: 110px;" />
		</div>
		<div align = "center" width = "35%">
			<form method = "POST" action = "login_action.php" enctype = "multipart/form-data" name = "loginform">
			<table cellspacing = "0" cellpadding = "0" id = "logintable" align = "center" width = "42%"
			style = "border-radius: 12;
			-webkit-border-radius: 12;
			-moz-border-radius: 12;">
				<tr>
					<td height = "40px" align = "center" colspan = "2">Üdvözöljük a <font color = "#AF8700"><b><i>CMRent</i></b></font><font color = "#fff"> oldalán! </font>
					</td>
				</tr>
				<tr>
					<td style = "padding: 5px;" colspan = "2">
						<div style="text-align: center; height: 1px; background-color: #E6E6E6; width:100%;"></div>
					</td>
				</tr>
				<tr>
					<td height = "40px" align = "left" style =" padding: 20px 0px 20px 30px;"><b><font size = "6">Bejelentkezés 
					<img src = "../css/pictures2/sing_in_key.png" width = "32px" height = "32px"/>
					
					</td>
				</tr>
				<tr>
					<td height = "25px" colspan = "2" align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Felhasználónév</br>
					<input type = "text" class = "input" name = "username"  required></td>
				</tr>
				
				<tr>
					<td height = "30px" align = "left" colspan = "2" style =" padding: 10px 0px 0px 30px; font-size: 22px;">Jelszó</br>
					<input type = "password" class = "input" name = "password" required></td>
				</tr>
				<tr><td colspan = "2" height = "10px"></td></tr>
				<tr>
					<td style="padding: 0px 38px 0px 30px;" colspan = "2">
						<input type = "submit" class = "input" name = "login" value = "Bejelentkezés" />
					</td>
				</tr>
				<tr>
					<td colspan = "2" height = "40px" align = "left" style =" padding: 20px 0px 5px 35px; font-size: 21px;"> 
						
					</td>
				</tr>
				<tr>
					<td colspan = "2" height = "40px" align = "left" style =" padding: 5px 20px 5px 35px; font-size: 21px;">Nem rendelkezik fiókkal? 
					<input type = "button" onclick = "location.href='sign_up.php';" class = "sign_up"
					value = "  Fiók létrehozása" title = "Az oldal használatához be kell jelentkeznie!" style = "width: 45%;"/></td>
				</tr>
				<tr>
					<td colspan = "2" height = "40px" align = "left" style =" padding: 5px 20px 5px 35px; font-size: 21px;">Elfelejtette jelszavát?
					<input type ="button" id = "openmodal" value = " Kattintson ide" title = "Kattintson erre a gombra, ha elfelejtette a jelszavát!"></input></td>
				</tr>
				</form>
			</table>
			
			<!-- elfelejtett jelszó -->

			<div id="myModal" class="modal" style = "z-index: 1;">
			  <form method = "POST" action = "forgottenpassword.php" enctype = "multipart/form-data" name = "forgottenpassword">
				 <!-- Modal content -->
			  <div class="modal-content">
				<div class="modal-header">
				  <span class="close" title = "Close" >&times;</span>
				  <font color = "#AF8700"><b>Elfelejtett </b></font><font color = "#fff">jelszó</font>
				  <img src = "../css/pictures2/forgot_password.png" width = "41px" height = "41px"/>
				</div>
				<div class="modal-body">
				
				  Felhasználónév
				<input type = "text" class = "input" name= "username" id="username" required />
				   <div style="text-align: center; height: 14px; background-color: #424242; width:100%;"></div>
				  Válassza ki a biztonsági kérdését
				  <select class = "select" style = "font-size: 20px;" name = "biztonsagikerdesek">
					  <?php
						  $conn = mysqli_connect("localhost", "root", "");
						  $db = mysqli_select_db($conn, "jarmuadatbazis");
						  mysqli_set_charset($conn,"utf8");
						  
						  $select_q = "SELECT * FROM biztonsagi_kerdesek;";
						  $select_q_query = mysqli_query($conn, $select_q);
						 
						  if(mysqli_num_rows($select_q_query)){
							  while($question = mysqli_fetch_array($select_q_query)){ ?>
							  
							  <option class = "option"value = "<?php echo $question["id"]; ?>">
								<?php 
									echo $question["biztonsagikerdes"]; }}
								?>
						  </option>
				  </select>
				  <div style="text-align: center; height: 14px; background-color: #424242; width:100%;"></div>
				  Válasz
				  <input style = "background: url('../css/pictures2/question_icon.png') no-repeat 0 0; background-size: 26px;"
				  type = "text" class = "input" name = "valasz" id = "valasz" required /></br>
				   Új jelszó
				  <input type = "password" class = "input" name = "ujjelszo1" required /></br>
				   Új jelszó megerősítése
				  <input type = "password" class = "input" name = "ujjelszo2" required /></br>
				</div>
				<div class="modal-footer">
				  <input type = "submit" class = "input" name = "forgotpassword" value = "Új jelszó megadása" title = "" style = "width: 92%;" />
				   <div style="text-align: center; height: 5px; background-color: #424242; width:100%;"></div>
				</div>
			  </div>
			</form>
			</div>
			
		</div>
		
		
		<div id="myModal" class="modal" style = "z-index: 1;">
			  <!-- Modal content -->
			  <div class="modal-content">
				<div class="modal-header">
				  <span class="close" title = "Close" >&times;</span>
				  <font style = "font-size: 25px" color = "#fff">Egy erős jelszó tartalmaz:</font>
				  <img src = "css/pictures2/forgot_password.png" width = "41px" height = "41px"/>
				</div>
				<div class="modal-body">
					<ul>
						<li>Minimum <font color = "#AF8700"><b>8 karaktert</b></font></li>
						<li>Legalább egy <font color = "#AF8700"><b>kisbetűt</b></font></li>
						<li>Legalább egy <font color = "#AF8700"><b>nagybetűt</b></font></li>
						<li>Legalább egy <font color = "#AF8700"><b>számot</b></font></li>
						<li>Legalább egy <font color = "#AF8700"><b>különleges karaktert</b></font></li>
					</ul>
						Használjon <font color = "#AF8700"><b>különböző felhasználónevet és jelszót!</b></font></br>
						<font color = "#AF8700"><b>Kerülje el</b></font> az <font color = "#AF8700"><b>ismétlődéseket! </b></font> (pl.: aaaa, abcabc)
					
				</div>
				<div class="modal-footer">
				  <input type = "button" class = "backbutton" name = "back" value = "Vissza" style = "width: 95%; height: 36px;" id = "closeit" title = "Vissza a regisztrációs felülethez!">
				   <div style="text-align: center; height: 5px; background-color: #424242; width:100%;"></div>
				</div>
			  </div>
		</div>
		</br>
		<!-- Open to modal when click on the "Forgot password" button -->
		</body>
		<script>
		// Get the modal
			var modal = document.getElementById('myModal');
			// Get the button that opens the modal
			var btn = document.getElementById("openmodal");
			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("close")[0];
			// When the user clicks the button, open the modal 
			btn.onclick = function() {
				modal.style.display = "block";
			}
			// When the user clicks on <span> (x), close the modal
			span.onclick = function() {
				modal.style.display = "none";
			}
			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
			}
		</script>
</html>
	
	