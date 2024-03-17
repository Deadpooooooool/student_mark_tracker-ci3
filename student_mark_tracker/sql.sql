-- Create the database and use it (this part is usually done in your DB management tool)
CREATE DATABASE IF NOT EXISTS student_mark_tracker_db;
USE student_mark_tracker_db;

-- Create a table for students
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create a table for marks
CREATE TABLE IF NOT EXISTS marks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    month INT NOT NULL,
    marks INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id)
);

-- Seed data for 'students' table
INSERT INTO students (id, student_name, created_at) VALUES
(1, 'John Doe', '2024-03-17 17:34:27'),
(2, 'Jack', '2024-03-17 17:35:06'),
(3, 'Ben', '2024-03-17 18:51:16'),
(4, 'Peter', '2024-03-17 23:19:16'),
(5, 'Parker', '2024-03-17 23:20:38'),
(6, 'Donny', '2024-03-17 23:21:57'),
(7, 'Tom', '2024-03-17 23:22:59'),
(8, 'Mike', '2024-03-18 02:53:06'),
(9, 'John', '2024-03-18 03:26:18');

-- Seed data for 'marks' table
INSERT INTO marks (id, student_id, month, marks, created_at) VALUES
(1, 1, 1, 50, '2024-03-17 17:34:27'),
(2, 2, 1, 60, '2024-03-17 17:35:06'),
(3, 3, 4, 15, '2024-03-17 18:51:16'),
(4, 4, 2, 55, '2024-03-17 23:19:16'),
(5, 5, 2, 60, '2024-03-17 23:20:38'),
(6, 6, 4, 55, '2024-03-17 23:21:57'),
(7, 7, 3, 65, '2024-03-17 23:22:59'),
(9, 7, 4, 67, '2024-03-18 01:47:56'),
(10, 7, 5, 70, '2024-03-18 01:48:26'),
(11, 3, 5, 77, '2024-03-18 01:51:31'),
(12, 7, 6, 80, '2024-03-18 02:13:43'),
(13, 8, 7, 82, '2024-03-18 02:53:06'),
(14, 2, 4, 56, '2024-03-18 03:13:47'),
(15, 9, 8, 70, '2024-03-18 03:26:18');
