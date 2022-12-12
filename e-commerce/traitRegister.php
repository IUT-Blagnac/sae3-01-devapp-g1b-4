<?php
if(!isset($_POST['isSubbed'])){
    header('location:formLogin.php');
}
/**
 *⚠ ATTENTION ⚠
 *
 *	LES NOMS DE COLONNES DE LA
 *	BD SONT THEORIQUES
 *	CE CODE NE MARCHE PAS EN 
 *	TANT QUE TEL
 *
 *⚠⚠⚠⚠⚠⚠⚠
*/
else {
	require_once("include/connect.inc.php");


	$mdp_client_hashed = password_hash($_POST['mdpUtil'], PASSWORD_DEFAULT);
    $nomClient = $_POST['nomUtil'];
    $prenomClient = $_POST['prenomUtil'];
    $emailClient = $_POST['mailUtil'];
    $idC = 0;

    $reqInsert = "INSERT INTO Client(nom, prenom, email, passowrd) VALUES(:pNom, :pPrenom, :pEmail, :pPassword) RETURNING idClient INTO :idC";

    $insertClient = oci_parse($connect, $reqInsert);

    oci_bind_by_name($insertClient, ":pNom", $nomClient);
    oci_bind_by_name($insertClient, ":pPrenom", $prenomClient);
    oci_bind_by_name($insertClient, ":pEmail", $emailClient);
    oci_bind_by_name($insertClient, ":pPassword", $mdp_client_hashed);
    oci_bind_by_name($insertClient, ":idC", $idC);

    $result = oci_execute($insertClient);

    if (!$result) {
		$e = oci_error($insertClient);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
		print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);		
	}

	oci_commit($connect);

	oci_free_statement($insertClient);

	session_start();

	$_SESSION['idClientIdentifie'] = $idC;

	header('location:index.php');
}

?>