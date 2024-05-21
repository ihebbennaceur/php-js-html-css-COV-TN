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
        echo "Trajet ajouté avec succès ";
        
        header("Location: mes_trajets.php");
        exit();
        //echo '<a href="../vue/mes_trajet.php">  Mes trajets trajets</a>';
        
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

    <!-- <link rel="stylesheet" href="../vue/css/styles.css"> -->
    <title>Ajouter Trajet</title>

   
</head>
<body>

</body>
</html>
