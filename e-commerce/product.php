<?php
if(empty($_GET)){
    header('location:index.php');
}
else{
    require('includes/connect.inc.php');

    $idProduit = $_GET['idProduit'];

    $reqProduit = "SELECT * FROM Produit WHERE IDPRODUIT = :pIDproduit";

    $produitInfos = oci_parse($connect, $reqProduit);

    oci_bind_by_name($produitInfos, ":pIDproduit", $idProduit);

    $resultInfosProduit = oci_execute($produitInfos);

    // si la requete n'a pas pu être executée, on affiche l'erreur
    if (!$resultInfosProduit) {
        $e = oci_error($resultVerif);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
        print htmlentities($e['message']. ' pour cette requete : ' .$e['sqltext']); 
    } else {
        $statementBD = oci_fetch_assoc($produitInfos);
        if(empty($statementBD)){
            header('location:index.php?msgErreur=Produit existant mais aucune info trouvée');
        }
        
        $reqCategorie = "SELECT nomcat FROM Categorie WHERE idcategorie = :pIDcat";

        $idCategorie = $statementBD['idcategorie'];

        $categorieInfos = oci_parse($connect, $reqCategorie);

        oci_bind_by_name($categorieInfos, ":pIDcat", $idCategorie);

        $resultCategorie = oci_execute($categorieInfos);
        // si la requete n'a pas pu être executée, on affiche l'erreur
        if (!$resultInfosProduit) {
            $e = oci_error($resultVerif);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
            print htmlentities($e['message']. ' pour cette requete : ' .$e['sqltext']); 
        } else{
            $statementBD_CAT = oci_fetch_assoc($categorieInfos);
        }
    }
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
    <link rel="stylesheet" href="assets/css/product-page.css">

</head>

<body>

    <?php include('includes/header.php'); ?>

    <div class="container">

        <!-- Première ligne image + présentation produit -->
        <div class="row">
            <!-- Left side product image displayer -->
            <div class="col-6">
                <div class="product-image-displayer">
                    <img src="https://contents.mediadecathlon.com/p2097113/k$6aec1f7948846ee1fd98ae4a58dd1fb0/sq/barre-de-traction-murale-compacte.jpg?format=auto&f=800x800" alt="">
                </div>
                <div class="product-image-switcher">
                    <div class="button-group">
                        <button class="btn">
                            <img src="https://contents.mediadecathlon.com/p2097113/k$6aec1f7948846ee1fd98ae4a58dd1fb0/sq/barre-de-traction-murale-compacte.jpg?format=auto&f=50x50" alt="">
                        </button>
                        <button class="btn">
                            <img src="https://contents.mediadecathlon.com/p2097113/k$6aec1f7948846ee1fd98ae4a58dd1fb0/sq/barre-de-traction-murale-compacte.jpg?format=auto&f=50x50" alt="">
                        </button>
                    </div>
                </div>
            </div>
            <!-- Right side product infos section -->
            <div class="col-6 pl-5 pt-4">
                <div class="row">
                    <div class="col-9">
                        <h1 class="product-title">
                            <?php echo $statementBD['nomP'];?>
                        </h1>
                        <h3>
                            <?php echo $statementBD['prixProduit']." €";?>
                        </h3>
                    </div>

                    <!-- Section notation -->
                    <div class="col-3">
                        <div class="rate-section">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Section description -->
                <div class="row mt-5">
                    <div class="col-12">
                        <h5>Description rapide</h5>
                        <p class="product-description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. In maxime officiis voluptates beatae. Natus modi velit quam impedit quo eum ipsum debitis cumque odit accusantium! Atque, veritatis cumque! At, quasi.
                            <?php echo $statementBD['descriptionRapide'];?>
                        </p>
                    </div>
                </div>

                <!-- Section actions sur le produit -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Choix des matériaux
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#">Bois</a></li>
                                <li><a class="dropdown-item" href="#">Métal</a></li>
                                <li><a class="dropdown-item" href="#">Aluminium</a></li>
                                <li><a class="dropdown-item" href="#">Netherite</a></li>
                            </ul>
                        </div>
                        <p>
                            Matériaux choisi : <span class="fw-bold">Bois</span>
                        </p>
                    </div>
                    <div class="col-12 d-flex justify-content-center mt-3">
                        <button class="btn ajouter-panier">
                            Ajouter au panier
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Affichage des infos produit en détail -->
        <div class="row">

            <!-- Description produit -->
            <div class="col-12 mt-4">
                <h2>
                    Description
                </h2>
                <hr>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. In maxime officiis voluptates beatae. Natus modi velit quam impedit quo eum ipsum debitis cumque odit accusantium! Atque, veritatis cumque! At, quasi.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis non possimus cupiditate odio accusantium. Recusandae cupiditate odit itaque voluptates, sapiente quos nam aperiam debitis delectus soluta beatae voluptatibus iusto in?
                    Magni, omnis reprehenderit. Sunt officiis vero reprehenderit. Veniam iure, accusamus asperiores eligendi impedit possimus sint vero deserunt repellendus recusandae, velit culpa, ad porro voluptatibus labore doloremque provident. Inventore, iusto labore.
                    <?php echo $statementBD['descriptionRapide'];?>
                </p>
            </div>

            <!-- Avantages produit -->
            <div class="col-12 mt-4">
                <h2>
                    Avantages
                </h2>
                <hr>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. In maxime officiis voluptates beatae. Natus modi velit quam impedit quo eum ipsum debitis cumque odit accusantium! Atque, veritatis cumque! At, quasi.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis non possimus cupiditate odio accusantium. Recusandae cupiditate odit itaque voluptates, sapiente quos nam aperiam debitis delectus soluta beatae voluptatibus iusto in?
                    Magni, omnis reprehenderit. Sunt officiis vero reprehenderit. Veniam iure, accusamus asperiores eligendi impedit possimus sint vero deserunt repellendus recusandae, velit culpa, ad porro voluptatibus labore doloremque provident. Inventore, iusto labore.
                </p>
            </div>

            <!-- Avis produit -->
            <div class="col-12 mt-4">
                <h2>
                    Avis
                </h2>
                <hr>
                <!-- Carte d'avis utilisateur -->
                <!-- avis utilisateur 1 -->
                <div class="card m-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="rate-section">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <small class="text-muted">le 07/08/10 par : Igor Carpetto</small>
                            </div>
                        </div>
                        <h4 class="mt-3">Titre de l'avis</h4>
                        <p>Oui oui baguette. </p>
                    </div>
                </div>
                <!-- avis utilisateur 2s -->
                <div class="card m-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="rate-section">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <small class="text-muted">le 07/08/10 par : Karim ZOuli</small>
                            </div>
                        </div>

                        <h4 class="mt-3">Avis un peu moins bien </h4>
                        <p>Oui oui baguette. </p>

                    </div>
                </div>
            </div>

        </div>

        <!-- Suggestion autres produits -->
        <div class="row">
            <div class="col-12 mt-4">
                <h2>
                    Produits qui pourraient vous plaire
                </h2>
                <hr>
            </div>
            <div class="col-12">
                <div class="card-displayer-suggestion">
                    <div class="product-card" style="transform: none;">
                        <div class="product-card-img">
                            <img src="https://contents.mediadecathlon.com/p2097113/k$6aec1f7948846ee1fd98ae4a58dd1fb0/sq/barre-de-traction-murale-compacte.jpg?format=auto&f=646x646" alt="">
                        </div>
                        <div class="product-card-content">
                            <h4 class="title">Barre trop sexy</h4>
                            <h5 class="price">25.50 €</h5>
                        </div>
                    </div>
                    <div class="product-card" style="transform: none;">
                        <div class="product-card-img">
                            <img src="https://contents.mediadecathlon.com/p2097113/k$6aec1f7948846ee1fd98ae4a58dd1fb0/sq/barre-de-traction-murale-compacte.jpg?format=auto&f=646x646" alt="">
                        </div>
                        <div class="product-card-content">
                            <h4 class="title">Barre trop sexy</h4>
                            <h5 class="price">25.50 €</h5>
                        </div>
                    </div>

                </div>
            </div>
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