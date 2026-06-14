-- schema.sql
-- Student Information Management System - Tanzania
-- Import this file into phpMyAdmin (or run via: mysql -u root -p < schema.sql)

CREATE DATABASE IF NOT EXISTS school_db
  DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE school_db;

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

-- Optional sample data
INSERT IGNORE INTO students
  (reg_no, full_name, gender, date_of_birth, level, class_form,
   school_name, region, district, parent_name, parent_phone)
VALUES
  ('S/2026/001','Asha John Mwakyusa','Female','2010-04-12','Secondary','Form 2',
   'Azania Secondary School','Dar es Salaam','Ilala','John Mwakyusa','+255712345678'),
  ('P/2026/002','Juma Hassan Mbaga','Male','2014-09-03','Primary','Std IV',
   'Mlimani Primary School','Mwanza','Nyamagana','Hassan Mbaga','+255754112233');
