<?php
// Ce fichier connect.inc.php sera inclus dans
// chaque page PHP qui travaille avec la BD
$user = "";
$pass = "";

try {
	$conn = new PDO
	('mysql:host=localhost;dbname=;
	charset=UTF8',$user, $pass);
}
catch (PDOException $e) {
	echo "Erreur: ".$e->getMessage()."<br>";
	die();
}
?>