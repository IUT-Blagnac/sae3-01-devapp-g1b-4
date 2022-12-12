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

	$mdp_client_a_verifier = $_POST['mdpUtil']
    $emailClient = $_POST['mailUtil'];

    $reqVerif = "SELECT idClient,password FROM Client WHERE emailClient=$emailClient";

    $verifMail =  oci_parse($connect, $reqVerif);

    $resultVerif = oci_execute($verifMail);
    if (!$resultVerif) {
    	$e = oci_error($resultVerif);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
		print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);	
    } else {
    	$statementBD = oci_fetch_assoc($resultVerif));
    	if(empty($pwdBD){
    		header('location:formLogin.php?msgErreur=Compte inexistant');
    	}
    	if (password_verify($mdp_client_a_verifier, $statementBD['password'])) {
    		session_start();
    		$_SESSION['idClientIdentifie'] = $statementBD['idClient'];
    		header('location:index.php'):
    	}
    }    
}

?>