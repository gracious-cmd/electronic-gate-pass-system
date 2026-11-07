CREATE DATABASE IF NOT EXISTS electronic_gate_pass CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE electronic_gate_pass;

CREATE TABLE IF NOT EXISTS users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(120) NOT NULL,
 email VARCHAR(150) NOT NULL UNIQUE,
 password VARCHAR(255) NOT NULL,
 role ENUM('admin','security') NOT NULL DEFAULT 'security',
 status ENUM('active','inactive') NOT NULL DEFAULT 'active',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS visitors (
 id INT AUTO_INCREMENT PRIMARY KEY,
 pass_no VARCHAR(40) NOT NULL UNIQUE,
 name VARCHAR(120) NOT NULL,
 phone VARCHAR(30) NOT NULL,
 email VARCHAR(150) NULL,
 host_name VARCHAR(120) NOT NULL,
 purpose TEXT NOT NULL,
 visit_date DATE NOT NULL,
 visit_time TIME NOT NULL,
 status ENUM('pending','approved','rejected','completed') NOT NULL DEFAULT 'pending',
 reviewed_by INT NULL,
 entry_time DATETIME NULL,
 entry_by INT NULL,
 exit_time DATETIME NULL,
 exit_by INT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT fk_visitor_reviewer FOREIGN KEY (reviewed_by) REFERENCES users(id) ON DELETE SET NULL,
 CONSTRAINT fk_visitor_entry FOREIGN KEY (entry_by) REFERENCES users(id) ON DELETE SET NULL,
 CONSTRAINT fk_visitor_exit FOREIGN KEY (exit_by) REFERENCES users(id) ON DELETE SET NULL,
 INDEX idx_visitors_status(status),
 INDEX idx_visitors_date(visit_date)
) ENGINE=InnoDB;
