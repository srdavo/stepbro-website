CREATE DATABASE sb_mind;
USE sb_mind;

CREATE TABLE appointments (
    id BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT(20) NOT NULL,
    patient_id BIGINT(20) NOT NULL,
    appt_date DATE NOT NULL,
    appt_time TIME NOT NULL,
    appt_status TINYINT(1) DEFAULT 1,
    appt_cost DECIMAL(10,2) DEFAULT 0,
    appt_note TEXT,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE
);

CREATE TABLE patients (
    id BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT(20) NOT NULL,
    patient_name VARCHAR(255) NOT NULL
);


CREATE TABLE actions (
    id BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
    action_name VARCHAR(255) NOT NULL,
    action_description TEXT
);

CREATE TABLE permissions (
    id BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT(20) NOT NULL,
    action_id BIGINT(20) NOT NULL,
    owner_id BIGINT(20) NOT NULL,
    FOREIGN KEY (action_id) REFERENCES actions(id) ON DELETE CASCADE
);
CREATE TABLE action_logs (
    id BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT(20) NOT NULL,
    owner_id BIGINT(20) NOT NULL,
    action_id BIGINT(20) NOT NULL,
    action_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    target_id BIGINT(20) NOT NULL,
    target_type VARCHAR(255) NOT NULL,
    old_value JSON,
    FOREIGN KEY (action_id) REFERENCES actions(id) ON DELETE CASCADE
);