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

// Créer une instance du contrôleur de trajet
$trajetController = new TrajetController();

// Récupérer le trajet spécifique par son ID
$trajet = $trajetController->getTrajetById($trajet_id);

// Vérifier si le trajet existe et appartient à l'utilisateur
if (!$trajet || $trajet['userid'] != $user_id) {
    header("Location: mes_trajets.php");
    exit();
}

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $villedepart = $_POST['villedepart'];
    $villearrive = $_POST['villearrive'];
    $date = $_POST['date'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];

    // Mettre à jour le trajet
    $success = $trajetController->updateTrajet($trajet_id, $user_id, $villedepart, $villearrive, $date, $prix, $description);

    if ($success) {
        // Rediriger vers la page des trajets avec un message de succès
        header("Location: mes_trajets.php?message=Trajet modifié avec succès.");
        exit();
    } else {
        $error = "Une erreur est survenue lors de la modification du trajet.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Trajet</title>
    <link rel="stylesheet" href="../vue/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Modifier Trajet</h2>

        <?php if (isset($error)): ?>
            <p><?= $error ?></p>
        <?php endif; ?>

        < method="post">
            <div>
                <label for="villedepart">Départ:</label>
                <input type="text" id="villedepart" name="villedepart" value="<?= $trajet['villedepart'] ?>" required>
            </div>
            <div>
                <label for="villearrive">Arrivée:</label>
                <input type="text" id="villearrive" name="villearrive" value="<?= $trajet['villearrivee'] ?>" required>
            </div>
            <div>
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" value="<?= $trajet['date'] ?>" required>
            </div>
            <div>
                <label for="prix">Prix:</label>
                <input type="text" id="prix" name="prix" value="<?= $trajet['prix']?>" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description" required><?= $trajet['description']?></textarea>
            </div>
            <div>
                <button type="submit">Enregistrer</button>
            </div>

            <div>
            <button type="cancel" onclick="javascript:window.location='../vue/dashbord.php';">Cancel</button>
            </div>

        </form>

        <!-- <form action="demo_form.asp" method="get">
  First name: <input type="text" name="fname"><br>
  Last name: <input type="text" name="lname"><br>
  <button type="submit" value="Submit">Submit</button>
  <button type="reset" value="Reset">Reset</button>
  <button type="cancel" onclick="javascript:window.location='http://stackoverflow.com';">Cancel</button>
</form> -->

    </div>
</body>
</html>
