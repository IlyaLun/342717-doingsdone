CREATE DATABASE doingsdone;

USE doingsdone;

CREATE TABLE category (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title CHAR(255) NOT NULL,
  user_id INT NOT NULL,

  UNIQUE INDEX category (title, user_id),
  INDEX category_title (title)
);

CREATE TABLE task (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_of_creation DATETIME NOT NULL,
  date_of_completion DATETIME,
  title CHAR(255) NOT NULL,
  file_link CHAR(255),
  deadline DATETIME,
  category_id INT NOT NULL,
  user_id INT NOT NULL,

  INDEX task_title (title)
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email CHAR(128),
  name CHAR(128),
  password CHAR(60),
  date_registration DATETIME NOT NULL,
  contacts TEXT,

  UNIQUE INDEX user (email)
);
