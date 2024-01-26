
-- import to uwamp

CREATE DATABASE IF NOT EXISTS `testLevel2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `testLevel2`;

DROP TABLE IF EXISTS user; 
CREATE TABLE user (
    nom VARCHAR(30),
    prenom VARCHAR(30),
    age INT,
    password0 VARCHAR(60),
    address0 VARCHAR(40)
);


INSERT INTO user 
(nom, prenom, age, password0, address0)
VALUES 
('Audrey', 'Okiau', 40, '1234', '1234@something.net'),
('test', 'test', 50, ' ', 'https://my-website.com'); -- main to test




-- end page