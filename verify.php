<?php 
session_start();

$login_password = 'SuperUser';

$conn = new PDO("sqlsrv:Server=MS00, 1488;Database=BetBookingMaster", "Josip", "Gal!leja123*");

$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

$err = 0;

if(!isset($_POST['password']) || strlen(trim($_POST['password'])) == 0){
	$err++;
}


if($err == 0){
	
	if($login_password == $_POST['password']){
		echo "uspeshno logiran!";
		$_SESSION['logged_in'] = TRUE;

		header('location: admin.php');
	}else{
		//echo "nema takov korisnik....";
		header('location: index.php?err=1');
	}
}else{	
	header('location: index.php?err=1');
}


 ?>