<?php

// =========================================
// Page de traitement du formulaire de login
// =========================================

// si le formulaire n'a pas été soumis, on redirige vers la page de login
if(!isset($_POST['isSubbed'])){
    header('location:formLogin.php');
}
else {
	// on se connecte à la base de données
    require_once("includes/connect.inc.php");

	// on récupère les données du formulaire
	$mdp_client_a_verifier = $_POST['mdpUtil'];
    $emailClient = $_POST['mailUtil'];

	// création de la requete
    $reqVerif = "SELECT idClient, motpasseclient FROM Client WHERE mailClient=:pMail";

	// on prépare la requete
    $verifMail =  oci_parse($connect, $reqVerif);

    oci_bind_by_name($verifMail, ":pMail", $emailClient);

	// on execute la requete
    $resultVerif = oci_execute($verifMail);

	// si la requete n'a pas pu être executée, on affiche l'erreur
    if (!$resultVerif) {
    	$e = oci_error($resultVerif);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
		print htmlentities($e['message']. ' pour cette requete : ' .$e['sqltext']);	
    } else {
    	$statementBD = oci_fetch_assoc($resultVerif);

		// vérification de l'existance du compte
    	if(empty($statementBD)){
    		header('location:formLogin.php?msgErreur=Compte inexistant');
    	}

		// vérification du mot de passe
    	if (password_verify($mdp_client_a_verifier, $statementBD['motpasseclient'])) {
    		session_start(); // démarre la session
    		$_SESSION['idClientIdentifie'] = $statementBD['idclient']; // on stocke l'id du client dans la session
    		header('location:index.php'); // on redirige vers la page d'accueil
    	}
    } 
}

?>