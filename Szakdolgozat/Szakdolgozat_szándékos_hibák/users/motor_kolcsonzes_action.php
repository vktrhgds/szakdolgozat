<?php
	ob_start();
	include('functions.php');
	include('connection.php');	
	if($login_session == "CMRentadmin"){
		echo "<script type='text/javascript'>  window.location='../users/login.php'; </script>"; 
	}
	if(!isset($login_session)){
		echo "<script type='text/javascript'>  window.location='../users/login.php'; </script>";
	}	
?>


<!DOCTYPE html>
<html>
	<!--<meta http-equiv="refresh" content="10;url=logout.php" />-->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta HTTP-EQUIV="Content-Language" Content="hu">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../res/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel = "stylesheet" href = "../css/stylepage1.css"/>
	<link rel = "stylesheet" href = "../css/modal.css"/>
	<link rel = "stylesheet" href = "../css/user.css"/>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway:300" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
	rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	
	<head>
		<title>CMRent</title>
		<link type="text/css" rel="stylesheet" href="../css/style1.css"/>
		<script type="text/javascript" src="../javascript/jquery.js"></script>
		<script type="text/javascript" src="../javascript/passwordStrengthMeter.js"></script>
		<script type="text/javascript" src="../javascript/adminpage.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
							
	
	<script>
		function goBack() {
			window.history.back();
		}
	</script>
	
	<!-- body -->
	
	<body>
	<div id="bgStyle" style = "background: #EAE9E9;"></div>
	<style>
	#table:hover{
		border-bottom: 1px solid black;
		border-left: 1px solid black;
		border-top: 1px solid black;
		transition: 0ms;
	}
	</style>
		
			
			</br></br>

			<?php 
				$checkUser = "Select * from felhasznalo WHERE felhasznalo_nev = '".$login_session."'";
				$checkUser_query = mysqli_query($conn, $checkUser);
				$user = mysqli_fetch_assoc($checkUser_query);
				
				$motor_sql = "SELECT * FROM `motor` ORDER BY evjarat DESC";
				$motors = mysqli_query($conn, $motor_sql);
							
				$rowindex = 1;
				if (mysqli_num_rows($motors) > 0){
					while($row = mysqli_fetch_assoc($motors)){
						if(isset($_GET[$row['id']])){
							
							$login_session1 = $_GET['userhiddenmotor'];
							$rent_start_motor = $_GET['startdatehiddenmotor'];
							$rent_end_motor = $_GET['enddatehiddenmotor'];
							$daily_price_motor = $_GET['dailypricehiddenmotor'];
							$whole_price_motor = $_GET['wholepricehiddenmotor'];
							
							if($login_session1 != $login_session){
								$login_session1 = $login_session;
							}
							
							$today = date("Y-m-d");

							$motor_rent_sql = "INSERT INTO motorkolcsonzes
							(felhasznalo_nev, motor_id, mettol, meddig, ar_naponta, ar_osszesen) 
							VALUES('".$login_session1."','".$row['id']."', '".$rent_start_motor."', '".$rent_end_motor."', '".$daily_price_motor."', '".$whole_price_motor."');";
							
							mysqli_query($conn, $motor_rent_sql);
							$last_motor = mysqli_insert_id($conn);
							
							$getName = "SELECT * FROM motorkolcsonzes, felhasznalo WHERE felhasznalo.felhasznalo_nev
							= motorkolcsonzes.felhasznalo_nev AND motorkolcsonzes.id = '".$last_motor."'";
							$getName_query = mysqli_query($conn, $getName);
							$user_data = mysqli_fetch_assoc($getName_query);

							
							//email
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
							$mail->Subject = "Sikeres kölcsönzés - CMRent";
							$mail->Body = "Kedves ".$login_session."!
Köszönjük, hogy nálunk kölcsönözte ki motorját. Ez egy automatikusan generált üzenet, kérjük, ne válaszoljon rá.
A kölcsönzés adatai:
	Név: ".$user_data['vezetek_nev']." ".$user_data['kereszt_nev']."
	E-mail cím: ".$user_data['email']."
	Tel.szám: ".$user_data['telszam']."
		
Motor adatai:
	Márka: ".$row['motormarka_id']." ".$row['marka_tipus']."
	Szín: ".$row['motorszin']."
	Teljesítmény: ".$row['teljesitmeny']."
	Hengerűrtartalom: ".$row['hengerurtartalom']."
		
Lakcím adatok:
	".$user_data['ir_szam']." ".$user_data['varos'].", ".$user_data['utca']." ".$user_data['hazszam'].". 
		
Kölcsönzés adatai:
	Ár naponta: ".$user_data['ar_naponta']." Ft
	Végösszeg: ".$user_data['ar_osszesen']." Ft
	Kölcsönzés kezdete: ".$user_data['mettol']."
	Kölcsönzés vége: ".$user_data['meddig']."
	
Üdvözlettel, CMRent	";
							
							$email = $user_data['email'];
																	
							$mail->AddAddress("$email");

							if(!$mail->Send()) {
								echo "Mailer Error: " . $mail->ErrorInfo;
							}
								
								
								
							?>
							<table id = "carmotortable" style="border:0px solid white; 
								width: 80%; padding: 0%; margin-bottom: 0.5%; margin-left: 10%; margin-right: 10%; border-bottom: 1px solid #6E6E6E; background: #EAE9E9; color: white;" align = "center" cellspacing = "0" cellpadding = "0">
								<tr>
									<td width = "33.3%" bgcolor = "gray" style = "font-size: 25px; padding: 5px; border-right: 1px solid white; text-align: center"> <i class="fa fa-calendar"></i> Dátum választás</td>
									<td width = "33.3%" bgcolor = "gray" style = "font-size: 25px; padding-left: 10px; padding-right: 10px; border-right: 1px solid white; text-align: center"> <i class="fa fa-user"></i> Adatok ellenőrzése</td>
									<td width = "33.3%" bgcolor = "#46a32d" style = "font-size: 25px; padding-left: 10px; padding-right: 10px; text-align: center"> <i class="fa fa-shopping-cart"></i> Kölcsönzés</td>
								</tr>
								<tr>
								</tr>
									<td colspan = "3" style = "background: #46a32d; color: white; font-size: 38px; padding: 30px; padding-left: 120px; font-family: Arial, Helvetica, sans-serif;" ><i class="fa fa-shopping-cart"></i> Sikeres kölcsönzés!</td>
								<tr>
									<td colspan = "3" style = "color: black; font-size: 22px; padding-bottom: 20px; padding-left: 120px;font-family: Arial, Helvetica, sans-serif;" ></br></td>
								</tr>
								<tr>
									<td colspan = "3" style = "color: black; font-size: 22px; padding-bottom: 20px; padding-left: 120px;font-family: Arial, Helvetica, sans-serif;" >A kölcsönző fél adatai:</td>
								</tr>
								<tr>
									<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Felh.név</td>
									<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($user_data['felhasznalo_nev']); ?></td>
								</tr>
								<tr>
									<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Név</td>
									<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($user_data['vezetek_nev']).' '.htmlspecialchars($user_data['kereszt_nev']); ?> </td>
								</tr>
								<tr>
									<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >E-mail</td>
									<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($user_data['email']); ?> </td>
								</tr>
								<tr>
									<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Telefonszám</td>
									<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($user_data['telszam']); ?> </td>
								</tr>
								<tr>
									<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Anyja neve</td>
									<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($user_data['anyja_vnev']).' '.htmlspecialchars($user_data['anyja_knev']); ?> </td>
								</tr>
								<tr>
									<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Lakcím</td>
									<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($user_data['ir_szam']).' '.htmlspecialchars($user_data['varos']).', '.htmlspecialchars($user_data['utca']).' '.htmlspecialchars($user_data['hazszam']).'.';?> </td>
								</tr>
								<tr>
									<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Születési hely</td>
									<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($user_data['szuletesi_hely']); ?> </td>
								</tr>
								<tr>
									<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Születési idő</td>
									<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($user_data['szuletesi_ido']); ?> </td>
								</tr>
								<tr>
									<td colspan = "3" style = "color: black; font-size: 22px; padding-bottom: 20px; padding-top: 25px; padding-left: 120px;font-family: Arial, Helvetica, sans-serif;" >A kölcsönzés adatai:</td>
								</tr>
								<tr>
									<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Motor márkája</td>
									<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($row['motormarka_id']).' '.htmlspecialchars($row['marka_tipus']); ?> </td>
								</tr>
								<tr>
									<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Kölcsönzés kezdete</td>
									<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($user_data['mettol']); ?> </td>
								</tr>
								<tr>
									<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Kölcsönzés vége</td>
									<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($user_data['meddig']); ?> </td>
								</tr>
								<tr>
									<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Ár naponta</td>
									<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($user_data['ar_naponta']); ?> HUF </td>
								</tr>
								<tr>
									<td style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; padding-left: 220px;font-family: Arial, Helvetica, sans-serif;" >Végösszeg</td>
									<td colspan = "2" style = "border-bottom: 1px solid rgb(209, 209, 209); color: black; font-size: 18px; padding: 0px; text-align: left; padding-left: 0px;font-family: Arial, Helvetica, sans-serif;" ><?php echo htmlspecialchars($user_data['ar_osszesen']); ?> HUF</td>
								</tr>
								<tr>
									<td colspan = "3"style = "padding-left: 120px; padding-top: 40px; padding-bottom: 30px;">
										<a href = "index" style = "padding: 3px; padding-left: 5px; padding-right: 5px;border: 2px solid rgb(63, 125, 188);text-decoration: none; color: rgb(63, 125, 188); font-size: 20px; width: 70%; height: 33px;" title = "Vissza a főoldalra" >Vissza a főoldalra</a>
									</td>
								</tr>
							</table>
							
							<?php
							}
						}
					}
				?>
	</body>
</html>