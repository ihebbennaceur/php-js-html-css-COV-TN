<?php
require 'dashbord.php';
require '../models/User.php'; 
require '../models/Connexion.php';

$user_id = $_SESSION['user_id'] ?? null;

if ($user_id === null) {
    die('Utilisateur non défini');
}

$connexion = Connexion::getConnexion();

$user = new User();
$user->selection_id($connexion, $user_id);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Utilisateur</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        /* Container styles */
        .container {
            max-width: 920px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Form styles */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form label {
            font-weight: bold;
            margin-bottom: 8px;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"],
        form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.2s ease-in-out;
        }

        form input[type="text"]:focus,
        form input[type="email"]:focus,
        form input[type="password"]:focus {
            outline: none;
            border-color: #4CAF50;
        }

        form button[type="submit"],
        form button[type="button"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        form button[type="submit"] {
            background-color: #4CAF50;
            color: white;
        }

        form button[type="submit"]:hover {
            background-color: #45a049;
        }

        form button[type="button"] {
            background-color: #ccc;
            color: #000;
        }

        form button[type="button"]:hover {
            background-color: #bbb;
        }

        /* Profile picture */
        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-top: 20px;
            border: 2px solid #ccc;
        }

        /* Heading styles */
        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Modifier Utilisateur</h2>
        <form action="../controllers/updateUserController.php" method="post" enctype="multipart/form-data">
            <label for="ID">ID: <?php echo $user_id; ?></label>
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

            <label for="name">Nom:</label>
            <input type="text" id="name" name="name" value="<?php echo $user->getName(); ?>">
            <br> 
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user->getEmail(); ?>">
            <br> 
            <label for="phone">Téléphone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $user->getPhone(); ?>">
            <br>
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" value="">
            <br>
            <label for="password2">Retaper le mot de passe:</label>
            <input type="password" id="password2" name="password2" value="">
            <br>
            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo">
            <br>
            <button type="submit">Enregistrer les modifications</button>
        
            <br> 
            <button type="button" onclick="redirectToDashboard()">Annuler La modifications</button>
        </form>

        <script type="text/javascript">
            function redirectToDashboard() {
                window.location.href = '../vue/dashbord.php';
            }
        </script>
    </div>
</body>
</html>
