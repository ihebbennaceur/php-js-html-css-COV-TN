<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit();
}

// Vérifier si l'ID du trajet est défini dans l'URL
if (!isset($_GET['id'])) {
    header("Location: mes_trajets.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$trajet_id = $_GET['id'];

// Inclure la connexion à la base de données et le contrôleur de trajet
require_once '../models/Connexion.php';
require_once '../controllers/TrajetController.php';

$trajetController = new TrajetController();

// Récupérer le trajet spécifique
$trajet = $trajetController->getTrajetById($trajet_id);

// Vérifier si le trajet existe et appartient à l'utilisateur
if (!$trajet || $trajet['userid'] != $user_id) {
    header("Location: mes_trajets.php");
    exit();
}

$error = '';

// Traitement de la suppression
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $success = $trajetController->supprimerTrajet($trajet_id, $user_id);

    if ($success) {
        // Rediriger vers la page des trajets avec un message de succès
        header("Location: mes_trajets.php?message=Trajet supprimé avec succès.");
        exit();
    } else {
        $error = "Une erreur est survenue lors de la suppression du trajet.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer Trajet</title>
    <link rel="stylesheet" href="../vue/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Supprimer Trajet</h2>

        <?php if (!empty($error)): ?>
            <p><?= $error ?></p>
        <?php endif; ?>

        <p>Êtes-vous sûr de vouloir supprimer ce trajet ?</p>

        <form method="post">
            <button type="submit">Oui, Supprimer</button>
            <a href="mes_trajets.php">Annuler</a>
        </form>
    </div>
</body>
</html>
