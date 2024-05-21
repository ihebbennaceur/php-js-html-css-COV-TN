<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des trajets</title>

    <link rel="stylesheet" href="../vue/css/styles.css">
</head>
<body>
    
    <div class="container">
        <h2>Gestion des trajets</h2>

        <nav>
            <ul>
            <li><a href="dashbord.php">Accueil</a></li>
                <li><a href="proposer_trajet.php">Proposer un trajet</a></li>

                <li> <a href="mes_trajets.php">Mes trajets</a> </li>

                <li> <a href="rechercher_tout.php">Tout les trajets</a> </li>
                <li>
                    <form action="rechercher_trajet.php" method="GET" style="display: inline;">
                        <label for="ville"> </label>
                        <input type="text" id="ville" name="ville" required>
                        <button type="submit">Rechercher</button>
                    </form>
                </li>
                
            </ul>

            
        </nav>

    </div>
    
</body>
</html>
