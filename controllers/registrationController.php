<?php
require_once '../models/User.php';
require_once '../models/Connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmedpassword'];
    $cin = $_POST['cin'];
    $photo = '';

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photo = $_FILES['photo']['name'];
        $photoTmpName = $_FILES['photo']['tmp_name'];
        $photoDir = "../images/";
        $photoPath = $photoDir . basename($photo);

        if (!move_uploaded_file($photoTmpName, $photoPath)) {
            echo "Erreur lors du téléchargement de la photo.";
            exit;
        }
    } else {
        echo "Erreur lors du téléchargement de la photo.";
        exit;
    }

    if ($password !== $confirmPassword) {
        echo "Les mots de passe ne correspondent pas.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "L'email n'est pas valide.";
        exit;
    }

    $connexion = Connexion::getConnexion();
    $user = new User();
    $user->setName($name);
    $user->setEmail($email);
    $user->setPhone($phone);
    $user->setPassword($password);
    $user->setCin($cin);
    $user->setPhoto($photo); // Stocke seulement le nom de la photo

    $_SESSION['user_photo'] = $photo;
    $user->ajouterUtilisateur($connexion);


    echo "<script>
    alert('Inscription réussie ! Vous pouvez maintenant vous connecter.');
    window.location.href = '../vue/login_form.php';
  </script>";
}
?>
