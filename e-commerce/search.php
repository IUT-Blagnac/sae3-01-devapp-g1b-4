<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueGym - dev</title>


    <link rel="stylesheet" href="includes/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">

    <!-- Custom page css -->
    <link rel="stylesheet" href="assets/css/search.css">

</head>

<body>
    <?php include('includes/header.php'); ?>

    <!-- Bannière de recherche -->
    <div class="search-wrap-wrap">
        <img class="search-wrap-bg" src="https://contents.mediadecathlon.com/s862295/k$7f1de21aeee82c19ac7c164ad2894872/dbi_b91bb9b8+c037+4c16+a722+b9789d13adb9.jpg" alt="">
        <div class="search-wrap-content">
            <div class="container h-100">
                <div class="row h-100 d-flex align-content-center">
                    <div class="col-12">

                        <!-- Navigation de retour arrière -->
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./index.php">Accueil</a></li>
                            <li class="breadcrumb-item active">Barres de traction</li>
                        </ul>

                    </div>
                    <div class="col-7">
                        <h1 class="text-white fw-bold search-wrap-title"><span style="background-color: #000;">Barres de traction</span></h1>
                    </div>
                    <div class="col-5">
                        <!-- Section vierge -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation des sous-catégories -->
    <nav class="subcat-nav">
        <div class="items-section">
            <ul>
                <li class="active"><a href="">Toutes les barres</a></li>
                <li><a href="">Fixation murale</a></li>
                <li><a href="">Fixation porte</a></li>
            </ul>
        </div>
    </nav>

    <!-- Trier -->
    <div class="short-items-row">
        <div class="dropdown-section">
            <div class="filter-section">
                <button href="" class="btn btn-primary">Filtrer les éléments</button>
            </div>
            <div class="dropdown dropdown-button">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Trier par
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Prix croissant</a></li>
                    <li><a class="dropdown-item" href="#">Prix décroissant</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Main search content -->
    <div class="container-fluid">
        <div class="product-grid">

            <!-- Carte produit -->
            <?php
                require_once("includes/connect.inc.php");
                
                $reqProducts = "SELECT * FROM PRODUIT";

                $prepProduits = oci_parse($connect, $reqProducts);

                $gotProduits = oci_execute($prepProduits);
                
                if($gotProduits){

                    while (($produit = oci_fetch_assoc($prepProduits)) != false) {
                        echo '<div class="product-card">';
                            echo '<div class="product-image">';
                                echo '<img src="https://contents.mediadecathlon.com/p2097113/k$6aec1f7948846ee1fd98ae4a58dd1fb0/sq/barre-de-traction-murale-compacte.jpg?format=auto&f=646x646" alt="">';
                                echo '<div class="product-image-overlay">';
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart-fill favorite-btn" viewBox="0 0 16 16">';
                                        echo '<path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />';
                                    echo '</svg>';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="product-infos">';
                                echo '<h5 class="product-title"><a href="">'.$produit['NOMP'].'</a></h5>';
                                echo '<h5 class="product-price">'.$produit['PRIXPRODUIT'].' €</h5>';
                            echo '</div>';
                        echo '</div>';
                    }
                }
                else {
                    $error = oci_error($prepProduits);  // on récupère l'exception liée au pb d'execution de la requete
		            echo "Aucun résultat trouvé.";
                }
            ?>

        </div>
    </div>




    <?php include('includes/footer.php'); ?>

    <!-- Javascript -->
    <!-- <script src="includes/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="./assets/js/main.js"></script>

</body>

</html>