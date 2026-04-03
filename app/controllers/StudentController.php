<?php
session_start(); 
require_once __DIR__ . "/../../database/db.php";
require_once __DIR__ . "/../models/Student.php";

class StudentController {
  private $pdo;

  public function __construct() {
    try {
      $db = new Database();
      $this->pdo = $db->connect();
    } catch (Exception $e) {
      error_log('DB connection failed: ' . $e->getMessage());
      die('Something went wrong. Please try again later.');
    }
  }

  // list all students function
  public function index() {
    try {
      $students = Student::getAll($this->pdo);
    } catch (Exception $e) {
      error_log('Index error: '. $e->getMessage());
      $students = [];
      exit;
    }
    require __DIR__ . '/../views/students.php';
  }

  // Store new student function
  public function store() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $nom = trim($_POST['nom'] ?? '');
      $pays = trim($_POST['pays'] ?? '');
      $niveau = $_POST['niveau'] ?? 'debutant';
      $user_id  = $_POST['user_id'] ?? $_SESSION['user_id'];

      if (empty($nom)){
        header("Location: ../app/views/add_student.php?error=empty");
        exit;
      }
      
      $student = new Student();
      $student->setUserId($user_id);
      $student->setNom($nom);
      $student->setPays($pays);
      $student->setNiveau($niveau);
    }
    
    try {
      if ($student->create($this->pdo)) {
        header("Location: StudentController.php?action=index&success=added");
        exit;
      } else {
        header("Location: ../app/views/add_student.php?error=failed");
        exit;
      }
    } catch (Exception $e) {
      error_log("Store student error: " . $e->getMessage());
      header("Location: ../app/views/add_student.php?error=failed");
      exit;
    }
  }

  // Show update from
  public function edit() {
    $id = $_GET["id"] ?? null;
    if (!$id) {
      header("Location: StudentController.php?action=index");
      exit;
    }

    try {} catch (Exception $e) {
      error_log("Edit student error: ". $e->getMessage());
      header("Location: StudentController.php?action=index&error=failed");
      exit;
    }
  }

  // Update student
  public function update() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $id = $_POST["id"] ?? null;
      $nom = trim($_POST["nom"] ??"");
      $pays = trim($_POST["pays"] ??"");
      $niveau = trim($_POST["niveau"] ??"debutand");

      if (empty($id) || empty($nom)){
        header("Location: ../views/edit_student.php?id=$id&error=empty");
        exit;
      }

      $student = new Student();
      $student->setId($id);
      $student->setNom($nom);
      $student->setPays($pays);
      $student->setNiveau($niveau);

      try{} catch (Exception $e) {
        error_log("Update student error: ". $e->getMessage());
        header("Location: ../views/edit_student.php?id=$id&error=failed");
        exit;
      }
    }
  }

  // Delete student function
  public function delete() {
    $id = $_GET["id"] ?? null;
    if (!$id) {
      try {
        Student::delete($this->pdo, $id);
        header("Location: StudentController.php?action=index&success=deleted");
      } catch (Exception $e) {
        error_log("Delete student error: ". $e->getMessage());
        header("Location: StudentController.php?action=index&error=failed");
        exit;
      }
      header("Location: StudentController.php?action=index");
      exit;
    }
  }
}

$controller = new StudentController();
$action = $_GET['action'] ?? 'index';
switch ($action) {
    case 'index':   $controller->index(); break;
    case 'store':   $controller->store(); break;
    case 'edit':    $controller->edit(); break;
    case 'update':  $controller->update(); break;
    default:        $controller->index();
}