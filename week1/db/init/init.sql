DROP DATABASE IF EXISTS TEST;
CREATE DATABASE TEST CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE TEST;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password CHAR(64) NOT NULL
) ENGINE=InnoDB;

INSERT INTO users (username, password) VALUES ('admin', SHA2('adminn',256)), ('guest', SHA2('guest',256));

CREATE TABLE boards (
  id INT AUTO_INCREMENT PRIMARY KEY,
  writer VARCHAR(50) NOT NULL,
  title CHAR(64) NOT NULL,
  content text NOT NULL
) ENGINE=InnoDB;

INSERT INTO boards (writer, title, content) VALUES ('admin', 'Notice', "Hello everyone!!");
