<?php
require '../models/User.php';
require '../models/Connexion.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$connexion = Connexion::getConnexion();

$user_id = $_POST['user_id'] ?? null;

if ($user_id === null) {
    die('User ID is missing.');
}

$user = new User();
if ($user->supprimer($connexion, $user_id,'projetphp')) {
    session_destroy(); 
    header('Location: ../vue/login_form.php'); 
    exit;
} else {
    echo 'votre compte a été supprimé.';
}
?>
