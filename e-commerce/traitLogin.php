<?php
if(!isset($_POST['isSubbed'])){
    header('location:formLogin.php');
}
else {
    require_once("includes/connect.inc.php");

	$mdp_client_a_verifier = $_POST['mdpUtil'];
    $emailClient = $_POST['mailUtil'];

    $reqVerif = "SELECT idClient,motpasseclient FROM Client WHERE mailClient=$emailClient";

    $verifMail =  oci_parse($connect, $reqVerif);

    $resultVerif = oci_execute($verifMail);
    if (!$resultVerif) {
    	$e = oci_error($resultVerif);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
		print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);	
    } else {
    	$statementBD = oci_fetch_assoc($resultVerif));
    	if(empty($statementBD){
    		header('location:formLogin.php?msgErreur=Compte inexistant');
    	}
    	if (password_verify($mdp_client_a_verifier, $statementBD['motpasseclient'])) {
    		session_start();
    		$_SESSION['idClientIdentifie'] = $statementBD['idclient'];
    		header('location:index.php'):
    	}
    }    
}

?>