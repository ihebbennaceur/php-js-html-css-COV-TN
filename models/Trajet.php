<?php
class Trajet {
    private $id;
    private $villedepart;
    private $villearrive;
    private $date;
    private $prix;
    private $description;
    private $userid;

   public function setVilledepart( $villedepart) {$this->villedepart=$villedepart;}
   public function getVilledepart() {return $this->villedepart;}
   public function setVillearrive( $villearrive) {$this->villearrive=$villearrive;}
   public function getVillearrive() {return $this->villearrive;}
   public function setDate( $date) {$this->date=$date;}
   public function getDate() {return $this->date;}
   public function setPrix( $prix) {$this->prix=$prix;}
   public function getPrix() {return $this->prix;}
   public function setDescription( $description) {$this->description=$description;}
   public function getDescription() {return $this->description;}
   public function setuserid( $userid) {$this->userid=$userid;}
   public function getuserid() {return $this->userid;}





    

    public function ajouterTrajet($connexion) {
        $query = "INSERT INTO trajets (villedepart, villearrivee, date, prix, description, userid) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connexion->prepare($query);
        $stmt->execute([$this->villedepart, $this->villearrive, $this->date, $this->prix, $this->description, $this->userid]);
        
        return $stmt->rowCount() > 0;
    }

    
}
?>
