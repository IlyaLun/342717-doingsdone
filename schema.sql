CREATE TABLE 'categories' (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title CHAR(128)
);

CREATE TABLE 'tasks' (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_of_creation DATETIME,
  date_of_completion DATETIME,
  title CHAR(128),
  link_to_file CHAR,
  deadline DATETIME,
  categories_id INT NOT_NULL,
  user_id INT
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email CHAR(128),
  name CHAR(128),
  password CHAR(32),
  date_registration DATETIME,
  contacts CHAR(128),

);
