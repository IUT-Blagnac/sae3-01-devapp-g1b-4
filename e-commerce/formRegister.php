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
        //dans cette fonction on vérifie que les deux mots de passe
        //saisies par l'utilisateur sont les mêmes puis on
        //soumet le formulaire.
        function validateForm(){
            let pwd1 = document.querySelector('input[name="mdpUtil"]').value;
            let pwd2 = document.querySelector('input[name="mdpUtilAconfirmer"]').value;
            let formReg = document.forms['formRegister'];

            if (pwd1 == pwd2) {
                formReg.submit();
            }
            else{
                alert('Les mots de passe ne correspondent pas');
            }
        }
    </script>
</head>

<body>
    <?php include('includes/header.php'); ?>

    <form name="formRegister" method="POST" action="traitRegister.php">
    	Votre email :<input type="email" name="mailUtil" required><br>
    	Votre nom :<input type="text" name="nomUtil"><br>
    	Votre prénom :<input type="text" name="prenomUtil"><br>
    	Mot de passe :<input type="password" name="mdpUtil" id="mdpUtil" required><br>
    	Confirmer mot de passe :<input type="password" name="mdpUtilAconfirmer" id="mdpUtilAconfirmer" required><br>
    	<input type="submit" name="isSubbed" onclick="validateForm()">
    </form>

    <?php include('includes/footer.php'); ?>
</body>

</html>