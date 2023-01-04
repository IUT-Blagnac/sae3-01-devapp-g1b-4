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
            <div class="col-12 text-center">

                <h1 class="fw-semibold text-center mb-5">Votre panier</h1>
                <h1 class="fw-semibold text-center mb-5">
                    <?php
                    if (!isset($_SESSION['idClientIdentifie']) and !isset($_COOKIE["tempPanier"])) {
                        echo 'Votre panier est vide ! <br>';
                    }
                    if (!isset($_SESSION['idClientIdentifie'])) {
                        echo '<span class="fs-5"><a href="./index.php">Continuez vos achats</a></span></h1>';
                    }
                    if (isset($_SESSION['idClientIdentifie'])) {
                        require_once("./includes/connect.inc.php");
                        error_reporting(0);
                        $req1 = "SELECT * FROM PANIER P, QUANTITEPANIER QP, PRODUIT PR
                    WHERE P.idpanier = QP.idpanier AND P.idclient = :pIdClient AND PR.idproduit = QP.idproduit AND P.idpanier NOT IN
                    (SELECT idpanier FROM COMMANDE C
                    WHERE P.idpanier = C.idpanier)";
                        $produitsPanier = oci_parse($connect, $req1);
                        oci_bind_by_name($produitsPanier, ":pIdClient", $_SESSION['idClientIdentifie']);
                        $result1 = oci_execute($produitsPanier);
                        if (($leProduitPanier = oci_fetch_assoc($produitsPanier)) == false) {
                            echo 'Votre panier est vide ! <br>';
                            echo '<span class="fs-5"><a href="./index.php">Continuez vos achats</a></span></h1>';
                        } else {
                            $result1 = oci_execute($produitsPanier);
                            echo '<span class="fs-5"><a href="./index.php">Continuez vos achats</a></span></h1>';
                            echo '<div class="row mb-5"><div class="col-9"><div class="row">';
                            while (($leProduitPanier = oci_fetch_assoc($produitsPanier)) != false) {
                                echo '
                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <img src="https://contents.mediadecathlon.com/p2097113/k$6aec1f7948846ee1fd98ae4a58dd1fb0/sq/barre-de-traction-murale-compacte.jpg?format=auto" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-9 pl-3">
                                        <div class="card-body text-start">
                                            <h4 class="card-title fw-bold">' . $leProduitPanier["NOMP"] . '</h4>
                                            <p class="card-text">Matériaux : ' . $leProduitPanier["COMPOSITION"] . '</p>
                                            <p class="card-text"><small class="text-muted">Quantité : ' . $leProduitPanier["NBPRODUIT"] . '</small></p>
                                            <a href="" class="btn btn-danger">Supprimer du panier</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ';
                            }
                            $result1 = oci_execute($produitsPanier);
                            echo '
                        </div>
                        </div>
                        <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <div><h5>Récapitulatif</h5>';
                            while (($leProduitPanier = oci_fetch_assoc($produitsPanier)) != false) {
                                echo '<p>' . $leProduitPanier["NOMP"] . ' - ' . $leProduitPanier["PRIXQTEPRODUIT"] . ' €</p>';
                            }
                            echo '</div>
                            <hr>
                            <h5>Total : <span class="fw-bold">';
                            $result1 = oci_execute($produitsPanier);
                            $row = oci_fetch_row($produitsPanier);
                            echo $row[2];
                            echo ' €</span> <span class="text-muted fs-6">TTC</span></h5>
                                <div class="d-flex justify-content-center mt-3 mb-3">
                                <a href="" class="btn btn-primary">Passer commande</a>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <img width="170" src="https://cdn.shopify.com/s/files/1/0318/5718/0809/t/2/assets/gateways-cart.png?v=fd3b6526858486989ac0" alt="">
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>';
                            oci_free_statement($produitsPanier);
                        }
                    }
                    ?>


            </div>
        </div>
    </div>
    </div>
    </div>
    </div>


    <?php include('includes/footer.php'); ?>
</body>

</html>