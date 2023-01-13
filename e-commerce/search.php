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
                    <?php
                    require_once("includes/connect.inc.php");

                    $nomCat = "";
                    $sousCat = FALSE;


                    if (isset($_GET['getIDCat'])) {
                        //récupère la catégorie de la page
                        $reqCat = "SELECT * FROM CATEGORIE WHERE IDCATEGORIE =" . $_GET['getIDCat'];
                        $prepCat = oci_parse($connect, $reqCat);
                        $gotCat = oci_execute($prepCat);

                        $gotCatMere=FALSE;
                        if ($gotCat) {
                            $categorie = oci_fetch_assoc($prepCat);
                            $nomCat = $categorie['NOMCAT'];

                            //Si la catégorie récupérée est une sous catégorie, ce if permet de récupérer les données de la categorie mère
                            if($categorie['IDCATEGORIEMERE']!=""){
                                $sousCat = TRUE;
                                $reqCatMere = "SELECT * FROM CATEGORIE WHERE IDCATEGORIE =" . $categorie['IDCATEGORIEMERE'];
                                $prepCatMere = oci_parse($connect, $reqCatMere);
                                $gotCatMere = oci_execute($prepCatMere);
                                if($gotCatMere){
                                    $categorieCatMere=oci_fetch_assoc($prepCatMere);
                                }
                            }
                            

                        } else {
                            header('location:search.php');
                        }
                    } else {
                        $nomCat = "Tous les produits";
                        
                    }

                    echo '<div class="col-12">';

                        //<!-- Navigation de retour arrière -->
                        echo '<ul class="breadcrumb">';
                            echo '<li class="breadcrumb-item"><a href="./index.php">Accueil</a></li>';
                            if($sousCat==TRUE){
                                echo '<li class="breadcrumb-item active"><a href="./search.php?getIDCat='.$categorieCatMere['IDCATEGORIE'].'">'.$categorieCatMere['NOMCAT'].'</a></li>';
                            }
                                echo '<li class="breadcrumb-item active">' . $nomCat . '</li>';
                        echo '</ul>';

                    echo '</div>';
                    echo '<div class="col-7">';
                        echo '<h1 class="text-white fw-bold search-wrap-title"><span style="background-color: #000;">' . $nomCat . '</span></h1>';
                    echo '</div>';
                    ?>
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
            <?php
            if($nomCat != "Tous les produits"){

                if($gotCatMere){
                    $reqSousCat = "SELECT * FROM CATEGORIE WHERE IDCATEGORIEMERE =" . $categorieCatMere['IDCATEGORIE'];
                }
                else {
                    $reqSousCat = "SELECT * FROM CATEGORIE WHERE IDCATEGORIEMERE =" . $categorie['IDCATEGORIE'];

                }
                $prepSousCat = oci_parse($connect, $reqSousCat);
                $gotSousCat = oci_execute($prepSousCat);

                if($gotSousCat){
                    echo '<ul>';
                    while (($lesSousCat = oci_fetch_assoc($prepSousCat)) != false) {
                        echo '<li><a href="./search.php?getIDCat='.$lesSousCat['IDCATEGORIE'].'">'.$lesSousCat['NOMCAT'].'</a></li>'; 
                    }
                    echo '</ul>';
                }
                
            }
            
            ?>
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
            if (isset($_GET['getIDCat'])) {
                $reqProducts = "SELECT * FROM PRODUIT WHERE IDCATEGORIE =" . $_GET['getIDCat'];
            } else {
                $reqProducts = "SELECT * FROM PRODUIT";
            }

            $prepProduits = oci_parse($connect, $reqProducts);

            $gotProduits = oci_execute($prepProduits);

            if ($gotProduits) {

                while (($produit = oci_fetch_assoc($prepProduits)) != false) {
                    echo '<div class="product-card">';
                        echo '<a href="product.php?idProduit='.$produit['IDPRODUIT'].'" style="text-decoration: none; color: inherit">';
                        echo '<div class="product-image">';
                            echo '<img src="./assets/images/product-img/'.$produit['IDPRODUIT'].'" alt="" style="width: 100%; height: auto;"> ';
                                echo '<div class="product-image-overlay">';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="product-infos">';
                            echo '<h5 class="product-title">' . $produit['NOMP'] . '</h5>';
                            echo '<h5 class="product-price">' . $produit['PRIXPRODUIT'] . ' €</h5>';
                        echo '</div>';
                        echo '</a>';
                    echo '</div>';
                }
            } else {
                $error = oci_error($prepProduits);  // on récupère l'exception liée au pb d'execution de la requete
                echo "Aucun résultat trouvé.";
            }
            ?>

        </div>
    </div>




    <?php include('includes/footer.php'); ?>

</body>

</html>