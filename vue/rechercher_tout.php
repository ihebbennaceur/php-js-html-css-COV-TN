<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit();
}

$user_id = $_SESSION['user_id'];


if (isset($_GET['ville'])) {
    $ville = $_GET['ville'];
} else {
    $ville = '';
}

require_once '../models/Connexion.php';
require_once '../controllers/TrajetController.php';

$trajetController = new TrajetController();


$trajets = $trajetController->selectall();

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de Trajet</title>
    <link rel="stylesheet" href="../vue/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Tout les Trajets</h2>

        <nav>
            <ul>
            <li><a href="dashbord.php">Accueil</a></li>
                <li><a href="proposer_trajet.php">Proposer un trajet</a></li>
                <li><a href="mes_trajets.php">Mes trajets</a></li>
                <li>
                    <form action="rechercher_trajet.php" method="GET" style="display: inline;">
                        <label for="ville">Rechercher un trajet: </label>
                        <input type="text" id="ville" name="ville" value="<?= $ville ?>" required>
                        <button type="submit">Rechercher</button>
                    </form>
                </li>
            </ul>
        </nav>

        <?php if (empty($trajets)): ?>
            <p>Aucun trajet trouvé pour la ville <?= $ville?></p>
        <?php else: ?>
            <ul>
                <?php foreach ($trajets as $trajet): ?>
                    <li>
                        <strong>Départ:</strong> <?= $trajet['villedepart'] ?><br>
                        <strong>Arrivée:</strong> <?= $trajet['villearrivee'] ?><br>
                        <strong>Date:</strong> <?= $trajet['date'] ?><br>
                        <strong>Prix:</strong> <?= $trajet['prix'] ?><br>
                        <strong>Description:</strong> <?= $trajet['description'] ?><br><br>
                        
                        <a href="profile_user.php?userid=<?= $trajet['userid'] ?>">Voir le profil</a>

                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>
