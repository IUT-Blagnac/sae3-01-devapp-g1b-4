<?php
	error_reporting(0);
	session_start();
	if (isset($_SESSION['idClientTransiting'])) {
		require('includes/connect.inc.php');
		$arrayTempPanier = json_decode($_COOKIE['tempPanier'], true);


		$reqSelPanier = "SELECT idproduit, NBPRODUIT, PRIXQTEPRODUIT FROM QUANTITEPANIER INNER JOIN PANIER ON QUANTITEPANIER.IDPANIER=PANIER.IDPANIER WHERE PANIER.IDCLIENT = :pIDclient";
		$sel_panier = oci_parse($connect, $reqSelPanier);
		oci_bind_by_name($sel_panier, ":pIDclient", $_SESSION['idClientTransiting']);
		$resultSelPanier = oci_execute($sel_panier);
		if(!$resultSelPanier){
			$e = oci_error($resultSelPanier);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
			print htmlentities($e['message']. ' pour cette requete : ' .$e['sqltext']);
		} else{
			//contient la premiere ligne du resultat de la requete
			//si des valeurs sont attribuees alors la requete
			//a renvoye un resultat non vide
			$statementBD_selPanier = oci_fetch_assoc($sel_panier);
			if (!isset($statementBD_selPanier['IDPRODUIT'])) {
				//transfert du panier cookie vers panier bd puisque panier BD inexistant
				$idpanier_returned = 0;
				$reqInsertPanier = "INSERT INTO PANIER(IDPANIER, IDCLIENT, PRIXPANIER) VALUES(SEQIDPANIER.nextval, :pID_CLIENT, 0) RETURNING IDPANIER INTO :IDPANIER_RETURNED";
				$insertPanier = oci_parse($connect, $reqInsertPanier);
				oci_bind_by_name($insertPanier, ":pID_CLIENT", $_SESSION['idClientTransiting']);
				oci_bind_by_name($insertPanier, ":IDPANIER_RETURNED", $idpanier_returned);
				$resultInsertPanier = oci_execute($insertPanier);
				if (!$resultInsertPanier) {
						$e = oci_error($result_insert_panier);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
						print htmlentities($e['message']. ' pour cette requete : ' .$e['sqltext']);
				}
				oci_commit($connect);

				oci_free_statement($insertPanier);

				$reqInsertProduit = "INSERT INTO QUANTITEPANIER(IDPANIER, IDPRODUIT, NBPRODUIT, PRIXQTEPRODUIT) VALUES(:pID_PANIER, :pID_PRODUIT, :pNB_PRODUIT, :pPRIX_QTEPRODUIT)";

				$insert_produit = oci_parse($connect, $reqInsertProduit);

				foreach ($arrayTempPanier as $value) {
					oci_bind_by_name($insert_produit, ":pID_PANIER", $idpanier_returned);
					oci_bind_by_name($insert_produit, ":pID_PRODUIT", $value['idProduit']);
					oci_bind_by_name($insert_produit, ":pNB_PRODUIT", $value['qteProduit']);
					oci_bind_by_name($insert_produit, ":pPRIX_QTEPRODUIT", $value['qtePrixProduit']);

					$result_insertProduit = oci_execute($insert_produit);
					if (!$result_insertProduit) {
						$e = oci_error($result_insert_panier);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
						print htmlentities($e['message']. ' pour cette requete : ' .$e['sqltext']);
					} else{
						oci_commit($connect);
						oci_free_statement($insert_produit);
					}
				}
			}
			else{
		}

?>
				<!DOCTYPE html>
				<html lang="fr">

				<head>
				    <meta charset="UTF-8">
				    <meta http-equiv="X-UA-Compatible" content="IE=edge">
				    <meta name="viewport" content="width=device-width, initial-scale=1.0">
				    <title>BlueGym - dev</title>
				    <link rel="stylesheet" href="includes/bootstrap/css/bootstrap.min.css">
				    <link rel="stylesheet" href="assets/css/main.css">
				</head>

				<body>
				    <?php include('includes/header.php'); ?>


				    <div class="container mt-5">
				        <div class="row d-flex justify-content-center">
				            <div class="col-4 text-left">

				                <h1 class="fw-semibold text-center">Connexion</h1>
				                <p class="text-muted">Si vous possédez déjà un compte sur notre site vous pouvez vous connecter avec vos identifiants. </p>

				                <?php
					                // if GET msgErreur is set, display the error message
					                if (isset($_GET['msgErreur'])) {
					                    echo '
					                    <div class="alert alert-danger" role="alert">
					                        ' . $_GET['msgErreur'] . '
					                    </div>';
					                }
				                ?>

				                <!--Tableau panier cookie-->
				                <table>
				                	<caption>Panier déconnecté</caption>
				                	<thead>
				                		<tr>
				                			<th>
				                				Nom du produit
				                			</th>
				                			<th>
				                				Quantité sélectionné
				                			</th>
				                			<th>
				                				Total
				                			</th>
				                		</tr>
				                	</thead>
				                	<tbody>
				                		<?php
				                			/*
				                			ce tableau n'est pas directement utilisable pour
											de l'affichage, il faut donc aller chercher les noms
											des produits sur la BD
											*/
											$reqSelNomProduit = "";
											$sel_NomProduit = oci_parse($connect, $reqSelNomProduit);
				                			foreach ($arrayTempPanier as $unProduit) {
				                				oci_bind_by_name($sel_NomProduit, ":pIDProduit_np", $unProduit['idProduit']);
				                				$result_sel_NomProduit = oci_execute($sel_NomProduit);
				                				if(!$result_sel_NomProduit){
				                					$e = oci_error($sel_NomProduit);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
													print htmlentities($e['message']. ' pour cette requete : ' .$e['sqltext']);
				                				}
				                				else{
				                					$statementBD_selNomProduit = oci_fetch_assoc($sel_NomProduit);
				                				}
				                				echo "<tr><td>".$statementBD_selNomProduit['NOMP']."</td><td>".$unProduit['qteProduit']."</td><td>".$unProduit['qtePrixProduit']."</td></tr>";
				                			}
				                		?>
				                	</tbody>
				                </table>
				                <!--Tableau panier BD-->
				                <table>
				                	<caption>Panier connecté</caption>
				                	<thead>
				                		<tr>
				                			<th>
				                				Nom du produit
				                			</th>
				                			<th>
				                				Quantité sélectionné
				                			</th>
				                			<th>
				                				Total
				                			</th>
				                		</tr>
				                	</thead>
				                	<tbody>
				                		<?php
				                			$reqSelNomProduitBD = "SELECT NOMP FROM PRODUIT WHERE IDPRODUIT = :pIDProduit_npBD";
				                			$sel_NomProduitBD = oci_parse($connect, $reqSelNomProduitBD);
				                			oci_bind_by_name($sel_NomProduitBD, ":pIDProduit_npBD", $statementBD_selPanier['IDPRODUIT']);
				                			$result_sel_NomProduitBD = oci_execute($sel_NomProduitBD);
				                			if(!$result_sel_NomProduitBD){
				                				$e = oci_error($sel_NomProduitBD);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
												print htmlentities($e['message']. ' pour cette requete : ' .$e['sqltext']);
				                			}
				                			else{
				                				/*
				                				oblige de le faire en 2 fois puisque on a du recuperer une ligne
				                				en haut pour verifier si un panier bd existait
				                				*/
				                				$statementBD_selNomProduitBD = oci_fetch_assoc($sel_NomProduitBD);
				                				echo "<tr><td>".$statementBD_selNomProduitBD['NOMP']."</td><td>".$statementBD_selPanier['NBPRODUIT']."</td><td>".$statementBD_selPanier['PRIXQTEPRODUIT']."</td></tr>";
				                				while ($ligne_selNomProduitBD = oci_fetch_assoc($sel_NomProduitBD)) {
				                					oci_bind_by_name($sel_NomProduitBD, ":", variable)
				                					echo "<tr><td>".$statementBD_selNomProduitBD['NOMP']."</td><td>".$statementBD_selPanier['NBPRODUIT']."</td><td>".$statementBD_selPanier['PRIXQTEPRODUIT']."</td></tr>";
				                				}
				                			}

				                		?>
				                	</tbody>
				                </table>

				                <div class="row d-flex justify-content-center">
				                    <img src="./assets/images/logo.png" alt="" style="width: 50%;">
				                </div>
				            </div>
				        </div>
				    </div>


				    <?php include('includes/footer.php'); ?>


				</body>

				</html>
<?php
			}
		}
		else{
			header('location:index.php');
	}
?>