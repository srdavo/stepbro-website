CREATE DATABASE sb_notes;
USE sb_notes;

CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT(20) NOT NULL,
    title VARCHAR(255),
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE folders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT(20) NOT NULL,
    folder_name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE folder_relations(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT(20) NOT NULL,
    folder_id INT NOT NULL,
    item_id INT NOT NULL,
    item_type ENUM('note', 'folder') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

