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
                <h1 class="fw-semibold text-center mb-5">Votre panier est vide ! <br><span class="fs-5"><a href="./index.php">Continuez vos achats</a></span></h1>


                <div class="row mb-5">
                    <div class="col-9">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-3">
                                    <img src="https://contents.mediadecathlon.com/p2097113/k$6aec1f7948846ee1fd98ae4a58dd1fb0/sq/barre-de-traction-murale-compacte.jpg?format=auto" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-9 pl-3">
                                    <div class="card-body text-start">
                                        <h4 class="card-title fw-bold">Barre trop sexy</h4>
                                        <p class="card-text">Matériaux : Bois</p>
                                        <p class="card-text"><small class="text-muted">Quantité : 1</small></p>

                                        <a href="" class="btn btn-danger">Supprimer du panier</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <p>Barre trop sexy - 29.99 € | (1)</p>
                                    <p>Elastique 25kg - 12.99 € | (1)</p>
                                </div>
                                <hr>
                                <h5>Total : <span class="fw-bold">29.99 €</span> <span class="text-muted fs-6">TTC</span></h5>

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
        </div>
    </div>

    <?php include('includes/footer.php'); ?>
</body>

</html>