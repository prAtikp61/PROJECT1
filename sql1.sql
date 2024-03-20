CREATE DATABASE app;
USE app;
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL, -- Change the length according to your needs
    photo BLOB
);
INSERT INTO users (name, email, password) 
VALUES ('Aryan', 'aryanoak@123', '1234');

CREATE USER 'root'@'127.0.0.1:3306' IDENTIFIED BY '1234';
GRANT ALL PRIVILEGES ON app.* TO 'root'@'127.0.0.1:3306';
FLUSH PRIVILEGES;

SELECT * FROM users;
