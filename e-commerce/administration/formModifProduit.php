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
            <h1> Modification d'un produit</h1>
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
				idproduit_non_modifiable : <input type="text" name="identifiantproduit" /><br><br>
                Nom du Produit : <input type="text" name="nomProd" /><br><br>
                Description du Produit : <input type="text" name="descProd" /><br><br>
                Avantages du produit : <input type="text" name="avantProd" /><br><br>
                Taille du produit : <input type="text" name="tailProd" /><br><br>
                Composition du produit : <input type="text" name="compoProd" /><br><br>
                Prix du Produit : <input type="text" name="prixProd" /><br><br>
                Produits en stock : <input type="text" name="stockProd" /><br><br>
                Categorie : <select name="catProd">
                    <?php
                        $reqCat = "SELECT NOMCAT, IDCATEGORIE FROM CATEGORIE";
                        $prepCat = oci_parse($connect, $reqCat);
                        oci_execute($prepCat);
                        while (($nomC = oci_fetch_assoc($prepCat)) != false) {
                            echo '<option value="', $nomC[IDCATEGORIE],'">', $nomC[NOMCAT] ,'</option>';
                        }
                    ?>
                </select><br><br>
                <input type="submit" name="modifier" value="Modifier" />
            </fieldset>
        </form><BR><BR>
    </div>
         
    <?php
        if(isset($_POST["modifier"])) {
            $reqProd = "UPDATE PRODUIT SET NOMP = ".$_POST['nomProd'].", PRIXPRODUIT = ".$_POST['prixProd'].", TAILLE = ".$_POST['tailProd'].", COMPOSITION = ".$_POST['compoProd'].", DESCRIPTION ".$_POST['descProd'].", QTEPRODUIT = ".$_POST['stockProd'].", AVANTAGES = ".$_POST['avantProd']." WHERE idproduit = identifiantproduit)";
            $prepProd = oci_parse($connect, $reqProd);
            $sendProd = oci_execute($prepProd);
            
            if(!$sendProd){
                header("location:./formModifProduit.php?Erreur=Erreur lors de la modificationdu produit dans la base de données");
            }

            header("location:./formModifProduit.php?Succes=Produit modifié dans la base de données");
            
        }
    ?>




    <?php include('includes/footer.php'); ?>

</body>
</html>