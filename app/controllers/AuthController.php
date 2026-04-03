<?php
// AuthController.php
session_start();
require_once '../../database/db.php';
require_once '../models/User.php';

class AuthController {
  private $pdo;

  public function __construct() {
    $db = new Database();
    $this->pdo = $db->connect();
  }
  // Registration function
  public function register(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $nom = trim($_POST['nom'] ?? '');
      $email = trim($_POST['email'] ?? '');
      $password = $_POST['password'] ?? '';

      if (empty($nom) || empty($email) || empty($password)) {
        header("Location: ../../app/views/register.php?error=empty");
        exit;
      }

      $user = new User();

      if ($user->emailExists($this->pdo, $email)) {
        header("Location: ../../app/views/register.php?error=email_exists");
        exit;
      }

      $user->setNom($nom);
      $user->setEmail($email);
      $user->setMotDePasse($password);
      $user->setRole_user('surfeur');

      try {
        if ($user->register($this->pdo)){
            header("Location: ../../app/views/login.php?success=registered");
            exit;
        } else {
          header("Location: ../../app/views/register.php?error=failed");
          exit;
        }
      } catch (PDOException $e) {
          if ($e->getCode() == 23000) {
              echo "This email is already registered!";
          } else {
            header("Location: ../../app/views/register.php?error=failed");
            exit;
          }
      }
    }
  }

  // login function
  public function login() {
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $email = trim($_POST['email'] ?? '');
      $password = $_POST['password'] ?? '';

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../../app/views/login.php?error=invalid_email");
        exit;
      }
      try {
        $user = new User();
        $result = $user->login($this->pdo, $email, $password);

        if ($result) {
          $_SESSION['user_id'] = $result['id'];
          $_SESSION['user_nom'] = $result['nom'];
          $_SESSION['user_role'] = $result['role_user'];

          if ($result['role_user'] == 'admin') {
            header('Location: ../../app/views/dashboard.php');
          } else {
            header('Location: ../../app/views/my_lessons.php');
          }
          exit;
        } else {
          header('Location: ../../app/views/login.php?error=invalid');
          exit;
        }
      } catch (Exception $e) {
        error_log("Login error: " . $e->getMessage());
        header("Location: ../../app/views/login.php?error=failed");
        exit;
      }
    }
  }

  // Logout functions
  public function logout() {
    session_destroy();
    header("Location: ../../app/views/login.php?success=logout");
    exit;
  }
}
$auth = new AuthController();
$action = $_GET['action'] ?? '';
if ($action === 'login') {
    $auth->login();
} else {
    $auth->register();
}


