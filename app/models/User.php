<?php
// User.php
class User {
    private $nom;
    private $email;
    private $mot_de_passe;
    private $role_user;

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setMotDePasse($mot_de_passe) {
        $this->mot_de_passe = password_hash($mot_de_passe, PASSWORD_DEFAULT);
    }

    public function getMotDePasse() {
        return $this->mot_de_passe;
    }

    public function setRole_user($role_user) {
        $this->role_user = $role_user;
    }

    public function getRole_user() {
        return $this->role_user;
    }

    // Check email if exist 
    public function emailExists($pdo, $email){
        $sql = "SELECT id FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() ? true : false;
    }

    // Register function
    public function register($pdo) {
      $sql = "INSERT INTO users (nom, email, mot_de_passe, role_user)
              VALUES (:nom, :email, :mot_de_passe, :role_user)";   
      $stmt = $pdo->prepare($sql);
      
      return $stmt->execute([
        'nom' => $this->nom,
        'email' => $this->email,
        'mot_de_passe' => $this->mot_de_passe,
        'role_user' => $this->role_user
      ]);
    }

    // login function 
    public function login($pdo, $email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            return $user;
        }
        return false;
    }
}