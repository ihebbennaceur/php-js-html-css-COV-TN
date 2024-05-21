<?php
require_once '../models/Connexion.php';
require_once '../models/User.php';

if (isset($_POST['recuperer'])) {

    $email = $_POST['email'];
    $cin = $_POST['cin'];
    
    $user = new User();
    $connexion = Connexion::getConnexion();

    $pwd = $user->getPasswordFromDatabase($connexion, $email, $cin);

    if ($pwd !== null) {
       // echo "Votre mot de passe est : " . $pwd;
       echo "
       <script>
        alert('Votre mot de passe est : " . $pwd . "');
        window.location.href = '../vue/login_form.php';
    
       </script>
       
       ";
    } else {
        
        //echo "Aucun utilisateur correspondant trouvé";

        echo "
        <script>
        alert('Aucun utilisateur correspondant trouvé');
        window.location.href='../vue/mdp.php' ;
        </script> 
        ";
        
    }
}
?>
