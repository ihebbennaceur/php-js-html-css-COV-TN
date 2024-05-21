<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mot de passe oublié</title>
</head>
<body>
    <h2>Mot de passe oublié</h2>
    <form action="cov-tn/controllers/mdpoublieController.php" method="post">
        <label for="email">Adresse e-mail:</label>
        <input type="text" id="email" name="email" required><br><br>
        <label for="cin">Numéro Cin:</label>
        <input type="text" id="cin" name="cin" required><br><br>
        <button type="submit">Récupérer le mot de passe</button>
    </form>
</body>
</html>
