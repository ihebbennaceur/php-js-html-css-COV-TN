<?php
require_once '../models/Trajet.php';
require_once '../models/Connexion.php';

class TrajetController {
    public function ajouterTrajet($villedepart, $villearrive, $date, $prix, $description, $userid) {
        $trajet = new Trajet();
        $trajet->setVilledepart($villedepart);
        $trajet->setVillearrive($villearrive);
        $trajet->setDate($date);
        $trajet->setPrix($prix);
        $trajet->setDescription($description);
        $trajet->setUserid($userid);

        $connexion = Connexion::getConnexion();
        return $trajet->ajouterTrajet($connexion);
    }

    public function getTrajetsByUserId($user_id) {
        $connexion = Connexion::getConnexion();
        $query = "SELECT * FROM trajets WHERE userid = ?";
        $st = $connexion->prepare($query);
        $st->execute([$user_id]);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTrajetById($trajet_id) {
        $connexion = Connexion::getConnexion();
        $query = "SELECT * FROM trajets WHERE id = ?";
        $st = $connexion->prepare($query);
        $st->execute([$trajet_id]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }
    

    public function supprimerTrajet($trajet_id, $user_id) {
        $connexion = Connexion::getConnexion();
        $query = "DELETE FROM trajets WHERE id = ? AND userid = ?";
        $st = $connexion->prepare($query);
        $st->execute([$trajet_id, $user_id]);
        return $st->rowCount() > 0;
    }

    public function updateTrajet($trajet_id, $user_id, $newdep, $newarriv, $newdate, $newprix, $newdescription) {
        $connexion = Connexion::getConnexion();
        $query = "UPDATE trajets SET villedepart = ?, villearrivee = ?, date = ?, prix = ?, description = ? WHERE id = ? AND userid = ?";
        $st = $connexion->prepare($query);
    
        $st->execute([$newdep, $newarriv, $newdate, $newprix, $newdescription, $trajet_id, $user_id]);
        
        return $st->rowCount() > 0;

    }


    public function searchTrajets($ville) {
        $connexion = Connexion::getConnexion();
        $query = "SELECT * FROM trajets WHERE villedepart = ? OR villearrivee = ?";
        $st = $connexion->prepare($query);
        $st->execute([$ville, $ville]);
        return $st->fetchAll(PDO::FETCH_ASSOC);

}

public function selectall() {
    $connexion = Connexion::getConnexion();
    $query = "SELECT * FROM trajets ";

    $st = $connexion->prepare($query);
    $st->execute();

    return $st->fetchAll(PDO::FETCH_ASSOC);

}
}

?>
