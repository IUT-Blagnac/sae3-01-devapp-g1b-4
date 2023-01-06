<?php
if(isset($_POST['sub'])){
	require('includes/connect.inc.php');
	$qteSelectionne = $_POST['quantiteSelectionne'];
	$idArticle = $_POST['idProduit'];
	session_start();
	if(isset($_SESSION['idClientIdentifie'])){
		//sql
		/*
		recuperer prix produit
		recuperer idpanier
		si panier deja existant
			si produit deja dans panier
				update de quantitepanier
			sinon
				insert produit dans quantitepanier
		sinon
			insert panier dans panier en recuperant idpanier crée
			insert produit dans quantitepanier
		*/
	    //recuperer prix produit
	    	$req_prix_produit = "SELECT PRIXPRODUIT FROM PRODUIT WHERE IDPRODUIT=:p_PRIX_ID_PRODUIT";

	    	$prix_produit = oci_parse($connect, $req_prix_produit);

	    	oci_bind_by_name($prix_produit, ":p_PRIX_ID_PRODUIT", $idArticle);

	    	$result_prix_produit = oci_execute($prix_produit);

	    	if (!$result_prix_produit) {
		        $e = oci_error($result_prix_produit);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
		        print htmlentities($e['message']. ' pour cette requete : ' .$e['sqltext']);
	    	} else {
	    		$statementBD_prix_produit = oci_fetch_assoc($prix_produit);
	    		$prix_qte_produit = $qteSelectionne * $statementBD_prix_produit['PRIXPRODUIT'];
	    	}
	    //fin recuperer prix produit
	//---------------------------------------------------------
		//recuperer id panier
			$identifiantClient = $_SESSION['idClientIdentifie'];
			$req_is_panier = "SELECT IDPANIER FROM PANIER WHERE IDCLIENT = :pIDCLIENT";

			$is_panier = oci_parse($connect, $req_is_panier);

			oci_bind_by_name($is_panier, ":pIDCLIENT", $identifiantClient);

			$result_is_panier = oci_execute($is_panier);

			if (!$result_is_panier) {
		        $e = oci_error($result_is_panier);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
		        print htmlentities($e['message']. ' pour cette requete : ' .$e['sqltext']);
	    	} else {
	    		$statementBD_is_panier = oci_fetch_assoc($is_panier);
	    	}
	    //fin recuperer id panier
	//---------------------------------------------------------
	    //si panier deja existant
	    	if($statementBD_is_panier != 1){
	    		//si article deja dans panier
		    		$req_is_already_in_cart  = "SELECT IDPRODUIT FROM QUANTITEPANIER WHERE IDPANIER = :pID_PANIER_is_in_cart AND IDPRODUIT = :pID_PRODUIT_is_in_cart";

		    		$is_already_in_cart = oci_parse($connect, $req_is_already_in_cart);

		    		oci_bind_by_name($is_already_in_cart, ":pID_PANIER_is_in_cart", $statementBD_is_panier['IDPANIER']);
		    		oci_bind_by_name($is_already_in_cart, ":pID_PRODUIT_is_in_cart", $idArticle);

		    		$result_is_already_in_cart = oci_execute($is_already_in_cart);

		    		if (!$result_is_already_in_cart) {
				        $e = oci_error($result_is_already_in_cart);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
				        print htmlentities($e['message']. ' pour cette requete : ' .$e['sqltext']);
			    	} else {
			    		$statementBD_is_already_in_cart = oci_fetch_assoc($is_already_in_cart);
			    		if ($statementBD_is_already_in_cart != 1) {
			    			$req_update_already_in_cart = "UPDATE QUANTITEPANIER SET NBPRODUIT = NBPRODUIT+:pNOMBRE_PRODUIT_ALREADY_IN_CART WHERE IDPANIER = :pID_PANIER_ALREADY_IN_CART";

			    			$update_already_in_cart = oci_parse($connect, $req_update_already_in_cart);

			    			oci_bind_by_name($update_already_in_cart, ":pNOMBRE_PRODUIT_ALREADY_IN_CART", $qteSelectionne);
			    			oci_bind_by_name($update_already_in_cart, ":pID_PANIER_ALREADY_IN_CART", $statementBD_is_panier['IDPANIER']);

			    			$result_update_already_in_cart = oci_execute($update_already_in_cart);

			    			oci_commit($connect);

							oci_free_statement($update_already_in_cart);
			    		}
			    	}
	    		//fin si article deja dans panier
			//----------------------------------------------------------
	    		//si article PAS deja dans panier
		    		$reqInsertQuantitePanier = "INSERT INTO QUANTITEPANIER(IDPANIER, IDPRODUIT, NBPRODUIT, PRIXQTEPRODUIT) VALUES(:pID_PANIER, :pID_PRODUIT, :pNB_PRODUIT, :pPRIX_QTEPRODUIT)";

		    		$insert_qte_panier = oci_parse($connect, $reqInsertQuantitePanier);

		    		oci_bind_by_name($insert_qte_panier, ":pID_PANIER", $statementBD_is_panier['IDPANIER']);
		    		oci_bind_by_name($insert_qte_panier, ":pID_PRODUIT", $idArticle);
		    		oci_bind_by_name($insert_qte_panier, ":pNB_PRODUIT", $qteSelectionne);
		    		oci_bind_by_name($insert_qte_panier, ":pPRIX_QTEPRODUIT", $prix_qte_produit);

		    		$result_insert_qtepanier = oci_execute($insert_qte_panier);

		    		if (!$result_insert_qtepanier) {
				        $e = oci_error($result_insert_qtepanier);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
				        print htmlentities($e['message']. ' pour cette requete : ' .$e['sqltext']);
			    	}

			    	oci_commit($connect);

					oci_free_statement($insert_qte_panier);
				//fin si article PAS deja dans panier
	    	}
	    //fin si panier deja existant
	    //sinon
			else{
				$idPanier_returned = 0;

				$reqInsertPanier = "INSERT INTO PANIER(IDCLIENT, PRIXPANIER) VALUES(:pID_CLIENT, 0) RETURNING IDPANIER INTO :IDPANIER_RETURNED";

				$insert_panier = oci_parse($connect, $reqInsertQuantitePanier);

				oci_bind_by_name($insert_panier, ":pID_CLIENT", $_SESSION['idClientIdentifie']);
				oci_bind_by_name($insert_panier, ":IDPANIER_RETURNED", $idPanier_returned);

				$result_insert_panier = oci_execute($insert_panier);

				if (!$result_insert_panier) {
			        $e = oci_error($result_insert_panier);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
			        print htmlentities($e['message']. ' pour cette requete : ' .$e['sqltext']);
		    	}
		    	oci_commit($connect);

				oci_free_statement($insert_panier);

				//idem que l.52 à 66 sauf qu'on utilise les nouvelles variables d'au dessus
				$reqInsertQuantitePanier = "INSERT INTO QUANTITEPANIER(IDPANIER, IDPRODUIT, NBPRODUIT, PRIXQTEPRODUIT) VALUES(:pID_PANIER, :pID_PRODUIT, :pNB_PRODUIT, :pPRIX_QTEPRODUIT)";

	    		$insert_qte_panier_inexistant = oci_parse($connect, $reqInsertQuantitePanier);

	    		oci_bind_by_name($insert_qte_panier_inexistant, ":pID_PANIER", $idPanier_returned);
	    		oci_bind_by_name($insert_qte_panier_inexistant, ":pID_PRODUIT", $idArticle);
	    		oci_bind_by_name($insert_qte_panier_inexistant, ":pNB_PRODUIT", $qteSelectionne);
	    		oci_bind_by_name($insert_qte_panier_inexistant, ":pPRIX_QTEPRODUIT", $prix_qte_produit);

	    		$result_insert_qtepanier_inexistant = oci_execute($insert_qte_panier_inexistant_inexistant);

	    		if (!$result_insert_qtepanier_inexistant) {
			        $e = oci_error($result_insert_qtepanier_inexistant);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
			        print htmlentities($e['message']. ' pour cette requete : ' .$e['sqltext']);
		    	}

		    	oci_commit($connect);

				oci_free_statement($insert_qte_panier_inexistant);
			}
	}
	else{
		//cookie
		/*
			si cookie de panier existe deja
				recherche produit deja dans panier
				si produit deja dans panier
					setcookie en ajoutant seulement la nouvelle qte
				sinon
					setcookie en ajoutant produit,qte,prixqte
			sinon
				setcookie en creant avec produit,qte,prixqte

		$newArray_tempPanier = array('' => , );
		*/
		if (isset($_COOKIE['tempPanier'])) {
			$oldArray_tempPanier = $_COOKIE['tempPanier'];
			$isFound = false;
			//$newArray_tempPanier = $oldArray_tempPanier;
			foreach ($oldArray_tempPanier as $key => $value) {
				if ($value['idProduit'] == $idArticle) {
					$value['idProduit'] = $value['idProduit'] + $qteSelectionne;
					$isFound = true;
					break;
				}
			}
		}
		setcookie(tempPanier)
	}
}
else{
	header('location:index.php');
}
?>