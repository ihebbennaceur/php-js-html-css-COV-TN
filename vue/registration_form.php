<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>S'inscrire</title>
    <link rel="stylesheet" href="../vue/css/styles.css">
</head>
<body>
    <h2>S'inscrire</h2>
    <form action="../controllers/registrationController.php" method="post" enctype="multipart/form-data">
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Adresse e-mail:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="confirmedpassword">Confirmer le mot de passe:</label>
        <input type="password" id="confirmedpassword" name="confirmedpassword" required><br><br>
        <label for="phone">Téléphone:</label>
        <input type="text" id="phone" name="phone"><br><br>
        <label for="cin">Numéro Cin:</label>
        <input type="text" id="cin" name="cin" required><br><br>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo" required ><br><br>
        <button type="submit">S'inscrire</button>
    </form>

    <button onclick="redirectToLoginPage()">J'ai un compte</button>
    <script>

        function redirectToLoginPage() {
            setTimeout(function() {
                window.location.href = "../vue/login_form.php";
            }, 20); //1000 = 1s
        }
    </script>
</body>
</html>
