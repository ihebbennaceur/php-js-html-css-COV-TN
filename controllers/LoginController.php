
<?php
session_start(); 

require_once '../models/User.php';
require_once '../models/Connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $connexion = Connexion::getConnexion();
    $user = new User();

    // vérifier les identifiants
    $user->selectiondb($connexion, "*", "projetphp", $email, $password);

    // récupérer ID et la photo
    if ($user->getEmail() !== null && $user->getPassword() !== null) {
        $userId = $user->getIdFromDatabase($connexion, $email, $password, 'projetphp');
        
        $userPhoto = $user->getPhotofromdb($connexion, $userId, 'projetphp');

        // l'ID et la photo dans la session
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_photo'] = $userPhoto;

        // vers le tableau de bord
        header("Location: /php/cov-tn/vue/dashbord.php");
        exit();
    } else {
        echo "Connexion échouée. Vérifiez vos identifiants.";
    }
}
?>
