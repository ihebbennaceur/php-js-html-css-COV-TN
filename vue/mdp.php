<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="../vue/css/styles.css">
</head>
<body>
    <h2>Mot de passe oublié</h2>
    <form action="../controllers/mdpoublieController.php" method="post">
        <label for="email">Adresse e-mail:</label>
        <input type="text" id="email" name="email" required>
        <br><br>
        <label for="cin">Numéro Cin:</label>
        <input type="text" id="cin" name="cin" required>
        <br><br>
        <button type="submit" name="recuperer">Récupérer le mot de passe</button>
        <br><br>
        <button onclick="redection()">Login</button>
    </form>

    <!-- <button onclick="rederction()">Login</button> -->

    <script>
        function redection(){
            return window.location.href = "../vue/login_form.php";
        }
    </script>

</body>
</html>
