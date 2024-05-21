<?php
require './dashbord.php';
require '../models/User.php'; 
require '../models/Connexion.php';

$connexion = Connexion::getConnexion();
$user = new User();
$user->selection_id($connexion, $user_id);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion du Compte</title>
    <link rel="stylesheet" href="../vue/css/styles.css">
    <script>
        function afficherFormModifier() {
            window.location.href = '../vue/modifier_user.php'; // Redirection vers la page de modification
        }

        function afficherFormSupprimer() {
            document.getElementById('formSupprimer').style.display = 'block'; // Affichage du formulaire de suppression
        }
    </script>
    <style>
        /* Styles spécifiques pour cette page */
        .container {
            max-width: 900px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
            color: #333;
        }

        .container ul {
            list-style-type: none;
            padding: 0;
        }

        .container ul li {
            margin-bottom: 10px;
        }

        .btn-group {
            margin-top: 20px;
            text-align: center;
        }

        .btn-group button {
            margin: 0 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-modifier {
            background-color: #4CAF50;
            color: white;
        }

        .btn-supprimer {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Gestion du Compte</h2>
    <h3>Utilisateur numéro <?php echo $user->getId(); ?></h3>
    <ul>
        <li><strong>CIN:</strong> <?php echo $user->getCin(); ?></li>
        <li><strong>Nom:</strong> <?php echo $user->getName(); ?></li>
        <li><strong>Email:</strong> <?php echo $user->getEmail(); ?></li>
        <li><strong>Téléphone:</strong> <?php echo $user->getPhone(); ?></li>
        <li><strong>Photo:</strong> <?php echo $user->getPhoto(); ?></li>
    </ul>
    
    <div class="btn-group">
        <button class="btn-modifier" onclick="afficherFormModifier()">Modifier mes données</button>
        <button class="btn-supprimer" onclick="afficherFormSupprimer()">Supprimer mon compte</button>
    </div>

    <!-- Formulaire de suppression -->
    <form id="formSupprimer" style="display: none;" action="../controllers/supprimerController.php" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?');">
        <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>"> <!-- Champ caché pour envoyer user_id -->
        <button type="submit" class="btn-supprimer">Confirmer la suppression</button>
    </form>
</div>

</body>
</html>
