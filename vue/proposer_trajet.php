<?php
require_once '../controllers/TrajetController.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $villedepart = $_POST['villedepart'];
    $villearrive = $_POST['villearrive'];
    $date = $_POST['date'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];

    $controller = new TrajetController();
    if ($controller->ajouterTrajet($villedepart, $villearrive, $date, $prix, $description, $user_id)) {
        echo "Trajet ajouté avec succès";
        header("Location: mes_trajets.php");
    } else {
        echo "Erreur lors de l'ajout du trajet";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Trajet</title>
</head>
<body>
<nav>
            <ul>
            <li><a href="dashbord.php">Accueil</a></li>
                
            </ul>
    <form method="POST" action="ajouter_trajet.php">
        <label for="villedepart">Ville de départ:</label>
        <input type="text" id="villedepart" name="villedepart" required><br>
        
        <label for="villearrive">Ville d'arrivée:</label>
        <input type="text" id="villearrive" name="villearrive" required><br>
        
        <label for="date">Date:</label>
        <input type="text" id="date" name="date" required><br>
        
        <label for="prix">Prix:</label>
        <input type="text" id="prix" name="prix" required><br>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>
        
        <button type="submit">Ajouter Trajet</button>
    </form>
</body>
</html>
