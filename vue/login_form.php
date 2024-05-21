
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../vue/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <form action="../controllers/LoginController.php" method="post">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
            
            <br><br>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            <br><br>

            <button type="submit" name="login">Se connecter</button>
            <br><br>

            <button onclick="redectionmdp()">Mot de passe oublié</button>

            <br><br>
            <button onclick="redecitinscription()">creer un compte</button>
        </form>
    </div>

    <script>
        function redecitinscription(){
            return window.location.href = "../vue/registration_form.php"
        }
    </script>

    <script>
        function redectionmdp(){
            return window.location.href = "../vue/mdp.php";
        }
    </script>

</body>
</html>
