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

    <form method='POST' action="traitLogin.php">
        Votre email :<input type="email" name="mailUtil"><br>
        Votre mot de passe :<input type="password" name="mdpUtil"><br>
        <input type="submit" name="isSubbed">
    </form>
    <?php
    if (isset($_GET['msgErreur'])) {
        echo $msgErreur;
    }
    include('includes/footer.php'); 
    ?>
</body>
</html>