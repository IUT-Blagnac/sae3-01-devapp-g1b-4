<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueGym - dev</title>
    <link rel="stylesheet" href="includes/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/search.css">

    <link rel="shortcut icon" href="./assets/images/bluegym.ico" type="image/x-icon">

</head>

<body>
    <?php include('includes/header.php'); ?>

    <?php


    ?>

    <?php
<<<<<<< Updated upstream
        echo '<div class="container mt-5">';
            echo '<div class="row d-flex justify-content-center">';
                echo '<div class="col-12 text-center">';
=======
    echo '<div class="container mt-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 text-center">
>>>>>>> Stashed changes

                    echo '<h1 class="fw-semibold text-center mb-5">Votre panier</h1>';

<<<<<<< Updated upstream
                    // Si panier vide
                    if (!isset($_SESSION['idClientIdentifie']) and !isset($_COOKIE["tempPanier"])) {
                        echo '<h3> Votre panier est vide !</h3><br>';
                        echo '<span class="fs-5"><a href="./index.php">Continuez vos achats</a></span><br><br>';
                    }
=======
    // Si panier vide
    if (!isset($_SESSION['idClientIdentifie']) and !isset($_COOKIE["tempPanier"])) {
        echo '<h3> Votre panier est vide !</h3><br><span class="fs-5"><a href="./index.php">Continuez vos achats</a></span><br><br>';
    }
