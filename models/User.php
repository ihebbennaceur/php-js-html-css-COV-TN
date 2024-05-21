<?php

class User {
    private $id;
    private $name;
    private $email;
    private $phone;
    private $password;
    private $cin;

private $photo;

    // Constructeur
    public function __construct($id = null, $name = null, $email = null, $phone = null, $password = null, $cin = null,$photo=null) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->cin = $cin;
        $this->photo=$photo;
    }
    


    // Getters and Setters
    public function setCin($cin) {
        $this->cin = $cin;
    }

    public function getId() {
        return $this->id;
    }

    public function getCin() {
        return $this->cin;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getPassword() {
        return $this->password;
    }

public function getPhoto() { return $this->photo;}
public function setPhoto($photo){$this->photo = $photo;}

    public function ajouterUtilisateur($connexion) {
        $query = "INSERT INTO projetphp (id, nom, email, phone, password, cin,photo) VALUES (default, ?, ?, ?, ?, ?,?)";
        $statement = $connexion->prepare($query);
        $statement->execute([$this->name, $this->email, $this->phone, $this->password, $this->cin,$this->photo]);
        if ($statement->rowCount() > 0) {
            echo "Utilisateur inséré avec succès !";
        }
    }

    public function selection_id($conn,$id){
        //requete parametrée
        $st=$conn->prepare("select * from projetphp where ID=?");
        $st->execute(array($id));
        $row=$st->fetch();

        $this->cin=$row["cin"];
        $this->id=$row["id"];
        $this->name=$row["nom"];
        $this->email=$row["email"];
        $this->phone=$row["phone"];
        $this->photo=$row['photo'];
        

        // $this->nom=$row['nom'];
        // $this->prenom=$row['prenom'];
        // $this->age=$row['age'];
        // $this->sexe=$row['sexe'];
        // $this->ville=$row['ville'];
        // $this->competence=$row['competence'];
        // $this->photo=$row['photo'];
    }

    public function selectiondb($connexion, $vb1, $vb2, $email, $password) {
        $query = "SELECT $vb1 FROM $vb2 WHERE email = ? AND password = ?";
        $statement = $connexion->prepare($query);
        $statement->execute([$email, $password]);
        $result = $statement->fetch();
        if ($result) {
           
            $this->id = $result['id'];
            $this->name = $result['nom']; //le nom dans la base donne est nom ici c name
          
            $this->email = $result['email'];

            $this->password = $result['password'];
            $this->phone = $result['phone'];

            $this->cin = $result['cin'];
            $this->photo = $result['photo'];
            
            
        } else {
            $this->email = null;
            $this->password = null;
        }
    }

    public function getPasswordFromDatabase($connexion, $email, $cin) {
        $query = "SELECT password FROM projetphp WHERE email = ? AND cin = ?";

        $statement = $connexion->prepare($query);
        $statement->execute([$email, $cin]);

        $result = $statement->fetch();
        

        if ($result) {
            return $result['password'];
        } else {
            return null;
        }
    }

    
    public function updatedonnee($conn,$tablename) { //pour utliser ca plustard avec les autres entites
        // Préparer la requête de mise à jour
        $stmt = $conn->prepare("UPDATE ". $tablename." SET nom=?, email=?, phone=?, password=?, photo=? WHERE ID=?");
    
        // Exécuter la requête sur les valeurs de la personne sélectionnée
        $r = $stmt->execute([$this->name, $this->email, $this->phone, $this->password, $this->photo, $this->id]);
    
        // Vérifier si la mise à jour a réussi
        if ($r) {
            return true;
        } else {
            return false;
        }
    }
    


     public function supprimer($conn,$usrid,$tablename){
        //$st=$conn->prepare("delete from personne where ID=?");
        $st=$conn->prepare("delete from ". $tablename. " where ID=?");
        $st->execute(array($usrid));
    }

    //no neeed 
    public function getIdFromDatabase($connexion, $email, $password,$tablename) {
        $query = "SELECT id FROM ". $tablename ." WHERE email = ? AND password = ?";
        $statement = $connexion->prepare($query);

        $statement->execute([$email, $password]);
        $result = $statement->fetch();

        if ($result) {
            return $result['id'];
        } else {
            return null;
        }
    }


public function getPhotofromdb($connexion, $user_id, $tablename) {
    $query = "SELECT photo FROM ".$tablename." WHERE id = ?";
    $statement = $connexion->prepare($query);
    $statement->execute([$user_id]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result && isset($result['photo'])) {
        return $result['photo'];
    } else {
        return 'default.jpg'; 
    }
}


   
}
?>
