

<?php 
	include('registration_connection.php');
?>


<!DOCTYPE html>
<html>

	<meta charset="UTF-8">
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
		<title>Regisztráció</title>
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
	
	<div class="tab">
	  <button class="tablinks" style = "width: 20%;" onclick="openTabs(event, 'Felhasznaloi_adatok')" id="defaultOpen">Felhasználói adatok <i class="fa fa-key" aria-hidden="true"></i></button>
	  <button class="tablinks" style = "width: 20%;" onclick="openTabs(event, 'Szemelyes_adatok')">Személyes adatok <i class="fa fa-user" aria-hidden="true"></i></button>
	  <button class="tablinks" style = "width: 20%;" onclick="openTabs(event, 'Lakcim_adatok')">Lakcím adatok <i class="fa fa-home" aria-hidden="true"></i></button>
	  <button class="tablinks" style = "width: 20%;" onclick="openTabs(event, 'Szuletesi_adatok')">Születési adatok <i class="fa fa-birthday-cake" aria-hidden="true"></i></button>
	  <button class="tablinks" style = "width: 20%;" onclick="openTabs(event, 'Regisztracio')">Regisztráció <i class="fa fa-user-plus" aria-hidden="true"></i></button>
	</div>
	
		<!-- Felhasználói adatok -->

		<div id="Felhasznaloi_adatok" class="tabcontent">
				</br>
				<div align = "center" style = "margin-bottom: -20px; z-index: 1;"id = "icons" >
					<img id = "icons"id="logo" src="../res/signup.png" alt="logo" style = "width: 120px; height: 120px;" />
				</div>
				<div width = "44%" align = "center" style = "margin-bottom: -22px; z-index: 1;" id = "divMovrepo">
				
				</div>
				
				<div align = "center" width = "100%">
					<form method = "POST" action = "sign_up_action.php" enctype = "multipart/form-data" name = "registrationform">
					<table cellspacing = "0" cellpadding = "0" id = "logintable" align = "center" width = "44%" 
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
							<td height = "40px" align = "left" style =" padding: 20px 0px 20px 30px;" colspan = "2" title = "Töltsön ki minden mezőt!"><b><font size = "6">Regisztráció</font></b>
							<img src = "../css/pictures2/sign_up_icon.png" width = "32px" height = "32px"/>
							</font>
							</td>
							
						</tr>
						<tr>
							<td width = "100%" height = "30px"  align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Felhasználónév
								<input type = "text" class = "input" name= "username" id="username" required 
								pattern=".{8,32}" title="Minimum 8, maximum 32 karakter lehet a jelszó." />
							</td>
						</tr>
						<tr>
							<td width = "100%" height = "30px" align = "left"  style =" padding: 10px 0px 0px 30px; font-size: 22px;">Jelszó
								<input type ="button" id = "openpassmodal" value = "?" title = ""></input>
								<div class="inbox">
								 <div class="graybar" id="graybar"></div>
								 <div class="colorbar" id="colorbar"> 
									<span class="percent" id="percent">0%</span>
								</div>
								<span class="result" id='result'><font color = "red">Minimum 8 karakter</font></span>
								</div>
								<input type = "password" class = "input" name = "password" id="password" 
								pattern=".{8,32}" title="Minimum 8, maximum 32 karakter lehet a jelszó." required ></input>
							</td>
						</tr>
						<tr>
							<td width = "50%" height = "30px" align = "left" style =" padding: 10px 0px 0px 30px; font-size: 22px;">Jelszó újra</br>
								<input type = "password" class = "input" name = "jelszo_ujra" id = "jelszo_ujra" 
								pattern=".{8,32}" title="Minimum 8, maximum 32 karakter lehet a jelszó."  required />
							</td>
						</tr>
						<tr>
							<td width = "50%" height = "30px" align = "left" style =" padding: 10px 0px 0px 30px; font-size: 22px;">E-mail</br>
								<input type = "email" class = "input" name = "email" id = "email" title = "" required />
							</td>
						</tr>
						<tr>
							<td width = "50%" height = "40px" align = "left" style =" padding: 20px 20px 5px 35px; font-size: 21px;">Rendelkezik már fiókkal?
								<input type = "button" title = "" onclick = "location.href='login.php';" class = "sign_in" style = "width: 97%;"
								value = "  Tovább a bejelentkezésre"/>
							</td>
						</tr>
						</table>
					</div>
			</div>
			
			
			<!-- Személyes adatok -->
			
			<div id="Szemelyes_adatok" class="tabcontent">
				</br>
				<div align = "center" style = "margin-bottom: -20px; z-index: 1;"id = "icons" >
					<img id = "icons"id="logo" src="../res/signup.png" alt="logo" style = "width: 120px; height: 120px;" />
				</div>
				<div width = "44%" align = "center" style = "margin-bottom: -22px; z-index: 1;" id = "divMovrepo">
				
				</div>
				
				<div align = "center" width = "100%">
					<table cellspacing = "0" cellpadding = "0" id = "logintable" align = "center" width = "44%" 
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
							<td height = "40px" align = "left" style =" padding: 20px 0px 20px 30px;" colspan = "2" title = "Töltsön ki minden mezőt!"><b><font size = "6">Regisztráció</font></b>
							<img src = "../css/pictures2/sign_up_icon.png" width = "32px" height = "32px"/>
							</font>
							</td>
							
						</tr>
						<tr>
							<td width = "100%" height = "30px"  align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Vezetéknév
								<input type = "text" class = "input" name= "vezeteknev" id="vezeteknev" required />
							</td>
						</tr>
						<tr>
							<td width = "100%" height = "30px"  align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Keresztnév
								<input type = "text" class = "input" name= "keresztnev" id="keresztnev" required />
							</td>
						</tr>
						<tr>
							<td width = "100%" height = "30px"  align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Személyi igazolványszám
								<input type = "text" class = "input" name= "szigszam" id="szigszam" required 
								pattern=".{9,9}" title="A személyi igazolványszám 9 karakter hosszú."/>
							</td>
						</tr>
						<tr>
							<td width = "100%" height = "30px"  align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Anyja vezetékneve
								<input type = "text" class = "input" name= "anyja_vezeteknev" id="anyja_vezeteknev" required />
							</td>
						</tr>
						<tr>
							<td width = "100%" height = "30px"  align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Anyja keresztneve
								<input type = "text" class = "input" name= "anyja_keresztnev" id="anyja_keresztnev" required />
							</td>
						</tr>
						<tr>
							<td width = "100%" height = "30px"  align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Telefonszám
								<input type = "tel" class = "input" name= "tel" id="tel" required/>
							</td>
						</tr>
						<tr>
							<td width = "50%" height = "40px" align = "left" style =" padding: 20px 20px 5px 35px; font-size: 21px;">Rendelkezik már fiókkal?
								<input type = "button" title = "" onclick = "location.href='login.php';" class = "sign_in" style = "width: 97%;"
								value = "  Tovább a bejelentkezésre"/>
							</td>
						</tr>
						</table>
					</div>
					</br>
				</div>
				
				
				<!-- Lakcím adatok -->
				
				<div id="Lakcim_adatok" class="tabcontent">
				</br>
				<div align = "center" style = "margin-bottom: -20px; z-index: 1;"id = "icons" >
					<img id = "icons"id="logo" src="../res/signup.png" alt="logo" style = "width: 120px; height: 120px;" />
				</div>
				<div width = "44%" align = "center" style = "margin-bottom: -22px; z-index: 1;" id = "divMovrepo">
				
				</div>
				
				<div align = "center" width = "100%">
					<table cellspacing = "0" cellpadding = "0" id = "logintable" align = "center" width = "44%" 
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
							<td height = "40px" align = "left" style =" padding: 20px 0px 20px 30px;" colspan = "2" title = "Töltsön ki minden mezőt!"><b><font size = "6">Regisztráció</font></b>
							<img src = "../css/pictures2/sign_up_icon.png" width = "32px" height = "32px"/>
							</font>
							</td>
							
						</tr>
						<tr>
							<td width = "100%" height = "30px"  align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Irányítószám
								<input type = "number" class = "input" name= "irszam" id="irszam" max = "500000"required />
							</td>
						</tr>
						<tr>
							<td width = "100%" height = "30px"  align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Város
								<input type = "text" class = "input" name= "varos" id="varos" required />
							</td>
						</tr>
						<tr>
							<td width = "100%" height = "30px"  align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Utca, tér, sugárút, körút, köz
								<input type = "text" class = "input" name= "utca" id="utca" required />
							</td>
						</tr>
						<tr>
							<td width = "100%" height = "30px"  align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Házszám
								<input type = "number" class = "input" name= "hazszam" id="hazszam" max = "500000" required />
							</td>
						</tr>
						<tr>
							<td width = "50%" height = "40px" align = "left" style =" padding: 20px 20px 5px 35px; font-size: 21px;">Rendelkezik már fiókkal?
								<input type = "button" title = "" onclick = "location.href='login.php';" class = "sign_in" style = "width: 97%;"
								value = "  Tovább a bejelentkezésre"/>
							</td>
						</tr>
						</table>
					</div>
					</br>
				</div>
				
				
				<!-- Születési adatok -->
				
				<div id="Szuletesi_adatok" class="tabcontent">
				</br>
				<div align = "center" style = "margin-bottom: -20px; z-index: 1;"id = "icons" >
					<img id = "icons"id="logo" src="../res/signup.png" alt="logo" style = "width: 120px; height: 120px;" />
				</div>
				<div width = "44%" align = "center" style = "margin-bottom: -22px; z-index: 1;" id = "divMovrepo">
				
				</div>
				<div align = "center" width = "100%">
					<table cellspacing = "0" cellpadding = "0" id = "logintable" align = "center" width = "44%" 
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
							<td height = "40px" align = "left" style =" padding: 20px 0px 20px 30px;" colspan = "2" title = "Töltsön ki minden mezőt!"><b><font size = "6">Regisztráció</font></b>
							<img src = "../css/pictures2/sign_up_icon.png" width = "32px" height = "32px"/>
							</font>
							</td>
							
						</tr>
						<tr>
							<td width = "100%" height = "30px"  align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Születési hely
								<input type = "text" class = "input" name= "szul_hely" id="szul_hely" required />
							</td>
						</tr>
						<tr>
							<td width = "100%" height = "30px"  align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Születési idő
								<input type = "date" class = "input" name= "szul_ido" id="szul_ido" required />
							</td>
						</tr>
						<tr>
							<td width = "50%" height = "40px" align = "left" style =" padding: 20px 20px 5px 35px; font-size: 21px;">Rendelkezik már fiókkal?
								<input type = "button" title = "" onclick = "location.href='login.php';" class = "sign_in" style = "width: 97%;"
								value = "  Tovább a bejelentkezésre"/>
							</td>
						</tr>
						</table>
					</div>
					</br>
				</div>
				
				
			<!-- regisztráció véglegesítése -->
			<div id="Regisztracio" class="tabcontent">
				</br>
				<div align = "center" style = "margin-bottom: -20px; z-index: 1;"id = "icons" >
					<img id = "icons"id="logo" src="../res/signup.png" alt="logo" style = "width: 120px; height: 120px;" />
				</div>
				<div width = "44%" align = "center" style = "margin-bottom: -22px; z-index: 1;" id = "divMovrepo">
				
				</div>
				<div align = "center" width = "100%">
					<table cellspacing = "0" cellpadding = "0" id = "logintable" align = "center" width = "44%" 
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
							<td height = "40px" align = "left" style =" padding: 20px 0px 20px 30px;" colspan = "2" title = "Töltsön ki minden mezőt!"><b><font size = "6">Regisztráció</font></b>
							<img src = "../css/pictures2/sign_up_icon.png" width = "32px" height = "32px"/>
							</font>
							</td>
							
						</tr>
						<tr>
							<td width = "100%" height = "30px"  align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Válassza ki a biztonsági kérdését
								  <select class = "select" style = "font-size: 20px;" name = "biztonsagikerdesek">
								  <?php
									 
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
							</td>
						</tr>
						<tr>
							<td width = "100%" height = "30px"  align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Válasz
								<input type = "text" class = "input" name= "valasz" id="valasz" required 
								pattern=".{1,50}" title="Minimum 1, maximum 50 karakter lehet a biztonsági válasz."/>
							</td>
						</tr>
						<tr>
							<td width = "100%" height = "30px"  align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">
								</br>
							</td>
						</tr>
						<tr>
							<td width = "100%" height = "30px"  align = "left" style =" padding: 5px 0px 0px 30px; font-size: 22px;">Elolvastam, és elfogadom a felhasználói feltételeket.
								  <input type="checkbox" style = "height: 24px; width: 24px;" required />					
							</td>
						</tr>
						<tr>
							<td style="padding: 0px 38px 0px 30px;" colspan = "2">
								<input type = "submit" class = "input" name = "signup" value = "Regisztráció" />
							</td>
						</tr>
						<tr>
							<td width = "50%" height = "40px" align = "left" style =" padding: 20px 20px 5px 35px; font-size: 21px;">Rendelkezik már fiókkal?
								<input type = "button" title = "" onclick = "location.href='login.php';" class = "sign_in" style = "width: 97%;"
								value = "  Tovább a bejelentkezésre"/>
							</td>
						</tr>
						</table>
					</div>
					</br>
				</div>
			</form>
				
				
				
			<!-- megjelenik, ha rákattintunk a kérdőjelre a jelszó után -->
			
			<div id="myModal" class="modal" style = "z-index: 1;">
			  <!-- Modal content -->
			  <div class="modal-content">
				<div class="modal-header" style = "font-family: Arial;">
				  <span class="close" title = "Close" >&times;</span>
				  <font style = "font-size: 25px" color = "#fff">Egy erős jelszó tartalmaz:</font>
				  <img src = "../css/pictures2/forgot_password.png" width = "41px" height = "41px"/>
				</div>
				<div class="modal-body" style = "font-family: Arial;">
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
		
		</body>
		
		<script>
		// Get the modal
			var modal = document.getElementById('myModal');
			var closebtn = document.getElementById("closeit");
			// Get the button that opens the modal
			var btn = document.getElementById("openpassmodal");
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
			
			//click on "Go back" button
			closebtn.onclick = function(){
				modal.style.display = "none";
			}
			
			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
			}
		</script>
		
		
		<script>
			function openTabs(evt, cityName) {
				var i, tabcontent, tablinks;
				tabcontent = document.getElementsByClassName("tabcontent");
				for (i = 0; i < tabcontent.length; i++) {
					tabcontent[i].style.display = "none";
				}
				tablinks = document.getElementsByClassName("tablinks");
				for (i = 0; i < tablinks.length; i++) {
					tablinks[i].className = tablinks[i].className.replace(" active", "");
				}
				document.getElementById(cityName).style.display = "block";
				evt.currentTarget.className += " active";
			}

			// Get the element with id="defaultOpen" and click on it
			document.getElementById("defaultOpen").click();
		</script>
</html>