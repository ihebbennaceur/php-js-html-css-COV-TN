<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit();
}


if (!isset($_GET['userid'])) {
    header("Location: mes_trajets.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$profile_user_id = $_GET['userid'];


require_once '../models/Connexion.php';
require_once '../controllers/UserController.php';

$userController = new UserController();


$user = $userController->getUserById($profile_user_id);


if (!$user) {
    header("Location: mes_trajets.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="../vue/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Profil de l'utilisateur</h2>

        <p><strong>Nom:</strong> <?= $user['nom'] ?></p>
        <p><strong>Email:</strong> <?= $user['email'] ?></p>
        

        <a href="rechercher_trajet.php">Retour aux trajets</a>
    </div>
</body>
</html>
