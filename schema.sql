-- Database: cert_system
CREATE DATABASE  college_event;
USE college_event;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Plain text as requested
    name VARCHAR(100) NOT NULL,
    roll_number VARCHAR(50) NOT NULL UNIQUE,
    class VARCHAR(50) NOT NULL,
    department VARCHAR(100) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user'
);

CREATE TABLE IF NOT EXISTS certificates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    event_name VARCHAR(100) NOT NULL,
    event_description TEXT,
    category ENUM('Winner', 'Runner', 'Participant') NOT NULL,
    template_id INT NOT NULL,
    issue_date DATE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_cert (user_id, event_name) -- Prevent duplicates
);

CREATE TABLE IF NOT EXISTS correction_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    certificate_id INT NOT NULL,
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    status ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (certificate_id) REFERENCES certificates(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Default Admin
INSERT INTO users (username, password, name, roll_number, class, department, role) 
VALUES ('admin', 'admin123', 'System Admin', 'ADMIN001', 'N/A', 'Administration', 'admin')
ON DUPLICATE KEY UPDATE id=id;
