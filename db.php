<?php
// db.php - MySQL database connection for the Student Information Management System
// Case Study: Primary and Secondary Schools in Tanzania
//
// SETUP (one-time):
// 1. Start MySQL (e.g. XAMPP / WAMP / MAMP / standalone MySQL).
// 2. Open phpMyAdmin or the MySQL CLI and import the file `schema.sql`
//    (it creates the database `school_db` and the `students` table),
//    OR just create the database manually:  CREATE DATABASE school_db;
//    The table will then be auto-created on first page load.
// 3. Adjust the credentials below if yours differ.

$DB_HOST = 'localhost';
$DB_NAME = 'school_db';
$DB_USER = 'root';
$DB_PASS = '';            // XAMPP default = empty
$DB_PORT = 3306;

try {
    $dsn = "mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME;charset=utf8mb4";
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);

    // Auto-create the students table on first run
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS students (
            id            INT AUTO_INCREMENT PRIMARY KEY,
            reg_no        VARCHAR(50)  NOT NULL UNIQUE,
            full_name     VARCHAR(150) NOT NULL,
            gender        ENUM('Male','Female') NOT NULL,
            date_of_birth DATE         NOT NULL,
            level         ENUM('Primary','Secondary') NOT NULL,
            class_form    VARCHAR(20)  NOT NULL,
            school_name   VARCHAR(150) NOT NULL,
            region        VARCHAR(60)  NOT NULL,
            district      VARCHAR(60)  NOT NULL,
            parent_name   VARCHAR(150) NOT NULL,
            parent_phone  VARCHAR(20)  NOT NULL,
            created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");
} catch (PDOException $e) {
    die('Database error: ' . htmlspecialchars($e->getMessage()) .
        '<br><br>Make sure MySQL is running and the database <b>' . $DB_NAME .
        '</b> exists. See db.php for setup instructions.');
}
