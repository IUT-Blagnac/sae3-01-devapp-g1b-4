<?php
session_start();

// if($_SESSION['isLogged']!=true){
//     header('location:formLogin.php');
// }

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

    <link rel="stylesheet" href="./assets/css/profile-page.css">

</head>

<body>
    <?php include('includes/header.php'); ?>

    <div class="container p-5">

        <!-- Message d'accueil -->
        <div class="row">
            <div class="col-12 text-center">
                <h1>Bonjour, Gabin</h1>
            </div>
        </div>

        <!-- Onglets -->
        <div class="row mt-3">
            <div class="profile-tabs">
                <ul>
                    <li><a href="">Se déconnecter</a></li>
                    <li><a href="" class="active">Mes commandes</a></li>
                    <li><a href="">Paramètres</a></li>
                </ul>
            </div>
        </div>

        <!-- Contenu -->
        <!-- Sélection du contenu en fonction du paramètre d'URL -->
        <?php 
            // if the current GET request is for the "orders" tab
            if($_GET['tab'] == "orders"){
                // include the orders tab
                include('./includes/profile-includes/profile-orders.php');
            }
            else if ($_GET['tab'] == "settings"){
                // include the settings tab
                include('./includes/profile-includes/profile-settings.php');
            }
            else{
                // include the default tab
                include('./includes/profile-includes/profile-default.php');
            }
        ?>

        
    </div>


    <?php include('includes/footer.php'); ?>
</body>

</html>