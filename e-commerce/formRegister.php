<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueGym - dev</title>
    <link rel="stylesheet" href="includes/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <script type="text/javascript">
        function validateForm(){
            let pwd1 = document.getElementById('mdpUtil');
            let pwd2 = document.getElementByName('mdpUtilAconfirmer');
            let formReg = document.querySelector('formRegister');
            let buttonSubmit = formReg.querySelector("isSubbed");

            if (pwd1 == pwd2) {
                formReg.requestSubmit(buttonSubmit);
            }
            else{
                alert('Erreur form');
            }
        }

    </script>
</head>

<body>
    <?php include('includes/header.php'); ?>

    <form id="formRegister" method="POST" action="traitRegister.php">
    	Votre email :<input type="email" name="mailUtil"><br>
    	Votre nom :<input type="text" name="nomUtil"><br>
    	Votre prénom :<input type="text" name="prenomUtil"><br>
    	Mot de passe :<input type="password" name="mdpUtil"><br>
    	Confirmer mot de passe :<input type="password" name="mdpUtilAconfirmer"><br>
    	<input type="submit" name="isSubbed" onclick="validateForm()">
    </form>

    <?php include('includes/footer.php'); ?>
</body>

</html>