>>>>>>> Stashed changes

    // Si utilisateur connecté
    if (isset($_SESSION['idClientIdentifie'])) {

<<<<<<< Updated upstream
                        require_once("./includes/connect.inc.php");

                        // requete
                        $req1 = "SELECT * FROM PANIER P, QUANTITEPANIER QP, PRODUIT PR
                            WHERE P.idpanier = QP.idpanier AND P.idclient = :pIdClient AND PR.idproduit = QP.idproduit AND P.idpanier NOT IN
                            (SELECT idpanier FROM COMMANDE C
                            WHERE P.idpanier = C.idpanier)";
=======
        require_once("./includes/connect.inc.php");
        error_reporting(0);
        // requete
        $req1 = "SELECT * FROM PANIER P, QUANTITEPANIER QP, PRODUIT PR
                        WHERE P.idpanier = QP.idpanier AND P.idclient = :pIdClient AND PR.idproduit = QP.idproduit AND P.encours IS NULL";
>>>>>>> Stashed changes

        $produitsPanier = oci_parse($connect, $req1);
        oci_bind_by_name($produitsPanier, ":pIdClient", $_SESSION['idClientIdentifie']);
        $result1 = oci_execute($produitsPanier);

<<<<<<< Updated upstream
                        // si panier vide
                        if (($leProduitPanier = oci_fetch_assoc($produitsPanier)) == false) {
                            echo '<h3> Votre panier est vide !</h3><br>';
                            echo '<span class="fs-5"><a href="./index.php">Continuez vos achats</a></span><br><br>';

                            // si produits dans panier
                        } else {
                            $result1 = oci_execute($produitsPanier);
                            echo '<span class="fs-5"><a href="./index.php">Continuez vos achats</a></span><br><br>';
                            echo '<div class="row mb-5">';
                                echo '<div class="col-9">';
                                    echo '<div class="row">';
                            // Affichage des produits
                            while (($leProduitPanier = oci_fetch_assoc($produitsPanier)) != false) {
                                        echo '<div class="col-12">';
                                            echo '<div class="card mb-3">';
                                                echo '<div class="row g-0">';
                                                    echo '<div class="col-md-3">';
                                                        echo '<img src="https://contents.mediadecathlon.com/p2097113/k$6aec1f7948846ee1fd98ae4a58dd1fb0/sq/barre-de-traction-murale-compacte.jpg?format=auto" class="img-fluid rounded-start" alt="...">';
                                                    echo '</div>';
                                                    echo '<div class="col-md-9 pl-3">';
                                                        echo '<div class="card-body text-start">';
                                                            echo '<h4 class="card-title fw-bold">' . $leProduitPanier["NOMP"] . '</h4>';
                                                            echo '<p class="card-text">Matériaux : ' . $leProduitPanier["COMPOSITION"] . '</p>';
                                                            echo '<p class="card-text"><small class="text-muted">Quantité : ' . $leProduitPanier["NBPRODUIT"] . '</small></p>';
                                                            echo '<a href="" class="btn btn-danger">Supprimer du panier</a>';
                                                        echo '</div>';
                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                            }
                            // Affichage paiement
                            $result1 = oci_execute($produitsPanier);
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="col-3">';
                                    echo '<div class="card">';
                                        echo '<div class="card-body">';
                                            echo '<div><h5>Récapitulatif</h5><hr>';
                                                echo '<div class="text-start ml-5">';
                        while (($leProduitPanier = oci_fetch_assoc($produitsPanier)) != false) {
                            if($leProduitPanier["NBPRODUIT"] > 1){   
                                echo '<p>' . $leProduitPanier["NOMP"] . ' - ' . $leProduitPanier["PRIXQTEPRODUIT"] . ' € - x'.$leProduitPanier["NBPRODUIT"].'</p>';
                            }else{   
                                echo '<p>' . $leProduitPanier["NOMP"] . ' - ' . $leProduitPanier["PRIXQTEPRODUIT"] . ' €</p>';
                            }
                        }
                                                echo '</div>';
                                            echo '</div>';
                                            echo '<hr>';
                                            echo '<h5>Total : <span class="fw-bold">';
                        $result1 = oci_execute($produitsPanier);
                        $row = oci_fetch_row($produitsPanier);
                                            echo $row[2];
                                            echo ' €</span> <span class="text-muted fs-6">TTC</span></h5>';
                                            echo '<div class="d-flex justify-content-center mt-3 mb-3">';
                                                echo '<a href="" class="btn btn-primary">Passer commande</a>';
                                            echo '</div>';
                                        echo '</div>';
                                        echo '<div class="card-footer d-flex justify-content-center">';
                                            echo '<img width="170" src="https://cdn.shopify.com/s/files/1/0318/5718/0809/t/2/assets/gateways-cart.png?v=fd3b6526858486989ac0" alt="">';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                            oci_free_statement($produitsPanier);
                        }
                    } else if (isset($_COOKIE["tempPanier"])) {
                        echo '<span class="fs-5"><a href="./index.php">Continuez vos achats</a></span><br><br>';
                    } 
                    // Recommandation
                    else {
                echo '</div>';
            echo '</div>';
        echo '</div>';
                        echo '<div class="container-fluid"><br>';
                            echo '<div class="product-grid">';
                            $reqCards = 'SELECT * FROM (SELECT * FROM PRODUIT ORDER BY dbms_random.value) WHERE rownum <= 4';
                            $cardsProduct = oci_parse($connect, $reqCards);
                            $result2 = oci_execute($cardsProduct);

                            while(($cardProduct = oci_fetch_assoc($cardsProduct)) != false){
                                echo '<div class="product-card"><a href="product.php?idProduit='.$cardProduct["IDPRODUIT"].'" style="color: inherit; text-decoration:none">';
                                    echo '<div class="product-image">';
                                        echo '<img src="https://contents.mediadecathlon.com/p2097113/k$6aec1f7948846ee1fd98ae4a58dd1fb0/sq/barre-de-traction-murale-compacte.jpg?format=auto&f=646x646" alt="">';
                                    echo '</div>';
                                    echo '<div class="product-infos">';
                                        echo '<h5 class="product-title">'.$cardProduct["NOMP"].'</h5>';
                                        echo '<h5 class="product-price"> '.$cardProduct["PRIXPRODUIT"].' €</h5>';
                                    echo '</div>';
                                echo '</a></div>';
                            }
                            

                            echo '</div>';
                        echo '</div>';
                    }
                    


                        echo '</div>';
                    echo '</div>';
        echo '</div>';
                
        include('includes/footer.php');
