<?php
require_once("../models/MaClasseCoockies.php");
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_photo = $_SESSION['user_photo'] ?? 'default.jpg'; // Image par défaut
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="../vue/css/styles.css">
</head>
<body>
    
    <div class="container">
        <h2>Bienvenue dans le tableau de bord utilisateur numéro : <?php echo $user_id; ?></h2>
        
        <!-- Affichage de la photo de profil -->
        <img src="<?php echo "../images/".$user_photo ; ?>" alt="Photo de profil" class="profile-picture">

        <!-- Affichage du nom de l'utilisateur -->
        <h5><?php echo MaClasseCoockies::mafonctioncookie($user_id); ?></h5>



        <!-- Navigation -->
        <nav>
            <ul>
                <li><a href="../vue/gestion_compte.php">Gestion de compte</a></li>
                <li><a href="../vue/gestion_trajet.php">Gestion des trajets</a></li>
                <li><a href="#gestion_paiements">Gestion des paiements</a></li>
                <li><a href="#gestion_reservations">Gestion des réservations</a></li>
                <li><a href="../vue/logout.php">Déconnexion</a></li>
            </ul>
        </nav>

    </div>
    
</body>
</html>
