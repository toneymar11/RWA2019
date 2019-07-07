<?php

include 'config.php';

$ime = $_POST["ime"];
$prezime = $_POST["prezime"];
$adresa = $_POST["adresa"];
$grad = $_POST["grad"];
$broj = $_POST["broj"];
$email = $_POST["email"];
$lozinka = $_POST["lozinka"];
if(isset($_POST['rola'])){
   $rola= 0; 
}
else{
    $rola=1;
}

if($mysqli->query("INSERT INTO korisnik (ime, prezime, email, lozinka, adresa,grad,broj,rola) VALUES('$ime', '$prezime', '$email', '$lozinka', '$adresa', '$grad', '$broj','$rola')")){
	echo 'Podaci unešeni';
	echo '<br/>';
}

header("location:profile.php?showusers=1")

?>