<?php
// Student.php
class Student {
    private $id;
    private $user_id;
    private $nom;
    private $pays;
    private $niveau;

    public function getID() {
        return $this->id;
    }
    public function setID($id) {
        $this->id = $id;
    }

    public function getUserId() {
        return $this->user_id;
    }
    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function getNom() {
        return $this->nom;
    }
    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getPays() {
        return $this->pays;
    }
    public function setPays($pays) {
        $this->pays = $pays;
    }

    public function getNiveau() {
        return $this->niveau;
    }
    public function setNiveau($niveau) {
        $this->niveau = $niveau;
    }

    // Create function
    public function create($pdo){
        try{
            $sql = "INSERT INTO students (user_id, nom, pays, niveau)
                    VALUES (:user_id, :nom, :pays, :niveau)";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([
                'user_id' => $this->user_id,
                'nom' => $this->nom,
                'pays' => $this->pays,
                'niveau' => $this->niveau
            ]);
        } catch (PDOException $e){
            error_log("Student create error: " . $e->getMessage());
            throw $e; 
        }
    }

}
