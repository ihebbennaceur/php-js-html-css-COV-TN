<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit();
}

$user_id = $_SESSION['user_id'];

require_once '../models/Connexion.php';
require_once '../controllers/TrajetController.php';

$trajetController = new TrajetController();

$trajets = $trajetController->getTrajetsByUserId($user_id);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes trajets</title>
    <link rel="stylesheet" href="../vue/css/styles.css">
</head>
<body>
    <div class="container">

    <nav>
            <ul>
            <li><a href="dashbord.php">Accueil</a></li>
                <li><a href="proposer_trajet.php">Proposer un trajet</a></li>

             
                </li>
                
            </ul>

            
        </nav>
        <h2>Mes trajets</h2>


        <?php if (empty($trajets)): ?>
            <p>Aucun trajet trouvé.</p>
        <?php else: ?>
            <ul>
                

                <?php foreach ($trajets as $trajet): ?>
                    <li>
                        <strong>Départ:</strong> <?= $trajet['villedepart'] ?><br><br>
                        <strong>Arrivée:</strong> <?= $trajet['villearrivee'] ?><br><br>
                        <strong>Date:</strong> <?= $trajet['date'] ?><br><br>
                        <strong>Prix:</strong> <?= $trajet['prix'] ?><br><br>
                        <strong>Description:</strong> <?= $trajet['description'] ?><br><br>

                        <a href="modifier_trajet.php?id=<?= $trajet['id'] ?>">Modifier</a> 
                        <a href="supprimer_trajet.php?id=<?= $trajet['id'] ?>">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

    </div>
</body>
</html>
