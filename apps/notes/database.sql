CREATE DATABASE sb_notes;
USE sb_notes;

CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT(20) NOT NULL,
    title VARCHAR(255),
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status TINYINT(1) DEFAULT 1
);

CREATE TABLE folders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT(20) NOT NULL,
    folder_name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status TINYINT(1) DEFAULT 1
);

CREATE TABLE folder_relations(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT(20) NOT NULL,
    folder_id INT NOT NULL,
    item_id INT NOT NULL,
    item_type ENUM('note', 'folder') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE diary (
  id int AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT(20) NOT NULL,
  content TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Modificaciones que agregar
ALTER TABLE notes ADD status TINYINT(1) DEFAULT 1;


CREATE TABLE tasks (
  id INT NOT NULL AUTO_INCREMENT,
  user_id BIGINT(20) NOT NULL,
  task VARCHAR(255) NOT NULL,
  description TEXT,
  limit_date DATE,
  status ENUM('Pendiente', 'Activo', 'Terminado', '0', '1') DEFAULT 'Pendiente',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)


-- Modiifcacion ya agregadas *IGNORAR*
ALTER TABLE notes ADD status TINYINT(1) DEFAULT 1;
ALTER TABLE folders ADD status TINYINT(1) DEFAULT 1;

-- Modificaciones que agregar *NO IGNORAR*
ALTER TABLE tasks MODIFY status ENUM('Pendiente', 'Activo', 'Terminado', '0', '1') DEFAULT 'Pending';

ALTER TABLE tasks ADD description TEXT AFTER task;
ALTER TABLE tasks ADD limit_date DATE AFTER description;

ALTER TABLE tasks add last_status ENUM('Pendiente', 'Activo', 'Terminado', '0', '1') DEFAULT '1';