=======
        // si panier vide
        if (($leProduitPanier = oci_fetch_assoc($produitsPanier)) == false) {
            echo '<h3> Votre panier est vide !</h3><br>
                                <span class="fs-5"><a href="./index.php">Continuez vos achats</a></span><br><br>';

            // si produits dans panier
        } else {
            $result1 = oci_execute($produitsPanier);
            echo '<span class="fs-5">
                                <a href="./index.php">Continuez vos achats</a></span><br><br>
                                    <div class="row mb-5"><div class="col-9">
                                        <div class="row">';
            // Affichage des produits
            while (($leProduitPanier = oci_fetch_assoc($produitsPanier)) != false) {
                echo '<div class="col-12">
                                              <div class="card mb-3">
                                                 <div class="row g-0">
                                                    <div class="col-md-3">
                                                        <img src="https://contents.mediadecathlon.com/p2097113/k$6aec1f7948846ee1fd98ae4a58dd1fb0/sq/barre-de-traction-murale-compacte.jpg?format=auto" class="img-fluid rounded-start" alt="...">
                                                    </div>
                                                <div class="col-md-9 pl-3">
                                                        <div class="card-body text-start">
                                                            <a href="product.php?idProduit=' . $leProduitPanier["IDPRODUIT"] . '" style="color: inherit; text-decoration:none"><h4 class="card-title fw-bold">' . $leProduitPanier["NOMP"] . '</h4></a>
                                                            <p class="card-text">Matériaux : ' . $leProduitPanier["COMPOSITION"] . '</p>
                                                            <p class="card-text"><small class="text-muted">Quantité : ' . $leProduitPanier["NBPRODUIT"] . '</small></p>
                                                            <form id="formDeletePanier" method="POST" action="deleteFromCart.php">
                                                            <button class="btn btn-danger" type="submit" name="del" >
                                                                Supprimer 1
                                                            </button>
                                                            <button class="btn btn-danger" type="submit" name="delAll" >
                                                                Supprimer Tout
                                                            </button>
                                                            <input type="hidden" name="idPanier" value="' . $leProduitPanier['IDPANIER'] . '">
                                                            <input type="hidden" name="idProduit" value="' . $leProduitPanier['IDPRODUIT'] . '">
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
            }
            // Affichage paiement
            $result1 = oci_execute($produitsPanier);
            echo '</div>
                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div><h5>Récapitulatif</h5><hr>
                                                <div class="text-start ml-5">';
            while (($leProduitPanier = oci_fetch_assoc($produitsPanier)) != false) {
                if ($leProduitPanier["NBPRODUIT"] > 1) {
                    echo '<p>' . $leProduitPanier["NOMP"] . ' - ' . $leProduitPanier["PRIXQTEPRODUIT"] . ' € - x' . $leProduitPanier["NBPRODUIT"] . '</p>';
                } else {
                    echo '<p>' . $leProduitPanier["NOMP"] . ' - ' . $leProduitPanier["PRIXQTEPRODUIT"] . ' €</p>';
                }
            }
            echo '</div>
                                            </div>
                                            <hr>
                                            <h5>Total : <span class="fw-bold">';
            $result1 = oci_execute($produitsPanier);
            $row = oci_fetch_row($produitsPanier);
            echo $row[2];
            echo ' €</span> <span class="text-muted fs-6">TTC</span></h5>
                                            <div class="d-flex justify-content-center mt-3 mb-3">
                                                <a href="payment.php?tab=shipping&cartID=' . $row[0] . '" class="btn btn-primary">Passer commande</a>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-center">
                                            <img width="170" src="https://cdn.shopify.com/s/files/1/0318/5718/0809/t/2/assets/gateways-cart.png?v=fd3b6526858486989ac0" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>';
            oci_free_statement($produitsPanier);
        }
    } // Panier avec seulement le cookie 
    else if (!empty($_COOKIE["tempPanier"])) {
        $reqProduit = "SELECT * FROM Produit WHERE idProduit = :pIdProduit";
        $produitCookie = oci_parse($connect, $reqProduit);
        echo '<span class="fs-5"><a href="./index.php">Continuez vos achats</a></span><br><br>
                        <div class="row mb-5">
                            <div class="col-9">
                                <div class="row">';
        foreach (json_decode($_COOKIE['tempPanier'], true) as $articleCookie) {
            oci_bind_by_name($produitCookie, ":pIdProduit", $articleCookie['idProduit']);
            $resultCookie = oci_execute($produitCookie);
            $row = oci_fetch_row($produitCookie);
            echo '<div class="col-12">
                                        <div class="card mb-3">
                                            <div class="row g-0">
                                                <div class="col-md-3">
                                                    <img src="https://contents.mediadecathlon.com/p2097113/k$6aec1f7948846ee1fd98ae4a58dd1fb0/sq/barre-de-traction-murale-compacte.jpg?format=auto" class="img-fluid rounded-start" alt="...">
                                                </div>
                                                <div class="col-md-9 pl-3">
                                                    <div class="card-body text-start">
                                                        <a href="product.php?idProduit=' . $row[0] . '" style="color: inherit; text-decoration:none"><h4 class="card-title fw-bold">' . $row[2] . '</h4></a>
                                                        <p class="card-text">Matériaux : ' . $row[5] . '</p>
                                                        <p class="card-text"><small class="text-muted">Quantité : ' . $articleCookie["qteProduit"] . '</small></p>
                                                        
                                                        <form id="formDeletePanier" method="POST" action="deleteFromCart.php">
                                                            <button class="btn btn-danger" type="submit" name="del" >
                                                                Supprimer 1
                                                            </button>
                                                            <button class="btn btn-danger" type="submit" name="delAll" >
                                                                Supprimer Tout
                                                            </button>
                                                            <input type="hidden" name="index" value="' . array_search($articleCookie, json_decode($_COOKIE['tempPanier'], true)) . '">
                                                        </form>
                                                        
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
        }
        // Récap avec cookie seulement
        $prixTotalCookie = 0;
        echo '</div></div><div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div><h5>Récapitulatif</h5><hr>
                                                <div class="text-start ml-5">';
        foreach (json_decode($_COOKIE['tempPanier'], true) as $articleCookie) {
            oci_bind_by_name($produitCookie, ":pIdProduit", $articleCookie['idProduit']);
            $resultCookie = oci_execute($produitCookie);
            $row = oci_fetch_row($produitCookie);
            if ($articleCookie['qteProduit'] > 1) {
                echo '<p>' . $row[2] . ' - ' . $articleCookie['qtePrixProduit'] . ' € - x' . $articleCookie['qteProduit'] . '</p>';
            } else {
                echo '<p>' . $row[2] . ' - ' . $articleCookie['qtePrixProduit'] . ' €</p>';
            }
            $prixTotalCookie = $prixTotalCookie + $articleCookie['qtePrixProduit'];
        }
        echo '</div>
                                            </div>
                                            <hr>
                                            <h5>Total : <span class="fw-bold">';
        echo $prixTotalCookie;
        echo ' €</span> <span class="text-muted fs-6">TTC</span></h5>
                                            <div class="d-flex justify-content-center mt-3 mb-3">
                                            <a href="./payment.php?tab=shipping&cartID=' . $row[0] . '" class="btn btn-primary">Passer commande</a>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-center">
                                            <img width="170" src="https://cdn.shopify.com/s/files/1/0318/5718/0809/t/2/assets/gateways-cart.png?v=fd3b6526858486989ac0" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>';
        oci_free_statement($produitCookie);
    }
    // Recommandation
    else {
        echo '</div>
            </div>
        </div>
                        <div class="container-fluid"><br>
                            <div class="product-grid">';
        $reqCards = 'SELECT * FROM (SELECT * FROM PRODUIT ORDER BY dbms_random.value) WHERE rownum <= 4';
        $cardsProduct = oci_parse($connect, $reqCards);
        $result2 = oci_execute($cardsProduct);

        while (($cardProduct = oci_fetch_assoc($cardsProduct)) != false) {
            echo '<div class="product-card"><a href="product.php?idProduit=' . $cardProduct["IDPRODUIT"] . '" style="color: inherit; text-decoration:none">
                                    <div class="product-image">
                                        <img src="https://contents.mediadecathlon.com/p2097113/k$6aec1f7948846ee1fd98ae4a58dd1fb0/sq/barre-de-traction-murale-compacte.jpg?format=auto&f=646x646" alt="">
                                    </div>
                                    <div class="product-infos">
                                        <h7 class="product-title">' . $cardProduct["NOMP"] . '</h7>
                                        <h7 class="product-price"> ' . $cardProduct["PRIXPRODUIT"] . ' €</h7>
                                    </div>
                                </a></div>';
        }
        oci_free_statement($cardsProduct);

        echo '</div>
                        </div>';
    }



    echo '</div>
                    </div>
        </div>';

    include('includes/footer.php');
>>>>>>> Stashed changes
    ?>
</body>

</html>