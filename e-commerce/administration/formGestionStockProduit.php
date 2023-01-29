<!DOCTYPE html>
<html lang="en">

<?php
    session_start();

    require_once("../includes/connect.inc.php");
    error_reporting(0);
    
    if (isset($_SESSION['idClientIdentifie'])) {
        $reqAdm = "SELECT * FROM CLIENT WHERE IDCLIENT= :pIdClie";
        $prepAdm = oci_parse($connect, $reqAdm);
        oci_bind_by_name($prepAdm, ":pIdClie", $_SESSION['idClientIdentifie']);
        $gotAdmin = oci_execute($prepAdm);

        while (($getInfos = oci_fetch_assoc($prepAdm)) != false) {
            $adm=$getInfos["ADMIN"];
        }

        if($adm == null){
            header('location:../index.php');
        }
    } 
    else {
        header('location:../index.php');
    }
    
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueGym - dev</title>

    <link rel="stylesheet" href="../includes/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">

    <link rel="shortcut icon" href="../assets/images/bluegym.ico" type="image/x-icon">

</head>

<body>
    <div class="header bg-dark text-white">
        </br>
        <div style="margin: 50px">
            <h1> Gestion des stockes et des produits</h1>
        </div>
        </br>
    </div>
	
	<?php 
        include('includes/header.php'); 
    ?>
	
	<div style="margin: 50px">

        <?php
            if(isset($_GET["Erreur"])){
                echo '<div class="alert alert-warning" role="alert">';
                    echo $_GET['Erreur'];
                echo '</div>';
            }
            if(isset($_GET["Succes"])){
                echo '<div class="alert alert-success" role="alert">';
                    echo $_GET['Succes'];
                echo '</div>';
            }
        ?>

        <a href="./admin.php">Retour aux actions administrateur</a></br>
		
		</br>
        </br>
        <form method='post'>
				idproduit : <input type="text" name="identifiantproduit" /><br><br>
                quantité à recharger : <input type="text" name="nomProd" /><br><br>
				<input type="submit" name="rajouter" value="Rajouter" />
				</fieldset>
        </form><BR><BR>
    </div>
	
	<?php
    if(isset($_POST['rajouter'])){
        $idproduit = $_POST['idproduit'];
        $produit_rajouter = $_POST['produit_rajouter'];

        $stid = oci_parse($conn, "EXEC ajoutproduitstock(:idproduit,:produit_rajouter);");
        oci_bind_by_name($stid, ":idproduit", $idproduit);
        oci_bind_by_name($stid, ":produit_rajouter", $produit_rajouter);

        $sendProd = oci_execute($stid);

        oci_free_statement($stid);
		
		if(!$sendProd){
                header("location:./formGestionStockProduit.php?Erreur=Erreur lors du rechargement du produit dans la base de données");
            }

            header("location:./formGestionStockProduit.php?Succes=Produit recharger dans la base de données");
    }
?>

	
	
	
	