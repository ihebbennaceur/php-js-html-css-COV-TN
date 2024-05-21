<?php
session_start();
require '../models/User.php';
require '../models/Connexion.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$connexion = Connexion::getConnexion();

// Récupérer les données du formulaire
$user_id = $_POST['user_id'] ?? null;
$name = $_POST['name'] ?? null;
$email = $_POST['email'] ?? null;
$phone = $_POST['phone'] ?? null;
$password = $_POST['password'] ?? null;
$password2 = $_POST['password2'] ?? null;
$photo = $_FILES['photo'] ?? null;

// Vérifier si toutes les données requises sont présentes
if ($user_id === null) {
    echo 'User ID is missing.';
} elseif ($name === null) {
    echo 'Name is missing.';
} elseif ($email === null) {
    echo 'Email is missing.';
} elseif ($phone === null) {
    echo 'Phone is missing.';
} elseif ($password === null) {
    echo 'Password is missing.';
} elseif ($password2 === null) {
    echo 'Password confirmation is missing.';
} elseif ($password !== $password2) {
    echo 'Passwords do not match.';
} else {
    // objet usr
    $user = new User();
    $user->setId($user_id);
    $user->setName($name);
    $user->setEmail($email);
    $user->setPhone($phone);
    $user->setPassword($password);

    // si ya pa de pic
    if ($photo && $photo['error'] == UPLOAD_ERR_OK) {
        $uploadDir = '../images/';
        $uploadFile = $uploadDir . basename($photo['name']);
        if (move_uploaded_file($photo['tmp_name'], $uploadFile)) {
            $user->setPhoto($photo['name']);
        } else {
            echo "Failed to move uploaded file.";
        }
    }

    // maj
    if ($user->updatedonnee($connexion, 'projetphp')) {

        $_SESSION['user_photo'] = $user->getPhoto();
        header('Location: ../vue/dashbord.php'); 
        exit();
    } else {
        echo 'Failed to update user details.';
    }
}
?>
