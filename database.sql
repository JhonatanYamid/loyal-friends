CREATE DATABASE IF NOT EXISTS loyal_friends;
USE loyal_friends;

CREATE TABLE tbl_category(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE tbl_tag (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE tbl_pet (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(255) NOT NULL,
    photoUrls TEXT NOT NULL,
    status ENUM('available', 'pending', 'sold') NOT NULL,
    CONSTRAINT fk_pet_category FOREIGN KEY (category_id) REFERENCES Category(id)
);

CREATE TABLE tbl_pet_tag (
    id INT PRIMARY KEY, 
    pet_id INT,
    tag_id INT,
    CONSTRAINT fk_pet_tag_pet FOREIGN KEY (pet_id) REFERENCES tbl_pet(id),
    CONSTRAINT fk_pet_tag_tag FOREIGN KEY (tag_id) REFERENCES tbl_tag(id)
);