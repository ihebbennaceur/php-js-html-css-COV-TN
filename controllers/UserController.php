<?php
require_once '../models/User.php';
require_once '../models/Connexion.php';

class UserController {
    public function getUserById($user_id) {
        $connexion = Connexion::getConnexion();
        $query = "SELECT * FROM projetphp WHERE id = ?";
        $p = $connexion->prepare($query);
        $p->execute([$user_id]);
        return $p->fetch(PDO::FETCH_ASSOC);
    }
}
?>
