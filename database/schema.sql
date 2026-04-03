CREATE DATABASE IF NOT EXISTS surfschool;

USE surfschool;

-- users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    role_user ENUM('admin', 'surfeur') DEFAULT 'surfeur',
    cree_le DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- students
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    nom VARCHAR(100) NOT NULL,
    pays VARCHAR(100),
    niveau ENUM('debutant','intermediaire','avance') DEFAULT 'debutant',
    cree_le DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- lessons
CREATE TABLE lessons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(150) NOT NULL,
    coach VARCHAR(100) NOT NULL,
    date_heure DATETIME NOT NULL,
    niveau_requis ENUM('debutant','intermediaire','avance') DEFAULT 'debutant',
    places_max INT DEFAULT 8,
    price DECIMAL(10,2) NOT NULL,
    cree_le DATETIME DEFAULT CURRENT_TIMESTAMP
);  

-- inscriptions (Pivot Table محسنة)
CREATE TABLE inscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    student_id INT NOT NULL,
    lesson_id INT NOT NULL,
    statut_paiement ENUM('paid','pending') DEFAULT 'pending',

    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (lesson_id) REFERENCES lessons(id) ON DELETE CASCADE
);